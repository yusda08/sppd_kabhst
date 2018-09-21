<?php
foreach ($get_notaDinasWhereId as $gndwi) {
    $id_nd = $gndwi->id;
    $no_nd = $gndwi->no;
    $lampiran = $gndwi->lampiran;
    $email_skpd = $gndwi->email_skpd;
    $tgl_nota_dinas = $gndwi->tgl_nota_dinas;
    $perihal = $gndwi->perihal;
    $tujuan = $gndwi->tujuan;
    $id_ref_tujuan = $gndwi->id_ref_tujuan;
    $id_ref_kewenangan = $gndwi->id_ref_kewenangan;
    $dasar = $gndwi->dasar;
    $tgl_berangkat = $gndwi->tgl_berangkat;
    $tgl_kembali = $gndwi->tgl_kembali;
    $maksud = $gndwi->maksud;
    $lama = $gndwi->lama;
    $narasi = $gndwi->narasi;
    $nama_file = $gndwi->nama_file;
}


//foreach ($get_disposisiWhereIdNd as $gswin) {
//    $tgl_disposisi = $gswin->tgl_disposisi;
//    $urutan = $gswin->urutan;
//    $jabatan = $gswin->nama;
//    foreach ($get_setAsistenWhereIdSkpdJoinAll as $row1) {
//        if ($urutan == $row1->urutan) {
//            $nip_nik = $row1->nip_nik;
//            $jabatan = $row1->jabatan;
//        }
//    }
//    
?>
<!--    <div class="row">
        <div class="col-md-12">
            <label>Disposisi //<?= $urutan; ?></label><br>
            <label>//<?= $jabatan; ?></label>
            <textarea readonly class="form-control" rows="3">//<?= $gswin->isi; ?></textarea>
            //<?php if ($tgl_disposisi != null) { ?>
                            <label>//<?= Tgl_indo::indo(substr($tgl_disposisi, 0, 10)) . " At :" . substr($tgl_disposisi, 10, 18); ?></label>
                        //<?php } ?>
            <hr>
        </div>
    </div>-->
<?php // }  ?>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-3">
            <label class="text-left">Perihal</label>
        </div>
        <div class="col-md-9">
            <label><?= $perihal; ?></label>
        </div>
        <div class="col-md-3">
            <label>Tujuan</label>
        </div>
        <div class="col-md-9">
            <label><?= $tujuan; ?></label>
        </div>
        <div class="col-md-3">
            <label>Maksud</label>
        </div>
        <div class="col-md-9">
            <label><?= $maksud; ?></label>
            <hr>
        </div>

    </div>
</div>
<table class="table table-hover table-striped table-bordered table-condensed ">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama / NIP</th>
            <th>Pangkat / Golongan</th>
            <th>Jabatan</th>
            <th><i class="fa fa-group"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($get_notaDinasDetailWhereIdNd as $row) {
            $nunker = $row->nunker; 
            $id_detail = $row->id;
            $id_nota_dinas = $row->id_nota_dinas;
            $nip = $row->nip_nik;
            $nama = $row->nama;
            $jabatan = $row->jabatan;
            $pangkat_gol = $row->pangkat_gol;
            $status = $row->status_pegawai;
            $status_1 = $row->status;
            $chek = 'checked';
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
                <td>
                    <?= $jabatan; ?><br>
                    <?php foreach ($get_skpd as $sk){
                       if($nunker == $sk->kunker){
                           echo "(".$sk->nunker.")";
                        }
                    }
                    ?>
                    
                </td>
                <td class="text-center">
                    <input width="20%"   value='0' id='pilih<?= $id_detail; ?>' type="checkbox" class="form-check" name="status_cek<?= $no; ?>" onClick="
                            var pilih = $('#pilih<?= $id_detail; ?>').val();
                            $('#status<?= $id_detail; ?>').val(0);
                            var cek = $('#cek').val();
                            if (pilih == 0) {
                                $('#status<?= $id_detail; ?>').val(1);
                                $('#pilih<?= $id_detail; ?>').val(1)
                                $('#cek').val(parseInt(cek) + 1);
                            } else {
                                $('#status<?= $id_detail; ?>').val(0);
                                $('#pilih<?= $id_detail; ?>').val(0)
                                $('#cek').val(parseInt(cek) - 1);
                            }" >
                    <input type="hidden" value="0" name="status_cek[]" id='status<?= $id_detail; ?>' required>
                    <input type="hidden" name="id_detail_nd[]" value="<?= $id_detail; ?>">
                    <!--<input type="text" name="id_nota_dinas" value="<?= $id_nota_dinas; ?>">-->
                </td>
            </tr>
            <?php
            $no++;
        }
        ?>
    </tbody>
    <input type="hidden" value="0" name='cek' id='cek' required>
