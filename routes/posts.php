<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::post('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('posts/comment/{id}', [PostController::class, 'comment'])->name('posts.comment');
Route::post('posts/like/{id}', [PostController::class, 'like'])->name('posts.like');
Route::post('posts/dislike/{id}', [PostController::class, 'dislike'])->name('posts.dislike');
