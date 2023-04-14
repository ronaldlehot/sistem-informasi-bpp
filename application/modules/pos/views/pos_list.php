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
						<!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addPos"><i class="fa fa-plus"></i> Tambah</button> -->

						<div class="box-tools">
							<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
							<div class="input-group input-group-sm" style="width: 250px;">
								<input type="text" id="field" autofocus name="n" <?php echo (isset($f['n'])) ? 'placeholder="'.$f['n'].'"' : 'placeholder="Nama POS"' ?> class="form-control" required>
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
								<th>Nama POS</th>
								<th>Keterangan</th>
								<th>Aksi</th>
							</tr>
							<tbody>
								<?php
								if (!empty($pos)) {
									$i = 1;
									foreach ($pos as $row):
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['pos_name']; ?></td>
											<td><?php echo $row['pos_description']; ?></td>
											<td>
												<a href="<?php echo site_url('manage/pos/edit/' . $row['pos_id']) ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
													
												

											</td>	
										</tr>
										<?php
										$i++;
									endforeach;
								} else {
									?>
									<tr id="row">
										<td colspan="4" align="center">Data Kosong</td>
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
	<div class="modal fade" id="addPos" role="dialog">
		<div class="modal-dialog modal-md">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Tambah POS Pembayaran</h4>
				</div>
				<?php echo form_open('manage/pos/add_glob', array('method'=>'post')); ?>
				<div class="modal-body">
					<div id="p_scents_pos">
						<div class="row">
							<div class="col-md-6">
								<label>Nama POS</label>
								<input type="text" required="" name="pos_name[]" class="form-control" placeholder="Contoh: BPP">
							</div>
							<div class="col-md-6">
								<label>Keterangan</label>
								<input type="text" required="" name="pos_description[]" class="form-control" placeholder="Contoh: Sumbangan Pendidikan">
							</div>
						</div>
					</div>
					<h6 ><a href="#" class="btn btn-xs btn-success" id="addScnt_pos"><i class="fa fa-plus"></i><b> Tambah Baris</b></a></h6>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>


<script>
	$(function() {
		var scntDiv = $('#p_scents_pos');
		var i = $('#p_scents_pos .row').size() + 1;

		$("#addScnt_pos").click(function() {
			$('<div class="row"><div class="col-md-6"><label>Nama POS</label><input type="text" required name="pos_name[]" class="form-control" placeholder="Contoh: BPP"><a href="#" class="btn btn-xs btn-danger remScnt_pos">Hapus Baris</a></div><div class="col-md-6"><label>Keterangan</label><input type="text" required name="pos_description[]" class="form-control" placeholder="Contoh: Sumbangan Pendidikan"></div></div>').appendTo(scntDiv);
			i++;
			return false;
		});

		$(document).on("click", ".remScnt_pos", function() {
			if (i > 2) {
				$(this).parents('.row').remove();
				i--;
			}
			return false;
		});
	});
</script>