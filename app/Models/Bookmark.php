<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'post_id',
        'user_id',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function toggle($userId, $postId)
    {
        $bookmark = self::where('user_id', $userId)
            ->where('post_id', $postId)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return false;
        }

        self::create([
            'user_id' => $userId,
            'post_id' => $postId,
        ]);

        return true;
    }
}