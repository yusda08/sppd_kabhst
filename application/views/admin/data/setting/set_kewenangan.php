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
        <li><a href="#">Setting Kewenangan</a></li>
        <li class="active">Tujuan Persetujuan</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <span class="pull-right">
                        <div class="col-md-12">
                            <button type='button' class='btn btn-primary btn-flat btn-sm btn-block' data-toggle='modal' 
                                    data-target='#tambah_kewenangan'><i class='fa fa-plus'></i>&nbsp;Tambah Kewenangan</button>
                        </div>
                    </span>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table  class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr >
                                    <th width="5%">No</th>
                                    <th>Tujuan Persetujuan</th>
                                    <th>Jam Persetujuan</th>
                                    <th width="5%"><i class="fa fa-cogs"></i></th>
                                    <th width="5%"><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($get_SetKewenanganJoinTtd as $gskjt) {
                                    ?>
                                    <tr class="bg-info">
                                        <td class="text-center"><?= $no; ?></td>
                                        <td class=""><?= $gskjt->nama; ?></td>
                                        <td class="text-center"><?= $gskjt->jam_persetujuan; ?> Jam</td>
                                        <td class="">
                                            <?php $id_kewenangan = isset($_REQUEST['id_kewenangan']) ? $_REQUEST['id_kewenangan'] : ""; ?>
                                            <form action="" method="GET">
                                                <input type="hidden" class="form-control" id="id_kewenangan" name="id_kewenangan" value="<?php echo $gskjt->id; ?>">
                                                <button type="submit" class="small-box-footer btn-xs btn btn-block"> Lihat <i class="fa fa-arrow-circle-right"></i></button>
                                            </form>

                                        </td>
<!--                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                    data-toggle="modal"
                                                    data-id="<?= $gskjt->id; ?>" 
                                                    data-nama="<?= $gskjt->nama; ?>" 
                                                    data-target="#delete_kewenangan" title="Hapus">
                                                <i class="fa fa-trash-o"></i> </button>
                                        </td>-->
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                    data-toggle="modal"
                                                    data-id="<?= $gskjt->id; ?>" 
                                                    data-nama="<?= $gskjt->nama; ?>" 
                                                    data-jam_persetujuan="<?= $gskjt->jam_persetujuan; ?>" 
                                                    data-target="#edit_kewenangan" title="Edit">
                                                <i class="fa fa-pencil-o"></i> Edit</button>
                                        </td>
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
        </div><!-- /.box-body -->

        <?php
        if (isset($_GET['id_kewenangan'])) {
            $get_SetKewenanganDetailWhereIdKewenangan = $this->Data_setting->get_SetKewenanganDetailWhereIdKewenangan($id_kewenangan);
            $get_SetKewenanganJoinTtdWhereId = $this->Data_setting->get_SetKewenanganJoinTtdWhereId($id_kewenangan);
            $id_kewenangan = $_GET['id_kewenangan'];
            foreach ($get_SetKewenanganJoinTtdWhereId as $gskjtwi) {
                $nama = $gskjtwi->nama;
            }
             $cek = $this->Data_setting->count_dataKewenanganId($id_kewenangan);
             foreach ($cek as $row){
                 $cek_data = $row->cek;
             }
            ?>
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <?= $nama; ?>
                        <span class="pull-right">
                            <div class="col-md-12">
                                <button type='button' class='btn btn-warning btn-flat btn-sm btn-block' 
                                        data-toggle='modal' 
                                        data-id_kewenangan='<?= $id_kewenangan; ?>' 
                                        data-target='#tambah_detail'><i class='fa fa-plus'></i>&nbsp;Tambah Detail</button>
                            </div>
                        </span>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table  class=" table table-hover table-bordered table-striped">
                                <thead>
                                    <tr >
                                        <th width="5%">No</th>
                                        <th>Disposisi</th>
                                        <th width="20%">Jam Disposisi</th>
                                        <th width="5%">Urutan </th>
                                        <th width="5%"><i class="fa fa-cogs"></i></th>
                                        <!--<th width="5%"><i class="fa fa-cogs"></i></th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($cek_data > 0){
                                    $no = 1;
                                    foreach ($get_SetKewenanganDetailWhereIdKewenangan as $gskjt) {
                                        ?>
                                        <tr class="bg-warning">
                                            <td class="text-center"><?= $no; ?></td>
                                            <td class=""><?= $gskjt->nama; ?></td>
                                            <td class="text-center"><?= $gskjt->jam_disposisi; ?> JAM</td>
                                            <td class="text-center"><?= $gskjt->urutan; ?></td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                        data-toggle="modal" 
                                                        data-id="<?= $gskjt->id; ?>" 
                                                        data-id_kewenangan="<?= $id_kewenangan; ?>"  
                                                        data-target="#update_detail" title="Edit">
                                                    <i class="fa fa-pencil"></i> Edit</button>
                                            </td>
<!--                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                        data-toggle="modal"
                                                        data-id="<?= $gskjt->id; ?>" 
                                                        data-nama="<?= $gskjt->nama; ?>" 
                                                        data-target="#delete_detail" title="Hapus">
                                                    <i class="fa fa-trash-o"></i></button>
                                            </td>-->
                                        </tr>
                                        <?php
                                        $no++;
                                    }
                                    }else{
                                        echo '<tr>
                                            <td class="text-center" colspan="5"><h5 class="alert alert-danger">Data Kosong</h5></td>
                                        </tr>';
                                    }
                                    ?>
                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        <?php } ?>
    </div><!-- /.box -->          
</section>
<div class="modal fade" id="tambah_detail" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Form Tambah Kewenangan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_kewenangan/insert_kewenangan_detail" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Pendisposisi</label>
                        </div>
                        <div class="form-group col-md-8">
                            <select name='id_ttd' id='id_ttd' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Pendisposisi --</option>
                                <?php
                                foreach ($get_refTtd as $grt) {
                                    $id = $grt->id;
                                    $nama = $grt->nama;
                                    foreach ($get_SetKewenanganDetailWhereIdKewenangan as $row2) {
                                        if ($id == $row2->id_ttd) {
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
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>Urutan</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" name="urutan" required>
                            <input type="hidden" readonly class="form-control" name="id_kewenangan" value="<?= $id_kewenangan; ?>" required>
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
<!--<div class="modal fade" id="delete_detail" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Form Hapus Kewenangan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_kewenangan/delete_kewenangan_detail" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <h4 class="alert alert-danger">Apakah Anda Yakin Menghapus ini . . . !!!</h4>
                            <label>Nama Pendisposisi</label>
                            <input type="nama" class="form-control" id="nama" name="nama" readonly required>
                        </div>
                        <input type="hidden" readonly class="form-control" name="id" id="id" required>
                        <input type="hidden" readonly class="form-control" name="id_kewenangan" value="<?= $id_kewenangan; ?>" required>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                </div>
                <div class="modal-footer bg-red">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>-->
<div class="modal fade" id="update_detail" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Form Update Kewenangan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_kewenangan/update_kewenangan_detail" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="editDetail"></div>
                        <input type="hidden" readonly class="form-control" name="id_kewenangan" value="<?= $id_kewenangan; ?>" required>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                </div>
                <div class="modal-footer bg-yellow">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_detail" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Form Update Kewenangan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_kewenangan/update_kewenangan_detail" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="editDetail"></div>
                        <input type="hidden" readonly class="form-control" name="id" id="id" required>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                </div>
                <div class="modal-footer bg-yellow">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah_kewenangan" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Form Tambah Kewenangan Detail</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_kewenangan/insert_kewenangan" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Persetujuan</label>
                            <select name='id_ttd' id='id_ttd' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Persetujuan --</option>
                                <?php
                                foreach ($get_refTtd as $grt) {
                                    $id = $grt->id;
                                    $nama = $grt->nama;
                                    foreach ($get_SetKewenanganJoinTtd as $row) {
                                        if ($id == $row->id_ttd) {
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
<div class="modal fade" id="edit_kewenangan" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Form Edit Kewenangan Persetujuan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_kewenangan/update_kewenangan" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="alert alert-warning">Form Edit Kewenangan Persetujuan</h5>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" readonly class="form-control" name="nama" id="nama" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Jam Persetujuan</label>
                        </div>
                        <div class="form-group col-md-8">
                            <div class="input-group bg-gray">
                            <input type="text" class="form-control" name="jam_persetujuan" id="jam_persetujuan" required>
                                            <span class="input-group-addon bg-gray">Jam</span>
                                        </div>
                            
                        </div>
                         <input type="hidden" readonly class="form-control" name="id" id="id" required>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                </div>
                <div class="modal-footer bg-red">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="hapus" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete_kewenangan" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Form Hapus Kewenangan Persetujuan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_kewenangan/delete_kewenangan" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="alert alert-danger statusKewenangan"></h5>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Nama</label>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="text" readonly class="form-control" name="nama" id="nama" required>
                            <input type="hidden" readonly class="form-control" name="id" id="id" required>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                </div>
                <div class="modal-footer bg-red">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="hapus" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#update_detail').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var id_kewenangan = button.data('id_kewenangan');
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_kewenangan/modal_editKewenanganDetail/" + id + "/" + id_kewenangan,
            success: function (respont) {
                $('.editDetail').html(respont);
            }
        });
    });

    $('#delete_kewenangan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nama = button.data('nama');
        var modal = $(this);
        $.ajax({
            dataType: "json",
            url: "<?php echo base_url(); ?>index.php/admin/Setting/Set_kewenangan/cek_dataKewenangan/" + id,
            success: function (response) {
                if (response[0].cek == 0) {
                    $('.statusKewenangan').html('Apakah Anda Yankin Menghapus Kewenangan ini . . . !');
                    $('#hapus').removeAttr("disabled", "disabled");
                } else {
                    $('.statusKewenangan').html('Data Tidak Bisa Dihapus Karena Data Dipakai Pada Kewenanga Detail');
                    $("#hapus").attr("disabled", "disabled");
                }
            }
        });
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#nama').val(nama);
    });

    $('#delete_detail').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nama = button.data('nama');
        var modal = $(this);
        modal.find('#nama').val(nama);
        modal.find('#id').val(id);
    });
    $('#edit_kewenangan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nama = button.data('nama');
        var jam_persetujuan = button.data('jam_persetujuan');
        var modal = $(this);
        modal.find('#nama').val(nama);
        modal.find('#jam_persetujuan').val(jam_persetujuan);
        modal.find('#id').val(id);
    });
</script>