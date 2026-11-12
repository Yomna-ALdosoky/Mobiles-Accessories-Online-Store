<?php

namespace App\Http\Controllers\Api;

use App\Events\DeliveryLocationUpdated;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeliveryController extends Controller
{
    public function show($id)
    {
        $delivery = Delivery::query()->select([
            'id',
            'order_id',
            'status',
            'latitude',
            'longitude',
        ])
            ->where('id', $id)
            ->firstOrFail();

        return $delivery;
    }


    public function update(Request $request, Delivery $delivery)
    {
        $request->validate([
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
        ]);

        $delivery->update([
            'latitude'  => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        // event(new DeliveryLocationUpdated($delivery, $request->latitude, $request->longitude));
        event(new DeliveryLocationUpdated($delivery, $request->latitude, $request->longitude));

        return $delivery;
    }
}
