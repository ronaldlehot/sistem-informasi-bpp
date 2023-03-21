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
				
				<div class="box-body">
					<?php echo form_open_multipart(current_url(), array('class' => 'form-horizontal')); ?>
					<?php echo validation_errors(); ?>
					<?php if (isset($bulan)) { ?>
					<input type="hidden" name="payment_id" value="<?php echo $payment['payment_id']; ?>">
					<?php } ?>

					<div class="col-md-5">
						<div class="box box-primary">
							<div class="box-header">
								<h3 class="box-title">Pilih Kelas</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label for="" class="col-sm-4 control-label">Jenis Bayar</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo $payment['pos_name'].' - T.A '.$payment['period_start'].'/'.$payment['period_end'] ?>" readonly="">
									</div>
								</div>
								<div class="form-group">						
									<label for="" class="col-sm-4 control-label">Tahun Ajaran</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo $payment['period_start'].'/'.$payment['period_end'] ?>" readonly="">
									</div>
								</div>
								<div class="form-group">						
									<label for="" class="col-sm-4 control-label">Tipe Bayar</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo ($payment['payment_type']=='BULAN' ? 'Bulanan' : 'Bebas') ?>" readonly="">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-4 control-label">NIS</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" readonly="" value="<?php echo $student['student_nis'] ?>">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-4 control-label">Nama</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" readonly="" value="<?php echo $student['student_full_name'] ?>">
									</div>
								</div>						  
								<div class="form-group">
									<label for="" class="col-sm-4 control-label">Kelas</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" readonly="" value="<?php echo $student['class_name'] ?>">
									</div>
								</div>
								<?php if(majors() == 'senior') { ?>
								<div class="form-group">
									<label for="" class="col-sm-4 control-label">Program Keahlian</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" readonly="" value="<?php echo $student['majors_name'] ?>">
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
						<div class="box box-warning">
							<div class="box-header">
								<h3 class="box-title">Tarif Setiap Bulan Sama</h3>
							</div>
							<div class="box-body">
								<div class="form-group">
									<label for="" class="col-sm-4 control-label">Tarif Bulanan (Rp.)</label>
									<div class="col-sm-8">
										<input type="text" placeholder="Masukkan Nilai dan Tekan Enter" id="allTarif" name="allTarif" class="form-control numeric">
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="col-md-7">

						<div class="box box-success">
							<div class="box-header">
								<h3 class="box-title">Tarif Setiap Bulan Tidak Sama</h3>
							</div>
							<div class="box-body">
								<table class="table">
									<tbody>

										<?php foreach ($bulan as $row): ?>
										<tr>
											<td><?php echo $row['month_name']; ?></td>
											<input type="hidden" name="bulan_id[]" value="<?php echo $row['bulan_id'] ?>">
											<td><input type="text" id="n<?php echo $row['month_month_id'] ?>" name="bulan_bill[]" value="<?php echo $row['bulan_bill'] ?>" class="form-control numeric">
											</td>
										</tr>

										<?php
									endforeach;
									?>

								</tbody>
							</table>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-success">Update Tarif</button>
							<a href="<?php echo site_url('manage/payment/view_bulan/'. $payment['payment_id']) ?>" class="btn btn-default">Cancel</a>
						</div>
					</div>
				</div>					
				<?php echo form_close(); ?>
			</div>
		</div>		
</section>
</div>

<script type="text/javascript">
	
	$("#allTarif").keypress(function (event) {
		var allTarif = $("#allTarif").val();
		if(event.keyCode == 13) {
			event.preventDefault();
			<?php foreach ($bulan as $row): ?>
			$("#n<?php echo $row['month_month_id'] ?>").val(allTarif);
			<?php endforeach ?>
		}
	});


</script>