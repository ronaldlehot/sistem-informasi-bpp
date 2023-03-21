<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Reset Password
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<?php echo form_open(current_url()); ?>
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-9">
				<div class="box box-primary">
					<!-- /.box-header -->
					<div class="box-body">
						<?php echo form_open(current_url()); ?>
						<?php echo validation_errors(); ?>
						
						<div class="form-group">
							<label >Password baru*</label>
							<input type="password" name="student_password" class="form-control" placeholder="Password baru">
							<input type="hidden" name="student_id" value="<?php echo $student['student_id'] ?>" >
						</div>
						<div class="form-group">
							<label > Konfirmasi password baru*</label>
							<input type="password" name="passconf" class="form-control" placeholder="Konfirmasi password baru" >
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
						<a href="<?php echo site_url('manage/student'); ?>" class="btn btn-block btn-info">Batal</a>

					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>