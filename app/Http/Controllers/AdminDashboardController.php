<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use App\Models\ParcelStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    /**
     * Display the main Command Center dashboard.
     */
    public function dashboard()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Fetch KPI Stats using Model Constants for accuracy
        $totalParcels = Parcel::count();
        
        // "Pending" are parcels just registered and waiting for action
        $pendingParcels = Parcel::where('status', Parcel::STATUS_REGISTERED)->count();
        
        // "In Transit" includes those assigned and those currently on the road
        $inTransitParcels = Parcel::whereIn('status', [
            Parcel::STATUS_ASSIGNED, 
            Parcel::STATUS_OUT_FOR_DELIVERY
        ])->count();
        
        $deliveredParcels = Parcel::where('status', Parcel::STATUS_DELIVERED)->count();

        // 2. Fetch Recent Shipments (Eager load user and driver for performance)
        $recentParcels = Parcel::with(['user', 'driver.user'])
            ->latest()
            ->take(5)
            ->get();

        // 3. System Activity Logs (Fetched from Parcel Status Histories)
        // We load the 'parcel' relationship so we can show tracking codes in the log feed
        $recentLogs = ParcelStatusHistory::with('parcel')
            ->latest()
            ->take(10)
            ->get();

        // 4. Prepare Chart Data for the Doughnut/Bar chart
        $chartData = [
            $pendingParcels, 
            $inTransitParcels, 
            $deliveredParcels
        ];

        // 5. Role-Based Logic (Optional: Log who accessed the dashboard)
        // You can add logic here if you want to restrict specific data for 'staff' vs 'admin'
        // For now, both see the same operational data, but your Sidebar handles the menu visibility.

        return view('admin.dashboard', compact(
            'totalParcels',
            'pendingParcels',
            'inTransitParcels',
            'deliveredParcels',
            'recentParcels',
            'recentLogs',
            'chartData'
        ));
    }
}