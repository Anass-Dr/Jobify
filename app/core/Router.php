<?php

namespace App\core;

class Router
{
    protected array $routes = [];

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $position = strpos($_SERVER['REQUEST_URI'], '?');
        $path = $position === false ? $_SERVER['REQUEST_URI'] : substr($_SERVER['REQUEST_URI'], 0, $position);
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback) :
            echo 'Not Found';
            exit();
        endif;

        $callback();
    }
}
