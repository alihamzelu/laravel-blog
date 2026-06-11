<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;


Route::get('/', [PostController::class, 'home'])->name('home');
Route::get('/articles', [PostController::class, 'articles'])->name('articles.index');
Route::get('/categories', [PostController::class, 'categories'])->name('categories.categories');
Route::get('/posts/{post}', [PostController::class,'show'] )->name('posts.show');
Route::get('/profile/{user}', [UserController::class,'show'] )->name('preview');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
