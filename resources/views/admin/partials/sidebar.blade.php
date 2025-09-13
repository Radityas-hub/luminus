<!-- Hamburger Button (Mobile Only) -->
<nav class="bg-white shadow-lg w-full fixed top-0 left-0 right-0 z-50 md:hidden">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo Section -->
            <div class="flex items-center">
                <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">
                    Luminus
                </span>
            </div>

            <!-- Hamburger Button -->
            <button id="sidebarToggle">
                <i class="fas fa-bars text-gray-600 text-xl"></i>
            </button>
        </div>
    </div>
</nav>

<div class="h-16 md:hidden"></div>
<!-- Overlay -->


<aside id="sidebar"
    class="fixed top-0 left-0 z-50 w-64 h-screen bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
    <!-- Logo Section -->
    <div class="flex items-center justify-between h-16 px-6 border-b border-gray-100">
        <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">
            Luminus Admin
        </span>
        <button id="sidebarClose" class="p-2 text-gray-600 rounded-lg hover:bg-gray-100 md:hidden">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div class="flex flex-col h-[calc(100vh-4rem)] justify-between border">
        <!-- Main Navigation -->
        <div class="p-4">
            <!-- Main Menu -->
            <div class="mb-4">
                <h3 class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase">Main Menu</h3>
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
                        <a href="{{ route('admin.dashboard') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                           {{ request()->routeIs('admin.dashboard')
                               ? 'bg-gradient-to-r from-blue-50 to-blue-100/50 text-blue-600 shadow-sm'
                               : 'text-gray-600 hover:bg-gray-50' }}">
                            <i
                                class="fas fa-home w-5 h-5 transition-colors duration-200 
                               {{ request()->routeIs('admin.dashboard') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                            </i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.finance') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
               {{ request()->routeIs('admin.finance')
                   ? 'bg-gradient-to-r from-blue-50 to-blue-100/50 text-blue-600 shadow-sm'
                   : 'text-gray-600 hover:bg-gray-50' }}">
                            <i
                                class="fas fa-chart-line w-5 h-5 transition-colors duration-200
                   {{ request()->routeIs('admin.finance') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                            </i>
                            <span class="ml-3">Finance</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.reports') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
       {{ request()->routeIs('admin.reports')
           ? 'bg-gradient-to-r from-blue-50 to-blue-100/50 text-blue-600 shadow-sm'
           : 'text-gray-600 hover:bg-gray-50' }}">
                            <i
                                class="fas fa-file-alt w-5 h-5 transition-colors duration-200
           {{ request()->routeIs('admin.reports') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                            </i>
                            <span class="ml-3">Reports</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.forumReports') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                           {{ request()->routeIs('admin.forumReports')
                               ? 'bg-gradient-to-r from-blue-50 to-blue-100/50 text-blue-600 shadow-sm'
                               : 'text-gray-600 hover:bg-gray-50' }}">
                            <i
                                class="fas fa-flag w-5 h-5 transition-colors duration-200
                               {{ request()->routeIs('admin.forumReports') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                            </i>
                            <span class="ml-3">Laporan Forum</span>
                        </a>
                    </li>

                </ul>
            </div>

            <!-- Learning Management -->
            <div class="mb-4 ">
                <h3 class="px-4 mb-2 text-xs font-semibold text-gray-400 uppercase">Learning Management</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('admin.courses.create') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                           {{ request()->routeIs('admin.courses.*')
                               ? 'bg-gradient-to-r from-blue-50 to-blue-100/50 text-blue-600 shadow-sm'
                               : 'text-gray-600 hover:bg-gray-50' }}">
                            <i
                                class="fas fa-graduation-cap w-5 h-5 transition-colors duration-200
                               {{ request()->routeIs('admin.courses.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                            </i>
                            <span class="ml-3">Courses</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.instructors') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                           {{ request()->routeIs('admin.instructors')
                               ? 'bg-gradient-to-r from-blue-50 to-blue-100/50 text-blue-600 shadow-sm'
                               : 'text-gray-600 hover:bg-gray-50' }}">
                            <i
                                class="fas fa-chalkboard-teacher w-5 h-5 transition-colors duration-200
                               {{ request()->routeIs('admin.instructors') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                            </i>
                            <span class="ml-3">Instructors</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.students.index') }}"
                            class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
        {{ request()->routeIs('admin.students.*')
            ? 'bg-gradient-to-r from-blue-50 to-blue-100/50 text-blue-600 shadow-sm'
            : 'text-gray-600 hover:bg-gray-50' }}">
                            <i
                                class="fas fa-user-graduate w-5 h-5 transition-colors duration-200
            {{ request()->routeIs('admin.students.*') ? 'text-blue-600' : 'text-gray-400 group-hover:text-gray-600' }}">
                            </i>
                            <span class="ml-3">Manajemen Siswa</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="border-t  border-gray-100 p-4">
            <div class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-gray-50 transition-all duration-200">
                <img src="https://ui-avatars.com/api/?name=Admin&background=3b82f6&color=fff"
                    class="w-8 h-8 rounded-lg shadow-sm" alt="Admin">
                <div class="flex-1">
                    <h4 class="text-sm font-medium text-gray-700">Admin User</h4>
                    <p class="text-xs text-gray-500">admin@luminus.com</p>
                </div>
                <button class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </div>
        </div>

    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarClose = document.getElementById('sidebarClose');
        const overlay = document.getElementById('sidebarOverlay');
        const hamburgerIcon = sidebarToggle.querySelector('i');

        let isSidebarOpen = window.innerWidth >= 768;

        function isDesktop() {
            return window.innerWidth >= 768;
        }

        function toggleSidebar() {
            isSidebarOpen = !isSidebarOpen;

            if (isSidebarOpen) {
                sidebar.classList.remove('-translate-x-full');
                if (!isDesktop()) {
                    overlay.classList.remove('hidden');
                    hamburgerIcon.classList.remove('fa-bars');
                    hamburgerIcon.classList.add('fa-times');
                }
            } else {
                sidebar.classList.add('-translate-x-full');
                if (!isDesktop()) {
                    overlay.classList.add('hidden');
                    hamburgerIcon.classList.remove('fa-times');
                    hamburgerIcon.classList.add('fa-bars');
                }
            }
        }

        // Initialize sidebar state
        if (isDesktop()) {
            sidebar.classList.remove('-translate-x-full');
        }

        // Event listeners
        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarClose.addEventListener('click', () => {
            if (!isDesktop()) toggleSidebar();
        });
        overlay.addEventListener('click', () => {
            if (!isDesktop()) toggleSidebar();
        });

        // Handle window resize
        window.addEventListener('resize', () => {
            if (isDesktop()) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                isSidebarOpen = true;
            } else if (!isSidebarOpen) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Handle escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && isSidebarOpen && !isDesktop()) {
                toggleSidebar();
            }
        });
    });
</script>
