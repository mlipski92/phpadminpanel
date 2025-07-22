<?php

namespace App\Controllers;

use App\Services\User;
use Twig\Environment;


class DefaultController {
    protected $twig;
    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function index() {
        $userService = new User();
        // var_dump($userService->checkSession());
        echo $this->twig->render('home.html.twig', ['name' => $userService->checkSession()]);
    }


    
}