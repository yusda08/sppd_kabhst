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
        <li><a href="#">Data Refrensi Jabatan</a></li>
        <li class="active">Jabatan</li>
    </ol>
</section>
<section class="content">
    <div class="box box-success">
        <div class="box-header with-border">
            <span class="pull-right">
                <button type='button' class='btn btn-primary btn-sm' data-toggle='modal' 
                        data-target='#tambah'><i class='fa fa-plus'></i>&nbsp;Tambah Uang Harian</button>
            </span>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table  class="tabel_3 table table-hover table-bordered table-striped">
                    <thead>
                        <tr class="bg-danger">
                            <th width="5%">No</th>
                            <th width="25%" style="font-size: 8pt; ">Nama Jabatan</th>
                            <?php
                            foreach ($get_refTujuan as $get) {
                                echo"<th style='font-size: 8pt;' width='10%'>" . $get->nama . "</th>";
                            }
                            ?>
                            <th width="5%"><i class="fa fa-expand"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_setUangHarianJoinJabatan as $gsuhjj) {
                            $id_jabatan = $gsuhjj->id_ref_jabatan;
                            $nama_jabatan = $gsuhjj->nama_jabatan;
                            ?>
                            <tr>
                                <td class="text-center"
                                    style="font-size: 9pt;"><?= $no; ?></td>
                                <td style="font-size: 9pt;"><?= $gsuhjj->nama_jabatan; ?></td>
                                <?php
                                $get_setUangHarianWhereJabatan = $this->Data_setting->get_setUangHarianWhereJabatan($id_jabatan);
                                foreach ($get_setUangHarianWhereJabatan as $get) {
                                    
                                            echo"<td style='font-size: 8pt;' class='text-right'>Rp. ".number_format($get->uang_harian,0,',','.')."</td>";
                                    
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
                                                         data-id_jabatan="<?= $id_jabatan; ?>" 
                                                         data-target="#update">
                                                    <i class="fa fa-pencil"></i> Edit</button></li>
                                            <li><button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                        data-toggle="modal"
                                                        data-nama_jabatan="<?= $nama_jabatan; ?>" 
                                                        data-id_jabatan="<?= $id_jabatan; ?>" 
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
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/set_uangHarian/insert_uang_harian" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <select name='jabatan' id='jabatan' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Jabatan --</option>
                                <?php
                                foreach ($get_refJabatan as $grj) {
                                    $id_jabatan = $grj->id;
                                    foreach ($get_setUangHarian as $gsuh) {
                                        if ($id_jabatan == $gsuh->id_ref_jabatan) {
                                            $att = 'disabled';
                                            break;
                                        } else {
                                            $att = '';
                                        }
                                    }
                                    echo"<option $att value='$id_jabatan' data-jabatan='$id_jabatan'>$grj->nama_jabatan</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <?php
                        foreach ($get_refTujuan as $get) {
                            $id_tujuan = $get->id;
                            ?>
                            <div class="form-group col-md-6">
                                <label><?= $get->nama; ?></label>
                                <div class="input-group bg-gray">
                                    <span class="input-group-addon bg-gray">Rp.</span>
                                    <input type = 'number' class = "form-control text-right" name='uangharian[]' value='0' required>
                                    <span class="input-group-addon bg-gray">,00</span>
                                </div>
                                <input type = 'hidden' class = "form-control text-right" name='id_ref_tujuan[]' id='id_ref_tujuan' value='<?= $id_tujuan; ?>' required>
                                <input type = 'hidden' class = "form-control text-right id_ref_jabatan" name='id_ref_jabatan[]'>
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
            <form method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/set_uangHarian/update_uang_harian" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class='editUangHarian'></div>
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
            <form method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/set_uangHarian/delete_uang_harian" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <h4 class="alert alert-danger">Apakah Anda Yanki Menghapus Uang Harian Pada Jabatan ini . . . !!!</h4>
                        </div>
                            <div class="form-group col-md-12">
                                <label>Nama Jabatan</label>
                                <input type = 'text' readonly class = "form-control" name='nama_jabatan' id='nama_jabatan' required>
                                </div>
                        <input type = 'hidden' class = "form-control" name='id_jabatan' id='id_jabatan'>
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
        var id_jabatan = button.data('id_jabatan');
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_uangHarian/modal_editUangHarian/" + id_jabatan,
            success: function (respont) {
                $('.editUangHarian').html(respont);
            }
        });
    });
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id_jabatan = button.data('id_jabatan');
        var nama_jabatan = button.data('nama_jabatan');
        var modal = $(this);
        modal.find('#id_jabatan').val(id_jabatan);
        modal.find('#nama_jabatan').val(nama_jabatan);
    });
</script>