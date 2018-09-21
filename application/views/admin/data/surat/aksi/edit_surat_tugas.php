<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
foreach ($get_skpdWhereKun as $gs) {
    $nama_skpd = $gs->nunker;
}
foreach ($get_suratTugasSkpdWhereId as $gndwi) {
    $id_nd = $gndwi->id;
    $no_nd = $gndwi->no;
    $lampiran = $gndwi->lampiran;
    $tgl_nota_dinas = $gndwi->tgl_nota_dinas;
    $perihal = $gndwi->perihal;
    $tujuan = $gndwi->tujuan;
    $id_ref_tujuan = $gndwi->id_ref_tujuan;
    $id_ref_kewenangan = $gndwi->id_ref_kewenangan;
    $dasar = $gndwi->dasar;
    $tgl_berangkat = $gndwi->tgl_berangkat;
    $tgl_kembali = $gndwi->tgl_kembali;
    $maksud = $gndwi->maksud;
    $lama = $gndwi->lama;
    $narasi = $gndwi->narasi;
    $nama_file = $gndwi->nama_file;
    $no_spt = $gndwi->no_spt;
    $id_spt = $gndwi->id_spt;
    $id_ttd_spt = $gndwi->id_ttd_spt;
    $tgl_spt = $gndwi->tgl_spt;
//    $alat_angkut = explode(";", $gndwi->alat_angkut);
}
?>
<section class="content-header alert bg-gray" style=" border-bottom-width: 19px; margin-bottom: 16px;margin-top: 0px;">

    <h1><?php echo strtoupper($page_name); ?></h1>
    <ol class="breadcrumb ">
        <li><a href="#">Surat</a></li>
        <li class="">Surat Tugas</li>
        <li class="active">Edit Surat Tugas</li>
    </ol>
