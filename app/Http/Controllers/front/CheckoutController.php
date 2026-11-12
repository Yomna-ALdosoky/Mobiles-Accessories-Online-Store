<?php

namespace App\Http\Controllers\front;

use App\Events\OrderCreated;
use App\Exceptions\InvalidOrderException;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repository\Cart\CartRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;
use Throwable;

class CheckoutController extends Controller
{
    public function create(CartRepository $cart)
    {
        if ($cart->get()->count() == 0) {
            throw new InvalidOrderException('cart is empty');
        }
        return view('front.checkout', [
            'cart' => $cart,
            'countries' => Countries::getNames(),
        ]);
    }

    public function store(Request $request, CartRepository $cart)
    {

        $request->validate([
            'addr.billing.first_name' => ['required', 'string', 'max:255'],
            'addr.billing.last_name' => ['required', 'string', 'max:255'],
            'addr.billing.email' => ['required', 'string', 'max:255'],
            'addr.billing.phone_number' => ['required', 'string', 'max:255'],
            'addr.billing.city' => ['required', 'string', 'max:255'],

        ]);

        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {
                $total = collect($cart_items)->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id'  => Auth::id(),
                    'payment_method' => 'cod',
                    'number' => Order::getNextOrderNumber(),
                    'total' => $total,
                ]);
                foreach ($cart_items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product->id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,

                    ]);
                }
                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
            }
            DB::commit();
            $cart->empty();
            event(new OrderCreated($order));
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('orders.payments.create', $order->id);
    }
}
