<?php

namespace App\Pantheon\Router;

class RouteContainer
{
    private string $link;
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
    public function __construct(string $link, string $controller, string $method, string $httpMethod)
    {
        $this->link = $link;
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
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getMiddleware() : string
    {
        return $this->middleware;
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
    public function getLink() : string
    {
        return $this->link;
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