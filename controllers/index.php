<?php

if (isset($_GET['isLogged'])) {
    if (isset($_SESSION['id'])) echo 'true';
    else echo '';

    die();
}

if (isset($_POST['key'])) {
    $key = "%{$_POST['key']}%";
    $loc = "%{$_POST['loc']}%";
    $comp = "%{$_POST['comp']}%";

    require __DIR__ . "/../model/Job.php";
    $result = $job->search([$key, $loc, $comp]);
    $job->close();

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
    die();
}

$notifications = array();
if (isset($_SESSION['id'])) {
    require __DIR__ . '/../model/Notification.php';
    $notifications = $notification->getNotif($_SESSION['id']);
    $notification->close();
}

require __DIR__ . '/../views/index.view.php';
