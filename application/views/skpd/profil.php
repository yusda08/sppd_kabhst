<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$kode_skpd = $a['kode'];
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
?>
<section class="content-header">
    <h1>
        <?=
        $page_name;
        if ($a['level_user'] == 2) {
            foreach ($get_skpd as $gs) {
                if ($gs->kunker == $kode_skpd) {
                    $nunker = $gs->nunker;
                }
            }
            echo "<br><small>$nunker</small>";
        }
        ?>
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
    <?php
    if ($a['level_user'] == 2) {
        foreach ($get_setSkpdWhereLevel as $row) {
            $username = $row->username;
            $password = $row->password;
            $nm_kepala = $row->nm_kepala;
            $email_skpd = $row->email_kantor;
            $email_kepala = $row->email_kepala;
            $jabatan = $row->jabatan;
            $nip_nik = $row->nip;
            $foto = $row->foto;
            $inisial = $row->inisial;
            $alamat = $row->alamat;
            $no_telpon = $row->no_telpon;
            $kode_pos = $row->kode_pos;
            $ttd_kepala = $row->ttd_kepala;
            $id = $row->id;
            $id_kepala = $row->id_kepala;
            $ttd_kepala = $row->ttd_kepala;
        }
        ?>
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
                        </div>
                    </div>
                    <form id="form_tambah"  method="POST" action="<?php echo base_url(); ?>index.php/Administrator/update_user" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class='row'>
                                <div class="col-md-4">
                                    <center>
                                        <label>Foto Admin Pada SKPD</label>
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
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label  style="text-align:left;" class="control-label col-lg-12">INISIAL SKPD<span class="required">*</span></label>
                                                    <input class="form-control" name="inisial" id="inisial"  type="text" required value="<?= $inisial; ?>" />   
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label  style="text-align:left;" class="control-label col-lg-12">Email Kantor / SKPD<span class="required">*</span></label>
                                                    <input class="form-control" name="email" id="email"  type="email" required value="<?= $email_skpd; ?>" />   
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label  style="text-align:left;" class="control-label col-lg-12">Alamat Kantor<span class="required">*</span></label>
                                                    <textarea class="form-control" name="alamat" id="alamat" rows="3" required /><?= $alamat; ?> </textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label  style="text-align:left;" class="control-label col-lg-12">Telpon Kantor<span class="required">*</span></label>
                                                    <input class="form-control" name="no_telp" id="no_telp"  type="text" required value="<?= $no_telpon; ?>" />   
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label  style="text-align:left;" class="control-label col-lg-12">Kode Pos<span class="required">*</span></label>
                                                    <input class="form-control" name="kode_pos" id="kode_pos"  type="text" required value="<?= $kode_pos; ?>" />   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class='col-md-4'>
                                    <div class="box bg-aqua-gradient">
                                        <div class="box-header with-border panel-heading bg-gray">
                                            <h1 class="box-title text-center">Profil Kepala SKPD</h1>
                                        </div>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label  style="text-align:left;" class="control-label col-lg-12">Ganti Kepala SKPD<span class="required">*</span></label>
                                                    <select name='pegawai' id='pegawai' class="btn btn-default select2 pegawai" style="width: 100%" required>
                                                        <option>-- Pilih Pengganti Kepala --</option>
                                                        <?php
                                                        foreach ($get_dataPegawaiWhereKd as $kskpd) {
                                                            echo "<option value='$kskpd->nip_nik' data-nama_kepala='$kskpd->nama' data-nip='$kskpd->nip_nik' data-jabatan='$kskpd->jabatan'>$kskpd->nama</option>";
                                                        }
                                                        ?>
                                                    </select> 
                                                </div>
                                            </div>
                                            <?php if($id_kepala == ''){ ?>
                                            <div class="hidden">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label  style="text-align:left;" class="control-label col-lg-12">Nama Kepala SKPD<span class="required">*</span></label>
                                                        <input class="form-control" name="nama_kepala" id="nama_kepala"  type="text" required value="<?= $nm_kepala; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label  style="text-align:left;" class="control-label col-lg-12">NIP<span class="required">*</span></label>
                                                        <input class="form-control" name="nip" id="nip"  type="text" required value="<?= $nip_nik; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label  style="text-align:left;" class="control-label col-lg-12">Jabatan<span class="required">*</span></label>
                                                        <input class="form-control" name="jabatan" id="jabatan"  type="text" required value="<?= $jabatan; ?>" readonly>   
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label  style="text-align:left;" class="control-label col-lg-12">Emali<span class="required">*</span></label>
                                                        <input class="form-control" name="email_kepala" id="email_kepala"  type="email" value="<?= $email_kepala; ?>" required />   
                                                        <input class="form-control" name="id" id="id"  type="hidden" value="<?= $id; ?>" required />   
                                                        <input class="form-control" name="id_kepala" id="id_kepala"  type="hidden" value="<?= $id_kepala; ?>" required />   
                                                        <input class="form-control" name="kode_skpd" id="kode_skpd"  type="hidden" value="<?= $kode_skpd; ?>" required />   
                                                        <input class="form-control" name="url" id="url"  type="hidden" value="<?= $url; ?>" required />   
                                                    </div>
                                                </div>
                                            </div> 
                                            <?php }else{ ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label  style="text-align:left;" class="control-label col-lg-12">Nama Kepala SKPD<span class="required">*</span></label>
                                                        <input class="form-control" name="nama_kepala" id="nama_kepala"  type="text" required value="<?= $nm_kepala; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label  style="text-align:left;" class="control-label col-lg-12">NIP<span class="required">*</span></label>
                                                        <input class="form-control" name="nip" id="nip"  type="text" required value="<?= $nip_nik; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label  style="text-align:left;" class="control-label col-lg-12">Jabatan<span class="required">*</span></label>
                                                        <input class="form-control" name="jabatan" id="jabatan"  type="text" required value="<?= $jabatan; ?>" readonly>   
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label  style="text-align:left;" class="control-label col-lg-12">Emali<span class="required">*</span></label>
                                                        <input class="form-control" name="email_kepala" id="email_kepala"  type="email" value="<?= $email_kepala; ?>" required />   
                                                        <input class="form-control" name="id" id="id"  type="hidden" value="<?= $id; ?>" required />   
                                                        <input class="form-control" name="id_kepala" id="id_kepala"  type="hidden" value="<?= $id_kepala; ?>" required />   
                                                        <input class="form-control" name="kode_skpd" id="kode_skpd"  type="hidden" value="<?= $kode_skpd; ?>" required />   
                                                        <input class="form-control" name="url" id="url"  type="hidden" value="<?= $url; ?>" required />   
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <hr>
                                    <label>Tanda Tangan Kepala SKPD</label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail">
                                            <?php
                                            echo"<img src='" . base_url() . "assets/img/ttd_kepala/" . $ttd_kepala . "' width='80%'>";
                                            ?>
                                        </div>
                                        <div><span class="btn btn-file btn-success btn-xs"><span class="fileupload-new">Select Gambar</span>
                                                <input type="file" class="form-control" name="ttd_kepala" ></span>
                                            <input type="hidden" class="form-control" name="ttd_kepala_lama" value='<?= $ttd_kepala; ?>'>
                                            <a href="#" class="btn btn-danger btn-xs fileupload-exists" data-dismiss="fileupload">hapus</a>
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
        <?php
    } else {
        foreach ($get_dataKepalaSkpdWhereKd as $row) {
            $username = $row->username;
            $password = $row->password;
            $id = $row->id;
            $nm_kepala = $row->nm_kepala;
            $email_kepala = $row->email_kepala;
            $jabatan = $row->jabatan;
            $nip_nik = $row->nip;
            $foto = $row->foto;
            $ttd_kepala = $row->ttd_kepala;
            $id_kepala = $row->id_kepala;
        }
        ?>

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
                        </div>
                    </div>
                    <form id="form_tambah"  method="POST" action="<?php echo base_url(); ?>index.php/Administrator/update_user" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class='row'>
                                <div class="col-md-4">
                                    <center>
                                        <label>Foto Admin Pada SKPD</label>
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
                                    <hr>
                                    <label>Tanda Tangan Kepala SKPD</label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-preview thumbnail">
                                            <?php
                                            echo"<img src='" . base_url() . "assets/img/ttd_kepala/" . $ttd_kepala . "' width='70%'>";
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            
                            <div class='col-md-4'>
                                <div class="box bg-aqua-gradient">
                                    <div class="box-header with-border panel-heading bg-gray">
                                        <h1 class="box-title text-center">Profil Kepala SKPD</h1>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label  style="text-align:left;" class="control-label col-lg-12">Nama Kepala SKPD<span class="required">*</span></label>
                                                <input class="form-control" name="nama_kepala" id="nama_kepala"  type="text" required value="<?= $nm_kepala; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label  style="text-align:left;" class="control-label col-lg-12">NIP<span class="required">*</span></label>
                                                <input class="form-control" name="nip" id="nip"  type="text" required value="<?= $nip_nik; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label  style="text-align:left;" class="control-label col-lg-12">Jabatan<span class="required">*</span></label>
                                                <input class="form-control" name="jabatan" id="jabatan"  type="text" required value="<?= $jabatan; ?>" readonly>   
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label  style="text-align:left;" class="control-label col-lg-12">Emali<span class="required">*</span></label>
                                                <input class="form-control" name="email" id="email"  type="email" value="<?= $email_kepala; ?>" required />   
                                                <input class="form-control" name="id" id="id"  type="hidden" value="<?= $id; ?>" required />   
                                                <input class="form-control" name="id_kepala" id="id_kepala"  type="hidden" value="<?= $id_kepala; ?>" required />   
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
<?php } ?>
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

    $("#pegawai").change(function () {
        var nip = $("#pegawai").find('option:selected').data('nip');
        var jabatan = $("#pegawai").find('option:selected').data('jabatan');
        var nama_kepala = $("#pegawai").find('option:selected').data('nama_kepala');
        $('.hidden').removeClass('hidden');
        $('#nip').val(nip);
        $('#nama_kepala').val(nama_kepala);
        $('#jabatan').val(jabatan);
    });
</script>