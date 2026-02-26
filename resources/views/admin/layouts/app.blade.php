<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QTA Logistics | Terminal</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .mono { font-family: 'JetBrains Mono', monospace; }
        .sidebar-active { background-color: #054a32; color: white !important; box-shadow: 0 20px 25px -5px rgba(5, 74, 50, 0.2); }
    </style>
</head>
<body class="bg-[#F8FAFC] dark:bg-[#050505] text-slate-900 h-screen overflow-hidden flex"
      x-data="{ sidebarOpen: true }">

    <!-- SIDEBAR CONTAINER -->
    <aside :class="sidebarOpen ? 'w-80' : 'w-24'" 
           class="bg-[#0A0A0A] border-r border-white/5 h-screen flex flex-col transition-all duration-500 z-50 shadow-2xl">
        
        <!-- Logo Area -->
        <div class="h-24 flex items-center px-8 border-b border-white/5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-[#054a32] rounded-2xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-black text-xl italic">Q</span>
                </div>
                <div x-show="sidebarOpen" x-transition class="flex flex-col">
                    <span class="text-white font-black tracking-tighter text-lg uppercase italic">Logistics</span>
                    <span class="text-[#054a32] text-[9px] font-black uppercase tracking-[0.3em]">Terminal v2.0</span>
                </div>
            </div>
        </div>

        <!-- Navigation Menus (Role Based) -->
        <nav class="flex-1 overflow-y-auto py-8 px-4 space-y-10 no-scrollbar">

            @php $user = auth()->user(); @endphp

            {{-- 1. ADMIN & STAFF SECTION --}}
            @if($user->isAdmin() || $user->isStaff())
                <div class="space-y-2">
                    <p x-show="sidebarOpen" class="px-6 text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] mb-4">Management</p>
                    
                    <a href="{{ route('admin.dashboard') }}" 
                       class="flex items-center gap-4 px-6 h-16 rounded-2xl transition-all {{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span x-show="sidebarOpen" class="font-bold text-sm tracking-tight uppercase">Dashboard</span>
                    </a>

                    <a href="{{ route('admin.parcels.index') }}" 
                       class="flex items-center gap-4 px-6 h-16 rounded-2xl transition-all {{ request()->routeIs('admin.parcels.*') ? 'sidebar-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        <span x-show="sidebarOpen" class="font-bold text-sm tracking-tight uppercase">Shipment Deck</span>
                    </a>

                    <a href="{{ route('admin.drivers.index') }}" 
                       class="flex items-center gap-4 px-6 h-16 rounded-2xl transition-all {{ request()->routeIs('admin.drivers.*') ? 'sidebar-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        <span x-show="sidebarOpen" class="font-bold text-sm tracking-tight uppercase">Fleet Team</span>
                    </a>
                </div>
            @endif

            {{-- 2. CUSTOMER ONLY SECTION --}}
            @if($user->isCustomer())
                <div class="space-y-2">
                    <p x-show="sidebarOpen" class="px-6 text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] mb-4">My Dashboard</p>
                    
                    <a href="{{ route('customer.dashboard') }}" 
                       class="flex items-center gap-4 px-6 h-16 rounded-2xl transition-all {{ request()->routeIs('customer.dashboard') ? 'sidebar-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span x-show="sidebarOpen" class="font-bold text-sm tracking-tight uppercase">My Shipments</span>
                    </a>

                    <a href="{{ route('customer.parcels.create') }}" 
                       class="flex items-center gap-4 px-6 h-16 rounded-2xl transition-all {{ request()->routeIs('customer.parcels.create') ? 'sidebar-active' : 'hover:bg-white/5 text-gray-400 hover:text-white' }}">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        <span x-show="sidebarOpen" class="font-bold text-sm tracking-tight uppercase">Book Shipment</span>
                    </a>
                </div>
            @endif

            {{-- 3. SHARED SYSTEM SECTION --}}
            <div class="space-y-2 pt-10 border-t border-white/5">
                <p x-show="sidebarOpen" class="px-6 text-[10px] font-black text-gray-600 uppercase tracking-[0.3em] mb-4">Account</p>
                
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 px-6 h-14 rounded-2xl hover:bg-white/5 text-gray-500 hover:text-white transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <span x-show="sidebarOpen" class="text-xs font-bold uppercase">Settings</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-4 px-6 h-14 rounded-2xl hover:bg-red-500/10 text-red-500/70 hover:text-red-500 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7"></path></svg>
                        <span x-show="sidebarOpen" class="text-xs font-bold uppercase text-left">Terminate Session</span>
                    </button>
                </form>
            </div>
        </nav>

        <!-- Profile Bar -->
        <div class="p-6 bg-black border-t border-white/5">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=054a32&color=fff" class="w-12 h-12 rounded-xl border border-white/10 shadow-lg">
                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-500 border-4 border-black rounded-full"></div>
                </div>
                <div x-show="sidebarOpen" class="flex-1 overflow-hidden">
                    <p class="text-white text-xs font-black uppercase truncate">{{ $user->name }}</p>
                    <p class="text-[9px] text-[#054a32] font-black uppercase tracking-widest">{{ $user->role }} Member</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- MAIN PANEL -->
    <main class="flex-1 flex flex-col overflow-hidden relative">
        <!-- Top Bar -->
        <header class="h-20 bg-white/80 dark:bg-black/50 backdrop-blur-xl border-b border-slate-200 dark:border-white/5 flex items-center justify-between px-10 z-40">
            <button @click="sidebarOpen = !sidebarOpen" class="text-slate-400 hover:text-[#054a32] transition-all">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h7"></path></svg>
            </button>
            <div class="flex items-center gap-6">
                <a href="{{ route('tracking.index') }}" class="text-[10px] font-black uppercase tracking-widest text-[#054a32] border border-[#054a32]/20 px-4 py-2 rounded-xl hover:bg-[#054a32] hover:text-white transition-all">Live Tracker</a>
            </div>
            <!-- Inside the <header> in admin/layouts/app.blade.php -->
<div class="flex items-center gap-6" x-data="{ openNotifications: false }">
    
    <!-- Notification Bell -->
    <div class="relative">
        <button @click="openNotifications = !openNotifications" class="p-2 text-gray-400 hover:text-[#054a32] transition-all relative">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            
            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="absolute top-2 right-2 w-4 h-4 bg-orange-500 text-white text-[10px] font-black flex items-center justify-center rounded-full border-2 border-white">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
        </button>

        <!-- Dropdown Panel -->
        <div x-show="openNotifications" @click.away="openNotifications = false" x-cloak
             class="absolute right-0 mt-4 w-80 bg-white rounded-[2rem] shadow-2xl border border-gray-100 overflow-hidden z-50">
            <div class="p-5 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Notifications</span>
                <a href="#" class="text-[10px] font-bold text-[#054a32] uppercase">Clear All</a>
            </div>
            
            <div class="max-h-96 overflow-y-auto no-scrollbar">
                @forelse(auth()->user()->notifications->take(5) as $notification)
                    <div class="p-5 border-b border-gray-50 hover:bg-gray-50 transition-colors cursor-pointer">
                        <p class="text-xs font-bold text-gray-800">{{ $notification->data['message'] }}</p>
                        <p class="text-[10px] text-gray-400 mt-1 uppercase font-bold">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                @empty
                    <div class="p-10 text-center">
                        <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest">No active alerts</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
        </header>

        <!-- Content Shell -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto p-8 lg:p-12 dark:bg-[#050505]">
            @yield('content')
        </div>
    </main>

</body>
</html>