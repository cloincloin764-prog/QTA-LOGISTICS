<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dispatch</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 pb-10">
    <nav class="bg-black p-5 text-white sticky top-0 z-50 flex justify-between">
        <span class="font-bold tracking-tighter italic">QTA DRIVER</span>
        <span class="text-xs text-gray-400">{{ $driver->user->name }}</span>
    </nav>

    <div class="p-4 space-y-4">
        @foreach($parcels as $parcel)
        <div class="bg-white rounded-2xl shadow-sm border p-5">
            <div class="flex justify-between items-start mb-4">
                <h3 class="font-bold text-lg text-blue-600">#{{ $parcel->tracking_code }}</h3>
                <span class="px-2 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold rounded uppercase">{{ $parcel->status }}</span>
            </div>
            
            <div class="text-sm space-y-2 text-gray-600 mb-6">
                <p><strong>From:</strong> {{ $parcel->origin_city }} ({{ $parcel->sender_name }})</p>
                <p><strong>To:</strong> {{ $parcel->destination_city }} ({{ $parcel->receiver_name }})</p>
                <p class="bg-gray-50 p-2 rounded text-xs border"><strong>Address:</strong> {{ $parcel->delivery_address }}</p>
            </div>

            <form action="{{ route('driver.portal.update', [$token, $parcel->id]) }}" method="POST" class="space-y-3">
                @csrf
                <select name="status" class="w-full p-3 bg-gray-50 border rounded-xl text-sm">
                    @if($parcel->status == 'assigned') <option value="out_for_delivery">Start Delivery</option> @endif
                    @if($parcel->status == 'out_for_delivery') <option value="delivered">Mark as Delivered</option> @endif
                </select>
                <button class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl shadow-lg">UPDATE STATUS</button>
            </form>
        </div>
        @endforeach
    </div>
</body>
</html>