<?php

namespace App\Pantheon\Router;

use App\Pantheon\Router\Route;

class RouteDispatcher
{
    /** Check routes in array
     *
     * @return void
    */
    public function dispatch() : void
    {
        foreach (Route::getRoutes() as $route) {
            $routeLink = $route->getRoute();

            if($this->softCompare($routeLink, $_SERVER['REQUEST_URI'])) {
                $controller = $route->getController();
                $methodName = $route->getMethod();
                $params = $this->getParams($_SERVER['REQUEST_URI'], $routeLink); // '/posts/{id}/{s}'


                if($this->hardCompare($params, $controller, $methodName) && $this->httpMethodCompare($route->getHttpMethod()))
                {
                    $controllerInstance = new $controller();
                    $controllerInstance->$methodName(...array_values($params));
                }
            }
        }
    }

    /**
     * @param string $httpMethod
     * @return bool
     */
    private function httpMethodCompare(string $httpMethod) : bool
    {
        return $_SERVER['REQUEST_METHOD'] === $httpMethod;
    }

    /** Compare params in route with params in controller method
     *
     * @param array $params
     * @param string $controller
     * @param string $methodName
     *
     * @return boolean
     */
    private function hardCompare(array $params, string $controller, string $methodName) : bool
    {
        // Get params of controller
        $reflection = new \ReflectionMethod($controller, $methodName);
        $reflectionParams = $reflection->getParameters();

        if(count($reflectionParams) !== count($params)) {
            throw new \Exception("Count of params in route and controller method is not equal");
        }

        foreach ($reflectionParams as $key => $value) {
            if(!isset($params[$value->getName()])) {
                throw new \Exception("Param " . $value->getName() . " is not set in route");
            }
        }

        return true;
    }


    /** Compare route with current URI and return true or false
     *
     * Example:
     * route: '/posts/{id}'
     * current URI: '/posts/1'
     * return: true
     *
     * @param string $route
     * @param string $currentURI
     *
     * @return bool
    */
    private function softCompare(string $route, string $currentURI) : bool
    {
        $route = explode('/', $route);
        $currentURI = explode('/', $currentURI);

        if(count($route) !== count($currentURI)) {
            return false;
        }

        foreach ($route as $key => $value) {
            if(isset($value[strlen($value) - 1]) and isset($value[0]))
            {
                if($value[0] === '{' && $value[strlen($value) - 1] === '}') {
                    continue;
                }
            }

            if($value !== $currentURI[$key]) {
                return false;
            }
        }

        return true;
    }

    /** Check params in route. Array example: ['id' => 1]
     *
     * @param string $currentURI | Its current URI, like /posts/1
     * @param string $route | Its route from routes\web.php, like /posts/{id}
     * @return array
    */
    private function getParams(string $currentURI, string $route) : array
    {
        $currentURI = explode('/', $currentURI);
        $route = explode('/', $route);

        $params = [];

        foreach ($route as $key => $value) {

            if(isset($value[strlen($value) - 1]) and isset($value[0]))
            {
                if($value[0] === '{' && $value[strlen($value) - 1] === '}') {
                    if(!empty($currentURI[$key])) {
                        $params[trim($value, '{}')] = $currentURI[$key];
                    }
                }
            }
        }

        return $params;
    }
}