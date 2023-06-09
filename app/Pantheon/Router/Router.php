<?php

namespace App\Pantheon\Router;

class Router
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
     * @param string $name
     * @return string|null
     */
    public static function getRouteByName(string $name): null|RouteContainer
    {
        foreach (self::$routes as $route) {
            if ($route->getName() === $name) {
                return $route;
            }
        }

        return null;
    }

    /**
     * @return array
     */
    public static function getRoutes() : array
    {
        return self::$routes;
    }
}