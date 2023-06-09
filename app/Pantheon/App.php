<?php

namespace App\Pantheon;

use App\Pantheon\Router\RouteDispatcher;

/**
 * App class
 */
class App
{
    /**
     * @return void
     */
    public static function run() : void
    {
        // Check routes
        try {
            $dispatcher = new RouteDispatcher();
            $dispatcher->dispatch();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}