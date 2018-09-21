<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
foreach ($get_asistenWhereId as $row) {
    $username = $row->username;
    $password = $row->password;
    $nm_pgw = $row->nm_pgw;
    $email = $row->email;
    $jabatan = $row->jabatan;
    $nip_nik = $row->nip_nik;
    $foto = $row->foto;
    $id = $row->id;
    $asisten = $row->asisten;
}
?>


<section class="content-header">
    <h1>
        <?= $page_name; ?>
        <small><?= $jabatan; ?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> <?= $a['nama']; ?></a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
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
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border panel-heading bg-gray">
                    <h1 class="box-title text-center"></h1>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Min">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div></div>
                <form id="form_tambah"  method="POST" action="<?php echo base_url(); ?>index.php/Administrator/update_user" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class='row'>
                            <div class="col-md-4">
                                <center>
                                    <label class=""><?= $nm_pgw; ?>
                                        <br>NIP. <?= $nip_nik; ?></label>

                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail">
                                            <?php
                                            if ($foto == "") {
                                                echo"<img src='" . base_url() . "assets/dist/img/user2-160x160.jpg' width='80%'>";
                                            } else {
                                                echo"<img src='" . base_url() . "assets/img/user/" . $foto . "' width='80%'>";
                                            }
                                            ?>
                                        </div>
                                        <div><span class="btn btn-file btn-success btn-xs"><span class="fileupload-new">Select Gambar</span>
                                                <input type="file" class="form-control" name="foto" ></span>
                                            <input type="hidden" class="form-control" name="foto_lama" value='<?= $foto; ?>'>
                                            <a href="#" class="btn btn-danger btn-xs fileupload-exists" data-dismiss="fileupload">hapus</a>
                                        </div>
                                    </div>
                                </center>
                            </div>
                            <div class='col-md-4'>
                                <div class="box">
                                    <div class="box-header with-border panel-heading bg-gray">
                                    <h1 class="box-title text-center">Edit User</h1>
                                    </div>
                                    <div class="box-body bg-yellow-gradient">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label  style="text-align:left;" class="control-label col-lg-12">Username<span class="required">*</span></label>
                                                <input class="form-control" name="username"  id="username" type="text" readonly value='<?= $username; ?>'  required />
                                                <input class="form-control" name="username_lama"  id="username_lama" type="hidden" autofocus value='<?= $username_lama; ?>'  required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label  style="text-align:left;" class="control-label col-lg-12">Password Lama<span class="required">*</span></label>
                                                <input class="form-control" name="password_lama" id="password_lama"  type="password" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label  style="text-align:left;" class="control-label col-lg-12">Password Baru<span class="required">*</span></label>
                                                <input class="form-control" name="password_baru" id="password_baru"  type="password" required />   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class="box bg-aqua-gradient">
                                    <div class="box-header with-border panel-heading bg-gray">
                                    <h1 class="box-title text-center">Profil</h1>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label  style="text-align:left;" class="control-label col-lg-12">Nama<span class="required">*</span></label>
                                                <input class="form-control" name="nama"  id="nama" type="text" value='<?= $nm_pgw; ?>'  readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label  style="text-align:left;" class="control-label col-lg-12">NIP<span class="required">*</span></label>
                                                <input class="form-control" name="nip" id="nip"  type="text" required value="<?=$nip_nik;?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label  style="text-align:left;" class="control-label col-lg-12">Jabatan<span class="required">*</span></label>
                                                <input class="form-control" name="jabatan" id="jabatan"  type="text" required value="<?=$jabatan;?>" readonly>   
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label  style="text-align:left;" class="control-label col-lg-12">Emali<span class="required">*</span></label>
                                                <input class="form-control" name="email" id="email"  type="email" value="<?= $email; ?>" required />   
                                                <input class="form-control" name="id" id="id"  type="hidden" value="<?= $id; ?>" required />   
                                                <input class="form-control" name="asisten" id="asisten"  type="hidden" value="<?= $asisten; ?>" required />   
                                                <input class="form-control" name="url" id="url"  type="hidden" value="<?= $url; ?>" required />   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="box-footer bg-gray">
                        <span class="pull-right">
                        <button type="submit" id="edit" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    $(document).ready(function () {
        $('#password_lama').after('<span class="status_password_lama"></span>').css('margin-right', '10px');
        $('#password_lama').keyup(function () {
            $(this).css({'border': '1px solid #ccc', 'background': 'none'});
        });

        $('#password_lama').change(function (e) {
            var password_lama = md5($(this).val());
//            alert(password_lama+ "--" + '<?= $password; ?>' );
            if (password_lama == '<?= $password; ?>') {
                $('.status_password_lama').html('<img src="<?php echo base_url(); ?>/assets/img/true.png"><b style="color:green;"> Password diterima</b>');
                $('#edit').removeAttr("disabled", "disabled");
            } else {
                $('.status_password_lama').html('<img src="<?php echo base_url(); ?>/assets/img/false.png"><b style="color:red;"> Password Lama Tidak Diterima</b>');
                $('#password_lama').css({'border': '3px solid #f00', 'background': 'yellow'});
                $("#edit").attr("disabled", "disabled");
            }
        });
    });

</script>