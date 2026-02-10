@extends('admin.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Onboard Driver</h1>
        <p class="text-sm text-gray-500">Create a new driver account or link an existing user.</p>
    </div>

    <!-- Alpine Data Scope -->
    <form x-data="{ mode: 'new' }" action="{{ route('admin.drivers.store') }}" method="POST" class="bg-white dark:bg-[#111] p-8 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm">
        @csrf
        
        <!-- Toggle Tabs -->
        <div class="flex p-1 bg-gray-100 dark:bg-gray-800 rounded-xl mb-6">
            <button type="button" @click="mode = 'new'" 
                :class="mode === 'new' ? 'bg-white dark:bg-[#111] shadow text-gray-900 dark:text-white' : 'text-gray-500'"
                class="flex-1 py-2 text-sm font-bold rounded-lg transition-all">
                Create New User
            </button>
            <button type="button" @click="mode = 'existing'" 
                :class="mode === 'existing' ? 'bg-white dark:bg-[#111] shadow text-gray-900 dark:text-white' : 'text-gray-500'"
                class="flex-1 py-2 text-sm font-bold rounded-lg transition-all">
                Select Existing User
            </button>
        </div>

        <div class="space-y-6">
            
            <!-- SECTION: Create New User -->
            <div x-show="mode === 'new'" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Full Name</label>
                        <input type="text" name="name" :required="mode === 'new'" placeholder="e.g. John Doe" 
                               class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Email Address</label>
                        <input type="email" name="email" :required="mode === 'new'" placeholder="driver@company.com" 
                               class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Login Password</label>
                    <input type="password" name="password" :required="mode === 'new'" placeholder="••••••••" 
                           class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
                </div>
            </div>

            <!-- SECTION: Select Existing User -->
            <div x-show="mode === 'existing'" style="display: none;">
                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Select User Account</label>
                <select name="user_id" :required="mode === 'existing'" class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
                    <option value="">-- Choose Account --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                    @endforeach
                </select>
            </div>

            <div class="h-px bg-gray-100 dark:border-gray-800 my-6"></div>

            <!-- Common Fields (Vehicle/Phone) -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Vehicle Number</label>
                    <input type="text" name="vehicle_number" placeholder="KJA-123-XY" required 
                           class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white font-mono uppercase">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Phone</label>
                    <input type="text" name="phone" placeholder="+234 80..." required 
                           class="w-full bg-gray-50 dark:bg-gray-900 border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm dark:text-white">
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end gap-4">
            <a href="{{ route('admin.drivers.index') }}" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-800">Cancel</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-xl shadow-lg shadow-blue-500/30 transition-all">
                Save Driver
            </button>
        </div>
    </form>
</div>
@endsection