@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">New Parcel Shipment</h1>
            <p class="text-sm text-gray-500">Fill in the details to register an intercity parcel.</p>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="text-sm text-blue-600 hover:underline">Cancel & Return</a>
    </div>

    <form action="{{ route('admin.parcels.store') }}" method="POST"> <!-- Ensure route name matches your web.php -->
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white dark:bg-[#111] p-8 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
            
            <!-- Customer Section -->
            <div class="md:col-span-2">
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Customer Account</label>
                <select name="user_id" required class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
                    <option value="">-- Select Customer --</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
                    @endforeach
                </select>
            </div>

            <!-- Left Column: Origin -->
            <div class="space-y-4">
                <h3 class="text-blue-500 font-bold text-xs uppercase tracking-tighter">Origin Details</h3>
                <input type="text" name="sender_name" placeholder="Sender Name" required class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
                <input type="text" name="sender_phone" placeholder="Sender Phone" required class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
                <input type="text" name="origin_city" placeholder="Origin City" required class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
            </div>
            <!-- Inside Origin Details Section -->
<textarea name="pickup_address" placeholder="Full Pickup Address" class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white" rows="2"></textarea>

<!-- Inside Destination Details Section -->
<textarea name="delivery_address" placeholder="Full Delivery Address" class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white" rows="2"></textarea>
            <!-- Right Column: Destination -->
            <div class="space-y-4">
                <h3 class="text-green-500 font-bold text-xs uppercase tracking-tighter">Destination Details</h3>
                <input type="text" name="receiver_name" placeholder="Receiver Name" required class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
                <input type="text" name="receiver_phone" placeholder="Receiver Phone" required class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
                <input type="text" name="destination_city" placeholder="Destination City" required class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
            </div>

            <!-- Footer Section: Specs -->
            <div class="md:col-span-2 grid grid-cols-2 gap-4 border-t border-gray-100 dark:border-gray-800 pt-6 mt-2">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" required class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Parcel Type</label>
                    <select name="parcel_type" required class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
                        <option value="Box">Box / Carton</option>
                        <option value="Document">Document / Envelope</option>
                        <option value="Fragile">Fragile Item</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-10 py-3 rounded-xl shadow-xl shadow-blue-500/30 transition-all active:scale-95">
                Generate Tracking Code & Save
            </button>
        </div>
    </form>
</div>
@endsection