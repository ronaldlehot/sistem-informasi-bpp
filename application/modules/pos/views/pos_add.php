<?php

if (isset($pos)) {

	$inputNameValue = $pos['pos_name'];
	$inputDescValue = $pos['pos_description'];
	
} else {
	$inputNameValue = set_value('pos_name');
	$inputDescValue = set_value('pos_description');
	
}
?>

<div class="content-wrapper"> 
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li><a href="<?php echo site_url('manage/pos') ?>">Tahun Pelajaran</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<!-- Main content -->
	<section class="content">
		<?php echo form_open_multipart(current_url()); ?>
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-9">
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="box-body">
						<?php echo validation_errors(); ?>
						<?php if (isset($pos)) { ?>
						<input type="hidden" name="pos_id" value="<?php echo $pos['pos_id']; ?>">
						<?php } ?>
						
						<div class="form-group">
							<label>Nama POS <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<input name="pos_name" type="text" class="form-control" value="<?php echo $inputNameValue ?>" placeholder="POS Bayar">
						</div>

						<div class="form-group">
							<label>Keterangan <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<input name="pos_description" type="text" class="form-control" value="<?php echo $inputDescValue ?>" placeholder="Keterangan">
						</div>

						<p class="text-muted">*) Kolom wajib diisi.</p>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<div class="col-md-3">
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="box-body">
						<button type="submit" class="btn btn-block btn-success">Simpan</button>
						<a href="<?php echo site_url('manage/pos'); ?>" class="btn btn-block btn-info">Batal</a>
						<?php if (isset($pos['pos_id'])) { ?>
						<a href="#delModal<?php echo $pos['pos_id']; ?>" data-toggle="modal" class="btn btn-block btn-danger">Hapus</a>
						<?php } ?>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
	<?php if (isset($pos['pos_id'])) { ?>
	<div class="modal modal-default fade" id="delModal<?php echo $pos['pos_id']; ?>">
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
						<?php echo form_open('manage/pos/delete/' . $pos['pos_id']); ?>
						<input type="hidden" name="delName" value="<?php echo $pos['pos_name']; ?>">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
						<button type="submit" class="btn btn-danger"><span class="fa fa-check"></span> Hapus</button>
						<?php echo form_close(); ?>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<?php } ?>
	</div>