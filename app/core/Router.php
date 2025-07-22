<?php
namespace App\Core;

class Router {
    private static array $routes = [];

    public static function addRoute(string $method, string $route, array|string $action): void {
        self::$routes[$method][$route] = $action;
    }

    public function get(string $route, array|string $action): void {
        self::addRoute('GET', $route, $action);
    }

    public function post(string $route, array|string $action): void {
        self::addRoute('POST', $route, $action);
    }

    public function getRoutes(): array {
        return self::$routes;
    }
}
