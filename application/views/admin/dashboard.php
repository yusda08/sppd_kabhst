<?php
$a = $this->session->userdata('is_login');
$nama = $a['nama'];
$foto = $a['foto'];
$level = $a['level_user'];
$ol = $a['ol'];

?>    
<section class="content-header">
      <h4 class="alert bg-info">
          <center>
          <img src="<?php echo base_url(); ?>assets/img/logoold.png" width="10%" class="img-responsive">
          
          <br>
          SPD Online <br>
            Kabupaten Hulu Sungai Tengah
            <br>
            <small><?=strtoupper('WELCOME administrator');?> </small>    
            </center>
      </h4>
          </section>
<section class="content">
   <div class="row">
            
       <div class="col-lg-4">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h2 class="text-center">Rp. <?= number_format($sum->jml_dalam,2,',','.');?></h2>
                        <p class="text-center">Total Pagu Dalam Daerah</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-card"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/admin/surat/Realisasi_anggaran.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
       <div class="col-lg-4">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                         <h2 class="text-center">Rp. <?= number_format($jml_dalam,2,',','.');?></h2>
                        <p class="text-center">Realisasi Dalam Daerah</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/admin/surat/Realisasi_anggaran.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
       <div class="col-lg-4">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                         <h2 class="text-center">
                    <?php 
                             $sis_dalam = $sum->jml_dalam-$jml_dalam;
                             echo number_format($sis_dalam,2,',','.');
                         ?>
                         </h2>
                        <p class="text-center">Sisa Anggaran Dalam Daerah</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-calculator"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/admin/surat/Realisasi_anggaran.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
       
       <div class="col-lg-4">
                <!-- small box -->
                <div class="small-box bg-aqua-gradient">
                    <div class="inner">
                         <h2 class="text-center">Rp. <?= number_format($sum->jml_luar,2,',','.');?></h2>
                        <p class="text-center">Total Pagu Luar Daerah</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-card"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/admin/surat/Realisasi_anggaran.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
       <div class="col-lg-4">
                <!-- small box -->
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                         <h2 class="text-center">Rp. <?= number_format($jml_luar,2,',','.');?></h2>
                        <p class="text-center">Realisasi Luar Daerah</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-cash"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/admin/surat/Realisasi_anggaran.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
       <div class="col-lg-4">
                <!-- small box -->
                <div class="small-box bg-red-gradient">
                    <div class="inner">
                         <h2 class="text-center">
                             <?php 
                             $sis_luar = $sum->jml_luar-$jml_luar;
                             echo number_format($sis_luar,2,',','.');
                         ?></h2>
                        <p class="text-center">Sisa Anggaran Luar Daerah</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-calculator"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/admin/surat/Realisasi_anggaran.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
       
       <div class="col-lg-4">
                <!-- small box -->
                <div class="small-box bg-blue-active">
                    <div class="inner">
                         <h2 class="text-center"><?=$jml_nd;?> Doc</h2>
                        <p class="text-center">Nota Dinas Yang Disetujui</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-document"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/admin/surat/Nota_dinas.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
       <div class="col-lg-4">
                <!-- small box -->
                <div class="small-box bg-red-gradient">
                    <div class="inner">
                         <h2 class="text-center"><?=$row->jml_nota_dinas;?> Doc</h2>
                        <p class="text-center">Total Nota Dinas Jadi SPT</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-document"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/admin/surat/Nota_dinas.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
       <div class="col-lg-4">
                <!-- small box -->
                <div class="small-box bg-gray-active">
                    <div class="inner">
                         <h2 class="text-center"><?=$row->jml_detail_nd;?> Orang</h2>
                        <p class="text-center">Total Pegawai Nota Dinas Jadi SPT</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-android-apps"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/admin/surat/Nota_dinas.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
       <div class="col-lg-4">
                <!-- small box -->
                <div class="small-box bg-green-gradient">
                    <div class="inner">
                        <h2 class="text-center"><?=$jml_pegawai;?> Orang</h2>
                        <p class="text-center">Pegawai Negeri Sipil</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-podium"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/admin/master/Pegawai_Skpd/master_pegawai.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
       <div class="col-lg-4">
                <!-- small box -->
                <div class="small-box bg-maroon-gradient">
                    <div class="inner">
                        <h2 class="text-center"><?=$jml_nonpegawai;?> Orang</h2>
                        <p class="text-center">Non Pegawai Negeri Sipil</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-podium"></i>
                    </div>
                    <a href="<?php echo base_url(); ?>index.php/admin/master/Pegawai_Skpd/master_pegawai.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
       
            </div>
            
 </section>
<?php echo $javasc; ?>