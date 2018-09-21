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
                            <th class="text-center" width='5%'>ST</th>
                            <th class="text-center" width='5%'>ST PDF</th>
                            <th class="text-center" width='5%'>TTD</th>
                            <th class="text-center" width='5%'>SPD</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_suratTugasSkpdWhereStatus as $row) {
                            if ($row->status_ttd_spt > 0) {
                                $color = 'bg-green';
                            } else {
                                $color = '';
                            }
                            ?> 
                            <tr class="<?= $color; ?>">
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
                                        <a href="<?= base_url('index.php/admin/surat/Surat_tugas/tambah_surat_tugas/' . $id_skpd . '/' . $row->id); ?>" class="btn btn-primary btn-block btn-flat btn-xs">
                                            <i class='fa fa-search'></i>&nbsp;Buat Surat Tugas</a>
                                    </td>
                                    <td class="text-center">
                                        <button disabled class="btn btn-danger btn-flat btn-block btn-xs"><i class="fa fa-print"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <button disabled class="btn btn-danger btn-flat btn-block btn-xs"><i class="fa fa-download"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <button disabled class="btn btn-danger btn-flat btn-block btn-xs">TTD SPT</button>
                                    </td>
                                    <td class="text-center">
                                        <button disabled class="btn btn-danger btn-flat btn-block btn-xs">SPD</button>
                                    </td>
                                    <?php
                                } else {
                                    if ($row->status_ttd_spt > 0) {
                                        echo'<td class="text-center">
                                            <button disabled class="btn btn-danger btn-flat btn-block btn-xs"><i class="fa fa-search"></i>&nbsp;Edit</a></button>        
                                        </td>
                                            <td class="text-center">
                                        <a target="_blank" href="' . base_url() . 'index.php/laporan/Laporan_html/formulir_surat_tugas/' . $id_skpd . '?id_nd=' . $row->id . '" class="btn btn-primary btn-block btn-flat btn-xs"><i class="fa fa-print"></i></a>
                                    </td>
                                        </td>
                                            <td class="text-center">
                                        <a target="_blank" href="' . base_url() . 'index.php/laporan/Laporan_pdf/formulir_surat_tugas/' . $id_skpd . '?id_nd=' . $row->id . '" class="btn btn-primary btn-block btn-flat btn-xs"><i class="fa fa-print"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <button disabled class="btn btn-danger btn-flat btn-block btn-xs">Sudah TTD</button>
                                    </td>
                                    <td class="text-center">
                                        <a href="' . base_url() . 'index.php/admin/surat/surat_tugas/surat_perjalanan_dinas/' . $id_skpd . '?spt=' . $row->id_spt . '" class="btn btn-warning btn-block btn-flat btn-xs"><i class="fa fa-bar-chart"></i> SPD</a>
                                    </td>';
                                    } else {
                                        echo'<td class="text-center">
                                            <a href="' . base_url('index.php/admin/surat/Surat_tugas/edit_surat_tugas/' . $id_skpd . '/' . $row->id) . '" class="btn btn-primary btn-block btn-flat btn-xs">
                                                <i class="fa fa-search"></i>&nbsp;Edit</a>
                                        </td>
                                            <td class="text-center">
                                        <a target="_blank" href="' . base_url() . 'index.php/laporan/Laporan_html/formulir_surat_tugas/' . $id_skpd . '?id_nd=' . $row->id . '" class="btn btn-primary btn-block btn-flat btn-xs"><i class="fa fa-print"></i></a>
                                    </td>
                                        </td>
                                            <td class="text-center">
                                        <a target="_blank" href="' . base_url() . 'index.php/laporan/Laporan_pdf/formulir_surat_tugas/' . $id_skpd . '?id_nd=' . $row->id . '" class="btn btn-primary btn-block btn-flat btn-xs"><i class="fa fa-download"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <button type = "button" class = "btn btn-hover btn-primary btn-xs btn-block"
                                                data-toggle = "modal"
                                                data-target = "#ttd_spt"
                                                data-id_spt = "' . $row->id_spt . '">
                                            <i class = "fa fa-cogs"></i> Status TTD</button>
                                    </td>
                                    <td class="text-center">
                                        <a href="' . base_url() . 'index.php/admin/surat/surat_tugas/surat_perjalanan_dinas/' . $id_skpd . '?spt=' . $row->id_spt . '" class="btn btn-warning btn-block btn-flat btn-xs"><i class="fa fa-bar-chart"></i> SPD</a>
                                    </td>';
                                    }
                                }
                                ?>

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

<div class="modal fade" id="ttd_spt" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-maroon-gradient">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form merubah Status TTD SPT</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/surat/surat_tugas/update_ttdSpt" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="alert alert-info" id="informasi"></h3>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="id_spt" name="id_spt" placeholder="Id SPT" required>
                </div>
                <div class="modal-footer bg-maroon-gradient">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Kembali</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Ya</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#ttd_spt').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id_spt = button.data('id_spt');
//        alert(id_spt);
        var modal = $(this);
        modal.find('.modal-body input#id_spt').val(id_spt);
        modal.find('#informasi').html('Form Status Tanda Tangan Surat Tugas<br> <small>Apakah Sudah di Tanda Tangani...???</small>');
    });
</script>