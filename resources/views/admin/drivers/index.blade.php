@extends('admin.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto h-full">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Fleet Drivers</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Manage your logistics personnel and access tokens.</p>
        </div>
        <a href="{{ route('admin.drivers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold shadow-lg shadow-blue-500/20 flex items-center gap-2 transition-all active:scale-95">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            Add New Driver
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-700 dark:text-green-300 rounded-xl flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Drivers Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($drivers as $driver)
        <div class="bg-white dark:bg-[#1a1a1a] p-6 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm relative overflow-hidden group hover:border-blue-500 dark:hover:border-blue-500 transition-colors">
            
            <!-- Top Row: Avatar & Info -->
            <div class="flex items-start justify-between mb-6">
                <div class="flex items-center gap-4">
                    <!-- Avatar (Initials) -->
                    <div class="w-12 h-12 rounded-full bg-blue-50 dark:bg-blue-900/20 flex items-center justify-center text-lg font-bold text-blue-600 dark:text-blue-400 border border-blue-100 dark:border-blue-800">
                        {{ substr($driver->user->name, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white leading-tight">{{ $driver->user->name }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $driver->user->email }}</p>
                    </div>
                </div>
                <!-- Active Indicator -->
                <div class="flex flex-col items-end">
                    <div class="relative">
                        <div class="w-3 h-3 rounded-full {{ $driver->parcels_count > 0 ? 'bg-green-500 animate-pulse' : 'bg-gray-300 dark:bg-gray-700' }}"></div>
                        @if($driver->parcels_count > 0)
                            <div class="absolute -inset-1 bg-green-500/20 rounded-full animate-ping"></div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="space-y-3 mb-6">
                <div class="flex justify-between items-center text-sm p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                    <span class="text-gray-500 dark:text-gray-400">Vehicle No.</span>
                    <span class="font-mono font-bold text-gray-900 dark:text-white uppercase tracking-wider">{{ $driver->vehicle_number }}</span>
                </div>
                <div class="flex justify-between items-center text-sm px-3">
                    <span class="text-gray-500 dark:text-gray-400">Phone</span>
                    <span class="font-medium text-gray-900 dark:text-white">{{ $driver->phone }}</span>
                </div>
                <div class="flex justify-between items-center text-sm px-3">
                    <span class="text-gray-500 dark:text-gray-400">Active Deliveries</span>
                    <span class="font-bold {{ $driver->parcels_count > 0 ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400' }}">
                        {{ $driver->parcels_count }}
                    </span>
                </div>
            </div>
            
            <!-- Token Section (Copyable) -->
            <div class="pt-4 border-t border-gray-100 dark:border-gray-800">
                <p class="text-[10px] uppercase font-bold text-gray-400 mb-2">App API Token</p>
                <div class="flex items-center bg-gray-100 dark:bg-black border border-gray-200 dark:border-gray-800 rounded-lg p-2 group-hover:border-blue-200 dark:group-hover:border-blue-900 transition-colors">
                    <code id="token-{{ $driver->id }}" class="flex-1 text-[10px] text-gray-600 dark:text-gray-400 font-mono break-all line-clamp-1">
                        {{ $driver->api_token }}
                    </code>
                    <button onclick="copyToken('{{ $driver->api_token }}', 'btn-{{ $driver->id }}')" 
                            class="ml-2 p-1.5 bg-white dark:bg-gray-800 rounded shadow-sm text-gray-500 hover:text-blue-600 transition-colors"
                            title="Copy Token">
                        <svg id="icon-copy-btn-{{ $driver->id }}" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                        <svg id="icon-check-btn-{{ $driver->id }}" class="w-4 h-4 text-green-500 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                </div>
            </div>

        </div>
        @empty
        <!-- Empty State -->
        <div class="col-span-full py-16 text-center bg-white dark:bg-[#1a1a1a] rounded-2xl border border-dashed border-gray-200 dark:border-gray-800">
            <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">No Drivers Found</h3>
            <p class="text-gray-500 dark:text-gray-400 text-sm mt-1 mb-6">Start by adding a user with the 'driver' role.</p>
            <a href="{{ route('admin.drivers.create') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 font-bold text-sm hover:underline">
                Create First Driver &rarr;
            </a>
        </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    <div class="mt-8">
        {{ $drivers->links() }}
    </div>
</div>

<!-- Simple Script to Handle Copy -->
<script>
    function copyToken(token, btnId) {
        navigator.clipboard.writeText(token).then(() => {
            // Show Check Icon
            document.getElementById('icon-copy-' + btnId).classList.add('hidden');
            document.getElementById('icon-check-' + btnId).classList.remove('hidden');
            
            // Revert after 2 seconds
            setTimeout(() => {
                document.getElementById('icon-copy-' + btnId).classList.remove('hidden');
                document.getElementById('icon-check-' + btnId).classList.add('hidden');
            }, 2000);
        });
    }
</script>
@endsection