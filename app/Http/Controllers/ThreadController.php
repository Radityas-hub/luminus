<?php
namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ThreadVote;
use App\Models\Comment;
use League\CommonMark\CommonMarkConverter;
use App\Models\Report;



class ThreadController extends Controller
{
    public function create($forumId)
    {
        $forum = Forum::findOrFail($forumId);
        return view('thread.create', compact('forum'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'body'        => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'forum_id'    => 'required|exists:forums,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $imagePath = null;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }
    
        Thread::create([
            'title'       => $request->title,
            'body'        => $request->body,
            'category_id' => $request->category_id,
            'forum_id'    => $request->forum_id,
            'user_id'     => Auth::id(),
            'image'       => $imagePath,
        ]);
    
        return redirect()->route('forums.index')->with('success', 'Diskusi berhasil dibuat.');
    }

   
    public function __construct()
    {
        $this->middleware('auth');
    }



    
    public function storeFromIndex(Request $request)
    {
        try {
            $request->validate([
                'title' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:threads,title',
                    'min:5'
                ],
                'body' => [
                    'required',
                    'string',
                    'min:10'
                ],
                'category_id' => 'required|exists:categories,id',
                'image' => [
                    'nullable',
                    'image',
                    'mimes:jpeg,png,jpg,gif',
                    'max:2048'
                ],
            ], [
                'title.required' => 'Judul diskusi harus diisi',
                'title.unique' => 'Judul diskusi sudah ada, silakan gunakan judul lain',
                'title.min' => 'Judul diskusi minimal 5 karakter',
                'body.required' => 'Konten diskusi harus diisi',
                'body.min' => 'Konten diskusi minimal 10 karakter',
                'category_id.required' => 'Kategori harus dipilih',
                'image.image' => 'File harus berupa gambar',
                'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
                'image.max' => 'Ukuran gambar maksimal 2MB'
            ]);
    
            $imagePath = null;
    
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
            }
    
            $converter = new CommonMarkConverter();
            $bodyHtml = $converter->convertToHtml($request->body);
    
            DB::beginTransaction();
    
            $forum = Forum::create([
                'name' => $request->title,
                'description' => strip_tags($bodyHtml),
            ]);
    
            Thread::create([
                'title' => $request->title,
                'body' => $bodyHtml,
                'category_id' => $request->category_id,
                'forum_id' => $forum->id,
                'user_id' => Auth::id(),
                'image' => $imagePath,
            ]);
    
            DB::commit();
    
            return redirect()->route('forums.index')
                ->with('success', 'Diskusi berhasil dibuat.');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            DB::rollback();
            return back()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.')
                ->withInput();
        }
    }
    

    public function show($id)
    {
        $thread = Thread::with(['user', 'comments' => function($query) {
            $query->whereNull('parent_id')->with('children.user');
        }])->findOrFail($id);
        $thread->views += 1;
        $thread->save();
        return view('thread.comments', compact('thread'));
    }
    public function upvote($id)
    {
        $thread = Thread::findOrFail($id);
        $user = Auth::user();
    
        // Cek apakah pengguna sudah memberikan vote
        $existingVote = ThreadVote::where('user_id', $user->id)->where('thread_id', $thread->id)->first();
    
        if ($existingVote) {
            if ($existingVote->vote_type == 'upvote') {
                return back()->with('error', 'You have already upvoted this thread.');
            } else {
                // Ubah vote dari downvote ke upvote
                $existingVote->vote_type = 'upvote';
                $existingVote->save();
                $thread->upvotes += 1;
                $thread->downvotes -= 1;
            }
        } else {
            // Tambahkan upvote baru
            ThreadVote::create([
                'user_id' => $user->id,
                'thread_id' => $thread->id,
                'vote_type' => 'upvote',
            ]);
            $thread->upvotes += 1;
        }
    
        $thread->save();
    
        return back()->with('success', 'Upvoted successfully.');
    }
    
    public function downvote($id)
    {
        $thread = Thread::findOrFail($id);
        $user = Auth::user();
    
        // Cek apakah pengguna sudah memberikan vote
        $existingVote = ThreadVote::where('user_id', $user->id)->where('thread_id', $thread->id)->first();
    
        if ($existingVote) {
            if ($existingVote->vote_type == 'downvote') {
                return back()->with('error', 'You have already downvoted this thread.');
            } else {
                // Ubah vote dari upvote ke downvote
                $existingVote->vote_type = 'downvote';
                $existingVote->save();
                $thread->upvotes -= 1;
                $thread->downvotes += 1;
            }
        } else {
            // Tambahkan downvote baru
            ThreadVote::create([
                'user_id' => $user->id,
                'thread_id' => $thread->id,
                'vote_type' => 'downvote',
            ]);
            $thread->downvotes += 1;
        }
    
        $thread->save();
    
        return back()->with('success', 'Downvoted successfully.');
    }
    
  
    
 

    public function comment(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $thread = Thread::findOrFail($id);
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('comments', 'public');
        }
    
        $thread->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
            'image' => $imagePath,
        ]);
    
        return redirect()->route('threads.commentsPage', $thread->id)->with('success', 'Comment added successfully.');
    }

    public function commentsPage($id)
    {
        $thread = Thread::with(['comments' => function($query) {
            $query->whereNull('parent_id')->with('children');
        }])->findOrFail($id);
    
        $comments = $thread->comments;
    
        return view('thread.comments', compact('thread', 'comments'));
    }


public function reply(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string',
            'parent_id' => 'required|exists:comments,id',
        ]);

        $parentComment = Comment::findOrFail($request->parent_id);
        $taggedUserId = $parentComment->user_id;

        $thread = Thread::findOrFail($id);
        $thread->comments()->create([
            'body' => $request->body,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'tagged_user_id' => $taggedUserId,
        ]);

        return redirect()->route('threads.commentsPage', $thread->id)->with('success', 'Reply added successfully.');
    }



public function destroy($id)
{
    $thread = Thread::findOrFail($id);
    $thread->delete();

    return redirect()->route('forums.index')->with('success', 'Diskusi berhasil dihapus.');
}

public function storeReport(Request $request)
{
    $request->validate([
        'thread_id'   => 'required|exists:threads,id',
        'type'        => 'required|string',
        'description' => 'nullable|string',
    ]);

    $thread = Thread::findOrFail($request->thread_id);

    if ($thread->user_id == Auth::id()) {
        return redirect()->back()->with('error', 'Anda tidak dapat melaporkan diskusi Anda sendiri.');
    }

    Report::create([
        'user_id'     => Auth::id(),
        'thread_id'   => $request->thread_id,
        'type'        => $request->type,
        'description' => $request->description,
    ]);

    return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
}




public function search(Request $request)
{
    $query = $request->input('query');
    $threads = Thread::where('title', 'LIKE', "%{$query}%")
                     ->with('user')
                     ->get();

    return view('forum.index', compact('threads', 'query'));
}


public function searchSuggestions(Request $request)
{
    $query = $request->input('query');

    $threads = Thread::where('title', 'LIKE', "%{$query}%")
        ->orWhere('body', 'LIKE', "%{$query}%")
        ->select('id', 'title', 'body')
        ->limit(5)
        ->with('user:id,name')
        ->get()
        ->map(function ($thread) {
            return [
                'id' => $thread->id,
                'title' => $thread->title,
                'preview' => Str::limit(strip_tags($thread->body), 100),
                'author' => $thread->user->name
            ];
        });

    return response()->json([
        'status' => 'success',
        'data' => $threads,
        'query' => $query,
        'count' => $threads->count()
    ]);
}

}