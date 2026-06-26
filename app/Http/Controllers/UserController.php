<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\galleries;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()->latest()->paginate(6);
        $postCount = $user->posts()->count();
        $galleries = $user->galleries()
    ->where('is_public', 1)
    ->latest()
    ->paginate(6);
        $userSlug = $user->slug;

        return view('profile', compact('user', 'posts','postCount','userSlug','galleries'));
    }
}
