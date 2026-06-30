<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'published_at',
        'image',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    // Route model binding (slug)
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // bookmarks (many-to-many)
    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'bookmarks')->withTimestamps();
    }

    // BOOT (fixed)
    protected static function booted()
    {
        static::creating(function ($post) {

            // slug safe (unique)
            $slug = Str::slug($post->title);
            $original = $slug;
            $i = 1;

            while (Post::where('slug', $slug)->exists()) {
                $slug = $original . '-' . $i;
                $i++;
            }

            $post->slug = $slug;

            // auto user
            if (auth()->check()) {
                $post->user_id = auth()->id();
            }
        });
    }
}