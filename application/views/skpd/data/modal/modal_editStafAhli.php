<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
foreach ($get_setStafAhliWhereId as $row) {
    $id = $row->id;
    $nip_nik = $row->nip_nik;
    $email = $row->email;
    $jabatan = $row->jabatan;
}
?>
<div class="form-group col-md-12">
    <label>Nama Pegawai</label>
    <select class="btn btn-default select2 pegawai1" style="width: 100%">
        <option value=''> Pilih Pegawai</option>
        <?php
        foreach ($get_dataPegawai as $gdp) {
            if ($gdp->status_pegawai == 'pns') {
                echo"<option  value='" . $gdp->nip_nik . "'"
                . "data-nip1='" . $gdp->nip_nik . "'"
                . " data-jabatan1='" . $gdp->jabatan . "'"; if($nip_nik==$gdp->nip_nik) echo"selected"; echo">" . $gdp->nama . "</option>";
            }
        }
        ?>
    </select> 
</div>
<div class="hidden">
    <div class="form-group col-md-12">
        <label>NIP</label>
        <input type="text" readonly class="form-control nip1" name="nip" required value="<?= $nip_nik;?>">
    </div>
    <div class="form-group col-md-12">
        <label>Jabatan</label>
        <input type="text" readonly class="form-control jabatan1" name="jabatan" required value="<?= $jabatan;?>">
    </div>
</div>
<div class="form-group col-md-12">
    <label>Email</label>
    <input type="email" class="form-control" id="email" name="email" required value="<?= $email; ?>">
    <input type="hidden" class="form-control" id="id" name="id" required value="<?= $id; ?>">
</div>

<script type="text/javascript">
    $(function () {
        $(".select2").select2();
    });
    $('.pegawai1').on('change', function () {
        $(".hidden").removeClass('hidden');
        var jabatan1 = $(".pegawai1 option:selected").data('jabatan1');
        var nip1 = $(".pegawai1 option:selected").data('nip1');
//        alert(nip1);
        $(".jabatan1").val(jabatan1);
        $(".nip1").val(nip1);
    });
</script>