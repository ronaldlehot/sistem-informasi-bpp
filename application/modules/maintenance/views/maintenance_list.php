
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small>List</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?php echo site_url('manage') ?>"><i class="fa fa-th"></i> Home</a></li>
			<li class="active"><?php echo isset($title) ? '' . $title : null; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-warning">
					<div class="box-header">
						<div class="col-md-6">
							<a href="<?php echo site_url('manage/maintenance/backup') ?>">
							<i class="fa fa-database" style="color:#03C9A9; font-size: 90pt"></i><br>
							Backup Database</a>
						</div>
						<div class="col-md-6">
							<div class="alert alert-danger pull-left">
								Warning!... !<br>
								Halaman ini digunakan untuk membackup seluruh database yang digunakan pada sistem ini.
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</section>
	<!-- /.content -->
</div>