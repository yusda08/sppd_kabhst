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
        <div class="box-body">
            <div id="notivs"></div>
            <div class="table-responsive">
                <table class="tabel_1 table table-hover table-bordered table-striped" width="100%">
                    <thead >
                        <tr>

                            <th style="font-size: 8pt;">Nama SKPD</th>
                            <th width="12%" style="font-size: 8pt;">Kouta Dalam</th>
                            <th width="12%" style="font-size: 8pt;">Realisasi Dalam</th>
                            <th width="12%" style="font-size: 8pt;">Sisa Dalam</th>
                            <th width="12%" style="font-size: 8pt;">Kouta Luar</th>
                            <th width="12%" style="font-size: 8pt;">Realisasi Luar</th>
                            <th width="12%" style="font-size: 8pt;">Sisa Luar</th>
                            <th width="5%" style="font-size: 8pt;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($skpd as $skp) {
                            foreach ($get_realisasiAnggaran as $row) {
                                if ($row->kode_skpd == $skp->kunker) {
                                    ?>
                        <tr class="bg-info" >
                                        <td style="font-size: 8pt;"><?= $skp->nunker; ?></td>
                                        <td style="font-size: 8pt;" class="text-right">
                                            <span class="pull-left">Rp.</span>
                                            <?= number_format($row->kouta_anggaran_dalam, 2, ',', '.'); ?>
                                        </td>
                                        <td style="font-size: 8pt;" class="text-right ">
                                            <span class="pull-left">Rp.</span>
                                            <?= number_format($row->jml_realisasi_dalam, 2, ',', '.'); ?>
                                        </td>
                                        <td style="font-size: 8pt;" class="text-right ">
                                            <span class="pull-left">Rp.</span>
                                            <?php
                                            $sisa_kouta_dalam = $row->kouta_anggaran_dalam-$row->jml_realisasi_dalam;
                                                    echo number_format($sisa_kouta_dalam, 2, ',', '.'); ?>
                                        </td>
                                        <td style="font-size: 8pt;" class="text-right ">
                                            <span class="pull-left">Rp.</span>
                                            <?= number_format($row->kouta_anggaran_luar, 2, ',', '.'); ?>
                                        </td>
                                        <td style="font-size: 8pt;" class="text-right ">
                                            <span class="pull-left">Rp.</span>
                                            <?= number_format($row->jml_realisasi_luar, 2, ',', '.'); ?>
                                        </td>
                                        <td style="font-size: 8pt;" class="text-right ">
                                            <span class="pull-left">Rp.</span>
                                            <?php
                                            $sisa_kouta_luar = $row->kouta_anggaran_luar-$row->jml_realisasi_luar;
                                                    echo number_format($sisa_kouta_luar, 2, ',', '.'); ?>
                                        </td>
                                        <td style="font-size: 8pt;">
                                            <a href="<?= base_url();?>index.php/admin/surat/Realisasi_anggaran/inputRealisasiAnggaran/<?=$row->kode_skpd;?>" class="btn btn-success btn-flat btn-block btn-xs"><i class="fa fa-plus"></i> Realisasi</a>
                                        </td>
                                    </tr>

                                    <?php
                                    $no++;
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>


        </div><!-- /.box-body -->
    </div><!-- /.box -->          
</section>

