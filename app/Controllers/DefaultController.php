<?php

namespace App\Controllers;

use Twig\Environment;


class DefaultController {
    protected $twig;
    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function index() {
        echo $this->twig->render('home.html.twig', ['name' => 'Mateusz']);
    }


    
}