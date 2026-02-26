<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request; // <--- THIS LINE IS THE FIX
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
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
            'sender_name' => 'required|string|max:255',
            'sender_phone' => 'required|string|max:20',
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|string|max:20',
            'origin_city' => 'required|string|max:100',
            'pickup_address' => 'required|string',
            'destination_city' => 'required|string|max:100',
            'delivery_address' => 'required|string',
            'weight' => 'required|numeric|min:0.1',
            'parcel_type' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        
        // Parcel model handles tracking code generation in its booted() method
        Parcel::create($validated);

        return redirect()->route('customer.dashboard')->with('success', 'Shipment booked successfully!');
    }
}