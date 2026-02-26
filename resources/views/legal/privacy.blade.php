@extends('layouts.guest')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-24 space-y-12">
    <div class="space-y-4">
        <h1 class="text-6xl font-black text-gray-900 tracking-tighter italic uppercase">Privacy <br> <span class="text-[#054a32] not-italic underline">Protocol.</span></h1>
        <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Effective Date: February 2026</p>
    </div>

    <div class="bg-white p-12 rounded-[4rem] border border-gray-100 shadow-xl shadow-gray-200/50 space-y-10 text-gray-600 leading-relaxed font-medium">
        <section class="space-y-4">
            <h2 class="text-2xl font-black text-gray-900 italic uppercase tracking-tight">1. Data Collection</h2>
            <p>QTA Logistics collects essential data to facilitate intercity transport. This includes names, contact phone numbers, city locations, and weight specifications of parcels. We use this data strictly for routing and driver assignment.</p>
        </section>

        <section class="space-y-4">
            <h2 class="text-2xl font-black text-gray-900 italic uppercase tracking-tight">2. Real-time Telemetry</h2>
            <p>Our system tracks the location of parcels via our Driver Portal. This data is shared publicly only through the unique tracking code provided to the sender and recipient. Driver location data is anonymized after delivery completion.</p>
        </section>

        <section class="space-y-4">
            <h2 class="text-2xl font-black text-gray-900 italic uppercase tracking-tight">3. Third Party Disclosure</h2>
            <p>We do not sell shipment data. Information is shared only with assigned drivers and hub personnel necessary to complete the transit cycle.</p>
        </section>

        <div class="pt-10 border-t border-gray-50 flex justify-between items-center">
            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Security Standard v4.0</p>
            <a href="mailto:privacy@qta.com" class="bg-gray-100 px-6 py-2 rounded-xl text-xs font-black uppercase text-gray-900">Contact DPO</a>
        </div>
    </div>
</div>
@endsection