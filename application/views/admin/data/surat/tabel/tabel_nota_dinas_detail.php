<table class="table table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama / NIP</th>
            <th>Pangkat / Golongan</th>
            <th width="40%">Jabatan</th>
            <th><i class="fa fa-group"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($get_temporaryDetailWhereKd as $gtdwk) {
            $id = $gtdwk->id;
            $nip = $gtdwk->nip_nik;
            $nama = $gtdwk->nama;
            $id_skpd = $gtdwk->nunker;
            $jabatan = $gtdwk->jabatan;
            $pangkat_gol = $gtdwk->pangkat_gol;
            $status = $gtdwk->status_pegawai;
            $kode = $gtdwk->kode;
            ?>
            <tr>
                <td><?= $no; ?></td>
                <td>
                    <?php
                    if ($status == 'pns') {
                        echo $nama . "<br>NIP. " . $nip;
                    } else {
                        echo $nama . "<br>NIK. " . $nip;
                    }
                    ?>

                </td>
                <td><?= $pangkat_gol; ?></td>
                <td><?= $jabatan; ?></td>
                <td>
                    <!--<input type="text" id="id" value='<?= $id; ?>'>-->
                    <input type="hidden" id="kode" value='<?= $kode; ?>'>
                    <input type="hidden" id="id_skpd" value='<?= $id_skpd; ?>'>
                    <button type='button' class='btn btn-danger btn-flat  btn-sm btn-block'
                            onclick="hapus_pegawai(<?= $id; ?>)">
                        <i class='fa fa-trash'></i>&nbsp;Hapus</button>
                </td>
            </tr>
    <?php $no++;
} ?>
    </tbody>
</table>

<script>
    function hapus_pegawai(id) {
        var kode = $('#kode').val();
//        alert(id+' - - - '+kode);
        var posting = $.post('<?= base_url() ?>index.php/admin/surat/Nota_dinas/hapusPegawai', {
            id: id,
            kode: kode
        });
        posting.done(function (data) {
            $("#tbl_detail_pgw").html(data);
        })
    }
</script>