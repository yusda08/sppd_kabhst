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
        <li><a href="#">Data Refrensi Executive Dan Asisten</a></li>
        <li class="active">Executive dan Asisten</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border bg-warning">
                    Tabel Executive
                    <span class="pull-right">
                        <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' 
                                data-target='#tambah'><i class='fa fa-plus'></i>&nbsp;Tambah Ref Executive</button>
                    </span>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table  class="tabel_3 table table-hover table-bordered table-striped">
                            <thead>
                                <tr >
                                    <th width="5%">No</th>
                                    <th width="50%">Nama Executive</th>
                                    <th width="5%" style="font-size: 7pt;" >Edit</th>
                                    <!--<th width="5%" style="font-size: 7pt;" >Hapus</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($get_ref_executive as $gre) {
                                    ?>
                                <tr class="bg-warning">
                                        <td class="text-center"><?= $no; ?></td>
                                        <td class=""><?= $gre->nama; ?></td>
                                        <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                        data-toggle="modal" 
                                                        data-id="<?= $gre->id; ?>"
                                                        data-nama="<?= $gre->nama; ?>"
                                                        data-target="#update" title="edit">
                                                    <i class="fa fa-pencil"></i></button>
                                        </td>
<!--                                        <td>
                                                                                            <button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                        data-toggle="modal"
                                                        data-id="<?= $gre->id; ?>"
                                                        data-nama="<?= $gre->nama; ?>"
                                                        data-target="#delete" title="hapus">
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
                    Tabel Asisten
                    <span class="pull-right">
                        <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' 
                                data-target='#tambah_asisten'><i class='fa fa-plus'></i>&nbsp;Tambah Ref Asisten</button>
                    </span>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table  class="tabel_3 table table-hover table-bordered table-striped">
                            <thead>
                                <tr >
                                    <th width="5%">No</th>
                                    <th width="">Nama Asisten</th>
                                    <!--<th width="5%"><i class="fa fa-free-code-camp"></i></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($get_refAsisten as $gra) {
                                    $id = $gra->id;
                                    $nama = $gra->nama;
                                    ?>
                                <tr class="bg-info">
                                        <td class="text-center"><?= $no; ?></td>
                                        <td ><?= $nama; ?></td>
<!--                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                    data-toggle="modal"
                                                    data-id="<?= $id; ?>" 
                                                    data-nama="<?= $nama; ?>"
                                                    data-target="#delete_asisten" title="hapus">
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
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Refrensi Executive</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_executive_asisten/insert_executive" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Executive</label>
                            <input type="text"  class="form-control" id="nama" name="nama" placeholder="Nama Executive Exp : (Bupati / Wakil Bupati)" required>
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
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Edit Refrensi Executive</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_executive_asisten/update_executive" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama</label>
                            <input type="text"  class="form-control" id="nama" name="nama" placeholder="Nama / Executive Exp : (Bupati / Wakil Bupati)" required>
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
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus Refrensi Executive</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_executive_asisten/delete_executive" enctype="multipart/form-data">
                <div class="modal-body">
                    <h4 class="alert alert-danger status"></h4>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama</label>
                            <input type="text" readonly class="form-control" id="nama" name="nama" placeholder="Nama Executive Exp : (Bupati / Wakil Bupati)" required>
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


<div class="modal fade" id="tambah_asisten" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Refrensi Asisten</h4>
            </div>
            <form id="form_tambah" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_executive_asisten/insert_asisten" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Asisten</label>
                            <?php
                            foreach ($count_refAsisten as $cra) {
                                $count = $cra->countId;
                            }
                            ?>
                            <input type="text"  class="form-control" id="nama" readonly name="nama" value="Asisten <?= $count + 1; ?> " required>
                            <input type="hidden"  class="form-control" id="id" readonly name="id" value="as<?= $count + 1; ?> " required>

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
<div class="modal fade" id="delete_asisten" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Refrensi Asisten</h4>
            </div>
            <form id="form_tambah" method="POST" action="<?php echo base_url(); ?>index.php/admin/referensi/Ref_executive_asisten/delete_asisten" enctype="multipart/form-data">
                <div class="modal-body">

                    <div class="row">
                        <div class="form-group col-md-12">
                            <h4 class="alert alert-danger status"></h4>
                            <label>Nama Asisten</label>
                            <input type="text"  class="form-control" id="nama" readonly name="nama" required>
                            <input type="hidden"  class="form-control" id="id" readonly name="id" required>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                </div>
                <div class="modal-footer bg-red">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="hapus_asisten" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    //aksi asisten
    $('#delete_asisten').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nama = button.data('nama');
//        alert(id);
        var modal = $(this);
        $.ajax({
            dataType: "json",
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_asisten/cek_dataAsisten/"+id,
            success: function (response) {
                if (response[0].cek == 0) {
                    $('.status').html('Apakah Anda Yankin Menghapus Referensi Executive ini . . . !');
                    $('#hapus_asisten').removeAttr("disabled", "disabled");
                } else {
                    $('.status').html('Data Tidak Bisa Dihapus Karena Data Dipakai pada Data Pegawai');
                    $("#hapus_asisten").attr("disabled", "disabled");
                }
            }
        });
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#nama').val(nama);
    });
    
    
    //aksi executive
    $('#update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nama = button.data('nama');
        var modal = $(this);
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#nama').val(nama);
    });
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nama = button.data('nama');
        var modal = $(this);
//                    $.ajax({
//                        dataType: "json",
//                        url: "<?php echo base_url(); ?>index.php/admin/referensi/Ref_jabatan/cek_dataJabPgw/" + id,
//                        success: function (response) {
//                            if (response[0].cek == 0) {
        $('.status').html('Apakah Anda Yankin Menghapus Referensi Executive ini . . . !');
//                                $('#hapus').removeAttr("disabled", "disabled");
//                            } else {
//                                $('.status').html('Data Tidak Bisa Dihapus Karena Data Dipakai pada Data Pegawai');
//                                $("#hapus").attr("disabled", "disabled");
//                            }
//                        }
//                    });

        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#nama').val(nama);
    });
</script>