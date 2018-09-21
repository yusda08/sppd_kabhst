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
        <li><a href="#">Data Referensi</a></li>
        <li class="active">Referensi User</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <label>Pilih Level User :</label>
        </div>        
        <div class="col-md-4">
            <?php
            $level_user = isset($_REQUEST['level_user']) ? $_REQUEST['level_user'] : "";
            ?>
            <form name='flevel_user' method='get' >
                <select name='level_user'class="btn btn-default select2" style="width: 100%"  onchange='document.flevel_user.submit();'>
                    <option value=''> Pilih Level User</option>
                    <?php
                    foreach ($get_level_user as $glu) {
                        echo"<option value='$glu->level'";
                        if ($level_user == $glu->level)
                            echo" selected";
                        echo">$glu->nama</option>";
                    }
                    ?>
                </select> 
            </form>
        </div>

    </div>
    <hr>

    <?php
    if (!empty($level_user)) {
        $get_userWhereLevel = $this->data_administrator->get_userWhereLevel($level_user);
        ?>


        <div class="box box-success">
            <div class="box-header with-border">
                <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' 
                        data-target='#tambah' 
                        data-level='<?= $level_user; ?>'><i class='fa fa-plus'></i>&nbsp;Tambah Administrator</button>

            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table  class="tabel_1 table table-hover table-bordered">
                        <thead class='<?php echo $color; ?>'>
                            <tr>
                                <th width="5%"> No</th>
                                <th width="10%"> Username</th>
                                <th> Password</th>
                                <th> Last Date / Time</th>
                                <th width="15%"> Status Online</th>
                                <th width="7%"> Reset</th>
                                <th class="text-center" style="width: 30px;"><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                            foreach ($get_userWhereLevel as $gua) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php
                                        echo $n;
                                        $n++;
                                        ?></td>

                                    <td><?= $gua->username; ?></td>
                                    <td><?= $gua->password; ?></td>

                                    <td class="text-center"><?= Tgl_indo::indo($gua->last_date) . "<br>" . $gua->last_time; ?></td>
                                    <?php
                                    if ($gua->ol == 'Y') {
                                        echo"<td class='text-center'><span class='label label-success'>Online</span></td>";
                                    } else {
                                        echo"<td class='text-center'><span class='label label-danger'>Offline</span></td>";
                                    }
                                    ?>
                                    <td>
                                        <button type = "button" class = "btn btn-hover btn-primary btn-xs btn-block"
                                                data-toggle = "modal"
                                                data-target = "#rest_pass"
                                                data-username = "<?= $gua->username; ?>"
                                                data-id = "<?= $gua->id; ?>">
                                            <i class = "fa fa-cogs"></i> Reset</button>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-xs btn-block" 
                                                data-toggle="modal"
                                                data-id="<?= $gua->id; ?>"
                                                data-username="<?= $gua->username; ?>"
                                                data-target="#hapus">
                                            <i class="fa fa-trash-o"></i> Hapus</button>
                                    </td>
                                </tr>
                                <?php
                            }
//                                
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div><!-- /.box-body -->
    <?php } ?>

</section>

