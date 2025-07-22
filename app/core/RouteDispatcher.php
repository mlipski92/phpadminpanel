<?php
namespace App\Core;

use App\Services\User;
use Twig\Environment;

class RouteDispatcher {
    private string $method;
    private string $uri;
    private array $routes = [];
    private $userService;
    private Environment $twig;

    public function __construct(string $method, string $uri, Environment $twig, User $userService) {
        $this->method = $method;
        $this->uri = rtrim($uri, '/');
        $this->twig = $twig;
        $this->userService = $userService;

        if ('' === $this->uri) {
            $this->uri = '/';
        }
    }

    public function setRoutes(array $routes): void {
        $this->routes = $routes;
    }

    public function dispatch() {
        foreach ($this->routes[$this->method] ?? [] as $route => $action) {

            $pattern = preg_replace('/:[^\/]+/', '([^\/]+)', $route);
            $pattern = '#^' . $pattern . '$#';

            if (preg_match($pattern, $this->uri, $matches)) {
                $params = array_slice($matches, 1);

                if (is_array($action) && count($action) === 2) {
                    [$controllerName, $methodName] = $action;

                    if (class_exists($controllerName)) {
                        $controller = new $controllerName($this->twig, $this->userService);

                        if (method_exists($controller, $methodName)) {
                            return call_user_func_array([$controller, $methodName], $params);
                        } else {
                            http_response_code(500);
                            echo "Method $methodName not found in controller $controllerName.";
                            return;
                        }
                    } else {
                        http_response_code(500);
                        echo "Controller class $controllerName not found.";
                        return;
                    }
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
