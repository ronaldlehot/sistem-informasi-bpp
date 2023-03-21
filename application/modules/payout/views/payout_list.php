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
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Filter Data Pembayaran Siswa</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
						<div class="form-group">						
							<label for="" class="col-sm-2 control-label">Tahun Pelajaran</label>
							<div class="col-sm-2">
								<select class="form-control" name="n">
									<?php foreach ($period as $row): ?>
										<option <?php echo (isset($f['n']) AND $f['n'] == $row['period_id']) ? 'selected' : '' ?> value="<?php echo $row['period_id'] ?>"><?php echo $row['period_start'].'/'.$row['period_end'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<label for="" class="col-sm-2 control-label">NIS Siswa</label>
							<div class="col-sm-3">
								<div class="input-group">
									<input type="text" class="form-control" autofocus name="r" <?php echo (isset($f['r'])) ? 'placeholder="'.$f['r'].'"' : 'placeholder="Masukan NIS Siswa"' ?> required>
									<span class="input-group-btn">
										<button class="btn btn-success" type="submit">Cari</button>


						
									</span>
								</div>
							</div>
						</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->

			<?php if ($f) { ?>

				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">Informasi Siswa</h3>
						<?php if ($f['n'] AND $f['r'] != NULL) { ?>
							<a href="<?php echo site_url('manage/payout/printBill' . '/?' . http_build_query($f)) ?>" target="_blank" class="btn btn-danger btn-xs pull-right">Cetak Semua Tagihan</a>
						<?php } ?>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="col-md-9">
							<table class="table table-striped">
								<tbody>
									<tr>
										<td width="200">Tahun Ajaran</td><td width="4">:</td>
										<?php foreach ($period as $row): ?>
											<?php echo (isset($f['n']) AND $f['n'] == $row['period_id']) ? 
											'<td><strong>'.$row['period_start'].'/'.$row['period_start'].'<strong></td>' : '' ?> 
										<?php endforeach; ?>
									</tr>
									<tr>
										<td>NIS</td>
										<td>:</td>
										<?php foreach ($siswa as $row): ?>
											<?php echo (isset($f['n']) AND $f['r'] == $row['student_nis']) ? 
											'<td>'.$row['student_nis'].'</td>' : '' ?> 
										<?php endforeach; ?>
									</tr>
									<tr>
										<td>Nama Siswa</td>
										<td>:</td>
										<?php foreach ($siswa as $row): ?>
											<?php echo (isset($f['n']) AND $f['r'] == $row['student_nis']) ? 
											'<td>'.$row['student_full_name'].'</td>' : '' ?> 
										<?php endforeach; ?>
									</tr>
									<tr>
										<td>Nama Ibu Kandung</td>
										<td>:</td>
										<?php foreach ($siswa as $row): ?>
											<?php echo (isset($f['n']) AND $f['r'] == $row['student_nis']) ?  
											'<td>'.$row['student_name_of_mother'].'</td>' : '' ?> 
										<?php endforeach; ?>
									</tr>
									<tr>
										<td>Kelas</td>
										<td>:</td>
										<?php foreach ($siswa as $row): ?>
											<?php echo (isset($f['n']) AND $f['r'] == $row['student_nis']) ? 
											'<td>'.$row['class_name'].'</td>' : '' ?> 
										<?php endforeach; ?>
									</tr>
									<?php if (majors() == 'senior') { ?>
										<tr>
											<td>Program Keahlian</td>
											<td>:</td>
											<?php foreach ($siswa as $row): ?>
												<?php echo (isset($f['n']) AND $f['r'] == $row['student_nis']) ? 
												'<td>'.$row['majors_name'].'</td>' : '' ?> 
											<?php endforeach; ?>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<div class="col-md-3">
							<?php foreach ($siswa as $row): ?>
								<?php if (isset($f['n']) AND $f['r'] == $row['student_nis']) { ?> 
									<?php if (!empty($row['student_img'])) { ?>
										<img src="<?php echo upload_url('student/'.$row['student_img']) ?>" class="img-thumbnail img-responsive">
									<?php } else { ?>
										<img src="<?php echo media_url('img/user.png') ?>" class="img-thumbnail img-responsive">
									<?php } 
								} ?>
							<?php endforeach; ?>
						</div>
					</div>
				</div>

				<div class="row">

					<div class="col-md-5">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Transaksi Terakhir</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
								<table class="table table-responsive table-bordered" style="white-space: nowrap;">
									<tr class="info">
										<th>Pembayaran</th>
										<th>Tagihan</th>
										<th>Tanggal</th>
									</tr>
									<?php 
									foreach ($log as $key) :
									?>
									<tr>
										<td><?php echo ($key['bulan_bulan_id']!= NULL) ? $key['posmonth_name'].' - T.A '.$key['period_start_month'].'/'.$key['period_end_month'].' ('.$key['month_name'].')' : $key['posbebas_name'].' - T.A '.$key['period_start_bebas'].'/'.$key['period_end_bebas'] ?></td>
										<td><?php echo ($key['bulan_bulan_id']!= NULL) ? 'Rp. '. number_format($key['bulan_bill'], 0, ',', '.') : 'Rp. '. number_format($key['bebas_pay_bill'], 0, ',', '.') ?></td>
										<td><?php echo pretty_date($key['log_trx_input_date'],'d F Y',false)  ?></td>
									</tr>
								<?php endforeach ?>

								</table>
							</div>
						</div>
						</div>
					
					<div class="col-md-4">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Pembayaran</h3>
							</div>
							<div class="box-body">
								<form id="calcu" name="calcu" method="post" action="">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Total</label>
												<input type="text" class="form-control numeric" value="<?php echo $cash+$cashb ?>" name="harga" id="harga" placeholder="Total Pembayaran" onfocus="startCalculate()" onblur="stopCalc()">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Dibayar</label>
												<input type="text" class="form-control numeric" value="<?php echo $cash+$cashb ?>" name="bayar" id="bayar" placeholder="Jumlah Uang" onfocus="startCalculate()" onblur="stopCalc()">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Kembalian</label>
										<input type="text" class="form-control numeric" readonly="" name="kembalian" id="kembalian" onblur="stopCalc()">
									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="col-md-3">
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Cetak Bukti Pembayaran</h3>
							</div><!-- /.box-header -->
							<div class="box-body">
								<form action="<?php echo site_url('manage/payout/cetakBukti') ?>" method="GET" class="view-pdf">
									<input type="hidden" name="n" value="<?php echo $f['n'] ?>">
									<input type="hidden" name="r" value="<?php echo $f['r'] ?>">
									<div class="form-group">
										<label>Tanggal Transaksi</label>
										<div class="input-group date " data-date="<?php echo date('Y-m-d') ?>" data-date-format="yyyy-mm-dd">
											<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
											<input class="form-control" readonly="" required="" type="text" name="d" value="<?php echo date('Y-m-d') ?>">
										</div>
									</div>
									<button class="btn btn-success btn-block" formtarget="_blank" type="submit">Cetak</button>
								</form>
							</div>
						</div>
					</div>

				</div>



				<!-- List Tagihan Bulanan --> 
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Jenis Pembayaran</h3>
					</div><!-- /.box-header -->
					<div class="box-body">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1" data-toggle="tab">Bulanan</a></li>
								<li><a href="#tab_2" data-toggle="tab">Bebas</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">
									<div class="box-body table-responsive">
										<table class="table table-bordered" style="white-space: nowrap;">
											<thead>
												<tr class="info">
													<th>No.</th>
													<th>Nama Pembayaran</th>
													<th>Sisa Tagihan</th>
													<?php foreach ($bulan as $key) : ?>
														<th><?php echo $key['month_name'] ?></th>
													<?php endforeach ?>
												</tr>
											</thead>
											<tbody>
												<?php
												$i =1;
												foreach ($student as $row):
													if ($f['n'] AND $f['r'] == $row['student_nis']) {
														?>
														<tr>
															<td><?php echo $i ?></td>
															<td><?php echo $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'] ?></td>
															<td><?php echo ($total == $pay) ? 'Rp. -' : 'Rp. '.number_format($total-$pay,0,',','.') ?></td>
															<?php foreach ($bulan as $row) : ?>
																<td class="<?php echo ($row['bulan_status'] ==1) ? 'success' : 'danger' ?>"><a href="<?php echo ($row['bulan_status'] ==0) ? site_url('manage/payout/pay/' . $row['payment_payment_id'].'/'.$row['student_student_id'].'/'.$row['bulan_id']) : site_url('manage/payout/not_pay/' . $row['payment_payment_id'].'/'.$row['student_student_id'].'/'.$row['bulan_id'])?>" onclick="return confirm('<?php echo ($row['bulan_status']==0) ? 'Anda Akan Melakukan Pembayaran bulan '.$row['month_name'].'?' : 'Anda Akan Menghapus Pembayaran bulan'.$row['month_name'].'?' ?>')">
																	<?php echo ($row['bulan_status']==1) ? '('.pretty_date($row['bulan_date_pay'],'d/m/y',false).')': number_format($row['bulan_bill'], 0, ',', '.') ?></a></td>
																<?php endforeach ?>

															</tr>
															<?php 
														}
														$i++;
													endforeach; 
													?>					
												</tbody>
											</table>
										</div>
									</div>
									<div class="tab-pane" id="tab_2">
										<!-- End List Tagihan Bulanan -->

										<!-- List Tagihan Lainnya (Bebas) -->

										<div class="box-body">
											<a href="" class="btn btn-info btn-xs"><i class="fa fa-refresh"></i> Refresh</a>
											<table class="table table-hover table-responsive table-bordered" style="white-space: nowrap;">
												<thead>
													<tr class="info">
														<th>No.</th>
														<th>Jenis Pembayaran</th>
														<th>Total Tagihan</th>
														<th>Dibayar</th>
														<th>Status</th>
														<th>Bayar</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$i =1;
													foreach ($bebas as $row):
														if ($f['n'] AND $f['r'] == $row['student_nis']) {
															$sisa = $row['bebas_bill']-$row['bebas_total_pay'];
															?>
															<tr class="<?php echo ($row['bebas_bill'] == $row['bebas_total_pay']) ? 'success' : 'danger' ?>">
																<td style="background-color: #fff !important;"><?php echo $i ?></td>
																<td style="background-color: #fff !important;"><?php echo $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'] ?></td>
																<td><?php echo 'Rp. ' . number_format($sisa, 0, ',', '.') ?></td>
																<td><?php echo 'Rp. ' . number_format($row['bebas_total_pay'], 0, ',', '.') ?></td>
																<td><a href="<?php echo site_url('manage/payout/payout_bebas/'. $row['payment_payment_id'].'/'.$row['student_student_id'].'/'.$row['bebas_id']) ?>" class="view-cicilan label <?php echo ($row['bebas_bill']==$row['bebas_total_pay']) ? 'label-success' : 'label-warning' ?>"><?php echo ($row['bebas_bill']==$row['bebas_total_pay']) ? 'Lunas' : 'Belum Lunas' ?></a></td>
																<td width="40" style="text-align:center">
																	<a data-toggle="modal" class="btn btn-success btn-xs <?php echo ($row['bebas_bill']==$row['bebas_total_pay']) ? 'disabled' : '' ?>" title="Bayar" href="#addCicilan<?php echo $row['bebas_id'] ?>"><span class="fa fa-money"></span> Bayar</a>
																</td>
															</tr>

															<div class="modal fade" id="addCicilan<?php echo $row['bebas_id'] ?>" role="dialog">
																<div class="modal-dialog modal-md">
																	<div class="modal-content">
																		<div class="modal-header">
																			<button type="button" class="close" data-dismiss="modal">&times;</button>
																			<h4 class="modal-title">Tambah Pembayaran/Cicilan</h4>
																		</div>
																		<?php echo form_open('manage/payout/payout_bebas/', array('method'=>'post')); ?>
																		<div class="modal-body">
																			<input type="hidden" name="bebas_id" value="<?php echo $row['bebas_id'] ?>">
																			<input type="hidden" name="student_nis" value="<?php echo $row['student_nis'] ?>">
																			<input type="hidden" name="student_student_id" value="<?php echo $row['student_student_id'] ?>">
																			<input type="hidden" name="payment_payment_id" value="<?php echo $row['payment_payment_id'] ?>">
																			<div class="form-group">
																				<label>Nama Pembayaran</label>
																				<input class="form-control" readonly="" type="text" value="<?php echo $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'] ?>">
																			</div>
																			<div class="form-group">
																				<label>Tanggal</label>
																				<input class="form-control" readonly="" type="text" value="<?php echo pretty_date(date('Y-m-d'),'d F Y',false) ?>">
																			</div>
																			<div class="row">
																				<div class="col-md-6">
																					<label>Jumlah Bayar *</label>
																					<input type="text" required="" name="bebas_pay_bill" class="form-control numeric" placeholder="Jumlah Bayar">
																				</div>
																				<div class="col-md-6">
																					<label>Keterangan *</label>
																					<input type="text" required="" name="bebas_pay_desc" class="form-control" placeholder="Keterangan">
																				</div>
																			</div>
																		</div>
																		<div class="modal-footer">
																			<button type="submit" class="btn btn-success">Simpan</button>
																			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																		</div>
																		<?php echo form_close(); ?>
																	</div>

																	<?php 
																}
																$i++;
															endforeach; 
															?>				
														</tbody>
													</table> 
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<script type="text/javascript">
			function startCalculate(){
				interval=setInterval("Calculate()",10);
			}

			function Calculate() {
									var numberHarga = $('#harga').val(); // a string
									numberHarga = numberHarga.replace(/\D/g, '');
									numberHarga = parseInt(numberHarga, 10);

									var numberBayar = $('#bayar').val(); // a string
									numberBayar = numberBayar.replace(/\D/g, '');
									numberBayar = parseInt(numberBayar, 10);

									var total = numberBayar - numberHarga;
									$('#kembalian').val(total);
								}

								function stopCalc(){
									clearInterval(interval);
								}
							</script>
							<script>
								$(document).ready(function() {
									$("#selectall").change(function() {
										$(".checkbox").prop('checked', $(this).prop("checked"));
									});
								});
							</script>

							<script type="text/javascript">
								(function(a){
									a.createModal=function(b){
										defaults={
											title:"",message:"Your Message Goes Here!",closeButton:true,scrollable:false
										};
										var b=a.extend({},defaults,b);
										var c=(b.scrollable===true)?'style="max-height: 420px;overflow-y: auto;"':"";
										html='<div class="modal fade" id="myModal">';
										html+='<div class="modal-dialog">';
										html+='<div class="modal-content">';
										html+='<div class="modal-header">';
										html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>';
										if(b.title.length>0){
											html+='<h4 class="modal-title">'+b.title+"</h4>"
										}
										html+="</div>";
										html+='<div class="modal-body" '+c+">";
										html+=b.message;
										html+="</div>";
										html+='<div class="modal-footer">';
										if(b.closeButton===true){
											html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>'
										}
										html+="</div>";
										html+="</div>";
										html+="</div>";
										html+="</div>";a("body").prepend(html);a("#myModal").modal().on("hidden.bs.modal",function(){
											a(this).remove()})}})(jQuery);

/*
* Here is how you use it
*/
$(function(){    
	$('.view-cicilan').on('click',function(){
		var link = $(this).attr('href');      
		var iframe = '<object type="text/html" data="'+link+'" width="100%" height="350">No Support</object>'
		$.createModal({
			title:'Lihat Pembayaran/Ciiclan',
			message: iframe,
			closeButton:true,
			scrollable:false
		});
		return false;        
	});    
});
</script>
