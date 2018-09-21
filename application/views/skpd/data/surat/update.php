<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
$url = base_url() . 'index.php/skpd/surat/Nota_dinas/masuk'; //"http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//var_dump($get_notaDinasWhereId);
foreach ($get_notaDinasWhereId as $value) {
    $id = $value->id;
    $no = $value->no;
    $tgl_nota_dinas = $value->tgl_nota_dinas;
    $perihal = $value->perihal;
    $tujuan = $value->tujuan;
    $dasar = $value->dasar;
    $maksud = $value->maksud;
    $tgl_berangkat = $value->tgl_berangkat;
    $tgl_kembali = $value->tgl_kembali;
    $lamanya = $value->lama;
    $status_persetujuan = $value->status_persetujuan;
    $nama_file = $value->nama_file;
}
?>
<section class="content">

    <div class="panel panel-info">
        <div class="panel-heading">
            Data Nota Dinas
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <input type="hidden" name="no" value="<?= $no ?>" class="form-control" readonly="true" />
                    <div class="form-group">
                        <label>Perihal</label>
                        <input type="text" name="perihal" value="<?= $perihal ?>" class="form-control" readonly="true" />
                    </div>
                    <div class="form-group">
                        <label>Tujuan</label>
                        <input type="text" name="tujuan" value="<?= $tujuan ?>" class="form-control" readonly="true" />
                    </div>
                    <div class="form-group">
                        <label>Dasar</label>
                        <input type="text" name="dasar" value="<?= $dasar ?>" class="form-control" readonly="true" />
                    </div>
                    <div class="form-group">
                        <label>Maksud</label>
                        <!--<input type="text" name="maksud" value="" class="form-control" readonly="true" />-->
                        <textarea class="form-control" rows="5" readonly><?= $maksud ?></textarea>
                    </div>
                </div>
                <div class="col-md-3">
                     <div class="form-group">
                        <label>Tanggal Nota Dinas</label>
                        <input type="text" name="tgl_nota_dinas" value="<?= Tgl_indo::indo($tgl_nota_dinas) ?>" class="form-control" readonly="true" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Berangkat</label>
                        <!--<p><?= Tgl_indo::indo($tgl_berangkat)?></p>-->
                        <input type="text" name="tgl_berangkat" value="<?= Tgl_indo::indo($tgl_berangkat)?>" class="form-control" readonly="true" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Kembali</label>
                        <!--<p><?= Tgl_indo::indo($tgl_kembali)?></p>-->
                        <input type="text" name="tgl_kembali" value="<?= Tgl_indo::indo($tgl_kembali)?>" class="form-control" readonly="true" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Lamanya</label>
                        <!--<p><?= Tgl_indo::indo($tgl_kembali)?></p>-->
                        <input type="text" name="lama" value="<?= $lamanya;?>" class="form-control" readonly="true" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a target='_blank' href='<?= base_url() ?>assets/file/<?= $nama_file ?>'  class = 'btn btn-danger btn-xs'>
                                                    <i class = 'fa fa-eye'></i> Lihat lampiran</a>
    <br>
    
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP/ NIK</th>
                    <th>Nama</th>
                    <th>Pangkat / Gol</th>
                    <th>Jabatan</th>
                    <th>Status Pegawai</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($get_notaDinasDetailWhereIdNd as $value) {
                    ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $value->nip_nik ?></td>
                        <td><?= $value->nama ?></td>
                        <td class="text-center"><?= $value->pangkat_gol ?></td>
                        <td><?= $value->jabatan ?></td>
                        <td class="text-center"><?php if($value->status_pegawai == 'pns'){ echo "PNS"; }else{ echo"Non PNS";}  ?></td>

                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table></div>
    <br>
    
    <div class="panel panel-primary">
        <div class="panel-heading">
            Form Verifikasi
        </div>
        <div class="panel-body">
            <form method="POST" action="<?= base_url() . 'index.php/skpd/surat/nota_dinas/updatestatuspersetujuan' ?>">
                <div class='row'>
                    <div class='col-md-5'>
                        <p>
                            <select onChange="pilihasisten(this.value)" name='id_assisten' id='id_assisten' class="btn btn-default select2" style="width: 100%" required>
                                <option value=''> Pilih Tujuan Kewenangan</option>
                                <?php foreach ($get_SetAsisten as $value) { ?>
                                    <option value='<?= $value->id ?>' data-email='<?= $value->email?>'><?= $value->nm_as . ' - ' . $value->nama ?></option>
                                <?php } ?>
                            </select>
                        </p>
                        <br>
                        <select name="status_persetujuan" class="form-control select2" required>
                            <option value=''>-- Pilih --</option>
                            <option value="1">Setuju</option>
                            <option value="2">Ditolak / Batal</option>
                        </select>
                        <br><br>
                        <input type="hidden" name='penerima' id='penerima' />
                        <input type="submit" value="Kirim" class="btn btn-info" />
                    </div>
                    <div class='col-md-7'>
                        <div id='tablebidang'>
                        </div>
                    </div>
                </div>
                
                <div class='row'>
                    <div class='col-md-5'>
                        <input type="hidden" name="id" value="<?= $id ?>" />
                        <input type="hidden" name="url" value="<?= $url ?>" />

                    </div>
                </div>

            </form>
        </div>
    </div>

</section>

<script>
//    $("select").on("select2:close", function (e) {  
//        $(this).valid(); 
//    });
    
    $("#id_assisten").change(function () {
        var email = $("#id_assisten").find('option:selected').data('email');
//        alert(email);
        $('#penerima').val(email);
        
    });
    function pilihasisten(idassisten) {
        var id_assiten = idassisten;

        var posting = $.post("<?= base_url() . 'index.php/skpd/surat/Nota_dinas/listbidangbyidassisten' ?>", {
            id_assisten: id_assiten
        })
        posting.done(function (data) {
            $("#tablebidang").html(data);
        })
    }
</script>