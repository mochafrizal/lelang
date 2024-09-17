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
				<div class="card">
					<div class="card-body">
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Nama Penerima</label>
									<p class="mb-0">
										<?php echo $payment->recipient_name ?>
									</p>
								</div>
								<div class="form-group">
									<label>Alamat Penerima</label>
									<p class="mb-0">
										<?php echo $payment->recipient_address ?>
									</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Bukti Bayar</label>
									<p class="mb-0">
										<img src="<?php echo base_url() ?>assets/proof_payments/<?php echo $payment->proof_payment ?>" alt="foto" class="img-fluid">
									</p>
								</div>
								<?php
								$status = '';
								if ($payment->status == '0') {
									$status = 'Menunggu Konfirmasi';
									$color = 'primary';
								} else if ($payment->status == '1') {
									$status = 'Diterima';
									$color = 'success';
								} else if ($payment->status == '2') {
									$status = 'Ditolak';
									$color = 'danger';
								}
								?>
								<div class="form-group">
									<label>Status</label>
									<p class="mb-0">
										<span class="badge badge-<?php echo $color ?>"><?php echo $status ?></span>
									</p>
								</div>
							</div>
						</div>
						<div class="row justify-content-end">
							<div class="col-md-4">
								<a href="<?php echo base_url() ?>/pelelang/riwayatlelang/edit_konfirmasi/<?php echo $payment->auction_id ?>" class="btn btn-warning btn-block">Edit</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
</div>