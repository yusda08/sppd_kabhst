<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
foreach ($get_skpdWhereKun as $gswk) {
    $nm_skpd = $gswk->nunker;
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
    <h1><?php echo strtoupper($page_name); ?>
        <br><small><?= $nm_skpd; ?></small>
    </h1>
    <ol class="breadcrumb ">
        <li><a href="#">Data Pegawai PERSKPD</a></li>
        <li class="active">Data SKPD</li>
        <li class="active">Data Pegawai SKPD</li>
    </ol>
</section>
<section class="content">
    
    <div class="box box-success">
        <div class="box-header with-border">
            <div class="col-md-4">
                <button type='button' class='btn btn-primary btn-flat btn-sm btn-block' data-toggle='modal' 
                        data-target='#tambah_pns'><i class='fa fa-plus'></i>&nbsp;Tambah Pegawai PNS</button>
            </div>
            <div class="col-md-4">
                <button type='button' class='btn btn-warning btn-flat btn-sm btn-block' data-toggle='modal' 
                        data-target='#tambah_pns_luar_dinas'><i class='fa fa-plus'></i>&nbsp;Tambah Pegawai PNS Diluar Dinas</button>
            </div>
            <div class="col-md-4">
                <button type='button' class='btn btn-danger btn-flat  btn-sm btn-block' data-toggle='modal' 
                        data-target='#tambah_nonpns'><i class='fa fa-plus'></i>&nbsp;Tambah Pegawai Non PNS</button>
            </div>



        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table  class="tabel_3 table table-hover table-bordered table-striped">
                    <thead>
                        <tr >
                            <th width="5%">No</th>
                            <th width="25%">Nama<br>NIP</th>
                            <th>Jabatan</th>
                            <th width="15%">Pangkat<br>(Gol)</th>
                            <th width="15%">Bank</th>
                            <th width="15%">Rekening</th>
                            <!--<th width="10%">Tingkat Pembayaran</th>-->
                            <th width="5%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        foreach ($get_pegawai_skpd as $gps) {
                            $nip_nik = $gps->nip_nik;
                            $jbtn = $gps->jabatan;
                            $nunker = $gps->nunker;
                            $status = $gps->status_pegawai;
                            $no_rekening = $gps->no_rekening;
                            $tingkat = $gps->tingkat;
                            $nama = $gps->nama;
                            $nama_bank = $gps->nama_bank;
                            $no_rekening = $gps->no_rekening;
                            if ($nunker == $kunker) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= $no; ?></td>
                                    <?php
                                    if ($status == 'pns') {
                                        echo"<td style=''>" . $nama . "<br> NIP. " . $nip_nik . "</td>";
                                    } else {
                                        echo"<td style=''>" . $nama . "<br> NIK. " . $nip_nik . "</td>";
                                    }
                                    ?>
                                    <td style=""><?= ucwords(strtolower($jbtn)); ?></td>
                                    <td style=" text-align: center;">
                                        <?php
                                        foreach ($get_pegawai as $pgw) {
                                            if($nip_nik == $pgw->nip){
                                                echo $pgw->PANGKAT . " <br>(" . $pgw->NGOLRU . ")";
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center"><?= $nama_bank; ?></td>
                                    <td class="text-center"><?= $no_rekening; ?></td>
                                    <!--<td class="text-center"><?= $tingkat; ?></td>-->
                                    <td style=" text-align: center;">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fa fa-cogs"></i> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li> <button type="button" class="btn btn-warning btn-xs btn-block btn-flat" 
                                                             data-toggle="modal" 
                                                             data-nip_nik="<?= $nip_nik; ?>" 
                                                             data-id_skpd="<?= $nunker; ?>" 
                                                             data-status="<?= $status; ?>"
                                                             data-target="#update">
                                                        <i class="fa fa-pencil"></i> Edit</button></li>
                                                <li><button type="button" class="btn btn-danger btn-xs btn-block btn-flat" 
                                                            data-toggle="modal"
                                                            data-nama="<?= $nama; ?>" 
                                                            data-id_skpd="<?= $nunker; ?>"
                                                             data-nip="<?= $nip_nik; ?>" 
                                                             data-jabatan="<?= $jbtn; ?>"
                                                            data-target="#delete">
                                                        <i class="fa fa-trash-o"></i> Hapus</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                                <?php
                                $no++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>


        </div><!-- /.box-body -->
    </div><!-- /.box -->          
</section>
<div class="modal fade" id="tambah_pns" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Refrensi Jabatan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/master/Pegawai_Skpd/insert_pegawai" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Pegawai</label>
                            <select name='pegawai' id='' class="btn btn-default select2 pegawai" style="width: 100%" required>
                                <option value=''> Pilih Pegawai</option>
                                <?php
                                foreach ($get_pegawaiSkpd as $pgw) {
                                    foreach ($get_pegawai_skpd as $gps) {
                                        if ($gps->nip_nik == $pgw->nip) {
                                            $att = 'disabled';
                                            break;
                                        } else {
                                            $att = '';
                                        }
                                    }

                                    if ($pgw->glblk != "") {
                                        echo '<option ' . $att . ' value="' . $pgw->nama . '"'
                                        . 'data-nama="' . $pgw->gldepan . ' ' . ucwords(strtolower($pgw->nama)) . ', ' . $pgw->glblk . '"'
                                        . "data-nip_nik='" . $pgw->nip . "'"
                                        . "data-gol='" . $pgw->PANGKAT . " / " . $pgw->NGOLRU . "'"
                                        . "data-jabatan='" . $pgw->NJAB . "'>" . $pgw->gldepan . " " . ucwords(strtolower($pgw->nama)) . ", " . $pgw->glblk . "</option>";
                                    } else {
                                        echo '<option ' . $att . ' value="' . $pgw->nama . '"'
                                        . 'data-nama="' . $pgw->gldepan . ' ' . ucwords(strtolower($pgw->nama)).'"'
                                        . "data-nip_nik='" . $pgw->nip . "'"
                                        . "data-gol='" . $pgw->PANGKAT . " / " . $pgw->NGOLRU . "'"
                                        . "data-jabatan='" . $pgw->NJAB . "'>" . $pgw->gldepan . " " . ucwords(strtolower($pgw->nama)) . "</option>";
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group col-md-12">
                            <label>NIP</label>
                            <input type="text" class="form-control nip_nik" name="nip_nik" readonly>
                            <input type="hidden" class="form-control nama" name="nama">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Pangkat / Gol</label>
                            <input type="text" class="form-control gol" name="gol" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Jabatan</label>
                            <input type="text" class="form-control jabatan" name="jabatan" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Tingkatan</label>
                            <select name='id_jabatan'class="btn btn-default select2" style="width: 100%">
                                <option value=''> Pilih Jabatan</option>
                                <?php
                                foreach ($get_refJabatan as $grj) {
                                    echo"<option value='" . $grj->id . "'>" . $grj->nama_jabatan . "</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group col-md-12">
                            <label>Pilih Bank</label>
                            <select name='bank'class="btn btn-default select2" style="width: 100%" required>
                                <option value=''> Pilih Bank</option>
                                <?php
                                foreach ($get_refbank as $grb) {
                                    echo"<option value='" . $grb->id . "'> (" . $grb->kode . ") - " . $grb->nama_bank . "</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nomor Rekening</label>
                            <input type="text" class="form-control" id="no_rekening" name="no_rekening" required >
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="status" name="status" value="pns">
                    <input type="hidden" class="form-control" id="kunker" name="kunker" value="<?= $kunker; ?>">
                </div>
                <div class="modal-footer bg-blue">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah_pns_luar_dinas" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Pegawai Diluar SKPD</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/master/Pegawai_Skpd/insert_pegawai" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Piliih SKPD</label>
                            <select class="form-control select2" id='skpd_pegawai' name='skpd_pegawai' style="width: 100%;" required>
                                <option >-- Pilih SKPD --</option>
                                <?php foreach ($get_skpd as $gsa) {
                                    if($kunker == $gsa->kunker){
                                        $att = 'disabled';
                                    }else{
                                        $att = '';
                                    } ?>
                                    <option <?= $att;?> value='<?= $gsa->kunker; ?>' 
                                            data-kun='<?= $gsa->kuntp; ?>' 
                                            data-kom='<?= $gsa->kunkom; ?>'><?= $gsa->nunker; ?></option>
                                        <?php }
                                        
                                        ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Pilih Pegawai</label>
                            <select class="form-control select2 pegawai_luar" name='pegawai_skpd' style="width: 100%;" required>
                                <option>-- Pilih Pegawai --</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>NIP</label>
                            <input type="text" class="form-control nip_nik" name="nip_nik" readonly>
                            <input type="hidden" class="form-control nama" name="nama">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Pangkat / Gol</label>
                            <input type="text" class="form-control gol" name="gol" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Jabatan</label>
                            <input type="text" class="form-control jabatan" name="jabatan" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Tingkatan</label>
                            <select name='id_jabatan'class="btn btn-default select2" style="width: 100%">
                                <option value=''> Pilih Jabatan</option>
                                <?php
                                foreach ($get_refJabatan as $grj) {
                                    echo"<option value='" . $grj->id . "'>" . $grj->nama_jabatan . "</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group col-md-12">
                            <label>Pilih Bank</label>
                            <select name='bank'class="btn btn-default select2" style="width: 100%">
                                <option value=''> Pilih Bank</option>
                                <?php
                                foreach ($get_refbank as $grb) {
                                    echo"<option value='" . $grb->id . "'> (" . $grb->kode . ") - " . $grb->nama_bank . "</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nomor Rekening</label>
                            <input type="text" class="form-control" id="no_rekening" name="no_rekening" required>
                            <input type="hidden" class="form-control" id="status" name="status" value='pns' placeholder="">
                            <input type="hidden" class="form-control" id="kunker" name="kunker" value="<?= $kunker; ?>">
                            <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-blue">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah_nonpns" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Refrensi Jabatan</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/master/Pegawai_Skpd/insert_pegawai" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>NIK</label>
                            <input type="search" class="form-control" id="nik" name="nik" autocomplete="on" autofocus="true" pattern=".{16,}" required oninvalid="this.setCustomValidity('NIK Harus Mencapai 16 Karakter')" placeholder="NIK (Exp : 6309060112900010)">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nama Non PNS</label>
                            <input type="text" class="form-control" id="nama" name="nama" required >
                        </div>
                        <div class="form-group col-md-12">
                            <label>Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Tingkat Golongan</label>
                            <select name='id_jabatan'class="btn btn-default select2" required style="width: 100%">
                                <option value=''> Pilih Jabatan</option>
                                <?php
                                foreach ($get_refJabatan as $grj) {
                                    echo"<option value='" . $grj->id . "'>" . $grj->nama_jabatan . "</option>";
                                }
                                ?>
                            </select> 
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label>Pilih Bank</label>
                            <select name='bank'class="btn btn-default select2" required style="width: 100%">
                                <option value=''> Pilih Bank</option>
                                <?php
                                foreach ($get_refbank as $grb) {
                                    echo"<option value='" . $grb->id . "'> (".$grb->kode.") - " . $grb->nama_bank."</option>";
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
                    <input type="hidden" class="form-control" id="status" name="status" value='non_pns' placeholder="">
                    <input type="hidden" class="form-control" id="kunker" name="kunker" value="<?= $kunker; ?>">

                </div>
                <div class="modal-footer bg-blue">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add_non" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="update" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-yellow">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Edit Data Pegawai SKPD</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/master/Pegawai_Skpd/update_pegawai" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="editPegawaiPns"></div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="status" name="status">
                </div>
                <div class="modal-footer bg-yellow">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Edit</button>
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
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span> Form Hapus Data Pegawai SKPD</h4>
            </div>
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/admin/master/Pegawai_Skpd/delete_pegawai" enctype="multipart/form-data">
                <div class="modal-body">
                    <h4 class="alert alert-danger">Apakah Anda Yakin Menghapus Ini . . !!!</h4>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama</label>
                            <input type="text"  class="form-control" id="nama" name="nama" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>NIP / NIK</label>
                            <input type="text" class="form-control" id="nip" name="nip_nik" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" name="jabatan" readonly>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="url" name="url" value='<?php echo $url; ?>' placeholder="">
                    <input type="hidden" class="form-control" id="id_skpd" name="id_skpd" placeholder="">
                    </div>
                <div class="modal-footer bg-red-gradient">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type='text/javascript'>
    $("#skpd_pegawai").change(function () {
        var kun = $("#skpd_pegawai").find('option:selected').data('kun');
        var kom = $("#skpd_pegawai").find('option:selected').data('kom');
//        alert(kun+"-"+kom)
        var url = "<?php echo base_url(); ?>index.php/admin/master/Pegawai_Skpd/add_pegawaiSkpd/" + kun + "/" + kom;
        $('.pegawai_luar').load(url);
        return false;
    });

    $(document).ready(function () {
        $('#nik').after('<span class="status"></span>').css('margin-right', '10px');
        $('#nik').keyup(function () {
            $(this).css({'border': '1px solid #ccc', 'background': 'none'});
        });
        $('#nik').change(function (e) {
            var nik = $(this).val();
            if (nik.length != 0) {
                $('.status').html('<img src="<?php echo base_url(); ?>/assets/img/loading.gif"><b> Chek ketersediaan . . .</b>');
                $.ajax({
                    dataType: "json",
                    url: "<?php echo base_url(); ?>index.php/admin/master/Pegawai_Skpd/cek_dataPgw/" + nik,
                    success: function (response) {
                        if (response[0].cek == 0 && nik.length == 16) {
                            $('.status').html('<img src="<?php echo base_url(); ?>/assets/img/true.png"><b style="color:green;"> NIK Diterima</b>');
                            $('#add_non').removeAttr("disabled", "disabled");
                        } else {
                            $('.status').html('<img src="<?php echo base_url(); ?>/assets/img/false.png"><b style="color:red;"> NIK Sudah Terdaftar</b>');
                            $('#nik').css({'border': '3px solid #f00', 'background': 'yellow'});
                            $("#add_non").attr("disabled", "disabled");
                        }
                    }
                });
            } else {
                $('.status').html('');
            }
        });
    });
</script>
<script>
    $('.pegawai').on('change', function () {
        var nip_nik = $(".pegawai option:selected").data('nip_nik');
        var jabatan = $(".pegawai option:selected").data('jabatan');
        var gol = $(".pegawai option:selected").data('gol');
        var nunker = $(".pegawai option:selected").data('nunker');
        var nama = $(".pegawai option:selected").data('nama');
        $(".nama").val(nama);
        $(".nip_nik").val(nip_nik);
        $(".jabatan").val(jabatan);
        $(".gol").val(gol);
        $(".nunker").val(nunker);
    });
    $('.pegawai_luar').on('change', function () {
        var nip_nik = $(".pegawai_luar option:selected").data('nip_nik');
        var jabatan = $(".pegawai_luar option:selected").data('jabatan');
        var gol = $(".pegawai_luar option:selected").data('gol');
        var nunker = $(".pegawai_luar option:selected").data('nunker');
        var nama = $(".pegawai_luar option:selected").data('nama');
        $(".nama").val(nama);
        $(".nip_nik").val(nip_nik);
        $(".jabatan").val(jabatan);
        $(".gol").val(gol);
        $(".nunker").val(nunker);
    });

    $('#update').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var nama = button.data('nama');
        var nip_nik = button.data('nip_nik');
        var id_skpd = button.data('id_skpd');
        var status = button.data('status');
        var modal = $(this);
//        alert(nip_nik);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/master/Pegawai_Skpd/modal_editPgwSkpd/"+nip_nik+"/"+id_skpd,
            success: function (data) {
                $('.editPegawaiPns').html(data);
            }
        });
    });
    
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var nama = button.data('nama');
        var nip = button.data('nip');
        var jabatan = button.data('jabatan');
        var id_skpd = button.data('id_skpd');
        var modal = $(this);
        modal.find('.modal-body input#nama').val(nama);
        modal.find('.modal-body input#id_skpd').val(id_skpd);
        modal.find('.modal-body input#nip').val(nip);
        modal.find('.modal-body input#jabatan').val(jabatan);
    });
</script>


