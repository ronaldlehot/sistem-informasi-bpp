<?php

if (isset($student)) {

	$inputFullnameValue = $student['student_full_name'];
	$inputClassValue = $student['class_class_id'];
	$inputMajorValue = $student['majors_majors_id'];
	$inputNisValue = $student['student_nis'];
	$inputNisNValue = $student['student_nisn'];
	$inputPlaceValue = $student['student_born_place'];
	$inputDateValue = $student['student_born_date'];
	$inputPhoneValue = $student['student_phone'];
	$inputParPhoneValue = $student['student_parent_phone'];
	$inputHobbyValue = $student['student_hobby'];
	$inputAddressValue = $student['student_address'];
	$inputGenderValue = $student['student_gender'];
	$inputMotherValue = $student['student_name_of_mother'];
	$inputFatherValue = $student['student_name_of_father'];
	$inputStatusValue = $student['student_status'];
} else {
	$inputFullnameValue = set_value('student_full_name');
	$inputClassValue = set_value('class_class_id');
	$inputMajorValue = set_value('majors_majors_id');
	$inputNisValue = set_value('student_nis');
	$inputNisNValue = set_value('student_nisn');
	$inputPlaceValue = set_value('student_born_place');
	$inputDateValue = set_value('student_born_date');
	$inputPhoneValue = set_value('student_phone');
	$inputParPhoneValue = set_value('student_parent_phone');
	$inputHobbyValue = set_value('student_hobby');
	$inputAddressValue = set_value('student_address');
	$inputGenderValue = set_value('student_gender');
	$inputMotherValue = set_value('student_name_of_mother');
	$inputFatherValue = set_value('student_name_of_father');
	$inputStatusValue = set_value('student_status');
}
?>

<div class="content-wrapper"> 
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('student') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li><a href="<?php echo site_url('student/profile') ?>">Profile</a></li>
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
				<div class="box">
					<!-- /.box-header -->
					<div class="box-body">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1" data-toggle="tab">Data Pribadi</a></li>
								<li><a href="#tab_2" data-toggle="tab">Data Sekolah</a></li>
								<li><a href="#tab_3" data-toggle="tab">Data Keluarga</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">
									<?php echo validation_errors(); ?>
									<?php if (isset($student)) { ?>
									<input type="hidden" name="student_id" value="<?php echo $student['student_id']; ?>">
									<?php } ?>
									
									<div class="form-group">
										<label>Nama lengkap <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
										<input readonly="" type="text" class="form-control" value="<?php echo $inputFullnameValue ?>">
									</div>
									<div class="form-group">
										<label>Jenis Kelamin</label>
										<div class="radio">
											<label>
												<input type="radio" name="student_gender" value="L" <?php echo ($inputGenderValue == 'L') ? 'checked' : ''; ?>> Laki-laki
											</label>&nbsp;&nbsp;
											<label>
												<input type="radio" name="student_gender" value="P" <?php echo ($inputGenderValue == 'P') ? 'checked' : ''; ?>> Perempuan
											</label>
										</div>
									</div>

									<div class="form-group">
										<label>Tempat Lahir</label>
										<input name="student_born_place" type="text" class="form-control" value="<?php echo $inputPlaceValue ?>" placeholder="Tempat Lahir">
									</div>

									<div class="form-group">
										<label>Tanggal Lahir </label>
										<div class="input-group date " data-date="" data-date-format="yyyy-mm-dd">
											<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											<input class="form-control" type="text" name="student_born_date" readonly="readonly" placeholder="Tanggal" value="<?php echo $inputDateValue; ?>">
										</div>
									</div>

									<div class="form-group">
										<label>Hobi</label>
										<input name="student_hobby" type="text" class="form-control" value="<?php echo $inputHobbyValue ?>" placeholder="Hobi">
									</div>

									<div class="form-group">
										<label>No. Handphone <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
										<input name="student_phone" type="text" class="form-control" value="<?php echo $inputPhoneValue ?>" placeholder="No Handphone">
									</div>
									<div class="form-group">
										<label>Alamat</label>
										<textarea class="form-control" name="student_address" placeholder="Alamat Tempat Tinggal"><?php echo $inputAddressValue ?></textarea>
									</div>
								</div>

								<div class="tab-pane" id="tab_2">
									<div class="form-group">
										<label>NIS <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
										<input readonly="" type="text" class="form-control" value="<?php echo $inputNisValue ?>">
									</div> 

									<div class="form-group">
										<label>NISN <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
										<input readonly="" type="text" class="form-control" value="<?php echo $inputNisNValue ?>">
									</div>
									<?php if (majors()== 'senior') { ?>
									<div class="form-group">
										<label>Program Keahlian <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
										<input readonly="" type="text" class="form-control" value="<?php echo $student['majors_name'] ?>">
									</div> 
									<?php } ?>

									<div class="form-group"> 
										<label >Kelas *</label>
										<input readonly="" type="text" class="form-control" value="<?php echo $student['class_name'] ?>">
									</div>
									
								</div>
								<div class="tab-pane" id="tab_3">
									<div class="form-group">
										<label>Nama Ibu Kandung</label>
										<input name="student_name_of_mother" type="text" class="form-control" value="<?php echo $inputMotherValue ?>" placeholder="Nama Ibu">
									</div>
									<div class="form-group">
										<label>Nama Ayah Kandung</label>
										<input name="student_name_of_father" type="text" class="form-control" value="<?php echo $inputFatherValue ?>" placeholder="Nama Ayah">
									</div>
									<div class="form-group">
										<label>No. Handphone Orang Tua <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
										<input name="student_parent_phone" type="text" class="form-control" value="<?php echo $inputParPhoneValue ?>" placeholder="No Handphone Orang Tua">
									</div>
								</div>

							</div>
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
							<?php if (isset($student) AND $student['student_img'] != NULL) { ?>
							<img src="<?php echo upload_url('student/' . $student['student_img']) ?>" class="img-responsive avatar">
							<?php } else { ?>
							<img src="<?php echo media_url('img/missing.png') ?>">
							<?php } ?>
						</a>
						<br>
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

