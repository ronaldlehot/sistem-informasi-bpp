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
							<?php if ($this->uri->segment(3) == 'cpw') { ?>
							<label >Password lama *</label>
							<input type="password" name="student_current_password" class="form-control" placeholder="Password lama">
							<?php } ?>
						</div>
						<div class="form-group">
							<label >Password baru*</label>
							<input type="password" name="student_password" class="form-control" placeholder="Password baru">
							<?php if ($this->uri->segment(3) == 'cpw') { ?>
							<input type="hidden" name="student_id" value="<?php echo $this->session->userdata('uid_student'); ?>" >
							<?php } else { ?>
							<input type="hidden" name="student_id" value="<?php echo $student['student_id'] ?>" >
							<?php } ?>
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
						<a href="<?php echo site_url('student/profile'); ?>" class="btn btn-block btn-info">Batal</a>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>