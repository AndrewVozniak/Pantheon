<?php

use App\Pantheon\Router\Route;

Route::get('/', [App\Http\Controllers\PostController::class, 'index'])->name('home')->middleware('auth');