  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php if ($this->session->userdata('student_img') != null) { ?>
          <img src="<?php echo upload_url().'/student/'.$this->session->userdata('student_img'); ?>" class="img-responsive">
          <?php } else { ?>
          <img src="<?php echo media_url() ?>img/user.png" class="img-responsive">
          <?php } ?>
        </div>
        <div class="pull-left info">
          <p><?php echo ucfirst($this->session->userdata('ufullname_student')); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <div style="margin-top: 20px"></div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>

        <li class="<?php echo ($this->uri->segment(2) == 'dashboard' OR $this->uri->segment(2) == NULL) ? 'active' : '' ?>">
          <a href="<?php echo site_url('student'); ?>">
            <i class="fa fa-th"></i> <span>Dashboard</span>
            <span class="pull-right-container"></span>
          </a>
        </li>


      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>