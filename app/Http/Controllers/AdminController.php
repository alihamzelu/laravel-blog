<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.dashboard', [
            'posts' => Post::with('user', 'category')
                ->latest()
                ->paginate(10),

            'categories' => Category::withCount('posts')->get(),

            'totalPosts' => Post::count(),
            'totalUsers' => User::count(),
            'totalCategories' => Category::count(),

            'latestPosts' => Post::latest()->take(5)->get(),
        ]);
    }
}
