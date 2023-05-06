<?php

namespace App\Pantheon\Router;

class RouteContainer
{
    private string $route;
    private string $controller;
    private string $method;
    private string $name;
    private string $middleware;

    /**
     * @param string $route
     * @param string $controller
     * @param string $method
     */
    public function __construct(string $route, string $controller, string $method)
    {
        $this->route = $route;
        $this->controller = $controller;
        $this->method = $method;
    }

    /**
     * @param string $name
     */
    public function name(string $name) : RouteContainer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $middleware
     */
    public function middleware(string $middleware) : RouteContainer
    {
        $this->middleware = $middleware;
        return $this;
    }
}