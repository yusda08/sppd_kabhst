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
        <li><a href="#">Setting Sekda</a></li>
        <li class="active">Data Sekda</li>
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
                        data-target='#tambah'><i class='fa fa-plus'></i>&nbsp;Ganti Sekda</button>

                <?php // } ?>
            </div>
        </div>
        <div>
            <?php foreach ($get_sekda as $sekda) { ?>
                <div class="row">
                    <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Nama</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value='<?= $sekda->nama ?>' disabled="">
                            </div>
                        </div>
                        </div>
             <div class="row">
                    <div class="col-md-12">
                            <div class="col-md-3">
                                <label>Nip / Nik</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" value='<?= $sekda->nip_nik ?>' disabled="">
                            </div>
                        </div>
                        </div>
             <div class="row">
                    <div class="col-md-12">
                            <div class="col-md-3">
                                <label> Email</label>
                            </div>
                            <div class="col-md-4" >
                                <input type="text" class="form-control" value='<?= $sekda->email ?>' disabled="">
                            </div>
                    </div>
                </div>
            <?php } ?>
        </div><!-- /.box-header -->
        <div class="box-body">

        </div><!-- /.box-body -->
    </div><!-- /.box -->          
</section>

<div class="modal fade" id="tambah" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Form Merubah Sekda</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_sekda/update_sekda" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                        </div>


                        <div class="form-group col-md-12">
                            <label>Nama Pegawai</label>
                            <select class="btn btn-default select2 pegawai" style="width: 100%">
                                <option value=''> Pilih Pegawai</option>
                                <?php
                                foreach ($get_dataPegawai as $gdp) {
                                    if ($gdp->status_pegawai == 'pns') {
                                        if ($gdp->nip_nik == $sekda->nip_nik) {
                                            echo"<option  value='" . $gdp->nip_nik . "'"
                                            . "data-nip='" . $gdp->nip_nik . "'"
                                            . " data-jabatan='" . $gdp->jabatan . "' selected>" . $gdp->nama . "</option>";
                                        } else {
                                            echo"<option  value='" . $gdp->nip_nik . "'"
                                            . "data-nip='" . $gdp->nip_nik . "'"
                                            . " data-jabatan='" . $gdp->jabatan . "'>" . $gdp->nama . "</option>";
                                        }
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group col-md-12">
                            <label>NIP</label>
                            <input type="text" readonly class="form-control nip" name="nip" required value='<?= $sekda->nip_nik ?>'>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Alamat Email</label>
                            <input type="email" class="form-control" id="email" name="email" required value='<?= $sekda->email ?>'>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="id" name="id" value='<?= $sekda->id ?>' placeholder="">
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
    $('.pegawai').on('change', function () {
        $(".hidden").removeClass('hidden');
        var nip = $(".pegawai option:selected").data('nip');
        $(".nip").val(nip);
    });
</script>