<?php
$a = $this->session->userdata('is_login');
$nama = $a['nama'];
$foto = $a['foto'];
$level = $a['level_user'];
$ol = $a['ol'];
$kode = $a['kode'];
$ndmasuk = 0;
$ndkeluar = 0;
$totnd = 0;
foreach ($totalskpd as $value) {
    $ndmasuk = $value->ndmasuk;
    $ndkeluar = $value->ndkeluar;
    $totnd = $value->totnd;
}
?>
<section class="content-header">
    <h1 class="alert bg-info text-center">
        <img src="<?php echo base_url(); ?>assets/img/logoold.png" width="5%" >
        <br>
        SPD Online <br>
        Kabupaten Hulu Sungai Tengah
        <br>
        <a target='_blank' href='<?= base_url() ?>assets/file/MatriksPD.xlsx'  class = 'btn btn-danger btn-xs'>
                <i class = 'fa fa-download'></i>  Download Matriks Perjalanan Dinas</a><br>
        <?php
        if ($level == 2) {
            foreach ($get_skpd as $skpd) {
                if ($skpd->kunker == $kode) {
                    $nm_skpd = $skpd->nunker;
                }
            }
            ?>
            <small>Welcome <?= $nm_skpd; ?></small>      
        <?php } elseif ($level == 5) {
            $jabatan='';
     foreach ($get_setSkpdWhereLevel as $gkpl){
         $jabatan = $gkpl->jabatan;
     } ?>
            <small>Welcome <?= $jabatan;?></small>
            
        <?php } ?>
    </h1>
</section>
<section class="content">
    <?php if($level==2){ ?>
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
                    <a href="<?php echo base_url(); ?>index.php/skpd/surat/Realisasi_anggaran/inputRealisasiAnggaran/<?= $kode_skpd ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="<?php echo base_url(); ?>index.php/skpd/surat/Realisasi_anggaran/inputRealisasiAnggaran/<?= $kode_skpd ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="<?php echo base_url(); ?>index.php/skpd/surat/Realisasi_anggaran/inputRealisasiAnggaran/<?= $kode_skpd ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="<?php echo base_url(); ?>index.php/skpd/surat/Realisasi_anggaran/inputRealisasiAnggaran/<?= $kode_skpd ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="<?php echo base_url(); ?>index.php/skpd/surat/Realisasi_anggaran/inputRealisasiAnggaran/<?= $kode_skpd ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                    <a href="<?php echo base_url(); ?>index.php/skpd/surat/Realisasi_anggaran/inputRealisasiAnggaran/<?= $kode_skpd ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($level == 5) { ?>
    <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?= $ndmasuk ?></h3>

                    <p>Nota Dinas Masuk</p>
                </div>
                <div class="icon">
                    <i class="fa fa-inbox"></i>
                </div>
                <a href="<?= base_url() . 'index.php/skpd/surat/Nota_dinas/masuk' ?>" class="small-box-footer">Detail<i class="fa fa-arrow-circle-right"></i></a>
            </div>

        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?= $ndkeluar ?></h3>

                    <p>Nota Dinas Keluar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-send"></i>
                </div>
                <a href="<?= base_url() . 'index.php/skpd/surat/Nota_dinas/keluar' ?>" class="small-box-footer">Detail<i class="fa fa-arrow-circle-right"></i></a>
            </div>

        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?= $totnd ?></h3>

                    <p>Semua Nota Dinas</p>
                </div>
                <div class="icon">
                    <i class="fa fa-send"></i>
                </div>
                <a href="#" onclick="alert('under construction bro !!')"class="small-box-footer">Detail<i class="fa fa-arrow-circle-right"></i></a>
            </div>


        </div>
    </div>
    <?php } ?>
</section>
<?php echo $javasc; ?>
