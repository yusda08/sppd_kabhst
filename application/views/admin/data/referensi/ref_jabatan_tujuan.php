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
        <div class="col-md-6">
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
        <li><a href="#">Data Refrensi Jabatan dan Tujuan</a></li>
        <li class="active">Jabatan dan Tujuan</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border bg-success">
                    Tabel Referinsi Jabatan
                    <span class="pull-right">
                        <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' 
                                data-target='#tambah'><i class='fa fa-plus'></i>&nbsp;Tambah Ref Jabatan</button>
                    </span>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table  class="tabel_3 table table-hover table-bordered table-striped">
                            <thead>
                                <tr >
                                    <th width="5%">No</th>
                                    <th width="25%">Nama Jabatan</th>
                                    <th width="5%" style="font-size: 8pt;" >Edit</th>
                                    <!--<th width="5%" style="font-size: 8pt; ">Hapus</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($get_refJabatan as $grj) {
                                    ?>
                                <tr class="bg-success">
                                        <td class="text-center"
                                            style="font-size: 9pt;"><?= $no; ?></td>
                                        <td style="font-size: 9pt;"><?= $grj->nama_jabatan; ?></td>
                                        <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                     data-toggle="modal" 
                                                     data-id="<?= $grj->id; ?>"
                                                     data-nm_jbtn="<?= $grj->nama_jabatan; ?>"
                                                     data-tingkat="<?= $grj->tingkat; ?>"
                                                     data-target="#update">
                                                <i class="fa fa-pencil"></i></button>
                                </td>
<!--                                <td>
                                    <button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                    data-toggle="modal"
                                                    data-id="<?= $grj->id; ?>"
                                                    data-nm_jbtn="<?= $grj->nama_jabatan; ?>"
                                                    data-target="#delete">
                                                <i class="fa fa-trash-o"></i></button>
                                </td>-->
                                <?php
                                $no++;
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.box-body -->
            </div>    
        </div>
        
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border bg-info">
                    Tabel Referinsi Tujuan
                    <span class="pull-right">
                        <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' 
                                data-target='#tambah_tujuan'><i class='fa fa-plus'></i>&nbsp;Tambah Ref Tujuan</button>
                    </span>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table  class="tabel_3 table table-hover table-bordered table-striped table-condensed">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">Nama Tujuan</th>
                                    <th width="10%">Kode Rek</th>
                                    <th width="5%" style="font-size: 7pt;" >Edit</th>
                                    <!--<th width="5%" style="font-size: 7pt;" >Hapus</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($get_refTujuan as $grj) {
                                    ?>
                                    <tr class="bg-info">
                                        <td class="text-center"
                                            style="font-size: 9pt;"><?= $no ; ?></td>
                                        <td style="font-size: 9pt;"><?= $grj->nama; ?></td>
                                        <td style="font-size: 9pt;"><?= $grj->kode_rekening ?></td>
                                        <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                     data-toggle="modal" 
                                                     data-id="<?= $grj->id; ?>"
                                                     data-nama="<?= $grj->nama; ?>"
                                                     data-rek="<?= $grj->id_rek; ?>"
                                                     data-target="#update_tujuan">
                                                <i class="fa fa-pencil"></i></button>
                                </td>
<!--                                <td>
                                    <button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                    data-toggle="modal"
                                                    data-id="<?= $grj->id; ?>"
                                                    data-nama="<?= $grj->nama; ?>"
                                                    data-target="#delete_tujuan">
                                                <i class="fa fa-trash-o"></i></button>
                                </td>-->
                                <?php
                                $no++;
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

<div class="modal fade" id="tambah" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Refrensi Jabatan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_jabatan_tujuan/insert_jabatan" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Jabatan</label>
                            <input type="text"  class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Nama Jabatan Exp : (Bupati / Wakil Bupati)" required>
                        </div>
                        <div class="form-group col-md-12">
                            <select name='tingkat' id='tingkat' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Tingkat --</option>
                                <option value='A' >A</option>
                                <option value='B' >B</option>
                                <option value='C' >C</option>
                                <option value='D' >D</option>
                            </select> 
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
            <div class="modal-header bg-yellow">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Edit Data Refrensi Jabatan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_jabatan_tujuan/update_jabatan" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Jabatan</label>
                            <input type="text"  class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Nama Jabatan Exp : (Bupati / Wakil Bupati)" required>
                        </div>
                       
                        <div class="form-group col-md-12">
                            <div class="tingkat"></div>
                        </div>
                        
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="id" name="id" >
                </div>
                <div class="modal-footer bg-yellow">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus Data Refrensi Jabatan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_jabatan_tujuan/delete_jabatan" enctype="multipart/form-data">
                <div class="modal-body">
                    <h4 class="alert alert-danger status"></h4>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Jabatan</label>
                            <input type="text" readonly class="form-control" id="nama_jabatan" name="nama_jabatan" placeholder="Nama Jabatan Exp : (Bupati / Wakil Bupati)" required>
                        </div>
                    </div>
                    <note style='font-size: 8pt;'>* Anda Akan Menghapus Nama Ini Pada Kolom Uang Harian mohon untuk di cek kembali !!!</note>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="id" name="id" >
                </div>
                <div class="modal-footer bg-red">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="hapus" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="tambah_tujuan" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Refrensi Jabatan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_jabatan_tujuan/insert_tujuan" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Tujuan</label>
                            <input type="text"  class="form-control" id="nama" name="nama" placeholder="Nama Tujuan Exp : (Luar Negeri)" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Kode Rekening</label>
                            <select name='rek' id='rek' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Kode Rekening--</option>
                                <?php 
                                foreach($get_refRekening as $grr){
                                    ?>
                                <option value='<?= $grr->id ?>' ><?= $grr->kode_rekening.' - '.$grr->jenis_rekening ?></option>
                                <?php } ?>
                            </select> 
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

<div class="modal fade" id="update_tujuan" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Edit Data Refrensi Jabatan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_jabatan_tujuan/update_tujuan" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama</label>
                            <input type="text"  class="form-control" id="nama" name="nama" placeholder="Nama Tujuan Exp : (Luar Negeri)" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Kode Rekening</label>
                            <div class="rek"></div>
                        </div>                       
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="id" name="id" >
                </div>
                <div class="modal-footer bg-yellow">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_tujuan" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus Data Refrensi Jabatan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_jabatan_tujuan/delete_tujuan" enctype="multipart/form-data">
                <div class="modal-body">
                    <h4 class="alert alert-danger status"></h4>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama</label>
                            <input type="text" readonly class="form-control" id="nama" name="nama" >
                        </div>
                    </div>
                    <note style='font-size: 8pt;'>* Anda Akan Menghapus Nama Ini Pada Kolom Uang Harian mohon untuk di cek kembali !!!</note>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="id" name="id" >
                </div>
                <div class="modal-footer bg-red">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="hapus" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#update_tujuan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nama = button.data('nama');
        var rek = button.data('rek');
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/referensi/Ref_jabatan_tujuan/modal_editRefRekening",
            data: {id: rek},
            success: function (data) {
                $('.rek').html(data);
            }
        });
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#nama').val(nama);
        modal.find('.modal-body input#rek').val(rek);
    });


    $('#delete_tujuan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nama = button.data('nama');
        var modal = $(this);
//        $.ajax({
//            dataType: "json",
//            url: "<?php echo base_url(); ?>index.php/admin/referensi/Ref_tujuan/cek_dataUangHarian/" + id,
//            success: function (response) {
//                if (response[0].cek == 0) {
//                    $('.status').html('Apakah Anda Yankin Menghapus Referensi Tujuan ini . . . !');
//                    $('#hapus').removeAttr("disabled", "disabled");
//                } else {
//                    $('.status').html('Data Tidak Bisa Dihapus Karena Data Dipakai pada Uang Harian');
//                    $("#hapus").attr("disabled", "disabled");
//                }
//            }
//        });
        $('.status').html('Apakah Anda Yankin Menghapus Referensi Tujuan ini . . . !!!');
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#nama').val(nama);
    });
</script>
<script>
    $('#update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nm_jbtn = button.data('nm_jbtn');
        var tingkat = button.data('tingkat');
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/referensi/Ref_jabatan_tujuan/modal_editRefJabatan",
            data: {id: id},
            success: function (data) {
                $('.tingkat').html(data);
            }
        });

        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#nama_jabatan').val(nm_jbtn);
        modal.find('.modal-body input#tingkat').val(tingkat);
    });


    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nm_jbtn = button.data('nm_jbtn');
        var modal = $(this);
        $.ajax({
            dataType: "json",
            url: "<?php echo base_url(); ?>index.php/admin/referensi/Ref_jabatan_tujuan/cek_dataJabPgw/" + id,
            success: function (response) {
                if (response[0].cek == 0) {
                    $('.status').html('Apakah Anda Yankin Menghapus Jabatan ini . . . !');
                    $('#hapus').removeAttr("disabled", "disabled");
                } else {
                    $('.status').html('Data Tidak Bisa Dihapus Karena Data Dipakai pada Data Pegawai');
                    $("#hapus").attr("disabled", "disabled");
                }
            }
        });

        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#nama_jabatan').val(nm_jbtn);
    });
</script>