<?php
namespace App;

class Dispatcher {
    private string $method;
    private string $uri;
    private array $routes = [];

    public function __construct(string $method, string $uri) {
        
        $this->method = $method;
        $this->uri = rtrim($uri, '/');
       
        if ('' === $this->uri) $this->uri = '/';
    }

    public function setRoutes(array $routes): void {
        $this->routes = $routes;
    }

    public function dispatch() {
        
        foreach ($this->routes[$this->method] ?? [] as $route => $action) {
             
            $pattern = preg_replace('/:[^\/]+/', '([^\/]+)', $route);
            $pattern = '#^' . $pattern . '$#';


            if (preg_match($pattern, $this->uri, $matches)) {
                list($controllerName, $methodName) = explode('@', $action);
                $params = array_slice($matches, 1);
                $controller = new $controllerName();
                return call_user_func_array([$controller, $methodName], $params);
            }
        }

        http_response_code(404);
        echo "404";
    }
}
