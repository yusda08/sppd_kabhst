<?php
$a = $this->session->userdata('is_login');
$nama = $a['nama'];
$foto = $a['foto'];
$level = $a['level_user'];
$ol = $a['ol'];
if ($level == 2) {
    $kode_skpd = $a['kode'];
} elseif ($level == 5) {
    $kode_skpd = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
}
$ndmasuk = 0;
$ndkeluar = 0;
$totnd = 0;
$totalskpd = $this->Data_notadinas->get_totalnotadinasbystatus($kode_skpd);
foreach ($totalskpd as $value) {
    $ndmasuk = $value->ndmasuk;
    $ndkeluar = $value->ndkeluar;
    $totnd = $value->totnd;
}
?>
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <?php if (empty($foto)) { ?>
                <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            <?php } else { ?>
                <img src="<?php echo base_url(); ?>assets/img/user/<?= $foto; ?>" class="img-circle" alt="<?= $nama; ?>">
            <?php } ?>
        </div> 
        <div class="pull-left info">
            <p><?php echo $a['nama']; ?> </p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>

    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree" id="nav">
        <li class="header">MAIN NAVIGATION</li>
        <li class=""><a href="<?php echo base_url(); ?>index.php/admin_skpd.html"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
        <li class="header">DATA SURAT</li>
        <!--        <li class="treeview">
                    <a href="#">
                        <i class="fa fa-file"></i>
                        <span>Surat</span>
                        <span class="pull-right-container">
                      <small class="label pull-right bg-green"><?= $ndkeluar ?></small>
                        <small class="label pull-right bg-yellow"><?= $ndmasuk ?></small>
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">-->
        <?php if ($level == 2) { //ADmin SKPD ?> 
            <li class=""><a href="<?php echo base_url(); ?>index.php/skpd/surat/Nota_dinas/nota_dinas/<?= $kode_skpd ?>"> <i class="fa fa-file-text-o"></i><span>Nota Dinas</span></a></li>                    
            <!--<li class=""><a href="<?php echo base_url(); ?>index.php/skpd/surat/surat_tugas/surat_tugas/<?= $kode_skpd ?>"> <i class="fa fa-file-text-o"></i><span>Surat Dinas</span></a></li>-->  
            <li class=""><a href="<?php echo base_url(); ?>index.php/skpd/surat/Realisasi_anggaran/inputRealisasiAnggaran/<?= $kode_skpd ?>"> <i class="fa fa-file-text-o"></i>
                    <span>Realisasi Anggaran</span>
                </a>
            </li>
        <?php } else { ?>
            <li class=""><a href="<?php echo base_url(); ?>index.php/skpd/surat/Nota_dinas/masuk"> <i class="fa fa-file-text-o"></i><span>Nota Dinas Masuk
                            <small class="label bg-yellow pull-right"><?php if ($ndmasuk > 0) {echo $ndmasuk . ' New';} ?></small>
                    </span></a></li>                    

            <li class=""><a href="<?php echo base_url(); ?>index.php/skpd/surat/Nota_dinas/keluar"> <i class="fa fa-file-text-o"></i><span>Nota Dinas Keluar</span><span class="pull-right-container">
                        <small class="label pull-right bg-green"><?php if ($ndkeluar > 0) {
            echo $ndkeluar;
        } ?></small>
                    </span></a></li>                    
<?php } ?>
        <!--            </ul>
        
                </li>-->

        <li class="treeview">
            <a href="#">
                <i class="fa fa-file"></i>
                <span>Laporan</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
<?php if ($level == 2) { ?>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/skpd/surat/Nota_dinas/indexnd"> <i class="fa fa-file-text-o"></i><span>Nota Dinas</span></a></li>                    
           <!--<li class=""><a href="<?php echo base_url(); ?>index.php/laporan/Laporan_html/formulir_nota_dinas/<?= $kode_skpd ?>"> <i class="fa fa-file-text-o"></i><span>NOTA DINAS</span></a></li>-->                    
                    <li class=""><a href="<?php echo base_url(); ?>index.php/laporan/Laporan_html/formulir_surat_tugas/<?= $kode_skpd ?>"> <i class="fa fa-file-text-o"></i><span>SPT</span></a></li>                
                    <li class=""><a target="_blank" href="<?php echo base_url(); ?>index.php/skpd/surat/Nota_dinas/lap_sppd/<?= $kode_skpd ?>"> <i class="fa fa-file-text-o"></i><span>SPPD</span></a></li>                    
<?php } else { ?>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/skpd/surat/Nota_dinas/lapnota"> <i class="fa fa-file-text-o"></i><span>Nota Dinas</span></a></li>                    
                    <li class=""><a href="<?php echo base_url(); ?>index.php/skpd/surat/Nota_dinas/rekap"> <i class="fa fa-file-text-o"></i><span>Rekap</span></a></li>                    
<?php } ?>
            </ul>

        </li>
        <li class="header">DATA MASTER</li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-maxcdn"></i>
                <span>Data Master</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <?php if ($level == 2) { ?> 
                    <li class=""><a href="<?php echo base_url(); ?>index.php/skpd/master/Pegawai_Skpd/PegawaiPerSkpd.html"> <i class="fa fa-user"></i><span> Data Pegawai</span></a></li>

                                <?php
                            } else {
                                ?>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/skpd/master/Pegawai_Skpd/master_pegawai.html"> <i class="fa fa-user"></i><span> Data Pegawai</span></a></li>
<?php } ?>

            </ul>
        </li>
    </ul>

</section>



<script>
    $(function () {
        $('#nav a[href~="' + location.href + '"]').parents('li').addClass('active');
    });
</script>