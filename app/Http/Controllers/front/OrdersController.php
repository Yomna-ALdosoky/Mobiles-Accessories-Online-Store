<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function index(Request $request)
    {
        $orders = $request->user()
            ->orders()
            ->latest()
            ->get();
        return view('front.orders.index', compact('orders'));
    }
    public function show(Order $order)
    {
        // $delivery = $order->delivery()->select([
        //     'id',
        //     'order_id',
        //     'status',
        //     'latitude',
        //     'longitude',
        // ])->first();
        // return view('front.orders.show', [
        //     'order' => $order,
        //     'delivery' => $delivery
        // ]);

        abort_if($order->user_id !== auth()->id(), 403);

        return view('front.orders.show', compact('order'));
    }

    public function cancel(Order $order)
    {
        // 1. التأكد من أن الطلب يخص العميل الحالي
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // 2. التأكد من أن حالة الطلب تسمح بالإلغاء فقط (pending أو processing)
        if (!in_array($order->status, ['pending', 'processing'])) {
            return redirect()->back()->with('error', __('This order cannot be cancelled.'));
        }

        // 3. تحديث حالة الطلب إلى cancelled
        $order->update([
            'status' => 'cancelled',
        ]);

        // (اختياري) إذا كان هناك مخزون/منتجات محجوزة للطلب يمكنك إرجاعها هنا

        return redirect()->back()->with('success', __('Order has been cancelled successfully.'));
    }
}
