<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use Illuminate\Http\JsonResponse;

class ParcelTrackingController extends Controller
{
    public function show(string $trackingCode): JsonResponse
    {
        $parcel = Parcel::with([
                'statusHistories' => function ($q) {
                    $q->orderBy('created_at');
                }
            ])
            ->where('tracking_code', $trackingCode)
            ->first();

        if (! $parcel) {
            return response()->json([
                'message' => 'Invalid tracking code',
            ], 404);
        }

        return response()->json([
            'tracking_code' => $parcel->tracking_code,
            'status'        => $parcel->status,
            'origin_city'   => $parcel->origin_city,
            'destination_city' => $parcel->destination_city,
            'history' => $parcel->statusHistories->map(function ($h) {
                return [
                    'status'  => $h->status,
                    'comment' => $h->comment,
                    'time'    => $h->created_at->toDateTimeString(),
                ];
            }),
        ]);
    }
}
