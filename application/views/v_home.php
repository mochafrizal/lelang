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

			<!-- Main Content -->
			<div class="main-content pt-5 mt-5">
				<section class="section">
					<div class="section-header justify-content-center">
						<img src="<?php echo base_url() ?>assets/header.png" class="img-fluid" style="max-height: 500px">
					</div>

					<div class="section-body">
						<div class="card">
							<div class="card-header justify-content-center">
								<h4>Daftar Barang Lelang</h4>
							</div>
							<!-- /.card-header -->
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<form action="#">
											<div class="form-group mb-0">
												<div class="row justify-content-end">
													<div class="col-10 text-right">
														<input class="form-control" type="search" name="nama" placeholder="Search" aria-label="Search">
													</div>
													<div class="col-2 text-right">
														<button class="btn btn-primary btn-block" type="submit">
															<i class="fas fa-search"></i>
														</button>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<?php echo $this->session->flashdata('pesan') ?>
									</div>
								</div>
								<table class="table table-sm table-hover">
									<thead>
										<tr>
											<th style="width: 10px">#</th>
											<th width="100px">Foto</th>
											<th width="15%">Pelelang</th>
											<th class="table-fit">Kode</th>
											<th>Nama Barang</th>
											<th class="table-fit">Tanggal Tutup</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($barang as $item) {
										?>
											<tr>
												<td><?= $no++ ?></td>
												<td><img src="<?= base_url('assets/photos/' . $item->photo) ?>" alt="" class="img-fluid"></td>
												<td><?= $item->fullname ?></td>
												<td class="table-fit"><?= $item->code ?></td>
												<td><?= $item->name ?></td>
												<td class="table-fit"><?= $item->close_date ?></td>
											</tr>
										<?php
										}
										?>
									</tbody>
								</table>
							</div>
							<!-- /.card-body -->	

						</div>
					</div>
				</section>
			</div>
		</div>
	</div>

	<script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/jquery.nicescroll.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/moment.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/stisla.js"></script>
	<script src="<?php echo base_url() ?>assets/js/select2.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/daterangepicker.js"></script>
	<script src="<?php echo base_url() ?>assets/js/ckeditor.js"></script>
	<script src="<?php echo base_url() ?>assets/js/moment-with-locales.js"></script>
	<script src="<?php echo base_url() ?>assets/js/sweetalert.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/cleave.min.js"></script>
</body>

</html>