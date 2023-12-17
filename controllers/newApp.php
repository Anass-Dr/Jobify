<?php

if (isset($_POST['job_id'])) {
    $userId = $_SESSION['id'];
    $jobId = $_POST['job_id'];

    # Check if exist :
    require __DIR__ . '/../model/App.php';
    $result = $app->check($userId, $jobId);

    if (!$result) {
        $app->add($userId, $jobId);
        echo 'ok';
    }

    $app->close();
}