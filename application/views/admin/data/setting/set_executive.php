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
        <li><a href="#">Setting Executive</a></li>
        <li class="active">Data Executive</li>
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
                        data-target='#tambah'><i class='fa fa-plus'></i>&nbsp;Tambah Executive</button>

                <?php // } ?>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table  class="tabel_1 table table-hover table-bordered table-striped">
                    <thead>
                        <tr >
                            <th width="5%">No</th>
                            <th >Nama</th>
                            <th >Jabatan</th>
                            <th>Email</th>
                            <th>Bank</th>
                            <th>No Rekening</th>
                            <th width="5%"><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_SetExecutiveJoinBank as $gsa) {
                            ?>
                            <tr class="bg-info">
                                <td class="text-center"><?= $no; ?></td>
                                <td ><?= $gsa->nama; ?></td>
                                <td ><?= $gsa->nama_jabatan; ?></td>
                                <td class="text-center"><?= $gsa->email; ?></td>
                                <td class="text-center"><?= $gsa->kode. " -- ".$gsa->nama_bank ; ?></td>
                                <td class="text-center"><?= $gsa->no_rekening; ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                         data-toggle="modal" 
                                                         data-id="<?= $gsa->id; ?>" 
                                                         data-target="#update">
                                                    <i class="fa fa-pencil"></i> Edit</button>
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
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Tambah Executiv</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_executive/insert_executive" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Executive</label>
                            <select name='id_executive' id='id_executive' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Jabatan Executive --</option>
                                <?php
                                foreach ($get_ref_executive as $gra) {
                                    $id = $gra->id;
                                    $nama = $gra->nama;
                                    foreach ($get_SetExecutiveJoinBank as $gsa) {
                                        if($id == $gsa->id){
                                            $att = "disabled";
                                            break;
                                        }else{
                                            $att = "";
                                        }
                                    }
                                    echo"<option ".$att." value='" . $id . "'>" . $nama . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                            <div class="form-group col-md-12">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" id='nama' required>
                            </div>
                        <div class="form-group col-md-12">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nama Bank</label>
                            <select name='id_bank' id='id_bank' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Bank --</option>
                                <?php
                                foreach ($get_refbank as $grb) {
                                    $id = $grb->id;
                                    $nama = $grb->nama_bank;
                                    $kode = $grb->kode;
                                    echo"<option value='" . $id . "'>".$kode. " - " . $nama . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nomor Rekening</label>
                            <input type="text" class="form-control" id="no_rekening" name="no_rekening" required>
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
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Edit Executive</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_executive/update_executive" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="editExecutif"></div>
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

<script>
    $('#update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_executive/modal_editExecutive/" + id,
            success: function (respont) {
                $('.editExecutif').html(respont);
            }
        });
    });

</script>