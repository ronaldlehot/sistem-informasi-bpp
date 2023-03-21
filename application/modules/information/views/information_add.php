<?php $this->load->view('manage/tinymce_init'); ?>
<?php
if (isset($information)) {

	$inputJudulValue = $information['information_title'];
	$inputRingkasanValue = $information['information_desc'];
	$inputStatus = $information['information_publish'];
} else {

	$inputJudulValue = set_value('information_title');
	$inputRingkasanValue = set_value('information_desc');
	$inputStatus = set_value('information_is_publish');
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
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<?php if (!isset($information)) echo validation_errors(); ?>
	<?php echo form_open_multipart(current_url()); ?>

	<section class="content">
		<div class="row">
			<div class="col-md-9">
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="box-body">
						<?php if (isset($information)): ?>
							<input type="hidden" name="information_id" value="<?php echo $information['information_id']; ?>" />
						<?php endif; ?>
						<label>Judul Informasi <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
						<input name="information_title" placeholder="Judul Informasi" type="text" class="form-control" value="<?php echo $inputJudulValue; ?>"><br>
						<div class="form-group">
							<label >Deskripsi Informasi *</label>
							<textarea name="information_desc" rows="10" class="mce-init"><?php echo $inputRingkasanValue; ?></textarea>
						</div>
						<br/>
						<p style="color:#9C9C9C;margin-top: 5px"><i>*) Field Wajib Diisi</i></p>
						<div class="form-group">
							<div class="box4">
								<label for="image">Unggah File Gambar</label>
								<a href="#" class="thumbnail">
									<?php if (isset($information) AND $information['information_img'] != NULL) { ?>
									<img src="<?php echo upload_url('information/' . $information['information_img']) ?>" class="img-responsive avatar">
									<?php } else { ?>
									<img id="target" alt="Choose image to upload">
									<?php } ?>
								</a>
								<input type='file' id="information_img" name="information_img">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="box-body">
						<div class="form-group">
							<label>Status Publikasi</label>
							<div class="radio">
								<label>
									<input type="radio" name="information_publish" value="0" <?php echo ($inputStatus == 0) ? 'checked' : ''; ?>> Draft
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="information_publish" value="1" <?php echo ($inputStatus == 1) ? 'checked' : ''; ?>> Terbit
								</label>
							</div>
						</div>

						
						<div class="form-group">
							<button name="action" type="submit" value="save" class="btn btn-success btn-form"><i class="fa fa-check"></i> Simpan</button>
							<a href="<?php echo site_url('manage/information'); ?>" class="btn btn-info btn-form"><i class="fa fa-arrow-left"></i> Batal</a>
							<?php if (isset($information)): ?>
								<a href="<?php echo site_url('manage/information/delete/' . $information['information_id']); ?>" class="btn btn-danger btn-form" ><i class="fa fa-trash"></i> Hapus</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
</section>
</div>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#target').attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#information_img").change(function() {
		readURL(this);
	});
</script>