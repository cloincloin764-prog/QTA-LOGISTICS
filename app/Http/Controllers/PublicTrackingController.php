<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class PublicTrackingController extends Controller
{
    /**
     * Show the tracking search page (The landing page)
     */
    public function index()
    {
        return view('tracking.index');
    }

    /**
     * Search and show the parcel journey
     */
    public function track(string $tracking_code)
    {
        // Fetch parcel with history (ordered latest first)
        $parcel = Parcel::where('tracking_code', $tracking_code)
            ->with(['statusHistories' => function($q) {
                $q->latest();
            }])
            ->first();

        // If not found, go back to search with error
        if (!$parcel) {
            return redirect()->route('tracking.index')->with('error', 'Tracking code not found. Please check and try again.');
        }

        // Return the professional tracking view
        return view('tracking.show', compact('parcel'));
    }
}