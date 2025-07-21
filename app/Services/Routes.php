<?php

namespace App\Services;

use App\Controllers\DefaultController;
use App\Core\RouteDispatcher;
use App\Core\Router;
use Dotenv\Dotenv;

class Routes {
    public function initRoutes() {

        $basePath = $_ENV['BASE_PATH'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $cleanUri = substr($uri, strlen($basePath));

        $router = new Router();
        $router->get('/', [DefaultController::class, 'index']);

        $dispatcher = new RouteDispatcher($_SERVER['REQUEST_METHOD'], $cleanUri);
        $dispatcher->setRoutes($router->getRoutes());
        $dispatcher->dispatch();
    }
}