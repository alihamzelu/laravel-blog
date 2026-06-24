<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BookmarkController extends Controller
{
    public function toggle(Post $post)
    {
        auth()->user()
            ->bookmarkedPosts()
            ->toggle($post->id);

        return back();
    }
}
