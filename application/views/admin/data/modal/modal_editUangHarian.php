<?php
foreach ($get_refJabWhereId as $grjwi) {
    $nama_jabatan = $grjwi->nama_jabatan;
}
?>

<div class="col-md-12">
    <h3 class="alert alert-info hr text-center" style="font-weight: bold;"><?= $nama_jabatan;?></h3>
    </div>

<?php
foreach ($get_setUangHarianWhereJabatan as $get) {
        $id = $get->id;
        $id_tujuan = $get->id_ref_tujuan;
        $nama_tujuan = $get->nama_tujuan;
        $uang_harian = $get->uang_harian;
    if($id > 0){
        ?>
    <div class="form-group col-md-6">
        <label style='font-size:10pt; '><?= $nama_tujuan; ?></label>
        <div class="input-group bg-gray">
            <span class="input-group-addon bg-gray">Rp.</span>
            <input type = 'number' class = "form-control text-right" name='uangharian[]' value='<?= $uang_harian;?>' required>
            <span class="input-group-addon bg-gray">,00</span>
        </div>
        <input type = 'hidden' class = "form-control text-right" name='id_ref_tujuan[]' id='id_ref_tujuan' value='<?= $id_tujuan; ?>' required>
        <input type = 'hidden' class = "form-control text-right" name='id_ref_jabatan[]' value="<?= $id_jabatan;?>">
        <input type = 'hidden' class = "form-control text-right" name='id[]' value="<?= $id;?>">
    </div>
    <?php }else{ ?>
          <div class="form-group col-md-6">
        <label><?= $nama_tujuan; ?></label>
        <div class="input-group bg-gray">
            <span class="input-group-addon bg-gray">Rp.</span>
            <input type = 'number' class = "form-control text-right" name='uangharian1' value='<?= $uang_harian;?>' required>
            <span class="input-group-addon bg-gray">,00</span>
        </div>
        <input type = 'hidden' class = "form-control text-right" name='id_ref_tujuan1' id='id_ref_tujuan' value='<?= $id_tujuan; ?>' required>
        <input type = 'hidden' class = "form-control text-right" name='id_ref_jabatan1' value="<?= $id_jabatan;?>">
        <input type = 'hidden' class = "form-control text-right" name='id_ii' value="0">
    </div>
<?php    }

 } ?>
