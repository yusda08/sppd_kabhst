<?php
foreach ($get_pgwSkpdWhereNip as $gpswn) {
    $id = $gpswn->id;
    $id_jabatan = $gpswn->id_jabatan;
    $nama = $gpswn->nama;
    $nip_nik = $gpswn->nip_nik;
    $status = $gpswn->status_pegawai;
    $no_rekening = $gpswn->no_rekening;
    $jabatan = $gpswn->jabatan;
    $id_bank = $gpswn->id_bank;
}
foreach ($get_pegawaiNip as $pgn) {
    $gol = $pgn->NGOLRU;
    $pangkat = $pgn->PANGKAT;
}
switch ($status) {
    default:
        ?>   

        <div class="form-group col-md-12">
            <label>Nama Pegawai</label>
            <input type="text" class="form-control nama" name="nama" value="<?= $nama; ?>" readonly>
        </div>
        <div class="form-group col-md-12">
            <label>NIP</label>
            <input type="text" class="form-control" name="nip_nik" value="<?= $nip_nik; ?>" readonly>

        </div>
        <div class="form-group col-md-12">
            <label>Pangkat / Gol</label>
            <input type="text" class="form-control" name="gol" value="<?= $pangkat . " / " . $gol; ?>" readonly>
        </div>
        <div class="form-group col-md-12">
            <label>Jabatan</label>
            <input type="text" class="form-control jabatan" name="jabatan" required value="<?= $jabatan; ?>">
        </div>
        <div class="form-group col-md-12">
            <label>Tingkatan</label>
            <select name='id_jabatan'class="btn btn-default select2" required style="width: 100%">
                <option value=''> Pilih Jabatan</option>
                <?php
                foreach ($get_refJabatan as $grj) {
                    echo"<option value='$grj->id'";
                    if ($grj->id == $id_jabatan)
                        echo"selected";
                    echo">" . $grj->nama_jabatan . "</option>";
                }
                ?>
            </select> 
        </div>
        <div class="form-group col-md-12">
            <label>Pilih Bank</label>
            <select name='bank'class="btn btn-default select2" required style="width: 100%">
                <option value=''> Pilih Bank</option>
                <?php
                foreach ($get_refbank as $grb) {
                    echo"<option value='$grb->id'";
                    if ($grb->id == $id_bank)
                        echo"selected";
                    echo"> (" . $grb->kode . ") - " . $grb->nama_bank . "</option>";
                }
                ?>
            </select> 
        </div>
        <div class="form-group col-md-12">
            <label>Nomor Rekening</label>
            <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="<?= $no_rekening; ?>" required>
            <input type="hidden" class="form-control" id="id" name="id" value="<?= $id; ?>" required>
            <input type="hidden" class="form-control" id="status" name="status" value="<?= $status; ?>" required>
        </div>

        <?php
        break;
    case "non_pns":
        ?>
        <div class="form-group col-md-12">
            <label>Nama Pegawai Non PNS</label>
            <input type="text" class="form-control nama" name="nama" value="<?= $nama; ?>" readonly>
        </div>
        <div class="form-group col-md-12">
            <label>NIK</label>
            <input type="text" class="form-control" name="nip_nik" value="<?= $nip_nik; ?>" readonly>
        </div>
        <div class="form-group col-md-12">
            <label>Jabatan</label>
            <input type="text" class="form-control jabatan" name="jabatan" required value="<?= $jabatan; ?>">
        </div>
        <div class="form-group col-md-12">
            <label>Tingkatan</label>
            <select name='id_jabatan'class="btn btn-default select2" style="width: 100%">
                <option value=''> Pilih Jabatan</option>
        <?php
        foreach ($get_refJabatan as $grj) {
            echo"<option value='$grj->id'";
            if ($grj->id == $id_jabatan)
                echo"selected";
            echo">" . $grj->nama_jabatan . "</option>";
        }
        ?>
            </select> 
        </div>

        <div class="form-group col-md-12">
            <label>Pilih Bank</label>
            <select name='bank'class="btn btn-default select2" style="width: 100%">
                <option value=''> Pilih Bank</option>
        <?php
        foreach ($get_refbank as $grb) {
            echo"<option value='$grb->id'";
            if ($grb->id == $id_bank)
                echo"selected";
            echo"> (" . $grb->kode . ") - " . $grb->nama_bank . "</option>";
        }
        ?>
            </select> 
        </div>
        <div class="form-group col-md-12">
            <label>Nomor Rekening</label>
            <input type="text" class="form-control" id="no_rekening" name="no_rekening" value="<?= $no_rekening; ?>" required>
            <input type="hidden" class="form-control" id="id" name="id" value="<?= $id; ?>" required>
            <input type="hidden" class="form-control" id="status" name="status" value="<?= $status; ?>" required>
        </div>


        <?php
        break;
}
?>
        

        <script type="text/javascript">
            $(function () {
                $(".select2").select2();
            });
        </script>