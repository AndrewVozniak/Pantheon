<?php

use App\Pantheon\Router\Router;

Router::get('/', [App\Http\Controllers\HomeController::class, 'index'])->setName('posts')->setMiddleware('auth');
Router::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->setName('posts')->setMiddleware('auth');