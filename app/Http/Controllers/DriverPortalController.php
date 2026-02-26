<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Parcel;
use Illuminate\Http\Request;

class DriverPortalController extends Controller
{
    public function showPortal($token)
    {
        // Find the specific driver by token
        $driver = Driver::where('api_token', $token)->with('user')->firstOrFail();
        
        // Get parcels assigned to this driver that are not yet delivered
        $parcels = Parcel::where('driver_id', $driver->id)
            ->whereIn('status', [Parcel::STATUS_ASSIGNED, Parcel::STATUS_OUT_FOR_DELIVERY])
            ->latest()
            ->get();

        // Note: We send 'driver' (singular) to the view
        return view('driver.portal', compact('driver', 'parcels', 'token'));
    }

    public function updateStatus(Request $request, $token, Parcel $parcel)
    {
        $driver = Driver::where('api_token', $token)->firstOrFail();
        
        if ($parcel->driver_id !== $driver->id) {
            abort(403, 'Unauthorized parcel update.');
        }

        try {
            // Using the model method you built
            $parcel->changeStatus($request->status, $request->comment);
            return back()->with('success', 'Parcel status updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}