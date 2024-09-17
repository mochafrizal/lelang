<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Admin</h1>
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
					<div class="card-header">
						<div class="col-md-12 text-right">
							<button class="btn btn-primary" type="button" data-toggle="modal" data-target="#add"><i class="fas fa-plus"></i>&emsp;Tambah Admin</button>
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
									<th>Username</th>
									<th class="table-fit">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								foreach ($admin as $item) {
								?>
									<tr>

										<td><?= $no++ ?></td>
										<td><?= $item->username ?></td>
										<td class="table-fit">
											<button type="button" class="btn btn-sm btn-warning mr-2" data-toggle="modal" data-target="#edit<?= $no ?>"><i class="fas fa-edit"></i></button>
											<a href="<?= base_url() ?>/admin/useradmin/delete/<?= $item->id ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
										</td>
									</tr>

									<div class="modal fade" id="edit<?= $no ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form action="<?php echo base_url() ?>admin/useradmin/edit/<?= $item->id ?>" method="POST">
														<div class="row">
															<div class="col-md-12">
																<div class="form-group">
																	<label>Username<span class="text-danger">*</span></label>
																	<input type="text" class="form-control" name="username" value="<?= $item->username ?>">
																</div>
																<div class="form-group">
																	<label>Password<span class="text-danger">*</span></label>
																	<input type="password" class="form-control" name="password">
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
				<h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?php echo base_url() ?>admin/useradmin/create" method="POST">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Username<span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="username">
							</div>
							<div class="form-group">
								<label>Password<span class="text-danger">*</span></label>
								<input type="password" class="form-control" name="password">
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