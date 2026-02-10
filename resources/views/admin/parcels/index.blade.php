@extends('admin.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto h-full">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">All Parcels</h1>
            <p class="text-sm text-gray-500">Manage and track all intercity shipments.</p>
        </div>
        <a href="{{ route('admin.parcels.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold transition-all shadow-lg">
            + New Parcel
        </a>
    </div>

    <!-- Full Parcel Table -->
    <div class="bg-white dark:bg-[#1a1a1a] rounded-xl shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-gray-50 dark:bg-[#111] text-gray-500 uppercase text-xs font-semibold">
                    <tr>
                        <th class="px-6 py-4">Tracking Code</th>
                        <th class="px-6 py-4">Sender / Origin</th>
                        <th class="px-6 py-4">Receiver / Destination</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Driver</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                    @forelse($parcels as $parcel)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                        
                        <td class="px-6 py-4">
                            <span class="font-mono font-bold text-blue-600 dark:text-blue-400">{{ $parcel->tracking_code }}</span>
                            <div class="text-[10px] text-gray-400 uppercase mt-0.5">{{ $parcel->parcel_type }} • {{ $parcel->weight }}kg</div>
                        </td>
                        <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                            <div class="font-medium text-gray-900 dark:text-white">{{ $parcel->sender_name }}</div>
                            <div class="text-xs">{{ $parcel->origin_city }}</div>
                        </td>
                        <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                            <div class="font-medium text-gray-900 dark:text-white">{{ $parcel->receiver_name }}</div>
                            <div class="text-xs">{{ $parcel->destination_city }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'registered'       => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                    'assigned'         => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                    'out_for_delivery' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                                    'delivered'        => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                    'cancelled'        => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                ];
                                $statusClass = $statusColors[$parcel->status] ?? 'bg-gray-100 text-gray-800';
                            @endphp
                            <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase {{ $statusClass }}">
                                {{ str_replace('_', ' ', $parcel->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                            @if($parcel->driver)
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center text-[10px] font-bold text-blue-600 uppercase">
                                        {{ substr($parcel->driver->user->name, 0, 2) }}
                                    </div>
                                    <span>{{ $parcel->driver->user->name }}</span>
                                </div>
                            @else
                                <span class="text-xs italic text-gray-400">Not Assigned</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if($parcel->status === 'registered')
                                <a href="{{ route('admin.parcels.assign', $parcel->id) }}" class="text-blue-600 hover:text-blue-800 font-bold text-xs uppercase">Assign</a>
                            @else
                                <button class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg></button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500 italic">No parcels found in the system.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        @if($parcels->hasPages())
        <div class="px-6 py-4 bg-gray-50 dark:bg-[#111] border-t border-gray-100 dark:border-gray-800">
            {{ $parcels->links() }}
        </div>
        @endif
    </div>
</div>
@endsection