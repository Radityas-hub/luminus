<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $thread->title }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
     .mention {
    color: #696EFF;
    font-weight: 500;
    background-color: rgba(105, 110, 255, 0.1);
    padding: 2px 4px;
    border-radius: 4px;
    }
    </style>
</head>

<body class="bg-gray-100">
    <div class="max-w-screen-lg mx-auto py-6">
    
    <!-- nav -->
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
                    <div class="bg-gray-50 rounded-xl p-4 relative">
                        <div class="flex items-center space-x-3 mb-2">
                            <img src="{{ $comment->user->profile_picture_url ? asset('storage/' . $comment->user->profile_picture_url) : 'https://via.placeholder.com/40' }}" 
                                 alt="User Avatar" 
                                 class="w-8 h-8 rounded-full">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium text-gray-700">{{ $comment->user->name }}</span>
                                <span class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <!-- Three-dot menu -->
                      @if(Auth::id() == $comment->user_id || Auth::user()->hasRole('admin'))
                            <div class="ml-auto relative">
                                <button class="text-gray-400 hover:text-gray-600" onclick="toggleMenu({{ $comment->id }})">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div id="menu-{{ $comment->id }}" class="hidden absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg">
                                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" onclick="openEditModal({{ $comment->id }}, '{{ $comment->body }}')">Edit</a>
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Delete</button>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                          <div class="text-gray-600 ml-11">
                            {!! $comment->body !!}
                        </div>
                        <!-- Reply Form -->
                        <div class="ml-11 mt-4">
                            <button class="text-sm text-blue-500 hover:underline" onclick="toggleReplyForm({{ $comment->id }}, '{{ $comment->user->name }}')">Reply</button>
                            <form action="{{ route('threads.reply', $thread->id) }}" method="POST" class="hidden mt-2" id="reply-form-{{ $comment->id }}">
                                @csrf
                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                <textarea name="body" rows="2" 
                                          class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-[#696EFF] focus:ring-1 focus:ring-[#696EFF] transition-all duration-200"
                                          placeholder="Write your reply here..."></textarea>
                                <button type="submit" 
                                        class="mt-2 px-4 py-2 bg-gradient-to-r from-[#696EFF] to-[#F8ACFF] text-white font-medium rounded-xl hover:shadow-lg hover:shadow-[#696EFF]/25 transition-all duration-300">
                                    Reply
                                </button>
                            </form>
                        </div>
                        <!-- Display Replies -->
                        @foreach ($comment->replies as $reply)
                            <div class="bg-gray-100 rounded-xl p-4 mt-4 ml-11">
                                <div class="flex items-center space-x-3 mb-2">
                                    <img src="{{ $reply->user->profile_picture_url ? asset('storage/' . $reply->user->profile_picture_url) : 'https://via.placeholder.com/40' }}" 
                                         alt="User Avatar" 
                                         class="w-8 h-8 rounded-full">
                                    <div class="flex items-center space-x-2">
                                        <span class="font-medium text-gray-700">{{ $reply->user->name }}</span>
                                        <span class="text-gray-400 text-sm">{{ $reply->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <p class="text-gray-600 ml-11">
                                    <span class="text-blue-500 font-medium">@ {{ $reply->taggedUser->name }}</span> 
                                    {{ $reply->body }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Comment Form -->
            <form action="{{ route('threads.comment', $thread->id) }}" method="POST" class="mt-8">
                @csrf
                <div class="mb-4">
                    <label for="body" class="block text-sm font-medium text-gray-700 mb-2">Add a comment</label>
                    <textarea id="body" 
                              name="body" 
                              rows="3" 
                              class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl focus:outline-none focus:border-[#696EFF] focus:ring-1 focus:ring-[#696EFF] transition-all duration-200"
                              placeholder="Write your comment here..."></textarea>
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
</script>
</body>

</html>