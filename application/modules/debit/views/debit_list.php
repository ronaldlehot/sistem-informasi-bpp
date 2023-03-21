<script type="text/javascript" src="<?php echo media_url('js/jquery-migrate-3.0.0.min.js') ?>"></script>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small></small>
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
						<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addDebit"><i class="fa fa-plus"></i> Tambah</button>

						<div class="box-tools">
							<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
							<div class="input-group input-group-sm" style="width: 250px;">
								<input type="text" id="field" autofocus name="n" <?php echo (isset($f['n'])) ? 'placeholder="'.$f['n'].'"' : 'placeholder="Keterangan Penerimaan"' ?> class="form-control" required>
								<div class="input-group-btn">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive">
						<table class="table table-hover">
							<tr>
								<th>No</th>
								<th>Tanggal</th>
								<th>Keterangan</th>
								<th>Pemasukan (Rp.)</th>
								<th>Aksi</th>
							</tr>
							<tbody>
								<?php
								if (!empty($debit)) {
									$i = 1;
									foreach ($debit as $row):
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo pretty_date($row['debit_date'],'d F Y',false); ?></td>
											<td><?php echo $row['debit_desc']; ?></td>
											<td><?php echo 'Rp. ' . number_format($row['debit_value'], 0, ',', '.') ?></td>
											<td>
												<a href="<?php echo site_url('manage/debit/edit/' . $row['debit_id']) ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
												
												<a href="#delModal<?php echo $row['debit_id']; ?>" data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" title="Hapus"></i></a>
											</td>	
										</tr>
										<div class="modal modal-default fade" id="delModal<?php echo $row['debit_id']; ?>">
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
															<?php echo form_open('manage/debit/delete/' . $row['debit_id']); ?>
															<input type="hidden" name="delName" value="<?php echo $row['debit_desc']; ?>">
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

		<!-- Modal -->
		<div class="modal fade" id="addDebit" role="dialog">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Tambah Penerimaan</h4>
					</div>
					<?php echo form_open('manage/debit/add_glob', array('method'=>'post')); ?>
					<div class="modal-body">
						<div id="p_scents_debit">
							<div class="form-group">
								<label>Tanggal</label>
								<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
									<input class="form-control" required="" type="text" name="debit_date" placeholder="Tanggal Penerimaan">
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<label>Keterangan *</label>
									<input type="text" required="" name="debit_desc[]" class="form-control" placeholder="Keterangan Penerimaan">
								</div>
								<div class="col-md-6">
									<label>Jumlah Rupiah *</label>
									<input type="number" required="" name="debit_value[]" class="form-control" placeholder="Jumlah" onfocus="unformatRupiah(this)" onblur="formatRupiah(this);">
								</div>
							</div>
						</div>
						<h6 ><a href="#" class="btn btn-xs btn-success" id="addScnt_debit"><i class="fa fa-plus"></i><b> Tambah Baris</b></a></h6>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-success">Simpan</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>


	<script>
		$(function() {
			var scntDiv = $('#p_scents_debit');
			var i = $('#p_scents_debit .row').size() + 1;

			$("#addScnt_debit").click(function() {
				$('<div class="row"><div class="col-md-6"><label>Keterangan *</label><input type="text" required name="debit_desc[]" class="form-control" placeholder="Keterangan Penerimaan"><a href="#" class="btn btn-xs btn-danger remScnt_debit">Hapus Baris</a></div><div class="col-md-6"><label>Jumlah Rupiah *</label><input type="number" required name="debit_value[]" class="form-control numeric" placeholder="Jumlah" onfocus="unformatRupiah(this)" onblur="formatRupiah(this);"></div></div>').appendTo(scntDiv);
				i++;
				return false;
			});

			$(document).on("click", ".remScnt_debit", function() {
				if (i > 2) {
					$(this).parents('.row').remove();
					i--;
				}
				return false;
			});
		});
	</script>
<?php $this->load->view('manage/rupiah'); ?>