<?php

if (isset($period)) {

	$inputStartValue = $period['period_start'];
	$inputEndValue = $period['period_end'];
	$inputStatusValue = $period['period_status'];
	
} else {
	$inputStartValue = set_value('period_start');
	$inputEndValue = set_value('period_end');
	$inputStatusValue = set_value('period_status');
	
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
			<li><a href="<?php echo site_url('manage/period') ?>">Tahun Pelajaran</a></li>
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
						<?php if (isset($period)) { ?>
							<input type="hidden" name="period_id" value="<?php echo $period['period_id']; ?>">
						<?php } ?>

						<div class="form-group">
							<label>Tahun Pelajaran *</label>
							<div class="row">
								<div class="col-sm-6 col-md-6">
									<input type="text" name="period_start" readonly="" class="form-control years" onchange="getYear(this.value)" placeholder="Tahun Awal">
								</div>
								<div class="col-sm-6 col-md-6">
									<input type="text" class="form-control" readonly="" name="period_end" id="YearEnd" value="<?php echo $inputEndValue ?>" placeholder="Tahun Akhir">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label>Keterangan</label>
							<div class="radio">
								<label>
									<input type="radio" name="period_status" value="1" <?php echo ($inputStatusValue == 1) ? 'checked' : ''; ?>> Aktif
								</label> &nbsp;&nbsp;&nbsp;&nbsp;
								<label>
									<input type="radio" name="period_status" value="0" <?php echo ($inputStatusValue == 0) ? 'checked' : ''; ?>> Tidak Aktif
								</label>
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
						<button type="submit" class="btn btn-block btn-success">Simpan</button>
						<a href="<?php echo site_url('manage/period'); ?>" class="btn btn-block btn-info">Batal</a>
					</div>
					<!-- /.box-body -->
				</div>
			</div>
		</div>
		<?php echo form_close(); ?>
		<!-- /.row -->
	</section>
</div>

<script>
	function getYear(value) {

		var yearsend = parseInt(value) + 1;

		$("#YearEnd").val(yearsend);

	}

</script>
<!-- <script>
      $(".input-group.date").datepicker({autoclose: true, todayHighlight: true});
    </script> -->