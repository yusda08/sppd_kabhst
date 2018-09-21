<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
foreach ($get_SetAsistenWhereId as $gsawi){
 $nm_as =    $gsawi->nm_as;
}
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
    <h1><?php echo strtoupper($page_name); ?><br>
        <small><?= $nm_as; ?></small></h1>
    <ol class="breadcrumb ">
        <li><a href="#">Data Asisten Skpd</a></li>
        <li class="active">Data SKPD</li>
    </ol>
</section>
<section class="content">

    <div class="box box-success">
        <div class="box-header with-border">
            <div class="col-md-3 col-xs-6">
                <button type="button" class="btn btn-primary btn-sm btn-block btn-flat" 
                        data-toggle="modal" 
                        data-id="<?= $id_asisten; ?>" 
                        data-target="#tamabhSkpd">
                    <i class="fa fa-plus"></i> Urusan / Sub Bidang Urusan</button>
            </div><!-- /.box-header -->
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table class="tabel_3 table table-hover table-bordered table-striped" width="100%">
                    <thead >
                        <tr>
                            <th style="width: 10px;">No</th>
                             <th >Nama Urusan / Sub Bidang Urusan</th>
                            <th width="5%"><i class="fa fa-free-code-camp"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_SetAsistenSkpdWhereAsisten as $gsaswa) {
                            $nama_urusan = $gsaswa->nama_urusan;
                    
                           
                                    ?>
                        <tr class="bg-danger">
                                        <td class="text-center"><?= $no; ?></td>
                                        <td class=""><?= $nama_urusan; ?></td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                    data-toggle="modal"
                                                    data-id="<?= $gsaswa->id; ?>" 
                                                    data-nama_urusan="<?= $gsaswa->nama_urusan; ?>" 
                                                          data-target="#delete" title="hapus">
                                                <i class="fa fa-trash-o"></i></button></td>
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
<div class="modal fade" id="tamabhSkpd" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue-gradient">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Tambah SKPD Asisten</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_asistenSkpd/insert_skpdAsisten" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type='text' class="form-control" name="nama_urusan">
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="id_asisten" value='<?= $id_asisten; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                </div>
                <div class="modal-footer bg-blue-gradient">
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
            <div class="modal-header bg-red-gradient">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Hapus SKPD Asisten</h4>
            </div>
            <form id="form_tambah"  method="POST" action="<?php echo base_url(); ?>index.php/admin/setting/Set_asistenSkpd/delete_asistenSkpd" enctype="multipart/form-data">
                <div class="modal-body">
                    <h4 class="alert alert-danger">Apakah Anda Yakin Menghapus ini . . . !!</h4>
                    <div class="row">
                             <div class="form-group col-md-12">
                            <label>Nama Urusan</label>
                            <input type="text"  class="form-control" id="nama_urusan" name="nama_urusan" readonly>
                            <input type="hidden"  class="form-control" id="id" name="id" readonly>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                </div>
                <div class="modal-footer bg-red-gradient">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#tamabhSkpd').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/setting/Set_asistenSkpd/modal_tambahSkpdAsisten/" + id,
            success: function (respont) {
              //      $('.tamabhSkpdAsisten').html(respont);
            }
        });
    });
    
     $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nama_urusan = button.data('nama_urusan');
        var modal = $(this);
        modal.find('.modal-body input#nama_urusan').val(nama_urusan);
        modal.find('.modal-body input#id').val(id);
    });
</script>