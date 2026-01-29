<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Icons --}}
    <script src="https://unpkg.com/feather-icons"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

    
</head>
<body class="bg-gray-100">
<body x-data="{sidebarOpen: false}" class="bg-gray-100">
<div class="flex min-h-screen">

    {{-- Sidebar --}}
   

    <aside class="w-64 bg-gray-900 text-gray-200 min-h-screen">
    <div class="px-6 py-4 text-xl font-bold border-b border-gray-700">
        Logistics Admin
    </div>

    <nav class="mt-4 space-y-1">

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-6 py-3 hover:bg-gray-800">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <!-- Parcels -->
        <div x-data="{ open: true }">
            <button
                @click="open = !open"
                class="w-full flex items-center justify-between px-6 py-3 hover:bg-gray-800"
            >
                <span class="flex items-center gap-3">
                    <i class="fa-solid fa-box"></i>
                    Parcels
                </span>
                <i class="fa-solid fa-chevron-down text-sm"></i>
            </button>

            <div x-show="open" x-transition class="ml-10 mt-1 space-y-1">
                <a href="#"
                   class="block px-2 py-2 text-sm hover:text-blue">
                    All Parcels
                </a>
                <a href="#"
                   class="block px-2 py-2 text-sm hover:text-blue">
                    Add Parcel
                </a>
            </div>
        </div>
        <a href="#"
        class="flex items-center gap-3 px-6 py-3 hover:bg-gray-800 hover:text-blue transition">
        <i class="fa-solid fa-credit-card"></i>
        Customers
</a>

        <!--payment-->
        <a href="#"
        class="flex items-center gap-3 px-6 py-3 hover:bg-gray-800 hover:text-gray transition">
        <i class="fa-solid fa-credit-card"></i>
        payment
</a>

        <!-- Notifications -->
        <a href="#"
           class="flex items-center gap-3 px-6 py-3 hover:bg-gray-800">
            <i class="fa-solid fa-bell"></i>
            Notifications
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="w-full text-left flex items-center gap-3 px-6 py-3 hover:bg-gray-600">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
</nav>
<!-- Mobile overlay -->
<div 
    x-show="sidebarOpen"
    @click="sidebarOpen = false"
    class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden"
    x-transition
></div>

    
</div>

<script>
    feather.replace();

    function toggleMenu() {
        document.getElementById('parcelMenu').classList.toggle('hidden');
    }
</script>

</body>
</html>