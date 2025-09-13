<?php
namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Category;
use App\Models\Topic;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $threads = Thread::with('user')
                         ->when($query, function ($queryBuilder) use ($query) {
                             $queryBuilder->where('title', 'LIKE', "%{$query}%")
                                          ->orWhere('content', 'LIKE', "%{$query}%");
                         })
                         ->latest()
                         ->get();
        $forums = Forum::all();
        $categories = Category::all();
        $popularTopics = Topic::withCount('threads')->orderBy('threads_count', 'desc')->take(5)->get();
    
        return view('forum.index', compact('forums', 'threads', 'categories', 'popularTopics', 'query'));
    }
    public function show($id)
    {
        $forum = Forum::findOrFail($id);
        return view('forum.show', compact('forum'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = $request->only(['name', 'description']);
        Forum::create($data);

        return redirect()->route('forums.index')->with('success', 'Forum berhasil dibuat.');
    }

    public function edit($id)
    {
        $forum = Forum::findOrFail($id);
        return view('forum.edit', compact('forum'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $forum = Forum::findOrFail($id);
        $forum->update($request->all());

        return redirect()->route('forums.index')->with('success', 'Forum updated successfully.');
    }

    public function destroy($id)
    {
        $forum = Forum::findOrFail($id);
        $forum->delete();

        return redirect()->route('forums.index')->with('success', 'Forum deleted successfully.');
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:siswa')->only(['store', 'edit', 'update', 'destroy']);
    }

    
    public function showAllCategories()
    {
        $forums = Forum::all();
        $threads = Thread::with('user')->latest()->get();
        $categories = Category::all();
        $popularTopics = Topic::withCount('threads')->orderBy('threads_count', 'desc')->take(5)->get();
        return view('forum.index', compact('forums', 'threads', 'categories', 'popularTopics'));
    }
public function filterByCategory($id)
{
    $forums = Forum::all();
    $threads = Thread::where('category_id', $id)->with('user')->latest()->get();
    $categories = Category::all();
    $popularTopics = Topic::withCount('threads')->orderBy('threads_count', 'desc')->take(5)->get();
    $selectedCategory = Category::findOrFail($id);
    return view('forum.index', compact('forums', 'threads', 'categories', 'popularTopics', 'selectedCategory'));
}



}