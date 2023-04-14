<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-6">
       <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Pengumuman</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Indicators --> 
              <ol class="carousel-indicators ind"> 
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li> 
                <li data-target="#carousel-example-generic" data-slide-to="1"></li> 
                <li data-target="#carousel-example-generic" data-slide-to="2"></li> 
              </ol> 
              <!-- Wrapper for slides --> 
              <div class="carousel-inner"> 
                <?php
                $i = 1;
                foreach ($information as $row):
                  ?>
                  <div class="item <?php echo ($i == 1) ? 'active' : ''; ?>"> 
                    <div class="row"> 
                        <div class="adjust1"> 
                            <div class="caption"> 
                              <p class="text-info lead adjust2"><?php echo $row['information_title'] ?></p>  
                              <blockquote class="adjust2"> <p><?php echo strip_tags(character_limiter($row['information_desc'], 250)) ?></p> 
                              </blockquote> 
                          </div> 
                        </div> 
                    </div> 
                  </div> 
                  <?php
                  $i++;
                endforeach;
                ?>
              </div> <!-- Controls --> 
              <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev"> 
                <span class="glyphicon glyphicon-chevron-left" style="font-size:20px"></span> </a> 
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next"> 
                  <span class="glyphicon glyphicon-chevron-right" style="font-size:20px"></span> 
                </a> 
              </div> 
            </div>

        </div>
        <!-- /.box -->
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-dollar"></i></span>

          <div class="info-box-content">
            <span class="info-box-text dash-text">Sisa Tagihan Bulanan</span>
            <span class="info-box-number"><?php echo 'Rp. ' . number_format($total_bulan, 0, ',', '.') ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

          <div class="info-box-content">
            <span class="info-box-text dash-text">Sisa Tagihan Lainnya</span>
            <span class="info-box-number"><?php echo 'Rp. ' . number_format($total_bebas-$total_bebas_pay, 0, ',', '.') ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      
    </div>
    <div style="margin-bottom: 50px;"></div>
   
  <!-- /.content -->
</div>

