<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Models\Driver;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    /**
     * This handles the actual process of assignment
     */
    public function assignDriver(Request $request, $parcelId)
    {
        // 1. Validate the input
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'comment' => 'nullable|string|max:255',
        ]);

        $parcel = Parcel::findOrFail($parcelId);
        $driver = Driver::findOrFail($request->driver_id);

        try {
            // 2. Call the Business Logic from your Parcel Model (The code you shared earlier)
            // This automatically updates the status and logs the history.
            $parcel->assignDriver($driver, $request->comment ?? 'Driver assigned via Admin Dashboard');

            // 3. Check if it's an API request or a Web request
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Driver assigned successfully',
                    'parcel' => $parcel->load('driver.user'),
                ]);
            }

            // For your Blade UI:
            return redirect()->route('admin.dashboard')->with('success', 'Driver ' . $driver->user->name . ' has been assigned to ' . $parcel->tracking_code);

        } catch (\DomainException $e) {
            // If the model throws an error (e.g. parcel isn't 'registered')
            return back()->with('error', $e->getMessage());
        }
    }
}