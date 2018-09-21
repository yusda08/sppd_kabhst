

<?php
foreach ($get_disposisiWhereIdNd as $row) {
    $tgl_disposisi = $row->tgl_disposisi;
    $urutan = $row->urutan;
    $jabatan = '';
    foreach ($get_setAsistenWhereIdSkpdJoinAll as $row1) {
        if ($urutan == $row1->urutan) {
            $nip_nik = $row1->nip_nik;
            $jabatan = $row1->jabatan;
        } else {
            $nip_nik = '';
            $jabatan = $row->nama;
        }
    }
    if($id_ttd == $row->id_ttd){
        $att = '';
    }else{
        $att = 'readonly';
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <label><?= $jabatan; ?> </label>
            <textarea  <?= $att;?> class="form-control" type="text" id="isi<?=$row->id_ttd;?>" name="isi<?=$row->id_ttd;?>" rows="5"  required><?= $row->isi; ?></textarea>
            <?php if ($tgl_disposisi != null) { ?>
                <label><?= Tgl_indo::indo(substr($tgl_disposisi, 0, 10)) . " At :" . substr($tgl_disposisi, 10, 18); ?></label>
            <?php } ?>
            <hr>
        </div>
    </div>

    <?php
} ?>
<input type="hidden" name='id_ttd' id='id_ttd' value="<?=$id_ttd;?>">
<?php
foreach ($get_SetKewenanganTtdWhereId as $row) {
    foreach ($get_notaDinasWhereId as $key) {
        if ($row->status_persetujuan == 1) {
        ?>
        <div class="row">
            <div class="col-md-12">
                <label>Persetujuan Dari <?= $row->nama; ?> </label>
                <h4><?=$row->catatan_persetujuan;?></h4>
                <note>Silahkan Untuk membuat SPT</note>
            </div>
        </div>
        <?php
    }else if ($row->status_persetujuan == 2) { 
        ?>
        <div class="row">
            <div class="col-md-12">
                <label>Persetujuan Dari <?= $row->nama; ?> </label>
                <h3>DibatalKan</h3>
            </div>
        </div>
        <?php
    }else if ($row->status_persetujuan == 3) { 
        ?>
        <div class="row">
            <div class="col-md-12">
                <label>Persetujuan Dari <?= $row->nama; ?> </label>
                <h3><?= $row->catatan_koreksi;?></h3>
            </div>
        </div>
        <?php }else{ ?>
            <div class="row">
            <div class="col-md-12">
                <label>Persetujuan Dari <?= $row->nama; ?> </label>
                <h3>Dalam Proses</h3>
            </div>
        </div>
            <?php
        }
    }
}
?>
