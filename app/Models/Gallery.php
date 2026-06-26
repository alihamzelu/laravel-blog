<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Validate;

class Gallery extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        'category_id',
        'is_public',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
