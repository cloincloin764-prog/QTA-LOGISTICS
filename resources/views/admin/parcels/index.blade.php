@extends('admin.layouts.app')

@section('content')
<div class="max-w-[1600px] mx-auto space-y-6 pb-20" 
     x-data="{ 
        selected: [], 
        showStats: true,
        allIds: {{ $parcels->pluck('id') }},
        toggleAll() {
            this.selected = (this.selected.length === this.allIds.length) ? [] : [...this.allIds];
        }
     }">
    
    <!-- 1. Search & Global Header -->
    <div class="flex justify-between items-center bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
        <div class="flex items-center gap-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Shipment Deck</h1>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Registry Control</p>
            </div>
            <!-- Search Bar Input -->
            <form action="{{ route('admin.parcels.index') }}" method="GET" class="hidden md:flex items-center bg-gray-50 px-4 py-2 rounded-xl border border-transparent focus-within:border-gray-200 transition-all">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search ID or Name..." class="bg-transparent border-none focus:ring-0 text-xs w-64">
                <button type="submit" class="hidden">Search</button>
            </form>
        </div>
        <a href="{{ route('admin.parcels.create') }}" class="px-6 py-2.5 bg-black text-white rounded-xl text-xs font-bold hover:bg-blue-600 transition-all shadow-lg">
            + New Parcel
        </a>
    </div>

    <!-- 2. Controls Row -->
    <div class="flex items-center justify-between px-2">
        <div class="flex items-center gap-4">
            <!-- Filter Dropdown Simulation -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-xs font-bold text-gray-500 hover:text-black transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter Status
                </button>
                <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-48 bg-white border border-gray-100 rounded-xl shadow-xl z-50 p-2 space-y-1">
                    <a href="{{ route('admin.parcels.index') }}" class="block px-4 py-2 text-xs hover:bg-gray-50 rounded-lg">All Status</a>
                    <a href="{{ route('admin.parcels.index', ['status' => 'registered']) }}" class="block px-4 py-2 text-xs hover:bg-gray-50 rounded-lg">Registered</a>
                    <a href="{{ route('admin.parcels.index', ['status' => 'delivered']) }}" class="block px-4 py-2 text-xs hover:bg-gray-50 rounded-lg">Delivered</a>
                </div>
            </div>

            <!-- Stats Toggle -->
            <div class="flex items-center gap-3 ml-4">
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Show Analytics</span>
                <button @click="showStats = !showStats" 
                        :class="showStats ? 'bg-orange-500' : 'bg-gray-200'"
                        class="w-10 h-5 rounded-full relative transition-colors duration-300">
                    <div :class="showStats ? 'translate-x-5' : 'translate-x-1'" class="absolute top-1 w-3 h-3 bg-white rounded-full transition-transform"></div>
                </button>
            </div>
        </div>
    </div>

    <!-- 3. Horizontal Stats (Interactive Toggle) -->
    <div x-show="showStats" x-collapse
         class="grid grid-cols-4 divide-x divide-gray-100 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all">
        <div class="p-6">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Registry</p>
            <h3 class="text-2xl font-black text-gray-900 tracking-tighter">{{ $parcels->total() }}</h3>
        </div>
        <div class="p-6">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">In Transit</p>
            <h3 class="text-2xl font-black text-blue-600 tracking-tighter">{{ $parcels->where('status', 'in_transit')->count() }}</h3>
        </div>
        <div class="p-6">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Completion</p>
            <h3 class="text-2xl font-black text-green-600 tracking-tighter">94%</h3>
        </div>
        <div class="p-6">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Avg Rating</p>
            <div class="flex items-center gap-1 text-orange-400">
                <h3 class="text-2xl font-black text-gray-900 mr-2 tracking-tighter">4.9</h3>
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
            </div>
        </div>
    </div>

    <!-- 4. Main Table -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50/50 text-gray-400 text-[10px] font-black uppercase tracking-widest border-b border-gray-100">
                <tr>
                    <th class="px-6 py-4 w-10">
                        <input type="checkbox" @click="toggleAll()" :checked="selected.length === allIds.length && allIds.length > 0" class="rounded border-gray-300 text-black focus:ring-0">
                    </th>
                    <th class="px-6 py-4">Parcel / Tracking ID</th>
                    <th class="px-6 py-4">Route Path</th>
                    <th class="px-6 py-4">Weight</th>
                    <th class="px-6 py-4">Current Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($parcels as $parcel)
                <tr class="hover:bg-gray-50/50 transition-colors group" :class="selected.includes({{ $parcel->id }}) ? 'bg-orange-50/40' : ''">
                    <td class="px-6 py-5">
                        <input type="checkbox" value="{{ $parcel->id }}" x-model.number="selected" class="rounded border-gray-300 text-black focus:ring-0">
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex flex-col">
                            <span class="font-bold text-gray-900 tracking-tight">{{ $parcel->tracking_code }}</span>
                            <span class="text-[10px] text-gray-400 font-bold mt-1 uppercase italic">{{ $parcel->user?->name ?? 'Walk-in' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-2 text-xs font-bold text-gray-500">
                            {{ $parcel->origin_city }} 
                            <svg class="w-3 h-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            {{ $parcel->destination_city }}
                        </div>
                    </td>
                    <td class="px-6 py-5 font-mono text-[10px] font-bold text-gray-400 uppercase">{{ $parcel->weight }} kg</td>
                    <td class="px-6 py-5">
                        <span class="px-3 py-1 rounded-lg text-[10px] font-black uppercase bg-blue-50 text-blue-600">
                            {{ str_replace('_', ' ', $parcel->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-5 text-right">
                         <a href="{{ route('admin.parcels.show', $parcel->id) }}" class="text-gray-300 hover:text-black transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                         </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="p-20 text-center text-gray-400 uppercase font-black tracking-widest opacity-30 text-xs">Registry Empty</td></tr>
                @endforelse
            </tbody>
        </table>

        <!-- 5. Interactive Pagination -->
        <div class="px-6 py-4 bg-gray-50/30 flex justify-between items-center border-t border-gray-100">
            <div class="flex items-center gap-2">
                <span class="text-[10px] font-bold text-gray-400 uppercase">Rows</span>
                <select @change="window.location.href = '{{ route('admin.parcels.index') }}?per_page=' + $event.target.value" class="bg-white border border-gray-200 rounded-lg text-xs font-bold px-2 py-1 outline-none">
                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                </select>
            </div>
            <div>{{ $parcels->appends(request()->query())->links() }}</div>
        </div>
    </div>

    <!-- 6. FLOATING ACTION BAR (Bulk Actions) -->
    <div x-show="selected.length > 0" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="translate-y-20 opacity-0"
         x-transition:enter-end="translate-y-0 opacity-100"
         class="fixed bottom-10 left-1/2 -translate-x-1/2 z-50">
        
        <div class="bg-white border border-gray-200 shadow-2xl rounded-2xl px-6 py-4 flex items-center gap-8">
            <div class="flex items-center gap-3 border-r border-gray-100 pr-8">
                <span class="bg-black text-white w-7 h-7 rounded-full flex items-center justify-center text-[10px] font-black" x-text="selected.length"></span>
                <span class="text-xs font-black text-gray-600 uppercase tracking-widest">Shipments</span>
            </div>

            <!-- Bulk Forms -->
            <div class="flex gap-6">
                <form action="{{ route('admin.parcels.bulk_action') }}" method="POST" onsubmit="return confirm('Mark selected as delivered?')">
                    @csrf
                    <template x-for="id in selected">
                        <input type="hidden" name="selected_ids[]" :value="id">
                    </template>
                    <input type="hidden" name="action" value="mark_delivered">
                    <button class="flex items-center gap-2 text-[10px] font-black text-gray-500 hover:text-blue-600 uppercase tracking-widest transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
                        Deliver
                    </button>
                </form>

                <form action="{{ route('admin.parcels.bulk_action') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete these parcels?')">
                    @csrf
                    <template x-for="id in selected">
                        <input type="hidden" name="selected_ids[]" :value="id">
                    </template>
                    <input type="hidden" name="action" value="delete">
                    <button class="flex items-center gap-2 text-[10px] font-black text-red-500 uppercase tracking-widest transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Delete
                    </button>
                </form>
            </div>

            <button @click="selected = []" class="text-gray-300 hover:text-black border-l border-gray-100 pl-6">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>
</div>
@endsection