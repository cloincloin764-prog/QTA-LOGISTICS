@extends('admin.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto space-y-10">
    
    <!-- Welcome Header -->
    <div class="flex justify-between items-end">
        <div>
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Dashboard</h1>
            <p class="text-gray-500 mt-1 text-sm font-medium">Plan, prioritize, and accomplish your tasks with ease.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.parcels.create') }}" class="bg-[#054a32] text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-green-900/20 hover:scale-105 transition-all">
                + New Shipment
            </a>
            <button class="bg-white border border-gray-100 text-gray-700 px-6 py-3 rounded-2xl font-bold text-sm">Import Data</button>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Card 1 (Active/Primary) -->
        <div class="bg-[#054a32] p-6 rounded-[2rem] text-white shadow-xl shadow-green-900/10 flex flex-col justify-between h-48 relative overflow-hidden">
            <div class="flex justify-between items-start">
                <span class="text-sm font-bold opacity-80 uppercase tracking-widest">Total Parcels</span>
                <div class="bg-white/20 p-2 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg></div>
            </div>
            <h3 class="text-5xl font-black">{{ $totalParcels }}</h3>
            <p class="text-[10px] font-bold bg-white/10 inline-block px-2 py-1 rounded-lg">Increased from last month</p>
        </div>

        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex flex-col justify-between h-48">
            <div class="flex justify-between items-start">
                <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Pending</span>
                <div class="border border-gray-100 p-2 rounded-full"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg></div>
            </div>
            <h3 class="text-5xl font-black text-gray-900">{{ $pendingParcels }}</h3>
            <p class="text-[10px] font-bold text-gray-400">On discussion</p>
        </div>

        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex flex-col justify-between h-48">
             <div class="flex justify-between items-start">
                <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">In Transit</span>
                <div class="border border-gray-100 p-2 rounded-full"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg></div>
            </div>
            <h3 class="text-5xl font-black text-gray-900">{{ $inTransitParcels }}</h3>
            <p class="text-[10px] font-bold text-gray-400">Current active trips</p>
        </div>

        <div class="bg-white p-6 rounded-[2rem] border border-gray-100 shadow-sm flex flex-col justify-between h-48">
             <div class="flex justify-between items-start">
                <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Delivered</span>
                <div class="border border-gray-100 p-2 rounded-full"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg></div>
            </div>
            <h3 class="text-5xl font-black text-gray-900">{{ $deliveredParcels }}</h3>
            <p class="text-[10px] font-bold text-gray-400">Successfully completed</p>
        </div>
    </div>

    <!-- Main Grid Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left: Analytics & Team -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Analytics Chart -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                <h3 class="font-extrabold text-gray-900 mb-8">Shipment Analytics</h3>
                <div class="h-64 relative">
                    <canvas id="analyticsChart"></canvas>
                </div>
            </div>

            <!-- Team Collaboration (SRS: Active Logs) -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                <div class="flex justify-between items-center mb-8">
                    <h3 class="font-extrabold text-gray-900">Recent System Activity</h3>
                    <button class="text-xs font-bold text-gray-400 border border-gray-100 px-4 py-1.5 rounded-xl hover:bg-gray-50">+ View History</button>
                </div>
                <div class="space-y-6">
                    @foreach($recentLogs as $log)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center font-bold text-gray-400 uppercase text-xs">
                                {{ substr($log->parcel?->tracking_code ?? 'SY', -2) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900 uppercase">#{{ $log->parcel?->tracking_code ?? 'SYSTEM' }}</p>
                                <p class="text-[10px] text-gray-400 font-medium">{{ $log->comment ?? 'Status updated' }}</p>
                            </div>
                        </div>
                        <span class="px-3 py-1 bg-green-50 text-green-700 text-[10px] font-bold rounded-lg uppercase">
                            {{ $log->status }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right: Reminder & Progress -->
        <div class="space-y-8">
            <!-- Time Tracker Widget -->
            <div class="bg-black p-8 rounded-[2.5rem] text-white relative overflow-hidden h-64 flex flex-col justify-between">
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Global Terminal Clock</p>
                <div>
                    <h2 id="digital-clock" class="text-5xl font-extrabold tracking-tighter mono">--:--:--</h2>
                    <p class="text-[10px] text-gray-500 mt-2 font-bold uppercase" id="current-date">Fetching date...</p>
                </div>
                <div class="flex gap-2">
                    <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg></div>
                    <div class="w-8 h-8 rounded-lg bg-red-500 flex items-center justify-center"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd"></path></svg></div>
                </div>
                <!-- Background Pattern -->
                <div class="absolute right-[-20%] bottom-[-20%] w-48 h-48 bg-white/5 rounded-full blur-3xl"></div>
            </div>

            <!-- Progress Semicircle -->
            <div class="bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm">
                <h3 class="font-extrabold text-gray-900 mb-2">Fleet Performance</h3>
                <p class="text-xs text-gray-400 font-medium mb-6">Real-time delivery fulfillment rate</p>
                <div class="h-40 relative flex items-center justify-center">
                    <canvas id="progressChart"></canvas>
                    <div class="absolute inset-0 flex flex-col items-center justify-center pt-8">
                        <span class="text-3xl font-black text-gray-900">92%</span>
                        <span class="text-[10px] font-bold text-gray-400 uppercase">On Time</span>
                    </div>
                </div>
                <div class="mt-8 flex justify-between px-2">
                    <div class="text-center"><div class="w-2 h-2 rounded-full bg-[#054a32] mx-auto mb-1"></div><p class="text-[9px] font-bold text-gray-400 uppercase">Active</p></div>
                    <div class="text-center"><div class="w-2 h-2 rounded-full bg-green-400 mx-auto mb-1"></div><p class="text-[9px] font-bold text-gray-400 uppercase">Idle</p></div>
                    <div class="text-center"><div class="w-2 h-2 rounded-full bg-gray-200 mx-auto mb-1"></div><p class="text-[9px] font-bold text-gray-400 uppercase">Waiting</p></div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Analytics Chart (Pill Bars)
        const analyticsCtx = document.getElementById('analyticsChart').getContext('2d');
        new Chart(analyticsCtx, {
            type: 'bar',
            data: {
                labels: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
                datasets: [{
                    data: [45, 60, 35, 90, 55, 40, 20],
                    backgroundColor: '#054a32',
                    borderRadius: 50,
                    barThickness: 30,
                }, {
                    data: [30, 20, 45, 10, 30, 60, 50],
                    backgroundColor: '#E5E7EB',
                    borderRadius: 50,
                    barThickness: 30,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: { 
                    y: { display: false },
                    x: { grid: { display: false }, border: { display: false } }
                }
            }
        });

        // Progress Semicircle
        const progressCtx = document.getElementById('progressChart').getContext('2d');
        new Chart(progressCtx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [92, 8],
                    backgroundColor: ['#054a32', '#f3f4f6'],
                    borderWidth: 0,
                    circumference: 180,
                    rotation: 270,
                    cutout: '85%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });

        // Clock logic
        function updateClock() {
            const now = new Date();
            document.getElementById('digital-clock').innerText = now.toLocaleTimeString('en-US', { hour12: false });
            document.getElementById('current-date').innerText = now.toLocaleDateString('en-US', { weekday: 'long', month: 'short', day: 'numeric' });
        }
        setInterval(updateClock, 1000); updateClock();
    });
</script>
@endsection