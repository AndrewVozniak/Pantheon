<?php

namespace App\Pantheon\Router;

class Route
{
    private static array $routes = [];

    /**
     * @param string $path
     * @param array $controller
     * @return RouteContainer
     */
    public static function get(string $path, array $controller) : RouteContainer
    {
        $routeContainer = new RouteContainer($path, $controller[0], $controller[1], 'GET');
        self::$routes[] = $routeContainer;
        return $routeContainer;
    }

    /**
     * @param string $path
     * @param array $controller
     * @return RouteContainer
     */
    public static function post(string $path, array $controller) : RouteContainer
    {
        $routeContainer = new RouteContainer($path, $controller[0], $controller[1], 'POST');
        self::$routes[] = $routeContainer;
        return $routeContainer;
    }

    /**
     * @param string $path
     * @param array $controller
     * @return RouteContainer
     */
    public static function put(string $path, array $controller) : RouteContainer
    {
        $routeContainer = new RouteContainer($path, $controller[0], $controller[1], 'PUT');
        self::$routes[] = $routeContainer;
        return $routeContainer;
    }

    /**
     * @param string $path
     * @param array $controller
     * @return RouteContainer
     */
    public static function delete(string $path, array $controller) : RouteContainer
    {
        $routeContainer = new RouteContainer($path, $controller[0], $controller[1], 'DELETE');
        self::$routes[] = $routeContainer;
        return $routeContainer;
    }

    /**
     * @return array
     */
    public static function getRoutes() : array
    {
        return self::$routes;
    }
}