<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo isset($title) ? '' . $title : null; ?>
			<small></small>
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
						<h3 class="box-title"></h3>

						<div class="box-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

								<div class="input-group-btn">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>No</th>
								<th>log id</th>
								<th>bulan id</th>
								<th>bebas id </th>
								<th>studend it</th>
								<th>start update</th>
								<th>last update</th>

								<!-- <th>Penulis</th> -->
							</tr>
							<tbody>
								<?php
								if (!empty($ltrx)) {
									$i = 1;
									foreach ($ltrx as $row):
										?>
										<tr>
											<td><?php echo $i; ?></td>
											<td><?php echo $row['log_trx_id']; ?></td>
											<td><?php echo $row['bulan_bulan_id']; ?></td>
											<td><?php echo $row['bebas_pay_bebas_pay_id']; ?></td>
											<td><?php echo $row['student_student_id']; ?></td>	
											<td><?php echo $row['log_trx_input_date']; ?></td>
											<td><?php echo $row['log_trx_last_update']; ?></td>
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