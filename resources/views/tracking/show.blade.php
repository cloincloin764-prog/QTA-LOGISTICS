@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking #{{ $parcel->tracking_code }} | QTA Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style> 
        body { font-family: 'Inter', sans-serif; background: #fdf2f4; } 
        /* Custom Dotted Line for Timeline */
        .dotted-line {
            background-image: linear-gradient(to bottom, #d1d5db 50%, rgba(255, 255, 255, 0) 0%);
            background-position: left;
            background-size: 2px 10px;
            background-repeat: repeat-y;
        }
    </style>
</head>
<body class="py-6 md:py-12 px-4 md:px-10">

    <div class="max-w-6xl mx-auto bg-white shadow-2xl rounded-sm overflow-hidden border border-gray-100 min-h-[800px]">
        
        <!-- Top Header Strip -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-6 md:p-8 border-b border-gray-100">
            <div class="bg-black text-white px-5 py-2.5 font-black tracking-tighter text-2xl italic mb-6 md:mb-0 select-none">QTA LOGISTICS</div>
            <div class="flex flex-col md:text-right w-full md:w-auto">
                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest mb-1">Tracking Number</p>
                <h2 class="text-xl font-black text-gray-800 tracking-tight">#{{ str_replace('TRK-', '', $parcel->tracking_code) }}</h2>
            </div>
            <div class="hidden lg:block text-blue-600 font-black italic text-2xl tracking-widest ml-10">EXPRESS</div>
        </div>

        <div class="flex flex-col lg:flex-row">
            
            <!-- LEFT COLUMN: Shipment Details -->
            <div class="w-full lg:w-1/3 p-6 md:p-8 border-r border-gray-100 bg-gray-50/30 space-y-10">
                
                <!-- Customer Section -->
                <div class="space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Customer Name</p>
                        <p class="text-sm font-bold text-gray-800">{{ $parcel->user ? $parcel->user->name : $parcel->sender_name }}</p>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Customer Contact</p>
                        <p class="text-sm font-semibold text-gray-700">{{ $parcel->sender_phone }}</p>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Delivery Address</p>
                        <p class="text-sm font-medium text-gray-600 leading-relaxed">
                            {{ $parcel->delivery_address ?? 'Address details pending...' }}
                        </p>
                        <p class="text-xs font-bold text-gray-400 mt-1 italic uppercase tracking-tighter">{{ $parcel->destination_city }}</p>
                    </div>
                </div>

                <!-- Seller/Sender Section -->
                <div class="border-t border-gray-100 pt-8 space-y-6">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Pickup Point</p>
                        <p class="text-sm font-medium text-gray-600 leading-relaxed">
                            {{ $parcel->pickup_address ?? 'Pickup point recorded' }}
                        </p>
                        <p class="text-xs font-bold text-gray-400 mt-1 italic uppercase tracking-tighter">{{ $parcel->origin_city }}</p>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Sender Name</p>
                        <p class="text-sm font-bold text-gray-800">{{ $parcel->sender_name }}</p>
                    </div>

                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Service Support</p>
                        <p class="text-sm font-bold text-blue-600">support@qta-logistics.com</p>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Status & Timeline -->
            <div class="w-full lg:w-2/3 p-6 md:p-12 bg-white">
                
                <!-- Large Status Header -->
                <div class="mb-12 border-b border-gray-100 pb-10">
                    <p class="text-sm text-gray-400 font-medium mb-2">Your shipment is currently</p>
                    <h1 class="text-5xl md:text-6xl font-black text-gray-900 tracking-tighter capitalize mb-4">
                        {{ str_replace('_', ' ', $parcel->status) }}
                    </h1>
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-6">
                        <p class="text-sm font-bold text-gray-800">As on {{ $parcel->updated_at->format('d M Y, l') }}</p>
                        <span class="hidden sm:block text-gray-300">|</span>
                        <p class="text-xs text-gray-400 uppercase tracking-widest font-semibold">Last updated {{ $parcel->updated_at->format('h:i A') }}</p>
                    </div>
                </div>

                <!-- Action Links (Optional placeholder for exchange/return) -->
                <div class="flex gap-8 mb-12">
                    <a href="mailto:support@qta-logistics.com" class="flex items-center gap-2 text-xs font-bold text-gray-800 hover:text-blue-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        Support Query
                    </a>
                    <button onclick="window.print()" class="flex items-center gap-2 text-xs font-bold text-gray-800 hover:text-blue-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Print Invoice
                    </button>
                </div>

                <!-- Tracking History Section -->
                <div>
                    <h3 class="text-sm font-black text-gray-300 uppercase tracking-widest mb-10">Shipment Milestone</h3>

                    <div class="relative space-y-12">
                        <!-- The Dotted Vertical Line -->
                        <div class="absolute left-[135px] top-2 bottom-2 w-px dotted-line"></div>

                        @foreach($parcel->statusHistories as $history)
                        <div class="flex items-start">
                            <!-- Left: Date/Time -->
                            <div class="w-32 pr-8 text-right pt-0.5">
                                <p class="text-xs font-black text-gray-800 tracking-tight">{{ $history->created_at->format('jS M Y') }}</p>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">{{ $history->created_at->format('h:i A') }}</p>
                            </div>

                            <!-- Middle: Status Bullet -->
                            <div class="relative z-10 mr-8 pt-1.5">
                                <div class="w-3.5 h-3.5 rounded-full {{ $loop->first ? 'bg-green-500 ring-[6px] ring-green-100 shadow-sm' : 'bg-gray-300' }}"></div>
                            </div>

                            <!-- Right: Status Content -->
                            <div class="flex-1">
                                <p class="text-sm font-black text-gray-900 uppercase tracking-tight">{{ str_replace('_', ' ', $history->status) }}</p>
                                <p class="text-[11px] text-gray-500 mt-1 font-medium">
                                    Location: <span class="uppercase text-gray-400 font-bold tracking-tighter">{{ $history->status == 'registered' ? $parcel->origin_city : $parcel->destination_city }}</span>
                                </p>
                                @if($history->comment)
                                    <p class="text-xs text-gray-400 mt-2 bg-gray-50 p-2 rounded italic border-l-2 border-gray-200">
                                        "{{ $history->comment }}"
                                    </p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Fixed Milestone: Origin -->
                        <div class="flex items-start opacity-30">
                            <div class="w-32 pr-8 text-right pt-0.5">
                                <p class="text-xs font-black text-gray-800">{{ $parcel->created_at->format('jS M Y') }}</p>
                            </div>
                            <div class="relative z-10 mr-8 pt-1.5">
                                <div class="w-3.5 h-3.5 rounded-full bg-gray-200"></div>
                            </div>
                            <div class="flex-1">
                                <p class="text-[11px] font-black text-gray-400 uppercase tracking-widest">Shipment Registered at Origin</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    
    <!-- Footer Brand -->
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center mt-10 px-4">
        <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.4em] mb-4 md:mb-0">
            &copy; {{ date('Y') }} QTA LOGISTICS INTERCITY SYSTEM
        </p>
        <div class="flex gap-6 opacity-40 grayscale hover:grayscale-0 transition-all cursor-pointer">
            <!-- Add Small logos if you want like Visa/Mastercard etc -->
        </div>
    </div>

</body>
</html>