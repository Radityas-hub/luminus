<nav class="sticky top-0 z-30 flex items-center justify-between px-6 py-4 bg-white border-b border-gray-100">
    <!-- Left Side - Title & Time -->
    <div>
        <div class="flex items-center gap-3 mb-1">
            <h1 class="text-xl font-semibold text-gray-800">{{ $title }}</h1>
            <!-- Real-time Clock -->
            <div class="hidden md:flex items-center gap-2 px-3 py-1 bg-emerald-50 rounded-lg">
                <i class="fas fa-clock text-emerald-500 text-sm"></i>
                <span id="current-time" class="text-sm font-medium text-emerald-600"></span>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <p class="text-sm text-gray-500">Welcome back to your learning dashboard</p>
            <span class="hidden md:inline-block px-2 py-1 text-xs font-medium text-emerald-600 bg-emerald-50 rounded-md">
                {{ now()->format('l, d F Y') }}
            </span>
        </div>
    </div>

    <!-- Right Side - Notifications & Profile -->
    <div class="flex items-center gap-4">
        <!-- Notifications -->
        <div class="relative">
            <button class="p-2 text-gray-500 hover:bg-gray-50 rounded-xl transition-colors duration-200 relative">
                <i class="fas fa-bell w-5 h-5"></i>
                <span class="absolute top-0 right-0 w-2 h-2 bg-emerald-500 rounded-full"></span>
            </button>
        </div>

        <!-- Profile Dropdown -->
        <div class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-50 transition-all duration-200 cursor-pointer">
            <img class="w-9 h-9 rounded-lg shadow-sm object-cover" 
                 src="{{ Auth::user()->profile_picture_url 
                     ? asset('storage/' . Auth::user()->profile_picture_url) 
                     : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=059669&color=fff' }}" 
                 alt="{{ Auth::user()->name }}'s avatar">
            <div class="hidden md:block">
                <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
            </div>
            <i class="fas fa-chevron-down text-gray-400 text-xs ml-2"></i>
        </div>
    </div>
</nav>

<!-- Add this script at the bottom of your layout file -->
<script>
function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit',
        second: '2-digit',
        hour12: false 
    });
    document.getElementById('current-time').textContent = timeString;
}

// Update time every second
setInterval(updateTime, 1000);
updateTime(); // Initial call
</script>