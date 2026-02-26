@extends('layouts.guest')

@section('content')
<div x-data="{ y: 0 }" @window.scroll.window="y = window.pageYOffset" class="relative overflow-x-hidden">
    
<!-- HERO -->
<section class="relative min-h-screen flex items-center px-6 lg:px-20 overflow-hidden">

    <!-- Background Glow -->
    <div class="absolute top-[-200px] left-[20%] w-[700px] h-[700px] bg-green-100 rounded-full blur-[160px] opacity-40"></div>
    <div class="absolute bottom-[-200px] right-[10%] w-[600px] h-[600px] bg-orange-100 rounded-full blur-[160px] opacity-40"></div>

    <div class="max-w-7xl mx-auto w-full grid lg:grid-cols-2 gap-16 items-center">

        <!-- LEFT -->
        <div class="space-y-8 text-center lg:text-left">

            <!-- Badge -->
            <div class="inline-flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-full shadow-sm">
                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                <span class="text-xs font-semibold text-gray-600 tracking-wide">
                    Smart Logistics Platform
                </span>
            </div>

            <!-- Title -->
            <h1 class="text-5xl md:text-7xl font-extrabold leading-tight text-gray-900">
                Fast & Reliable  
                <span class="bg-gradient-to-r from-green-700 to-green-500 bg-clip-text text-transparent">
                    Intercity Delivery
                </span>
            </h1>

            <!-- Description -->
            <p class="text-lg text-gray-600 max-w-xl mx-auto lg:mx-0">
                Manage shipments, track parcels in real-time, and connect cities
                through one powerful logistics platform built for modern businesses.
            </p>

            <!-- CTA -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">

                <a href="/track"
                   class="px-8 py-4 bg-green-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:scale-105 transition">
                    Track Parcel
                </a>

                <a href="/register"
                   class="px-8 py-4 bg-white border border-gray-300 text-gray-800 font-semibold rounded-xl hover:bg-gray-50 transition">
                    Become a Partner
                </a>

            </div>

            <!-- Trust -->
            <div class="flex items-center gap-6 justify-center lg:justify-start pt-4 text-sm text-gray-500">
                <span>Trusted by logistics teams</span>
                <div class="flex -space-x-2">
                    <img class="w-8 h-8 rounded-full border" src="https://i.pravatar.cc/100?img=1">
                    <img class="w-8 h-8 rounded-full border" src="https://i.pravatar.cc/100?img=2">
                    <img class="w-8 h-8 rounded-full border" src="https://i.pravatar.cc/100?img=3">
                </div>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="relative hidden lg:block">

            <div class="bg-white p-6 rounded-3xl shadow-2xl border border-gray-100">
                <img src="{{ asset('images/logistic.jpg') }}" 
     class="rounded-2xl w-full h-[520px] object-cover">
            </div>

            <!-- Floating Card -->
            <div class="absolute -bottom-8 -left-8 bg-white p-6 rounded-2xl shadow-xl border">
                <p class="text-3xl">📦</p>
                <p class="text-sm font-semibold text-gray-700">Shipment In Transit</p>
            </div>

            <!-- Floating Stats -->
            <div class="absolute -top-8 -right-8 bg-green-800 text-white px-6 py-4 rounded-2xl shadow-xl">
                <p class="text-sm opacity-80">Active Deliveries</p>
                <p class="text-2xl font-bold">2,481</p>
            </div>

        </div>

    </div>
</section>

    <!-- CAROUSEL SECTION -->
    <section class="py-32 bg-white rounded-[5rem] shadow-sm relative z-20 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 mb-16 flex justify-between items-end">
            <div>
                <h2 class="text-5xl font-black text-gray-900 tracking-tight">Our Core <span class="text-[#054a32]">Services.</span></h2>
                <p class="text-gray-400 font-bold mt-2">Scale your logistics with our automated hub network.</p>
            </div>
            <!-- Swiper Controls -->
            <div class="hidden sm:flex gap-4">
                <button class="swiper-prev w-14 h-14 bg-gray-50 border border-gray-100 rounded-full flex items-center justify-center hover:bg-[#054a32] hover:text-white transition-all">&larr;</button>
                <button class="swiper-next w-14 h-14 bg-gray-50 border border-gray-100 rounded-full flex items-center justify-center hover:bg-[#054a32] hover:text-white transition-all">&rarr;</button>
            </div>
        </div>

        <div class="swiper mySwiper px-6 lg:px-20 overflow-visible">
            <div class="swiper-wrapper">
                @foreach([
                    ['icon' => '🛰️', 'title' => 'Real-time Telemetry', 'bg' => 'bg-blue-50', 'text' => 'text-blue-600'],
                    ['icon' => '🛡️', 'title' => 'Insured Transit', 'bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
                    ['icon' => '⚡', 'title' => 'Express Priority', 'bg' => 'bg-orange-50', 'text' => 'text-orange-600'],
                    ['icon' => '🚛', 'title' => 'Fleet Automation', 'bg' => 'bg-green-50', 'text' => 'text-[#054a32]'],
                ] as $svc)
                <div class="swiper-slide h-auto">
                    <div class="{{ $svc['bg'] }} p-12 rounded-[4rem] h-full space-y-8 border border-white hover:scale-[1.02] transition-transform duration-500">
                        <div class="w-16 h-16 bg-white rounded-3xl flex items-center justify-center text-4xl shadow-sm">{{ $svc['icon'] }}</div>
                        <h3 class="text-3xl font-black text-gray-900 leading-tight">{{ $svc['title'] }}</h3>
                        <p class="text-gray-500 font-medium text-lg leading-relaxed italic">Dedicated intercity routing with 24/7 hub monitoring.</p>
                        <a href="/services" class="inline-block text-[10px] font-black uppercase {{ $svc['text'] }} tracking-[0.2em] hover:underline">Learn Strategy &rarr;</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper(".mySwiper", {
            slidesPerView: 1.1,
            spaceBetween: 20,
            centeredSlides: false,
            navigation: { nextEl: ".swiper-next", prevEl: ".swiper-prev" },
            breakpoints: {
                640: { slidesPerView: 2, spaceBetween: 30 },
                1024: { slidesPerView: 3, spaceBetween: 40 },
            }
        });
    });
</script>
@endsection