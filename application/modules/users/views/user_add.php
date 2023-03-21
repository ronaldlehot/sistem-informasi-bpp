<?php

if (isset($user)) {
	$id = $user['user_id'];
	$inputFullnameValue = $user['user_full_name'];
	$inputRoleValue = $user['user_role_role_id'];
	$inputEmailValue = $user['user_email'];
	$inputDescValue = $user['user_description'];
} else {
	$inputFullnameValue = set_value('user_full_name');
	$inputRoleValue = set_value('user_role_role_id');
	$inputEmailValue = set_value('user_email');
	$inputDescValue = set_value('user_description');
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
			<li><a href="<?php echo site_url('manage/users') ?>">Manage Users</a></li>
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
						<?php if (isset($user)) { ?>
						<input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
						<?php } ?>
						<div class="form-group">
							<label>Email <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<input name="user_email" type="text" class="form-control" <?php echo (isset($user)) ? 'disabled' : ''; ?> value="<?php echo $inputEmailValue ?>" placeholder="email">
						</div> 

						<div class="form-group">
							<label>Nama lengkap <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<input name="user_full_name" type="text" class="form-control" value="<?php echo $inputFullnameValue ?>" placeholder="Nama lengkap">
						</div>

						<?php if (!isset($user)) { ?>
						<div class="form-group">
							<label>Password <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<input name="user_password" type="password" class="form-control" placeholder="Password">
						</div>            

						<div class="form-group">
							<label>Konfirmasi Password <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<input name="passconf" type="password" class="form-control" placeholder="Konfirmasi Password">
						</div>       
						<?php } ?>

						<div class="form-group">
							<label>Deskripsi</label>
							<textarea class="form-control" name="user_description" placeholder="Deskripsi"><?php echo $inputDescValue ?></textarea>
						</div>

						<div class="form-group">
							<label>Hak Akses <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
							<select name="role_id" class="form-control">
								<option value="">-Pilih Hak Akses-</option>
								<?php foreach ($roles as $row): ?> 
									<option value="<?php echo $row['role_id']; ?>" <?php echo ($inputRoleValue == $row['role_id']) ? 'selected' : '' ?>><?php echo $row['role_name']; ?></option>
								<?php endforeach; ?>
							</select>
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
						<label >Foto</label>
						<a href="#" class="thumbnail">
							<?php if (isset($user) AND $user['user_image'] != NULL) { ?>
							<img src="<?php echo upload_url('users/' . $user['user_image']) ?>" class="img-responsive avatar">
							<?php } else { ?>
							<img id="target" alt="Choose image to upload">
							<?php } ?>
						</a>
						<input type='file' id="user_image" name="user_image">
						<br>
						<button type="submit" class="btn btn-block btn-success">Simpan</button>
						<a href="<?php echo site_url('manage/users'); ?>" class="btn btn-block btn-info">Batal</a>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>
<script src="<?php echo media_url() ?>/js/jquery.min.js"></script>
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

	$("#user_image").change(function() {
		readURL(this);
	});
</script>