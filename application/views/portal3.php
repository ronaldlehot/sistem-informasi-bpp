<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SPPS | Portal</title>
	<link rel="icon" type="image/png" href="<?php echo media_url('ico/favicon.ico') ?>">

	<!-- Bootstrap Core CSS -->
	<link href="<?php echo media_url() ?>/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo media_url() ?>/css/load-font-googleapis.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo media_url() ?>/css/font-awesome.min.css">


	<!-- Custom CSS -->
	<link href="<?php echo media_url() ?>/css/frontend-style.css" rel="stylesheet">
	<link href="<?php echo media_url() ?>/css/portal.css" rel="stylesheet">

</head>

<body>

	<!-- Home -->
	<section class="content-section">
		<div class="container text-center">
			<div class="row">
				<div class="col-md-12">
					<h2><i class="fa fa-graduation-cap"></i> Selamat Datang</h2>
					<p class="lead mb-5 colr">Sistem Pembayaran Pendidikan Sekolah</p>
				</div>
				<div class="col-md-4">
					<a href="<?php echo site_url('manage') ?>">
					<div class="box">
						<i class="fa fa-desktop icon-menu"></i>
						<br>
						Login Admin
					</div>
				</a>
				</div>
				<div class="col-md-4">
					<a href="<?php echo site_url('home') ?>">
					<div class="box">
						<i class="fa fa-credit-card icon-menu"></i>
						<br>
						Cek Pembayaran Siswa
					</div>
				</a>
				</div>
				<div class="col-md-4">
					<a href="<?php echo site_url('student') ?>">
					<div class="box">
						<i class="fa fa-users icon-menu"></i>
						<br>
						Login Siswa
					</div>
				</a>
				</div>
			</div>
		</div>
	</section>


</body>

</html>
