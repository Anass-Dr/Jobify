<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="views/styles/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<div class="wrapper">
    <?php require 'partials/sidebar.php'?>
    <div class="main">
        <nav class="navbar justify-content-space-between pe-4 ps-2">
            <button class="btn open">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar  gap-4">
                <div class="">
                    <input type="search" class="search " placeholder="Search">
                    <img class="search_icon" src="views/img/search.svg" alt="iconicon">
                </div>
                <!-- <img src="views/img/search.svg" alt="icon"> -->
                <img class="notification" src="views/img/new.svg" alt="icon">
                <div class="card new w-auto">
                    <div class="list-group list-group-light">
                        <div class="list-group-item px-3 d-flex justify-content-between align-items-center ">
                            <p class="mt-auto">Notification</p><a href="#"><img src="views/img/settingsno.svg" alt="icon"></a>
                        </div>
                        <div class="list-group-item px-3 d-flex"><img src="views/img/notif.svg" alt="iconimage">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                    the bulk of the card's content.</p>
                                <small class="card-text">1  day ago</small>
                            </div>
                        </div>
                        <div class="list-group-item px-3 d-flex"><img src="views/img/notif.svg" alt="iconimage">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                    the bulk of the card's content.</p>
                                <small class="card-text">1  day ago</small>
                            </div>
                        </div>
                        <div class="list-group-item px-3 text-center"><a href="#">View all notifications</a></div>
                    </div>
                </div>
                <div class="inline"></div>
                <div class="name"> Admin</div>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-icon pe-md-0 position-relative" data-bs-toggle="dropdown">
                            <img src="views/img/photo_admin.svg" alt="icon">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end position-absolute">
                            <a class="dropdown-item" href="#">Profile</a>
                            <a class="dropdown-item" href="#">Account Setting</a>
                            <a class="dropdown-item" href="/PeoplePerTask/project/pages/index.html">Log out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <section class="Agents px-4">
            <table class="agent table align-middle bg-white" style="min-width: 700px;">
                <thead class="bg-light">
                <tr>
                    <th>Name Candidat</th>
                    <th>Job Title</th>
                    <th>description</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($apps as $record) : ?>
                    <tr class="freelancer">
                        <input type="hidden" class="jobId" value="<?= $record['job_id'] ?>">
                        <input type="hidden" class="appId" value="<?= $record['id'] ?>">
                        <td>
                            <div class="d-flex align-items-center">

                                <div class="ms-3">
                                    <p class="fw-bold mb-1 f_name"><?= $record['username'] ?></p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <?= $record['title'] ?>
                        </td>
                        <td>
                            <p class="fw-normal mb-1 f_title"><?= $record['description'] ?></p>

                        </td>
                        <td class="f_position"><?= $record['status'] ?></td>
                        <td>
                            <select name="status" id="status" onchange="update(event)">
                                <option value="approved" <?php if ($record['status'] == 'approved') echo 'selected' ?>>Approved</option>
                                <option value="not approved" <?php if ($record['status'] == 'not approved') echo 'selected' ?>>Not Approved</option>
                                <option value="in progress" <?php if ($record['status'] == 'in progress') echo 'selected' ?>>In Progress</option>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<script src="views/scripts/dashboard.js"></script>
<script>
    function update (e) {
        const appId = e.currentTarget.closest('tr').querySelector('.appId').value;
        const jobId = e.currentTarget.closest('tr').querySelector('.jobId').value;
        const req = new XMLHttpRequest();
        req.open("post", "/jobify/application");
        req.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
        req.send(`app_id=${appId}&status=${e.currentTarget.value}&job_id=${jobId}}`);
    }
</script>
</body>

</html>