</section>
<section class="invoice">
    <form id="form_tambah" method="POST" action="<?= base_url() ?>index.php/admin/surat/Surat_tugas/updateSuratTugas" enctype="multipart/form-data">
        <div class="row invoice-info">
            <div class="row">
                <div class="col-sm-12 invoice-col">
                    <div class="col-sm-3 invoice-col">
                        Nama SKPD 
                    </div>
                    <div class="col-sm-9 invoice-col">
                        <label><?= $nama_skpd; ?></label>
                    </div>
                    <div class="col-sm-3 invoice-col">
                        Nomor SPT 
                    </div>
                    <div class="col-sm-9 invoice-col">
                        <label><?= $no_spt; ?></label>
                        <input type="hidden" class="form-control" id='id_spt' name='id_spt' value="<?= $id_spt; ?>" readonly required>
                        <input type="hidden" class="form-control" id='no_spt' name='no_spt' value="<?= $no_spt; ?>" readonly required>
                    </div>
                </div>
            </div>
            <br>
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td width='10%' style="border: 0px;"><label>DASAR</label></td>
                            <td width='3%' style="border: 0px;">:</td>
                            <td colspan="4" style="border: 0px;"><?= $dasar; ?></td>
                        </tr>
                        <tr>
                            <td colspan="7" style="border: 0px;" class="text-center">MENUGASKAN :</td>
                        </tr>
                        <tr>
                            <td style="border: 0px;"><label>KEPADA</label></td>
                            <td style="border: 0px;">:</td>
                            <td style="border: 0px;" colspan="4">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama / NIP</th>
                                            <th>Pangkat / Gol</th>
                                            <th>Jabatan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($get_notaDinasDetailWhereIdNd as $row) {
                                            if ($row->status == true) {
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?= $no; ?></td>
                                                    <td>
                                                        <?=
                                                        $row->nama;
                                                        if ($row->status_pegawai) {
                                                            echo '<br>NIP. ';
                                                        } else {
                                                            echo '<br>NIK. ';
                                                        }
                                                        echo $row->nip_nik;
                                                        ?>
                                                    </td>
                                                    <td class="text-center"><?= $row->pangkat_gol; ?></td>
                                                    <td class="text-center"><?= $row->jabatan; ?></td>
                                                </tr>    
                                                <?php
                                                $no++;
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0px;"><label>UNTUK</label></td>
                            <td style="border: 0px;">:</td>
                            <td colspan="4" style="border: 0px;"><?= $maksud . " di " . $tujuan; ?></td>
                        </tr>
                        <tr>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;">Tanggal Berangkat </td>
                            <td style="border: 0px;">:</td>
                            <td colspan="2" style="border: 0px;"><?= Tgl_indo::indo($tgl_berangkat); ?></td>
                        </tr>
                        <tr>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;" width="20%">Tanggal Kembali</td>
                            <td style="border: 0px;" width="3%">:</td>
                            <td style="border: 0px;" colspan="2"><?= Tgl_indo::indo($tgl_kembali); ?></td>
                        </tr>
                        <tr>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;" width="20%">Lamanya</td>
                            <td style="border: 0px;" width="3%">:</td>
                            <td style="border: 0px;" colspan="2"><?= $lama; ?></td>
                        </tr>
<!--                        <tr>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;" width="20%">Alat Angkut</td>
                            <td style="border: 0px;" width="3%">:</td>
                            <td style="border: 0px;" colspan="2">
                                <input type="text" class="form-control" name='alat_angkut' value="<?= $alat_angkut; ?>" required autofocus="true">
                                <select class="form-control select2" id='alat_angkut' name='alat_angkut[]' multiple="multiple" required>
                                    <option >-- Pilih Alat Angkut --</option>
                                    <?php
                                    
                                    foreach ($get_alat_angkut as $gaa) {
                                        $att = '';
                                        foreach ($alat_angkut as $al) {
                                            if ($gaa->alat_angkut == $al) {
                                                $att = "selected";
                                            }
                                        }
                                        ?>
                                        <option value='<?= $gaa->alat_angkut; ?>' <?= $att ?>><?= $gaa->alat_angkut; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </td>
                        </tr>-->
                        <tr>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;"> </td>
                            <td style="border: 0px;" colspan="4" width="10%">Demikian surat tugas ini dibuat agar dilaksanakan dengan penuh tanggung jawab.</td>
                        </tr>
                        <tr>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;" width="10%"></td>
                            <td style="border: 0px;" width="3%"></td>
                            <td style="border: 0px;" width="20%"></td>
                            <td style="border: 0px;">Dikeluarkan di Barabai<br>Pada Tanggal <?= Tgl_indo::indo(date("Y-m-d")); ?>
                                <br><input class="form-control" type="hidden" id="tgl_spt" name="tgl_spt" value="<?= date("Y-m-d"); ?>"> </td>
                        </tr>
                        <tr>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;" width="10%"></td>
                            <td style="border: 0px;" width="3%"></td>
                            <td style="border: 0px;" width="20%" class="text-right">Pilih Penanda Tangan :</td>
                            <td style="border: 0px;">
                                <select name='id_ttd' id='id_ttd' class="btn btn-default select2" style="width: 100%" required>
                                    <option value=''> Pilih Penandatangan Surat Tugas</option>
                                    <?php
                                    foreach ($get_refTtdNotStafAhli as $grt) {
                                        echo"<option value='$grt->id' data-id='$grt->id'";
                                        if ($id_ttd_spt == $grt->id)
                                            echo"selected";
                                        echo">$grt->nama</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;"></td>
                            <td style="border: 0px;" width="10%"></td>
                            <td style="border: 0px;" width="3%"></td>
                            <td style="border: 0px;" width="20%" class="text-right">
                            </td>
                            <td style="border: 0px;" class="text-center">
                                <div class="ttdSpt"></div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row no-print">
            <div class="col-xs-12">
                <input type = "hidden" class = "form-control" name = "url" id="url" value="<?= base_url('index.php/admin/surat/Surat_tugas/surat_tugas/' . $id_skpd); ?>">
                <hr>
                <button type="submit"  id="add" class="btn btn-success pull-right" data-loading-text="Loading..." autocomplete="off"><i class="fa fa-save"></i> Simpan</button>
                <a href="<?= base_url('index.php/admin/surat/Surat_tugas/surat_tugas/' . $id_skpd); ?>" class="btn btn-danger pull-right">
                    <i class="fa fa-backward"></i> Kembali</a>
            </div>
        </div>
    </form>
</section>
<!-- /.content -->
<div class="clearfix"></div>
<script>
    $("#id_ttd").change(function () {
        var id = $("#id_ttd").find('option:selected').data('id');
        var id_skpd = <?= $id_skpd; ?>;
        var id_nd = <?= $id_nd; ?>;
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/surat/Surat_tugas/get_ttdSpt/" + id + "/" + id_skpd+"/"+id_nd,
            success: function (respont) {
                $('.ttdSpt').html(respont);
            }
        });
    });
</script>