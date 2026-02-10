<?php 
namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $parcels = Parcel::where('user_id', Auth::id())->latest()->get();
        return view('customer.dashboard', compact('parcels'));
    }

    public function create()
    {
        return view('customer.create-parcel');
    }
}