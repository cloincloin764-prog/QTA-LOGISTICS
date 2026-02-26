@extends('layouts.guest')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12">
    <div class="flex items-center gap-4 mb-10">
        <a href="{{ route('tracking.index') }}" class="w-10 h-10 bg-white border border-gray-100 rounded-xl flex items-center justify-center text-gray-400 hover:text-black shadow-sm transition-all">
            &larr;
        </a>
        <h1 class="text-3xl font-black text-gray-900 tracking-tight">Tracking ID: <span class="text-[#054a32] mono">{{ $parcel->tracking_code }}</span></h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- Sidebar Summary -->
        <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm space-y-8">
            <div class="space-y-1">
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Current Status</p>
                <h2 class="text-2xl font-black text-[#054a32] uppercase">{{ str_replace('_', ' ', $parcel->status) }}</h2>
            </div>

            <div class="h-px bg-gray-50"></div>

            <div class="space-y-6">
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Recipient</p>
                    <p class="text-sm font-bold text-gray-800">{{ $parcel->receiver_name }}</p>
                    <p class="text-xs text-gray-500 italic mt-1">{{ $parcel->delivery_address }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Destination</p>
                    <p class="text-sm font-bold text-gray-800">{{ $parcel->destination_city }}</p>
                </div>
            </div>

            <div class="p-4 bg-gray-50 rounded-2xl flex items-center gap-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-sm">🚚</div>
                <div>
                    <p class="text-[10px] font-black text-gray-400 uppercase">Weight</p>
                    <p class="text-sm font-bold text-gray-800">{{ $parcel->weight }} kg</p>
                </div>
            </div>
        </div>

        <!-- Main Timeline -->
        <div class="lg:col-span-2 bg-white p-10 rounded-[2.5rem] border border-gray-100 shadow-sm relative overflow-hidden">
            <h3 class="font-black text-gray-900 text-lg mb-12">Shipment Milestone</h3>

            <div class="relative space-y-12 ml-4">
                <!-- Vertical Dotted Line -->
                <div class="absolute left-3 top-2 bottom-2 w-px border-l-2 border-dashed border-gray-100"></div>

                @foreach($parcel->statusHistories as $history)
                <div class="relative flex gap-10">
                    <div class="z-10 w-6 h-6 rounded-full border-4 border-white shadow-sm flex items-center justify-center {{ $loop->first ? 'bg-[#054a32] scale-125' : 'bg-gray-200' }}">
                        @if($loop->first) <div class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></div> @endif
                    </div>
                    <div class="flex-1 -mt-1">
                        <div class="flex justify-between items-start mb-1">
                            <p class="text-sm font-black text-gray-900 uppercase tracking-tight">{{ str_replace('_', ' ', $history->status) }}</p>
                            <span class="text-[10px] font-bold text-gray-400">{{ $history->created_at->format('M d, Y • h:i A') }}</span>
                        </div>
                        <p class="text-xs text-gray-500 leading-relaxed italic">"{{ $history->comment ?? 'Operational update recorded.' }}"</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Background Aesthetic decoration -->
            <div class="absolute right-[-10%] top-[-10%] w-64 h-64 bg-green-50 rounded-full blur-3xl opacity-50"></div>
        </div>
    </div>
</div>
@endsection