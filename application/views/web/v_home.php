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
											<a href="<?php echo base_url() ?>" class="btn btn-secondary btn-block">
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
					<div class="row">
						<div class="col-md-12">
							<?php echo $this->session->flashdata('pesan') ?>
						</div>
					</div>
					<table class="table table-sm table-hover">
						<thead>
							<tr>
								<th style="width: 10px">#</th>
								<th width="200px">Foto</th>
								<th width="15%">Pelelang</th>
								<th class="table-fit">Kode</th>
								<th class="table-fit">Kategori</th>
								<th>Nama Barang</th>
								<th class="table-fit">Tanggal Buka</th>
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
									<td><?= $item->category_name ?? '-' ?></td>
									<td><?= $item->name ?></td>
									<td class="table-fit"><?= $item->open_date ?></td>
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
