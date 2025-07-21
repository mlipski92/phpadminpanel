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
use App\Services\Routes;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$routes = new Routes();
$routes->initRoutes();