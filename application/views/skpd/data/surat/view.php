<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;

//var_dump($get_notaDinasWhereId);
foreach ($get_notaDinasWhereId as $value) {
    $no = $value->no;
    $tgl_nota_dinas = $value->tgl_nota_dinas;
    $perihal = $value->perihal;
    $tujuan = $value->tujuan;
    $dasar = $value->dasar;
    $tgl_berangkat = $value->tgl_berangkat;
    $tgl_kembali = $value->tgl_kembali;
    $lamanya = $value->lama;
    $maksud = $value->maksud;
    $status_persetujuan = $value->ttd_kepala;
}
?>
<?php
switch ($status_persetujuan) {
    case 1:
        $label = "Setuju";
        $style = "label-success";
        break;
    case 2:
        $label = "DiTolak / DiBatalkan";
        $style = "label-danger";
        break;
    default:
        $label = "Prosess Persetujuan";
        $style = "label-info";
        break;
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
                    <!--                    <div class="form-group">
                                            <label>Tanggal Nota Dinas</label>
                                            <input type="text" name="tgl_nota_dinas" value="<?= Tgl_indo::indo($tgl_nota_dinas) ?>" class="form-control" readonly="true" />
                                        </div>-->
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
                        <input type="text" name="maksud" value="<?= $maksud ?>" class="form-control" readonly="true" />
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
                        <!--<p><?= Tgl_indo::indo($tgl_berangkat) ?></p>-->
                        <input type="text" name="tgl_berangkat" value="<?= Tgl_indo::indo($tgl_berangkat) ?>" class="form-control" readonly="true" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Tanggal Kembali</label>
                        <!--<p><?= Tgl_indo::indo($tgl_kembali) ?></p>-->
                        <input type="text" name="tgl_kembali" value="<?= Tgl_indo::indo($tgl_kembali) ?>" class="form-control" readonly="true" />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Lamanya</label>
                        <!--<p><?= Tgl_indo::indo($tgl_kembali) ?></p>-->
                        <input type="text" name="lama" value="<?= $lamanya; ?>" class="form-control" readonly="true" />
                    </div>
                </div>
                <br>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status Dokumen</label>
                        <span class="label <?= $style ?>"><?= $label ?></span>                
                    </div>
                </div>        
            </div>   
        </div>
    </div> 
    <br>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIP</th>
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
                        <td><?= $value->nama ?></td>
                        <td><?php if($value->status_pegawai == 'pns'){ echo "NIP." .$value->nip_nik;} ?></td>
                        <td class="text-center"><?= $value->pangkat_gol ?></td>
                        <td><?= $value->jabatan ?></td>
                        <td class="text-center"><?php if($value->status_pegawai == 'pns'){ echo "PNS"; }else{ echo"Non PNS";}  ?></td>
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</section>