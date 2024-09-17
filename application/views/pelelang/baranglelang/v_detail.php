<div class="main-content">
	<section class="section">
		<div class="section-header">
			<div class="section-header-back">
				<a href="<?php echo base_url() ?>pelelang/baranglelang" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
			</div>
			<h1>Detail Barang Lelang</h1>
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
									

									<dt>Pelelang</dt>
									<dd><?php echo $auction_item->fullname ?></dd>

									<dt>Kode</dt>
									<dd><?php echo $auction_item->code ?></dd>

									<dt>Kategori</dt>
									<dd><?php echo $auction_item->category_name ?? '-' ?></dd>

									<dt>Nama</dt>
									<dd><?php echo $auction_item->name ?></dd>

									
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
						<div class="col-md-6 text-right">
							<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i>&emsp;Tambah Penawaran</button>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<?php echo $this->session->flashdata('pesan') ?>
							</div>
							<div class="col-md-12">
								<div class="alert alert-danger alert-has-icon">
									<div class="alert-icon"><i class="far fa-lightbulb"></i></div>
									<div class="alert-body">
										<div class="alert-title">Perhatian</div>
										Penawaran yang telah diinputkan oleh Peserta Lelang ke Sistem tidak dapat diubah atau dibatalkan oleh Peserta Lelang!
									</div>
								</div>
							</div>
						</div>
						<table class="table table-sm table-hover">
							<thead>
								<tr>
									<th class="table-fit">#</th>
									<th width="15%">Tanggal</th>
									<th width="15%">Kandidat</th>
									<th width="15%">Harga</th>
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
		</div>
	</section>
</div>

<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Penawaran Harga</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url() ?>pelelang/baranglelang/lelang/<?php echo $auction_item->id; ?>" method="POST">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Harga Penawaran<span class="text-danger">*</span></label>
								<input type="text" class="form-control number-cleave" name="price">
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