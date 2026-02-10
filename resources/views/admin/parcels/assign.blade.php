@extends('admin.layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Assign Driver</h1>
            <p class="text-sm text-gray-500">Select a driver for Shipment <span class="font-mono font-bold text-blue-600">{{ $parcel->tracking_code }}</span></p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-800">Back to Dashboard</a>
    </div>

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm rounded">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Parcel Summary Card -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-[#111] p-6 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Shipment Details</h3>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Route</p>
                        <p class="text-sm font-semibold dark:text-white">{{ $parcel->origin_city }} ➝ {{ $parcel->destination_city }}</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-gray-400 uppercase font-bold">Receiver</p>
                        <p class="text-sm font-semibold dark:text-white">{{ $parcel->receiver_name }}</p>
                        <p class="text-xs text-gray-500">{{ $parcel->receiver_phone }}</p>
                    </div>
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex justify-between">
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-bold">Weight</p>
                            <p class="text-sm font-semibold dark:text-white">{{ $parcel->weight }} kg</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-bold">Type</p>
                            <p class="text-sm font-semibold dark:text-white">{{ $parcel->parcel_type }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Driver Selection Form -->
        <div class="lg:col-span-2">
            <form action="{{ route('admin.parcels.process_assignment', $parcel->id) }}" method="POST" class="bg-white dark:bg-[#111] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm overflow-hidden">
                @csrf
                <div class="p-6 border-b border-gray-100 dark:border-gray-800">
                    <h3 class="font-bold text-gray-900 dark:text-white">Choose Available Driver</h3>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Driver List -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($drivers as $driver)
                        <label class="relative flex items-center p-4 border rounded-xl cursor-pointer hover:border-blue-500 transition-all group dark:border-gray-800 dark:hover:bg-gray-900">
                            <input type="radio" name="driver_id" value="{{ $driver->id }}" required class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                            <div class="ml-4">
                                <p class="text-sm font-bold text-gray-900 dark:text-white group-hover:text-blue-600">{{ $driver->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $driver->vehicle_number ?? 'Fleet Driver' }}</p>
                            </div>
                        </label>
                        @endforeach
                    </div>

                    <!-- Comment -->
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Assignment Notes (Optional)</label>
                        <textarea name="comment" rows="3" class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-4 text-sm dark:text-white placeholder-gray-500 focus:ring-blue-500" placeholder="e.g. Please pick up by 4 PM..."></textarea>
                    </div>
                </div>

                <div class="p-6 bg-gray-50 dark:bg-[#161616] border-t border-gray-100 dark:border-gray-800 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-blue-500/30 transition-all active:scale-95">
                        Confirm Assignment
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection