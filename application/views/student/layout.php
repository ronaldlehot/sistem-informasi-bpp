<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $this->config->item('app_name') ?> <?php echo isset($title) ? ' | ' . $title : null; ?></title>
  <link rel="icon" type="image/png" href="<?php echo media_url('ico/favicon.ico') ?>">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo media_url() ?>/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo media_url() ?>/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo media_url() ?>/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo media_url() ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo media_url() ?>/css/load-font-googleapis.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <!-- Notyfy JS - Notification -->
   <link rel="stylesheet" href="<?php echo media_url() ?>css/jquery.notyfy.css">
   <link rel="stylesheet" href="<?php echo media_url() ?>/css/skin-purple-light.css">
   <!-- Date Picker -->
   <link rel="stylesheet" href="<?php echo media_url() ?>/css/bootstrap-datepicker.min.css">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="<?php echo media_url() ?>/css/daterangepicker.css">
   <link href="<?php echo base_url('/media/js/fullcalendar/fullcalendar.css');?>" rel="stylesheet">

   <script src="<?php echo media_url() ?>/js/jquery.min.js"></script>
   <script src="<?php echo media_url() ?>/js/angular.min.js"></script>
   <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo media_url() ?>/js/jquery-ui.min.js"></script>
   <script src="<?php echo media_url() ?>/js/jquery.inputmask.bundle.js"></script>
   
