<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Services\Routes;
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$viewsLoader = new FilesystemLoader(__DIR__ . '/App/Views');
$twig = new Environment($viewsLoader);

$routes = new Routes($twig);
$routes->initRoutes();