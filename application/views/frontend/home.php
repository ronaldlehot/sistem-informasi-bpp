<section class="content">
  <div class="row"> 
    <div class="col-md-12">
      <div class="box box-info box-solid" style="border: 1px solid #2ABB9B !important;">
        <div class="box-header backg with-border">
          <h3 class="box-title">Cek Data Pembayaran Siswa</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php echo form_open(current_url(), array('class' => 'form-horizontal', 'method' => 'get')) ?>
          <div class="form-group">            
            <label for="" class="col-sm-2 control-label">Tahun Pelajaran</label>
            <div class="col-sm-2">
              <select class="form-control" name="n">
                <!-- <option value="">-- Tahun Ajaran --</option> -->
                <?php foreach ($period as $row): ?>
                  <option <?php echo (isset($f['n']) AND $f['n'] == $row['period_id']) ? 'selected' : '' ?> value="<?php echo $row['period_id'] ?>"><?php echo $row['period_start'].'/'.$row['period_end'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <label for="" class="col-sm-2 control-label">Cari Data Siswa</label>
            <div class="col-sm-2">
              <input type="text" autofocus name="r" <?php echo (isset($f['r'])) ? 'placeholder="'.$f['r'].'"' : 'placeholder="Masukan NIS Siswa"' ?> class="form-control" required>
            </div>

            <div class="col-sm-4">
              <button type="submit" class="btn btn-success"><i class="fa fa-search"> </i> Cari </button>
              <a href="<?php echo site_url('home') ?>" class="btn btn-danger"><i class="fa fa-refresh"> </i> Reset</a>
              <a href="<?php echo site_url('welcome') ?>" class="btn btn-warning"><i  </i> Keluar</a>
            </div>
          </div>
        </form>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
    <?php if ($f) { ?>

    <div class="row">
      <div class="col-md-6">
        <div class="box box-info box-solid" style="border: 1px solid #2ABB9B !important;">
          <div class="box-header backg with-border">
            <h3 class="box-title">Informasi Siswa</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td width="200">Tahun Pelajaran</td><td width="4">:</td>
                  <?php foreach ($period as $row): ?>
                    <?php echo (isset($f['n']) AND $f['n'] == $row['period_id']) ? 
                    '<td><strong>'.$row['period_start'].'/'.$row['period_end'] .'<strong></td>' : '' ?> 
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
                  <?php if (majors()=='senior') { ?>
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
          </div>
        </div>
        <div class="col-md-6">
          <!-- List Tagihan Bulanan --> 
          <div class="box box-info box-solid" style="border: 1px solid #2ABB9B !important;">
            <div class="box-header backg with-border">
              <h3 class="box-title">Tagihan Bulanan</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-striped table-hover" style="cursor: pointer;">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Jenis Pembayaran</th>
                    <th>Total Tagihan</th>
                    <th>Sudah Dibayar</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i =1;
                  foreach ($student as $row):
                    $namePay = $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'];
                    if (isset($f['n']) AND $f['r'] == $row['student_nis']) {
                      ?>
                      <tr data-toggle="collapse" data-target="#demo" style="color:<?php echo ($total == $pay) ? '#00E640' : 'red' ?>">
                        <td><?php echo $i ?></td>
                        <td><?php echo $namePay ?></td>
                        <td><?php echo 'Rp. ' . number_format($total - $pay, 0, ',', '.') ?></td>
                        <td><?php echo 'Rp. ' . number_format($pay, 0, ',', '.') ?></td>
                        <td><label class="label <?php echo ($total == $pay) ? 'label-success' : 'label-warning' ?>"><?php echo ($total == $pay) ? 'Lengkap' : 'Belum Lengkap' ?></label></td>
                      </tr>
                      <?php 
                    }
                    $i++;
                  endforeach; 
                  ?> 
                  </tbody>
                  <tbody id="demo" class="collapse">
                  <tr>
                    <th>No.</th> 
                    <th>Bulan</th>
                    <th>Tahun Pelajaran</th>
                    <th>Tagihan</th>
                    <th style="text-align: center;">Status</th>
                  </tr>  
                  <?php 
                  $i =1;
                  foreach ($bulan as $row): 
                    $mont = ($row['month_month_id']<=6) ? $row['period_start'] : $row['period_end'];
                    ?>
                  <tr style="color:<?php echo ($row['bulan_status'] == 1) ? '#00E640' : 'red' ?>">              
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['month_name'] ?></td>
                    <td><?php echo $mont ?></td>
                    <td><?php echo 'Rp. ' . number_format($row['bulan_bill'], 0, ',', '.') ?></td>
                    <td colspan="2" style="text-align: center;"><?php echo ($row['bulan_status'] == 1) ? 'Lunas' : 'Belum Lunas' ?></td>
                  </tr>
                  <?php
                  $i++;
                endforeach;
                ?>      
              </tbody>
            </table>
          </div>
        </div>
        <div class="box box-info box-solid" style="border: 1px solid #2ABB9B !important;">
          <div class="box-header backg with-border">
            <h3 class="box-title">Tagihan Lainnya</h3>
          </div><!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Jenis Pembayaran</th>
                  <th>Total Tagihan</th>
                  <th>Dibayar</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i =1;
                foreach ($bebas as $row):
                  if (isset($f['n']) AND $f['r'] == $row['student_nis']) {
                    $sisa = $row['bebas_bill']-$row['bebas_total_pay'];
                    $namePay = $row['pos_name'].' - T.A '.$row['period_start'].'/'.$row['period_end'];
                    ?>
                    <tr style="color:<?php echo ($row['bebas_bill'] == $row['bebas_total_pay']) ? '#00E640' : 'red' ?>">
                      <td><?php echo $i ?></td>
                      <td><?php echo $namePay ?></td>
                      <td><?php echo 'Rp. ' . number_format($sisa, 0, ',', '.') ?></td>
                      <td><?php echo 'Rp. ' . number_format($row['bebas_total_pay'], 0, ',', '.') ?></td>
                      <td><label class="label <?php echo ($row['bebas_bill']==$row['bebas_total_pay']) ? 'label-success' : 'label-warning' ?>"><?php echo ($row['bebas_bill']==$row['bebas_total_pay']) ? 'Lunas' : 'Belum Lunas' ?></label></td>
                    </tr>
                    <?php 
                  }
                  $i++;
                endforeach; 
                ?>        
              </tbody>
            </table> 
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </section><br><br>