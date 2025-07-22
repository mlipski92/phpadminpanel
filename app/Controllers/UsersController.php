<?php

namespace App\Controllers;

use App\Model\UserModel;
use App\Repository\UserRepository;
use App\Services\User;
use Twig\Environment;

class UsersController {
    protected $twig;
    protected $user;
    protected $userService;
    public function __construct(Environment $twig, User $userService) {
        $this->twig = $twig;
        $this->userService = $userService;
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
    }

    public function getin() {
        $data = $_POST;

        $userModel = new UserModel($data['email'], '', $data['password']);

        $repo = new UserRepository();
        $result = $repo->checkUser($userModel);

        if ($result['status'] === 'failed') {
            echo $result['message'];
            exit;
        }

        $userService = new User();
        $userService->createSession($result);
        \App\Services\MessageService::set('error', 'Zalogowano');
        header('Location: /adminpanel');
        exit;
    }

    public function getout() {
        $userService = new User();
        $userService->destroySession();


        // session_start();
        // \App\Services\MessageService::set('error', 'Wylogowano');
        header('Location: /adminpanel');
        exit;
    }


}