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
			<div class="col-md-12">
				<div class="box">
					<div class="box-header">
						<a href="<?php echo site_url('manage/payment/add') ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah</a>

						<div class="box-tools">
							<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
							<div class="input-group input-group-sm" style="width: 250px;">
								<input type="text" id="field" autofocus name="n" <?php echo (isset($f['n'])) ? 'placeholder="'.$f['n'].'"' : 'placeholder="POS/Nama Pembayaran"' ?> class="form-control">
								<div class="input-group-btn">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</div>
							<?php echo form_close(); ?>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive">
						<table class="table table-hover">
							<tr>
								<th>POS</th>
								<th>Nama Pembayaran</th>
								<th>Tipe</th>
								<th>Tahun Pelajaran</th>
								<th>Tarif Pembayaran</th>
								<th>Aksi</th>
							</tr>
							<tbody>
								<?php
								if (!empty($payment)) {
									foreach ($payment as $row):
										?>
										<tr>
											<td><?php echo $row['pos_name']; ?></td>
											<td><?php echo $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end']; ?></td>
											<td><?php echo ($row['payment_type'] == 'BULAN') ? 'Bulanan' : 'Bebas' ?></td>
											<td><?php echo $row['period_start'].'/'.$row['period_end']; ?></td>
											<td>
												<?php if ($row['payment_type'] == 'BULAN') { ?>
												<a data-toggle="tooltip" data-placement="top" title="Ubah"
												class="btn btn-primary btn-xs"
												href="<?php echo site_url('manage/payment/view_bulan/' . $row['payment_id']) ?>">
												Setting Tarif Pembayaran
											</a>
											<?php } else { ?>
											<a data-toggle="tooltip" data-placement="top" title="Ubah"
											class="btn btn-primary btn-xs"
											href="<?php echo site_url('manage/payment/view_bebas/' . $row['payment_id']) ?>">
											Setting Tarif Pembayaran
										</a>
										<?php }?>
									</td>


									<td>
										<a href="<?php echo site_url('manage/payment/edit/' . $row['payment_id']) ?>" class="btn btn-xs btn-success" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>

									</td>	
								</tr>
								<?php
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