<?php

namespace App\Pantheon;
use App\Pantheon\Router\RouteDispatcher;

class App
{
    public static function run() : void
    {
        // Check routes
        $dispatcher = new RouteDispatcher();
        $dispatcher->dispatch();
    }
}