@extends('admin.layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8 flex justify-between items-end">
        <div>
            <h1 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight uppercase">Book a New Shipment</h1>
            <p class="text-sm text-gray-500">Provide the delivery details for your parcel.</p>
        </div>
        <a href="{{ route('customer.dashboard') }}" class="text-xs font-bold text-blue-600 uppercase hover:underline">Back to My Shipments</a>
    </div>

    <form action="{{ route('customer.parcels.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white dark:bg-[#111] p-8 rounded-3xl border border-gray-100 dark:border-gray-800 shadow-xl shadow-blue-500/5">
            
            <!-- Origin -->
            <div class="space-y-4">
                <h3 class="text-blue-500 font-black text-[10px] uppercase tracking-[0.2em] mb-4">Pickup Point (Origin)</h3>
                <input type="text" name="sender_name" value="{{ auth()->user()->name }}" placeholder="Sender Name" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl p-4 text-sm dark:text-white">
                <input type="text" name="sender_phone" placeholder="Sender Contact Phone" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl p-4 text-sm dark:text-white">
                <input type="text" name="origin_city" placeholder="City (e.g. Lagos)" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl p-4 text-sm dark:text-white">
                <textarea name="pickup_address" placeholder="Full Street Address for Pickup" required rows="2" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl p-4 text-sm dark:text-white"></textarea>
            </div>

            <!-- Destination -->
            <div class="space-y-4">
                <h3 class="text-green-500 font-black text-[10px] uppercase tracking-[0.2em] mb-4">Delivery Point (Destination)</h3>
                <input type="text" name="receiver_name" placeholder="Receiver Full Name" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl p-4 text-sm dark:text-white">
                <input type="text" name="receiver_phone" placeholder="Receiver Phone Number" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl p-4 text-sm dark:text-white">
                <input type="text" name="destination_city" placeholder="City (e.g. Abuja)" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl p-4 text-sm dark:text-white">
                <textarea name="delivery_address" placeholder="Full Street Address for Delivery" required rows="2" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl p-4 text-sm dark:text-white"></textarea>
            </div>

            <!-- Parcel Details -->
            <div class="md:col-span-2 grid grid-cols-2 gap-6 pt-6 border-t border-gray-50 dark:border-gray-800">
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Weight (kg)</label>
                    <input type="number" step="0.1" name="weight" placeholder="0.5" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl p-4 text-sm dark:text-white font-bold">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-gray-400 uppercase mb-2">Item Category</label>
                    <select name="parcel_type" required class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl p-4 text-sm dark:text-white font-bold appearance-none">
                        <option value="Box">Standard Box</option>
                        <option value="Document">Document / Paper</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Fragile">Fragile / Glass</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-black px-12 py-5 rounded-2xl shadow-2xl shadow-blue-500/30 transition-all hover:scale-[1.02] active:scale-95 uppercase tracking-widest text-xs">
                Confirm & Register Shipment
            </button>
        </div>
    </form>
</div>
@endsection