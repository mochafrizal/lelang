<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<!--To prevent most search engine web crawlers from indexing a page on your site-->
	<meta name="robots" content="noindex">
	<meta name="googlebot" content="noindex">

	<title>Lelang</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css" integrity="sha512-3M00D/rn8n+2ZVXBO9Hib0GKNpkm8MSUU/e2VNthDyBYxKWG+BftNYYcuEjXlyrSO637tidzMBXfE7sQm0INUg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Template CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/components.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/custom.css">
	<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>

</head>

<body class="layout-3">
	<div id="app">
		<div class="main-wrapper container">
			<nav class="navbar navbar-secondary navbar-expand-lg px-4 px-md-0 bg-primary" style="top: 0 !important">
				<div class="container">
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="<?php echo base_url() ?>" class="nav-link text-white"><i class="fas fa-th-large"></i><span>My Brand</span></a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url() ?>web/about_us" class="nav-link text-white"><span>Tentang Kami</span></a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url() ?>web/tnc" class="nav-link text-white"><span>Syarat dan Ketentuan</span></a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url() ?>web/contact" class="nav-link text-white"><span>Hubungi Kami</span></a>
						</li>
						<?php if ($id) { ?>
							<li class="nav-item">
								<a href="<?php echo base_url().$dashboard_route ?>" class="nav-link text-white"><span>Dashboard</span></a>
							</li>
							<li class="nav-item">
								<a href="<?php echo base_url() ?>login/logout" class="nav-link text-white"><span>Logout</span></a>
							</li>
						<?php } else { ?>
							<li class="nav-item">
								<a href="<?php echo base_url() ?>login" class="nav-link text-white"><span>Login</span></a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</nav>