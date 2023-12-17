<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		JobEase
	</title>

	<link rel="stylesheet" href="views/styles/style.css">
    <link rel="stylesheet" href="views/styles/dashboard.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
	<header>


		<nav class="navbar navbar-expand-md navbar-dark">
			<div class="container">
				<!-- Brand/logo -->
				<a class="navbar-brand" href="#">
					<i class="fas fa-code"></i>
					<h1>JobEase &nbsp &nbsp</h1>
				</a>

				<!-- Toggler/collapsibe Button -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- Navbar links -->
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav align-items-center ml-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">Home</a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								language
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">FR</a>
								<a class="dropdown-item" href="#">EN</a>
							</div>
						</li>
						<span class="nav-item active">
							<a class="nav-link" href="#">EN</a>
						</span>
                        <?php if (isset($_SESSION['id'])) : ?>
                            <div class="navbar pr-0 gap-4">
                                <img class="notification mr-3" src="views/img/new.svg" alt="icon">
                                <div class="card new w-auto">
                                    <div class="list-group list-group-light">
                                        <div class="list-group-item px-3 d-flex justify-content-between align-items-center ">
                                            <p class="mt-auto">Notification</p><a href="#"><img src="img/settingsno.svg" alt="icon"></a>
                                        </div>
                                        <div class="list-group-item px-3 d-flex"><img src="img/notif.svg" alt="iconimage">
                                            <div class="card-body">
                                                <h5 class="card-title">Card title</h5>
                                                <p class="card-text mb-3">Some quick example text to build on the card title and make up
                                                    the bulk of the card's content.</p>
                                                <small class="card-text">1  day ago</small>
                                            </div>
                                        </div>
                                        <div class="list-group-item px-3 d-flex"><img src="img/notif.svg" alt="iconimage">
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
                                <div class="name mr-3"><?= $_SESSION['username'] ?></div>
                                <ul class="navbar-nav">
                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-icon pe-md-0 position-relative" data-bs-toggle="dropdown">
                                            <img src="views/img/photo_admin.svg" alt="icon">
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end position-absolute">
                                            <a class="dropdown-item" href="#">Profile</a>
                                            <a class="dropdown-item" href="#">Account Setting</a>
                                            <a class="dropdown-item" href="/jobify/logout">Log out</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?php else : ?>
						<li class="nav-item">
							<a class="nav-link" href="/jobify/login">Login</a>
						</li>
                        <?php endif ?>
					</ul>
				</div>
			</div>
		</nav>
	</header>




	<section class="search">
		<h2>Find Your Dream Job</h2>
		<form class="form-inline">
			<div class="form-group mb-2">
				<input type="text" placeholder="Keywords">
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<input type="text" placeholder="Location">
			</div>
			<div class="form-group mx-sm-3 mb-2">
				<input type="text" placeholder="Company">
			</div>
			<button type="button" class="btn btn-primary mb-2" onclick="search()">Search</button>
		</form>
	</section>

	<!--------------------------  card  --------------------->
	<section class="light">
		<h2 class="text-center py-3">Latest Job Listings</h2>
		<div class="container py-2">

        <div id="results"></div>

<!--            Bootstrap Modal :-->
            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                    </div>
                </div>
            </div>

		</div>
	</section>




	<footer>
		<p>© 2023 JobEase </p>
	</footer>

    <script>
        function search () {
            const inputs = document.querySelectorAll('.search input');
            const keyword = inputs[0].value;
            const location = inputs[1].value;
            const company = inputs[2].value;

            const req = new XMLHttpRequest();
            req.open("POST", "/jobify/");
            req.setRequestHeader("content-type", "application/x-www-form-urlencoded");
            req.send(`key=${keyword}&loc=${location}&comp=${company}`);
            req.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById('results').innerHTML = req.response;
                }
            }
        }
        search();

        function apply (job_id) {
            const req = new XMLHttpRequest();
            req.open('GET', '/jobify/?isLogged');
            req.send();
            req.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    if (this.responseText) {
                        addOffer(job_id);
                    }
                    else window.location.replace('/jobify/login');
                }
            }
        }

        function addOffer (job_id) {
            const req = new XMLHttpRequest();
            req.open('POST', 'controllers/addOffer.php');
            req.setRequestHeader('content-type', 'application/x-www-form-urlencoded');
            req.send(`job_id=${job_id}`);
            req.onreadystatechange = function () {
                let msg;
                if (this.readyState === 4 && this.status === 200) {
                   msg = this.response ? 'Offer added successfully' : 'Offer already exist';
                }
                document.querySelector('.modal-body').textContent = msg;
                $('#modal').modal('show');
            }
        }
    </script>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<script src="scripts/dashboard.js"></script>
<script src="scripts/script.js"></script>

</html>