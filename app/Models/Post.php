<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }
    
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'published_at',
        'image'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
