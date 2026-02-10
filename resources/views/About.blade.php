{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('title', 'About Us')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-6 text-center">About Us</h1>

    <p class="text-lg text-gray-700 mb-6 text-center">
        Welcome to our company! This is a placeholder page for the About section.
        Here you can add information about your team, mission, vision, and history.
    </p>

    <div class="grid md:grid-cols-2 gap-8 mt-8">
        <div class="bg-gray-100 p-6 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-2xl font-semibold mb-4">Our Mission</h2>
            <p class="text-gray-600">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec
                purus vitae odio scelerisque elementum. Sed ac lacus at lorem tincidunt
                tempor.
            </p>
        </div>

        <div class="bg-gray-100 p-6 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-2xl font-semibold mb-4">Our Vision</h2>
            <p class="text-gray-600">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur
                luctus mi a ligula vehicula, vel varius eros laoreet. Suspendisse
                potenti.
            </p>
        </div>

        <div class="bg-gray-100 p-6 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-2xl font-semibold mb-4">Our Team</h2>
            <p class="text-gray-600">
                This section can highlight your core team members. Add names, roles,
                and photos to give a personal touch.
            </p>
        </div>

        <div class="bg-gray-100 p-6 rounded-lg shadow hover:shadow-lg transition">
            <h2 class="text-2xl font-semibold mb-4">History</h2>
            <p class="text-gray-600">
                You can describe how your organization started and the milestones you
                have achieved over time. This gives visitors a sense of your journey.
            </p>
        </div>
    </div>

    <div class="mt-12 text-center">
        <a href="{{ url('/') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
            Back to Home
        </a>
    </div>
</div>
@endsection
