<div class="main-content">
	<section class="section">
		<div class="section-header">
			<div class="section-header-back">
				<a href="<?php echo base_url() ?>admin/baranglelang" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
			</div>
			<h1>Detail Barang Lelang</h1>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<!-- show all data -->
						<div class="row">
							<div class="col-md-6">
								<dl class="meta">
									<dt>Pelelang</dt>
									<dd><?php echo $auction_item->fullname ?></dd>

									<dt>Kode</dt>
									<dd><?php echo $auction_item->code ?></dd>

									<dt>Nama</dt>
									<dd><?php echo $auction_item->name ?></dd>

									<dt>Kategori</dt>
									<dd><?php echo $auction_item->category_name ?? '-' ?></dd>

									<dt>Foto</dt>
									<dd>
										<img src="<?php echo base_url() ?>assets/photos/<?php echo $auction_item->photo ?>" alt="foto" class="img-fluid">
									</dd>

									<dt>Status</dt>
									<?php
									$status = '';
									if ($auction_item->status == '0') {
										$status = 'Tidak Aktif';
									} else if ($auction_item->status == '1') {
										$status = 'Aktif';
									} else if ($auction_item->status == '2') {
										$status = 'Selesai';
									} else if ($auction_item->status == '3') {
										$status = 'Batal';
									}
									?>
									<dd><?php echo $status ?></dd>
								</dl>
							</div>
							<div class="col-md-6">
								<dl class="meta">
									<dt>Lokasi</dt>
									<dd><?php echo $auction_item->location ?></dd>

									<dt>Keterangan</dt>
									<dd><?php echo $auction_item->note ?></dd>

									<dt>Harga Awal</dt>
									<dd>Rp <?php echo number_format($auction_item->open_price, 0, ',', '.') ?></dd>

									<dt>Tanggal Mulai</dt>
									<dd><?php echo $auction_item->open_date ?></dd>

									<dt>Tanggal Selesai</dt>
									<dd><?php echo $auction_item->close_date ?></dd>
								</dl>
							</div>
						</div>
					</div>
					<!-- /.card-body -->

				</div>

			</div>
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<div class="col-md-6">
							<h4>Riwayat Lelang</h4>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table class="table table-sm table-hover">
							<thead>
								<tr>
									<th class="table-fit">#</th>
									<th width="15%">Tanggal</th>
									<th width="15%">Kandidat</th>
									<th width="15%">Harga</th>
									<th class="table-fit">Pilih</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($auction as $item) {
								?>
									<tr>
										<td><?= $no++ ?></td>
										<td><?= $item->date ?></td>
										<td><?= $item->fullname ?></td>
										<td>Rp <?= number_format($item->price, 0, ',', '.') ?></td>
										<?php
										$btn_color = 'btn-secondary';
										$text = 'Tidak Terpilih';
										if ($item->status == '1') {
											$btn_color = 'btn-primary';
											$text = 'Terpilih';
										}
										?>
										<td class="table-fit">
											<button class="btn btn-sm btn-block <?php echo $btn_color ?>" disabled><?php echo $text ?></button>
										</td>
									</tr>
								<?php
								}
								?>
							</tbody>
						</table>
					</div>
					<!-- /.card-body -->

				</div>
				<?php if ($payment) { ?>
					<div class="card">
						<div class="card-header">
							<div class="col-md-6">
								<h4>Pemenang Lelang</h4>
							</div>
						</div>
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

									<div class="form-group">
										<label>Status</label>
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
										<p class="mb-0">
											<span class="badge badge-<?php echo $color ?>"><?php echo $status ?></span>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
</div>