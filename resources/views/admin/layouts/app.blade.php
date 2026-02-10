<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'LMS - Logistics') }} - Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>

<body class="bg-[#F3F4F6] dark:bg-[#141414] text-[#1b1b18] font-sans h-screen overflow-hidden flex"
      x-data="{ 
          sidebarOpen: window.innerWidth >= 1024, 
          mobileOpen: false,
          currentDropdown: null,
          toggleDropdown(name) {
              this.currentDropdown = this.currentDropdown === name ? null : name;
          }
      }"
      @resize.window="sidebarOpen = window.innerWidth >= 1024 ? true : false">

    <!-- Mobile Overlay -->
    <div x-show="mobileOpen" @click="mobileOpen = false" x-transition.opacity class="fixed inset-0 bg-black/50 z-40 lg:hidden backdrop-blur-sm"></div>

    <!-- SIDEBAR -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
           class="fixed lg:static inset-y-0 left-0 z-50 flex flex-col h-screen bg-[#0a0a0a] text-gray-400 transition-all duration-300 ease-in-out border-r border-gray-800"
           :style="mobileOpen ? 'transform: translateX(0);' : (window.innerWidth < 1024 ? 'transform: translateX(-100%);' : '')">
        
        <!-- Brand -->
        <div class="h-16 flex items-center justify-center border-b border-gray-800">
            <div class="flex items-center gap-2 font-bold text-white text-xl">
                <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center">L</div>
                <span x-show="sidebarOpen" x-transition class="tracking-wide">LOGISTICS</span>
            </div>
        </div>

        <!-- Menu -->
<!-- Inside Sidebar Menu -->
<div class="flex-1 overflow-y-auto py-6 flex flex-col gap-2 px-3 no-scrollbar">
    
    <!-- Dashboard -->
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-gray-900 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white' : '' }}">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
        <span x-show="sidebarOpen">Overview</span>
    </a>

    <!-- Parcel Management -->
    <div>
        <button @click="sidebarOpen ? toggleDropdown('parcels') : sidebarOpen = true" class="w-full flex items-center justify-between gap-3 px-3 py-3 rounded-lg hover:bg-gray-900 transition-colors">
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                <span x-show="sidebarOpen">Parcel Mgt</span>
            </div>
            <svg x-show="sidebarOpen" :class="currentDropdown === 'parcels' ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
        </button>
        <div x-show="currentDropdown === 'parcels' && sidebarOpen" x-collapse x-cloak class="bg-gray-900/50 rounded-lg mt-1 mx-2 overflow-hidden">
            <a href="{{ route('admin.parcels.index') }}" class="block pl-12 pr-4 py-2 text-sm hover:text-blue-400">All Parcels</a>
            <a href="{{ route('admin.parcels.create') }}" class="block pl-12 pr-4 py-2 text-sm hover:text-blue-400">Add Parcel</a>
        </div>
    </div>

<!-- Inside sidebar menu -->
<div>
    <button @click="sidebarOpen ? toggleDropdown('drivers') : sidebarOpen = true" 
            class="w-full flex items-center justify-between gap-3 px-3 py-3 rounded-lg hover:bg-gray-900 transition-colors">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <span x-show="sidebarOpen">Drivers</span>
        </div>
        <svg x-show="sidebarOpen" :class="currentDropdown === 'drivers' ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
    </button>
    <div x-show="currentDropdown === 'drivers' && sidebarOpen" x-collapse x-cloak class="bg-gray-900/50 rounded-lg mt-1 mx-2 overflow-hidden">
        <a href="{{ route('admin.drivers.index') }}" class="block pl-12 pr-4 py-2 text-sm hover:text-blue-400">All Drivers</a>
        <a href="{{ route('admin.drivers.create') }}" class="block pl-12 pr-4 py-2 text-sm hover:text-blue-400">Add Driver</a>
    </div>
</div>
</div>

<!-- Sidebar Footer (Profile & Logout) -->
<div class="p-4 border-t border-gray-800 bg-[#050505]">
    <div class="flex items-center gap-3">
        <!-- User Avatar -->
        <div class="relative min-w-[40px]">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0066FF&color=fff" 
                 class="w-10 h-10 rounded-full border-2 border-gray-700 shadow-sm" alt="User">
            <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-[#0a0a0a] rounded-full"></span>
        </div>
        
        <!-- User Info -->
        <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="flex flex-col overflow-hidden flex-1">
            <span class="text-white text-sm font-bold truncate">{{ auth()->user()->name }}</span>
            <span class="text-[10px] text-gray-500 uppercase font-black tracking-widest">{{ auth()->user()->role }}</span>
        </div>
        
        <!-- Logout Button -->
        <div x-show="sidebarOpen">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="p-2 text-gray-500 hover:text-red-500 hover:bg-red-500/10 rounded-xl transition-all group" 
                        title="Logout">
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
    </aside>

    <!-- MAIN CONTENT WRAPPER -->
    <div class="flex-1 flex flex-col h-full overflow-hidden relative">
        <!-- Header -->
        <header class="h-16 bg-white dark:bg-[#0a0a0a] border-b border-gray-200 dark:border-gray-800 flex items-center justify-between px-6">
            <button @click="mobileOpen = true" class="lg:hidden text-gray-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <div class="ml-auto flex items-center gap-4">
                <!-- Search for Tracking Code (SRS 3.5) -->
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Track Parcel (Enter Code)..." class="bg-gray-100 dark:bg-gray-900 border-none rounded-lg px-4 py-2 text-sm w-64 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-[#F3F4F6] dark:bg-[#141414] p-4 lg:p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>