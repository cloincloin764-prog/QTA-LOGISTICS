@extends('layouts.guest')

@section('content')
<div x-data="{ y: 0 }" @window.scroll.window="y = window.pageYOffset" class="overflow-x-hidden">
    
    <!-- HERO SECTION -->
    <section class="min-h-[70vh] flex flex-col items-center justify-center px-6 text-center space-y-8 relative">
        <!-- Floating Decor -->
        <div class="absolute top-20 left-[-10%] w-[500px] h-[500px] bg-orange-50 rounded-full blur-[120px] -z-10" :style="`transform: translateY(${y * 0.1}px)`"></div>
        
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-100 rounded-2xl shadow-sm">
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[#054a32]">The Mission</span>
        </div>

        <h1 class="text-6xl md:text-9xl font-black text-gray-900 tracking-tighter leading-none uppercase italic">
            Speed. <span class="text-[#054a32] not-italic">Scale.</span> <br> Precision.
        </h1>

        <p class="text-lg md:text-xl text-gray-500 max-w-2xl font-medium leading-relaxed italic">
            QTA Logistics was founded to solve a single problem: intercity transport was broken. We built the terminal that bridges the gap between major city hubs.
        </p>
    </section>

    <!-- STATS GRID -->
    <section class="max-w-7xl mx-auto px-6 mb-32">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-12 rounded-[4rem] border border-gray-100 shadow-sm hover:shadow-xl transition-all text-center">
                <p class="text-6xl font-black text-[#054a32] mb-2 tracking-tighter italic">50+</p>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Major City Hubs</p>
            </div>
            <div class="bg-white p-12 rounded-[4rem] border border-gray-100 shadow-sm hover:shadow-xl transition-all text-center">
                <p class="text-6xl font-black text-[#054a32] mb-2 tracking-tighter italic">24h</p>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Avg. Delivery Time</p>
            </div>
            <div class="bg-white p-12 rounded-[4rem] border border-gray-100 shadow-sm hover:shadow-xl transition-all text-center">
                <p class="text-6xl font-black text-[#054a32] mb-2 tracking-tighter italic">99.9%</p>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">Accuracy Rate</p>
            </div>
        </div>
    </section>

    <!-- BIG IMAGE SECTION (Parallax) -->
    <section class="max-w-7xl mx-auto px-6 mb-32">
        <div class="h-[600px] w-full bg-gray-200 rounded-[5rem] overflow-hidden relative group">
            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&q=80&w=2000" 
                 class="w-full h-[120%] object-cover absolute top-[-10%] left-0 grayscale group-hover:grayscale-0 transition-all duration-1000"
                 :style="`transform: translateY(${y * 0.05}px)`">
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center p-10">
                <h2 class="text-white text-4xl md:text-6xl font-black text-center tracking-tighter uppercase max-w-4xl italic">
                    Powering the supply chain of modern business.
                </h2>
            </div>
        </div>
    </section>

    <!-- PHILOSOPHY / WHY QTA -->
    <section class="py-32 bg-white rounded-[5rem] shadow-sm relative z-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-20">
            <div class="space-y-8">
                <h2 class="text-5xl font-black text-gray-900 tracking-tight leading-none uppercase italic">The QTA <br> <span class="text-[#054a32] not-italic underline">Protocol.</span></h2>
                <p class="text-lg text-gray-500 font-medium leading-relaxed">
                    We believe logistics is more than just moving boxes. It is data, it is trust, and it is the heartbeat of the economy. Our platform ensures every parcel is tracked with military-grade precision.
                </p>
                <div class="pt-6">
                    <a href="/register" class="bg-black text-white px-10 py-5 rounded-[2.5rem] font-black text-sm uppercase tracking-widest hover:scale-105 transition-all">
                        Join Our Network
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-green-50 p-8 rounded-[3rem] space-y-4">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm">🚀</div>
                    <h4 class="font-black text-gray-900 uppercase text-sm">Real-time Data</h4>
                    <p class="text-xs text-gray-500 font-medium">Full visibility into every driver movement and hub arrival.</p>
                </div>
                <div class="bg-orange-50 p-8 rounded-[3rem] space-y-4">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm">🔒</div>
                    <h4 class="font-black text-gray-900 uppercase text-sm">Zero Loss</h4>
                    <p class="text-xs text-gray-500 font-medium">Automated parcel handoffs mean nothing gets lost in transit.</p>
                </div>
                <div class="bg-blue-50 p-8 rounded-[3rem] space-y-4">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm">⚡</div>
                    <h4 class="font-black text-gray-900 uppercase text-sm">Express Hubs</h4>
                    <p class="text-xs text-gray-500 font-medium">Bypassing traditional traffic with city-direct express lanes.</p>
                </div>
                <div class="bg-purple-50 p-8 rounded-[3rem] space-y-4">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center shadow-sm">📡</div>
                    <h4 class="font-black text-gray-900 uppercase text-sm">Fleet API</h4>
                    <p class="text-xs text-gray-500 font-medium">The brain of our system, managing over 1,000 drivers daily.</p>
                </div>
            </div>
        </div>
    </section>



</div>
@endsection