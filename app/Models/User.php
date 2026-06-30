<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use App\Models\Post;
use App\Models\Gallery;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Profile;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'bio',
        'job',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->hasRole('admin');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function bookmarkedPosts()
    {
        return $this->belongsToMany(Post::class, 'bookmarks')->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'username';
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isAuthor(): bool
    {
        return $this->hasRole('author');
    }

    public function isReader(): bool
    {
        return $this->hasRole('reader');
    }

    public function canManagePost($post): bool
    {
        return $this->hasRole('admin') || $this->id === $post->user_id;
    }

    public function canCreateContent(): bool
    {
        return $this->hasAnyRole(['admin', 'author']);
    }

    protected static function booted()
    {
        static::created(function ($user) {
            $user->assignRole('reader');
        });
    }

    public function hasLiked(Post $post): bool
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }


    public function hasBookmarked(Post $post): bool
    {
        return $this->bookmarkedPosts()->where('post_id', $post->id)->exists();
    }
}