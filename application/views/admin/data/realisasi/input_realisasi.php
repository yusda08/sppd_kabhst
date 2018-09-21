<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$level = $a['level_user'];
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
foreach ($skpd as $row_skpd) {
    if ($row_skpd->kunker == $id_skpd) {
        $nm_skpd = $row_skpd->nunker;
    }
}
?>
<section class="content-header alert bg-gray" style=" border-bottom-width: 19px; margin-bottom: 16px;margin-top: 0px;">
    <h1><?php echo strtoupper($page_name); ?><br><small><?= $nm_skpd; ?></small></h1>
    <ol class="breadcrumb ">
        <li><a href="#">Data Realisasi Anggaran</a></li>
        <li class="active">Input Realisasi Anggaran</li>
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
        <div class="col-md-12">
            <div id="notivs"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border bg-success">
                    Tabel Realisasi Dalam Daerah
                    <span class="pull-right">
                        <?php if($level!=2){ ?>
                        <button type='button' class='btn btn-success btn-sm' data-toggle='modal' 
                                data-target='#aksi_realisasi'
                                data-aksi="tambah"
                                data-info="dalam"
                                data-id_skpd="<?= $id_skpd; ?>"
                                ><i class='fa fa-plus'></i>&nbsp; Realisasi</button>
                        <?php } ?>
                    </span>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table  class="tabel_3 table table-hover table-bordered table-striped">
                            <thead>
                                <tr >
                                    <th width="3%">No</th>
                                    <th >No Nota Dinas / SPT</th>
                                    <th style="font-size: 8pt;" >Realisasi</th>
                                    <th width="15%" style="font-size: 8pt;" ><i class="fa fa-cogs"></i></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($get_realisasiAnggaranDalamWhereSkpd as $row_dlm) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $row_dlm->no_nota_dinas.' / '.$row_dlm->no_spt; ?></td>
                                        <td class="text-right">
                                            <span class="text-left">Rp.</span>
                                            <?= number_format($row_dlm->realisasi_dalam, 2, ',', '.'); ?></td>
                                        <td class="text-center">
                                            <?php if($level!=2){ ?>
                                            <div class="btn-group">
                                                <button type='button' class='btn btn-warning btn-xs' data-toggle='modal' 
                                                        data-target='#aksi_realisasi'
                                                        data-aksi="edit"
                                                        data-info="dalam"
                                                        data-id="<?= $row_dlm->id; ?>"
                                                        data-no_spt="<?= $row_dlm->no_spt; ?>"
                                                        data-realisasi="<?= $row_dlm->realisasi_dalam; ?>"
                                                        data-no_nd="<?= $row_dlm->no_nota_dinas; ?>"
                                                        data-id_skpd="<?= $id_skpd; ?>"><i class='fa fa-pencil'></i></button>
                                                <button type='button' class='btn btn-danger btn-xs' data-toggle='modal' 
                                                        data-target='#aksi_realisasi'
                                                        data-aksi="hapus"
                                                        data-info="dalam"
                                                        data-id="<?= $row_dlm->id; ?>"
                                                        data-no_spt="<?= $row_dlm->no_spt; ?>"
                                                        data-realisasi="<?= $row_dlm->realisasi_dalam; ?>"
                                                        data-no_nd="<?= $row_dlm->no_nota_dinas; ?>"
                                                        data-id_skpd="<?= $id_skpd; ?>"><i class='fa fa-trash'></i></button>
                                            </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div>    
        </div>
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border bg-info">
                    Tabel Realisasi Luar Daerah
                    <span class="pull-right">
                        <?php if($level!=2){ ?>
                        <button type='button' class='btn btn-info btn-sm' data-toggle='modal' 
                                data-target='#aksi_realisasi'
                                data-aksi="tambah"
                                data-info="luar"
                                data-id_skpd="<?= $id_skpd; ?>"
                                ><i class='fa fa-plus'></i>&nbsp; Realisasi</button>
                        <?php } ?>
                    </span>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table  class="tabel_3 table table-hover table-bordered table-striped">
                            <thead>
                                <tr >
                                    <th width="3%">No</th>
                                    <th >No. Nota Dinas / SPT</th>
                                    <th >Realisasi</th>
                                    <th width="15%" ><i class="fa fa-cogs"></i></th>
                                    <!--<th width="5%" style="font-size: 8pt; ">Hapus</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($get_realisasiAnggaranLuarWhereSkpd as $row_luar) {
                                    ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td><?= $row_luar->no_nota_dinas.' / '.$row_luar->no_spt; ?></td>
                                        <td class="text-right">
                                            <span class="pull-left">Rp.</span>
                                            <?= number_format($row_luar->realisasi_luar, 2, ',', '.'); ?></td>
                                        <td class="text-center">
                                            <?php if($level!=2){ ?>
                                            <div class="btn-group">
                                                <button type='button' class='btn btn-warning btn-xs' data-toggle='modal' 
                                                        data-target='#aksi_realisasi'
                                                        data-aksi="edit"
                                                        data-info="luar"
                                                        data-id="<?= $row_luar->id; ?>"
                                                        data-no_spt="<?= $row_luar->no_spt; ?>"
                                                        data-realisasi="<?= $row_luar->realisasi_luar; ?>"
                                                        data-no_nd="<?= $row_luar->no_nota_dinas; ?>"
                                                        data-id_skpd="<?= $id_skpd; ?>"><i class='fa fa-pencil'></i></button>
                                                <button type='button' class='btn btn-danger btn-xs' data-toggle='modal' 
                                                        data-target='#aksi_realisasi'
                                                        data-aksi="hapus"
                                                        data-info="luar"
                                                        data-id="<?= $row_luar->id; ?>"
                                                        data-no_spt="<?= $row_luar->no_spt; ?>"
                                                        data-realisasi="<?= $row_luar->realisasi_luar; ?>"
                                                        data-no_nd="<?= $row_luar->no_nota_dinas; ?>"
                                                        data-id_skpd="<?= $id_skpd; ?>"><i class='fa fa-trash'></i></button>
                                            </div>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div>    
        </div>
    </div>    
</section>

<div class="modal fade" id="aksi_realisasi" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-green">
                <button type="button" class="close" id="close-modal_realisasi" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Realisasi Anggaran Daerah</h4>
            </div>
            <form id="form_aksi_realisasi">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="infoHapus"></div>
                            <div class="form-group">
                                <label>Nomor Nota Dinas</label>
                                <input type='text' name='no_nd' class="form-control no_nd" autofocus="true" placeholder="Nomor Nota Dinas">
                            </div>
                            <div class="form-group">
                                <label>Nomor SPT</label>
                                <input type='text' name='no_spt' class="form-control no_spt" autofocus="true" placeholder="Nomor SPT">
                            </div>
                            <div class="form-group">
                                <label>Realisasi</label>
                                <div class="input-group">
                                    <span class="input-group-addon bg-gray">Rp.</span>
                                    <input type='number' name='realisasi' class="form-control text-right realisasi" id="realisasi" placeholder="Jumlah Realisasi">
                                    <span class="input-group-addon bg-gray">,00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control id_skpd" name="id_skpd" id="id_skpd" placeholder="ID SKPD">
                    <input type="hidden" class="form-control id" name="id" placeholder="ID">
                    <input type="hidden" class="form-control aksi" id="aksi" placeholder="Aksi">
                    <input type="hidden" class="form-control info" name="info" id='info' placeholder="Info">
                </div>
                <div class="modal-footer bg-green">
                    <div id="submitRealisasi"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#aksi_realisasi').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var realisasi = button.data('realisasi');
        var id_skpd = button.data('id_skpd');
        var no_spt = button.data('no_spt');
        var no_nd = button.data('no_nd');
        var aksi = button.data('aksi');
        var info = button.data('info');
        var modal = $(this);
        modal.find('.id_skpd').val(id_skpd);
        modal.find('.aksi').val(aksi);
        modal.find('.info').val(info);
        if (aksi == 'tambah') {
            modal.find('.infoHapus').html('');
            modal.find('.no_spt').val('').removeAttr('readonly', 'true');
            modal.find('.realisasi').val('').removeAttr('readonly', 'true');
            modal.find('.no_nd').val('').removeAttr('readonly', 'true');
            modal.find('.id').val('');
            modal.find('#submitRealisasi').html('<button type="submit" id="add" class="btn btn-info">' + aksi + '</button>');
        } else if (aksi == 'edit') {
            modal.find('.infoHapus').html('');
            modal.find('.no_spt').val(no_spt).removeAttr('readonly', 'true');
            modal.find('.no_nd').val(no_nd).attr('readonly', 'true');
            modal.find('.realisasi').val(realisasi).removeAttr('readonly', 'true');
            modal.find('.id').val(id);
            modal.find('#submitRealisasi').html('<button type="submit" id="add" class="btn btn-info">' + aksi + '</button>');
        } else if (aksi == 'hapus') {
            modal.find('.infoHapus').html('<h4 class="alert alert-danger">Apakah anda yakin menghapus realisasi ini . . . ? ? ?</h4>')
            modal.find('.no_spt').val(no_spt).attr('readonly', 'true');
            modal.find('.no_nd').val(no_nd).attr('readonly', 'true');
            modal.find('.realisasi').val(realisasi).attr('readonly', 'true');
            modal.find('.id').val(id);
            modal.find('#submitRealisasi').html('<button type="submit" id="add" class="btn btn-info"> ' + aksi + '</button>');
        }
    });

    $('#realisasi').after('<span class="status"></span>').css('margin-right', '10px');
    $('#realisasi').keyup(function () {
        $(this).css({'border': '1px solid #ccc', 'background': 'none'});
    });
    $('#realisasi').change(function (e) {
        var id_skpd = $('#id_skpd').val();
        var info = $('#info').val();
        var realisasi = parseInt($('#realisasi').val());
        if (id_skpd.length != 0) {
            $('.status').html('<img src="<?php echo base_url(); ?>/assets/img/loading.gif"><b> Chek ketersediaan ...</b>');
            var urlCek = "<?php echo base_url(); ?>index.php/admin/surat/Realisasi_anggaran/cek_sisaPagu/" + id_skpd + "/" + info;
            $.ajax({
                dataType: "json",
                url: urlCek,
                success: function (response) {
//                    alert(response["cek"]+ " - -  "+realisasi);
                    var jml_sisa = parseInt(response["cek"]) - realisasi;
//                    alert(jml_sisa);
                    if (jml_sisa >= 0) {
                        $('.status').html('<img src="<?php echo base_url(); ?>/assets/img/true.png"><b style="color:green;"> Batas Diterima</b>');
                        $('#add').removeAttr("disabled", "disabled");
                    } else if (jml_sisa < 0) {
                        $('.status').html('<img src="<?php echo base_url(); ?>/assets/img/false.png"><b style="color:red;"> Pagu Melebihi Batas Bro</b>');
                        $('#realisasi').css({'border': '3px solid #f00', 'background': 'yellow'});
                        $("#add").attr("disabled", "disabled");
                    }
                }
            });
        } else {
            $('.status').html('');
        }
    });

    $('#form_aksi_realisasi').validate({
        rules: {
            no_nd: {required: true},
            realisasi: {required: true}
        },
        submitHandler: function (form) {
            var aksi = $('#aksi').val();
            if (aksi == 'tambah') {
                var url_form = '<?= base_url(); ?>index.php/admin/surat/Realisasi_anggaran/insertRealisasiAnggaran';
            } else if (aksi == 'edit') {
                var url_form = '<?= base_url(); ?>index.php/admin/surat/Realisasi_anggaran/updateRealisasiAnggaran';
            } else if (aksi == 'hapus') {
                var url_form = '<?= base_url(); ?>index.php/admin/surat/Realisasi_anggaran/deleteRealisasiAnggaran';
            }
            $.ajax({
                type: 'POST',
                url: url_form,
                data: $(form).serialize(),
                success: function (data) {
                    if (data == 'true') {
                        $("#notivs").html('<div class="alert alert-success alert-dismissable animated fadeIn" id="notification"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Sukses!</h4> Berhasil di Hapus. </div>');
                        $('#close-modal_realisasi').trigger("click");
                        setTimeout(function () {
                            $('#notification').fadeOut('slow');
                            window.location.reload();
                        }, 2000);
                    } else {
                        $("#notivs").html('<div class="alert alert-danger alert-dismissible" id="alert-notification"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Gagal Di Hapus. </div>');
                        $('#close-modal_katagori').trigger("click");
                        setTimeout(function () {
                            $('#alert-notification').fadeOut('slow');
                        }, 2000);
                    }
                }
            });
        }
    });
</script>