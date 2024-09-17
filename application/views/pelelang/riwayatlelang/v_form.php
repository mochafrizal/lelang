<div class="main-content">
	<section class="section">
		<div class="section-header">
			<div class="section-header-back">
				<a href="<?php echo base_url() ?>pelelang/riwayatlelang" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
			</div>
			<h1>Konfirmasi Lelang</h1>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<!-- show all data -->
						<div class="row">
							<div class="col-md-12">
								<dt>Foto</dt>
								<dd>
									<img src="<?php echo base_url() ?>assets/photos/<?php echo $auction_item->auction_item_photo ?>" alt="foto" class="img-fluid">
								</dd>
							</div>
							<div class="col-md-6">
								<dl class="meta">
									<dt>Pelelang</dt>
									<dd><?php echo $auction_item->pelelang_fullname ?></dd>

									<dt>Kode</dt>
									<dd><?php echo $auction_item->auction_item_code ?></dd>

									<dt>Kategori</dt>
									<dd><?php echo $auction_item->category_name ?? '-' ?></dd>

									<dt>Nama</dt>
									<dd><?php echo $auction_item->auction_item_name ?></dd>

									
								</dl>
							</div>
							<div class="col-md-6">
								<dl class="meta">
									<dt>Lokasi</dt>
									<dd><?php echo $auction_item->auction_item_location ?></dd>

									<dt>Keterangan</dt>
									<dd><?php echo $auction_item->auction_item_note ?></dd>

									<dt>Harga Awal</dt>
									<dd>Rp <?php echo number_format($auction_item->auction_item_open_price, 0, ',', '.') ?></dd>

									<dt>Tanggal Mulai</dt>
									<dd><?php echo $auction_item->auction_item_open_date ?></dd>

									<dt>Tanggal Selesai</dt>
									<dd><?php echo $auction_item->auction_item_close_date ?></dd>
								</dl>
							</div>
						</div>
					</div>
					<!-- /.card-body -->

				</div>
			</div>
			<div class="col-md-8">
				<div class="alert alert-danger alert-has-icon">
					<div class="alert-icon"><i class="far fa-lightbulb"></i></div>
					<div class="alert-body">
						<div class="alert-title">Informasi</div>
						Jumlah yang harus dibayarkan <span class="font-weight-bold">Rp <?php echo $auction_item->price ?></span> ke Rekening 
						<span class="font-weight-bold">
						<?php echo $auction_item->pelelang_bank_name ?> / <?php echo $auction_item->pelelang_account_number ?> a.n <?php echo $auction_item->pelelang_account_name ?>
						</span>
					</div>
				</div>
				<div class="card">
					<div class="card-body">
						<form action="<?php echo base_url() ?>pelelang/riwayatlelang/konfirmasi_post/<?php echo $auction_item->id ?>" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<label>Nama Penerima<span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="recipient_name" value="<?php echo $kandidat->fullname ?>" required>
							</div>
							<div class="form-group">
								<label>Alamat Penerima<span class="text-danger">*</span></label>
								<textarea class="form-control" name="recipient_address" rows="3" style="height: 100px"><?php echo $kandidat->address ?></textarea>
							</div>
							<div class="form-group">
								<label>Bukti Bayar<span class="text-danger">*</span></label>
								<input type="file" name="proof_payment" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="exampleFormControlFile1" required>
							</div>
							<div class="row justify-content-end">
								<div class="col-md-4">
									<button type="submit" class="btn btn-primary btn-block">Konfirmasi</button>
								</div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>