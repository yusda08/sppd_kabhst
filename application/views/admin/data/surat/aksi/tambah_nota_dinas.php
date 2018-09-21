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

    <h1><?php echo strtoupper($page_name); ?></h1>
    <ol class="breadcrumb ">
        <li><a href="#">Surat</a></li>
        <li class="">Nota Dinas</li>
        <li class="active">Tambah Nota Dinas</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                <div class="box-body">
                    <form id="form_tambah" method="POST" action="<?= base_url() ?>index.php/skpd/surat/Nota_dinas/insertNotaDinas" enctype="multipart/form-data">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <td width='10%'>Kepala Yth</td>
                                        <td width='2%'>:</td>
                                        <td>
                                            <select name='id_kewenangan' id='id_kewenangan' required class="btn btn-default select2" style="width: 100%">
                                                <option value=''> Pilih Tujuan Kewenangan</option>
                                                <?php
                                                foreach ($get_SetKewenanganJoinTtd as $skjt) {
                                                    echo"<option value='$skjt->id'>$skjt->nama</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'>Dari </td>
                                        <td width='2%'>:</td>
                                        <td><label><?= $nm_skpd; ?></label>
                                            <input class="form-control" type="hidden" name="id_skpd" id='id_skpd' value="<?= $id_skpd; ?>"> </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'>Tanggal</td>
                                        <td width='2%'>:</td>
                                        <td>
                                            <label><?php echo Tgl_indo::indo(date('Y-m-d')); ?> </label>
                                            <input class="form-control" type="hidden" name="tgl_nota_dinas" id='tgl_nota_dinas' value="<?= date('Y-m-d'); ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'>Nomor </td>
                                        <td width='2%'>:</td>
                                        <td><input class="form-control" type="text" name="no_nota_dinas" id='no_nota_dinas' required> </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'>Lampiran</td>
                                        <td width='2%'>:</td>
                                        <td><input class="form-control" type="text" name="lampiran" id='lampiran' required> </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'>Perihal</td>
                                        <td width='2%'>:</td>
                                        <td><textarea class="form-control" type="text" name="perihal" id='perihal' rows="3" required></textarea> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><hr size="20px" style="color:#000;"></td>
                                    </tr>

                                    <tr>
                                        <td width='10%'></td>
                                        <td width='2%'></td>
                                        <td><label>Dasar </label>
                                            <textarea class="form-control" type="text" name="dasar" id='dasar' rows="3" required></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'></td>
                                        <td width='2%'></td>
                                        <td class="text-center">
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
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'></td>
                                        <td width='2%'></td>
                                        <td><label>Untuk Menugaskan Melakukan Perjalanan Dinas :</label>
                                            <table class="table table-hover table-striped table-bordered table-condensed tbl_detail_pgw" id="tbl_detail_pgw">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama / NIP</th>
                                                        <th>Pangkat / Golongan</th>
                                                        <th>Jabatan</th>
                                                        <th><i class="fa fa-group"></i></th>
                                                    </tr>
                                                </thead>
                                            </table>

                                        </td>
                                    <tr>
                                        <td width='10%'></td>
                                        <td width='2%'></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Berangkat Dari</label>
                                                    <input class="form-control" type="text" name="dari" id='dari' value="Barabai" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Tujuan</label>
                                                    <input class="form-control" type="text" name="tujuan" id='tujuan' required>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'></td>
                                        <td width='2%'></td>
                                        <td><label>Pembebanan Biaya</label>
                                            <input class="form-control" type="text" name="beban_biaya" id='beban_biaya' placeholder="(Ex: Pusat, Kementrian)" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'></td>
                                        <td width='2%'></td>
                                        <td><label>Maksud</label>
                                            <textarea class="form-control" type="text" name="maksud" id='maksud' rows="3" required></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'></td>
                                        <td width='2%'></td>
                                        <td><label>Alat Angkut</label>
                                            <select class="form-control select2" id='alat_angkut' name='alat_angkut[]' multiple="multiple" required>
                                                <option >-- Pilih Alat Angkut --</option>
                                                <?php
                                                foreach ($get_alat_angkut as $gaa) {
                                                    ?>
                                                    <option value='<?= $gaa->alat_angkut; ?>' ><?= $gaa->alat_angkut; ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'></td>
                                        <td width='2%'></td>
                                        <td><label>Perkiraan Biaya Perjalanan (Hotel + Uang Harian + Alat angkut + dll)</label>
                                            <input class="form-control" type="number" name="perkiraan_biaya" id='perkiraan_biaya' placeholder="(Ex: 4000000, 5000000)" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'></td>
                                        <td width='2%'></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Tanggal Berangkat</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input placeholder="Masukkan Tanggal Berangkat" type="date" class="form-control" name="tgl_berangkat" id='tgl_berangkat' value="<?= date('Y-m-d'); ?>" required>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'></td>
                                        <td width='2%'></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Tanggal Kembali</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input placeholder="Masukkan Tanggal Kembali" type="date" class="form-control" name="tgl_kembali" id='tgl_kembali' value="<?= date('Y-m-d'); ?>" required>
                                                    <!--<input placeholder="Masukkan Tanggal Kembali" type="text" class="form-control" name="tgl_kembali" id='tgl_kembali' value="<?= date('m/d/Y'); ?>" required>-->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'></td>
                                        <td width='2%'></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Lamanya</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control" type="text" readonly name="lamanya" id='lamanya' value="1 Hari" required>
                                                </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width='10%'></td>
                                        <td width='2%'></td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label>Upload File :</label>
                                                </div>
                                                <div class="col-md-4">
                                                    <input class="form-control" type="file" name="file" id='file'>
                                                    <note>Format JPG, PNG, JPEG, GIP, PDF </note>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div id="notivs"></div>
                        <input type = "hidden" class = "form-control" name = "kode" id="kode" value = '<?= md5(uniqid(rand(), true)); ?>'>
                        <input type = "hidden" class = "form-control" name = "id_skpd" id="id_skpd" value = '<?= $id_skpd; ?>'>
                        <input type = "hidden" class = "form-control" name = "id_ref_tujuan" id="id_ref_tujuan" value="<?= $id_tujuan; ?>">
                        <input type = "hidden" class = "form-control" name = "info" id="info" 
                               value="<?php if($id_tujuan==1 or $id_tujuan==2){
                                   echo 'luar';
                               }else{
                                   echo 'dalam';
                               }
                            ?>">
                        <input type = "hidden" class = "form-control" name = "url" id="url" value="<?= base_url(); ?>index.php/admin/surat/Nota_dinas/nota_dinas/<?= $id_skpd; ?>?id_tujuan=<?= $id_tujuan; ?>">
                        <div class="pull-right">
                            <!--<button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>-->
                            <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Simpan</button>
                            <!--<button type="submit" id="to-top" class="btn bg-orange" onclick="simpan_NotaDinas();">Simpan</button>-->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="tambah_pns" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Pegawai</h4>
            </div>
            <from id="form_tambah">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Pegawai</label>
                            <select name='pegawai' id='pegawai_pns' class="btn btn-default select2 pegawai_pns" style="width: 100%">
                                <option value=''> Pilih Pegawai</option>
                                <?php
                                foreach ($get_dataPegawaiWhereKd as $row) {
                                    foreach ($get_pegawai as $gp) {
                                        if ($gp->nip == $row->nip_nik) {
                                            echo"<option value='$row->nip_nik' 
                                         data-nama='$row->nama' 
                                         data-status='$row->status_pegawai' 
                                         data-nunker='$row->nunker' 
                                         data-nip='$row->nip_nik' 
                                         data-pangkat='$gp->PANGKAT' 
                                         data-gol='$gp->NGOLRU' 
                                         data-jabatan='$row->jabatan' 
                                         > $row->nama</option>";
                                        }
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group col-md-12">
                            <label>NIP</label>
                            <input type="text" class="form-control nip" name="nip" id='nip' readonly>
                            <input type="hidden" class="form-control nama" name="nama" id='nama' readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Pangkat / Gol</label>
                            <input type="text" class="form-control pangkat_gol" name="gol" id='pangkat_gol' readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Jabatan</label>
                            <input type="text" readonly class="form-control jabatan" name="jabatan" id='jabatan' required>
                        </div>
                    </div>
                    <input type="hidden" class="form-control status" id="status" name="status" placeholder="">
                    <input type="hidden" class="form-control id_skpd" id="id_skpd" name="id_skpd" placeholder="">
                </div>
            </from>
            <div class="modal-footer bg-blue">
                <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                <button type="submit"  id="add" class="btn btn-success" onclick="simpan_PegawaiPns();" data-dismiss="modal">Simpan</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="tambah_pns_luar_dinas" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Tambah Pegawai Di Luar SKPD</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label>Piliih SKPD</label>
                        <select class="form-control select2" id='skpd_pegawai' name='skpd_pegawai' style="width: 100%;" required>
                            <option >-- Pilih SKPD --</option>
                            <?php
                            foreach ($get_skpd as $gsa) {
                                if ($gsa->kunker == $id_skpd) {
                                    $att = 'disabled';
                                } else {
                                    $att = '';
                                }
                                ?>
                                <option <?= $att; ?> value='<?= $gsa->kunker; ?>' 
                                                     data-kunker='<?= $gsa->kunker; ?>'>
                                    <?= $gsa->nunker; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        <label>Pilih Pegawai</label>
                        <select class="form-control select2 pegawai_pns_luar" name='pegawai_skpd' style="width: 100%;" required>
                            <option>-- Pilih --</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label>NIP</label>
                        <input type="text" class="form-control nip" name="nip" id='nip' readonly>
                        <input type="hidden" class="form-control nama" name="nama" id='nama' readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Pangkat / Gol</label>
                        <input type="text" class="form-control pangkat_gol" name="gol" id='pangkat_gol' readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Jabatan</label>
                        <input type="text" readonly class="form-control jabatan" name="jabatan" id='jabatan' required>
                    </div>
                </div>
                <input type="hidden" class="form-control status" id="status" name="status" placeholder="">
                <input type="hidden" class="form-control id_skpd" id="id_skpd" name="id_skpd" placeholder="">
            </div>

            <div class="modal-footer bg-blue">
                <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                <button type="submit"  id="add" class="btn btn-success" onclick="simpan_PegawaiPns();" data-dismiss="modal">Simpan</button>
            </div>
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
            <form id="form_tambah" autocomplete="off" method="POST" action="<?php echo base_url(); ?>index.php/skpd/master/Pegawai_Skpd/insert_pegawai" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label>Nama Pegawai</label>
                            <select name='pegawai' id='pegawai_nonpns' class="btn btn-default select2 pegawai_nonpns" style="width: 100%">
                                <option value=''> Pilih Pegawai</option>
                                <?php
                                foreach ($get_dataPegawai as $row) {
                                    if ($row->status_pegawai == 'non_pns') {
                                        echo"<option value='$row->nip_nik' 
                                         data-nama='$row->nama' 
                                         data-nunker='$row->nunker' 
                                         data-nik='$row->nip_nik' 
                                         data-jabatan='$row->jabatan' 
                                         data-status='$row->status_pegawai' 
                                         > $row->nama</option>";
                                    }
                                }
                                ?>
                            </select> 
                        </div>
                        <div class="form-group col-md-12">
                            <label>NIK</label>
                            <input type="text" class="form-control nik" id="nik" name="nik" required  readonly>
                            <input type="hidden" class="form-control nama" id="nama" name="nama" required readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Jabatan</label>
                            <input type="text" class="form-control jabatan" id="jabatan" name="jabatan" required readonly>
                        </div>
                    </div>
                    <input type="hidden" class="form-control status status" id="status" name="status" placeholder="">
                    <input type="hidden" class="form-control id_skpd" id="id_skpd" name="id_skpd" placeholder="">
                </div>
                <div class="modal-footer bg-blue">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" onclick="simpan_PegawaiPns();" data-dismiss="modal">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#tgl_berangkat').after('<span class="statustgl_berangkat"></span>').css('margin-right', '10px');
    $('#tgl_berangkat').keyup(function () {
        $(this).css({'border': '1px solid #ccc', 'background': 'none'});
    });
    $('#tgl_kembali').after('<span class="status"></span>').css('margin-right', '10px');
    $('#tgl_kembali').keyup(function () {
        $(this).css({'border': '1px solid #ccc', 'background': 'none'});
    });
    $('#tgl_berangkat, #tgl_kembali').on('change', function () {
        var tgl_berangkat = $('#tgl_berangkat').val();
        var tgl_kembali = $('#tgl_kembali').val();
        if (tgl_berangkat != '') {
            if (tgl_kembali >= tgl_berangkat) {
                var hari = 24 * 60 * 60 * 1000;
                var tgl1 = new Date(tgl_berangkat);
                var tgl2 = new Date(tgl_kembali);
//                 alert(tgl1);
                var diff = Math.round(Math.round(tgl2.getTime() - tgl1.getTime()) / (hari));
                $('#lamanya').val(diff + 1 + ' Hari');
                $('.status').html('');
                $('#tgl_kembali').css({background: 'none'});
            } else {
                $('.status').html('<img src="<?php echo base_url(); ?>/assets/img/false.png"><b style="color:red;">Tanggal Kembali Tidak Boleh Kurang Dari Tanggal Berangkat</b>');
            }
        } else {
            alert('Tanggal Berangkat Tidak Boleh Kosong');
        }
    });

    $("#skpd_pegawai").change(function () {
        var kunker = $("#skpd_pegawai").find('option:selected').data('kunker');
        $(".id_skpd").val(kunker);
        var url = "<?php echo base_url(); ?>index.php/skpd/surat/Nota_dinas/add_pegawaiSkpd/" + kunker;
        $('.pegawai_pns_luar').load(url);
        return false;
    });
    $('.pegawai_nonpns').on('change', function () {
        var nik = $(".pegawai_nonpns option:selected").data('nik');
        var nama = $(".pegawai_nonpns option:selected").data('nama');
        var jabatan = $(".pegawai_nonpns option:selected").data('jabatan');
        var status = $(".pegawai_nonpns option:selected").data('status');
        var kunker = $(".pegawai_nonpns option:selected").data('nunker');
//        alert(nip+''+nama+''+jabatan+''+pangkat+''+gol);
        $(".nik").val(nik);
        $(".id_skpd").val(kunker);
        $(".nama").val(nama);
        $(".jabatan").val(jabatan);
        $(".status").val(status);
    });

    $('.pegawai_pns_luar').on('change', function () {
        var nip = $(".pegawai_pns_luar option:selected").data('nip');
        var nama = $(".pegawai_pns_luar option:selected").data('nama');
        var jabatan = $(".pegawai_pns_luar option:selected").data('jabatan');
        var gol = $(".pegawai_pns_luar option:selected").data('gol');
        var pangkat = $(".pegawai_pns_luar option:selected").data('pangkat');
        var status = $(".pegawai_pns_luar option:selected").data('status');
//        alert(nip+''+nama+''+jabatan+''+pangkat+''+gol);
        $(".nip").val(nip);
        $(".nama").val(nama);
        $(".jabatan").val(jabatan);
        $(".status").val(status);
        $(".pangkat_gol").val(pangkat + " / " + gol);
    });


    $('.pegawai_pns').on('change', function () {
        var nip = $(".pegawai_pns option:selected").data('nip');
        var nama = $(".pegawai_pns option:selected").data('nama');
        var jabatan = $(".pegawai_pns option:selected").data('jabatan');
        var gol = $(".pegawai_pns option:selected").data('gol');
        var pangkat = $(".pegawai_pns option:selected").data('pangkat');
        var status = $(".pegawai_pns option:selected").data('status');
        var id_skpd = $(".pegawai_pns option:selected").data('nunker');
//        alert(id_skpd);
//        alert(nip+''+nama+''+jabatan+''+pangkat+''+gol);
        $(".nip").val(nip);
        $(".id_skpd").val(id_skpd);
        $(".nama").val(nama);
        $(".jabatan").val(jabatan);
        $(".status").val(status);
        $(".pangkat_gol").val(pangkat + " / " + gol);
    });

    function simpan_PegawaiPns() {
        var nip = $("#nip").val();
        var nik = $("#nik").val();
        var nama = $("#nama").val();
        var jabatan = $("#jabatan").val();
        var kode = $("#kode").val();
        var id_skpd = $(".id_skpd").val();
        var status = $("#status").val();
        var pangkat_gol = $("#pangkat_gol").val();
        var posting = $.post('<?= base_url() ?>index.php/skpd/surat/Nota_dinas/insertPegawai', {
            nik: nik,
            id_skpd: id_skpd,
            nip: nip,
            nama: nama,
            status: status,
            jabatan: jabatan,
            pangkat_gol: pangkat_gol,
            kode: kode
        });
        posting.done(function (data) {
            $("#tbl_detail_pgw").html(data);
            load_tbl_detail();
        });
    }
//    setInterval(function (){
//        var kode = $("#kode").val();
//        $('#tbl_detail_pgw').load('<?php echo base_url(); ?>index.php/admin/surat/Nota_dinas/tabel_nota_dinas_detail/'+kode);
//    }, 1000);

    function load_tbl_detail() {
        var kode = $("#kode").val();
        $('#tbl_detail_pgw').load('<?php echo base_url(); ?>index.php/admin/surat/Nota_dinas/tabel_nota_dinas_detail/' + kode);
    }
    
    $('#perkiraan_biaya').after('<span class="status_realisasi"></span>').css('margin-right', '10px');
    $('#perkiraan_biaya').keyup(function () {
        $(this).css({'border': '1px solid #ccc', 'background': 'none'});
    });
    $('#perkiraan_biaya').change(function (e) {
        var id_skpd = <?= $id_skpd ?>;
        var info = $('#info').val();
        var realisasi = parseInt($('#perkiraan_biaya').val());
        if(realisasi<=0){
            alert('tidak boleh kosong');
            $("#add").attr("disabled", "disabled");
        }
        else if (id_skpd.length != 0) {
            $('.status_realisasi').html('<img src="<?php echo base_url(); ?>/assets/img/loading.gif"><b> Chek ketersediaan ...</b>');
            var urlCek = "<?php echo base_url(); ?>index.php/admin/surat/Realisasi_anggaran/cek_sisaPagu/" + id_skpd + "/" + info;
            $.ajax({
                dataType: "json",
                url: urlCek,
                success: function (response) {
//                    alert(response["cek"]+ " - -  "+realisasi);
                    var jml_sisa = parseInt(response["cek"]) - realisasi;
//                    alert(jml_sisa);
                    if (jml_sisa >= 0) {
                        $('.status_realisasi').html('<img src="<?php echo base_url(); ?>/assets/img/true.png"><b style="color:green;"> Batas Diterima</b>');
                        $('#add').removeAttr("disabled", "disabled");
                    } else if (jml_sisa < 0) {
                        $('.status_realisasi').html('<img src="<?php echo base_url(); ?>/assets/img/false.png"><b style="color:red;"> Pagu Melebihi Batas Bro</b>');
                        $('#perkiraan_biaya').css({'border': '3px solid #f00', 'background': 'yellow'});
                        $("#add").attr("disabled", "disabled");
                    }
                }
            });
        } else {
            $('.status_realisasi').html('');
        }
    });
//    function simpan_NotaDinas() {
//        var id_kewenangan = $("#id_kewenangan").val();
//        var id_skpd = $("#id_skpd").val();
//        var tgl_nota_dinas = $("#tgl_nota_dinas").val();
//        var no_nota_dinas = $("#no_nota_dinas").val();
//        var lampiran = $("#lampiran").val();
//        var perihal = $("#perihal").val();
//        var dasar = $("#dasar").val();
//        var tujuan = $("#tujuan").val();
//        var maksud = $("#maksud").val();
//        var tgl_berangkat = $("#tgl_berangkat").val();
//        var tgl_kembali = $("#tgl_kembali").val();
//        var lamanya = $("#lamanya").val();
//        var kode = $("#kode").val();
//        var id_ref_tujuan = $("#id_ref_tujuan").val();
//        var url = $("#url").val();
//        
//        if(no_nota_dinas != '' && lampiran != '' && perihal != '' && dasar != '' && tujuan != '' && maksud != '' && tgl_berangkat != '' && tgl_kembali != '' && lamanya != ''){
//
//        $.ajax({
//            type: "POST",
//            url: "<?= base_url() ?>index.php/skpd/Surat/Nota_dinas/insertNotaDinas",
//            data: {
//                id_kewenangan: id_kewenangan,
//                perihal: perihal,
//                id_skpd: id_skpd,
//                tgl_nota_dinas: tgl_nota_dinas,
//                no_nota_dinas: no_nota_dinas,
//                lampiran: lampiran,
//                dasar: dasar,
//                maksud: maksud,
//                tujuan: tujuan,
//                tgl_berangkat: tgl_berangkat,
//                tgl_kembali: tgl_kembali,
//                lamanya: lamanya,
//                id_ref_tujuan: id_ref_tujuan,
//                kode: kode,
//                url: url
//            },
//            success: function (msg) {
//                if (msg == "true") {
//                    $("#notivs").html('<div class="alert alert-success alert-dismissable animated fadeIn" id="alert-notification"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Sukses!</h4> Data Berhasil Ditambah. </div>');
//                    setTimeout(function () {
//                        window.location = url;
//                    }, 3000);
//
//                } else {
//                    $("#notivs").html('<div class="alert alert-danger alert-dismissible" id="alert-notification"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Data Gagal Ditambah. </div>');
//                    setTimeout(function () {
//                        $('#alert-notification').fadeOut('slow');
//                    }, 2000);
//                }
//            }
//        });
//        }else{
//        alert('Anda Harus Mengisi Data Dengan Lengkap dan Benar, Harap Cek Lagi . . !!! ');
//        }



//        var posting = $.post('<?= base_url() ?>index.php/skpd/Surat/Nota_dinas/insertNotaDinasDetail', {
//            kode: kode,
//            id_ref_tujuan: id_ref_tujuan,
//            id_skpd: id_skpd
//        })
//        posting.done(function () {
//            alert('Data Sukses')
//
//        })
//    }



</script>