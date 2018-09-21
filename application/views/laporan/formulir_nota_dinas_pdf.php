<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body{
            font-size: 11pt;
            text-align: left;
            font-family: ctimes;
        }
        table .main  tr td {
            font-size: 10pt;
            text-align: left;
            padding: 3px;
        }
        table, table .main {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            text-align: left;
        }
        table tr th{
            padding: 3px;
            border-collapse: collapse;
            text-align: center;
        }
        table .padding_8 tr td{
            padding: 8px;
        }
        table .padding_3 tr th{
            padding: 3px;
        }
        table .padding_3 tr td{
            padding: 3px;
        }
        .left {text-align: left;}
        .putus { border-bottom: 1px dotted #666; border-top: 1px dotted #666; }
        .bawah { border-bottom: 0px ; }
        .border-bawah { border-bottom: 2pt ; }
        .atas { border-top: 0px ; }
        .kanan { border-right: 0px ; }
        .kiri { border-left: 0px ; }
        .all { border: 1px solid #666; }
        .center {text-align: center;}
        .form-check{
            display:inline-block; 
            position:relative; 
            width:50px; 
            height:25px;
        }
        img{
            position: relative;
            z-index: 1;
            top: 0px;
        }
        p{
            position: absolute;
            top: 20px;
            z-index: 2;
            color: #000;
        }

    </style>
    <body>

        <?php
        foreach ($get_setSkpdWhereKd as $gsswk) {
            $alamat = $gsswk->alamat;
            $kode_pos = $gsswk->kode_pos;
            $no_telpon = $gsswk->no_telpon;
            $email = $gsswk->email;
        }
        foreach ($skpdWhereKun as $swk) {
            $nama_skpd = $swk->nunker;
        }
        foreach ($get_SetKepalaSkpdWhereKd as $gskswk) {
            $nama_kepala = $gskswk->nama;
            $jabatan_ttd = $gskswk->jabatan;
            $nip_ttd = $gskswk->nip_nik;
            $ttd_kepala = $gskswk->ttd_kepala;
        }

        foreach ($get_notaDinasWhereId as $gndwi) {
            $id_nd = $gndwi->id;
            $no_nd = $gndwi->no;
            $lampiran = $gndwi->lampiran;
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
            $beban_biaya = $gndwi->beban_biaya;
        }
        $get_setAsistenWhereIdSkpdJoinAll = $this->Data_setting->get_setAsistenWhereIdSkpdJoinAll($id_ref_kewenangan, $id_nd);
        $get_disposisiWhereIdNd = $this->Data_notadinas->get_disposisiWhereIdNd($id);
        $get_SetKewenanganTtdWhereId = $this->Data_setting->get_SetKewenanganTtdWhereId($id_ref_kewenangan, $id_nd);
        ?>

        <section class="sheet padding-10mm">
            <table repeat_header="1" cellspacing="0"  class="main" width='100%'>
                <tr>
                    <td  rowspan="4" valign='top'>
                <center>
                    <img src='<?= base_url(); ?>assets/img/logoold.png' width='8%' class="img-responsive">
                </center>
                </td>
                <td width='85%' class="center" style="border-top: 2px;">
                    <span style="font-size: 16pt;font-size: 16pt;margin-top: 0px; margin-bottom: 5px;">PEMERINTAH KABUPATEN HULU SUNGAI TENGAH</span>
                </td>
                </tr>
                <tr>

                    <td class="center" style="border-top: 2px;">
                        <span style="font-size: 14pt;"><?= strtoupper($nama_skpd); ?></span>
                    </td>
                </tr>
                <tr>

                    <td width='85%' class="center" style="border-top: 2px;">
                        <span style="font-size: 11pt;"><?= $alamat; ?></span>
                    </td>
                </tr>
                <tr>

                    <td width='85%' class="center" style="border-top: 2px;">
                        <span style="font-size: 8pt;">No Telp : <?= $no_telpon . " - Kode Pos :" . $kode_pos . " - Email :" . $email; ?> </span>
                    </td>
                </tr>
            </table>
            <hr style="border-bottom: 4px double black;padding: 0;margin-bottom: 0px;margin-top: 2px;">
            <hr style="border-bottom: 4px double black;padding: 0;margin-bottom: 0px;margin-top: 2px;">

            <table repeat_header="1" cellspacing="0" class="main">
                <tr>
                    <td colspan="3" class="center"><h2><u>NOTA DINAS</u></h2></td>
                </tr>
                <tr>
                    <td width='15%' valign='top'>Kepada Yth.</td>
                    <td width='3%'>:</td>
                    <td>
                        <?php
                        foreach ($get_SetKewenanganJoinTtd as $skjt) {
                            if ($id_ref_kewenangan == $skjt->id) {
                                echo ucwords(strtolower($skjt->nama));
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Dari</td>
                    <td>:</td>
                    <td><?= $jabatan_ttd; ?></td>
                </tr>
                <tr>
                    <td valign='top'>Tanggal</td>
                    <td valign='top'>:</td>
                    <td><?= Tgl_indo::indo($tgl_nota_dinas); ?></td>
                </tr>
                <tr>
                    <td valign='top'>Nomor Surat</td>
                    <td valign='top'>:</td>
                    <td><?= $no_nd; ?></td>
                </tr>
                <tr>
                    <td valign='top'>Lampiran</td>
                    <td valign='top'>:</td>
                    <td><?= $lampiran; ?></td>
                </tr>
                <tr>
                    <td valign='top'>Perihal</td>
                    <td valign='top'>:</td>
                    <td style="text-align: justify;"><?= $perihal; ?></td>
                </tr>
            </table>
            <hr style="border-bottom: 1px double black;">
            <table repeat_header="1" cellspacing="0" class="main">
                <tr>
                    <td width='15%'></td>
                    <td valign="top" >A. Dasar</td>
                    <td valign="top" class="center" width="3%" >:</td>
                    <td colspan="2" style="text-align: justify;" ><?= $dasar; ?></td>
                </tr>
                <tr>
                    <td colspan="5" style="padding: 5px;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="4" >B. Untuk Menugaskan Melakukan Perjalanan Dinas :</td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="4">
                        <table repeat_header="1" border='1'  class="main">
                            <tr>
                                <th width='5%'>No</th>
                                <th>Nama</th>
                                <th width='20%'>Pangkat / Gol</th>
                                <th>Jabatan</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($get_notaDinasDetailWhereIdNd as $row) {
                                $id_detail = $row->id;
                                $nip = $row->nip_nik;
                                $nama = $row->nama;
                                $jabatan = $row->jabatan;
                                $pangkat_gol = $row->pangkat_gol;
                                $status_pegawai = $row->status_pegawai;
                                $status = $row->status;
                                ?>
                                <tr>
                                    <td valign="top" class="center"><?= $no; ?>.</td>
                                    <td >
                                        <?php
                                        if ($status_pegawai == 'pns') {
                                            echo $nama . "<br>NIP. " . $nip;
                                        } else {
                                            echo $nama . "<br>NIK. " . $nip;
                                        }
                                        ?>

                                    </td>
                                    <td class="center"><?= $pangkat_gol; ?></td>
                                    <td><?= $jabatan; ?></td>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="padding: 5px;"></td>
                </tr>

                <tr>
                    <td></td>
                    <td colspan="" >C. Tujuan</td>
                    <td class="center" width="3%">:</td>
                    <td colspan="2" style="text-align: justify;" ><?= ucwords(strtolower($tujuan)); ?></td>
                </tr>

                <tr>
                    <td></td>
                    <td colspan="">D. Maksud</td>
                    <td class="center" width="3%">:</td>
                    <td colspan="2" style="text-align: justify;"><?= ucwords(strtolower($maksud)); ?></td>
                </tr>

                <tr>
                    <td></td>
                    <td style="width: 150px;">E. Lamanya</td>
                    <td class="center"> :</td>
                    <td colspan="2"> <?= $lama; ?></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td></td>
                    <td class="center" width="3%"></td>
                    <td width="20%">Tanggal Berangkat</td>
                    <td colspan="">: <?= Tgl_indo::indo($tgl_berangkat); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td class="center"></td>
                    <td> Tanggal Kembali</td>
                    <td colspan="">: <?= Tgl_indo::indo($tgl_kembali); ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 150px;">F. Pembebanan Biaya</td>
                    <td class="center"> :</td>
                    <td colspan="2"> <?= $beban_biaya; ?></td>
                </tr>
                <tr>
                    <td colspan="5" style="padding: 5px;"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="4">Demikian disampaikan dengan hormat, mohon arahan dan persetujuan Bapak.</td>
                </tr>        
                <tr>
                    <td colspan="5" style="padding: 5px;"></td>
                </tr>
                <tr>
                    <td colspan="5" style="padding: 5px;"></td>
                </tr>
                <tr>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td colspan="2" class="center" style="padding-left: 50px ; padding-right: 50px;">
                        <strong><?php
                            if ($id_skpd != '1001000000') {
                                $plt = substr($jabatan_ttd, 0, 3);
                                if (strtoupper($plt) == 'PLT') {
                                    echo $plt . ". " . strtoupper('Kepala');
                                } else {
                                    echo strtoupper('Kepala');
                                }
                            } else {
                                $plt = substr($jabatan_ttd, 0, 3);
                                if (strtoupper($plt) == 'PLT') {
                                    echo $plt . ". " . strtoupper('Sekretaris Daerah');
                                } else {
                                    echo strtoupper('Sekretaris Daerah');
                                }
                            }
                            ?>

                        </strong>
                        <!--                        <br>
                                                <img src='<?= base_url(); ?>assets/img/ttd_kepala/<?= $ttd_kepala ?>' width='30px' hieght="30px">
                                                <p><?= ucwords(strtolower($nama_kepala)); ?>
                                                    <br>NIP. <?= $nip_ttd; ?>
                                                    </p>-->
                    </td>
                </tr>
                <tr>
                    <?php
                    if ($ttd_kepala) {
                        ?>
                        <td ></td>
                        <td ></td>
                        <td ></td>
                        <td colspan="2" class="center" style="padding-left: 50px ; padding-right: 50px;">
                            <img src='<?= base_url(); ?>assets/img/ttd_kepala/<?= $ttd_kepala ?>' width='15%'></td>
                        <?php
                    } else {
                        echo '<td colspan="5" style="padding: 30px;"></td>';
                    }
                    ?>

                </tr>
                <tr>
                    <td ></td>
                    <td ></td>
                    <td ></td>
                    <td colspan="2" class="center" style="padding-left: 50px ; padding-right: 50px;">
                        <!--<strong><u><?= ucwords(strtolower($nama_kepala)); ?></u>-->
                        <strong><u><?= $nama_kepala; ?></u>
                            <br>NIP. <?= $nip_ttd; ?></strong>
                    </td>
                </tr>

            </table>
            <!--//shit1-->

        </section>
    <pagebreak></pagebreak>
    <section class="sheet padding-15mm">
        <table repeat_header="1" cellspacing="0" class="main" width='100%'>
            <?php
            foreach ($get_disposisiWhereIdNd as $row) {
                $tgl_disposisi = $row->tgl_disposisi;
                $urutan = $row->urutan;
                foreach ($get_setAsistenWhereIdSkpdJoinAll as $row1) {
                    if ($urutan == $row1->urutan) {
                        $nip_nik = $row1->nip_nik;
                        $jabatan = $row1->jabatan;
                    } else {
                        $nip_nik = '';
                        $jabatan = $row->nama;
                    }
                }
                ?>
                <tr >
                    <td style="border: 1px solid; background-color:#eae6ea; padding: 5px; "><?= $jabatan; ?> </td>
                </tr>
                <tr>
                    <td style="border: 1px solid; padding-bottom:70px;padding-left:5px;padding-right:5px;padding-top: 5px;"><?= $row->isi; ?></td>
                </tr>
                <tr>
                    <td style="border: 1px solid; padding:5px; ">Tanggal Disposisi :
                        <?php if ($tgl_disposisi != null) { ?>
                            <?= Tgl_indo::indo(substr($tgl_disposisi, 0, 10)) . " At :" . substr($tgl_disposisi, 10, 18); ?>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td class="center" style="padding: 10px;"></td>
                </tr>
                <?php
            }

            foreach ($get_SetKewenanganTtdWhereId as $row) {
                if ($row->status_persetujuan == 0) {
                    ?>
                    <tr>
                        <td style="border: 1px solid; padding:5px; background-color: #eaf5f7"> Persetujuan Dari <?= $row->nama; ?> </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid; padding-bottom:70px;padding-left:5px;padding-right:5px;padding-top: 5px;"></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid; padding:5px;">
                            Tanggal Persetujuan :
                        </td>
                    </tr>
                <?php } elseif ($row->status_persetujuan == 1) { ?>
                    <tr>
                        <td style="border: 1px solid; padding:5px; background-color: #eaf5f7"> Persetujuan Dari <?= $row->nama; ?> </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid; padding-bottom:10px;padding-left:5px;padding-right:5px;padding-top: 5px;">
                            <?= $row->catatan_persetujuan; ?>
                            <br>Dengan Nama / NIP:
                            <?php
                            $no = 1;
                            foreach ($get_notaDinasDetailWhereIdNd as $nddwin) {
                                $id_detail = $nddwin->id;
                                $nip = $nddwin->nip_nik;
                                $nama = $nddwin->nama;
                                $jabatan = $nddwin->jabatan;
                                $pangkat_gol = $nddwin->pangkat_gol;
                                $status_pegawai = $nddwin->status_pegawai;
                                $status = $nddwin->status;
                                if ($status == true) {
                                    ?>
                                    <br>
                                    <label><?=
                                        $no . ".  " . $nama;
                                        if ($status_pegawai == 'pns') {
                                            echo" / NIP.";
                                        } else {
                                            echo" / NIK.";
                                        } echo $nip;
                                        ?> 
                                    </label>
                                    <?php
                                    $no++;
                                }
                            }
                            ?>
                            <br>
                            <p>
                                Tanggal Berangkat   : <?= Tgl_indo::indo($row->tgl_berangkat); ?><br>
                                Tanggal Kembali     : <?= Tgl_indo::indo($row->tgl_kembali); ?><br>
                                Lamanya             : <?= $row->lama; ?>

                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid; padding:5px;">
                            Tanggal Persetujuan : <?= Tgl_indo::indo(substr($row->tgl_persetujuan, 0, 10)) . " At :" . substr($row->tgl_persetujuan, 10, 18); ?>
                        </td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <td style="border: 1px solid; padding:5px; background-color: #eaf5f7"> Persetujuan Dari <?= $row->nama; ?> </td>
                    </tr>
                    <tr>
                        <td class="center" style="border: 1px solid; padding-bottom:10px;padding-left:5px;padding-right:5px;padding-top: 5px; font-size:20pt; ">
                            <?= $row->catatan_persetujuan1; ?> <?= $row->catatan_koreksi; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid; padding:5px;">
                            Tanggal Persetujuan : <?= Tgl_indo::indo(substr($row->tgl_persetujuan, 0, 10)) . " At :" . substr($row->tgl_persetujuan, 10, 18); ?>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>

    </section>
</body>
<script>
    $('#Disposisi').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nip_nik = button.data('nip_nik');
        var id_asisten = button.data('id_asisten');
        var nm_pgw = button.data('nm_pgw');
        var id_kew_det = button.data('id_kew_det');
        var id_kewenangan = button.data('id_kewenangan');
        var id_ttd = button.data('id_ttd');
        var id_skpd = button.data('id_skpd');
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/admin/surat/Nota_dinas/modal_traikingSurat/",
            data: {
                id_skpd: id_skpd,
                id_ttd: id_ttd,
                id_kewenangan: id_kewenangan,
                id: id
            },
            success: function (respont) {
                $('.traickingSurat').html(respont);
            }
        });
        modal.find('#id').val(id);
        modal.find('#nip_nik').val(nip_nik);
        modal.find('#nm_pgw').val(nm_pgw);
        modal.find('#id_kew_det').val(id_kew_det);
        modal.find('#id_asisten').val(id_asisten);
    });

    $('#Persetujuan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var id_skpd = button.data('id_skpd');
        var id_kewenangan = button.data('id_kewenangan');
        var cek = button.data('cek');
        var url = button.data('url');
        //        alert(cek + '-' + id_kewenangan + '-' + id_skpd + '-' + id);
        var modal = $(this);

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/surat/Surat_masuk_keluar/modal_detailNotaDinas/" + id + "/" + id_skpd + "/" + id_kewenangan,
            success: function (respont) {
                $('.notaDinasDetail').html(respont);
            }
        });
        modal.find('#id').val(id);
        modal.find('#url').val(url);
        modal.find('.cek').val(cek);
    });

</script>



<script>
    $(document).ready(function () {
        $('.fancybox').fancybox();
    });
</script>