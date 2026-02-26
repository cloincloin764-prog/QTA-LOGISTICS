@extends('layouts.guest')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-20">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
        
        <!-- Left: Contact Info -->
        <div class="space-y-12">
            <div class="space-y-4">
                <h1 class="text-7xl font-black text-gray-900 tracking-tighter leading-none uppercase italic">Get in <br> <span class="text-[#054a32] not-italic underline">Touch.</span></h1>
                <p class="text-xl text-gray-500 font-medium leading-relaxed max-w-md">Have questions about a shipment or interested in joining our fleet? Our hub team is ready to assist.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="bg-white p-8 rounded-[3rem] border border-gray-100 shadow-sm space-y-3">
                    <div class="w-10 h-10 bg-green-50 rounded-xl flex items-center justify-center text-xl">📍</div>
                    <h4 class="font-black text-gray-900 uppercase text-xs tracking-widest">Main Hub</h4>
                    <p class="text-xs text-gray-500 leading-relaxed font-medium">102 Logistics Way, Terminal 4,<br>Lagos State, Nigeria.</p>
                </div>
                <div class="bg-white p-8 rounded-[3rem] border border-gray-100 shadow-sm space-y-3">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-xl">📞</div>
                    <h4 class="font-black text-gray-900 uppercase text-xs tracking-widest">Support Line</h4>
                    <p class="text-xs text-gray-500 leading-relaxed font-medium">+234 800 QTA LOGS<br>Available 24/7</p>
                </div>
            </div>
        </div>

        <!-- Right: Contact Form -->
        <div class="bg-white p-10 md:p-16 rounded-[4rem] border border-gray-100 shadow-2xl shadow-gray-200/50">
            <form action="#" class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-4">Full Name</label>
                        <input type="text" placeholder="John Doe" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-green-100">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-4">Email Address</label>
                        <input type="email" placeholder="john@company.com" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-green-100">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-4">Subject</label>
                    <select class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-green-100 appearance-none">
                        <option>General Inquiry</option>
                        <option>Shipment Delay</option>
                        <option>Partnership</option>
                        <option>Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-4">Your Message</label>
                    <textarea rows="4" placeholder="How can we help?" class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-green-100"></textarea>
                </div>

                <button type="submit" class="w-full bg-[#054a32] text-white py-5 rounded-[2rem] font-black text-xs uppercase tracking-widest shadow-xl shadow-green-900/20 hover:scale-[1.02] transition-all active:scale-95">
                    Send Transmission &rarr;
                </button>
            </form>
        </div>
    </div>
</div>
@endsection