<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function create(Order $order)
    {
        return view('front.payments.create', [
            'order' => $order,
        ]);
    }

    public function createStripePaymentIntent(Order $order)
    {

        $amount = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $amount = 1000;

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $amount,
            'currency' => 'usd',
            'payment_method_types' => ['card'],

        ]);
        // create payment
        try {
            $payment = new Payment();
            $payment->forceFill([
                'order_id' => $order->id,
                'amount' => $paymentIntent->amount,
                'currency' => $paymentIntent->currency,
                'method' => 'stripe',
                'status' =>  'pending',
                'transaction_id' => $paymentIntent->id,
                'transaction_data' => json_encode($paymentIntent),

            ])->save();
        } catch (QueryException $e) {
            echo $e->getMessage();
            return;
        }

        return [
            'clientSecret' => $paymentIntent->client_secret,
        ];
    }

    public function confirm(Request $request, Order $order)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $paymentIntent = $stripe->paymentIntents->retrieve(
            $request->query('payment_intent'),
            []
        );

        if ($paymentIntent->status == 'succeeded') {
            try {
                $payment = Payment::where('order_id', $order->id)->first();
                $payment->forceFill([
                    'status' =>  'completed',
                    'transaction_data' => json_encode($paymentIntent),

                ])->save();

                $order->forceFill([
                    'payment_status' => 'paid',
                    'payment_method' => 'stripe',
                    'status'         => 'processing',
                ])->save();
            } catch (QueryException $e) {
                echo $e->getMessage();
                return;
            }

            event('payment.create', $payment->id);

            return redirect()->route('orders.show', $order->id)
                ->with('success', __('Payment completed successfully! Your order is being processed.'));
        }

        return redirect()->route('orders.payments.create', [
            'order' => $order->id,
            'status' => $paymentIntent->status,
        ]);
    }
}
