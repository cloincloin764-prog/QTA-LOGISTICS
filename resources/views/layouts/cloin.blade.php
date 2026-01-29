<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" type="text/css">

        <title>@yield('title', 'Admin Dashboard')</title>
        @vite (['resources/css/app.css','resources/js/app.js'])
        <!--Tailwind-->
        <script src="https//cdn.tailwindcss.com"></script>

</head>
<body>
    <body class="flex min-h-screen">
    <!--Sidebar-->
    <div class="Flex min-h-screen">
        <aside class="w-64 bg-gray-900 text-black p-4">
            <div class="p-4 font-bold text-lg border-b>
            QTA-LOGISTICS
</div>
            <nav class="p-4 space-y-2>
            <a href="/dashboard" class="block px-3 py-2 rounded hover:bg-gray-100"><i class="fa-solid fa-table"></i> Dashboard</i>
    
            </a>
            <a href="/Parcels" class="block px-3 py-2 rounded hover:bg-gray-100">
            Parcels
            </a>
            <a href="Drivers" class="block px-3 py-2 rounded hover:bg-gray-100">
            Drivers
            </a>
            <a href="/Customers record" class="block px-3 py-2 rounded hover:bg-gray-100">
            Customer record
            </a>
            <a href="/notification" class="block px-3 py-2 rounded hover:bg-gray-100">
             notification
            </a>
            <a href="/logout" class="block px-3 py-2 rounded hover:bg-gray-100">
            logout
            </a>
            </nav>
                
</aside>

</div>
<!--main content-->
<main class="flex-1 p-6">
    @yield('content')
</main>
</body>
</html>
{{-- Main content --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>
