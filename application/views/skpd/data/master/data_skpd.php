<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
?>
<section class="content-header alert bg-gray" style=" border-bottom-width: 19px; margin-bottom: 16px;margin-top: 0px;">
    <h1><?php echo strtoupper($page_name); ?></h1>
    <ol class="breadcrumb ">
        <li><a href="#">Data Pegawai PERSKPD</a></li>
        <li class="active">Data SKPD</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if ($tipe == 'alert-danger') {
                $lambang = 'fa-ban';
                $notify = 'Gagal!';
            }
            if ($msg) {
                ?>
                <div class="alert <?php echo $tipe; ?> alert-dismissable" id='notiv'>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa <?php echo $lambang; ?>"></i> <?php echo $notify; ?></h4>
                    <?php echo $msg; ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="box box-success">
        <div class="box-header with-border">
            Tabel Pegawai
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <!-- //table here -->
                <table class="tabel_3 table table-hover table-bordered" width="100%">
                    <thead >
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th  width="20%">Kode SKPD</th>
                            <th >Nama SKPD</th>
                            <th >Jumlah Pegawai</th>
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        foreach ($skpd as $skp){ 
                            $jml_pegawai_skpd = $this->Data_pegawai->count_dataPegawaiWhereSkpd($skp->kunker);
                            ?>
                        <tr>
                            <td style="text-align: center;"><?= $no;?></td>
                            <td style="text-align: center;"><?=  $skp->kunker;?></td>
                            <td style=""><?= $skp->nunker;?></td>
                            <td class="text-center"><label class="label label-info"><?= $jml_pegawai_skpd." Pegawai";?></label></td>
                            <td style="">
                                <a href="<?= base_url();?>index.php/admin/master/Pegawai_Skpd/pegawaiPerSkpd/<?= $skp->kunker;?>"
                                   class="btn btn-primary btn-xs btn-block btn-facebook"> <i class="fa fa-search"></i> Lihat</a>
                            </td>
                        </tr>
                            
                        <?php $no++; } ?>
                    </tbody>
                </table>
            </div>


        </div><!-- /.box-body -->
    </div><!-- /.box -->          
</section>


