var createThreadModal = document.getElementById('createThreadModal');
var createThreadButton = document.getElementById('createThreadButton');
var closeCreateThreadButton = document.getElementById('closeModalButton');
var cancelCreateThreadButton = document.getElementById('cancelButton');

createThreadButton.onclick = function() {
    createThreadModal.classList.remove('hidden');
}

closeCreateThreadButton.onclick = cancelCreateThreadButton.onclick = function() {
    createThreadModal.classList.add('hidden');
}

window.onclick = function(event) {
    if (event.target == createThreadModal) {
        createThreadModal.classList.add('hidden');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('sidebarOverlay');

    sidebarToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
        document.body.classList.toggle('overflow-hidden');
    });

    overlay.addEventListener('click', function() {
        sidebar.classList.remove('active');
        overlay.classList.remove('active');
        document.body.classList.remove('overflow-hidden');
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && sidebar.classList.contains('active')) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.classList.remove('overflow-hidden');
        }
    });



    async function fetchSearchSuggestions(query) {
        try {
            const response = await fetch(`/api/threads/search?query=${encodeURIComponent(query)}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

            if (!response.ok) throw new Error('Network response was not ok');

            const data = await response.json();
            return data;
        } catch (error) {
            console.error('Error fetching suggestions:', error);
            return { data: [], count: 0 };
        }
    }

    function createSearchSuggestions(inputId) {
        const searchInput = document.getElementById(inputId);
        const suggestionsBox = document.createElement('div');

        suggestionsBox.className = 'absolute left-0 right-0 mt-1 bg-white rounded-xl shadow-lg z-50 max-h-96 overflow-y-auto';
        searchInput.parentElement.appendChild(suggestionsBox);

        searchInput.addEventListener('input', debounce(async (e) => {
            const query = e.target.value.trim();

            if (query.length < 2) {
                suggestionsBox.innerHTML = '';
                suggestionsBox.classList.add('hidden');
                return;
            }

            const result = await fetchSearchSuggestions(query);

            if (result.data.length > 0) {
                suggestionsBox.innerHTML = result.data.map(thread => `
                    <div class="p-3 hover:bg-gray-50 cursor-pointer border-b" 
                         onclick="window.location.href='/threads/${thread.id}'">
                        <div class="font-medium text-gray-800">${thread.title}</div>
                        <div class="text-sm text-gray-500">${thread.preview}</div>
                        <div class="text-xs text-gray-400 mt-1">oleh ${thread.author}</div>
                    </div>
                `).join('');
            } else {
                suggestionsBox.innerHTML = `
                    <div class="p-4 text-center">
                        <p class="text-gray-500 mb-2">Tidak ada topic yang ditemukan</p>
                        <button onclick="openCreateThreadModal('${query}')" 
                                class="px-4 py-2 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white rounded-xl text-sm">
                            Buat Topic Baru
                        </button>
                    </div>
                `;
            }

            suggestionsBox.classList.remove('hidden');
        }, 300));

        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                suggestionsBox.classList.add('hidden');
            }
        });
    }

    // Debounce function
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Initialize search suggestions for both inputs
    createSearchSuggestions('navbar-search-input');
    createSearchSuggestions('mobile-search-input');

    // Function to open create thread modal with pre-filled title
    window.openCreateThreadModal = function(query) {
        const modal = document.getElementById('createThreadModal');
        const titleInput = modal.querySelector('input[name="title"]');
        titleInput.value = query;
        modal.classList.remove('hidden');
    }
});

document.getElementById('sidebarClose')?.addEventListener('click', () => {
    document.getElementById('sidebar').classList.remove('active');
    document.getElementById('sidebarOverlay').classList.remove('active');
});

document.querySelectorAll('.comments-toggle').forEach(function(toggle) {
    toggle.onclick = function(event) {
        event.preventDefault();
        var threadId = this.dataset.threadId;
        var commentsSection = document.getElementById('comments-' + threadId);
        var commentsList = document.getElementById('commentsList-' + threadId);

        if (commentsSection.classList.contains('hidden')) {
            fetch(`/threads/${threadId}`)
                .then(response => response.json())
                .then(data => {
                    commentsList.innerHTML = '';
                    data.comments.forEach(function(comment) {
                        var commentDiv = document.createElement('div');
                        commentDiv.classList.add('mb-4');
                        commentDiv.innerHTML = `
                            <div class="flex items-center space-x-2 mb-2">
                                <img src="${comment.user.avatar_url ?? 'https://via.placeholder.com/40'}" alt="User Avatar" class="w-8 h-8 rounded-full" />
                                <p class="text-gray-600">${comment.user.name}</p>
                                <p class="text-gray-400 text-sm">${comment.created_at}</p>
                            </div>
                            <p class="text-gray-600">${comment.body}</p>
                        `;
                        commentsList.appendChild(commentDiv);
                    });
                    commentsSection.classList.remove('hidden');
                });
        } else {
            commentsSection.classList.add('hidden');
        }
    }
});


function confirmLogout() {
    Swal.fire({
        title: 'Apakah Anda yakin ingin logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        customClass: {
            popup: 'swal2-popup-custom',
            title: 'swal2-title-custom',
            confirmButton: 'swal2-confirm-button-custom',
            cancelButton: 'swal2-cancel-button-custom'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener("scroll", function() {
        // scroll-up button show/hide script
        const scrollUpBtn = document.querySelector(".scroll-up-btn");
        if (window.scrollY > 100) {
            scrollUpBtn.classList.add("show");
        } else {
            scrollUpBtn.classList.remove("show");
        }
    });
});


function confirmLogout() {
    Swal.fire({
        title: 'Apakah Anda yakin ingin logout?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
}
document.addEventListener("DOMContentLoaded", function() {
    window.addEventListener("scroll", function() {
        // scroll-up button show/hide script
        const scrollUpBtn = document.querySelector(".scroll-up-btn");
        if (window.scrollY > 100) {
            scrollUpBtn.classList.add("show");
        } else {
            scrollUpBtn.classList.remove("show");
        }
    });
});





