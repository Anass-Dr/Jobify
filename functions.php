<?php

function dd($arr) : void {
    echo '<pre>';
    var_dump($arr);
    echo '</pre>';
}

function upload_img ($file) : array {
    $errors = [];

    # - Check file size :
    if ($file['size'] > 200000) :
        $errors[] = '<div>File can\'t be more than 2 mb</div>';
    endif;

    # - Check file type :
    $file_ext = explode('/', $file['type'])[0];
    if ($file_ext !== 'image') :
        $errors[] = '<div>Only images are allowed</div>';
    endif;

    # - Upload Image :
    if (empty($errors)) :
        move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/jobify/views/img/' . $file['name']);
    endif;

    return ["err" => $errors, "path" => $file['name']];
}