<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Shipment | QTA Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-[#fdf2f4] flex items-center justify-center min-h-screen p-6">

    <div class="max-w-xl w-full">
        <!-- Brand Header -->
        <div class="flex justify-between items-center mb-12">
            <div class="bg-black text-white px-4 py-2 font-black tracking-tighter text-xl italic">QTA LOGISTICS</div>
            <div class="text-blue-600 font-bold tracking-widest text-xs uppercase">Premium Delivery</div>
        </div>

        <div class="bg-white rounded-3xl p-10 shadow-2xl shadow-rose-200/50 border border-white">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Track your shipment</h1>
            <p class="text-gray-500 text-sm mb-8">Enter your 10-digit tracking number to see live status.</p>

            <form onsubmit="event.preventDefault(); window.location.href='/track/' + document.getElementById('code').value" class="space-y-4">
                @if(session('error'))
                    <div class="p-3 bg-red-50 text-red-600 text-xs font-bold rounded-xl border border-red-100 mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="relative">
                    <input type="text" id="code" placeholder="#341918713810" required 
                           class="w-full p-5 bg-gray-50 border-2 border-transparent focus:border-blue-500 focus:bg-white rounded-2xl outline-none transition-all text-lg font-mono font-bold tracking-widest text-gray-800">
                </div>
                
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-extrabold py-5 rounded-2xl shadow-xl shadow-blue-500/30 transition-all active:scale-95 uppercase tracking-widest text-sm">
                    Track Now
                </button>
            </form>
        </div>

        <div class="mt-12 grid grid-cols-3 gap-4 text-center">
            <div>
                <p class="text-[10px] font-bold text-rose-400 uppercase tracking-widest">Global</p>
                <p class="text-xs font-bold text-gray-400">Intercity</p>
            </div>
            <div>
                <p class="text-[10px] font-bold text-rose-400 uppercase tracking-widest">Speed</p>
                <p class="text-xs font-bold text-gray-400">Express</p>
            </div>
            <div>
                <p class="text-[10px] font-bold text-rose-400 uppercase tracking-widest">Support</p>
                <p class="text-xs font-bold text-gray-400">24/7 Live</p>
            </div>
        </div>
    </div>

</body>
</html>