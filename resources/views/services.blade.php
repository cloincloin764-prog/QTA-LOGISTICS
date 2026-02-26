@extends('layouts.guest')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-24">
    <div class="text-center max-w-2xl mx-auto mb-24 space-y-4">
        <h1 class="text-6xl font-black text-gray-900 tracking-tight">Enterprise <span class="text-[#054a32]">Services</span></h1>
        <p class="text-gray-500 font-medium italic">Customized logistics solutions for businesses of all sizes.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        @foreach([
            ['title' => 'E-Commerce Logistics', 'color' => 'bg-green-50', 'text' => 'text-[#054a32]', 'icon' => '🛒'],
            ['title' => 'Cold Chain Supply', 'color' => 'bg-blue-50', 'text' => 'text-blue-600', 'icon' => '❄️'],
            ['title' => 'Corporate Documents', 'color' => 'bg-orange-50', 'text' => 'text-orange-600', 'icon' => '📄'],
            ['title' => 'Bulk Cargo Transport', 'color' => 'bg-purple-50', 'text' => 'text-purple-600', 'icon' => '🚛']
        ] as $item)
        <div class="{{ $item['color'] }} p-12 rounded-[4rem] flex flex-col justify-between h-[400px] hover:scale-[1.02] transition-transform cursor-pointer">
            <span class="text-6xl">{{ $item['icon'] }}</span>
            <div>
                <h3 class="text-4xl font-black {{ $item['text'] }} mb-4">{{ $item['title'] }}</h3>
                <p class="text-gray-600 max-w-xs font-medium italic">Customized routing and dedicated driver assignment for maximum speed.</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection