<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        // Only fetch parcels where user_id matches the logged-in customer
        $parcels = Parcel::where('user_id', Auth::id())->latest()->get();
        
        return view('customer.dashboard', compact('parcels'));
    }

    public function createParcel()
    {
        return view('customer.create-parcel');
    }
}