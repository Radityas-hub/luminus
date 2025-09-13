<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request, $threadId)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        Post::create([
            'thread_id' => $threadId,
            'user_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return redirect()->route('threads.show', $threadId)->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->all());

        return redirect()->route('threads.show', $post->thread_id)->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('threads.show', $post->thread_id)->with('success', 'Post deleted successfully.');
    }
}