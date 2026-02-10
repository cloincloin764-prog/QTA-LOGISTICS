<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        // 1. Fetch KPI Stats using your Model Constants
        $totalParcels = Parcel::count();
        
        // "Pending" = Registered (Waiting for driver)
        $pendingParcels = Parcel::where('status', Parcel::STATUS_REGISTERED)->count();
        
        // "In Transit" = Assigned OR Out for delivery
        $inTransitParcels = Parcel::whereIn('status', [
            Parcel::STATUS_ASSIGNED, 
            Parcel::STATUS_OUT_FOR_DELIVERY
        ])->count();
        
        $deliveredParcels = Parcel::where('status', Parcel::STATUS_DELIVERED)->count();

        // 2. Fetch Recent Parcels
        // FIX: Changed 'customer' to 'user' to match your Model
        $recentParcels = Parcel::with(['user', 'driver.user'])
            ->latest()
            ->take(5)
            ->get();

        // 3. Prepare Chart Data
        $chartData = [
            $pendingParcels, 
            $inTransitParcels, 
            $deliveredParcels
        ];

        // 4. Return View
        return view('admin.dashboard', compact(
            'totalParcels',
            'pendingParcels',
            'inTransitParcels',
            'deliveredParcels',
            'recentParcels',
            'chartData'
        ));
    }
}