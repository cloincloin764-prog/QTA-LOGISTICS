<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use Illuminate\Http\Request;

class DriverParcelController extends Controller
{
    /**
     * Driver: list assigned parcels
     */
    public function index(Request $request)
    {
        $driverId = $request->user()->id;

        $parcels = Parcel::where('driver_id', $driverId)
            ->latest()
            ->get([
                'id',
                'tracking_code',
                'sender_name',
                'receiver_name',
                'origin_city',
                'destination_city',
                'status',
                'created_at',
            ]);

        return response()->json($parcels);
    }

    /**
     * Driver: view a single parcel
     */
    public function show(Request $request, Parcel $parcel)
    {
        if ($parcel->driver_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $parcel->load('statusHistories');

        return response()->json([
            'id' => $parcel->id,
            'tracking_code' => $parcel->tracking_code,
            'sender' => [
                'name'  => $parcel->sender_name,
                'phone' => $parcel->sender_phone,
                'city'  => $parcel->origin_city,
            ],
            'receiver' => [
                'name'  => $parcel->receiver_name,
                'phone' => $parcel->receiver_phone,
                'city'  => $parcel->destination_city,
            ],
            'weight' => $parcel->weight,
            'type'   => $parcel->parcel_type,
            'status' => $parcel->status,
            'history' => $parcel->statusHistories->map(fn ($h) => [
                'status'  => $h->status,
                'comment' => $h->comment,
                'date'    => $h->created_at->toDateTimeString(),
            ]),
        ]);
    }
}
