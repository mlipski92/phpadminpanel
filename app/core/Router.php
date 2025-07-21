<?php
namespace App\Core;

class Router {
    private static array $routes = [];

    // Zmieniamy typ $action na string|array
    public static function addRoute(string $method, string $route, array|string $action): void {
        self::$routes[$method][$route] = $action;
    }

    public function get(string $route, array|string $action): void {
        self::addRoute('GET', $route, $action);
    }

    public function getRoutes(): array {
        return self::$routes;
    }
}
