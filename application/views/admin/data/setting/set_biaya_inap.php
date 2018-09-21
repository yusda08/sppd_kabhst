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
        <li><a href="#">Data Refrensi </a></li>
        <li class="active">Jabatan</li>
    </ol>
</section>
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <span class="pull-right">
                <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' 
                        data-target='#tambah'><i class='fa fa-plus'></i>&nbsp;Tambah Biaya Inap</button>
            </span>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table  class="tabel_3 table table-hover table-bordered table-striped">
                    <thead>
                        <tr class="bg-danger">
                            <th width="5%">No</th>
                            <th width="15%" style="font-size: 8pt; ">Nama Provinsi</th>
                            <?php
                            foreach ($get_refJabatan as $get) {
                                echo"<th style='font-size: 8pt;' width='10%'>" . $get->nama_jabatan . "</th>";
                            }
                            ?>
                            <th width="5%"><i class="fa fa-expand"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_refProvinsiJoinPenginapan as $grp) {
                            $id_provinsi = $grp->id;
                            $nama_provinsi = $grp->nama;
                            ?>
                            <tr>
                                <td class="text-center"
                                    style="font-size: 9pt;"><?= $no; ?></td>
                                <td style="font-size: 9pt;"><?= $nama_provinsi ?></td>
                                <?php
                                $get_setbiayaInapWhereProv = $this->Data_setting->get_setbiayaInapWhereProv($id_provinsi);
                                foreach ($get_setbiayaInapWhereProv as $get) {
                                    
                                            echo"<td style='font-size: 8pt;' class='text-right'>Rp. ".number_format($get->biaya,0,',','.')."</td>";
                                    
                                }
                                ?>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-cogs"></i> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li> <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                         data-toggle="modal" 
                                                         data-id_provinsi="<?= $id_provinsi; ?>" 
                                                         data-target="#update">
                                                    <i class="fa fa-pencil"></i> Edit</button></li>
                                            <li><button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                        data-toggle="modal"
                                                        data-nama_provinsi="<?= $nama_provinsi; ?>" 
                                                        data-id_provinsi="<?= $id_provinsi; ?>" 
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
    </div>    
</section>

<div class="modal fade" id="tambah" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Uang Harian</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/set_biayaInap/insert_biayaInap" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <select name='id_provinsi' id='id_provinsi' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Provinsi --</option>
                                <?php
                                foreach ($get_refProvinsi as $grj) {
                                    $id_provinsi = $grj->id;
                                    foreach ($get_refProvinsiJoinPenginapan as $gsuh) {
                                        if ($id_provinsi == $gsuh->id) {
                                            $att = 'disabled';
                                            break;
                                        } else {
                                            $att = '';
                                        }
                                    }
                                    echo"<option $att value='$id_provinsi'>$grj->nama</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <?php
                        foreach ($get_refJabatan as $get) {
                            $id_jabatan = $get->id;
                            ?>
                            <div class="form-group col-md-6">
                                <label><?= $get->nama_jabatan; ?></label>
                                <div class="input-group bg-gray">
                                    <span class="input-group-addon bg-gray">Rp.</span>
                                    <input type = 'number' class = "form-control text-right" name='biaya[]' value='0' required>
                                    <span class="input-group-addon bg-gray">,00</span>
                                </div>
                                <input type = 'hidden' class = "form-control text-right" name='id_jabatan[]' id='id_jabatan' value='<?= $id_jabatan; ?>' required>
                                <!--<input type = 'hidden' class = "form-control text-right id_provinsi" name='id_provinsi[]' value="<?= $id_provinsi ?>">-->
                            </div>
                        <?php } ?>

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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Edit Uang Harian</h4>
            </div>
            <form method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/set_biayaInap/update_biaya_inap" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class='editBiayaInap'></div>
                        </div>
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
<div class="modal fade" id="delete" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Hapus Uang Harian</h4>
            </div>
            <form method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/set_biayaInap/delete_biaya_inap" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <h4 class="alert alert-danger">Apakah Anda Yakin Menghapus Biaya Inap pada provinsi ini . . . !!!</h4>
                        </div>
                            <div class="form-group col-md-12">
                                <label>Nama Provinsi</label>
                                <input type = 'text' readonly class = "form-control" name='nama_provinsi' id='nama_provinsi' required>
                                </div>
                        <input type = 'hidden' class = "form-control" name='id_provinsi' id='id_provinsi'>
                            </div>
                        </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                <div class="modal-footer bg-red">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
</div>
</div>
<script>
    $("#jabatan").change(function () {
        var id_jabatan = $("#jabatan").find('option:selected').data('jabatan');
//        alert(id_jabatan);
        $('.id_ref_jabatan').val(id_jabatan);
    });
        
    $('#update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id_provinsi= button.data('id_provinsi');
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_biayaInap/modal_editBiayaInap/" + id_provinsi,
            success: function (respont) {
                $('.editBiayaInap').html(respont);
            }
        });
    });
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id_provinsi = button.data('id_provinsi');
        var nama_provinsi = button.data('nama_provinsi');
        var modal = $(this);
        modal.find('#id_provinsi').val(id_provinsi);
        modal.find('#nama_provinsi').val(nama_provinsi);
    });
</script>