<script src="<?php echo base_url('/media/js/fullcalendar/fullcalendar.js');?>"></script>
   

 </head>
 <body class="hold-transition skin-purple-light fixed sidebar-mini" <?php echo isset($ngapp) ? $ngapp : null; ?>>
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php site_url('student') ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <?php if (!empty(logo())) { ?>
        <span class="logo-mini"><img src="<?php echo upload_url('school/' . logo()) ?>" style="height: 40px; margin-top: 5px; margin-left:5px;" class="pull-left"></span>
        <?php } else { ?>
        <span class="logo-mini"><img src="<?php echo media_url('ico/favicon.ico') ?>" style="height: 40px; margin-top: 5px; margin-left:5px;" class="pull-left"></span>
        <?php } ?>
        <?php if (!empty(logo())) { ?>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><img src="<?php echo upload_url('school/' . logo()) ?>" style="height: 40px; margin-top: 5px;" class="pull-left"><b>&nbsp;<?php echo $this->config->item('app_name') ?></b></span>
        <?php } else { ?>
        <span class="logo-lg"><img src="<?php echo media_url('ico/favicon.ico') ?>" style="height: 40px; margin-top: 5px;" class="pull-left"><b>&nbsp;<?php echo $this->config->item('app_name') ?></b></span>
        <?php } ?>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if ($this->session->userdata('student_img') != null) { ?>
                <img src="<?php echo upload_url().'/student/'.$this->session->userdata('student_img'); ?>" class="user-image">
                <?php } else { ?>
                <img src="<?php echo media_url() ?>img/user.png" class="user-image">
                <?php } ?>
                <span class="hidden-xs"><?php echo ucfirst($this->session->userdata('ufullname_student')); ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <?php if ($this->session->userdata('student_img') != null) { ?>
                  <img src="<?php echo upload_url().'/student/'.$this->session->userdata('student_img'); ?>" class="img-circle">
                  <?php } else { ?>
                  <img src="<?php echo media_url() ?>img/user.png" class="img-circle">
                  <?php } ?>

                  <p>
                    <?php echo ucfirst($this->session->userdata('ufullname_student')); ?>
                    <small><?php echo $this->session->userdata('unis_student'); ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo site_url('student/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo site_url('student/auth/logout?location=' . htmlspecialchars($_SERVER['REQUEST_URI'])) ?>" class="btn btn-default btn-flat">Keluar</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header> 

    <?php $files = glob('media/barcode_student/*');
    foreach($files as $file) { // iterate files
      if(is_file($file))
    unlink($file); // delete file
    } ?>

    <?php $this->load->view('student/sidebar'); ?>
    <!-- Content Wrapper. Contains page content -->
    <?php isset($main) ? $this->load->view($main) : null; ?>
    <!-- Content Wrapper. Contains page content -->

    
    <!-- /.content-wrapper -->
    <footer class="main-footer hidden-xs">
      <div class="pull-right hidden-xs">
        <?php echo $this->config->item('app_name').' '.$this->config->item('version') ?>
      </div>
      <p class="hidden-xs"><?php echo $this->config->item('created') ?></p>
    </footer>
    <div class="navbar navbar-default navbar-fixed-bottom hidden-lg hidden-md hidden-sm">
      <div class="bott-bar hidden-lg hidden-md hidden-sm">
      <div class="pos-bar">
        <a class="content-bar <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == NULL) ? 'active' : '' ?>" href="<?php echo site_url('student') ?>">
          <div class="group-bot-bar">
            <i class="fa fa-th icon-bot-bar"></i>
            <p class="text-bot-bar">Dashboard</p>
          </div>
        </a>
        <a class="content-bar <?php echo ($this->uri->segment(2) == 'payout') ? 'active' : '' ?>" href="<?php echo site_url('student/payout') ?>">
          <div class="group-bot-bar">
            <i class="fa fa-calendar icon-bot-bar"></i>
            <p class="text-bot-bar">Bulanan</p>
          </div>
        </a>
        <a class="content-bar <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == NULL) ? 'active' : '' ?>" href="<?php echo site_url('student') ?>">
          <div class="group-bot-bar">
            <i class="fa fa-home icon-bot-bar"></i>
            <p class="text-bot-bar">Home</p>
          </div>
        </a>
        <a class="content-bar <?php echo ($this->uri->segment(1) == 'student' && $this->uri->segment(2) == NULL) ? 'active' : '' ?>" href="<?php echo site_url('student') ?>">
          <div class="group-bot-bar">
            <i class="fa fa-home icon-bot-bar"></i>
            <p class="text-bot-bar">Home</p>
          </div>
        </a>
        <a class="content-bar <?php echo ($this->uri->segment(2) == 'profile' && $this->uri->segment(3) == NULL) ? 'active' : '' ?>" href="<?php echo site_url('student/profile') ?>">
          <div class="group-bot-bar">
            <i class="fa fa-user icon-bot-bar"></i>
            <p class="text-bot-bar">Profile</p>
          </div>
        </a>
      </div>
    </div>
      </div>

    </div>

    <!-- jQuery 3 -->

    
    
    
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo media_url() ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo media_url() ?>/js/moment.min.js"></script>
   
   <script src="<?php echo media_url() ?>/js/fullcalendar.min.js"></script>

    
    <!-- daterangepicker -->
    <script src="<?php echo media_url() ?>/js/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="<?php echo media_url() ?>/js/bootstrap-datepicker.min.js"></script>
    <!-- SlimScroll -->
    <script src="<?php echo media_url() ?>/js/jquery.slimscroll.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo media_url() ?>/js/adminlte.min.js"></script>
    <!-- Notyfy JS -->
    <script src="<?php echo media_url() ?>/js/jquery.notyfy.js"></script>
    <script>
      $(".input-group.date").datepicker({autoclose: true, todayHighlight: true});
    </script>

    <?php if ($this->session->flashdata('success')) { ?>
    <script>
      $(function () {
        notyfy({
          layout: 'top',
          type: 'success',
          showEffect: function (bar) {
            bar.animate({height: 'toggle'}, 500, 'swing');
          },
          hideEffect: function (bar) {
            bar.animate({height: 'toggle'}, 500, 'swing');
          },
          timeout: 3000,
          text: '<?php echo $this->session->flashdata('success') ?>'
        });
      });
    </script>
    <?php } ?>

    <script>
      $(function separator() {
        $('.numeric').inputmask("numeric", {
          removeMaskOnSubmit: true,
          radixPoint: ".",
          groupSeparator: ",",
          digits: 2,
          autoGroup: true,
            prefix: 'Rp ', //Space after $, this will not truncate the first character.
            rightAlign: false,
            // oncleared: function() {
            //   self.Value('');
            // }
          });
      });
    </script>

    <script>
      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
      });
    </script>

  </body>
  </html>
