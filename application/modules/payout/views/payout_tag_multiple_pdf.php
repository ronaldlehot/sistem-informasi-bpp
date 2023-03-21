<!DOCTYPE html>
<html>
<head>
	<title>Tagihan Lainnya</title>
</head>

<style type="text/css">
@page {
	margin-top: 0.5cm;
	/*margin-bottom: 0.1em;*/
	margin-left: 1cm;
	margin-right: 1cm;
	margin-bottom: 0.1cm;
}
.name-school{
	font-size: 15pt;
	font-weight: bold;
	padding-bottom: -15px;
}
.alamat{
	font-size: 9pt;
	margin-bottom: -10px;
}
.detail{
	font-size: 10pt;
	font-weight: bold;
	padding-top: -15px;
	padding-bottom: -12px;
}
body {
	font-family: sans-serif;
}
table {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: none;
	/*border-color: #666666;*/
	border-collapse: collapse;
	width: 100%;
}

th {
	padding-bottom: 8px;
	padding-top: 8px;
	border-color: #666666;
	background-color: #dedede;
	/*border-bottom: solid;*/
	text-align: left;
}

td {
	text-align: left;
	border-color: #666666;
	background-color: #ffffff;
}

hr {
	border: none;
	height: 1px;
	/* Set the hr color */
	color: #333; /* old IE */
	background-color: #333; /* Modern Browsers */
}
.container {
	position: relative;
}

.topright {
	position: absolute;
	top: 0;
	right: 0;
	font-size: 18px;
	border-width: thin;
	padding: 5px;
}
.topright2 {
	position: absolute;
	top: 30px;
	right: 50px;
	font-size: 18px;
	border: 1px solid;
	padding: 5px;
	color: red;
}
</style>
<body>

	<div class="container">
		<div class="topright">Bukti Pembayaran</div>
	</div>
	<p class="name-school"><?php echo $setting_school['setting_value'] ?></p>
	<p class="alamat"><?php echo $setting_address['setting_value'] ?><br>
		<?php echo $setting_phone['setting_value'] ?></p>
		<hr>
		<table style="padding-top: -5px; padding-bottom: 5px">
			<tbody>
				<tr>
					<td style="width: 100px;">NIS</td>
					<td style="width: 5px;">:</td>
					<?php foreach ($printtag as $row): ?>
					<td style="width: 150px;"><?php echo $row['student_nis']?></td>
				<?php endforeach ?>
					<td style="width: 130px;">Tanggal Bayar</td>
					<td style="width: 5px;">:</td>
					<td style="width: 131px;"><?php echo pretty_date(date('d-m-Y'),'d F Y',false)?></td>
				</tr>
				<tr>
					<td style="width: 100px;">Nama</td>
					<td style="width: 5px;">:</td>
					<?php foreach ($printtag as $row): ?>
					<td style="width: 150px;"><?php echo $row['student_full_name']?></td>
					<?php endforeach ?>
					<td style="width: 130px;">Jenis Pembayaran</td>
					<td style="width: 5px;">:</td>
					<?php foreach ($printtag as $row): ?>
					<td style="width: 131px;"><?php echo ($row['payment_type'] == 'BULAN') ? 'Bulanan' : 'Lainnya' ?></td>
					<?php endforeach ?>
				</tr>
				<tr>
					<td style="width: 100px;">Kelas</td>
					<td style="width: 5px;">:</td>
					<?php foreach ($printtag as $row): ?>
					<td style="width: 150px;"><?php echo $row['class_name']?></td>
					<?php endforeach ?>
					<td style="width: 130px;">Tahun Ajaran</td>
					<td style="width: 5px;">:</td>
					<?php foreach ($printtag as $row): ?>
					<td style="width: 131px;"><?php echo $row['period_year']?></td>
					<?php endforeach ?>
				</tr>
			</tbody>
		</table>
		<hr>
		<p class="detail">Dengan rincian pembayaran sebagai berikut:</p>

		<table style="border-style: solid;">
			<tr>
				<th style="border-top: 1px solid; border-bottom: 1px solid;">No.</th>
				<th style="border-top: 1px solid; border-bottom: 1px solid;">Pembayaran</th>
				<th style="border-top: 1px solid; border-bottom: 1px solid;">Total Tagihan</th>
				<th style="border-top: 1px solid; border-bottom: 1px solid;">Jumlah Pembayaran</th>
				<th style="border-top: 1px solid; border-bottom: 1px solid;">Keterangan</th>
			</tr>
			<?php
				$i =1;
				foreach ($bbs as $row) :
				 ?>
			<tr>
				<td style="border-bottom: 1px solid;padding-top: 15px; padding-bottom: 15px;"><?php echo $i ?></td>
				<td style="border-bottom: 1px solid;"><?php echo $row['payment_name'] ?></td>
				<td style="border-bottom: 1px solid"><?php echo 'Rp. ' . number_format($row['bebas_bill'], 0, ',', '.') ?></td>
				<td style="border-bottom: 1px solid;"><?php echo 'Rp. ' . number_format($row['bebas_total_pay'], 0, ',', '.') ?></td>
				<td style="border-bottom: 1px solid;"><?php echo ($row['bebas_bill'] == $row['bebas_total_pay']) ? 'Lunas' : 'Belum Lunas' ?></td>
			</tr>
			<?php 
				$i++;
				endforeach ?>
			
			<tr>
				<td colspan="2" style="text-align: center;padding-top: 5px; padding-bottom: 5px;"><?php echo $setting_district['setting_value'] ?>, <?php echo pretty_date(date('Y-m-d'),'d F Y',false) ?></td>
				<td>&nbsp;</td>
				<td style="background-color: #dedede; font-weight:bold; border-bottom: 1px solid;">Sisa Tagihan</td>
				<td style="background-color: #dedede; font-weight:bold;border-bottom: 1px solid;"><?php echo 'Rp. ' . number_format($bill - $pay, 0, ',', '.') ?></td>
			</tr>
			
			<tr>
				<td colspan="2" style="text-align: center"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="2" style="text-align: center">(<?php echo ucfirst($this->session->userdata('ufullname')); ?>)</td>
			</tr>
		</table>
		<br>
		
		

		

	</body>
	</html>