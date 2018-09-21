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
        <li><a href="#">Data Referensi Provinsi</a></li>
        <!--<li class="active">Jabatan dan Tujuan</li>-->
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border bg-success">
                    Tabel Referinsi Provinsi
                    <span class="pull-right">
                        <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' 
                                data-target='#tambah'><i class='fa fa-plus'></i>&nbsp;Tambah Ref Provinsi</button>
                    </span>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table  class="tabel_3 table table-hover table-bordered table-striped">
                            <thead>
                                <tr >
                                    <th width="5%">No</th>
                                    <th width="25%">Nama Provinsi</th>
                                    <th width="5%" style="font-size: 8pt;" >Edit</th>
                                    <th width="5%" style="font-size: 8pt; ">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($get_refProv as $grp) {
                                    ?>
                                <tr class="bg-success">
                                        <td class="text-center"
                                            style="font-size: 9pt;"><?= $no; ?></td>
                                        <td style="font-size: 9pt;"><?= $grp->nama; ?></td>
                                        <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                     data-toggle="modal" 
                                                     data-id="<?= $grp->id; ?>"
                                                     data-nama="<?= $grp->nama; ?>"
                                                     data-target="#update">
                                                <i class="fa fa-pencil"></i></button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                    data-toggle="modal"
                                                    data-id="<?= $grp->id; ?>"
                                                    data-nama="<?= $grp->nama; ?>"
                                                    data-target="#delete">
                                                <i class="fa fa-trash-o"></i></button>
                                </td>
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
                <div class="box-header with-border bg-success">
                    Tabel Referinsi Alat Angkut
                    <span class="pull-right">
                        <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' 
                                data-target='#tambahalat'><i class='fa fa-plus'></i>&nbsp;Tambah Ref Alat Angkut</button>
                    </span>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table  class="tabel_3 table table-hover table-bordered table-striped">
                            <thead>
                                <tr >
                                    <th width="5%">No</th>
                                    <th width="25%">Nama Alat Angkut</th>
                                    <th width="20%">Biaya</th>
                                    <th width="5%" style="font-size: 8pt;" >Edit</th>
                                    <th width="5%" style="font-size: 8pt; ">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($get_refAlatangkut as $gra) {
                                    ?>
                                <tr class="bg-success">
                                        <td class="text-center"
                                            style="font-size: 9pt;"><?= $no; ?></td>
                                        <td style="font-size: 9pt;"><?= $gra->alat_angkut; ?></td>
                                        <td style="font-size: 9pt;">Rp <?= number_format($gra->biaya); ?></td>
                                        <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                     data-toggle="modal" 
                                                     data-id="<?= $gra->id; ?>"
                                                     data-alat="<?= $gra->alat_angkut; ?>"
                                                     data-biaya="<?= $gra->biaya; ?>"
                                                     data-target="#updatealat">
                                                <i class="fa fa-pencil"></i></button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                    data-toggle="modal"
                                                    data-id="<?= $gra->id; ?>"
                                                    data-alat="<?= $gra->alat_angkut; ?>"
                                                    data-target="#deletealat">
                                                <i class="fa fa-trash-o"></i></button>
                                </td>
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
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Refrensi Provinsi</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_provinsi/insert_provinsi" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Provinsi</label>
                            <input type="text"  class="form-control" id="nama" name="nama" placeholder="provinsi" required>
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
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_provinsi/update_provinsi" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Provinsi</label>
                            <input type="text"  class="form-control" id="nama" name="nama" placeholder="Nama Provinsi" required>
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
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus Data Refrensi Provinsi</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_provinsi/delete_provinsi" enctype="multipart/form-data">
                <div class="modal-body">
                    <h4 class="alert alert-danger status"></h4>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Provinsi</label>
                            <input type="text" readonly class="form-control" id="nama" name="nama" placeholder="Nama Provinsi" required>
                        </div>
                    </div>
                    <!--<note style='font-size: 8pt;'>* Anda Akan Menghapus Nama Ini Pada Kolom Uang Harian mohon untuk di cek kembali !!!</note>-->
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

<div class="modal fade" id="tambahalat" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Refrensi Alat Angkut</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_provinsi/insert_alat" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Alat Angkut</label>
                            <input type="text"  class="form-control" id="alat" name="alat" placeholder="alat" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Biaya yang diberikan</label>
                            <input type="number"  class="form-control" id="biaya" name="biaya" placeholder="biaya" required>
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

<div class="modal fade" id="updatealat" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Edit Data Refrensi Alat Angkut</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_provinsi/update_alat" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Alat Angkut</label>
                            <input type="text"  class="form-control" id="alat" name="alat" placeholder="alat" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Biaya yang diberikan</label>
                            <input type="number"  class="form-control" id="biaya" name="biaya" placeholder="biaya" required>
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
<div class="modal fade" id="deletealat" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus Refrensi Alat Angkutan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_provinsi/delete_alat" enctype="multipart/form-data">
                <div class="modal-body">
                    <h4 class="alert alert-danger status">Apakah anda yakin menghapus alat angkutan ini ?</h4>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Alat Angkut</label>
                            <input type="text" readonly class="form-control" id="alat" name="alat" placeholder="" required>
                        </div>
                    </div>
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
    $('#update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nama = button.data('nama'); 
        var modal = $(this);
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#nama').val(nama);
    });
    $('#updatealat').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var alat = button.data('alat'); 
        var biaya = button.data('biaya'); 
        var modal = $(this);
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#alat').val(alat);
        modal.find('.modal-body input#biaya').val(biaya);
    });


    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nama = button.data('nama');
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
        modal.find('.modal-body input#nama').val(nama);
    });
    
    $('#deletealat').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var alat = button.data('alat');
        var modal = $(this);

        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#alat').val(alat);
    });
</script>