<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewCommentNotification;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $user = Auth::user();

        abort_unless($user, 403);

        $request->validate([
            'body' => ['required', 'string', 'min:2', 'max:1000'],
        ]);

        $alreadyCommented = $post->comments()
            ->where('user_id', $user->id)
            ->latest()
            ->first();

        if ($alreadyCommented && $alreadyCommented->created_at->diffInSeconds(now()) < 10) {
            return back()->with('error', 'You are commenting too fast.');
        }

        $post->comments()->create([
            'user_id' => $user->id,
            'body' => trim($request->body),
        ]);

        return back()->with('success', 'Comment added.');
    }
}