<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- <link rel="apple-touch-icon" sizes="76x76" href="<?php echo URLROOT ?> ./dashboard/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="<?php echo URLROOT ?> ./dashboard/assets/img/favicon.png"> -->
	<title>
		<?php echo SITENAME ?>
	</title>
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<!-- Nucleo Icons -->
	<link href="<?php echo URLROOT ?> ./dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
	<link href=" <?php echo URLROOT ?> ./dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
	<!-- Font Awesome Icons -->
	<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
	<link href="<?php echo URLROOT ?> ./dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
	<!-- CSS Files -->
	<link id="pagestyle" href="<?php echo URLROOT ?> ./dashboard/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
	<style>
		.loader {
			background: white;
			/* opacity: 0.3; */
			height: 100vh;
			width: 100%;
			position: fixed;
			z-index: 100;
			display: none;
		}

		.log {
			background: url('<?php echo URLROOT ?>/images/loader.gif') no-repeat center center;
			background-size: 25%;
			position: fixed;
			z-index: 110;
			display: block;
			height: 100vh;
			width: 100%;
			display: none;
		}
	</style>
</head>

<body class="g-sidenav-show   bg-gray-100">
	<div class="loader"></div>
	<div class="log"></div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>
		function ll() {
			document.addEventListener('DOMContentLoaded', function() {
				document.querySelector(".lift").style.display = "block";
				document.querySelector(".loader").style.display = "none";
				document.querySelector(".log").style.display = "none";
			}, false);
			$('#createCourse').modal('hide');
			$('#editmodel').modal('hide');
			$('#video-modal').modal('hide');
			$('#reomveVidModal').modal('hide');
			$('#editVidModal').modal('hide');
			$('#addVideo').modal('hide');
			$('#reomveCateModal').modal('hide');
			$('#editCateModal').modal('hide');

			document.querySelector(".loader").style.display = "block";
			document.querySelector(".log").style.display = "block";
			document.querySelector(".lift").style.display = "none";
		}
		ll();
	</script>
	<div class="min-height-300 bg-primary position-absolute w-100"></div>
	<aside class="lift sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
		<div class="sidenav-header">
			<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
			<a class="navbar-brand m-0">
				<!-- <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo"> -->
				<span class="ms-1 font-weight-bold"><?php echo SITENAME ?></span>
			</a>
		</div>
		<hr class="horizontal dark mt-0">
		<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link active" href="<?php echo URLROOT ?>/Instructors">
						<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">Dashboard</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link " href="<?php echo URLROOT ?>/Instructors/myCourses">
						<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
							<i class="ni ni-html5 text-warning text-sm opacity-10"></i>
						</div>
						<span class="nav-link-text ms-1">My Courses</span>
					</a>
				</li>

			</ul>
		</div>
		<div class="sidenav-footer mx-3 mt-5 ">

			<a href="<?php echo URLROOT ?>" class="btn btn-dark btn-sm w-100 mb-3">Home</a>
			<a href="<?php echo URLROOT ?>/users/logout" class="btn btn-primary btn-sm w-100 mb-3">Logout</a>
		</div>
	</aside>
	<main class="main-content position-relative border-radius-lg ">
		<!-- Navbar -->
		<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
			<div class="container-fluid py-1 px-3">
				<nav aria-label="breadcrumb">
					<h6 class="font-weight-bolder text-white mb-0">Instructor Dashboard</h6>
					<span class="breadcrumb-item text-sm opacity-5 text-white"><?php echo $_SESSION['user_name'] ?></span>
				</nav>

			</div>
		</nav>
		<!-- End Navbar -->
		<div class="container-fluid py-4">