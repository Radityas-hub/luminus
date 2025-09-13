<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Instructors | Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <!-- Header -->
        <nav class="flex md:mx-8 justify-between items-center mb-4 bg-white p-4 rounded-lg ">
            <div>
                <h1 class="md:text-2xl text-lg font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">Manage Instructors</h1>
                <p class="md:text-sm text-xs w-[60%] md:w-auto text-gray-500">Manage and organize your course instructors</p>
            </div>
            <div class="flex items-center md:gap-3">
                <button class="p-2 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-bell text-gray-500"></i>
                </button>
                <div class="flex items-center gap-2">
                    <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?name=Admin" alt="user photo">
                    <span class="text-sm text-gray-600">Admin</span>
                </div>
            </div>
        </nav>

    

        <main class="flex-1 max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-700">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Add Instructor Form -->
            <div id="createInstructorForm" class="mb-8 bg-white rounded-xl p-8">
                <div class="border-b pb-4 mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">Add New Instructor</h3>
                    <p class="mt-1 text-sm text-gray-500">Fill in the information below to create a new instructor
                        account</p>
                </div>

                <form action="{{ route('admin.instructors.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400"></i>
                                </div>
                                <input type="text" name="name"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="John Doe" required>
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Email Address</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-gray-400"></i>
                                </div>
                                <input type="email" name="email"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="instructor@example.com" required>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" name="password"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="••••••••" required>
                            </div>
                            <p class="text-xs text-gray-500">Password must be at least 8 characters long</p>
                        </div>

                        <!-- Password Confirmation Field -->
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-gray-400"></i>
                                </div>
                                <input type="password" name="password_confirmation"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="••••••••" required>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end pt-4 border-t">
                        <button type="button"
                            class="mr-3 px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-500">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition duration-200">
                            Create Instructor
                        </button>
                    </div>
                </form>
            </div>

            <div class="p-4 rounded-lg bg-white block md:hidden mb-8">
                <div class="items-center flex">
                    <div
                        class="inline-flex flex-shrink-0 items-center justify-center h-10 w-10 text-blue-600 bg-blue-100 rounded-lg">
                        <i class="fas fa-chalkboard-teacher text-lg"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-base font-normal text-gray-500">Total Instructors</h3>
                        <span class="text-lg font-bold text-gray-900">{{ $instructors->count() }}</span>
                    </div>
                </div>
            </div>

            <!-- Instructors Table -->
            <div class="bg-white rounded-xl overflow-hidden">
                <!-- Table Header with Search -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                        <div class="p-4 rounded-lg border-[#ddd] border hidden md:block">
                            <div class="items-center flex">
                                <div
                                    class="inline-flex flex-shrink-0 items-center justify-center h-10 w-10 text-blue-600 bg-blue-100 rounded-lg">
                                    <i class="fas fa-chalkboard-teacher text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-base font-normal text-gray-500">Total Instructors</h3>
                                    <span class="text-lg font-bold text-gray-900">{{ $instructors->count() }}</span>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Instructors List</h3>
                        <div class="relative">
                            <input type="text" id="searchInput" placeholder="Search instructors..."
                                class="w-full md:w-64 pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                onkeyup="searchInstructors()">
                            <div class="absolute left-3 top-2.5">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Instructor
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Courses
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="instructorsTableBody" class="bg-white divide-y divide-gray-200">
                            @foreach ($instructors as $instructor)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-full"
                                                    src="https://ui-avatars.com/api/?name={{ urlencode($instructor->name) }}"
                                                    alt="{{ $instructor->name }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $instructor->name }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $instructor->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $instructor->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($instructor->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $instructor->courses_count ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end gap-2">
                                            <form
                                                action="{{ route('admin.instructors.toggleStatus', $instructor->id) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="p-2 text-blue-600 hover:text-blue-900 rounded-lg hover:bg-blue-50">
                                                    <i class="fas fa-toggle-on"></i> Toggle Status
                                                </button>
                                            </form>
                                            <button onclick="showDeleteModal('/instructors/{{ $instructor->id }}')"
                                                class="p-2 text-red-600 hover:text-red-900 rounded-lg hover:bg-red-50">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="noResultsMessage" class="hidden p-6 text-center text-gray-500">
                        Instructor bernama <span id="searchQuery"></span> tidak ada.
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900 mt-5">Delete Instructor</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        Are you sure you want to delete this instructor? This action cannot be undone.
                    </p>
                </div>
                <div class="flex justify-center gap-4 mt-5">
                    <button id="cancelDelete" type="button"
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-md">
                        Cancel
                    </button>
                    <form id="deleteForm" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(deleteUrl) {
            const modal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            const cancelBtn = document.getElementById('cancelDelete');

            deleteForm.action = deleteUrl;
            modal.classList.remove('hidden');

            cancelBtn.onclick = function() {
                modal.classList.add('hidden');
            }
            modal.onclick = function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            }
        }

        function toggleStatus(toggleUrl) {
            fetch(toggleUrl, {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to toggle status');
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function searchInstructors() {
            var input, filter, table, tr, td, i, txtValue, found;
            input = document.getElementById('searchInput');
            filter = input.value.toLowerCase();
            table = document.querySelector('table');
            tr = table.getElementsByTagName('tr');
            found = false;

            for (i = 1; i < tr.length; i++) {
                td = tr[i].getElementsByTagName('td')[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        found = true;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }

            const noResultsMessage = document.getElementById('noResultsMessage');
            const searchQuery = document.getElementById('searchQuery');
            if (!found) {
                searchQuery.textContent = input.value;
                noResultsMessage.classList.remove('hidden');
            } else {
                noResultsMessage.classList.add('hidden');
            }
        }
    </script>
</body>

</html>
