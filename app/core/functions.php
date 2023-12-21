<?php

function base($path)
{
    return __DIR__ . '/../../' . $path;
}

function views($path)
{
    return __DIR__ . '/../../views/' . $path;
}

function dd($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';

    die();
}
