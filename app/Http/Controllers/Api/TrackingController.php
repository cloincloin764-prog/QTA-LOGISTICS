<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function track($trackingCode)
    {
        $parcel = Parcel::where('tracking_code', $trackingCode)
            ->with(['statusHistories' => function ($q) {
                $q->latest();
            }])
            ->first();

        if (!$parcel) {
            return response()->json([
                'message' => 'Tracking code not found'
            ], 404);
        }

        return response()->json([
            'tracking_code' => $parcel->tracking_code,
            'status' => $parcel->status,
            'from' => $parcel->origin_city,
            'to' => $parcel->destination_city,
            'history' => $parcel->statusHistories->map(function ($h) {
                return [
                    'status' => $h->status,
                    'comment' => $h->comment,
                    'date' => $h->created_at->toDateTimeString(),
                ];
            })
        ]);
    }
}
