<?php
foreach ($get_setSkpdWhereKd as $gsswk) {
    $alamat = $gsswk->alamat;
    $kode_pos = $gsswk->kode_pos;
    $no_telpon = $gsswk->no_telpon;
    $email = $gsswk->email;
    $inisial = $gsswk->inisial;
}
?>
<div class="form-group col-md-3">
    <label>Alamat SKPD</label>
</div>
<div class="form-group col-md-9">
    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= $alamat; ?></textarea>
</div>
<div class="form-group col-md-3">
    <label>Email</label>
</div>
<div class="form-group col-md-9">
    <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>">
</div>
<div class="form-group col-md-3">
    <label>No Telpon</label>
</div>
<div class="form-group col-md-9">
    <input type="text" class="form-control" id="no_telpon" name="no_telpon" value="<?= $no_telpon; ?>">
</div>
<div class="form-group col-md-3">
    <label>Kode Pos</label>
</div>
<div class="form-group col-md-9">
    <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="<?= $kode_pos; ?>">
</div>
<div class="form-group col-md-3">
    <label>Inisial SKPD</label>
</div>
<div class="form-group col-md-9">
    <input type="text" class="form-control" id="inisial" name="inisial" value="<?= $inisial; ?>">
</div>
