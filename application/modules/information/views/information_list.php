<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small>List</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<a href="<?php echo site_url('manage/information/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive">
						<table class="table table-hover">
							<tr>
								<th>No</th>
								<th>Judul</th>
								<th>Tanggal</th>
								<th>Status</th>
								<th>Aksi</th>
							</tr>
							<tbody>
								<?php
								if (!empty($information)) {
									$i = 1;
									foreach ($information as $row):
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['information_title']; ?></td>
											<td><?php echo pretty_date($row['information_input_date'],'d F Y',false); ?></td>
											<td><?php echo ($row['information_publish']==0) ? 'Draft' : 'Terbit' ?></td>
											<td>
												<a href="<?php echo site_url('manage/information/edit/' . $row['information_id']) ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
												
												<a href="#delModal<?php echo $row['information_id']; ?>" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="Hapus"></i></a>
											</td>	
										</tr>
										<div class="modal modal-default fade" id="delModal<?php echo $row['information_id']; ?>">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span></button>
															<h3 class="modal-title"><span class="fa fa-warning"></span> Konfirmasi penghapusan</h3>
														</div>
														<div class="modal-body">
															<p>Apakah anda yakin akan menghapus data ini?</p>
														</div>
														<div class="modal-footer">
															<?php echo form_open('manage/information/delete/' . $row['information_id']); ?>
															<input type="hidden" name="delName" value="<?php echo $row['information_title']; ?>">
															<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
															<button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Hapus</button>
															<?php echo form_close(); ?>
														</div>
													</div>
													<!-- /.modal-content -->
												</div>
												<!-- /.modal-dialog -->
											</div>
											<?php
											$i++;
										endforeach;
									} else {
										?>
										<tr id="row">
											<td colspan="5" align="center">Data Kosong</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<!-- /.box-body -->
						</div>
						<div>
							<?php echo $this->pagination->create_links(); ?>
						</div>
						<!-- /.box -->
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>