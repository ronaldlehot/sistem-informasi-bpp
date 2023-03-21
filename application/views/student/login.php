<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>SMAN 5 KOTA KUPANG</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" type="image/png" href="<?php echo media_url('ico/favicon.ico') ?>">

  <link href="<?php echo media_url() ?>css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo media_url() ?>css/font-awesome.min.css" rel="stylesheet" />
  <link href="<?php echo media_url() ?>css/login.css" rel="stylesheet" />

  <style>
   

   @keyframes float {
     0% {
       transform: translatey(0px);
     }
     50% {
       transform: translatey(-20px);
     }
     100% {
       transform: translatey(0px);
     }
   }

 </style>


</head>
<body>


  <div class="row">
    <div class="col-md-5">
      <div class="logo hidden-xs hidden-sm">
        <?php if (isset($setting_logo) AND $setting_logo['setting_value'] == NULL) { ?>
        <img  style="animation: float 3s linear infinite;" src="<?php echo media_url('img/logo.kemendikbud.png') ?>" class="img-responsive">
        <?php } else { ?>
        <img src="<?php echo upload_url('school/' . $setting_logo['setting_value']) ?>" class="img-responsive">
        <?php } ?>
      </div>
      <p  style="animation: float 3s linear infinite;" class="merk"><span style="color: #2ABB9B">SISTEM INFORMASI PEMBAYARAN BPP</span> </p> 
      <?php if (isset($setting_school) AND $setting_school['setting_value'] == '-') { ?>
      <p  style="animation: float 3s linear infinite;" class="school">Sistem Informasi Pembayaran BPP </p> 
      <?php } else { ?>
      <p class="school"><?php echo $setting_school['setting_value'] ?></p> 
      <?php } ?> 
    </div>
    <div class="col-md-7">
      <div class="box">
        <?php echo form_open('student/auth/login', array('class'=>'login100-form validate-form')); ?>

        <div class="col-md-12">
          <p   class="title-login">Login Siswa</p>
          <?php if ($this->session->flashdata('failed')) { ?>
          <br><br>
        <div class="alert alert-danger alert-dismissible" style="margin-top: -85px !important;">
          <h5><i class="fa fa-close"></i> NIS atau Password salah!</h5>
        </div>
        <?php  }  ?>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>NIS</label>
                <input type="text" required="" autofocus="" name="nis" placeholder="Masukan NIS" class="form-control flat">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
                <input type="password" required="" name="password" placeholder="Masukan password" class="form-control flat">
              </div>
            </div>
          </div>
          <button class="btn btn-login">Login</button>
          <a style="margin-left:20px;" href="<?php echo site_url('welcome') ?>" class="btn btn-login">Keluar</a>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>


</body>
</html>
