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
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive">
						<table class="table table-hover">
							<tr>
								<th>No</th>
								<th>Nama Bulan</th>
								<th>Aksi</th>
							</tr>
							<tbody>
								<?php
								if (!empty($month)) {
									$i = 1;
									foreach ($month as $row):
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['month_name']; ?></td>
											<td>
												<a href="<?php echo site_url('manage/month/edit/' . $row['month_id']) ?>" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
											</td>	
										</tr>
											<?php
											$i++;
										endforeach;
									} else {
										?>
										<tr id="row">
											<td colspan="3" align="center">Data Kosong</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<!-- /.box-body -->
						</div>
						<div>
							<?php echo $this->pagination->create_links(); ?>
						</div>
						<!-- /.box -->
					</div>
				</div>
			</section>
			<!-- /.content -->
		</div>