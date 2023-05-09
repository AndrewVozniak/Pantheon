<?php

use App\Pantheon\Router\Route;

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->setName('home')->setMiddleware('auth');
Route::post('/post/{id}/{name}', [App\Http\Controllers\PostController::class, 'show'])->setName('home')->setMiddleware('auth');