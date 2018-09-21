<?php
$a = $this->session->userdata('is_login');
$nama = $a['nama'];
$foto = $a['foto'];
$level = $a['level_user'];
$ol = $a['ol'];
$jml_nd_masuk = $this->Data_asisten->count_nota_dinasMasukWhereAsisten($a['kode']);
$jml_nd_keluar = $this->Data_asisten->count_nota_dinasKeluarWhereAsisten($a['kode']);

foreach ($get_asistenWhereId as $row) {
    $jabatan = $row->jabatan;
}
?>    
<section class="content-header">
    <h4 class="alert bg-info">
        <center>
            <img src="<?php echo base_url(); ?>assets/img/logoold.png" width="10%" class="img-responsive">

            <br>
            SPD Online <br>
            Kabupaten Hulu Sungai Tengah
            <br>
            <small><?= strtoupper('WELCOME ' . $jabatan); ?> </small>    
        </center>
    </h4>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua-gradient">
                <div class="inner">
                    <h3 class="text-center"><?= $jml_nd_masuk; ?></h3>
                    <p class="text-center">Data Surat Masuk</p>
                </div>
                <div class="icon">
                    <i class="ion ion-skip-backward"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/Surat/Surat_masuk_keluar/asisten.html?surat=masuk" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow-gradient">
                <div class="inner">
                    <h3 class="text-center"><?= $jml_nd_keluar; ?></h3>
                    <p class="text-center">Data Surat Keluar</p>
                </div>
                <div class="icon">
                    <i class="ion ion-fireball"></i>
                </div>
                <a href="<?php echo base_url(); ?>index.php/Surat/Surat_masuk_keluar/asisten.html?surat=keluar" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

</section>
<?php echo $javasc; ?>