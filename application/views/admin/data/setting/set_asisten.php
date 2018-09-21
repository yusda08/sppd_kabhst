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
        <div class="col-xs-12">
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
        <li><a href="#">Setting Asisten</a></li>
        <li class="active">Data Asisten</li>
    </ol>
</section>
<section class="content">

    <div class="box box-success">
        <div class="box-header with-border">
            <div class="col-md-3 col-xs-6">
                <?php
//                foreach ($count_SetAsisten as $csa) {
//                    $count = $csa->count;
//                }
//                if ($count >= 3) {
                ?>
                    <!--<button type='button' class='btn btn-primary btn-flat btn-sm btn-block' disabled><i class='fa fa-plus'></i>&nbsp;Tambah Asisten</button>-->
                <?php // } else { ?>
                <button type='button' class='btn btn-primary btn-flat btn-sm btn-block' data-toggle='modal' 
                        data-target='#tambah'><i class='fa fa-plus'></i>&nbsp;Tambah Asisten</button>

                <?php // } ?>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table  class="tabel_1 table table-hover table-bordered table-striped">
                    <thead>
                        <tr >
                            <th width="5%">No</th>
                            <th width="10%">Asisten</th>
                            <th width="25%">Nama<br>NIP</th>
                            <th width=30%">Jabatan</th>
                            <th>Email</th>
                            <th width="5%"><i class="fa fa-plus"></i></th>
                            <th width="5%"><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_SetAsisten as $gsa) {
                            ?>
                            <tr class="bg-info">
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-center"><?= $gsa->nm_as; ?></td>
                                <td ><?= $gsa->nama . "<br> NIP. " . $gsa->nip_nik; ?></td>
                                <td ><?= $gsa->jabatan; ?></td>
                                <td ><?= $gsa->email; ?></td>
                                <td > 
                                    <?php
                                    $get_SetAsistenSkpd = $this->Data_setting->get_SetAsistenSkpdWhereAsisten($gsa->id);
                                    if (count($get_SetAsistenSkpd) >= 0) {
                                        ?>
                                        <a href="<?= base_url(); ?>index.php/admin/setting/Set_asistenSkpd/lihat_asistenSkpd/<?= $gsa->id; ?>" type="button" class="btn btn-warning btn-xs btn-block btn-flat"> <i class="fa fa-search"></i> Lihat</a>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-primary btn-xs btn-block btn-flat" 
                                                data-toggle="modal" 
                                                data-id="<?= $gsa->id; ?>" 
                                                data-target="#tamabhSkpd">
                                            <i class="fa fa-plus"></i> SKPD</button>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-cogs"></i> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li> <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                         data-toggle="modal" 
                                                         data-id="<?= $gsa->id; ?>" 
                                                         data-target="#update">
                                                    <i class="fa fa-pencil"></i> Edit</button></li>
                                            <li><button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                        data-toggle="modal"
                                                        data-id="<?= $gsa->id; ?>" 
                                                        data-target="#delete">
                                                    <i class="fa fa-trash-o"></i> Hapus</button></li>
                                        </ul>
                                    </div>
                                </td>
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

<div class="modal fade" id="tambah" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Form Tambah Asisten</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_asisten/insert_asisten" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Asisten</label>
                            <select name='asisten' id='asisten' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Jabatan Asisten --</option>
                                <?php
                                foreach ($get_refAsisten as $gra) {
                                    $id = $gra->id;
                                    $nama = $gra->nama;
                                    foreach ($get_SetAsisten as $gsa) {
                                        if ($id == $gsa->asisten) {
                                            $att = 'disabled';
                                            break;
                                        } else {
                                            $att = '';
                                        }
                                    }
                                    echo"<option " . $att . " value='" . $id . "'>" . $nama . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        
                        <div class="form-group col-md-12">
                            <label>Nama Pegawai</label>
                            <select class="btn btn-default select2 pegawai" style="width: 100%">
                                <option value=''> Pilih Pegawai</option>
                                <?php
                                foreach ($get_dataPegawai as $gdp) {
                                    if ($gdp->status_pegawai == 'pns') {
                                        echo"<option  value='" . $gdp->nip_nik . "'"
                                        . "data-nip='" . $gdp->nip_nik . "'"
                                        . " data-jabatan='" . $gdp->jabatan . "'>" . $gdp->nama . "</option>";
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="hidden">
                            <div class="form-group col-md-12">
                                <label>NIP</label>
                                <input type="text" readonly class="form-control nip" name="nip" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label>Jabatan</label>
                                <input type="text" readonly class="form-control jabatan" name="jabatan" required>
                            </div>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label>Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                </div>
                <div class="modal-footer bg-blue">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="update" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow-gradient">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Edit Asisten</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_asisten/update_asisten" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="editAsisten"></div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                </div>
                <div class="modal-footer bg-yellow-gradient">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-red-gradient">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Hapus Asisten</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_asisten/delete_asisten" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="hapusAsisten"></div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                </div>
                <div class="modal-footer bg-red-gradient">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="hps" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="tamabhSkpd" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue-gradient">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Tambah SKPD Asisten</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_asistenSkpd/insert_skpdAsisten" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tamabhSkpdAsisten"></div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                </div>
                <div class="modal-footer bg-blue-gradient">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_asisten/modal_editAsisten/" + id,
            success: function (respont) {
                $('.editAsisten').html(respont);
            }
        });
    });
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var modal = $(this);
        $.ajax({
            dataType: "json",
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_asisten/cek_dataSetAsisten/" + id,
            success: function (response) {
                if (response[0].cek == 0) {
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo base_url(); ?>index.php/admin/setting/Set_asisten/modal_hapusAsisten/" + id,
                        success: function (respont) {
                            $('.hapusAsisten').html(respont);
                        }
                    });
                } else {
                    $('.hapusAsisten').html('<h4 class="alert alert-danger">Data Tidak Bisa Dihapus Karena Data Dipakai pada Data Pegawai</h4>');
                    $("#hps").attr("disabled", "disabled");
                }
            }
        });


    });

    $('#tamabhSkpd').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_asistenSkpd/modal_tambahSkpdAsisten/" + id,
            success: function (respont) {
                $('.tamabhSkpdAsisten').html(respont);
            }
        });
    });

    $('.pegawai').on('change', function () {
        $(".hidden").removeClass('hidden');
        var jabatan = $(".pegawai option:selected").data('jabatan');
        var nip = $(".pegawai option:selected").data('nip');
        $(".jabatan").val(jabatan);
        $(".nip").val(nip);
    });
</script>