<?php

namespace App\Services;

class User {


    public function __construct() {

    }

    public static function validate($data) {
        $validationElements = [
            self::validateUsername($data['name']),
            self::validateEmail($data['email']),
            self::validatePassword($data['password'],$data['passwordconfirmation'])
        ];
        foreach($validationElements as $validationElement) {
            if ($validationElement['status'] == 'failed') {
                return $validationElement;
            }
        }
        return true;

    }

    private static function validateUsername($username) {
        if (strlen($username) > 10) {
            return ['status' => 'failed', 'message' => 'Nazwa użytkownika może mieć maksymalnie 10 znaków.'];
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
            return ['status' => 'failed', 'message' => 'Nazwa użytkownika może zawierać tylko litery i cyfry.'];
        }

        return ['status' => 'success', 'message' => 'Udało się'];
    }

    private static function validateEmail($email) {
        $atCount = substr_count($email, '@');

        if ($atCount !== 1) {
            return [
                'status' => 'failed',
                'message' => 'Adres e-mail musi zawierać dokładnie jedną małpę (@).'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Email wygląda poprawnie.'
        ];
    }

    private static function validatePassword($password, $passwordconfirmation) {
        if ($password !== $passwordconfirmation) {
            return [
                'status' => 'failed',
                'message' => 'Hasła nie są zgodne.'
            ];
        }

        return [
            'status' => 'success',
            'message' => 'Hasła są zgodne.'
        ];
    }

}