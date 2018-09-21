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
    <h1><?php echo strtoupper($page_name); ?></h1>
    <ol class="breadcrumb ">

        <li><a href="#">Surat</a></li>
        <li class="">Surat Tugas</li>
        <li class="active">Surat Perjalanan Dinas</li>
    </ol>
</section>
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">

        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table  class="tabel_1 table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="5%"> No</th>
                            <th > Nomor SPT</th>
                            <th width="20%"> Nama / NIP</th>
                            <th width="13%"> Pangkat / Gol</th>
                            <th> Jabatan</th>
                            <th class="text-center" width='5%'><i class="fa fa-cogs"></i></th>
                            <th class="text-center" width='5%'><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_suratPerjalananDinasWhereSt as $row) {
                            ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-center"><?= $row->no_spt; ?></td>
                                <td class=""><?= $row->nama . "<br>" . $row->status_pegawai = 'pns' ? 'NIP. ' . $row->nip_nik : 'NIK. ' . $row->nip_nik; ?></td>
                                <td class="text-center"><?= $row->pangkat_gol; ?></td>
                                <td class=""><?= $row->jabatan; ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('index.php/laporan/Laporan_html/formulir_surat_perjalanan_dinas/' . $id_skpd . '?id_spd=' . $row->id_spd); ?>" class="btn btn-warning btn-block btn-flat btn-xs">
                                        <i class='fa fa-print'></i>&nbsp;View SPD</a>
                                </td>
                                <td class="text-center">
                                    <a href="<?= base_url('index.php/laporan/Laporan_pdf/formulir_surat_perjalanan_dinas_pdf/' . $id_skpd . '?id_spd=' . $row->id_spd); ?>" class="btn btn-danger btn-block btn-flat btn-xs">
                                        <i class='fa fa-file-pdf-o'></i>&nbsp;Download</a>
                                </td>
                            </tr>
                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>