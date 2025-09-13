<!-- filepath: /d:/Lomba2024bact2/luminus/resources/views/thread/comments.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/thread.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="max-w-screen-lg mx-auto py-6">
        <!-- nav -->


        <div class="max-w-screen-lg mx-auto py-6">
            <!-- Alert Messages -->
            @if (session('success'))
                <div id="alert-success"
                    class="mb-6 flex items-center p-4 bg-green-50 border-l-4 border-green-400 rounded-lg shadow-md transform transition-all duration-500 ease-in-out"
                    role="alert">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            {{ session('success') }}
                        </p>
                    </div>
                    <button onclick="dismissAlert('alert-success')"
                        class="ml-auto -mx-1.5 -my-1.5 text-green-500 rounded-lg p-1.5 hover:bg-green-100 inline-flex h-8 w-8">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div id="alert-error"
                    class="mb-6 flex items-center p-4 bg-red-50 border-l-4 border-red-400 rounded-lg shadow-md transform transition-all duration-500 ease-in-out"
                    role="alert">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-400 text-xl"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">
                            {{ session('error') }}
                        </p>
                    </div>
                    <button onclick="dismissAlert('alert-error')"
                        class="ml-auto -mx-1.5 -my-1.5 text-red-500 rounded-lg p-1.5 hover:bg-red-100 inline-flex h-8 w-8">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif

            @include('thread.nav')
            <div class="bg-white shadow rounded-xl p-6">
                <!-- Thread Header -->
                @include('thread.Header')
                <!-- Comments Section -->
                <div class="border-t pt-6">
                    <h3 class="text-lg font-semibold mb-6 flex items-center gap-2">
                        <i class="fas fa-comments text-[#696EFF]"></i>
                        <span>Comments ({{ $thread->comments->count() }})</span>
                    </h3>
                    <div class="space-y-6">
                        @foreach ($thread->comments as $comment)
                            @include('thread.partials.comment', ['comment' => $comment, 'level' => 0])
                        @endforeach
                    </div>
                    <!-- Comment Form -->
                    <form action="{{ route('threads.comment', $thread->id) }}" method="POST" class="mt-8"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="body" class="block text-sm font-medium text-gray-700 mb-2">Add a
                                comment</label>
                            <textarea id="body" name="body" rows="3"
                                class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-[#696EFF] focus:ring-1 focus:ring-[#696EFF] transition-all duration-200"
                                placeholder="Write your comment here..."></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Upload
                                Image</label>
                            <input type="file" name="image" id="image"
                                class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-[#696EFF] focus:ring-1 focus:ring-[#696EFF] transition-all duration-200">
                        </div>
                        <button type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white font-medium rounded-xl hover:shadow-lg hover:shadow-[#696EFF]/25 transition-all duration-300">
                            Submit Comment
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Edit Comment Modal -->
        @include('thread.modal')
        <script>
            function toggleReplyForm(commentId, userName) {
                const form = document.getElementById(`reply-form-${commentId}`);
                form.classList.toggle('hidden');
                const textarea = form.querySelector('textarea');
                textarea.value = `@${userName} `;
                textarea.focus();
            }

            function toggleMenu(commentId) {
                const menu = document.getElementById(`menu-${commentId}`);
                menu.classList.toggle('hidden');
            }

            function openEditModal(commentId, commentBody) {
                const modal = document.getElementById('editCommentModal');
                const form = document.getElementById('editCommentForm');
                const textarea = document.getElementById('editBody');
                form.action = `/comments/${commentId}`;
                textarea.value = commentBody;
                modal.classList.remove('hidden');
            }

            function closeEditModal() {
                const modal = document.getElementById('editCommentModal');
                modal.classList.add('hidden');
            }

   /* filepath: /d:/Lomba2024bact2/luminus/public/js/forum.js */
function dismissAlert(alertId) {
    const alert = document.getElementById(alertId);
    alert.style.opacity = '0';
    alert.style.transform = 'translateX(100%)';
    setTimeout(() => {
        alert.style.display = 'none';
    }, 500);
}

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        const alerts = document.querySelectorAll('[role="alert"]');
        alerts.forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(100%)';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 500);
        });
    }, 5000);
});

     
        </script>
</body>

</html>
