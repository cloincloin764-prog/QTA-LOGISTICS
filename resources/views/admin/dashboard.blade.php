@extends('admin.layouts.app')

@section('content')
    <div class="flex flex-col gap-6 max-w-7xl mx-auto h-full">
        @if(session('success'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="mb-6 p-4 bg-green-500 text-white rounded-xl shadow-lg shadow-green-500/20 flex justify-between items-center animate-bounce">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
        <button @click="show = false"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
    </div>
@endif
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">Logistics Overview</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage your intercity parcel operations.</p>
            </div>
            <div class="flex items-center gap-3">
                <!-- Link to your Add Parcel Route -->
                <a href="{{ route('admin.parcels.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-semibold shadow-lg shadow-blue-500/20 flex items-center gap-2 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Register Parcel
                </a>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Total -->
            <div class="bg-white dark:bg-[#1a1a1a] p-5 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm relative overflow-hidden">
                <div class="flex justify-between items-start z-10 relative">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">Total Parcels</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ number_format($totalParcels) }}</h3>
                    </div>
                    <div class="p-2 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Pending (Registered) -->
            <div class="bg-white dark:bg-[#1a1a1a] p-5 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">Pending Assignment</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ number_format($pendingParcels) }}</h3>
                    </div>
                    <div class="p-2 bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- In Transit (Assigned/Out) -->
            <div class="bg-white dark:bg-[#1a1a1a] p-5 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">In Transit</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ number_format($inTransitParcels) }}</h3>
                    </div>
                    <div class="p-2 bg-blue-50 dark:bg-blue-900/20 text-blue-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Delivered -->
            <div class="bg-white dark:bg-[#1a1a1a] p-5 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 dark:text-gray-400 text-xs font-bold uppercase tracking-wider">Delivered</p>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ number_format($deliveredParcels) }}</h3>
                    </div>
                    <div class="p-2 bg-green-50 dark:bg-green-900/20 text-green-600 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Parcels Table -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white dark:bg-[#1a1a1a] rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col">
                <div class="p-5 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center">
                    <h3 class="font-bold text-gray-900 dark:text-white">Recent Parcels</h3>
                    <a href="{{ route('admin.parcels.index') }}" class="text-sm text-blue-600 hover:text-blue-500 font-medium">View All</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 dark:bg-[#111] text-gray-500 uppercase text-xs">
                            <tr>
                                <th class="px-5 py-3 font-semibold">Tracking Code</th>
                                <th class="px-5 py-3 font-semibold">Route</th>
                                <th class="px-5 py-3 font-semibold">Customer</th>
                                <th class="px-5 py-3 font-semibold">Status</th>
                                <th class="px-5 py-3 font-semibold text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse($recentParcels as $parcel)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                  <td class="px-5 py-4 font-mono font-medium">
    <a href="{{ route('admin.parcels.show', $parcel->id) }}" class="text-blue-600 hover:underline">
        {{ $parcel->tracking_code }}
    </a>
</td>
                                    <td class="px-5 py-4 text-gray-600 dark:text-gray-300">
                                        {{ $parcel->origin_city }} <span class="text-gray-400 px-1">➝</span> {{ $parcel->destination_city }}
                                    </td>
                                    <td class="px-5 py-4 text-gray-600 dark:text-gray-300">
                                        <!-- FIX: Using 'user' relationship or falling back to sender_name column -->
                                        {{ $parcel->user ? $parcel->user->name : ($parcel->sender_name ?? 'N/A') }}
                                    </td>
                                    <td class="px-5 py-4">
                                        @php
                                            // Mapping Model Constants to Colors
                                            $statusColors = [
                                                'registered'       => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                                'assigned'         => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                                'out_for_delivery' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                                                'delivered'        => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                                'cancelled'        => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                            ];
                                            $statusClass = $statusColors[$parcel->status] ?? 'bg-gray-100 text-gray-800';
                                            $displayStatus = ucwords(str_replace('_', ' ', $parcel->status));
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                            {{ $displayStatus }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        @if($parcel->status === 'registered')
                                            <!-- Logic to assign driver would go here -->
                                            <a href="#" class="text-blue-600 hover:underline text-xs">Assign Driver</a>
                                        @else
                                            <span class="text-xs text-gray-400">
                                                {{ $parcel->driver && $parcel->driver->user ? $parcel->driver->user->name : 'Assigned' }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-4 text-center text-gray-500">No parcels found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Chart Section (Same as before) -->
            <div class="bg-white dark:bg-[#1a1a1a] p-6 rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 flex flex-col">
                <h3 class="font-bold text-gray-900 dark:text-white mb-2">Shipment Status</h3>
                <p class="text-xs text-gray-500 mb-6">Distribution of active parcels</p>
                
                <div class="relative flex-1 min-h-[200px]">
                    <canvas id="parcelChart"></canvas>
                </div>

                <div class="mt-6 grid grid-cols-2 gap-4">
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg text-center">
                        <span class="block text-xl font-bold text-gray-900 dark:text-white">{{ number_format($deliveredParcels) }}</span>
                        <span class="text-xs text-gray-500">Delivered</span>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-800 rounded-lg text-center">
                        <span class="block text-xl font-bold text-gray-900 dark:text-white">{{ number_format($pendingParcels) }}</span>
                        <span class="text-xs text-gray-500">Pending</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('parcelChart').getContext('2d');
            const isDark = document.documentElement.classList.contains('dark');
            const chartData = @json($chartData);

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Registered', 'In Transit', 'Delivered'],
                    datasets: [{
                        data: chartData, 
                        backgroundColor: ['#F59E0B', '#3B82F6', '#10B981'],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true, color: isDark ? '#9ca3af' : '#4b5563' } }
                    }
                }
            });
        });
    </script>
@endsection