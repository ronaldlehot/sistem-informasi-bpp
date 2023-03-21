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
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li><a href="<?php echo site_url('manage/students') ?>">Kelola Siswa</a></li>
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
										<input name="student_full_name" type="text" class="form-control" value="<?php echo $inputFullnameValue ?>" placeholder="Nama lengkap">
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
										<input name="student_nis" type="text" class="form-control" value="<?php echo $inputNisValue ?>" placeholder="NIS Siswa">
									</div> 

									<?php if (!isset($student)) { ?>
										<div class="form-group">
											<label>Password <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
											<input name="student_password" type="password" class="form-control" placeholder="Password">
										</div>            

										<div class="form-group">
											<label>Konfirmasi Password <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
											<input name="passconf" type="password" class="form-control" placeholder="Konfirmasi Password">
										</div>       
									<?php } ?>

									<div class="form-group">
										<label>NISN <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
										<input name="student_nisn" type="text" class="form-control" value="<?php echo $inputNisNValue ?>" placeholder="NISN Siswa">
									</div>
									<?php if ($setting_level['setting_value']=='senior') { ?>
										<div class="form-group">
											<label>Program Keahlian <small data-toggle="tooltip" title="Wajib diisi">*</small></label>
											<select name="majors_majors_id" class="form-control">
												<option value="">---Pilih Program Keahlian---</option>
												<?php foreach ($majors as $row): ?>
													<option value="<?php echo $row['majors_id'] ?>" <?php echo ($inputMajorValue == $row['majors_id']) ? 'selected' : '' ?> ><?php echo $row['majors_name'] ?></option>
												<?php endforeach ?>
											</select>
										</div> 
									<?php } ?>
									<div ng-controller="classCtrl">
										<div class="form-group"> 
											<label >Kelas *</label>
											<select name="class_class_id" class="form-control autocomplete">
												<option value="">-- Pilih Kelas --</option>
												<option ng-repeat="class in classs" ng-selected="class_data.index == class.class_id" value="{{class.class_id}}">{{class.class_name}}</option>
											</select>
											<a data-toggle="modal" href="#myModal"><span class="fa fa-plus"></span> Tambah Kelas</a><br><br>
											<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-dialog modal-sm"> 
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<h4 class="modal-title" id="myModalLabel">Tambah Kelas</h4>
															</div>
															<div class="modal-body">
																<label >Nama Kelas *</label>
																<input type="text" name="class_name" ng-model="classForm.class_name" placeholder="Kelas" class="form-control"><br>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
																<button type="button" class="btn btn-primary" ng-disabled="!(!!classForm.class_name)" ng-click="submit(classForm)" type="button" data-dismiss="modal">Simpan</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
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
						<div class="form-group">
							<label>Status</label>
							<div class="radio">
								<label>
									<input type="radio" name="student_status" value="1" <?php echo ($inputStatusValue == 1) ? 'checked' : ''; ?>> Aktif
								</label>
							</div>
							<div class="radio">
								<label>
									<input type="radio" name="student_status" value="0" <?php echo ($inputStatusValue == 0) ? 'checked' : ''; ?>> Tidak Aktif
								</label>
							</div>
						</div>
						<label >Foto</label>
						<a href="#" class="thumbnail">
							<?php if (isset($student['student_img']) != NULL) { ?>
								<img src="<?php echo upload_url('student/' . $student['student_img']) ?>" class="img-responsive avatar">
							<?php } else { ?>
								<img src="<?php echo media_url('img/missing.png') ?>" id="target" alt="Choose image to upload">
							<?php } ?>
						</a>
						<input type='file' id="student_img" name="student_img">
						<br>
						<button type="submit" class="btn btn-block btn-success">Simpan</button>
						<a href="<?php echo site_url('manage/student'); ?>" class="btn btn-block btn-info">Batal</a>
						<?php if (isset($student)) { ?>
							<button type="button" onclick="getId(<?php echo $student['student_id'] ?>)" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteStudent">Hapus
							</button>
						<?php } ?>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>
<?php if (isset($student)) { ?>
	<div class="modal fade" id="deleteStudent">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">Konfirmasi Hapus</h4>
				</div>
				<form action="<?php echo site_url('manage/student/delete') ?>" method="POST">
					<div class="modal-body">
						<p>Apakah anda akan menghapus data ini?</p>
						<input type="hidden" name="student_id" id="studentId">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-danger">Hapus</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php } ?>

<script>

	function getId(id) {
		$('#studentId').val(id)
	}
</script>

<script>
	var classApp = angular.module("classApp", []);
	var SITEURL = "<?php echo site_url() ?>";

	classApp.controller('classCtrl', function($scope, $http) {
		$scope.classs = [];
		<?php if (isset($student)): ?>
			$scope.class_data = {index: <?php echo $student['class_class_id']; ?>};
		<?php endif; ?>

		$scope.getClass = function() {

			var url = SITEURL + 'api/get_class/';
			$http.get(url).then(function(response) {
				$scope.classs = response.data;
			});

		};

		$scope.submit = function(student) {
			var postData = $.param(student);
			$.ajax({
				method: "POST",
				url: SITEURL + "manage/student/add_class",
				data: postData,
				success: function(data) {
					$scope.getClass();
					$scope.classForm.class_name = '';
				}
			});
		};

		angular.element(document).ready(function() {
			$scope.getClass();
		});

	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#target').attr('src', e.target.result);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#student_img").change(function() {
		readURL(this);
	});


</script>