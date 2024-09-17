<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Riwayat Lelang</h1>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card mb-1">
					<div class="card-body">
						<form action="#">
							<div class="form-group mb-0">
								<div class="row justify-content-end">
									<div class="col-md-5 text-right">
										<input class="form-control" type="search" name="nama" placeholder="Search" aria-label="Search" value="<?php echo $keyword ?>">
									</div>
									<div class="col-md-5">
										<select name="category_id" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
											<option disabled selected>-- Kategori --</option>
											<?php foreach ($kategori as $key => $value) { ?>
												<option value="<?php echo $value->id ?>" <?php echo ($category_id == $value->id) ? 'selected' : '' ?>><?php echo $value->name ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col-md-1 text-right">
										<a href="<?php echo base_url().'pelelang/riwayatlelang' ?>" class="btn btn-secondary btn-block">
											<i class="fas fa-sync-alt"></i>
										</a>
									</div>
									<div class="col-md-1 text-right">
										<button class="btn btn-primary btn-block" type="submit">
											<i class="fas fa-search"></i>
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<!-- /.card-header -->
					<div class="card-body">
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
									<th class="table-fit">Tanggal</th>
									<th width="15%">Pelelang</th>
									<th class="table-fit">Kategori</th>
									<th class="table-fit">Nama Barang</th>
									<th class="table-fit">Harga Penawaran</th>
									<th width="10%">Status</th>
									<th width="10%">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($auction as $item) {
								?>
									<tr>
										<?php
										$status = '';
										if ($item->status == '0') {
											$status = 'Menunggu';
											$color = 'secondary';
										} else if ($item->status == '1') {
											$status = 'Diterima';
											$color = 'success';
										} else if ($item->status == '2') {
											$status = 'Ditolak';
											$color = 'danger';
										}
										?>
										<td><?= $no++ ?></td>
										<td><img src="<?= base_url('assets/photos/' . $item->auction_item_photo) ?>" alt="" class="img-fluid"></td>
										<td class="table-fit"><?= $item->date ?></td>
										<td><?= $item->fullname ?></td>
										<td><?= $item->category_name ?? '-' ?></td>
										<td><?= $item->auction_item_name ?></td>
										<td class="table-fit">Rp <?= number_format($item->price, 0, ',', '.') ?></td>
										<td>
											<div class="badge badge-<?= $color ?> w-100"><?= $status ?></div>
										</td>
									<?php if($item->status == '1') { ?>
										<td width="15%">
											<a href="<?= base_url() ?>/pelelang/riwayatlelang/konfirmasi/<?= $item->id ?>" class="btn btn-sm btn-block btn-primary">Konfirmasi Lelang</a>
										</td>
										<?php } ?>
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
