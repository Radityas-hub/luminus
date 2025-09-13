<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-3">
<!-- Update thread header profile image -->
<img src="{{ $thread->user->profile_picture_url ? asset('storage/' . $thread->user->profile_picture_url) : ($thread->user->gender == 'female' ? asset('images/default-female.png') : asset('images/default-male.png')) }}"
    alt="Thread Image"
    class="w-10 h-10 rounded-full">
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">{{ $thread->title }}</h2>
                <p class="text-gray-500">Posted by {{ $thread->user->name }} ·
                    {{ $thread->created_at->diffForHumans() }}</p>

            </div>

        </div>
        @if (Auth::user()->hasRole('siswa') && $thread->user_id != Auth::id())
            <button onclick="toggleReportForm()" class="text-red-500 hover:text-red-700">
                <i class="fas fa-flag"></i> Laporkan
            </button>
        @endif

    </div>


    <!-- Thread Content -->
    <div class="text-gray-600 mb-8">
        {!! $thread->body !!}
    </div>
    @if ($thread->image)
        <img src="{{ asset('storage/' . $thread->image) }}" alt="Thread Image" class="w-full h-auto mb-4">
    @endif

    <!-- Form Laporan -->
    @if (Auth::user()->hasRole('siswa') && $thread->user_id != Auth::id())
        <div id="reportForm" class="hidden mt-4">
            <form action="{{ route('reports.store') }}" method="POST">
                @csrf
                <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                <div class="mb-4">
                    <label for="type" class="block text-gray-700">Jenis Laporan:</label>
                    <select name="type" id="type" class="w-full border rounded px-3 py-2" required>
                        <option value="Spam">Spam</option>
                        <option value="Inappropriate">Inappropriate</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Deskripsi:</label>
                    <textarea name="description" id="description" class="w-full border rounded px-3 py-2"></textarea>
                </div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Kirim Laporan</button>
            </form>
        </div>
    @endif

    <script>
        function toggleReportForm() {
            const form = document.getElementById('reportForm');
            form.classList.toggle('hidden');
        }
    </script>


</body>

</html>
