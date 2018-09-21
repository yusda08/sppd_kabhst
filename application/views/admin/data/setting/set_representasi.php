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
        <li><a href="#">Setting Uang Represintasi</a></li>
        <li class="active">Data Uang Represintasi</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="col-md-12">
                <button type='button' class='btn btn-primary btn-flat btn-sm btn-block' data-toggle='modal' 
                        data-target='#tambah'><i class='fa fa-plus'></i>&nbsp;Tambah Uang Representasi</button>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table  class="tabel_2 table table-hover table-bordered table-striped">
                    <thead>
                        <tr >
                            <th width="5%">No</th>
                            <th >Nama Jabatan</th>
                            <th colspan="2" width='20%'>Uang Representasi</th>
                            <th width="5%"><i class="fa fa-expand"></i></th>
                            <th width="5%"><i class="fa fa-expand"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_representasi as $gr) {
                            ?>
                            <tr class="bg-info">
                                <td class="text-center"><?= $no; ?></td>
                                <td class=""><?= $gr->nama_jabatan; ?></td>
                                <td class="">Rp.</td>
                                <td class="text-right"><?= number_format($gr->uang_harian,2,',','.'); ?></td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                         data-toggle="modal" 
                                                         data-id="<?= $gr->id; ?>"
                                                         data-nama="<?= $gr->nama_jabatan; ?>"
                                                         data-uang="<?= $gr->uang_harian; ?>"
                                                         data-target="#update" title="Edit"><i class="fa fa-pencil   "></i>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                        data-toggle="modal"
                                                        data-id="<?= $gr->id; ?>"
                                                        data-nama="<?= $gr->nama_jabatan; ?>"
                                                        data-uang="<?= $gr->uang_harian; ?>"
                                                        data-target="#hapus" title="Hapus">
                                                    <i class="fa fa-trash-o"></i></button>
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
    </div><!-- /.box -->          
</section>

<div class="modal fade" id="tambah" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Refrensi Executive</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_representasi/insert_representasi" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Piliih Jabatan</label>
                            <select class="form-control select2" id='jab' name='jab' style="width: 100%;" required>
                                <option >-- Pilih Jabatan --</option>
                                <?php
                                foreach ($get_jabatan as $jab) {
                                    $att = '';
                                    foreach ($get_representasi as $gr) {
                                        if ($jab->id == $gr->id_jabatan or $jab->representasi==0) {
                                            $att = 'disabled';
                                            break;
                                        } else {
                                            $att = '';
                                        }
                                    }
                                    ?>
                                    <option <?= $att ?> value='<?= $jab->id; ?>' ><?= $jab->nama_jabatan; ?></option>
                                <?php }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Uang Harian Representasi</label>
                            <input type="number"  class="form-control" id="uang" name="uang" placeholder="Uang Ex : 100000" required>
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

<div class="modal fade" id="hapus" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><i class="fa fa-shopping-cart"></i> Delete Username</h4>
            </div>
            <form id="tambah_urusan" action="<?php echo base_url(); ?>index.php/admin/setting/Set_representasi/hapus_representasi" method="POST">
                <div class="modal-body">
                    <h3 class='alert bg-gray'>Anda akan menghapus Jabatan Representasi ini, lanjutkan?</h3>
                    <div class="row">
                        <div class="col-md-12">       
                            <label for="nama_program">Nama Jabatan</label>
                            <input type="text" class="form-control" id="nama" name="nama" disabled>
                        </div>
                        <div class="col-md-12">       
                            <label for="nama_program">Uang Harian</label>
                            <input type="text" class="form-control" id="uang" name="uang" disabled>
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

<div class="modal fade" id="update" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Refrensi Executive</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_representasi/update_representasi" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Jabatan</label>
                            <input type="text"  class="form-control" id="nama" name="nama" readonly="">
                        
                        </div>
                        <div class="form-group col-md-12">
                            <label>Uang Harian Representasi</label>
                            <input type="number"  class="form-control" id="uang" name="uang" placeholder="Uang Ex : 100000" required>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="id" name="id" placeholder="">
                </div>
                <div class="modal-footer bg-blue">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#hapus').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')
        var nama = button.data('nama');
        var uang = button.data('uang');
        var modal = $(this)
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#nama').val(nama);
        modal.find('.modal-body input#uang').val(uang);
    });
    
    $('#update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')
        var nama = button.data('nama');
        var uang = button.data('uang');
        var modal = $(this)
        modal.find('.modal-body input#id').val(id);
        modal.find('.modal-body input#nama').val(nama);
        modal.find('.modal-body input#uang').val(uang);
    });

</script>