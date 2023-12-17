<?php

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $values = [$name, $email, password_hash($password, PASSWORD_DEFAULT)];

    require  __DIR__ . '/../model/User.php';
    $user->register($values);

    header('location:/jobify/');
    die();
}

require __DIR__ . '/../views/register.view.php';
