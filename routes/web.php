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
Route::delete('/posts/{post}', [PostController::class,'destroy'] )->name('posts.destroy');
Route::get('/posts/{post}/edit', [PostController::class,'edit'] )->name('posts.edit');
Route::put('/posts/{post}', [PostController::class,'update'] )->name('posts.update');


Route::get('/dashboard', [PostController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('create');
    
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
