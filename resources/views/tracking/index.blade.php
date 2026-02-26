@extends('layouts.guest')

@section('content')
<div class="min-h-[80vh] flex flex-col items-center justify-center px-6 relative overflow-hidden">
    
    <!-- Background Decor -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-green-50/50 rounded-full blur-[120px] -z-10"></div>

    <div class="max-w-2xl w-full text-center space-y-12">
        <div class="space-y-4">
            <h1 class="text-6xl font-black text-gray-900 tracking-tighter uppercase italic">Track & Trace</h1>
            <p class="text-gray-500 font-medium">Enter your unique tracking code below to see the journey of your parcel.</p>
        </div>

        <!-- Professional Search Terminal -->
        <div class="bg-white p-4 rounded-[3rem] shadow-2xl shadow-gray-200 border border-gray-100 flex items-center gap-4">
            <div class="w-14 h-14 bg-gray-50 rounded-[1.5rem] flex items-center justify-center text-gray-300">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            
            <form onsubmit="event.preventDefault(); window.location.href='/track/' + document.getElementById('code').value" class="flex-1 flex gap-4">
                <input type="text" id="code" placeholder="Enter Tracking Code (e.g. TRK-XXXX)" required 
                       class="flex-1 bg-transparent border-none focus:ring-0 text-xl font-bold placeholder-gray-300 uppercase tracking-widest">
                
                <button type="submit" class="bg-[#054a32] text-white px-8 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-black transition-all">
                    Track
                </button>
            </form>
        </div>

        @if(session('error'))
            <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-xs font-bold border border-red-100 inline-block px-8">
                {{ session('error') }}
            </div>
        @endif

        <div class="pt-10 flex justify-center gap-12 grayscale opacity-30">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b3/DHL_Express_logo.svg" class="h-4">
            <img src="https://upload.wikimedia.org/wikipedia/commons/a/a2/FedEx_Express_logo.svg" class="h-4">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/UPS_Logo.svg" class="h-4">
        </div>
    </div>
</div>
@endsection