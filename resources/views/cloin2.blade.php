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
    
</head>
<body class="bg-gray-100">
<body x-data="{sidebarOpen: false}" class="bg-gray-100">
<div class="flex min-h-screen">

    {{-- Sidebar --}}
   

    <aside class="w-64 bg-gray-900 text-white">
        <aside>

        <div class="p-4 text-xl font-bold border-b border-gray-700">
            Logistics Admin
        </div>

        <nav class="p-4 space-y-2">
            <a href="#" class="flex items-center gap-2 p-2 rounded hover:bg-gray-700">
                <i data-feather="home"></i>
                <span>Dashboard</span>
            </a>

            <button onclick="toggleMenu()" class="flex items-center justify-between w-full p-2 rounded hover:bg-gray-700">
                <div class="flex items-center gap-2">
                    <i data-feather="package"></i>
                    <span>Parcels</span>
                </div>
                <i data-feather="chevron-down"></i>
            </button>

            <div id="parcelMenu" class="ml-6 hidden space-y-1">
                <a href="#" class="block p-2 rounded hover:bg-gray-700">All Parcels</a>
                <a href="#" class="block p-2 rounded hover:bg-gray-700">Add Parcel</a>
            </div>
        </nav>
    </aside>

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