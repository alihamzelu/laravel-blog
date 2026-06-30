<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /* --------------------------------
        ROLE CHECK HELPERS
    -------------------------------- */

    private function canCreate()
    {
        return in_array(auth()->user()->role, ['admin', 'author']);
    }

    private function canManagePost(Post $post)
    {
        $user = auth()->user();

        return $user->role === 'admin' || $post->user_id === $user->id;
    }

    /* --------------------------------
        DASHBOARD
    -------------------------------- */

    public function dashboard()
    {
        $user = auth()->user();

        $galleries = $user->galleries()->latest()->get();

        $bookmarks = Bookmark::where('user_id', $user->id)
            ->with(['post.category', 'post.user'])
            ->latest()
            ->get();

        $posts = $user->posts()
            ->with('category')
            ->latest()
            ->get();

        return view('dashboard', compact('posts', 'galleries', 'bookmarks'));
    }

    /* --------------------------------
        CREATE
    -------------------------------- */

    public function create()
    {
        if (!$this->canCreate()) {
            abort(403, 'Only authors and admins can create posts.');
        }

        $categories = Category::all();

        return view('create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!$this->canCreate()) {
            abort(403, 'Only authors and admins can create posts.');
        }

        $validated = $request->validate([
            "title" => "required|max:255",
            "content" => "required",
            "category_id" => "required|exists:categories,id",
            "image" => "nullable|image",
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('posts', 'public')
            : null;

        $request->user()->posts()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . Str::random(6),
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'published_at' => now(),
        ]);

        return redirect()->route('dashboard')
            ->with('status', 'Post created successfully!');
    }

    /* --------------------------------
        EDIT
    -------------------------------- */

    public function edit(Post $post)
    {
        if (!$this->canManagePost($post)) {
            abort(403);
        }

        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    /* --------------------------------
        UPDATE
    -------------------------------- */

    public function update(Request $request, Post $post)
    {
        if (!$this->canManagePost($post)) {
            abort(403);
        }

        $request->validate([
            "title" => "required|max:255",
            "content" => "required",
            "category_id" => "required|exists:categories,id",
            "image" => "nullable|image",
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('dashboard')
            ->with('status', 'Post updated successfully!');
    }

    /* --------------------------------
        DELETE
    -------------------------------- */

    public function destroy(Post $post)
    {
        $user = auth()->user();

        if (! $user->canManagePost($post)) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('dashboard')
            ->with('status', 'Post deleted successfully!');
    }

    /* --------------------------------
        PUBLIC PAGES (unchanged)
    -------------------------------- */

    public function header()
    {
        $categories = Category::all();
        $name = Auth::user()->name;

        return view("components.header", compact("categories", "name"));
    }

    public function categories()
    {
        return view("categories", [
            'categories' => Category::all()
        ]);
    }
    public function show(Post $post)
    {

        $post->load(['category', 'user'])->loadCount('likes');

        $categories = Category::all();

        $posts = Post::with(['category', 'user'])->latest()->get();

        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->latest()
            ->take(5)
            ->get();

        return view('posts.show', compact('post', 'categories', 'posts', 'relatedPosts'));
    }

    public function home()
    {
        return view("home", [
            'categories' => Category::all(),
            'posts' => Post::with(['category', 'user'])->latest()->get(),
            'galleries' => Gallery::all(),
        ]);
    }

    public function articles(Request $request)
    {
        $categories = Category::all();

        $posts = Post::with(['category', 'user'])
            ->latest()
            ->when($request->search, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            })
            ->when($request->category, function ($q, $slug) {
                $q->whereHas(
                    'category',
                    fn($c) =>
                    $c->where('slug', $slug)
                );
            })
            ->paginate(9)
            ->withQueryString();

        return view("articles", compact("categories", "posts"));
    }
}
