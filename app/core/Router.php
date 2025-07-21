<?php
namespace App;

class Router {
    private static array $routes = [];

    public static function addRoute(string $method, string $route, string $action): void {
        self::$routes[$method][$route] = $action;
    }

    public function get(string $route, string $action): void {
        self::addRoute('GET', $route, $action);
    }

    public function getRoutes(): array {
        return self::$routes;
    }
}
