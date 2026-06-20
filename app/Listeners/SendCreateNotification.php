<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Models\User;
use App\Notifications\OrderCreateNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendCreateNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event)
    {
        $order = $event->order;

        $user = User::where('store_id', $order->store_id)->first();
        if ($user) {
            $user->notify(new OrderCreateNotification($order));
        }

        // $users= User::where('store_id', $order->store_id)->get();
        // Notification::send($users, new OrderCreateNotification($order));
    }
}
