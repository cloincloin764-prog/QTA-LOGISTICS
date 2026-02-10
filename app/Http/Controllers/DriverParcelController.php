<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class DriverParcelController extends Controller
{
public function index($token)
{
    // Find driver by token or fail with 404
    $driver = \App\Models\Driver::where('api_token', $token)->with('user')->firstOrFail();
    
    // Get assigned parcels
    $parcels = \App\Models\Parcel::where('driver_id', $driver->id)
        ->whereNotIn('status', ['delivered', 'cancelled'])
        ->get();

    return view('driver.portal', compact('driver', 'parcels', 'token'));
}

    public function show(Request $request, Parcel $parcel)
    {
        $driver = $request->driver;

        if ($parcel->driver_id !== $driver->id) {
            return response()->json([
                'message' => 'Unauthorized parcel access',
            ], 403);
        }

        return response()->json($parcel);
    }
    
    public function updateStatus(Request $request, Parcel $parcel)
    {
        $driver = $request->driver;

        if ($parcel->driver_id !== $driver->id) {
            return response()->json([
                'message' => 'You cannot update this parcel',
            ], 403);
        }

        $request->validate([
            'status'  => 'required|string',
            'comment' => 'nullable|string',
        ]);

        try {
            $parcel->changeStatus(
                $request->status,
                $request->comment
            );

            return response()->json([
                'message' => 'Status updated',
                'parcel'  => $parcel->fresh(),
            ]);

        } catch (\DomainException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
