<?php
foreach ($get_SetAsistenWhereId as $gsawi) {
    $id = $gsawi->id;
    $nip = $gsawi->nip_nik;
    $email = $gsawi->email;
    $nama = $gsawi->nama;
    $jabatan = $gsawi->jabatan;
    $asisten = $gsawi->asisten;
    $nm_as = $gsawi->nm_as;
}
?>
<div class="form-group col-md-12">
    <label>Nama Pegawai</label>
<input type="text" readonly class="form-control nip" name="nip" value="<?= $nama;?>"> 
</div>

    <div class="form-group col-md-12">
        <label>NIP</label>
        <input type="text" readonly class="form-control nip" name="nip" value="<?= $nip;?>">
    </div>
    <div class="form-group col-md-12">
        <label>Jabatan</label>
        <input type="text" readonly class="form-control jabatan" name="jabatan" value="<?=$jabatan;?>">
    </div>
<div class="form-group col-md-12">
    <label>Asisten</label>
    <input type="text" readonly class="form-control" id="nm_as" name="nm_as" value="<?=$nm_as;?>" required>
    <input type="hidden" readonly class="form-control" id="asisten" name="asisten" value="<?=$asisten;?>" required>
</div>
<div class="form-group col-md-12">
    <label>Alamat Email</label>
    <input type="email" readonly class="form-control" id="email" name="email" value="<?=$email;?>" required>
</div>
<input type="hidden" readonly class="form-control" name="id" value="<?= $id;?>"> 