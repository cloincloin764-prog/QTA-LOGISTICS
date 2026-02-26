@extends('layouts.guest')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-24 space-y-12">
    <div class="space-y-4 text-right">
        <h1 class="text-6xl font-black text-gray-900 tracking-tighter italic uppercase">Terms of <br> <span class="text-[#054a32] not-italic underline">Service.</span></h1>
        <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Agreement v1.2</p>
    </div>

    <div class="bg-white p-12 rounded-[4rem] border border-gray-100 shadow-xl shadow-gray-200/50 space-y-10 text-gray-600 leading-relaxed font-medium">
        <section class="space-y-4">
            <h2 class="text-2xl font-black text-gray-900 italic uppercase tracking-tight text-blue-600">01. Service Scope</h2>
            <p>QTA Logistics provides a software terminal for managing and tracking intercity shipments. By using the platform, you agree to provide accurate parcel weights and city destinations.</p>
        </section>

        <section class="space-y-4 border-l-4 border-orange-100 pl-8">
            <h2 class="text-2xl font-black text-gray-900 italic uppercase tracking-tight text-orange-500">02. Prohibited Items</h2>
            <p>Clients are strictly prohibited from shipping hazardous materials, illegal substances, or liquid chemicals through our standard express hubs. QTA reserves the right to cancel shipments without refund if violations are detected.</p>
        </section>

        <section class="space-y-4">
            <h2 class="text-2xl font-black text-gray-900 italic uppercase tracking-tight text-green-600">03. Liability</h2>
            <p>While QTA Logistics maintains a 99.9% accuracy rate, we are not liable for delays caused by extreme weather conditions or interstate hub blockages. Maximum insurance coverage applies per parcel weight class.</p>
        </section>

        <div class="pt-10 flex gap-4">
            <a href="{{ route('register') }}" class="btn-primary px-8 py-3 rounded-2xl text-xs font-black uppercase">Accept & Join</a>
            <a href="/" class="bg-gray-100 px-8 py-3 rounded-2xl text-xs font-black uppercase text-gray-900">Decline</a>
        </div>
    </div>
</div>
@endsection