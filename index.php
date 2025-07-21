<?php
require_once __DIR__ . '/app/core/Router.php';
require_once __DIR__ . '/app/core/RouteDispatcher.php';
require_once __DIR__ . '/app/Controller/DefaultController.php';

use App\Router;
use App\Dispatcher;

$basePath = '/adminpanel';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$cleanUri = substr($uri, strlen($basePath));

$router = new Router();
$router->get('/', 'DefaultController@index');

$dispatcher = new Dispatcher($_SERVER['REQUEST_METHOD'], $cleanUri);
$dispatcher->setRoutes($router->getRoutes());
$dispatcher->dispatch();
