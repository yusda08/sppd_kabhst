<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
$id_skpd = $a['kode'];
?>
<section class="content-header alert bg-gray" style=" border-bottom-width: 19px; margin-bottom: 16px;margin-top: 0px;">
    <h1><?php echo strtoupper($page_name); ?></h1>
    <ol class="breadcrumb ">
        <li><a href="#">Nota Dinas</a></li>
        <li class="active">Data SKPD</li>
    </ol>
</section>
<section class="content">
    <div class="box box-success">
        <div class="box-body">
            <div class="table-responsive">
                <table class="tabel_3 table table-hover table-bordered table-striped" width="100%">
                    <thead >
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th width="18%">No Nota</th>
                            <th width="13%">Tgl Nota</th>
                            <th>Tujuan</th>
                            <!--<th>Perihal</th>-->
                            <th width="13%">Status Permintaan</th>
                            <th width='5%'>View</th>
                            <th width='8%'>Download</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($getnotadinas as $value) {
                           
                                ?>
                                <tr class="bg-info">
                                    <td style="text-align: center;"><?= $no; ?></td>
                                    <td><?= $value->no; ?></td>
                                    <td style=""><?= Tgl_indo::indo($value->tgl_nota_dinas); ?></td>
                                    <td ><?= $value->tujuan; ?></td>
                                    <!--<td ><?= $value->maksud; ?></td>-->
                                    <td style="text-align: center;"><?php
                                        switch ($value->ttd_kepala) {
                                            case 1:
                                                $label = "Setuju";
                                                $style = "label-success";
                                                break;
                                            case 2:
                                                $label = "DiTolak";
                                                $style = "label-danger";
                                                break;
                                            default:
                                                $label = "Belum Ada TTD Kepala SKPD";
                                                $style = "label-warning";
                                                break;
                                        }
                                        ?>
                                        <span class="label <?= $style ?>"><?= $label ?></span>
                                    </td>
                                    <td style="">
                                        <?php
                                        if ($value->ttd_kepala == 1) {
                                        $disabled = '';
                                        $klik = 'true';
                                        if ($value->posting == 0 or $value->ttd_kepala != 0) {
                                            $disabled = 'disabled';
                                            $klik = 'false';
                                        }
                                        ?>
                                        <a href="<?= base_url('index.php/skpd/surat/Nota_dinas/viewnd/' . $value->id); ?>" class="btn btn-primary btn-block btn-flat btn-xs" target="_blank">
                                            <i class='fa fa-search'></i>&nbsp;Lihat</a>
                                            <?php }else{ ?>
                                        <span class="label label-warning">Belum Ada TTD Kepala SKPD</span>
                                         <?php } ?>
                                    </td>
                                    <td style="">
                                        <?php
                                         if ($value->ttd_kepala == 1) {
                                        $disabled = '';
                                        $klik = 'true';
                                        if ($value->posting == 0 or $value->ttd_kepala != 0) {
                                            $disabled = 'disabled';
                                            $klik = 'false';
                                        }
                                        ?>
                                        <a href='<?= base_url(); ?>index.php/laporan/Laporan_pdf/formulir_nota_dinas?id_skpd=<?= $id_skpd; ?>&id=<?= $value->id; ?>' target='_blank' 
                                           type='button' class='btn btn-danger btn-flat  btn-xs btn-block'>
                                            <i class='fa fa-file-pdf-o'></i>&nbsp; Download</a>
                                         <?php }else{ ?>
                                        <span class="label label-warning">Belum Ada TTD Kepala SKPD</span>
                                         <?php } ?>

                                </tr>

                                <?php
                                $no++;
                            }

                        ?>
                    </tbody>
                </table>
            </div>


        </div><!-- /.box-body -->
    </div><!-- /.box -->          
</section>
