<?php

namespace App\Services;

use App\Controllers\DefaultController;
use App\Core\RouteDispatcher;
use App\Core\Router;
use Dotenv\Dotenv;
use Twig\Environment;

class Routes {
    private Environment $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }
    public function initRoutes() {

        $basePath = $_ENV['BASE_PATH'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $cleanUri = substr($uri, strlen($basePath));

        $router = new Router();
        $router->get('/', [DefaultController::class, 'index']);
        $router->get('/login', [DefaultController::class, 'login']);
        $router->get('/register', [DefaultController::class, 'register']);

        $dispatcher = new RouteDispatcher($_SERVER['REQUEST_METHOD'], $cleanUri, $this->twig);
        $dispatcher->setRoutes($router->getRoutes());
        $dispatcher->dispatch();
    }
}