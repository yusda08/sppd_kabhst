<?php
foreach ($get_SetKepalaSkpdWhereKd as $gskswk) {
    $id = $gskswk->id;
    $jabatan = $gskswk->jabatan;
    $nip = $gskswk->nip;
    $kode_skpd = $gskswk->kode_skpd;
    $email = $gskswk->email;
}
?>
<div class="form-group col-md-12">
    <label>Nama Pegawai</label>
    <select name='pegawai1' id='pegawai1' class="btn btn-default select2" style="width: 100%" required>
        <option value='' >-- Pilih Kepala SKPD --</option>
        <?php
        foreach ($get_dataPegawaiWhereKd as $row) {
            if($row->status_pegawai == 'pns'){
            echo "<option  value='" . $row->nip_nik . "' data-nip='" . $row->nip_nik . "'"
                    . "data-jabatan='" . $row->jabatan . "'";
                    if($row->nip_nik == $nip) echo"selected"; echo">" . $row->nama. "</option>";
        }
        }
        ?>
    </select>
</div>
    <div class="form-group col-md-12">
        <label>NIP</label>
        <input type="text" readonly class="form-control nip1" name="nip" value="<?= $nip;?>">
    </div>
    <div class="form-group col-md-12">
        <label>Jabatan</label>
        <input type="text" readonly class="form-control jabatan1" name="jabatan" value="<?= $jabatan;?>">
    </div>

<div class="form-group col-md-12">
    <label>Alamat Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?= $email;?>">
    <input type="hidden" class="form-control" id="id" name="id" value="<?= $id;?>">
</div>
<script type="text/javascript">
    $(function () {
    $(".select2").select2();
    });
    
    $("#pegawai1").change(function () {
        var nip = $("#pegawai1").find('option:selected').data('nip');
        var jabatan = $("#pegawai1").find('option:selected').data('jabatan');
        $('.nip1').val(nip);
        $('.jabatan1').val(jabatan);
    });
    </script>