<div class="modal fade" id="tambah" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Data User</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_user/insert_user" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">

                        <div class='administrator'>
                            <div class="form-group col-md-12">
                                <h3 class="alert alert-success text-center">Administrator</h3>
                                <input class="form-control" type="hidden" name="kode_adm" id="kode_adm" value="100">
                            </div>
                        </div>

                        <div class='skpd'>
                            <div class="form-group col-md-12">
                                <label>Piliih SKPD</label>
                                <select class="form-control select2" id='skpd1' name='skpd1' style="width: 100%;">
                                    <option >-- Pilih SKPD --</option>
                                    <?php
                                    foreach ($skpd as $gs) {
                                        foreach ($get_user_all as $gsa) {
                                            $kode = $gsa->kode;
                                            if ($gsa->level_user == 2 and $kode == $gs->kunker ) {
                                                $att = 'disabled';
                                                if ($gs->nunker == 'Sekretariat Daerah') { // sekda boleh lebih dari 1 user
                                                    $att = '';
                                                }
                                                break;
                                            } else {
                                                $att = '';
                                            }
                                        }
                                        ?>
                                        <option <?= $att; ?> value='<?= $gs->kunker; ?>' ><?= $gs->nunker; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class='executive'>
                            <div class="form-group col-md-12">
                                <label>Nama Pimpinan</label>
                                <select name='kode_exe' class="form-control select2" style="width: 100%;">
                                    <option value=''>-- Pilih Executive--</option>
                                    <?php foreach ($get_ref_executive as $gse) {
                                        ?>
                                        <option value='<?= $gse->id; ?>' ><?= $gse->nama; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class='staf_ahli'>
                            <div class="form-group col-md-12">
                                <label>Pilih Staf Ahli</label>
                                <select class="form-control select2" id='staf_ahli' name='skpd_pegawai' style="width: 100%;" required>
                                    <option >-- Pilih SKPD --</option>
                                    <?php foreach ($get_setStafAhli as $gssa) { ?>
                                        <option value='<?= $gssa->id; ?>' 
                                                data-nip_nik='<?= $gssa->nip_nik; ?>' data-jabatan='<?= $gssa->jabatan; ?>' data-id='<?= $gssa->id; ?>'><?= $gssa->nama; ?></option>
                                            <?php } ?>
                                </select>
                                <div class="hidden">

                                    <label>NIP</label>
                                    <input type="text" readonly class="form-control"  id="nip_staf_ahli" name="nip_staf_ahli">

                                    <label>Jabatan</label>
                                    <input type="text" readonly class="form-control"  id="jabatan_staf_ahli" name="jabatan_staf_ahli">
                                    <input type="text" readonly class="form-control"  id="id_staf_ahli" name="id_staf_ahli">
                                </div>
                            </div>
                        </div>


                        <div class='kepala_skpd'>
                            <div class="form-group col-md-12">
                                <label>Piliih SKPD</label>
                                <select class="form-control select2" id='skpd_kepala' name='skpd_kepala' style="width: 100%;" required>
                                    <option >-- Pilih SKPD --</option>
                                    <?php foreach ($skpd as $gsa) { ?>
                                        <option value='<?= $gsa->kunker; ?>' 
                                                data-kunker='<?= $gsa->kunker; ?>'><?= $gsa->nunker; ?></option>
                                            <?php } ?>
                                </select>
                            </div>
                            <div class="hidden">
                                <div class="form-group col-md-12">
                                    <label>Nama</label>
                                    <input type="text" readonly class="form-control"  id="nama_kepala" name="nama_kepala">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>NIP</label>
                                    <input type="text" readonly class="form-control"  id="nip_kepala" name="nip_kepala">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Jabatan</label>
                                    <input type="text" readonly class="form-control"  id="jabatan_kepala" name="jabatan_kepala">
                                </div>
                            </div>
                            <input type="hidden" readonly class="form-control"  id="kode_skpd" name="kode_skpd">
                        </div>


                        <div class='sekda'>
                            <?php
                            foreach ($get_sekda as $gs) {
                                foreach ($get_dataPegawai as $gdp) {
                                    if ($gdp->nip_nik == $gs->nip_nik) {
                                        ?>
                                        <div class="form-group col-md-3">
                                            <label>Nama</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input class="form-control" id='nm_sekda' name="nm_sekda" readonly required value="<?= $gdp->nama; ?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>NIP</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input class="form-control" type="text" id='nip_sekda' name="nip_sekda" readonly required value="<?= $gdp->nip_nik; ?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Jabatan</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input class="form-control" type="text" id='jabatan_sekda' name="jabatan_sekda" readonly required value="<?= $gdp->jabatan; ?>">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Email</label>
                                        </div>
                                        <div class="form-group col-md-9">
                                            <input class="form-control" type="text" id='jabatan_sekda' name="jabatan_sekda" readonly required value="<?= $gs->email; ?>">
                                            <input class="form-control" type="hidden" id='id_sekda' name="id_sekda" readonly required value="<?= $gs->id; ?>">
                                        </div>

                                        <?php
                                    }
                                }
                            }
                            ?>
                        </div>

                        <div class='asisten'>
                            <div class="form-group col-md-12">
                                <select class="form-control select2" id='asisten' name='asisten' style="width: 100%;" required>
                                    <option >-- Pilih Asisten --</option>
                                    <?php
                                    foreach ($get_refAsisten as $gra) {
                                        $id = $gra->id;
                                        $nama = $gra->nama;
                                        ?>
                                        <option value='<?= $id; ?>'><?= $nama; ?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>


                        <div class="form-group col-md-12">
                            <label>Username</label>
                            <input type="text"  class="form-control" autocomplete="off" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Password</label>
                            <input type="password" class="form-control" autocomplete="off"  id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="level_user" name="level_user" placeholder="Level User" required>
                </div>
                <div class="modal-footer bg-blue">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="update_status_aktif" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Tambah Data Katagori</h4>
            </div>
            <form id="form_tambah"  method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_user/insert_user" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Apakah Anda Yakin Menonaktifkan Status Pada User Ini ... ?</label>
                            <input type="text" class="form-control bg-danger" id="nama" name="nama">
                            <input type="hidden" class="form-control" id="id" name="id">
                        </div>                            
                    </div>
                </div>
                <div class="modal-footer bg-gray">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapus" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><i class="fa fa-shopping-cart"></i> Delete Username</h4>
            </div>
            <form id="tambah_urusan" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_user/hapus_user" method="POST">
                <div class="modal-body">
                    <h3 class='alert bg-gray'>Anda akan menghapus Username ini, lanjutkan?</h3>
                    <div class="row">
                        <div class="col-md-12">       
                            <label for="nama_program">Username</label>
                            <input type="text" class="form-control" id="username" name="username" disabled>
                        </div>
                    </div>

                    <input type="hidden" class="form-control" id="id" name="id" >
                    <input type="hidden" class="form-control" id="url" name="url" value="<?php echo $url; ?>">

                </div>
                <div class="modal-footer bg-red">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" id="update" class="btn bg-orange" data-loading-text="Loading..." autocomplete="off">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="rest_pass" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Form Hapus User</h4>
            </div>
            <form id="form_tambah" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_user/rest_pass" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12"> 
                            <h3 class='alert alert-success'> Apakah Anda Yakin Mereset Password Pada Username Ini . . . !!!</h3>
                        </div>
                        <div class="col-md-3">
                            <label>Username</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" class="form-control" id="username" name="username_baru" required>
                            <input type="hidden" class="form-control" id="username" name="username_lama" required>
                        </div>
                        <div class="col-md-3">
                            <label>Password</label>
                        </div>
                        <div class="col-md-9">
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <input type="hidden" class="form-control" name="id" id='id'>
                        <input type="hidden" class="form-control" name="url" value='<?= $url ?>'>
                    </div>
                </div>
                <div class="modal-footer bg-red">
                    <button type="button" class="btn btn-default" id='close' data-dismiss="modal">Tutup</button>
                    <button type="submit" id="tambah" class="btn btn-primary" data-loading-text="Loading..." autocomplete="off">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#rest_pass').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var username = button.data('username');
        var modal = $(this);
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#username').val(username);
    });
    $(document).ready(function () {
        $('#username').after('<span class="status"></span>').css('margin-right', '10px');
        $('#username').keyup(function () {
            $(this).css({'border': '1px solid #ccc', 'background': 'none'});
        });
        $('#username').change(function (e) {
            var username = $(this).val();
            if (username.length != 0) {
                $('.status').html('<img src="<?php echo base_url(); ?>/assets/img/loading.gif"><b> Chek ketersediaan ...</b>');
                $.ajax({
                    dataType: "json",
                    url: "<?php echo base_url(); ?>index.php/admin/referensi/Ref_user/cek_username/" + username,
                    success: function (response) {
//                                            alert(response[0].cek);
                        if (response[0].cek == 0) {
                            $('.status').html('<img src="<?php echo base_url(); ?>/assets/img/true.png"><b style="color:green;"> Username diterima</b>');
                            $('#add').removeAttr("disabled", "disabled");
                        } else {
                            $('.status').html('<img src="<?php echo base_url(); ?>/assets/img/false.png"><b style="color:red;"> Username sudah digunakan</b>');
                            $('#username').css({'border': '3px solid #f00', 'background': 'yellow'});
                            $("#add").attr("disabled", "disabled");
                        }
                    }
                });
            } else {
                $('.status').html('');
            }
        });

    });

    $("#skpd_pegawai").change(function () {
        var kun = $("#skpd_pegawai").find('option:selected').data('kun');
        var kom = $("#skpd_pegawai").find('option:selected').data('kom');
        var url = "<?php echo base_url(); ?>index.php/admin/referensi/Ref_user/add_pegawaiSkpd/" + kun + "/" + kom;
        $('#pegawai').load(url);
        return false;
    });

    $("#skpd_kepala").change(function () {
        var kunker = $("#skpd_kepala").find('option:selected').data('kunker');
        $("#kode_skpd").val(kunker);
        $.ajax({
            url: "<?php echo base_url(); ?>index.php/admin/referensi/Ref_user/pegawaiKepalaSkpd/" + kunker,
            dataType: "json",
            success: function (response) {
                $('.hidden').removeClass('hidden');
                $("#nip_kepala").val(response[0].nip);
                $("#nama_kepala").val(response[0].nama);
                $("#jabatan_kepala").val(response[0].jabatan);
            }
        });
    });


    $("#pegawai").change(function () {
        var nip = $("#pegawai").find('option:selected').data('nip');
        $('#username').val(nip);
        $('#username').attr("readonly", "readonly");

    });
    $("#staf_ahli").change(function () {
        var nip = $("#staf_ahli").find('option:selected').data('nip_nik');
        var jabatan = $("#staf_ahli").find('option:selected').data('jabatan');
        var id = $("#staf_ahli").find('option:selected').data('id');
        $('.hidden').removeClass('hidden');
        $('#nip_staf_ahli').val(nip);
        $('#jabatan_staf_ahli').val(jabatan);
        $('#id_staf_ahli').val(id);


    });


    $('#update_status_aktif').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nama = button.data('nama');
        var modal = $(this);
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#nama').val(nama);
    });

    $('#tambah').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var level_user = button.data('level');
        var modal = $(this);
        modal.find('.modal-body input#level_user').val(level_user);
        if (level_user == '1') {
            modal.find('.administrator').show();
            modal.find('.skpd').hide();
            modal.find('.executive').hide();
            modal.find('.staf_ahli').hide();
            modal.find('.kepala_skpd').hide();
            modal.find('.sekda').hide();
            modal.find('.asisten').hide();
        } else if (level_user == '2') {
            $('.administrator').hide();
            $('.skpd').show();
            $('.executive').hide();
            $('.staf_ahli').hide();
            $('.kepala_skpd').hide();
            $('.sekda').hide();
            $('.asisten').hide();
        } else if (level_user == '3') {
            $('.administrator').hide();
            $('.skpd').hide();
            $('.executive').show();
            $('.kepala_skpd').hide();
            $('.sekda').hide();
            $('.staf_ahli').hide();
            $('.asisten').hide();
        } else if (level_user == '4') {
            $('.administrator').hide();
            $('.skpd').hide();
            $('.executive').hide();
            $('.staf_ahli').show();
            $('.kepala_skpd').hide();
            $('.sekda').hide();
            $('.asisten').hide();
        } else if (level_user == '5') {
            $('.administrator').hide();
            $('.skpd').hide();
            $('.executive').hide();
            $('.pegawai').hide();
            $('.staf_ahli').hide();
            $('.kepala_skpd').show();
            $('.sekda').hide();
            $('.asisten').hide();
        } else if (level_user == '6') {
            $('.administrator').hide();
            $('.skpd').hide();
            $('.executive').hide();
            $('.staf_ahli').hide();
            $('.kepala_skpd').hide();
            $('.sekda').show();
            $('.asisten').hide();
        } else if (level_user == '7') {
            $('.administrator').hide();
            $('.skpd').hide();
            $('.executive').hide();
            $('.staf_ahli').hide();
            $('.kepala_skpd').hide();
            $('.sekda').hide();
            $('.asisten').show();
        }

    });
    $('#hapus').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')
        var username = button.data('username')
        var modal = $(this)
        modal.find('.modal-body input#id').val(id)
        modal.find('.modal-body input#username').val(username)
    });

</script>
