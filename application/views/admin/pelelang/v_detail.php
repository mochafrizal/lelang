<div class="main-content">
	<section class="section">
		<div class="section-header">
			<div class="section-header-back">
				<a href="<?php echo base_url() ?>admin/pelelang" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
			</div>
			<h1>Detail Data Pelelang</h1>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-body">
						<!-- show all data -->
						<div class="row">
							<div class="col-md-4">
								<dl class="meta">
									<dt>Username</dt>
									<dd><?php echo $pelelang->username ?></dd>

									<dt>Status</dt>
									<dd><?php echo $pelelang->status == '0' ? 'Tidak Aktif' : 'Aktif' ?></dd>

									<dt>Nomor Rekening</dt>
									<dd><?php echo $pelelang->bank_name.' / '.$pelelang->account_number.' a.n '.$pelelang->account_name ?></dd>
								</dl>
							</div>
							<div class="col-md-8">
								<dl class="meta">
									<dt>Nama Lengkap</dt>
									<dd><?php echo $pelelang->fullname ?></dd>

									<dt>No. Telp</dt>
									<dd><?php echo $pelelang->phone ?></dd>

									<dt>Alamat</dt>
									<dd><?php echo $pelelang->address ?></dd>

									<dt>Tanggal Daftar</dt>
									<dd><?php echo $pelelang->register_date ?></dd>
								</dl>
							</div>
						</div>
					</div>
					<!-- /.card-body -->

				</div>

			</div>
		</div>
	</section>
</div>