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
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-danger">
					Warning!... !
					Halaman ini digunakan untuk merubah status siswa menjadi lulus. Pastikan siswa yang diproses adalah SISWA KELAS AKHIR.
				</div>
			</div>
		</div>
		<!-- /.box-header -->
		<div class="row">
			<div class="col-md-5">
				<div class="box">
					<div class="box-body">
						<?php echo form_open(current_url(), array('method' => 'get')) ?>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon alert-info">Pilih kelas</div>
								<select class="form-control" name="pr" onchange="this.form.submit()">
									<option value="">-- Pilih Kelas  --</option>
									<?php foreach ($class as $row): ?>
										<option <?php echo (isset($f['pr']) AND $f['pr'] == $row['class_id']) ? 'selected' : '' ?> value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<?php echo form_close() ?>
						<table class="table table-hover table-bordered table-responsive">
							<form action="<?php echo site_url('manage/student/multiple'); ?>" method="post" id="lulus">
								<input type="hidden" name="action" value="pass">
								<tr>
									<th><input type="checkbox" id="selectall" value="checkbox" name="checkbox"></th> 
									<th>No</th>
									<th>NIS</th>
									<th>Nama</th>
									<th>Status Kelulusan</th>
								</tr>
								<tbody>
									<?php if($this->input->get(NULL)) { ?>
										<?php
										if (!empty($notpass)) {
											$i = 1;
											foreach ($notpass as $row):
												?>
												<tr style="<?php echo ($row['student_status']==0) ? 'color:#00E640' : '' ?>">
													<td><input type="checkbox" class="<?php echo ($row['student_status']==0) ? NULL : 'checkbox' ?>" <?php echo ($row['student_status']==0) ? 'disabled' : NULL ?> name="msg[]" value="<?php echo $row['student_id']; ?>"></td>
													<td><?php echo $i; ?></td>
													<td><?php echo $row['student_nis']; ?></td>
													<td><?php echo $row['student_full_name']; ?></td>	
													<td><label class="label <?php echo ($row['student_status']==0) ? 'label-success' : 'label-warning' ?>"><?php echo ($row['student_status']==0) ? 'Lulus' : 'Belum Lulus' ?></label></td>	
												</tr>
												<?php
												$i++;
											endforeach;
										} else {
											?>
											<tr id="row">
												<td colspan="5" align="center">Data Kosong</td>
											</tr>
											<?php } ?>
											<?php } else {
											?>
											<tr id="row">
												<td colspan="5" align="center">Data Kosong</td>
											</tr>
											<?php } ?>
										</tbody>
									</form>
								</table>
							</div>
						</div>
					</div>

					<div class="col-md-2">
						<div class="panel panel-info">
							<div class="panel-body">
								<button class="btn btn-info btn-block" type="submit" onclick="$('#lulus').submit()"><span class="glyphicon glyphicon glyphicon-chevron-right"></span> Proses Lulus</button>
								<br>
								<button class="btn btn-danger btn-block" onclick="$('#kembali').submit();"><span class="glyphicon glyphicon glyphicon-chevron-left"></span> Batal Lulus</button>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="box">
							<div class="box-body">
								<h4>Data Kelulusan</h4>
								<table class="table table-hover table-bordered table-responsive">
									<form action="<?php echo site_url('manage/student/multiple'); ?>" method="post" id="kembali">
										<input type="hidden" name="action" value="notpass">
										<tr>
											<th><input type="checkbox" id="selectall2" value="checkbox" name="checkbox"></th> 
											<th>No</th>
											<th>NIS</th>
											<th>Nama</th>
											<th>Status Kelulusan</th>
										</tr>
										<tbody>
											<?php
											if (!empty($pass)) {
												$i = 1;
												foreach ($pass as $row):
													?>
													<tr style="color:#00E640">
														<td><input type="checkbox" class="checkbox" name="msg[]" value="<?php echo $row['student_id']; ?>"></td>
														<td><?php echo $i; ?></td>
														<td><?php echo $row['student_nis']; ?></td>
														<td><?php echo $row['student_full_name']; ?></td>
														<td><label class="label label-success"><?php echo ($row['student_status']==0) ? 'Lulus' : 'Belum Lulus' ?></label></td>	
													</tr>
													<?php
													$i++;
												endforeach;
											} else {
												?>
												<tr id="row">
													<td colspan="6" align="center">Data Kosong</td>
												</tr>
												<?php } ?>
											</tbody>
										</form>
									</table>
								</div>
							</form>
						</div>
					</div>

				</div>

			</section>
			<!-- /.content -->
		</div>

		<script>
			$(document).ready(function() {
				$("#selectall").change(function() {
					$(".checkbox").prop('checked', $(this).prop("checked"));
				});
			});
			$(document).ready(function() {
				$("#selectall2").change(function() {
					$(".checkbox").prop('checked', $(this).prop("checked"));
				});
			});
		</script>
