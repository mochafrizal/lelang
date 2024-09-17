<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Lelang</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

	<!-- Template CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/components.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/custom.css">
</head>

<body>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row justify-content-center">
					<div class="col-12 col-md-10">
						<div class="card card-primary">
							<div class="card-header">
								<h4>Daftar</h4>
							</div>

							<div class="card-body">
								<form method="POST" action="<?php echo base_url() ?>register/post">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label for="username">Username<span class="text-danger">*</span></label>
												<input id="username" type="text" name="username" class="form-control" name="username" tabindex="1" required autofocus>
											</div>

											<div class="form-group">
												<div class="d-block">
													<label for="password" class="control-label">Password<span class="text-danger">*</span></label>
												</div>
												<input id="password" type="password" name="password" class="form-control" name="password" tabindex="2" required>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="name">Nama Lengkap<span class="text-danger">*</span></label>
												<input id="name" type="text" name="name" class="form-control" name="username" required autofocus>
											</div>
											<div class="form-group">
												<label for="phone">Nomor Telepon<span class="text-danger">*</span></label>
												<input id="phone" class="form-control" name="phone" value="">
											</div>
											<div class="form-group">
												<label>Alamat<span class="text-danger">*</span></label>
												<textarea style="height: auto;" class="form-control" name="address" value="" row="4"></textarea>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label>Nomor Rekening<span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="account_number">
											</div>
											<div class="form-group">
												<label>Atas Nama<span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="account_name">
											</div>
											<div class="form-group">
												<label>Nama Bank<span class="text-danger">*</span></label>
												<input type="text" class="form-control" name="bank_name">
											</div>
										</div>
									</div>


									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
											Daftar
										</button>
									</div>

									<div class="row">
										<div class="col-md-12 text-center">
											<a href="<?php echo base_url() ?>login">Sudah Punya Akun?</a>
										</div>
									</div>

								</form>

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- General JS Scripts -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/stisla.js"></script>


	<!-- JS Libraies -->

	<!-- Page Specific JS File -->

	<!-- Template JS File -->
	<script src="<?php echo base_url() ?>assets/js/scripts.js"></script>
</body>

</html>