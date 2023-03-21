<!DOCTYPE html>
<html>
<head>
	<title><?php echo $printpay['student_nis'].'_'.$printpay['student_full_name'] ?></title>
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
	border-collapse: collapse;
	font-size: 9pt;
	width: 100%
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
	/*border: 1px solid;*/
	border-width: thin;
	padding: 5px;
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
					<td style="width: 150px;"><?php echo $printpay['student_nis']?></td>
					<td style="width: 130px;">Tanggal Bayar</td>
					<td style="width: 5px;">:</td>
					<td style="width: 131px;"><?php echo pretty_date($printpay['bulan_date_pay'],'d F Y',false)?></td>
				</tr>
				<tr>
					<td style="width: 100px;">Nama</td>
					<td style="width: 5px;">:</td>
					<td style="width: 150px;"><?php echo $printpay['student_full_name']?></td>
					<td style="width: 130px;">No. Ref</td>
					<td style="width: 5px;">:</td>
					<td style="width: 131px;"><?php echo $printpay['bulan_number_pay'] ?></td>
				</tr>
				<tr>
					<td style="width: 100px;">Kelas</td>
					<td style="width: 5px;">:</td>
					<td style="width: 150px;"><?php echo $printpay['class_name']?></td>
					<td style="width: 130px;">Tahun Ajaran</td>
					<td style="width: 5px;">:</td>
					<td style="width: 131px;"><?php echo $printpay['period_year']?></td>
				</tr>
			</tbody>
		</table>
		<hr>
		<p class="detail">Dengan rincian pembayaran sebagai berikut:</p>
		<hr>
		<table style="padding-bottom:-15px">
			<tbody>
				<tr>
					<td style="width: 20px;">1.</td>
					<td style="width: 411px;"><?php echo $printpay['payment_name'].' ('.$printpay['month_name'].')'?></td>
					<td style="width: 81px;text-align: right;">Rp.</td>
					<td style="width: 156px; text-align: right;"><?php echo number_format($printpay['bulan_bill'], 0, ',', '.') ?></td>
				</tr>
			</tbody>
		</table>
		<br>
		<hr>
		<table>
			<tbody>
				<tr>
					<td style="width: 10px;">&nbsp;</td>
					<td style="width: 240px;text-align: center;"><?php echo $setting_district['setting_value'] ?>, <?php echo pretty_date(date('Y-m-d'),'d F Y',false) ?></td>
					<td style="width: 262px;text-align: right;"><strong>Jumlah Rp.</strong></td>
					<td style="width: 156px; text-align: right;"><strong><?php echo number_format($printpay['bulan_bill'], 0, ',', '.') ?></strong></td>
				</tr>
				<tr>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td></td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td></td>
					<td style="width: 200px;text-align: center;">(<?php echo ucfirst($this->session->userdata('ufullname')); ?>)</td>
				</tr>
			</tbody>
		</table>

	</body>
	</html>