<?php

$currPath = 'job';

require __DIR__ . '/../model/Job.php';

if (isset($_POST['delete'])) {
    $job_id = $_POST['job_id'];

    $job->delete($job_id);
}

$errors = array();
if (isset($_POST['update'])) {
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
        $_POST['method'] == 'add' ? $job->add($_POST, $img_path) : $job->update($_POST, $img_path);
    else :
        echo 'work4';
        $errors = $upload_result['err'];
    endif;
}

$jobs = $job->show();
$job->close();

require __DIR__ . '/../views/job.view.php';
