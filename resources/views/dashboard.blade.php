<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

</head>

@extends('layouts.admin')

@section('title','Dashboard')
@section('content')

{{-- Main content --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

 
<h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded shadow">Total Parcels</div>
        <div class="bg-white p-4 rounded shadow">In Transit</div>
        <div class="bg-white p-4 rounded shadow">Delivered</div>
        <div class="bg-white p-4 rounded shadow">Pending</div>
    </div>
   

{{-- Main content --}}
    <main class="flex-1 p-6">
        @yield('content')
    </main>

@endsection
</html>