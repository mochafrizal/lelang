<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Barang Lelang</h1>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="card mb-1">
					<div class="card-body">
						<form action="#">
							<div class="form-group mb-0">
								<div class="row justify-content-end">
									<div class="col-10 text-right">
										<input class="form-control" type="search" name="nama" placeholder="Search" aria-label="Search">
									</div>
									<div class="col-2 text-right">
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
									<th width="10%">Status</th>
									<th width="15%">Pelelang</th>
									<th class="table-fit">Kode</th>
									<th class="table-fit">Kategori</th>
									<th>Nama Barang</th>
									<th class="table-fit">Tanggal Tutup</th>
									<th class="table-fit">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($barang as $item) {
								?>
									<tr>
										<?php
										$status = '';
										if ($item->status == '0') {
											$status = 'Tidak Aktif';
										} else if ($item->status == '1') {
											$status = 'Aktif';
										} else if ($item->status == '2') {
											$status = 'Selesai';
										} else if ($item->status == '3') {
											$status = 'Batal';
										}
										?>
										<td><?= $no++ ?></td>
										<td><img src="<?= base_url('assets/photos/' . $item->photo) ?>" alt="" class="img-fluid"></td>
										<td><?= $status ?></td>
										<td><?= $item->fullname ?></td>
										<td class="table-fit"><?= $item->code ?></td>
										<td><?= $item->category_name ?? '-' ?></td>
										<td><?= $item->name ?></td>
										<td class="table-fit"><?= $item->close_date ?></td>
										<td class="table-fit">
											<a href="<?= base_url() ?>/admin/baranglelang/detail/<?= $item->id ?>" class="btn btn-sm btn-info mr-2"><i class="fas fa-eye"></i></a>
											<a href="<?= base_url() ?>/admin/baranglelang/delete/<?= $item->id ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
										</td>
									</tr>

									<script>
										$('#edit<?= $no ?>').appendTo("body").modal('show');
									</script>

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
