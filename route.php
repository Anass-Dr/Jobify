<?php

session_start();

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$publicRoutes = [
    "/jobify/" => 'controllers/index.php',
    "/jobify/login" => 'controllers/login.php',
    "/jobify/register" => 'controllers/register.php',
];

$privateRoutes = [
    "candidat" => [
        "/jobify/" => 'controllers/index.php',
        "/jobify/logout" => 'controllers/logout.php',
    ],
    "admin" => [
        "/jobify/dashboard" => 'controllers/dashboard.php',
        "/jobify/candidat" => 'controllers/candidat.php',
        "/jobify/job" => 'controllers/job.php',
        "/jobify/application" => 'controllers/app.php',
        "/jobify/logout" => 'controllers/logout.php',
    ],
];


if (isset($_SESSION['id'])) {
    $role = $_SESSION['role'];
    if (array_key_exists($uri, $privateRoutes[$role])) require $privateRoutes[$role][$uri];
    else require array_values($privateRoutes[$role])[0];
} else {
    if (array_key_exists($uri, $publicRoutes)) require $publicRoutes[$uri];
    else require $publicRoutes['/jobify/login'];
}

