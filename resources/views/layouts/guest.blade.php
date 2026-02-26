<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QTA Logistics | Intercity Supply Chain</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FAFAFA; }
        /* Smooth Custom Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #E5E7EB; border-radius: 10px; }
    </style>
</head>
<body x-data="{ mobileMenu: false }" :class="mobileMenu ? 'overflow-hidden' : ''">

    <!-- NAVIGATION HEADER -->
    <nav class="fixed top-0 left-0 right-0 z-[100] bg-white/70 backdrop-blur-xl border-b border-gray-100 h-20 flex items-center">
        <div class="max-w-7xl mx-auto px-6 w-full flex justify-between items-center">
            
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 group">
                <div class="w-10 h-10 bg-[#054a32] rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-all">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <span class="font-extrabold text-xl tracking-tighter text-gray-900 uppercase">QTA <span class="text-[#054a32]">Logistics</span></span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-sm font-bold text-gray-500 hover:text-[#054a32] transition-colors">Home</a>
                <a href="/about" class="text-sm font-bold text-gray-500 hover:text-[#054a32] transition-colors">Our Story</a>
                <a href="/services" class="text-sm font-bold text-gray-500 hover:text-[#054a32] transition-colors">Services</a>
                <!-- Inside the footer <ul> or grid in guest.blade.php -->
                <a href="{{ route('contact') }}" class="text-sm font-bold text-gray-500 hover:text-[#054a32] transition-colors">Contact</a>
                <a href="{{ route('tracking.index') }}" class="text-sm font-bold text-gray-500 hover:text-[#054a32] transition-colors">Track</a>
                <div class="h-4 w-px bg-gray-200"></div>
                @auth
                    <a href="{{ route('dashboard') }}" class="bg-[#054a32] text-white px-6 py-2.5 rounded-2xl text-sm font-bold shadow-lg shadow-green-900/10">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-gray-900">Login</a>
                    <a href="{{ route('register') }}" class="bg-black text-white px-6 py-2.5 rounded-2xl text-sm font-bold hover:scale-105 transition-all shadow-xl shadow-black/10">Get Started</a>
                @endauth
            </div>

            <!-- Mobile Toggle -->
            <button @click="mobileMenu = true" class="lg:hidden p-2 text-[#054a32]">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
            </button>
        </div>
    </nav>

    <!-- MOBILE DROPDOWN (FULL SCREEN MODAL STYLE) -->
    <div x-show="mobileMenu" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-[-100%]"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-[-100%]"
         x-cloak
         class="fixed inset-0 z-[200] bg-white px-8 pt-24">
        
        <!-- Close Button -->
        <button @click="mobileMenu = false" class="absolute top-6 right-8 p-2 text-gray-400">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <div class="flex flex-col gap-6">
            <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Quick Navigation</p>
            <a href="/" @click="mobileMenu = false" class="text-4xl font-black text-gray-900 tracking-tighter">Home</a>
            <a href="/about" @click="mobileMenu = false" class="text-4xl font-black text-gray-900 tracking-tighter">Our Story</a>
            <a href="/services" @click="mobileMenu = false" class="text-4xl font-black text-gray-900 tracking-tighter">Services</a>
            <a href="/track" @click="mobileMenu = false" class="text-4xl font-black text-gray-900 tracking-tighter text-[#054a32]">Track Shipment</a>
            
            <div class="mt-8 pt-8 border-t border-gray-100 grid grid-cols-2 gap-4">
                <a href="/login" class="bg-gray-50 text-gray-900 text-center py-5 rounded-[2rem] font-bold text-lg">Login</a>
                <a href="/register" class="bg-[#054a32] text-white text-center py-5 rounded-[2rem] font-bold text-lg shadow-xl shadow-green-900/20">Sign Up</a>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <main>
        @yield('content')
    </main>
    <!-- UPDATED PRODUCTION FOOTER -->
    <footer class="bg-[#054a32] text-white pt-24 pb-12 px-6 md:px-20 rounded-t-[5rem] relative overflow-hidden">
        <!-- Aesthetic Background Decor -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-[100px] -z-0"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-16 mb-20">
                
                <!-- Column 1: Brand -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-[#054a32]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="font-black text-xl tracking-tighter italic uppercase">QTA Logistics</span>
                    </div>
                    <p class="text-green-100/60 text-sm leading-relaxed font-medium italic">
                        Redefining intercity supply chains through real-time telemetry and automated dispatch systems.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-all">FB</a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-all">TW</a>
                        <a href="#" class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center hover:bg-white/20 transition-all">LN</a>
                    </div>
                </div>

                <!-- Column 2: Services -->
                <div>
                    <h4 class="font-black uppercase tracking-[0.2em] text-[10px] text-green-300 mb-8">Solutions</h4>
                    <ul class="space-y-4 text-sm font-bold text-green-100/80">
                        <li><a href="/services" class="hover:text-white transition-colors">Express Intercity</a></li>
                        <li><a href="/services" class="hover:text-white transition-colors">Corporate Fleet API</a></li>
                        <li><a href="/services" class="hover:text-white transition-colors">Secure Documents</a></li>
                        <!-- Inside the footer <ul> or grid in guest.blade.php -->
<li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact Hub</a></li>
                    </ul>
                </div>

                <!-- Column 3: Company -->
                <div>
                    <h4 class="font-black uppercase tracking-[0.2em] text-[10px] text-green-300 mb-8">Company</h4>
                    <ul class="space-y-4 text-sm font-bold text-green-100/80">
                        <li><a href="/about" class="hover:text-white transition-colors">Our Mission</a></li>
                        <li><a href="/track" class="hover:text-white transition-colors">Public Tracking</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact Hub</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition-colors">Carrier Program</a></li>
                    </ul>
                </div>

                <!-- Column 4: Support & Newsletter -->
                <div class="space-y-8">
                    <h4 class="font-black uppercase tracking-[0.2em] text-[10px] text-green-300 mb-4">Operations</h4>
                    <div class="bg-white/5 p-6 rounded-[2.5rem] border border-white/10">
                        <p class="text-xs font-bold mb-4 italic">Subscribe to fleet updates</p>
                        <div class="relative">
                            <input type="email" placeholder="Email address" class="w-full bg-white/10 border-none rounded-2xl py-3 px-4 text-xs focus:ring-1 focus:ring-white/30">
                            <button class="absolute right-2 top-1.5 bg-white text-[#054a32] px-3 py-1 rounded-xl text-[10px] font-black uppercase">Join</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="border-t border-white/10 pt-10 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-[10px] font-black uppercase tracking-[0.4em] text-green-100/30 text-center">
                    © {{ date('Y') }} QTA TERMINAL INTERCITY SYSTEM. ALL RIGHTS RESERVED.
                </p>
                <div class="flex gap-8">
                    <a href="{{ route('privacy') }}" class="text-[10px] font-black uppercase tracking-widest text-green-100/50 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="text-[10px] font-black uppercase tracking-widest text-green-100/50 hover:text-white transition-colors">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</body>
</html>