<?php

namespace App\Pantheon\Router;

class Route
{
    private static array $routesGET = [];

    public static function get(string $path, array $controller) : RouteContainer
    {
        $routeContainer = new RouteContainer($path, $controller[0], $controller[1]);
        self::$routesGET[] = $routeContainer;
        return $routeContainer;
    }
}