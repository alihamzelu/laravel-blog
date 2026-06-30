<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RoleRequestController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\NotificationController;


Route::get('/', [PostController::class, 'home'])->name('home');


Route::get('/articles', [PostController::class, 'articles'])->name('articles.index');


Route::get('/categories', [PostController::class, 'categories'])->name('categories.categories');


Route::get('/profile/{user}', [UserController::class, 'show'])->name('preview');




Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');





Route::get('/send-notification', [NotificationController::class, 'send']);



Route::delete('/bookmarks/{bookmark}', [BookmarkController::class, 'destroy'])
    ->name('bookmarks.destroy');




Route::get('/donate', [DonateController::class,'index']);
Route::post('/donate/pay', [DonateController::class, 'pay']);
Route::get('/donate/callback', [DonateController::class,'callback']);
Route::get('/donate/success', [DonateController::class, 'success']);
Route::get('/donate/failed', [DonateController::class, 'failed']);
Route::get('/donate/donors', [DonateController::class, 'donors'])->name('donate.donors');


Route::get('/galleries', [GalleryController::class, 'index'])
    ->name('galleries.index');

Route::get('/gallery/create', [GalleryController::class, 'create'])
    ->name('gallery.create');

Route::post('/gallery', [GalleryController::class, 'store'])
    ->name('gallery.store');

Route::get('/gallery/{gallery}/edit', [GalleryController::class, 'edit'])
    ->name('gallery.edit');

Route::put('/gallery/{gallery}', [GalleryController::class, 'update'])
    ->name('gallery.update');

Route::delete('/gallery/{gallery}', [GalleryController::class, 'destroy'])
    ->name('gallery.destroy');

    
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAll');
Route::post('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markSingle');


Route::middleware('auth')->group(function () {

    Route::get('/role-request', [RoleRequestController::class, 'index'])
        ->name('role-request.index');

    Route::post('/role-request', [RoleRequestController::class, 'store'])
        ->name('role-request.store');
});


Route::post('/posts/{post}/bookmark', [BookmarkController::class, 'toggle'])
    ->name('posts.bookmark');



Route::post('/posts/{post}/like', [LikeController::class, 'toggle'])
    ->name('posts.like');


Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');


Route::get('/dashboard', [PostController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth', 'verified', 'avatar'])->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('create');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
