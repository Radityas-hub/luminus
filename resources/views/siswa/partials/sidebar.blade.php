<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

<aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen bg-[#032038] shadow-sm  hidden lg:block md:block">
    <!-- Logo Section -->
    <div class="flex items-center h-16 px-6">
        <span class="text-xl font-bold text-white">Lu</span>
        <span
            class="text-xl font-bold bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] bg-clip-text text-transparent">minus</span>
    </div>

    <div class="flex flex-col h-[calc(100vh-4rem)] justify-between">
        <!-- Main Navigation -->
        <div class="p-4">
            <!-- Learning Section -->
            <div class="mb-4">
                <h3 class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase">Learning</h3>
                <ul class="space-y-1">
                  <li>
                        <a href="{{ route('home') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                            {{ request()->routeIs('home') ? 'bg-gradient-to-r from-blue-50 to-blue-100/50 text-blue-600 shadow-sm' : 'text-gray-600 hover:bg-gray-50' }}">
                            <i class="fas fa-home w-5 h-5 transition-colors duration-200 
                                {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                            </i>
                            <span class="ml-3">Beranda</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{ route('siswa.dashboard') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                            {{ request()->routeIs('siswa.dashboard')
                                ? 'bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white shadow-sm'
                                : 'text-gray-600 hover:bg-gradient-to-r hover:from-[#696EFF] hover:to-[#F8ACFF] hover:text-white' }}">
                            <i
                                class="fas fa-home w-5 h-5 transition-colors duration-200 
                                {{ request()->routeIs('siswa.dashboard') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">
                            </i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.courses') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                            {{ request()->routeIs('siswa.courses')
                                ? 'bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white shadow-sm'
                                : 'text-gray-600 hover:bg-gradient-to-r hover:from-[#696EFF] hover:to-[#F8ACFF] hover:text-white' }}">
                            <i
                                class="fas fa-book w-5 h-5 transition-colors duration-200
                                {{ request()->routeIs('siswa.courses') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">
                            </i>
                            <span class="ml-3">My Courses</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.progress') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                            {{ request()->routeIs('siswa.progress')
                                ? 'bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white shadow-sm'
                                : 'text-gray-600 hover:bg-gradient-to-r hover:from-[#696EFF] hover:to-[#F8ACFF] hover:text-white' }}">
                            <i
                                class="fas fa-chart-line w-5 h-5 transition-colors duration-200
                                {{ request()->routeIs('siswa.progress') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">
                            </i>
                            <span class="ml-3">Progress</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.certificates.index') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                            {{ request()->routeIs('siswa.certificates.index')
                                ? 'bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white shadow-sm'
                                : 'text-gray-600 hover:bg-gradient-to-r hover:from-[#696EFF] hover:to-[#F8ACFF] hover:text-white' }}">
                            <i
                                class="fas fa-certificate w-5 h-5 transition-colors duration-200
                                {{ request()->routeIs('siswa.certificates.index') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">
                            </i>
                            <span class="ml-3">Sertifikat Saya</span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Account Section -->
            <div class="mb-4">
                <h3 class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase">Account</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('siswa.transactions') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                            {{ request()->routeIs('siswa.transactions')
                                ? 'bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white shadow-sm'
                                : 'text-gray-600 hover:bg-gradient-to-r hover:from-[#696EFF] hover:to-[#F8ACFF] hover:text-white' }}">
                            <i
                                class="fas fa-wallet w-5 h-5 transition-colors duration-200
                                {{ request()->routeIs('siswa.transactions') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">
                            </i>
                            <span class="ml-3">Transactions</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.editProfile') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                            {{ request()->routeIs('siswa.editProfile')
                                ? 'bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white shadow-sm'
                                : 'text-gray-600 hover:bg-gradient-to-r hover:from-[#696EFF] hover:to-[#F8ACFF] hover:text-white' }}">
                            <i
                                class="fas fa-user w-5 h-5 transition-colors duration-200
                                {{ request()->routeIs('siswa.editProfile') ? 'text-white' : 'text-gray-400 group-hover:text-white' }}">
                            </i>
                            <span class="ml-3">Edit Profile</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="p-4">
            <div class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 transition-all duration-200">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=059669&color=fff"
                    class="w-8 h-8 rounded-lg shadow-sm" alt="Student Avatar">
                <div class="flex-1">
                    <h4 class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</h4>
                    <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                </div>
                <a href="{{ route('logout') }}"
                    class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </div>
</aside>

<div class="md:hidden h-16 w-full"></div>
<!-- Hamburger Menu Button -->
<div class="lg:hidden fixed md:hidden flex top-0 justify-between items-center z-20 bg-white p-2 w-full shadow-sm  px-6">
    <h1 class="font-semibold text-1xl text-black" id="logo">Lu<span id="logoSpan"
            class="bg-gradient-to-r from-[#696EFF] to-[#f8acff] text-transparent bg-clip-text">minus</span>
    </h1>
    <button id="hamburgerButton" class="text-black bg-white focus:outline-none">
        <i id="iconButtonHamburger" class="fas fa-bars w-6 h-6"></i>
    </button>
</div>

<script>
    const sidebar = document.getElementById('sidebar');
    const hamburgerButton = document.getElementById('hamburgerButton');
    const iconButtonHamburger = document.getElementById('iconButtonHamburger');
    hamburgerButton.addEventListener('click', () => {
        iconButtonHamburger.classList.toggle('fa-times');
        iconButtonHamburger.classList.toggle('fa-bars');
        sidebar.classList.toggle('hidden');
    });
</script>