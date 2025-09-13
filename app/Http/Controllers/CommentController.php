<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update([
            'body' => $request->body,
        ]);

        return redirect()->route('threads.commentsPage', $comment->thread_id)->with('success', 'Comment updated successfully.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if (Auth::user()->hasRole('admin')) {
            $comment->update([
                'body' => 'Komentar di hapus oleh admin',
            ]);
        } else {
            $comment->delete();
        }

        return redirect()->route('threads.commentsPage', $comment->thread_id)->with('success', 'Comment deleted successfully.');
    }
    public function storeReply(Request $request)
    {
        $request->validate([
            'body' => 'required|string',
            'thread_id' => 'required|exists:threads,id',
            'parent_id' => 'required|exists:comments,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('comments', 'public');
        }
    
        Comment::create([
            'body' => $request->body,
            'user_id' => Auth::id(),
            'thread_id' => $request->thread_id,
            'parent_id' => $request->parent_id,
            'image' => $imagePath,
        ]);
    
        return back()->with('success', 'Reply berhasil ditambahkan.');
    }

}