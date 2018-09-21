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
        <li><a href="#">Tambah Plafon Pesawat</a></li>
        <!--<li class="active">Data Asisten</li>-->
    </ol>
</section>
<section class="content">

    <div class="box box-success">
        <div class="box-header with-border">
            <div class="col-md-3 col-xs-6">
                <button type='button' class='btn btn-primary btn-flat btn-sm btn-block' data-toggle='modal' 
                        data-target='#tambah'><i class='fa fa-plus'></i>&nbsp;Tambah Plafon Pesawat</button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table  class="tabel_1 table table-hover table-bordered table-striped">
                    <thead>
                        <tr >
                            <th width="5%">No</th>
                            <th width="20%">Kota</th>
                            <th width="10%">Kelas Bisnis</th>
                            <th width=10%">Kelas Ekonomi</th>
                            <th width="5%">Keterangan</th>
                            <th width="5%"><i class="fa fa-cogs"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_plafonPesawat as $gps) {
                            ?>
                            <tr class="bg-info">
                                <td class="text-center"><?= $no; ?></td>
                                <td class="text-center"><?= $gps->kota_asal . ' - ' . $gps->kota_tujuan; ?></td>
                                <td >Rp <?= number_format($gps->bisnis) ?></td>
                                <td >Rp <?= number_format($gps->ekonomi); ?></td>
                                <td ><?= $gps->ket; ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-cogs"></i> <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li> <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                         data-toggle="modal" 
                                                         data-id="<?= $gps->id; ?>" 
                                                         data-asal="<?= $gps->kota_asal; ?>" 
                                                         data-tujuan="<?= $gps->kota_tujuan; ?>" 
                                                         data-bisnis="<?= $gps->bisnis; ?>" 
                                                         data-ekonomi="<?= $gps->ekonomi; ?>" 
                                                         data-ket="<?= $gps->ket; ?>" 
                                                         data-target="#update">
                                                    <i class="fa fa-pencil"></i> Edit</button></li>
                                            <li><button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                        data-toggle="modal"
                                                        data-id="<?= $gps->id; ?>" 
                                                        data-asal="<?= $gps->kota_asal; ?>" 
                                                        data-tujuan="<?= $gps->kota_tujuan; ?>" 
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
    </div><!-- /.box -->          
</section>

<div class="modal fade" id="tambah" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>Form Tambah Plafon</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_plafon_pesawat/insert_plafon" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label>Kota Asal</label>
                            <input type="text" class="form-control" id="asal" name="asal" required placeholder="Asal ex : Banjarmasin">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Kota Tujuan</label>
                            <input type="text" class="form-control" id="tujuan" name="tujuan" required placeholder="Tujuan ex : Surabaya">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kelas Bisnis</label>
                            <input type="number" class="form-control" id="bisnis" name="bisnis" required placeholder="Ex : 700000">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kelas Ekonomi</label>
                            <input type="number" class="form-control" id="ekonomi" name="ekonomi" required placeholder="Ex : 500000">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Keterangan</label>
                            <textarea  class="form-control" id="ket" name="ket" placeholder="Keterangan"></textarea>
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
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Edit Plafon</h4>
            </div>
            <form id="form_update" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_plafon_pesawat/update_plafon" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label>Kota Asal</label>
                            <input type="text" class="form-control" id="asal" name="asal" required placeholder="Asal ex : Banjarmasin">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Kota Tujuan</label>
                            <input type="text" class="form-control" id="tujuan" name="tujuan" required placeholder="Tujuan ex : Surabaya">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kelas Bisnis</label>
                            <input type="number" class="form-control" id="bisnis" name="bisnis" required placeholder="Ex : 700000">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Kelas Ekonomi</label>
                            <input type="number" class="form-control" id="ekonomi" name="ekonomi" required placeholder="Ex : 500000">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Keterangan</label>
                            <textarea  class="form-control" id="ket" name="ket" placeholder="Keterangan"></textarea>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="id" name="id" >
                </div>
                <div class="modal-footer bg-yellow-gradient">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="upd" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-red-gradient">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Hapus Plafon</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_plafon_pesawat/hapus_plafon" enctype="multipart/form-data">
                <div class="modal-body">
                    <h3 class='alert bg-gray'>Anda akan menghapus Setting Plafon Pesawat ini, lanjutkan?</h3>
                    <div class="row">
                        <div class="col-md-12">       
                            <label for="nama_program">Kota Asal</label>
                            <input type="text" class="form-control" id="asal" name="asal" readonly="">
                        </div>
                        <div class="col-md-12">       
                            <label for="nama_program">Kota Tujuan</label>
                            <input type="text" class="form-control" id="tujuan" name="tujuan" readonly="">
                        </div>
                    </div>

                    <input type="hidden" class="form-control" id="id" name="id" >
                    <input type="hidden" class="form-control" id="url" name="url" value="<?php echo $url; ?>">

                </div>
                <div class="modal-footer bg-red">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn bg-orange" data-loading-text="Loading..." autocomplete="off">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var asal = button.data('asal');
        var tujuan = button.data('tujuan');
        var bisnis = button.data('bisnis');
        var ekonomi = button.data('ekonomi');
        var ket = button.data('ket');
        var modal = $(this);
        
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#asal').val(asal);
        modal.find('.modal-body input#tujuan').val(tujuan);
        modal.find('.modal-body input#bisnis').val(bisnis);
        modal.find('.modal-body input#ekonomi').val(ekonomi);
        modal.find('.modal-body textarea#ket').val(ket);
        
    });
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var asal = button.data('asal');
        var tujuan = button.data('tujuan');
        var modal = $(this);
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#asal').val(asal);
        modal.find('.modal-body input#tujuan').val(tujuan);
        
    });

    $('#tamabhSkpd').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_asistenSkpd/modal_tambahSkpdAsisten/" + id,
            success: function (respont) {
                $('.tamabhSkpdAsisten').html(respont);
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