<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Bookmark;

class BookmarkController extends Controller
{
    public function toggle(Post $post)
    {
        $user = Auth::user();

        abort_unless($user, 403);

        $exists = Bookmark::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->first();

        if ($exists) {
            $exists->delete();
        } else {
            Bookmark::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);
        }

        return back();
    }

    public function destroy(Bookmark $bookmark)
    {
        if ($bookmark->user_id !== auth()->id()) {
            abort(403);
        }

        $bookmark->delete();

        return back()->with('success', 'Bookmark removed.');
    }
}
