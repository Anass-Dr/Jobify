<?php

if (isset($_POST['login'])) {
    $username = $_POST['email'];
    $password = $_POST['password'];

    require __DIR__ . '/../model/User.php';
    $result = $user->login($username);

    if ($result) {
        $record = $result[0];
        if (password_verify($password, $record['password'])) {
            $_SESSION['id'] = $record['id'];
            $_SESSION['role'] = $record['role_name'];
            $_SESSION['username'] = $record['username'];
            $path = $record["role_name"] === 'admin' ? 'dashboard' : '';
            header("location:/jobify/{$path}");
            $user->close();
            die();
        }
    } else {
        $user->close();
    }
}



require __DIR__ . '/../views/login.view.php';
