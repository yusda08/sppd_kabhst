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
        <li class="active">Surat Tugas</li>
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
                            <th width="20%"> No Nota Dinas</th>
                            <th width="13%"> No Surat Tugas</th>
                            <th width="13%"> Tanggal Surat Tugas</th>
                            <th class="text-center" width='5%'><i class="fa fa-cogs"></i></th>
                            <th class="text-center" width='5%'><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_suratTugasSkpdWhereStatus as $row) {
                            ?> 
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-center"><?= $row->no; ?></td>
                                <td class="text-center"><?= $row->no_spt; ?></td>
                                <td class="text-center">
                                    <?php
                                    if ($row->tgl_spt != NULL) {
                                        echo Tgl_indo::indo($row->tgl_spt);
                                    }
                                    ?></td>

                                <?php if ($row->id_spt == 0) { ?>
                                    <td class="text-center">            
                                        <a href="<?= base_url('index.php/skpd/surat/Surat_tugas/tambah_surat_tugas/' . $id_skpd . '/' . $row->id); ?>" class="btn btn-primary btn-block btn-flat btn-xs">
                                            <i class='fa fa-search'></i>&nbsp;Buat Surat Tugas</a>
                                    </td>
                                    <td class="text-center">
                                        <button disabled class="btn btn-warning btn-flat btn-block btn-xs"><i class="fa fa-print"></i></button>
                                    </td>
                                <?php } else { ?>
                                    <td class="text-center">
                                        <a href="<?= base_url('index.php/skpd/surat/Surat_tugas/edit_surat_tugas/' . $id_skpd . '/' . $row->id); ?>" class="btn btn-primary btn-block btn-flat btn-xs">
                                            <i class='fa fa-search'></i>&nbsp;Edit</a>
                                    </td>
                                    <td class="text-center">
                                        <a target="_blank" href="<?= base_url(); ?>index.php/laporan/Laporan_html/formulir_surat_tugas/<?= $id_skpd;?>?id_nd=<?=$row->id;?>" class="btn btn-primary btn-block btn-flat btn-xs"><i class="fa fa-print"></i></a>
                                    </td>
                                <?php } ?>
                                </td>
                            </tr>

                            <?php $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


