@extends('layouts.guest')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-6 py-20">
    <div class="max-w-md w-full bg-white p-10 rounded-[3rem] border border-gray-100 shadow-2xl shadow-gray-200/50">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-gray-900 tracking-tight">Welcome Back</h1>
            <p class="text-sm text-gray-400 mt-2 font-medium">Access your logistics dashboard terminal.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-4">Email Address</label>
                <input type="email" name="email" required class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-green-100">
            </div>

            <div>
                <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-4">Secure Password</label>
                <input type="password" name="password" required class="w-full bg-gray-50 border-none rounded-2xl p-4 text-sm focus:ring-2 focus:ring-green-100">
            </div>

            <div class="flex items-center justify-between px-2">
                <label class="flex items-center gap-2 text-xs text-gray-500">
                    <input type="checkbox" class="rounded border-gray-200 text-[#054a32] focus:ring-0"> Remember me
                </label>
                <a href="#" class="text-xs font-bold text-[#054a32] hover:underline">Forgot?</a>
            </div>

            <button type="submit" class="w-full btn-primary py-4 rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl">
                Login Terminal
            </button>
        </form>

        <p class="text-center mt-8 text-xs text-gray-400">
            New to QTA? <a href="{{ route('register') }}" class="font-bold text-[#054a32] hover:underline">Create Business Account</a>
        </p>
    </div>
</div>
@endsection