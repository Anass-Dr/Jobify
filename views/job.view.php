<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/dashboard.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="wrapper">
        <?php require 'partials/sidebar.php' ?>
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
                                    <small class="card-text">1 day ago</small>
                                </div>
                            </div>
                            <div class="list-group-item px-3 d-flex"><img src="views/img/notif.svg" alt="iconimage">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                        the bulk of the card's content.</p>
                                    <small class="card-text">1 day ago</small>
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
                                <a class="dropdown-item" href="/logout">Log out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <section class="Agents px-4">
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#jobModal">Add Job</button>
                <table class="agent table align-middle bg-white" style="min-width: 700px;">
                    <thead class="bg-light">
                        <tr>
                            <th>Job Title</th>
                            <th>description</th>
                            <th>company</th>
                            <th>location</th>
                            <th>status</th>
                            <th>date created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jobs as $key => $record) : ?>
                            <tr class="freelancer">
                                <input type="hidden" class="jobId" value="<?= $record['job_id'] ?>">
                                <input type="hidden" class="img_path" value="<?= $record['image_path'] ?>">
                                <td>
                                    <?= $record['title'] ?>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1 f_title"><?= $record['description'] ?></p>

                                </td>
                                <td class="f_position"><?= $record['company'] ?></td>
                                <td class="f_position"><?= $record['location'] ?></td>
                                <td class="f_position">
                                    <?= $record['status'] ?>
                                </td>
                                <td class="f_position"><?= $record['date_created'] ?></td>
                                <td>
                                    <form action="/removeJob" method="post">
                                        <input type="hidden" name="job_id" value="<?= $record['job_id'] ?>">
                                        <button type="submit" name="delete">
                                            <img class="delet_user" src="views/img/user-x.svg" alt="">
                                        </button>
                                    </form>
                                    <button type="submit" name="update" data-bs-toggle="modal" data-bs-target="#jobModal" onclick="loadData(event)">
                                        <img class="ms-2 edit" src="views/img/edit.svg" alt="">
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- Modal -->
                <div class="modal fade" id="jobModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="resetModal()"></button>
                            </div>
                            <form action="/updateJob" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Job title</label>
                                        <input type="text" name="title" class="form-control" id="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="desc" class="form-label">Description</label>
                                        <textarea id="desc" name="desc" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="company" class="form-label">Company</label>
                                        <input type="text" name="comp" class="form-control" id="company">
                                    </div>
                                    <div class="mb-3">
                                        <label for="location" class="form-label">Location</label>
                                        <input type="text" name="loc" class="form-control" id="location">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status1" class="form-label">Status</label>
                                        <select name="status" class="form-control" id="status1">
                                            <option value="open">Open</option>
                                            <option value="closed">Closed</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jobImg" class="form-label">Job Image</label>
                                        <input type="file" name="jobImg" class="form-control" id="jobImg">
                                    </div>
                                    <input id="jobId" type="hidden" name="job_id">
                                    <input id="method" type="hidden" name="method" value="add">
                                    <input id="imgPath" type="hidden" name="imgPath">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="resetModal()">Close</button>
                                    <button type="submit" name="update" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap Toast :-->
                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header">
                            <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <rect width="100%" height="100%" fill="#007aff"></rect>
                            </svg>
                            <strong class="me-auto">Info</strong>
                            <small>Just now</small>
                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                        <div class="toast-body <?php if (!empty($errors)) echo 'active' ?>">
                            <?php foreach ($errors as $err) echo $err ?>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="views/scripts/dashboard.js"></script>
    <script>
        $(document).ready(function() {
            if ($(".toast-body").hasClass('active')) {
                $('.toast').toast('show');
            }
        });

        function loadData(e) {
            console.log('working')
            const tableTds = e.currentTarget.closest('tr').querySelectorAll('td');
            document.getElementById('jobModal').querySelectorAll('.form-control').forEach((input, idx, arr) => {
                if (idx === arr.length - 1) return;
                input.value = tableTds[idx].textContent.trim()
            });
            document.getElementById('method').value = 'update';
            console.log(document.getElementById('method').value)
            document.getElementById('jobId').value = e.currentTarget.closest('tr').querySelector('.jobId').value
            document.getElementById('imgPath').value = e.currentTarget.closest('tr').querySelector('.img_path').value;
        }

        function resetModal() {
            document.getElementById('method').value = 'add';
            document.getElementById('jobModal').querySelectorAll('.form-control').forEach((input) => input.value = '');
        }
    </script>
</body>

</html>