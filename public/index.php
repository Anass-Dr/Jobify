<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/core/functions.php';

$app = new App\core\Application();

# Home page :
$app->router->get('/', fn () => App\controllers\UserController::home());
$app->router->post('/search', fn () => App\controllers\UserController::search());
$app->router->get('/islogin', fn () => App\controllers\UserController::isLogin());
$app->router->post('/newApplication', fn () => \App\controllers\ApplicationController::addApplication());

# Authentication :
$app->router->post('/checkEmail', fn () => \App\controllers\Authentication::checkEmail());
$app->router->post('/checkPassword', fn () => \App\controllers\Authentication::checkPassword());
$app->router->get('/login', fn () => App\controllers\Authentication::loginHTML());
$app->router->post('/login', fn () => App\controllers\Authentication::login());
$app->router->get('/register', fn () => App\controllers\Authentication::registerHTML());
$app->router->post('/register', fn () => App\controllers\Authentication::register());
$app->router->get('/logout', fn () => App\controllers\Authentication::logout());

# Application page :
$app->router->get('/application', fn () => App\controllers\ApplicationController::applicationsHTML());
$app->router->post('/application', fn () => App\controllers\ApplicationController::updateStatus());

# Dashboard page :
$app->router->get('/dashboard', fn () => \App\controllers\Dashboard::showStatis());

# Job page :
$app->router->get('/job', fn () => \App\controllers\JobController::jobsHTML());
$app->router->post('/removeJob', fn () => \App\controllers\JobController::removeJob());
$app->router->post('/updateJob', fn () => \App\controllers\JobController::updateJob());

# Not found page :
$app->router->get('/not-found', fn () => \App\controllers\Authentication::notFound());

# Access Denied page :
$app->router->get('/access-denied', fn () => \App\controllers\Authentication::accessDenied());

$app->run();
