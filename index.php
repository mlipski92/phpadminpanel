<?php
require_once __DIR__ . '/vendor/autoload.php';


// require_once __DIR__ . '/app/core/Router.php';
// require_once __DIR__ . '/app/core/RouteDispatcher.php';
// require_once __DIR__ . '/app/Controller/DefaultController.php';

//blad
// require_once __DIR__ . 'vendor/vlucas/phpdotenv/src/Dotenv.php';

// echo $_ENV['APP_NAME']; 
//blad koniec

use App\Core\Router;
use App\Core\RouteDispatcher;
use App\Controllers\DefaultController;

$basePath = '/adminpanel';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$cleanUri = substr($uri, strlen($basePath));

$router = new Router();
$router->get('/', [DefaultController::class, 'index']);

$dispatcher = new RouteDispatcher($_SERVER['REQUEST_METHOD'], $cleanUri);
$dispatcher->setRoutes($router->getRoutes());
$dispatcher->dispatch();
