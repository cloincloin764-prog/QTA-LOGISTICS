<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        // Stats for this specific customer
        $stats = [
            'total' => Parcel::where('user_id', $userId)->count(),
            'in_transit' => Parcel::where('user_id', $userId)->whereIn('status', ['assigned', 'out_for_delivery'])->count(),
            'delivered' => Parcel::where('user_id', $userId)->where('status', 'delivered')->count(),
        ];

        $parcels = Parcel::where('user_id', $userId)->latest()->paginate(10);

        return view('customer.dashboard', compact('parcels', 'stats'));
    }

    public function create()
    {
        return view('customer.create-parcel');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_name' => 'required|string',
            'sender_phone' => 'required|string',
            'receiver_name' => 'required|string',
            'receiver_phone' => 'required|string',
            'origin_city' => 'required|string',
            'pickup_address' => 'required|string',
            'destination_city' => 'required|string',
            'delivery_address' => 'required|string',
            'weight' => 'required|numeric',
            'parcel_type' => 'required|string',
        ]);

        // Force the user_id to be the logged-in customer
        $validated['user_id'] = Auth::id();

        Parcel::create($validated);

        return redirect()->route('customer.dashboard')->with('success', 'Your parcel has been registered for pickup!');
    }
}