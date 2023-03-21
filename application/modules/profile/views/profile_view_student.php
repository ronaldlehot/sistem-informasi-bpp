<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('student') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-md-12">
				<div class="box box-success">
					<!-- /.box-header -->
					<div class="box-body">
						<div class="col-md-12 col-sm-12 col-xs-12 pull-left">
							<br>
							<div class="row">
								<div class="col-md-2">
									<?php if (!empty($student['student_img'])) { ?>
									<img src="<?php echo upload_url('student/'.$student['student_img']) ?>" class="img-responsive avatar">
									<?php } else { ?>
									<img src="<?php echo media_url('img/user.png') ?>" class="img-responsive avatar">
									<?php } ?>
								</div>
								<div class="col-md-10">
									<table class="table table-hover">
										<tbody>
											<tr>
												<td>NIS Siswa</td>
												<td>:</td>
												<td><?php echo $student['student_nis'] ?></td>
											</tr>
											<tr>
												<td>NISN Siswa</td>
												<td>:</td>
												<td><?php echo $student['student_nisn'] ?></td>
											</tr>
											<tr>
												<td>Nama lengkap</td>
												<td>:</td>
												<td><?php echo $student['student_full_name'] ?></td>
											</tr>
											<tr>
												<td>Jenis Kelamin</td>
												<td>:</td>
												<td><?php echo ($student['student_gender']=='L')? 'Laki-laki' : 'Perempuan' ?></td>
											</tr>
											<tr>
												<td>Tempat, Tanggal Lahir</td>
												<td>:</td>
												<td><?php echo $student['student_born_place'].', '. pretty_date($student['student_born_date'],'d F Y',false) ?></td>
											</tr>
											<tr>
												<td>Hobi</td>
												<td>:</td>
												<td><?php echo $student['student_hobby'] ?></td>
											</tr>
											<tr>
												<td>No. Handphone</td>
												<td>:</td>
												<td><?php echo $student['student_phone'] ?></td>
											</tr>
											<tr>
												<td>Alamat</td>
												<td>:</td>
												<td><?php echo $student['student_address'] ?></td>
											</tr>
											<tr>
												<td>Nama Ibu Kandung</td>
												<td>:</td>
												<td><?php echo $student['student_name_of_mother'] ?></td>
											</tr>
											<tr>
												<td>Nama Ayah Kandung</td>
												<td>:</td>
												<td><?php echo $student['student_name_of_father'] ?></td>
											</tr>
											<tr>
												<td>No. Handphone Orang Tua</td>
												<td>:</td>
												<td><?php echo $student['student_parent_phone'] ?></td>
											</tr>
											<tr>
												<td>Kelas</td>
												<td>:</td>
												<td><?php echo $student['class_name'] ?></td>
											</tr>
											<?php if(majors()=='senior') { ?>
											<tr>
												<td>Program Keahlian</td>
												<td>:</td>
												<td><?php echo $student['majors_name'] ?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<div class="col-md-4">
									<a href="<?php echo site_url('student') ?>" class="btn btn-default">
										<i class="fa fa-arrow-circle-o-left"></i> Kembali
									</a>
									<a href="<?php echo site_url('student/profile/edit') ?>" class="btn btn-success">
										<i class="fa fa-edit"></i> Edit
									</a>
									<a href="<?php echo site_url('student/profile/cpw'); ?>" class="btn btn-warning"><i class="fa fa-refresh"></i> Ganti Password</a>

								</div>
							</div>
							<!-- /.box-body -->
						</div>
					</div>
				</div>

				</section>
			</div>