</table>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-4">
            <label>Tanggal Berangkat</label>
        </div>
        <div class="col-md-8">
            <input class="form-control" type="date" name="tgl_berangkat" id="tgl_berangkat" value="<?= $tgl_berangkat; ?>" required>
        </div>
        <div class="col-md-4">
            <label>Tanggal Kembali</label>
        </div>
        <div class="col-md-8">
            <input class="form-control" type="date" name="tgl_kembali" id="tgl_kembali" value="<?= $tgl_kembali; ?>" required>
        </div>
        <div class="col-md-4">
            <label>Lamanya</label>
        </div>
        <div class="col-md-8">
            <input class="form-control" type="text" name="lamanya" id="lamanya" value="<?= $lama; ?>" readonly required>
        </div>
        <input class="form-control" type="hidden" name="penerima" id="penerima" value="<?= $email_skpd; ?>" readonly required>
    <?php if($catatan == 'persetujuan'){ ?>    
    <div class="col-md-12">
            <label>Catatan Koreksi</label>
            <textarea class="form-control" type="text" name="ctt_koreksi" id="ctt_koreksi" placeholder="catatan jika diperlukan"></textarea>
        </div>
    <?php } ?>
    </div>
</div>


<script type="text/javascript">

    $('.setuju').click(function () {
        var cek = $('#cek').val();
        if (cek == 0) {
            alert('Ceklist Terlebih Dahulu Nama Pegawai Sebelum Memberi Persetujuan');
        } else {
            $("#setujuHidden").click();
        }
    });

//    $(function () {
//        var add = $('.setuju').val();
//        var cek = $('#cek').val();
//        alert(add);
//        if(add == 'setuju'){
//        if (cek == 0) {
//            $('.setuju').attr('disabled', 'disabled');
//        }else if (cek == 0){
//            $('.setuju').removeAttr('disabled', 'disabled');
//        }
//    }
//    });
//        $('.input').iCheck({
//            checkboxClass: 'icheckbox_square-blue',
//            radioClass: 'iradio_square-blue',
//            increaseArea: '20%' // optional
//            
//            
//        });
//    });

    $('#tgl_berangkat').after('<span class="statustgl_berangkat"></span>').css('margin-right', '10px');
    $('#tgl_berangkat').keyup(function () {
        $(this).css({'border': '1px solid #ccc', 'background': 'none'});
    });
    $('#tgl_kembali').after('<span class="status"></span>').css('margin-right', '10px');
    $('#tgl_kembali').keyup(function () {
        $(this).css({'border': '1px solid #ccc', 'background': 'none'});
    });
    $('#tgl_berangkat, #tgl_kembali').on('change', function () {
        var tgl_berangkat = $('#tgl_berangkat').val();
        var tgl_kembali = $('#tgl_kembali').val();
        if (tgl_berangkat != '') {
            if (tgl_kembali >= tgl_berangkat) {
                var hari = 24 * 60 * 60 * 1000;
                var tgl1 = new Date(tgl_berangkat);
                var tgl2 = new Date(tgl_kembali);
//                 alert(tgl1);
                var diff = Math.round(Math.round(tgl2.getTime() - tgl1.getTime()) / (hari));
                $('#lamanya').val(diff + 1 + ' Hari');
                $('.status').html('');
                $('#tgl_kembali').css({background: 'none'});
                $('#tgl_berangkat').css({background: 'none'});
                $('.setuju').removeAttr("disabled", "disabled");
                $('.batal').removeAttr("disabled", "disabled");
            } else {
                $('.status').html('<img src="<?php echo base_url(); ?>/assets/img/false.png"><b style="color:red;">Tanggal Kembali Tidak Boleh Kurang Dari Tanggal Berangkat</b>');
//                $('.statustgl_berangkat').html('<img src="<?php echo base_url(); ?>/assets/img/false.png"><b style="color:red;">Tanggal Kembali Tidak Boleh Kurang Dari Tanggal Berangkat</b>');
                $('.setuju').attr('disabled', 'disabled');
                $('.batal').attr('disabled', 'disabled');
            }
        } else {
            alert('Tanggal Berangkat Tidak Boleh Kosong');
        }
    });
    

    $('#ctt_koreksi').bind('input propertychange', function() {
        if ($.trim($('#ctt_koreksi').val()).length < 1) {
            $("#setuju").removeAttr("disabled");
            $("#koreksi").attr("disabled", true);
            
        } else {
            $("#setuju").attr("disabled", true);
            $("#koreksi").removeAttr("disabled");
        }
    });

</script>