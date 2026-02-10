@extends('layouts.app')

@section('content')

<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-2 lg:p-3 items-center lg:justify-top min-h-screen flex-col font-sans">

    <!-- Main Hero Container -->
    <!-- Added duration-500 for smooth loading if you add fade-ins later -->
<!-- Main Hero Container -->
<main class="relative w-full h-[calc(100vh-1rem)] lg:h-[calc(100vh-1.5rem)] min-h-[700px] rounded-[2rem] overflow-hidden shadow-2xl group">
    
    <!-- Background Image (Zoom effect on hover) -->
    <img 
        src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=2070&auto=format&fit=crop" 
        alt="Logistics Truck" 
        class="absolute inset-0 w-full h-full object-cover transition-transform duration-[2s] ease-in-out group-hover:scale-105"
    />
    
    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/20 to-black/70"></div>

    <!-- Navigation Bar -->
    <nav class="absolute top-0 left-0 w-full z-50 flex items-center justify-between px-6 py-5 lg:px-10">
        
        <!-- Logo -->
        <div class="flex items-center gap-3 cursor-pointer">
            <div class="bg-orange-500 w-9 h-9 rounded-lg flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
            </div>
            <span class="text-white font-bold text-xl tracking-wide drop-shadow-md">Gogistic Pro</span>
        </div>

        <!-- Center Menu -->
        <div class="hidden md:flex items-center gap-1 bg-white/90 backdrop-blur-md px-1.5 py-1.5 rounded-full shadow-2xl transition-all hover:bg-white">
            <a href="#" class="bg-orange-500 text-white px-6 py-2 rounded-full text-sm font-semibold shadow-md transition-transform hover:scale-105">Home</a>
            <a href="#" class="text-gray-600 hover:text-black hover:bg-gray-100 px-5 py-2 rounded-full text-sm font-medium transition-all">About Us</a>
            <a href="#" class="text-gray-600 hover:text-black hover:bg-gray-100 px-5 py-2 rounded-full text-sm font-medium transition-all">Services</a>
            <a href="#" class="text-gray-600 hover:text-black hover:bg-gray-100 px-5 py-2 rounded-full text-sm font-medium transition-all">Testimonials</a>
            <a href="#" class="text-gray-600 hover:text-black hover:bg-gray-100 px-5 py-2 rounded-full text-sm font-medium transition-all">Blogs</a>
        </div>

        <!-- Contact Button with Sliding Arrow -->
        <a href="#" class="group/btn flex items-center gap-3 pl-5 pr-1.5 py-1.5 rounded-full border border-white/20 bg-white/5 backdrop-blur-md text-white transition-all duration-300 hover:bg-white/20 hover:border-white/50 hover:shadow-lg">
            <span class="text-sm font-medium">Contact now</span>
            <div class="bg-orange-500 w-9 h-9 rounded-full flex items-center justify-center transition-all duration-300 group-hover/btn:bg-orange-400">
                <!-- ARROW SLIDE ANIMATION HERE: translate-x-0.5 and -translate-y-0.5 -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white -rotate-45 transition-transform duration-300 group-hover/btn:translate-x-0.5 group-hover/btn:-translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </div>
        </a>
    </nav>

    <!-- Hero Content -->
    <div class="relative z-10 flex flex-col justify-center items-center h-full w-full text-center px-4 pt-16">
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-semibold text-white tracking-tight leading-[1.1] mb-6 drop-shadow-xl">
            Fast and Sustainable <br />
            Logistic Solution
        </h1>
        <p class="text-white/90 text-base md:text-lg font-light max-w-xl mx-auto mb-12 leading-relaxed drop-shadow-md">
            Measures how quickly goods are delivered from order placement <br class="hidden md:block"/> to final destination.
        </p>
    </div>

    <!-- Bottom Section -->
    <div class="absolute bottom-0 left-0 w-full z-20 px-6 pb-6 lg:px-12 lg:pb-10 flex flex-col md:flex-row items-end justify-between gap-8">
        
        <!-- Bottom Left: Round Button -->
        <div class="max-w-xs text-white">
            <h3 class="text-xl font-semibold mb-2 drop-shadow-md">Reliable, Fast & Cost Effective</h3>
            <p class="text-white/70 text-sm mb-6 font-light">Solutions for all your Cargo needs.</p>
            
            <!-- BUTTON SLIDE ANIMATION -->
            <button class="w-14 h-14 rounded-full border border-white/30 flex items-center justify-center backdrop-blur-sm transition-all duration-300 hover:bg-white hover:text-black hover:border-white hover:scale-105 group/round">
                <!-- Arrow moves diagonally up-right -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transition-transform duration-300 group-hover/round:translate-x-1 group-hover/round:-translate-y-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </button>
        </div>

        <!-- Bottom Right: Glass Card -->
        <div class="w-full md:w-auto md:min-w-[480px] bg-white/10 backdrop-blur-2xl border border-white/10 rounded-[2rem] p-2.5 flex gap-4 transition-colors duration-300 hover:bg-white/15 shadow-2xl">
            
            <div class="flex-1 p-6 flex flex-col justify-between">
                <p class="text-white text-2xl leading-tight font-medium drop-shadow-sm">
                    We have all kinds <br/> of solutions of <br/> transport
                </p>
                
                <!-- LEARN MORE LINK SLIDE ANIMATION -->
                <a href="#" class="flex items-center gap-3 text-white/80 text-sm mt-4 group/link transition-colors hover:text-orange-400">
                    Learn more 
                    <!-- The span holding the arrow slides right (translate-x-2) -->
                    <span class="bg-white/10 rounded-full p-1 inline-flex items-center justify-center transition-all duration-300 group-hover/link:translate-x-2 group-hover/link:bg-orange-500 group-hover/link:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>
                </a>
            </div>

            <!-- Images (Zoom on hover) -->
            <div class="flex gap-2 h-44">
                <div class="w-20 h-full rounded-2xl overflow-hidden relative group/img">
                    <img src="https://images.unsplash.com/photo-1494412574643-35d32469f425?q=80&w=200&auto=format&fit=crop" class="w-full h-full object-cover opacity-80 transition-transform duration-500 group-hover/img:scale-110" alt="Containers" />
                </div>
                <div class="w-20 h-full rounded-2xl overflow-hidden relative group/img">
                    <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=200&auto=format&fit=crop" class="w-full h-full object-cover opacity-80 transition-transform duration-500 group-hover/img:scale-110" alt="Crane" />
                </div>
                <div class="w-20 h-full rounded-2xl bg-[#FDFDFC] flex items-center justify-center relative overflow-hidden group/last">
                     <div class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center transition-all duration-300 group-hover/last:bg-orange-500 group-hover/last:border-orange-500 group-hover/last:text-white">
                         <!-- Small arrow rotates -->
                         <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-black group-hover/last:text-white -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

</body>

@endsection
