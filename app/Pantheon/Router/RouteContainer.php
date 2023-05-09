<?php

namespace App\Pantheon\Router;

class RouteContainer
{
    private string $route;
    private string $controller;
    private string $method;
    private string $httpMethod;
    private string $name;
    private string $middleware;

    /**
     * @param string $route
     * @param string $controller
     * @param string $method
     */
    public function __construct(string $route, string $controller, string $method, string $httpMethod)
    {
        $this->route = $route;
        $this->controller = $controller;
        $this->method = $method;
        $this->httpMethod = $httpMethod;
    }

    /**
     * @param string $name
     * @return RouteContainer
     */
    public function setName(string $name) : RouteContainer
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $middleware
     * @return RouteContainer
     */
    public function setMiddleware(string $middleware) : RouteContainer
    {
        $this->middleware = $middleware;
        return $this;
    }

    /**
     * @return string
     */
    public function getHttpMethod() : string
    {
        return $this->httpMethod;
    }

    /**
     * @return string
     */
    public function getRoute() : string
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getController() : string
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }
}