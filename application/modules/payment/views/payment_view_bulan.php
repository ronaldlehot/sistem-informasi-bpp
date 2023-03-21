<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small>Detail</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row"> 
			<div class="col-md-12"> 
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Tarif - <?php echo $payment['pos_name'].' - T.A '.$payment['period_start'].'/'.$payment['period_end'] ?></h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
						<div class="form-group">						
							<label for="" class="col-sm-1 control-label">Tahun</label>
							<div class="col-sm-2">
								<input type="text" class="form-control" value="<?php echo $payment['period_start'].'/'.$payment['period_end'] ?>" readonly="">
							</div>
							<label for="" class="col-sm-1 control-label">Kelas</label>
							<div class="col-sm-2">
								<select class="form-control" name="pr">
									<option value="">-- Semua Kelas  --</option>
									<?php foreach ($class as $row): ?>
										<option <?php echo (isset($q['pr']) AND $q['pr'] == $row['class_id']) ? 'selected' : '' ?> value="<?php echo $row['class_id'] ?>"><?php echo $row['class_name'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<?php if(majors() == 'senior') { ?>
							<label for="" class="col-sm-2 control-label">Program Keahlian</label>
							<div class="col-sm-2">
								<select class="form-control" name="k">
									<option value="">-- Semua Keahlian  --</option>
									<?php foreach ($majors as $row): ?>
										<option <?php echo (isset($q['k']) AND $q['k'] == $row['majors_id']) ? 'selected' : '' ?> value="<?php echo $row['majors_id'] ?>"><?php echo $row['majors_name'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<?php } ?>
							<div class="col-sm-2">
								<button type="submit" class="btn btn-success">Cari / Tampilkan</button>
							</div>
						</div>
					</form>
					<hr>
					<label for="" class="col-sm-2">Setting Tarif</label>
					<div class="col-sm-10">
						<a class="btn btn-primary btn-sm" href="<?php echo site_url('manage/payment/add_payment_bulan/' . $payment['payment_id']) ?>"><span class="glyphicon glyphicon-plus"></span> Berdasarkan Kelas</a>
						<?php if (majors() == 'senior') { ?>
						<a class="btn btn-warning btn-sm" href="<?php echo site_url('manage/payment/add_payment_bulan_majors/' . $payment['payment_id']) ?>"><span class="glyphicon glyphicon-plus"></span> Berdasarkan Program Keahlian</a>
						<?php } ?>
						<a class="btn btn-info btn-sm" href="<?php echo site_url('manage/payment/add_payment_bulan_student/' . $payment['payment_id']) ?>"><span class="glyphicon glyphicon-plus"></span> Berdasarkan Siswa</a>
						
						<a class="btn btn-default btn-sm" href="<?php echo site_url('manage/payment') ?>"><span class="glyphicon glyphicon-repeat"></span> Kembali</a>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->

			<?php if($q) { ?>
			<div class="box box-primary">
				<div class="box-body table-responsive">
					<table class="table table-hover">
						<tr>
							<th>No</th>
							<th>NIS</th>
							<th>Nama</th>
							<th>Kelas</th>
							<?php if (majors() == 'senior') : ?>
								<th>Program</th>
							<?php endif ?>
							<th>Aksi</th>
						</tr>
						<tbody>
							<?php
							$i = 1;
							foreach ($student as $row):
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row['student_nis']; ?></td>
									<td><?php echo $row['student_full_name']; ?></td>
									<td><?php echo $row['class_name']; ?></td>
									<?php if (majors() == 'senior') : ?>
										<td><?php echo $row['majors_name']; ?></td>
									<?php endif ?>
									<td>
										<a href="<?php echo site_url('manage/payment/edit_payment_bulan/'. $row['payment_payment_id'].'/'.$row['student_student_id']) ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Ubah Tarif"><i class="fa fa-edit"></i></a>

									</td>	
								</tr>
								<?php
								$i++;
							endforeach;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>		
</section>
</div>