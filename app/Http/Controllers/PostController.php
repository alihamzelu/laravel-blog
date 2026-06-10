<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class PostController extends Controller
{
    public function header()
    {
        $categories = Category::all();
        $users = Auth::user();

        $name = $users->name;
        
        return view("components.header", compact("categories","name"));
    }
    
    public function categories()
    {
        $categories = Category::all();
        return view("categories", compact("categories"));
    }
    public function show(Post $post)
    {
        $post->load(['category','user']);
        $categories = Category::all();
        $posts = Post::with(['category', 'user'])->latest()->get();
        return view('posts.show', compact('post',"categories",'posts'));
    }

    public function home()
    {
        $categories = Category::all();
        $posts = Post::with(['category', 'user'])->latest()->get();
        return view("home", compact("categories",'posts'));
    }
    public function articles(Request $request)
    {
        $categories = Category::all();
        
        $searchTerm = $request->input('search');
        $categorySlug = $request->input('category');

        $posts = Post::with(['category', 'user'])
            ->latest()
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('content', 'like', "%{$searchTerm}%");
                });
            })
            ->when($categorySlug, function ($query, $categorySlug) {
                return $query->whereHas('category', function ($q) use ($categorySlug) {
                    $q->where('slug', $categorySlug);
                });
            })
            ->paginate(9)
            ->withQueryString();



        return view("articles", compact("categories",'posts'));
    }
    public function create()
    {
        $categories = Category::all();

        return view("posts.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "title"=> "required|max:255",
            "content"=> "required",
            "category_id"=> "required|exists:categories,id",
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $request->user()->posts()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']), 
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
            'image' => $imagePath,
            'published_at' => now(),
        ]);

        return redirect('/dashboard')->with('status', 'Post created successfully!');
    }
}
