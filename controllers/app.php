<?php

$currPath = 'app';

require __DIR__ . '/../model/App.php';

if (isset($_POST['app_id'])) {
    $app->update([$_POST['status'], $_POST['app_id'], $_POST['job_id']]);
    $app->close();
    die();
}

$apps = $app->show();
$app->close();

require __DIR__ . '/../views/app.view.php';