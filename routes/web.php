<?php

use App\Http\Controllers\Auth\ChatController;
use App\Http\Controllers\Auth\CommentController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/', [HomeController::class, 'store'])->name('postscreate');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');


Auth::routes();

Route::get('/profile/{id}', [UserController::class, 'profile'])->name('users.profile');
Route::post('/post/{id}/like', [PostController::class, 'likePost'])->name('post.like');

Route::middleware(['auth'])->group(function () {
    Route::get('/chat/{user}', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/unread-count', [ChatController::class, 'getUnreadMessageCount'])->name('chat.unread.count');

});

