<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div id="createThreadModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-lg w-full max-w-2xl">
       @if ($errors->any())
        <div id="errorAlert" class="fixed top-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-lg" role="alert">
            <div class="flex items-center">
                <div class="py-1">
                    <svg class="w-6 h-6 mr-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">Oops! Ada beberapa kesalahan:</p>
                    <ul class="mt-1 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="closeErrorAlert()" class="ml-auto">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
        @endif
        <div class="flex justify-between items-center px-4 py-2 border-b">
            <h2 class="text-xl font-semibold">Buat Diskusi Baru</h2>
            <button id="closeModalButton" class="text-gray-600 hover:text-gray-800">&times;</button>
        </div>
        <form action="{{ route('threads.storeFromIndex') }}" method="POST" class="px-6 py-4"
            enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700">Judul:</label>
                <input type="text" name="title" id="title" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="mb-4">
                <label for="body" class="block text-gray-700">Konten:</label>
                <textarea name="body" id="body" class="w-full border rounded px-3 py-2" required></textarea>
                <p class="text-sm text-gray-500">Anda dapat menggunakan Markdown untuk memformat teks. <a
                        href="https://www.markdownguide.org/cheat-sheet/" target="_blank" class="text-blue-500">Lihat
                        panduan Markdown</a>.</p>
            </div>
            <div class="mb-4">
                <label for="category" class="block text-gray-700">Kategori:</label>
                <select name="category_id" id="category" class="w-full border rounded px-3 py-2" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700">Gambar:</label>
                <input type="file" name="image" id="image" class="w-full border rounded px-3 py-2">
            </div>
            <div class="flex justify-end">
                <button type="button" id="cancelButton"
                    class="mr-2 px-4 py-2 rounded bg-gray-500 text-white hover:bg-gray-600">Batal</button>
                <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600">Buat</button>
            </div>
        </form>
    </div>
</div>


<script>
function closeErrorAlert() {
    document.getElementById('errorAlert').style.display = 'none';
}

// Auto-hide error alert after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const errorAlert = document.getElementById('errorAlert');
    if (errorAlert) {
        setTimeout(() => {
            errorAlert.style.display = 'none';
        }, 5000);
    }
});

// Show modal with errors if any
@if($errors->any())
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('createThreadModal').classList.remove('hidden');
});
@endif
</script>
</body>
</html>