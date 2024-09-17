<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Update Profile</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php echo $this->session->flashdata('pesan') ?>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-md-12">
						<form action="<?php echo base_url() ?>pelelang/profile/edit" method="POST">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Username<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="username" value="<?= $pelelang->username ?>">
									</div>
									<div class="form-group">
										<label>Password<span class="text-danger">*</span></label>
										<input type="password" class="form-control" name="password">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="name">Nama Lengkap<span class="text-danger">*</span></label>
										<input id="name" type="text" name="name" class="form-control" value="<?= $pelelang->fullname ?>" required>
									</div>
									<div class="form-group">
										<label for="phone">Nomor Telepon<span class="text-danger">*</span></label>
										<input id="phone" class="form-control" name="phone" value="<?= $pelelang->phone ?>">
									</div>
									<div class="form-group">
										<label>Alamat<span class="text-danger">*</span></label>
										<textarea style="height: auto;" class="form-control" name="address" value="" row="4"><?= $pelelang->address ?></textarea>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label>Nomor Rekening<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="account_number" value="<?= $pelelang->account_number ?>">
									</div>
									<div class="form-group">
										<label>Atas Nama<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="account_name" value="<?= $pelelang->account_name ?>">
									</div>
									<div class="form-group">
										<label>Nama Bank<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="bank_name" value="<?= $pelelang->bank_name ?>">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 text-right">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>