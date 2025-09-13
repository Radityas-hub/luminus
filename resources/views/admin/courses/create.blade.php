<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Course | Luminus Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-[#f1f2f6]">
    <!-- Sidebar -->
    @include('admin.partials.sidebar')

    <!-- Main Content -->
    <div class="p-4 sm:ml-64">
        <nav class="flex justify-between mx-10 items-center bg-white p-5 rounded-xl  backdrop-blur-sm border border-gray-100">
            <div>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Courses Management
                </h1>
            </div>
        </nav>

        <!-- Main Content Area -->
        <div class="px-4 py-6 md:px-6 2xl:px-11">
            <!-- Main Container -->
            <div class="container mx-auto p-8 bg-white rounded-2xl">
                <!-- Header -->
                <div class="mb-8 border-b border-gray-100 pb-6">
                    <h2 class="text-3xl font-bold text-gray-800">Create New Course</h2>
                    <p class="text-gray-500 mt-2 text-sm">Complete the form below to create a new course</p>
                </div>

                <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <!-- Basic Information -->
                    <div class="bg-gray-50 p-6 rounded-xl space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Basic Information</h3>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Course
                                    Title</label>
                                <input type="text" name="title" id="title"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="Enter course title" required>
                            </div>

                            <div>
                                <label for="instructor_id"
                                    class="block text-sm font-medium text-gray-700 mb-1">Instructor</label>
                                <select name="instructor_id" id="instructor_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    required>
                                    <option value="" disabled selected>Select instructor</option>
                                    @foreach ($instructors as $instructor)
                                        <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                placeholder="Enter course description" required></textarea>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="bg-gray-50 p-6 rounded-xl space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pricing</h3>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label for="original_price"
                                    class="block text-sm font-medium text-gray-700 mb-1">Original Price</label>
                                <div class="relative">
                                    <span
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                                    <input type="number" name="original_price" id="original_price"
                                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                        placeholder="0" required>
                                </div>
                            </div>

                            <div>
                                <label for="discounted_price"
                                    class="block text-sm font-medium text-gray-700 mb-1">Discounted Price
                                    (Optional)</label>
                                <div class="relative">
                                    <span
                                        class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                                    <input type="number" name="discounted_price" id="discounted_price"
                                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                        placeholder="0">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Details -->
                    <div class="bg-gray-50 p-6 rounded-xl space-y-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Course Details</h3>

                        <div class="grid gap-6 md:grid-cols-2">
                            <div>
                                <label for="duration" class="block text-sm font-medium text-gray-700 mb-1">Duration
                                    (hours)</label>
                                <input type="number" name="duration" id="duration"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="0" required>
                            </div>

                            <div>
                                <label for="video_count" class="block text-sm font-medium text-gray-700 mb-1">Number of
                                    Videos</label>
                                <input type="number" name="video_count" id="video_count"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                    placeholder="0" required>
                            </div>
                        </div>

                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Course
                                Thumbnail</label>
                            <input type="file" name="image" id="image" accept="image/*"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200">
                        </div>
                    </div>

                    <!-- Video Parts -->
                    <div class="bg-gray-50 p-6 rounded-xl space-y-4">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Video Parts</h3>
                            <button type="button" id="add-video-part"
                                class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition duration-200">
                                <i class="fas fa-plus mr-2"></i>
                                Add Video
                            </button>
                        </div>

                        <div id="video-parts-container" class="space-y-4">
                            <div class="video-part p-4 border border-gray-200 rounded-lg bg-white">
                                <div class="grid gap-4 md:grid-cols-2">
                                    <input type="text" name="video_parts[0][title]"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                        placeholder="Video Title" required>
                                    <input type="url" name="video_parts[0][video_url]"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                                        placeholder="Video URL" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end pt-6">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                            <i class="fas fa-save mr-2"></i>
                            Create Course
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tabel Kursus -->
            <div class="container mx-auto p-4 mt-8 bg-white rounded-2xl">
                <div class="mb-8 ml-6 mt-3">
                    <h2
                        class="text-3xl font-bold text-gray-800">
                        Daftar Kursus</h2>
                </div>

                @if (session('success'))
                    <div id="successMessage" class="max-w-4xl mx-auto mb-6 transform transition-all duration-300">
                        <div
                            class="bg-green-50 border-l-4 border-green-400 p-4 rounded-lg flex items-center justify-between">
                            <div class="flex items-center">
                                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" />
                                </svg>
                                <p class="ml-3 text-green-700 font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="bg-white  overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        ID</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Judul</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Deskripsi</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Harga Asli</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Harga Diskon</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Gambar</th>
                                    <th class="px-6 py-4 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($courses as $course)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $course->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900 capitalize">
                                            {{ $course->title }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ \Illuminate\Support\Str::limit($course->description, 50) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp
                                            {{ number_format($course->original_price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-medium">Rp
                                            {{ number_format($course->discounted_price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($course->image_url)
                                                <img src="{{ asset('storage/' . $course->image_url) }}"
                                                    alt="{{ $course->title }}"
                                                    class="h-16 w-16 rounded-lg object-cover shadow-sm hover:shadow-md transition-shadow duration-200">
                                            @else
                                                <span
                                                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Tidak
                                                    ada gambar</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <button onclick="openEditModal({{ $course->id }})"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg text-blue-600 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit
                                            </button>
                                            <form action="{{ route('admin.courses.delete', $course->id) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-lg text-red-600 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                                                    onclick="return confirmDelete(event)">
                                                    <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit Kursus -->
                                    <div id="editModal{{ $course->id }}"
                                        class="modal hidden fixed z-10 inset-0 overflow-y-auto">
                                        <div class="flex items-center justify-center min-h-screen">
                                            <div class="bg-white p-6 rounded shadow-lg">
                                                <h3 class="text-xl font-bold mb-4">Edit Kursus</h3>
                                                <form id="editForm{{ $course->id }}"
                                                    action="{{ route('admin.courses.update', $course->id) }}"
                                                    method="POST" enctype="multipart/form-data"
                                                    onsubmit="return confirmEdit(event, {{ $course->id }})">
                                                    @csrf
                                                    @method('PUT')
                                                    <!-- Form fields -->
                                                    <div class="mb-4">
                                                        <label for="title{{ $course->id }}"
                                                            class="block text-sm font-medium text-gray-700">Judul</label>
                                                        <input type="text" name="title"
                                                            id="title{{ $course->id }}"
                                                            value="{{ $course->title }}"
                                                            placeholder="Masukkan judul kursus"
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                                            required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="description{{ $course->id }}"
                                                            class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                                        <textarea name="description" id="description{{ $course->id }}" placeholder="Masukkan deskripsi kursus"
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>{{ $course->description }}</textarea>
                                                    </div>
                                                    <!-- Input Instructor -->
                                                    <div class="mb-4">
                                                        <label for="instructor_id{{ $course->id }}"
                                                            class="block text-sm font-medium text-gray-700">Instructor</label>
                                                        <select name="instructor_id"
                                                            id="instructor_id{{ $course->id }}"
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                                            required>
                                                            @foreach ($instructors as $instructor)
                                                                <option value="{{ $instructor->id }}"
                                                                    {{ $course->instructor_id == $instructor->id ? 'selected' : '' }}>
                                                                    {{ $instructor->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="original_price{{ $course->id }}"
                                                            class="block text-sm font-medium text-gray-700">Harga
                                                            Asli</label>
                                                        <input type="number" name="original_price"
                                                            id="original_price{{ $course->id }}"
                                                            value="{{ $course->original_price }}"
                                                            placeholder="Masukkan harga asli kursus"
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                                            required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="discounted_price{{ $course->id }}"
                                                            class="block text-sm font-medium text-gray-700">Harga
                                                            Diskon</label>
                                                        <input type="number" name="discounted_price"
                                                            id="discounted_price{{ $course->id }}"
                                                            value="{{ $course->discounted_price }}"
                                                            placeholder="Masukkan harga diskon kursus (opsional)"
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="duration{{ $course->id }}"
                                                            class="block text-sm font-medium text-gray-700">Durasi
                                                            (jam)</label>
                                                        <input type="number" name="duration"
                                                            id="duration{{ $course->id }}"
                                                            value="{{ $course->duration }}"
                                                            placeholder="Masukkan durasi kursus dalam jam"
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                                            required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="video_count{{ $course->id }}"
                                                            class="block text-sm font-medium text-gray-700">Jumlah
                                                            Video</label>
                                                        <input type="number" name="video_count"
                                                            id="video_count{{ $course->id }}"
                                                            value="{{ $course->video_count }}"
                                                            placeholder="Masukkan jumlah video kursus"
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                                            required>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="image{{ $course->id }}"
                                                            class="block text-sm font-medium text-gray-700">Gambar
                                                            Kursus</label>
                                                        <input type="file" name="image"
                                                            id="image{{ $course->id }}" accept="image/*"
                                                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                                    </div>
                                                    <div class="flex justify-end">
                                                        <button type="button"
                                                            onclick="closeEditModal({{ $course->id }})"
                                                            class="mr-2 px-4 py-2 bg-gray-500 text-white rounded shadow-sm hover:bg-gray-600">Batal</button>
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-blue-500 text-white rounded shadow-sm hover:bg-blue-600">Simpan
                                                            Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Konfirmasi Penghapusan -->
                <div id="deleteModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="bg-white p-6 rounded shadow-lg">
                            <h3 class="text-xl font-bold mb-4">Konfirmasi Penghapusan</h3>
                            <p>Apakah Anda yakin ingin menghapus kursus ini?</p>
                            <div class="flex justify-end mt-4">
                                <button type="button" onclick="closeDeleteModal()"
                                    class="mr-2 px-4 py-2 bg-gray-500 text-white rounded shadow-sm hover:bg-gray-600">Batal</button>
                                <button id="confirmDeleteButton" type="button"
                                    class="px-4 py-2 bg-red-500 text-white rounded shadow-sm hover:bg-red-600">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Konfirmasi Penyimpanan -->
                <div id="editConfirmModal" class="modal hidden fixed z-10 inset-0 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="bg-white p-6 rounded shadow-lg">
                            <h3 class="text-xl font-bold mb-4">Konfirmasi Penyimpanan</h3>
                            <p>Apakah Anda yakin ingin menyimpan perubahan ini?</p>
                            <div class="flex justify-end mt-4">
                                <button type="button" onclick="closeEditConfirmModal()"
                                    class="mr-2 px-4 py-2 bg-gray-500 text-white rounded shadow-sm hover:bg-gray-600">Batal</button>
                                <button id="confirmEditButton" type="button"
                                    class="px-4 py-2 bg-blue-500 text-white rounded shadow-sm hover:bg-blue-600">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Script untuk modal -->
                <script>
                    function openEditModal(id) {
                        document.getElementById('editModal' + id).classList.remove('hidden');
                    }

                    function closeEditModal(id) {
                        document.getElementById('editModal' + id).classList.add('hidden');
                    }

                    function confirmDelete(event) {
                        event.preventDefault();
                        const form = event.target;
                        document.getElementById('deleteModal').classList.remove('hidden');
                        document.getElementById('confirmDeleteButton').onclick = function() {
                            form.submit();
                        };
                    }

                    function closeDeleteModal() {
                        document.getElementById('deleteModal').classList.add('hidden');
                    }

                    function confirmEdit(event, id) {
                        event.preventDefault();
                        const form = document.getElementById('editForm' + id);
                        document.getElementById('editConfirmModal').classList.remove('hidden');
                        document.getElementById('confirmEditButton').onclick = function() {
                            form.submit();
                        };
                    }

                    function closeEditConfirmModal() {
                        document.getElementById('editConfirmModal').classList.add('hidden');
                    }

                    // Timer untuk menghilangkan pesan sukses setelah 3 detik
                    document.addEventListener('DOMContentLoaded', function() {
                        const successMessage = document.getElementById('successMessage');
                        if (successMessage) {
                            setTimeout(() => {
                                successMessage.style.display = 'none';
                            }, 3000);
                        }
                    });

                    // Script untuk menambahkan Video Parts
                    let videoPartIndex = 1;
                    document.getElementById('add-video-part').addEventListener('click', function() {
                        const container = document.getElementById('video-parts-container');
                        const videoPartDiv = document.createElement('div');
                        videoPartDiv.classList.add('video-part', 'mb-2');
                        videoPartDiv.innerHTML = `
                <input type="text" name="video_parts[${videoPartIndex}][title]" placeholder="Video Title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 mb-2" required>
                <input type="url" name="video_parts[${videoPartIndex}][video_url]" placeholder="Video URL" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            `;
                        container.appendChild(videoPartDiv);
                        videoPartIndex++;
                    });
                </script>
            </div>
        </div>
</body>

</html>
