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
                <table class="tabel_3 table table-hover table-bordered table-striped" width="100%">
                    <thead >
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th  width="10%">Kode SKPD</th>
                            <th >Nama SKPD</th>
                            <th width="15%">Kouta Dalam Daerah</th>
                            <th width="15%">Kouta Luar Daerah</th>
                            <th >Setting</th>
                            <th width="7%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($skpd as $skp) {
                            foreach ($get_setSkpd as $row) {
                                if ($row->kode_skpd == $skp->kunker) {
                                    ?>
                                    <tr class="bg-danger">
                                        <td style="text-align: center;"><?= $no; ?></td>
                                        <td style="text-align: center;"><?= $skp->kunker; ?></td>
                                        <td style=""><?= $skp->nunker; ?></td>
                                        <td style="" class="text-right ">
                                            <span class="pull-left">Rp.</span>
                                            <a href="#" data-type="text" data-placement="top" class="dalam_<?= $row->kode_skpd; ?>" id="<?= $row->kode_skpd; ?>"><?= number_format($row->kouta_anggaran_dalam, 2, ',', '.'); ?></a>
                                            <!--<a href="#" id="username" data-type="text" data-placement="right" data-title="Enter username">superuser</a>-->
                                            <script>
                                                $(document).ready(function () {
                                                    $.fn.editable.defaults.mode = 'popup';
            //                                                     $('.status_<?= $row->kode_skpd; ?>').editable();
                                                    $('.dalam_<?= $row->kode_skpd; ?>').editable({
                                                        type: 'number',
                                                        title: 'Pagu Anggaran <?= $skp->nunker; ?>',
                                                        pk: 1,
                                                        url: '<?php echo base_url(); ?>index.php/admin/setting/Set_kepalaSkpd/update_koutaAnggaranDalam',
                                                        ajaxOptions: {dataType: 'json'},
                                                        display: function (value, response) {
                                                            return false; //disable this method
                                                        },
                                                        success: function (response, newValue) {
//                                                            alert(response.msg);
                                                            if (response.msg == 'true') {
                                                                $("#notivs").html('<div class="alert alert-success alert-dismissable animated fadeIn" id="notification"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Sukses!</h4> Berhasil di Edit. </div>');
                                                                setTimeout(function () {
//                                                                    refresData();
                                                                    $('#notification').fadeOut('slow');
                                                                    window.location.reload();
                                                                }, 2000);
                                                            } else {
                                                                $("#notivs").html('<div class="alert alert-danger alert-dismissible" id="alert-notification"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Gagal Disimpan. </div>');
                                                                setTimeout(function () {
                                                                    $('#alert-notification').fadeOut('slow');
                                                                }, 2000);
                                                            }
                                                        }
                                                    });
                                                });
                                            </script>

                                        </td>
                                        <td style="" class="text-right ">
                                            <span class="pull-left">Rp.</span>
                                            <a href="#" data-type="text" data-placement="top" class="luar_<?= $row->kode_skpd; ?>" id="<?= $row->kode_skpd; ?>"><?= number_format($row->kouta_anggaran_luar, 2, ',', '.'); ?></a>
                                            <!--<a href="#" id="username" data-type="text" data-placement="right" data-title="Enter username">superuser</a>-->
                                            <script>
                                                $(document).ready(function () {
                                                    $.fn.editable.defaults.mode = 'popup';
            //                                                     $('.status_<?= $row->kode_skpd; ?>').editable();
                                                    $('.luar_<?= $row->kode_skpd; ?>').editable({
                                                        type: 'number',
                                                        title: 'Pagu Anggaran <?= $skp->nunker; ?>',
                                                        pk: 1,
                                                        url: '<?php echo base_url(); ?>index.php/admin/setting/Set_kepalaSkpd/update_koutaAnggaranLuar',
                                                        ajaxOptions: {dataType: 'json'},
                                                        display: function (value, response) {
                                                            return false; //disable this method
                                                        },
                                                        success: function (response, newValue) {
//                                                            alert(response.msg);
                                                            if (response.msg == 'true') {
                                                                $("#notivs").html('<div class="alert alert-success alert-dismissable animated fadeIn" id="notification"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Sukses!</h4> Berhasil di Edit. </div>');
                                                                setTimeout(function () {
//                                                                    refresData();
                                                                    $('#notification').fadeOut('slow');
                                                                    window.location.reload();
                                                                }, 2000);
                                                            } else {
                                                                $("#notivs").html('<div class="alert alert-danger alert-dismissible" id="alert-notification"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Gagal Disimpan. </div>');
                                                                setTimeout(function () {
                                                                    $('#alert-notification').fadeOut('slow');
                                                                }, 2000);
                                                            }
                                                        }
                                                    });
                                                });
                                            </script>

                                        </td>
                                        
                                        <td style="">
                                            <?php
                                            $get_setSkpdWhereKd = $this->Data_setting->get_setSkpdWhereKd($skp->kunker);
                                            if (count($get_setSkpdWhereKd)) {
                                                ?>
                                                <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                        data-toggle="modal" 
                                                        data-kunker="<?= $skp->kunker; ?>"
                                                        data-nunker="<?= $skp->nunker; ?>" 
                                                        data-target="#edit_setting_skpd">
                                                    <i class="fa fa-cogs"></i> Setting</button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-dark btn-xs btn-block btn-flat" 
                                                        data-toggle="modal" 
                                                        data-kunker="<?= $skp->kunker; ?>" 
                                                        data-nunker="<?= $skp->nunker; ?>" 
                                                        data-target="#setting_skpd">
                                                    <i class="fa fa-cogs"></i> Setting</button>
                                            <?php } ?>
                                        </td>
                                        <td style="">
                                            <?php
                                            $get_SetKepalaSkpdWhereKd = $this->Data_setting->get_SetKepalaSkpdWhereKd($skp->kunker);
                                            if (count($get_SetKepalaSkpdWhereKd) > 0) {
                                                ?>
                                                <button type="button" class="btn btn-warning btn-xs btn-block btn-flat"
                                                        data-toggle="modal" 
                                                        data-kunker="<?= $skp->kunker; ?>" 
                                                        data-target="#update">
                                                    <i class="fa fa-pencil"></i> Edit</button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-primary btn-xs btn-block btn-flat" 
                                                        data-toggle="modal" 
                                                        data-kunker="<?= $skp->kunker; ?>" 
                                                        data-nunker="<?= $skp->nunker; ?>" 
                                                        data-target="#tambah">
                                                    <i class="fa fa-plus"></i> Kepala</button>
                                            <?php } ?>
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

<div class="modal fade" id="tambah" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Form Tambah Kepala SKPD</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_kepalaSkpd/insert_kepalaSkpd" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Pegawai</label>
                            <select name='pegawai' id='pegawai' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Kepala SKPD --</option>
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
                    <input type="hidden" class="form-control" id="kode_skpd" name="kode_skpd">
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
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Edit Kepala SKPD</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_kepalaSkpd/update_kepalaSkpd" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="editKepalaSkpd"></div>
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
<div class="modal fade" id="setting_skpd" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Form Setting SKPD</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_kepalaSkpd/insert_settingSkpd" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <h3 class="alert alert-info text-center text-black" id='nama_skpd'></h3>
                            <div class="form-group col-md-3">
                                <label>Alamat SKPD</label>
                            </div>
                            <div class="form-group col-md-9">
                                <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Alamat Email</label>
                            </div>
                            <div class="form-group col-md-9">
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>No Telpon</label>
                            </div>
                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" id="no_telpon" name="no_telpon" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Kode Pos</label>
                            </div>

                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Inisial Kode Surat</label>
                            </div>

                            <div class="form-group col-md-9">
                                <input type="text" class="form-control" id="inisial" name="inisial" required>
                            </div>
                            <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                            <input type="hidden" class="form-control" id="kode_skpd" name="kode_skpd">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-blue">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="edit_setting_skpd" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Form Setting SKPD</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_kepalaSkpd/update_settingSkpd" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <h3 class="alert alert-info text-center text-black" id='nama_skpd'></h3>
                            <div class="editSettingSkpd"></div>
                            <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                            <input type="hidden" class="form-control" id="kode_skpd" name="kode_skpd">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-blue">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#tambah').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var kunker = button.data('kunker');
        $(this).find('.modal-body input#kode_skpd').val(kunker);
        var url = "<?php echo base_url(); ?>index.php/admin/setting/Set_kepalaSkpd/pegawaiSkpd/" + kunker;
        $('#pegawai').load(url);
        return true;
    });
    $('#setting_skpd').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var kunker = button.data('kunker');
        var nunker = button.data('nunker');
        $(this).find('.modal-body input#kode_skpd').val(kunker);
        $(this).find('#nama_skpd').text(nunker);
    });
    $("#pegawai").change(function () {
        var nip = $("#pegawai").find('option:selected').data('nip');
        var jabatan = $("#pegawai").find('option:selected').data('jabatan');
        $('.hidden').removeClass("hidden");
        $('.nip').val(nip);
        $('.jabatan').val(jabatan);
    });
    $('#update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var kunker = button.data('kunker');
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_kepalaSkpd/modal_editKepalaSkpd/" + kunker,
            success: function (respont) {
                $('.editKepalaSkpd').html(respont);
            }
        });
        var kunker = button.data('kunker');
    });
    $('#edit_setting_skpd').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var kunker = button.data('kunker');
        var nunker = button.data('nunker');
//        alert(nunker);
        $(this).find('#kode_skpd').val(kunker);
        $(this).find('#nama_skpd').text(nunker);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_kepalaSkpd/modal_editSettingSkpd/" + kunker,
            success: function (respont) {
                $('.editSettingSkpd').html(respont);
            }
        });
    });

</script>
