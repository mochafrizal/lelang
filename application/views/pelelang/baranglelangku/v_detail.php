<div class="main-content">
	<section class="section">
		<div class="section-header">
			<div class="section-header-back">
				<a href="<?php echo base_url() ?>pelelang/baranglelangku" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
			</div>
			<h1>Detail Barang Pelelang</h1>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<!-- show all data -->
						<div class="row">
							<div class="col-md-12">
								<dl class="meta">
									<dt>Foto</dt>
									<dd>
										<img src="<?php echo base_url() ?>assets/photos/<?php echo $auction_item->photo ?>" alt="foto" class="img-fluid">
									</dd>
								</dl>
							</div>
							<div class="col-md-6">
								<dl class="meta">
									<dt>Kode</dt>
									<dd><?php echo $auction_item->code ?></dd>

									<dt>Nama</dt>
									<dd><?php echo $auction_item->name ?></dd>

									<dt>Kategori</dt>
									<dd><?php echo $auction_item->category_name ?? '-' ?></dd>

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
				<div class="row">
					<div class="col-md-12">
						<?php echo $this->session->flashdata('pesan') ?>
					</div>
				</div>
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
										if ($item->status == '1') {
											$btn_color = 'btn-primary';
										}
										?>
										<td>
											<a href="<?php echo base_url() ?>pelelang/baranglelangku/pilih/<?php echo $item->id ?>" class="btn btn-sm <?php echo $btn_color ?>">Pilih</a>
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
											<img src="<?php echo base_url() ?>assets/proof_payments/<?php echo $payment->proof_payment ?>" alt="foto" width="100px">
										</p>
									</div>

									<div class="form-group">
										<label>Status</label>
										<form action="<?php echo base_url() ?>/pelelang/baranglelangku/konfirmasi/<?php echo $payment->auction_id ?>" method="POST">
											<div class="form-group">
												<select name="status" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
													<option disabled selected>-- Status --</option>
													<option value="1" <?php echo ($payment->status == '1') ? 'selected' : '' ?>>
														Diterima
													</option>
													<option value="2" <?php echo ($payment->status == '2') ? 'selected' : '' ?>>
														Ditolak
													</option>
												</select>
											</div>
											<div class="row">
												<div class="col-md-12 text-right">
													<button type="submit" class="btn btn-primary">
														Simpan
													</button>
												</div>
											</div>
										</form>
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