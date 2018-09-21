<?php
foreach ($get_ttdSuratTugas as $row) {
    $id = $row->id;
    $nama = $row->nama_pegawai;
    $ket = $row->keterangan;
    $nip = $row->nip;
}
foreach ($get_pegawai as $gp) {
    if ($nip == $gp->nip) {
        $gol = $gp->NGOLRU;
        $pangkat = $gp->PANGKAT;
    }
}
?>
<label><?= $ket; ?></label>
<br>
<br>
<br>
<br>
<label><?= $nama . "<br>";
if ($id != 1 and $id != 2) {
    echo $pangkat. " (".$gol.")<br>NIP." . $nip;
}
?></label>

