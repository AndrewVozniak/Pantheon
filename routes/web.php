<?php

use App\Pantheon\Router\Router;

Router::get('/', [App\Http\Controllers\HomeController::class, 'index'])->setMiddleware('auth');
Router::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->setName('home')->setMiddleware('auth');