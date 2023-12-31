<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

Route::post('/users/follow/{id}', [UserController::class, 'follow'])->name('users.follow');
Route::post('/users/unfollow/{id}', [UserController::class, 'unfollow'])->name('users.unfollow');
