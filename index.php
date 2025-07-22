<?php

use App\Services\User;
session_start();

require_once __DIR__ . '/vendor/autoload.php';

use App\Services\Dbconnect;
use App\Services\Routes;
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$database = new Dbconnect();
$database->dbConnect();

$viewsLoader = new FilesystemLoader(__DIR__ . '/App/Views');
$twig = new Environment($viewsLoader);

$userService = new User();

$routes = new Routes($twig, $userService);
$routes->initRoutes();