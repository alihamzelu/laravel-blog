<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    // Relationships
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    // Route binding (اختیاری ولی حرفه‌ای)
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Boot (safe slug)
    protected static function booted()
    {
        static::creating(function ($category) {

            $slug = Str::slug($category->name);
            $original = $slug;
            $i = 1;

            while (Category::where('slug', $slug)->exists()) {
                $slug = $original . '-' . $i;
                $i++;
            }

            $category->slug = $slug;
        });
    }
}