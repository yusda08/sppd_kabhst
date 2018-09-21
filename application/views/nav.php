<?php
$a = $this->session->userdata('is_login');
$nama = $a['nama'];
$foto = $a['foto'];
$level = $a['level_user'];
$ol = $a['ol'];
?>
<section class="sidebar">
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
        <li class=""><a href="<?php echo base_url(); ?>index.php/administrator.html"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
        <li class="header">DATA SURAT</li>        
        <?php
        if ($level == 7) {
            $jml_nd_masuk = $this->Data_asisten->count_nota_dinasMasukWhereAsisten($a['kode']);
            $jml_nd_keluar = $this->Data_asisten->count_nota_dinasKeluarWhereAsisten($a['kode']);
            ?>
            <li class="">
                <a href="<?php echo base_url(); ?>index.php/Surat/Surat_masuk_keluar/asisten.html?surat=masuk"> <i class="fa fa-file-text-o"></i><span>Surat Masuk</span>
                    <?php
                    if ($jml_nd_masuk > 0) {
                        echo'<span class="pull-right-container">
              <small class="label pull-right bg-aqua">' . $jml_nd_masuk . ' New </small>
            </span>';
                    }
                    ?>
                </a>

            </li>    
            <li class="">
                <a href="<?php echo base_url(); ?>index.php/Surat/Surat_masuk_keluar/asisten.html?surat=keluar"> <i class="fa fa-file-text-o"></i><span>Surat Keluar</span>
                    <?php
                    if ($jml_nd_keluar > 0) {
                        echo'<span class="pull-right-container">
              <small class="label pull-right bg-yellow"> ' . $jml_nd_keluar . ' New </small>
            </span>';
                    }
                    ?>
                </a>
            </li>    
            <?php
        } elseif ($level == 6) {
            $jml = $this->Data_notadinas->count_suratMasukKeluarSekda();
            ?>
            <li class="">
                <a href="<?php echo base_url(); ?>index.php/Surat/Surat_masuk_keluar/sekda.html?surat=masuk"> 
                    <i class="fa fa-file-text-o"></i><span>Surat Masuk</span>
                    <?php
                    if ($jml->jml_masuk > 0) {
                        echo'<span class="pull-right-container">
              <small class="label pull-right bg-aqua">' . $jml->jml_masuk . '  New  </small>
                    </span>';
                    }
                    ?>
                </a>
            </li>    
            <li class="">
                <a href="<?php echo base_url(); ?>index.php/Surat/Surat_masuk_keluar/sekda.html?surat=keluar"> 
                    <i class="fa fa-file-text-o"></i><span>Surat Keluar</span>
                    <?php
                    if ($jml->jml_keluar > 0) {
                        echo'<span class="pull-right-container">
              <small class="label pull-right bg-yellow">' . $jml->jml_keluar . '  New </small>
                    </span>';
                    }
                    ?>
                </a>
            </li>    
            <?php
        } elseif ($level == 4) {
            $jml = $this->Data_notadinas->count_suratMasukStafAhli();
            ?>
            <li class="">
                <a href="<?php echo base_url(); ?>index.php/Surat/Surat_masuk_keluar/staf_ahli.html?surat=masuk"> 
                    <i class="fa fa-file-text-o"></i><span>Surat Masuk</span>
                    <?php
                    if ($jml->jml_masuk > 0) {
                        echo'<span class="pull-right-container">
              <small class="label pull-right bg-aqua">' . $jml->jml_masuk . ' New</small>
            </span>';
                    }
                    ?>
                </a>
            </li>    
            <li class="">
                <a href="<?php echo base_url(); ?>index.php/Surat/Surat_masuk_keluar/staf_ahli.html?surat=keluar"> 
                    <i class="fa fa-file-text-o"></i><span>Surat Keluar</span>
                    <?php
                    if ($jml->jml_keluar > 0) {
                        echo'<span class="pull-right-container">
              <small class="label pull-right bg-yellow">' . $jml->jml_keluar . ' New</small>
            </span>';
                    }
                    ?>
                </a>
            </li>    
            <?php
        } elseif ($level == 3) {
            $jml_masuk = $this->Data_notadinas->count_suratMasukExe();
            $jml_keluar = $this->Data_notadinas->count_suratKeluarExe();
            ?>
            <li class="">
                <a href="<?php echo base_url(); ?>index.php/Surat/Surat_masuk_keluar/executive.html?surat=masuk"> 
                    <i class="fa fa-file-text-o"></i><span>Surat Masuk</span>
                    <?php
                    if ($jml_masuk > 0) {
                        echo'<span class="pull-right-container">
              <small class="label pull-right bg-aqua">' . $jml_masuk . ' New </small>
            </span>';
                    }
                    ?>
                </a>
            </li>    
            <li class="">
                <a href="<?php echo base_url(); ?>index.php/Surat/Surat_masuk_keluar/executive.html?surat=keluar"> 
                    <i class="fa fa-file-text-o"></i><span>Surat Keluar</span>
                    <?php
                    if ($jml_keluar > 0) {
                        echo'<span class="pull-right-container">
              <small class="label pull-right bg-yellow">' . $jml_keluar . ' New </small>
            </span>';
                    }
                    ?>
                </a></li>    
        <?php
        } elseif ($level == 1) {
            $jml_all = $this->Data_surat_tugas->countSptAndNdWhereSkpdAll();
            ?>
            
            <li class=""><a href="<?php echo base_url(); ?>index.php/admin/surat/Nota_dinas.html"> <i class="fa fa-file-text-o"></i><span>Nota Dinas</span>
                    <?php
                    if ($jml_all->jml_nd > 0) {
                        echo'<span class="pull-right-container">
              <small class="label pull-right bg-yellow">' . $jml_all->jml_nd . ' New </small>
            </span>';
                    }
                    ?>
                </a>

            </li>
            <li class=""><a href="<?php echo base_url(); ?>index.php/admin/surat/Surat_tugas.html"> 
                    <i class="fa fa-file-text-o"></i><span>Surat Tugas</span>
                 <?php
                    if ($jml_all->jml_spt > 0) {
                        echo'<span class="pull-right-container">
              <small class="label pull-right bg-yellow">' . $jml_all->jml_spt . ' New </small>
            </span>';
                    }
                    ?>
                </a></li>
            <li class=""><a href="<?php echo base_url(); ?>index.php/admin/surat/Realisasi_anggaran.html"> 
                    <i class="fa fa-file-text-o"></i><span>Realisasi Angaran</span>
                </a></li>
            <!--                </ul>
            
                        </li>-->
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
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/master/Pegawai_Skpd/master_pegawai.html"> <i class="fa fa-user"></i><span> Master Pegawai</span></a></li>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/master/Pegawai_Skpd.html"> <i class="fa fa-user"></i><span> Data Pegawai PerSKPD</span></a></li>

                        <!--            <li class=""><a href="<?php echo base_url(); ?>index.php/rest_pegawai"> <i class="fa fa-user"></i><span> Pegawai</span></a></li>
                        <li class=""><a href="<?php echo base_url(); ?>index.php/rest_skpd"> <i class="fa fa-user"></i><span> SKPD</span></a></li>-->
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-reddit"></i>
                    <span>Data Referensi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/referensi/Ref_user"> <i class="fa fa-user"></i><span> Ref User</span></a></li>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/referensi/Ref_jabatan_tujuan"> <i class="fa fa-user"></i><span> Ref Jabatan & Tujuan</span></a></li>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/referensi/Ref_executive_asisten"> <i class="fa fa-user"></i><span> Ref Executive & Asisten</span></a></li>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/referensi/Ref_provinsi"> <i class="fa fa-user"></i><span> Ref Provinsi & Alat Angkut</span></a></li>

                                <!--<li class=""><a href="<?php echo base_url(); ?>index.php/admin/referensi/Ref_Asisten"> <i class="fa fa-user"></i><span> Ref Asisten</span></a></li>-->
                                <!--<li class=""><a href="<?php echo base_url(); ?>index.php/admin/referensi/Ref_tujuan"> <i class="fa fa-user"></i><span> Ref Tujuan</span></a></li>-->
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database"></i>
                    <span>Data Setting</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/setting/Set_executive"> <i class="fa fa-user"></i><span> Setting Executive</span></a></li>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/setting/Set_stafAhli"> <i class="fa fa-user"></i><span> Setting Staf Ahli</span></a></li>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/setting/Set_sekda"> <i class="fa fa-user"></i><span> Setting Sekda</span></a></li>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/setting/Set_asisten"> <i class="fa fa-user"></i><span> Setting Asisten</span></a></li>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/setting/Set_kepalaSkpd"> <i class="fa fa-user"></i><span> Setting SKPD</span></a></li>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/setting/Set_kewenangan"> <i class="fa fa-user"></i><span> Setting Kewenangan</span></a></li>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/setting/Set_uangHarian"> <i class="fa fa-user"></i><span> Setting Uang Harian</span></a></li>
                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/setting/Set_biayaInap"> <i class="fa fa-user"></i><span> Setting Biaya Penginapan</span></a></li>
                    <li class=""><a href="<?= base_url() ?>index.php/admin/setting/Set_plafon_pesawat"> <i class="fa fa-user"></i><span> Setting Plafon Tiket</span></a></li>

                    <li class=""><a href="<?php echo base_url(); ?>index.php/admin/setting/Set_representasi"> <i class="fa fa-user"></i><span> Setting Uang Representasi</span></a></li>
                </ul>
            </li>


<?php } ?>
    </ul>

</section>



<script>
    $(function () {
        $('#nav a[href~="' + location.href + '"]').parents('li').addClass('active');
    });
</script>