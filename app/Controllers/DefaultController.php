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
        
        $flash = \App\Services\MessageService::get();
        var_dump($_SESSION); 
        // var_dump($flash);

        echo $this->twig->render('home.html.twig', ['name' => $userService->checkSession(), 'flash' => $flash]);
    }


    
}