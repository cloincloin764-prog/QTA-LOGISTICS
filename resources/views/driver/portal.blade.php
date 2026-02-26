<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dispatch Portal | QTA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 text-gray-900 pb-24">

    <!-- Header Section -->
    <nav class="sticky top-0 z-50 bg-black p-5 text-white flex justify-between items-center shadow-xl">
        <div>
            <p class="text-[10px] uppercase font-bold text-gray-500 tracking-widest mb-1">Active Driver</p>
            <h1 class="font-black italic tracking-tighter text-lg uppercase leading-none">
                {{ $driver->user?->name ?? 'Fleet Driver' }}
            </h1>
        </div>
        <div class="text-right border-l border-gray-800 pl-4">
            <p class="text-[10px] uppercase font-bold text-gray-500 mb-1">Vehicle No.</p>
            <p class="font-mono font-bold text-blue-400 text-sm uppercase">{{ $driver->vehicle_number }}</p>
        </div>
    </nav>

    <div class="p-4 space-y-6">
        
        <!-- Welcome Message -->
        <div class="px-2">
            <h2 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em]">Shipment Assignments</h2>
            @if(session('success'))
                <div class="mt-4 p-3 bg-green-500 text-white text-xs font-bold rounded-xl shadow-lg shadow-green-500/20">
                    ✓ {{ session('success') }}
                </div>
            @endif
        </div>

        @forelse($parcels as $parcel)
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-200 p-6 space-y-6 relative overflow-hidden group">
            
            <div class="flex justify-between items-center">
                <span class="font-mono font-black text-blue-600 text-xl tracking-tighter">#{{ str_replace('TRK-', '', $parcel->tracking_code) }}</span>
                <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase rounded-full">
                    {{ str_replace('_', ' ', $parcel->status) }}
                </span>
            </div>

            <!-- Route Details -->
            <div class="space-y-4">
                <div class="flex gap-4">
                    <div class="flex flex-col items-center pt-1">
                        <div class="w-3 h-3 rounded-full bg-blue-600 ring-4 ring-blue-100"></div>
                        <div class="w-0.5 h-12 border-l-2 border-dotted border-gray-200 my-1"></div>
                        <div class="w-3 h-3 rounded-full border-2 border-blue-600 bg-white"></div>
                    </div>
                    <div class="space-y-6 flex-1">
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-1">Pickup Information</p>
                            <p class="text-sm font-bold text-gray-800">{{ $parcel->origin_city }}</p>
                            <p class="text-xs text-gray-500 line-clamp-1 italic">{{ $parcel->pickup_address }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase font-black tracking-widest mb-1">Delivery Destination</p>
                            <p class="text-sm font-bold text-green-600">{{ $parcel->receiver_name }}</p>
                            <p class="text-xs text-gray-500 italic">{{ $parcel->delivery_address }}, {{ $parcel->destination_city }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <form action="{{ route('driver.portal.update', [$token, $parcel->id]) }}" method="POST" class="pt-4 border-t border-gray-50">
                @csrf
                @if($parcel->status == 'assigned')
                    <input type="hidden" name="status" value="out_for_delivery">
                    <input type="hidden" name="comment" value="Driver picked up package and is on the move.">
                    <button class="w-full bg-blue-600 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-500/20 active:scale-95 transition-all">
                        START DISPATCH
                    </button>
                @elseif($parcel->status == 'out_for_delivery')
                    <input type="hidden" name="status" value="delivered">
                    <input type="hidden" name="comment" value="Package delivered successfully to recipient.">
                    <button class="w-full bg-green-600 text-white font-black py-4 rounded-2xl shadow-lg shadow-green-500/20 active:scale-95 transition-all">
                        MARK AS DELIVERED
                    </button>
                @endif
            </form>
        </div>
        @empty
        <!-- Empty Assignments State -->
        <div class="py-24 text-center opacity-40">
            <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="font-black uppercase tracking-widest text-sm text-gray-600">No Pending Deliveries</p>
            <p class="text-xs text-gray-400 mt-2">All your tasks are completed. Enjoy your break!</p>
        </div>
        @endforelse
    </div>

    <!-- Contact Dispatch Footer -->
    <div class="fixed bottom-0 left-0 right-0 p-4 bg-white/90 backdrop-blur-md border-t flex gap-4">
        <a href="tel:0800-QTA-LOG" class="flex-1 bg-gray-100 text-gray-900 text-center py-3 rounded-xl text-xs font-black uppercase tracking-widest border border-gray-200">
            Call Hub
        </a>
        <div class="flex-1 flex flex-col justify-center items-center">
            <p class="text-[9px] text-gray-400 uppercase font-black tracking-widest italic">QTA Logistics Fleet</p>
        </div>
    </div>

</body>
</html>