<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/photos/ReminExlogolink3.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>Reminex Faculty</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="css/collapse.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          <span class="align-middle"><img src="img/photos/loginlogo3.png" 
										alt="Company Name"
										width="200"></span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="index.html">
							<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
							</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="proctorsub.html">
							<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Proctor Subject</span>
						</a>
					</li>

					<li class="sidebar-header">
						Request
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="managenewsched.html">
							<i class="align-middle" data-feather="edit-3"></i> <span class="align-middle">Manage New Schedule</span>
						</a>
					</li>

				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
								<div class="position-relative">
									<i class="align-middle" data-feather="bell"></i>
									<span class="indicator">4</span>
								</div>
							</a>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
								<div class="dropdown-menu-header">
									4 New Notifications
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-danger" data-feather="alert-circle"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Update completed</div>
												<div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
												<div class="text-muted small mt-1">30m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-warning" data-feather="bell"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Lorem ipsum</div>
												<div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-primary" data-feather="home"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">Login from 192.186.1.8</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<i class="text-success" data-feather="user-plus"></i>
											</div>
											<div class="col-10">
												<div class="text-dark">New connection</div>
												<div class="text-muted small mt-1">Christina accepted your request.</div>
												<div class="text-muted small mt-1">14h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all notifications</a>
								</div>
							</div>
						</li>
						
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="img/avatars/basan.png" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">Gian Rogel Basan</span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="info"></i> About Us</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Manage<strong> New Schedule</strong></h1>

					<div class="row">
						<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-body">					
									<label for="request"><strong>Your Student Requests </strong></label><br><br>
									<form action="#" method="#">
											<button type="button" class="collapsible">Basan, Gian Rogel Y. <span class="badge bg-success">OK</span></button>
												<div class="content2"><br>
													<label for="request"><strong>Request Type: &nbsp;</strong></label><label for="request"> Reschedule Request</label><br>
													<label for="request"><strong>Subject to Take:  &nbsp;</strong></label><label for="request"> Event-Driven Programming</label><br>
													<label for="request"><strong>Instructor:  &nbsp;</strong></label><label for="request"> Mr. Elbert Gumban</label><br>
													<label for="request"><strong>Time Availability:  &nbsp;</strong></label><label for="request"> 10:00 AM - 12:00 PM</label><br><br>
													<input type="submit" class="btn btn-warning btn-lg" id="createSched" value="Create New Schedule"><br><br>
												</div>
									</form>
									<form action="#" method="#">
											<button type="button" class="collapsible">Degamo, Maedy Luna E.</button>
												<div class="content2"><br>
													<label for="request"><strong>Request Type: &nbsp;</strong></label><label for="request" id="studName"> Reschedule Request</label><br>
													<label for="request"><strong>Subject to Take:  &nbsp;</strong></label><label for="request"> Event-Driven Programming</label><br>
													<label for="request"><strong>Instructor:  &nbsp;</strong></label><label for="request"> Mr. Elbert Gumban</label><br>
													<label for="request"><strong>Time Availability:  &nbsp;</strong></label><label for="request"> 10:00 AM - 12:00 PM</label><br><br>
													<input type="submit" class="btn btn-warning btn-lg" id="createSched" value="Create New Schedule"><br><br>
												</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-6">
							<div class="card">
								<div class="card-body">
									<form action="#" method="#">
										<label for="request"><h1 class="h3 d-inline align-middle">New Schedule</h1></label><br><br>
													<label for="request"><strong>Name: &nbsp;</strong></label><label for="request"> </label><br>
													<label for="request"><strong>Subject to Take:  &nbsp;</strong></label><label for="request"> </label><br>
													<label for="request"><strong>Instructor:  &nbsp;</strong></label><label for="request"> </label><br>
													<label for="request"><strong>Exam Day Schedule:  &nbsp;</strong></label><br>
													<input type="text" class="form-control" placeholder="Ex. September 9, 2023"><br>
													<label for="request"><strong>Exam Time Schedule:  &nbsp;</strong></label><br>
													<input type="text" class="form-control" placeholder="Ex. 10:00 AM - 11:00 AM"><br>
													<input type="submit" class="btn btn-warning btn-lg" id="createSched" value="Submit Schedule"><br><br>
												</div>
									</form>
								</div>
							</div>
						</div>				
					</div>

				</div>
			</main>

			<!-- <footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a>								&copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer> -->
		</div>
	</div>

	<script src="js/app.js"></script>
	<script src="js/collapse.js"></script>

	

</body>

</html>