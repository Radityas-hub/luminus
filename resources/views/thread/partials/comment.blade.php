<!-- Main Comment Container -->
<div class="comment ml-{{ $level * 20 }}">
    <div
        class="bg-gray-50 rounded-xl p-4 relative {{ $comment->body == 'Komentar di hapus oleh admin' ? 'deleted-comment' : '' }}">
        <!-- Existing comment content -->
        <div class="flex items-center space-x-3 mb-2">
            <img src="{{ $comment->user->profile_picture_url ? asset('storage/' . $comment->user->profile_picture_url) : ($comment->user->gender == 'female' ? asset('images/default-female.png') : asset('images/default-male.png')) }}"
                alt="User Avatar" class="w-8 h-8 rounded-full">
            <div class="flex items-center space-x-2">
                <span class="font-medium text-gray-700">
                    {{ $comment->user->name }}
                    @if ($comment->user->hasRole('admin'))
                        <span class="text-yellow-500 bg-gray-200 px-2 py-1 rounded-full ml-2">Admin</span>
                    @endif
                </span>
                <span class="text-gray-400 text-sm">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            <!-- Three-dot menu for edit/delete -->
            @if (Auth::id() == $comment->user_id || Auth::user()->hasRole('admin'))
                <div class="ml-auto relative">
                    <button class="text-gray-400 hover:text-gray-600" onclick="toggleMenu({{ $comment->id }})">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                    <div id="menu-{{ $comment->id }}"
                        class="hidden absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                            onclick="openEditModal({{ $comment->id }}, '{{ $comment->body }}')">Edit</a>
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Delete</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <!-- Comment body -->
        <div class="text-gray-600 ml-11">
            {!! $comment->body !!}
            @if ($comment->image)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $comment->image) }}" alt="Comment Image"
                        class="rounded-lg max-w-full h-auto">
                </div>
            @endif
        </div>

        <!-- Reply button & form -->
        <div class="ml-11 mt-4">
            <button class="text-sm text-blue-500 hover:underline"
                onclick="toggleReplyForm({{ $comment->id }}, '{{ $comment->user->name }}')">Reply</button>
            <form action="{{ route('comments.reply') }}" method="POST" class="hidden mt-2"
                id="reply-form-{{ $comment->id }}">
                @csrf
                <input type="hidden" name="thread_id" value="{{ $thread->id }}">
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

        <!-- Recursive replies section -->
        @if ($comment->children && $comment->children->count() > 0)
            <div class="mt-4 space-y-4 ml-8 pl-4 border-l-2 border-gray-200">
                @foreach ($comment->children as $reply)
                    @include('thread.partials.comment', ['comment' => $reply, 'level' => $level + 1])
                @endforeach
            </div>
        @endif
    </div>
</div>

