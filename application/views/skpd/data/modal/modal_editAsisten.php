<?php
foreach ($get_SetAsistenWhereId as $gsawi) {
    $id = $gsawi->id;
    $nip = $gsawi->nip_nik;
    $email = $gsawi->email;
    $nama = $gsawi->nama;
    $jabatan = $gsawi->jabatan;
    $asisten = $gsawi->asisten;
}
?>
<div class="form-group col-md-12">
    <label>Nama Pegawai</label>
    <select class="btn btn-default select2 pegawai" style="width: 100%">
        <option value=''> Pilih Pegawai</option>
        <?php
        foreach ($get_dataPegawai as $gdp) {
            if ($gdp->status_pegawai == 'pns') {
                echo"<option  value='".$gdp->nip_nik."' data-nip='".$gdp->nip_nik."' data-jabatan='".$gdp->jabatan. "'"; 
                if ($nip == $gdp->nip_nik) echo "selected";
                echo">" . $gdp->nama . "</option>";
            }
        }
        ?>
    </select> 
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
<select name='asisten' id='asisten' class="btn btn-default select2" style="width: 100%" required>
    <option value='' >-- Pilih Jabatan Asisten --</option>
   <?php
                                foreach ($get_refAsisten as $gra) {
                                    $id1 = $gra->id;
                                    $nama = $gra->nama;
                                    echo"<option value='" . $id1 . "'";
                                            if($asisten== $id1) echo"selected"; echo">" . $nama . "</option>";
                                }
                                ?>
</select> 
</div>
<div class="form-group col-md-12">
    <label>Alamat Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?=$email;?>" required>
</div>
<input type="hidden" readonly class="form-control" name="id" value="<?= $id;?>"> 
<script type="text/javascript">
    $(function () {
    $(".select2").select2();
    });
    </script>