<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()
            ->latest()
            ->paginate(6);

        $postCount = $user->posts()->count();

        $galleries = $user->galleries()
            ->where('is_public', true)
            ->latest()
            ->paginate(6);

        return view('profile', compact(
            'user',
            'posts',
            'postCount',
            'galleries'
        ));
    }
}