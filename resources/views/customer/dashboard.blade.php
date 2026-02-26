@extends('admin.layouts.app') <!-- Reusing the sidebar layout -->

@section('content')
<!-- Top section of customer dashboard -->
@if(auth()->user()->unreadNotifications->count() > 0)
<div class="bg-orange-50 border border-orange-100 p-4 rounded-3xl mb-8 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <span class="w-2 h-2 bg-orange-500 rounded-full animate-ping"></span>
        <p class="text-xs font-bold text-orange-800 uppercase tracking-tight">
            You have {{ auth()->user()->unreadNotifications->count() }} unread shipment updates.
        </p>
    </div>
    <button class="text-[10px] font-black text-orange-600 uppercase hover:underline">Mark Read</button>
</div>
@endif
<div class="max-w-7xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">My Shipments</h1>
            <p class="text-sm text-gray-500">Track and manage your intercity deliveries.</p>
        </div>
        <a href="{{ route('customer.parcels.create') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-blue-500/20">
            Book New Shipment
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white dark:bg-[#1a1a1a] p-6 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Sent</p>
            <h3 class="text-3xl font-black mt-2 dark:text-white">{{ $stats['total'] }}</h3>
        </div>
        <div class="bg-white dark:bg-[#1a1a1a] p-6 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest text-blue-500">In Transit</p>
            <h3 class="text-3xl font-black mt-2 dark:text-white">{{ $stats['in_transit'] }}</h3>
        </div>
        <div class="bg-white dark:bg-[#1a1a1a] p-6 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest text-green-500">Completed</p>
            <h3 class="text-3xl font-black mt-2 dark:text-white">{{ $stats['delivered'] }}</h3>
        </div>
    </div>

    <!-- My Parcels Table -->
    <div class="bg-white dark:bg-[#1a1a1a] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 dark:bg-[#111] text-gray-400 uppercase text-[10px] font-black">
                <tr>
                    <th class="px-6 py-4">Tracking Code</th>
                    <th class="px-6 py-4">Destination</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                @foreach($parcels as $parcel)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                    <td class="px-6 py-4">
                        <span class="font-mono font-bold text-blue-600 dark:text-blue-400 underline uppercase">{{ $parcel->tracking_code }}</span>
                    </td>
                    <td class="px-6 py-4 dark:text-gray-300">
                        {{ $parcel->destination_city }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-lg text-[10px] font-bold uppercase 
                            {{ $parcel->status == 'delivered' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                            {{ str_replace('_', ' ', $parcel->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('tracking.show', $parcel->tracking_code) }}" class="text-xs font-bold text-gray-400 hover:text-blue-600 uppercase">View Live Map</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection