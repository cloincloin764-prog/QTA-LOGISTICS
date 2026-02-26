@extends('admin.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto h-full">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Fleet Drivers</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Monitor your active drivers and manage their mobile access tokens.</p>
        </div>
        <a href="{{ route('admin.drivers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-500/20 flex items-center gap-2 transition-all active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Onboard New Driver
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 rounded-xl flex justify-between items-center">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-green-500 hover:text-green-700">&times;</button>
        </div>
    @endif

    <!-- Drivers Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($drivers as $driver)
        <div class="bg-white dark:bg-[#1a1a1a] p-6 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group hover:border-blue-500 dark:hover:border-blue-500 transition-all duration-300">
            
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center gap-4">
                    <!-- FIX: Added ?-> and ?? fallback -->
                    <div class="w-14 h-14 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-xl font-black text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-800 uppercase">
                        {{ substr($driver->user?->name ?? 'D', 0, 1) }}
                    </div>
                    <div>
                        <!-- FIX: Added ?-> and ?? fallback -->
                        <h3 class="font-bold text-gray-900 dark:text-white leading-tight text-lg">{{ $driver->user?->name ?? 'Deleted User' }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $driver->user?->email ?? 'Account Inactive' }}</p>
                    </div>
                </div>
                
                <div class="flex flex-col items-end">
                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-[10px] font-black uppercase tracking-widest {{ $driver->parcels_count > 0 ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-500 dark:bg-gray-800' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $driver->parcels_count > 0 ? 'bg-green-500 animate-pulse' : 'bg-gray-400' }}"></span>
                        {{ $driver->parcels_count > 0 ? 'Active' : 'Idle' }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 mb-6">
                <div class="p-3 bg-gray-50 dark:bg-[#111] rounded-xl border border-gray-100 dark:border-gray-800">
                    <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Vehicle No.</p>
                    <p class="text-xs font-mono font-bold text-gray-800 dark:text-gray-200 uppercase tracking-tighter">{{ $driver->vehicle_number ?? 'N/A' }}</p>
                </div>
                <div class="p-3 bg-gray-50 dark:bg-[#111] rounded-xl border border-gray-100 dark:border-gray-800">
                    <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Phone</p>
                    <p class="text-xs font-bold text-gray-800 dark:text-gray-200">{{ $driver->phone ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center text-sm px-1 mb-6">
                <span class="text-gray-500 dark:text-gray-400 text-xs">Active Assignments</span>
                <span class="font-black {{ $driver->parcels_count > 0 ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400' }}">
                    {{ $driver->parcels_count }} Parcels
                </span>
            </div>
            
            <div class="pt-5 border-t border-gray-100 dark:border-gray-800">
                <p class="text-[10px] uppercase font-black text-gray-400 tracking-[0.1em] mb-2">Dispatch Token</p>
                <div class="flex items-center bg-gray-50 dark:bg-black border border-gray-200 dark:border-gray-800 rounded-xl p-2.5 group-hover:border-blue-300 transition-colors">
                    <code class="flex-1 text-[10px] text-gray-500 font-mono truncate mr-2">
                        {{ $driver->api_token ?? 'NO-TOKEN' }}
                    </code>
                    @if($driver->api_token)
                    <button onclick="copyToken('{{ $driver->api_token }}', '{{ $driver->id }}')" 
                            id="btn-{{ $driver->id }}"
                            class="p-1.5 bg-white dark:bg-gray-800 rounded-lg shadow-sm text-gray-500 hover:text-blue-600 border border-gray-100 dark:border-gray-700">
                        <svg id="icon-copy-{{ $driver->id }}" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        <svg id="icon-check-{{ $driver->id }}" class="w-4 h-4 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-20 text-center bg-white dark:bg-[#1a1a1a] rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-800">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Fleet is empty</h3>
        </div>
        @endforelse
    </div>
</div>

<script>
    function copyToken(token, id) {
        navigator.clipboard.writeText(token).then(() => {
            document.getElementById('icon-copy-' + id).classList.add('hidden');
            document.getElementById('icon-check-' + id).classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('icon-copy-' + id).classList.remove('hidden');
                document.getElementById('icon-check-' + id).classList.add('hidden');
            }, 2000);
        });
    }
</script>
@endsection