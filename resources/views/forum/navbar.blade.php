<!-- filepath: /d:/Lomba2024bact2/luminus/resources/views/forum/navbar.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav class="sticky top-0 z-[60] bg-white shadow-sm">
        <div class="max-w-screen-lg mx-auto px-4 py-3">
            <!-- Desktop & Mobile Navigation -->
            <div class="flex items-center justify-between">
                <!-- Mobile Menu Toggle -->
                <button id="sidebarToggle" class="md:hidden text-gray-600 hover:text-[#696EFF]">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Create Thread Button -->
                <button id="createThreadButton"
                    class="px-4 md:px-6 py-2 md:py-2.5 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white font-medium rounded-xl hover:shadow-lg hover:shadow-[#696EFF]/25 transition-all duration-300 flex items-center gap-2">
                    <i class="fas fa-plus text-sm"></i>
                    <span class="hidden md:inline">Buat Diskusi Baru</span>
                </button>

                <div class="hidden md:flex items-center gap-4">
                    <!-- Search Input -->
                    <div class="relative">
                        <input type="text" id="navbar-search-input" placeholder="Cari diskusi..."
                            class="w-80 px-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-[#696EFF] focus:ring-1 focus:ring-[#696EFF] transition-all duration-200">
                        <i class="fas fa-search absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <!-- Suggestions will be inserted here by JS -->
                    </div>

                    <a href="{{ route('forums.index') }}"
                        class="px-5 py-2.5 bg-gray-50 text-gray-600 hover:bg-gray-100 font-medium rounded-xl transition-all duration-200">
                        Semua Kategori
                    </a>
                </div>
            </div>

            <!-- Mobile Search (shows below navbar) -->
            <div class="md:hidden mt-3">
                <div class="relative">
                    <input type="text" id="mobile-search-input" placeholder="Cari diskusi..."
                        class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-[#696EFF] focus:ring-1 focus:ring-[#696EFF] transition-all duration-200">
                    <i class="fas fa-search absolute right-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <!-- Suggestions will be inserted here by JS -->
                </div>
            </div>
        </div>
    </nav>

    <script>
        document.getElementById('navbar-search-input').addEventListener('input', function(event) {
            const query = event.target.value.toLowerCase();
            const threads = document.querySelectorAll('.thread-item');

            threads.forEach(function(thread) {
                const title = thread.querySelector('.thread-link').textContent.toLowerCase();
                if (title.includes(query)) {
                    thread.style.display = 'block';
                } else {
                    thread.style.display = 'none';
                }
            });
        });

        document.getElementById('mobile-search-input').addEventListener('input', function(event) {
            const query = event.target.value.toLowerCase();
            const threads = document.querySelectorAll('.thread-item');

            threads.forEach(function(thread) {
                const title = thread.querySelector('.thread-link').textContent.toLowerCase();
                if (title.includes(query)) {
                    thread.style.display = 'block';
                } else {
                    thread.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
