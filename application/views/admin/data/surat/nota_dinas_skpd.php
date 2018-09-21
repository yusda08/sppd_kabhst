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
                            <th  width="10%">Kode SKPD</th>
                            <th >Nama SKPD</th>
                            <th >Jumlah Nota Dinas</th>
                            <th >Pegawai Nota Dinas</th>
                            <th >Nota Dinas Disetujui</th>
                            <th width="7%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $ttl_all_nd = 0;
                        $ttl_all_pgw = 0;
                        foreach ($skpd as $skp) {
                            $countNotaDinasAndDetail = $this->Data_notadinas->countNotaDinasAndDetailWhereSkpd('1', $skp->kunker);
                            $jml_nd = $this->Data_notadinas->countNdWhereSkpd($skp->kunker);
                            if ($jml_nd == 0) {
                                $jml_nd_skpd = "<label class='label label-danger'>Data Kosong</label>";
                            } else {
                                $jml_nd_skpd = "<label class='label label-info'>$jml_nd Nota Dinas</label>";
                            }
                                $jml_nd = $countNotaDinasAndDetail->jml_nota_dinas;
                                $jml_nd_det = $countNotaDinasAndDetail->jml_detail_nd;
                                if ($jml_nd == 0) {
                                    $nota_dinas = "<label class='label label-warning'>Data Kosong</label>";
                                } else {
                                    $nota_dinas = "<label class='label label-info'>$jml_nd Nota Dinas</label>";
                                }
                                if ($jml_nd_det == 0) {
                                    $nota_dinas_detail = "<label class='label label-warning'>Data Kosong</label>";
                                } else {
                                    $nota_dinas_detail = "<label class='label label-info'>$jml_nd_det Pegawai Nota Dinas</label>";
                                }
                                ?>
                                <tr class="bg-info">
                                    <td style="text-align: center;"><?= $no; ?></td>
                                    <td style="text-align: center;"><?= $skp->kunker; ?></td>
                                    <td style=""><?= $skp->nunker; ?></td>
                                    <td class="text-center"><?= $nota_dinas; ?></td>
                                    <td class="text-center"><?= $nota_dinas_detail; ?></td>
                                    <td class="text-center"><?= $jml_nd_skpd; ?></td>
                                    <td style="">
                                        <a href="<?= base_url('index.php/admin/surat/Nota_dinas/nota_dinas/' . $skp->kunker); ?>" class="btn btn-primary btn-block btn-flat btn-xs">
                                            <i class='fa fa-search'></i>&nbsp;Lihat</a>
                                    </td>
                                </tr>

                                <?php
                                $no++;
                            $ttl_all_nd += $jml_nd;
                                $ttl_all_pgw += $jml_nd_det;
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr class="bg-info">
                            <td style="text-align: center;" colspan="3">Jumlah</td>

                            <td class="text-center"><?= $ttl_all_nd; ?> Nota Dinas</td>
                            <td class="text-center"><?= $ttl_all_pgw; ?> Pegawai Berangkat</td>
                            <td class="text-center"></td>
                            <td style=""></td>
                        </tr>
                    </tfoot>
                </table>
            </div>


        </div><!-- /.box-body -->
    </div><!-- /.box -->          
</section>
