<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostLikedNotification;

class LikeController extends Controller
{
    public function toggle(Post $post)
    {
        $user = Auth::user();

        if (! $user) {
            abort(403, 'Login required');
        }

        $like = $post->likes()
            ->where('user_id', $user->id)
            ->first();

        if ($like) {

            $like->delete();

        } else {

            $post->likes()->create([
                'user_id' => $user->id,
            ]);

            if ($post->user_id !== $user->id) {
                $post->user->notify(
                    new PostLikedNotification($user, $post)
                );
            }
        }

        return back();
    }
}