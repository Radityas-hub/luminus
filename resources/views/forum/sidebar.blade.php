
<div id="sidebar" class="fixed md:sticky md:top-[4.5rem] w-[280px] md:w-1/4 bg-white md:bg-transparent h-screen md:h-[calc(100vh-4.5rem)] overflow-y-auto transition-transform duration-300 transform -translate-x-full md:translate-x-0 z-50 shadow-lg md:shadow-none">
    <button id="sidebarClose" class="md:hidden absolute top-4 right-4 text-gray-500 hover:text-[#696EFF] transition-colors">
        <i class="fas fa-times text-xl"></i>
    </button>
   <div class="pt-16 md:pt-4 px-4 pb-4 space-y-4">
        <!-- Categories Section -->
        <div>
            <h2 class="text-lg font-semibold mb-3 flex items-center gap-2">
                <i class="fas fa-folder text-[#696EFF] text-lg"></i>
                <span>Kategori</span>
            </h2>
            <ul class="space-y-2">
                @foreach ($categories as $category)
                    <li>
                        <a href="{{ route('forums.filterByCategory', $category->id) }}"
                            class="flex items-center gap-2 text-gray-600 hover:text-[#696EFF] transition-colors duration-200">
                            <i class="fas fa-tag text-sm"></i>
                            <span>{{ $category->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>



