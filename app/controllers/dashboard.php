<?php

$currPath = 'dashboard';

require __DIR__ . '/../model/Job.php';
require __DIR__ . '/../model/User.php';
require __DIR__ . '/../model/App.php';

$job_count = $job->count()["all"];
$open_job_count = $job->count()["open"];
$app_count = $app->count();

$job->close();
$app->close();

require __DIR__ . '/../views/dashboard.view.php';