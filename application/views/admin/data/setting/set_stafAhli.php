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
        <li><a href="#">Setting Staf Ahli</a></li>
        <li class="active">Data Staf Ahli</li>
    </ol>
</section>
<section class="content">

    <div class="box box-success">
        <div class="box-header with-border">
            <div class="col-md-3 col-xs-6">
                <button type='button' class='btn btn-primary btn-flat btn-sm btn-block' data-toggle='modal' 
                        data-target='#tambah'><i class='fa fa-plus'></i>&nbsp;Tambah Staf Ahli</button>

            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table  class="tabel_1 table table-hover table-bordered table-striped">
                    <thead>
                        <tr >
                            <th width="5%">No</th>
                            <th width="25%">Nama<br>NIP</th>
                            <th width=30%">Jabatan</th>
                            <th>Email</th>
                            <th width="5%"><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_setStafAhli as $gsa) {
                            ?>
                            <tr class="bg-info">
                                <td class="text-center"><?= $no; ?></td>
                                <td ><?= $gsa->nama . "<br> NIP. " . $gsa->nip_nik; ?></td>
                                <td ><?= ucwords(strtolower($gsa->jabatan)); ?></td>
                                <td ><?= $gsa->email; ?></td>
                                <td >
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
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Tambah Staf Ahli</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_stafAhli/insert_stafAhli" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
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
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Edit Staf Ahli</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_stafAhli/update_stafAhli" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="editStafAhli"></div>
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
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_stafAhli/modal_editStafAhli/" + id,
            success: function (respont) {
                $('.editStafAhli').html(respont);
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