<nav class="absolute top-0 left-0 w-full z-50 px-6 py-5 lg:px-10">
    
    <div class="flex items-center justify-between">

        <!-- Logo -->
        <div class="flex items-center gap-3 cursor-pointer">
            <div class="bg-orange-500 w-9 h-9 rounded-lg flex items-center justify-center text-white shadow-lg shadow-orange-500/20">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                </svg>
            </div>
            <span class="text-white font-bold text-xl tracking-wide drop-shadow-md">
                Gogistic Pro
            </span>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden md:flex items-center gap-1 bg-white/90 backdrop-blur-md px-1.5 py-1.5 rounded-full shadow-2xl">
            <a href="#" class="bg-orange-500 text-white px-6 py-2 rounded-full text-sm font-semibold">Home</a>
            <a href="#" class="text-gray-600 hover:bg-gray-100 px-5 py-2 rounded-full text-sm font-medium">About Us</a>
            <a href="#" class="text-gray-600 hover:bg-gray-100 px-5 py-2 rounded-full text-sm font-medium">Services</a>
            <a href="#" class="text-gray-600 hover:bg-gray-100 px-5 py-2 rounded-full text-sm font-medium">Testimonials</a>
            <a href="#" class="text-gray-600 hover:bg-gray-100 px-5 py-2 rounded-full text-sm font-medium">Blogs</a>
        </div>

        <!-- Contact Button -->
        <a href="#" class="hidden md:flex items-center gap-3 pl-5 pr-1.5 py-1.5 rounded-full border border-white/20 bg-white/5 backdrop-blur-md text-white transition-all">
            <span class="text-sm font-medium">Contact now</span>
            <div class="bg-orange-500 w-9 h-9 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </div>
        </a>

        <!-- Mobile Toggle -->
        <button id="menuToggle" class="md:hidden text-white">
            ☰
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden mt-4 bg-white rounded-2xl p-6 shadow-xl">
        <div class="flex flex-col gap-4 text-gray-700">
            <a href="#">Home</a>
            <a href="#">About Us</a>
            <a href="#">Services</a>
            <a href="#">Testimonials</a>
            <a href="#">Blogs</a>
        </div>
    </div>

</nav>

<script>
document.getElementById('menuToggle').addEventListener('click', function () {
    document.getElementById('mobileMenu').classList.toggle('hidden');
});
</script>
