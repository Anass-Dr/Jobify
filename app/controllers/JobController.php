<?php

namespace App\controllers;

class JobController
{
    private array $errors;

    public static function jobsHTML()
    {
        $currPath = 'job';

        $jobs = \App\model\Job::fetchAll();

        $errors = self::$errors;

        require views('job.view.php');
    }

    public static function updateJob()
    {
        $file = $_FILES['jobImg'];
        $img_path = '';

        # If the user upload Img
        if ($file['name']) :
            $upload_result = upload_img($file);
            $img_path = $upload_result['path'];
        else :
            $img_path = $_POST['imgPath'];
        endif;

        #
        if (empty($upload_result['err'])) :
            $_POST['method'] == 'add' ? \App\model\Job::add($_POST, $img_path) : \App\model\Job::update($_POST, $img_path);
        else :
            self::$errors = $upload_result['err'];
        endif;

        self::jobsHTML();
    }

    public static function removeJob()
    {
        $job_id = $_POST['job_id'];

        \App\model\Job::delete($job_id);

        self::jobsHTML();
    }
}
