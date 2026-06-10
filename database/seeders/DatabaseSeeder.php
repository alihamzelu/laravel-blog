<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    
        $categories = ['Technology', 'Lifestyle', 'Travel', 'Food', 'Design'];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'slug' => Str::slug($category), 
            ]);
        }
    }
}
