<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Barang Lelangku</h1>
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
										<a href="<?php echo base_url().'pelelang/baranglelangku' ?>" class="btn btn-secondary btn-block">
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
					<div class="card-header">
						<div class="col-md-12 text-right">
							<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i>&emsp;Tambah Barang Lelang</button>
						</div>

					</div>
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
									<th width="15%">Kode</th>
									<th>Kategori</th>
									<th>Nama Barang</th>
									<th class="table-fit">Tanggal Tutup</th>
									<th class="table-fit">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($auction_item as $item) {
								?>
									<tr>
										<?php
										$status = '';
										if ($item->status == '0') {
											$status = 'Tidak Aktif';
											$color = 'secondary';
										} else if ($item->status == '1') {
											$status = 'Aktif';
											$color = 'primary';
										} else if ($item->status == '2') {
											$status = 'Selesai';
											$color = 'success';
										} else if ($item->status == '3') {
											$status = 'Batal';
											$color = 'danger';
										}
										?>
										<td><?= $no++ ?></td>
										<td><img src="<?= base_url('assets/photos/' . $item->photo) ?>" alt="" class="img-fluid"></td>
										<td>
											<div class="badge badge-<?= $color ?> w-100"><?= $status ?></div>
										</td>
										<td><?= $item->code ?></td>
										<td><?= $item->category_name ?? '-' ?></td>
										<td><?= $item->name ?></td>
										<td class="table-fit"><?= $item->close_date ?></td>
										<td class="table-fit">
											<a href="<?= base_url() ?>/pelelang/baranglelangku/detail/<?= $item->id ?>" class="btn btn-sm btn-info mr-2"><i class="fas fa-eye"></i></a>
											<?php if ($item->status == '0' || $item->status == '1') { ?>
												<button type="button" class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#edit<?= $no ?>"><i class="fas fa-edit"></i></button>
												<a href="<?= base_url() ?>/pelelang/baranglelangku/delete/<?= $item->id ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
											<?php } ?>
										</td>
									</tr>

									<?php if ($item->status == '0' || $item->status == '1') { ?>
										<div class="modal fade" id="edit<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Edit Barang Lelang</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form action="<?php echo base_url() ?>pelelang/baranglelangku/edit/<?= $item->id ?>" method="POST">
															<div class="row">
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="category_id">Kategori</label>
																		<select name="category_id" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
																			<option disabled selected>-- Kategori --</option>
																			<?php foreach ($kategori as $key => $value) { ?>
																				<option value="<?php echo $value->id ?>" <?php echo ($value->id == $item->category_id) ? 'selected' : ''?>><?php echo $value->name ?></option>
																			<?php } ?>
																		</select>
																	</div>
																	<div class="form-group">
																		<label>Kode<span class="text-danger">*</span></label>
																		<input type="text" class="form-control" name="code" value="<?php echo $item->code ?>" required>
																	</div>
																	<div class="form-group">
																		<label>Nama<span class="text-danger">*</span></label>
																		<input type="text" class="form-control" name="name" value="<?php echo $item->name ?>" required>
																	</div>
																	<div class="form-group">
																		<label>Foto Barang</label>
																		<input type="file" name="photo" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="exampleFormControlFile1">
																	</div>
																	<!-- make select option status -->
																	<div class="form-group">
																		<label for="status">Status<span class="text-danger">*</span></label>
																		<div class="input-group mb-2 mr-sm-2">
																			<select name="status" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
																				<option disabled selected>-- Status --</option>
																				<option value="0" <?php echo ($item->status == '0') ? 'selected' : '' ?>>
																					Tidak Aktif
																				</option>
																				<option value="1" <?php echo ($item->status == '1') ? 'selected' : '' ?>>
																					Aktif
																				</option>
																				<option value="2" <?php echo ($item->status == '2') ? 'selected' : '' ?>>
																					Selesai
																				</option>
																				<option value="3" <?php echo ($item->status == '3') ? 'selected' : '' ?>>
																					Batal
																				</option>
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-md-8">
																	<div class="form-group">
																		<label>Lokasi<span class="text-danger">*</span></label>
																		<input type="text" class="form-control" name="location" value="<?php echo $item->location ?>" required>
																	</div>
																	<div class="form-group">
																		<label>Keterangan<span class="text-danger">*</span></label>
																		<textarea class="form-control" name="note" rows="3" style="height: 100px"><?php echo $item->note ?></textarea>
																	</div>
																	<div class="form-group">
																		<label>Harga Awal<span class="text-danger">*</span></label>
																		<input type="text" class="form-control number-cleave" name="open_price" value="<?php echo $item->open_price ?>" required>
																	</div>
																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group">
																				<label>Tanggal Mulai<span class="text-danger">*</span></label>
																				<input type="text" class="form-control datetimepicker" name="open_date" value="<?php echo $item->open_date ?>" required>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group">
																				<label>Tanggal Berakhir<span class="text-danger">*</span></label>
																				<input type="text" class="form-control datetimepicker" name="close_date" value="<?php echo $item->close_date ?>" required>
																			</div>
																		</div>
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

										<script>
											$('#edit<?= $no ?>').appendTo("body").modal('show');
										</script>
									<?php } ?>

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
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Barang Lelang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url() ?>pelelang/baranglelangku/create" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="category_id">Kategori</label>
								<select name="category_id" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
									<option disabled selected>-- Kategori --</option>
									<?php foreach ($kategori as $key => $value) { ?>
										<option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label>Kode<span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="code" required>
							</div>
							<div class="form-group">
								<label>Nama<span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="name" required>
							</div>
							<div class="form-group">
								<label>Foto Barang<span class="text-danger">*</span></label>
								<input type="file" name="photo" accept="image/jpeg,image/jpg,image/png" class="form-control-file" id="exampleFormControlFile1" required>
							</div>
							<div class="form-group">
								<label for="status">Status<span class="text-danger">*</span></label>
								<select name="status" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" required>
									<option disabled selected>-- Status --</option>
									<option value="0">
										Tidak Aktif
									</option>
									<option value="1">
										Aktif
									</option>
								</select>
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label>Lokasi<span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="location" required>
							</div>
							<div class="form-group">
								<label>Keterangan<span class="text-danger">*</span></label>
								<textarea class="form-control" name="note" rows="3" style="height: 100px"></textarea>
							</div>
							<div class="form-group">
								<label>Harga Awal<span class="text-danger">*</span></label>
								<input type="text" class="form-control number-cleave" name="open_price" required>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Tanggal Mulai<span class="text-danger">*</span></label>
										<input type="text" class="form-control datetimepicker" name="open_date" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Tanggal Berakhir<span class="text-danger">*</span></label>
										<input type="text" class="form-control datetimepicker" name="close_date" required>
									</div>
								</div>
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