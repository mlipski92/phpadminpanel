<?php

namespace App\Controllers;

use App\Model\UserModel;
use App\Repository\UserRepository;
use App\Services\User;
use Twig\Environment;

class UsersController {
    protected $twig;
    protected $user;
    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }
    public function login() {
        echo $this->twig->render('login.html.twig');
    }

    public function register() {
        echo $this->twig->render('register.html.twig');
    }
    public function adduser() {
        $data = $_POST;
        $validate = User::validate($data);
        // var_dump($validate);
        if($validate !== true) {
            echo $validate["message"];
            exit;
        }

        $userModel = new UserModel(
            $data['name'],
            $data['email'],
            $data['password']
        );

        $repo = new UserRepository();
        if ($repo->add($userModel)) {
            header('Location: /adminpanel/login');
            exit;
        } else {
            echo "Błąd przy zapisie do bazy.";
            exit;
        }

        // header('Location: /adminpanel/login');
    }
}