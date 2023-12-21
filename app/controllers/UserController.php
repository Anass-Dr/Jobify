<?php

namespace App\controllers;

class UserController
{
    public static function home()
    {
        $notifications = array();
        if (isset($_SESSION['id'])) $notifications = \App\model\Notification::getNotif($_SESSION['id']);

        require views('index.view.php');
    }

    public static function isLogin()
    {
        if (isset($_SESSION['id'])) echo 'true';
    }

    public static function search()
    {
        $key = "%{$_POST['key']}%";
        $loc = "%{$_POST['loc']}%";
        $comp = "%{$_POST['comp']}%";

        $result = \App\model\Job::search([$key, $loc, $comp]);

        foreach ($result as $record) : ?>

            <article class="postcard light green">
                <a class="postcard__img_link" href="#">
                    <img class="postcard__img" src="views/img/<?= $record['image_path'] ?>" alt="Image Title" />
                </a>
                <div class="postcard__text t-dark">
                    <h3 class="postcard__title green"><a href="#"><?= $record['title'] ?></a></h3>
                    <div class="postcard__subtitle small">
                        <time datetime="2020-05-25 12:00:00">
                            <i class="fas fa-calendar-alt mr-2"></i><?= $record['date_created'] ?>
                        </time>
                    </div>
                    <div class="postcard__bar"></div>
                    <div class="postcard__preview-txt"><?= $record['description'] ?></div>
                    <ul class="postcard__tagbox">
                        <li class="tag__item"><i class="fas fa-tag mr-2"></i><?= $record['location'] ?></li>
                        <li class="tag__item"><i class="fas fa-clock mr-2"></i>55 mins.</li>
                        <?php if ($record['app_status'] === 'approved' || $record['app_status'] === 'not approved') : ?>
                            <li class="tag__item play bg-info">Approved</li>
                        <?php else : ?>
                            <li class="tag__item play green" onclick="apply(<?= $record['job_id'] ?>)">
                                Apply Now
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
            </article>

<?php endforeach;
    }
}
