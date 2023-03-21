<?php

if (isset($bulan)) {

	$inputMajorsValue = $bulan['majors_id'];
	$inputBillValue = $bulan['bulan_bill'];
} else {
	$inputMajorsValue = set_value('majors_majors_id');
	$inputBillValue = set_value('bulan_bill');

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
						<div class="box-header with-border">
							<h3 class="box-title">Informasi</h3>
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
								<label for="" class="col-sm-4 control-label">Kelas</label>
								<div class="col-sm-8">
									<select name="class_id" class="form-control" required="">
										<option value="">---Pilih Kelas---</option>
										<?php foreach ($class as $row): ?> 
											<option value="<?php echo $row['class_id']; ?>"><?php echo $row['class_name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>					  
							<div class="form-group">
								<label for="" class="col-sm-4 control-label">Program Keahlian</label>
								<div class="col-sm-8">
									<select name="majors_id" class="form-control" required="">
										<option value="">---Pilih Program Keahlian---</option>
										<?php foreach ($majors as $row): ?> 
											<option value="<?php echo $row['majors_id']; ?>"><?php echo $row['majors_name']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="box box-warning">
						<div class="box-header with-border">
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
						<div class="box-header with-border">
							<h3 class="box-title">Tarif Setiap Bulan Tidak Sama</h3>
						</div>
						<div class="box-body">
							<table class="table">
								<tbody>
									<?php foreach ($month as $row): ?>
										<input type="hidden" name="month_id[]" value="<?php echo $row['month_id']; ?>">
										<tr>
											<td><strong><?php echo $row['month_name']; ?></strong></td>
											<td><input type="text" id="n<?php echo $row['month_id'] ?>" name="bulan_bill[]" class="form-control numeric" required="">
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-success">Simpan</button>
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
			<?php foreach ($month as $row): ?>
			$("#n<?php echo $row['month_id'] ?>").val(allTarif);
			<?php endforeach ?>
		}
	});


</script>