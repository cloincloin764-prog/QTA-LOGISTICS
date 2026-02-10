@extends('admin.layouts.app')



@section('content')
@if(session('error'))
    <div class="mb-6 p-4 bg-red-50 text-red-700 border-l-4 border-red-500 rounded shadow-sm text-sm">
        <strong>Error:</strong> {{ session('error') }}
    </div>
@endif
<div class="max-w-6xl mx-auto pb-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Shipment <span class="text-blue-600 font-mono">{{ $parcel->tracking_code }}</span></h1>
            </div>
            <p class="text-sm text-gray-500 ml-8">Created on {{ $parcel->created_at->format('M d, Y • h:i A') }}</p>
        </div>

        <div class="flex items-center gap-2">
            @if($parcel->status === 'registered')
                <a href="{{ route('admin.parcels.assign', $parcel->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-lg shadow-blue-500/20">Assign Driver</a>
            @endif
            <button onclick="window.print()" class="p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-gray-600 dark:text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Details -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Sender -->
                <div class="bg-white dark:bg-[#111] p-6 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
                    <h3 class="text-xs font-bold text-blue-500 uppercase tracking-widest mb-4">Sender Information</h3>
                    <p class="font-bold text-gray-900 dark:text-white">{{ $parcel->sender_name }}</p>
                    <p class="text-sm text-gray-500">{{ $parcel->sender_phone }}</p>
                    <div class="mt-4 pt-4 border-t border-gray-50 dark:border-gray-800">
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Origin City</p>
                        <p class="text-sm dark:text-gray-300">{{ $parcel->origin_city }}</p>
                    </div>
                </div>

                <!-- Receiver -->
                <div class="bg-white dark:bg-[#111] p-6 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
                    <h3 class="text-xs font-bold text-green-500 uppercase tracking-widest mb-4">Receiver Information</h3>
                    <p class="font-bold text-gray-900 dark:text-white">{{ $parcel->receiver_name }}</p>
                    <p class="text-sm text-gray-500">{{ $parcel->receiver_phone }}</p>
                    <div class="mt-4 pt-4 border-t border-gray-50 dark:border-gray-800">
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Destination City</p>
                        <p class="text-sm dark:text-gray-300">{{ $parcel->destination_city }}</p>
                    </div>
                </div>
            </div>

            <!-- Parcel Specs -->
            <div class="bg-white dark:bg-[#111] p-6 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden relative">
                <div class="absolute top-0 right-0 p-4 opacity-10">
                    <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20"><path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM5.884 6.68a1 1 0 10-1.415-1.414l.707-.707a1 1 0 001.415 1.415l-.707.707zM14.116 6.68l.707-.707a1 1 0 00-1.415-1.415l-.707.707a1 1 0 001.415 1.414zM4 11a1 1 0 100-2H3a1 1 0 100 2h1zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zM15.414 14.116l.707.707a1 1 0 001.414-1.415l-.707-.707a1 1 0 00-1.414 1.415zM4.586 14.116l-.707.707a1 1 0 001.415 1.414l.707-.707a1 1 0 00-1.415-1.414zM10 17a1 1 0 100-2v-1a1 1 0 100 2v1z"></path></svg>
                </div>
                <div class="grid grid-cols-3 gap-4 relative z-10">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Weight</p>
                        <p class="text-lg font-bold dark:text-white">{{ $parcel->weight }} kg</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Type</p>
                        <p class="text-lg font-bold dark:text-white">{{ $parcel->parcel_type }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Assigned Driver</p>
                        <p class="text-sm font-bold text-blue-600">{{ $parcel->driver ? $parcel->driver->user->name : 'Unassigned' }}</p>
                    </div>
                </div>
            </div>
            <!-- Status Management Card (Admin Control) -->
<div class="bg-white dark:bg-[#111] p-6 rounded-2xl border-2 border-blue-500/20 shadow-sm mb-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
        <div>
            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-tight">Update Shipment Progress</h3>
            <p class="text-xs text-gray-500 mt-1">Current Status: <span class="font-bold text-blue-600 uppercase">{{ str_replace('_', ' ', $parcel->status) }}</span></p>
        </div>

        <form action="{{ route('admin.parcels.update_status', $parcel->id) }}" method="POST" class="flex flex-wrap items-center gap-3">
            @csrf
            <div class="flex flex-col sm:flex-row gap-3">
                <select name="status" required class="bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl px-4 py-2 text-sm dark:text-white outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Change Status --</option>
                    @if($parcel->status == 'assigned')
                        <option value="out_for_delivery">Mark as Out for Delivery</option>
                    @endif
                    @if($parcel->status == 'out_for_delivery')
                        <option value="delivered">Mark as Delivered</option>
                    @endif
                    <option value="cancelled">Cancel Shipment</option>
                </select>

                <input type="text" name="comment" placeholder="Add a note (Optional)" class="bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl px-4 py-2 text-sm dark:text-white outline-none focus:ring-2 focus:ring-blue-500 w-64">
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl text-sm font-bold transition-all shadow-lg shadow-blue-500/20 active:scale-95">
                Update Status
            </button>
        </form>
    </div>
</div>
        </div>

        <!-- Right Column: Status Timeline (SRS 3.3/3.6) -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-[#111] p-6 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm h-full">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-6">Status History</h3>

                <div class="relative space-y-8">
                    <!-- The vertical line -->
                    <div class="absolute left-[11px] top-2 bottom-2 w-0.5 bg-gray-100 dark:bg-gray-800"></div>
                    
                    @foreach($parcel->statusHistories as $history)
                    <div class="relative flex gap-4">
                        <!-- Dot -->
                        <div class="z-10 w-6 h-6 rounded-full flex items-center justify-center border-4 border-white dark:border-[#111] 
                            {{ $loop->first ? 'bg-blue-600 scale-125' : 'bg-gray-300 dark:bg-gray-700' }}">
                        </div>
                        
                        <div class="flex-1 -mt-1">
                            <p class="text-sm font-bold dark:text-white uppercase tracking-tight">
                                {{ str_replace('_', ' ', $history->status) }}
                            </p>
                            <p class="text-xs text-gray-400">{{ $history->created_at->format('M d, h:i A') }}</p>
                            @if($history->comment)
                                <p class="mt-1 text-xs text-gray-500 italic bg-gray-50 dark:bg-gray-900 p-2 rounded-lg">
                                    "{{ $history->comment }}"
                                </p>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    <!-- The Starting Point -->
                    <div class="relative flex gap-4 opacity-50">
                        <div class="z-10 w-6 h-6 rounded-full bg-gray-200 dark:bg-gray-800 border-4 border-white dark:border-[#111]"></div>
                        <div class="flex-1">
                            <p class="text-xs font-bold uppercase text-gray-400">Parcel Registered</p>
                            <p class="text-[10px] text-gray-400">{{ $parcel->created_at->format('M d, h:i A') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection