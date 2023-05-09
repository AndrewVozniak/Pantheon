<?php

namespace App\Pantheon\Router;

use Exception;

class RouteDispatcher
{
    private array $possibleRoutes = [];
    private object $currentRoute;

    /** Dispatch routes
     *
     * @return void
     * @throws Exception
     */
    public function dispatch() : void
    {
        $routes = Router::getRoutes();

        foreach ($routes as $route) {
            if($currentRoute = $this->absoluteCompare($routes, $_SERVER['REQUEST_URI'])) {
                if($this->httpMethodCompare($currentRoute->getHttpMethod())) {
                    $this->run($currentRoute->getController(), $currentRoute->getMethod(), []);
                    break;
                }
            }
        }
    }

    /**
     * @param string $controller
     * @param string $methodName
     * @param array $params
     * @return void
     */
    private function run(string $controller, string $methodName) : void
    {
        $controllerInstance = new $controller();
        $controllerInstance->$methodName();
    }

    /**
     * @param string $httpMethod
     * @return boolean
     * @throws Exception
     */
    private function httpMethodCompare(string $httpMethod) : bool
    {
        if ($_SERVER['REQUEST_METHOD'] !== $httpMethod) {
            throw new Exception("HTTP method is not equal. Needed: $httpMethod");
        } else {
            return true;
        }
    }

    /**
     * @param array $routes
     * @param string $currentURI
     * @return object|false
     */
    private function absoluteCompare(array $routes, string $currentURI) : object | false
    {
        foreach ($routes as $route) {
            if ($route->getRoute() === parse_url($_SERVER['REQUEST_URI'])['path']) {
                return $route;
            }
        }

        return false;
    }
}