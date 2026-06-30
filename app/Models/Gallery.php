<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        'category_id',
        'is_public',
        'slug',
    ];

    protected function casts(): array
    {
        return [
            'is_public' => 'boolean',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Route binding
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Auto slug
    protected static function booted()
    {
        static::creating(function ($gallery) {

            $slug = Str::slug($gallery->title);
            $original = $slug;
            $i = 1;

            while (Gallery::where('slug', $slug)->exists()) {
                $slug = $original . '-' . $i;
                $i++;
            }

            $gallery->slug = $slug;

            if (auth()->check()) {
                $gallery->user_id = auth()->id();
            }
        });
    }
}