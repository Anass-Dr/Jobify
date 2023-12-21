<?php

namespace App\controllers;

class ApplicationController
{
    public static function applicationsHTML()
    {
        $currPath = 'app';
        $apps = \App\model\ApplicationModel::fetchAll();

        require views('app.view.php');
    }

    public static function addApplication()
    {
        $userId = $_SESSION['id'];
        $jobId = $_POST['job_id'];

        # Check if exist :
        $result = \App\model\ApplicationModel::isExist($userId, $jobId);

        if (!$result) {
            \App\model\ApplicationModel::add($userId, $jobId);
            echo 'ok';
        }
    }

    public static function updateStatus()
    {
        \App\model\ApplicationModel::updateStatus([$_POST['status'], $_POST['app_id'], $_POST['job_id']]);
    }
}
