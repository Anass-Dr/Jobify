<?php

namespace App\controllers;

use App\model\User;

class Authentication
{

    public static function loginHTML()
    {
        require views('login.view.php');
    }

    public static function login()
    {
        $username = $_POST['email'];
        $password = $_POST['password'];

        $result = User::fetchUser($username);

        if ($result) {
            $record = $result[0];
            if (password_verify($password, $record['password'])) {
                $_SESSION['id'] = $record['id'];
                $_SESSION['role'] = $record['role_name'];
                $_SESSION['username'] = $record['username'];
                $path = $record["role_name"] === 'admin' ? '/dashboard' : '/';
                header("location:{$path}");
                die();
            }
        }

        self::loginHTML();
    }

    public static function registerHTML()
    {
        require views('register.view.php');
    }

    public static function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $values = [$name, $email, password_hash($password, PASSWORD_DEFAULT)];

        User::addUser($values);

        header('location:/');
    }

    public static function logout()
    {
        $_SESSION = array();
        session_destroy();

        header('location:/');
    }
}
