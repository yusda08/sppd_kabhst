<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body{
            font-size: 12pt;
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

    </style>
    <body>
        <?php
        foreach ($get_suratTugasSkpdWhereId as $gstswi) {
            $id_ttd_spt = $gstswi->id_ttd_spt;
            $no_nd = $gstswi->no;
            $tgl_nota_dinas = $gstswi->tgl_nota_dinas;
            $perihal = $gstswi->perihal;
            $tujuan = $gstswi->tujuan;
            $dasar = $gstswi->dasar;
            $maksud = $gstswi->maksud;
            $lama = $gstswi->lama;
            $no_spt = $gstswi->no_spt;
            $tgl_spt = $gstswi->tgl_spt;
            $id_spt = $gstswi->id_spt;
            $tgl_berangkat = $gstswi->tgl_berangkat;
            $tgl_kembali = $gstswi->tgl_kembali;
        }
        foreach ($coverSuratTugas as $cov) {
            $kode_skpd = $cov->kode_skpd;
            $alamat = $cov->alamat;
            $no_telpon = $cov->no_telpon;
            $email = $cov->email;
            $kode_pos = $cov->kode_pos;
        }
        foreach ($skpd as $sk) {
            if ($kode_skpd == $sk->kunker) {
                $nm_skpd = $sk->nunker;
            }
        }

        $get_ttdSuratTugas = $this->Data_surat_tugas->get_ttdSuratTugas($id_ttd_spt, $id_skpd, $id_nd);
        foreach ($get_ttdSuratTugas as $gtst) {
            $id_ttd_spt = $gtst->id;
            $jabatan_ttd_spt = $gtst->keterangan;
            $nip_ttd_spt = $gtst->nip;
            $nama_pegawai_ttd_spt = $gtst->nama_pegawai;
        }

        foreach ($get_pegawai as $gp) {
            if ($nip_ttd_spt == $gp->nip) {
                $gol = $gp->NGOLRU;
                $pangkat = $gp->PANGKAT;
            }
        }
        ?>
        <section class="sheet padding-10mm">
            <table repeat_header="1" cellspacing="0"  class="main" width='100%'>
                <?php if ($id_ttd_spt == 3 or $id_ttd_spt == 5) { ?>
                    <tr>
                        <td  rowspan="4" valign='top'>
                    <center>
                        <img src='<?= base_url(); ?>assets/img/logoold.png' width='10%' class="img-responsive">
                    </center>
                    </td>
                    <td width='85%' class="center" style="border-top: 2px;">
                        <span style="font-size: 16pt;font-size: 16pt;margin-top: 0px; margin-bottom: 5px;">PEMERINTAH KABUPATEN HULU SUNGAI TENGAH</span>
                    </td>
                    </tr>
                    <tr>

                        <td class="center" style="border-top: 2px;">
                            <span style="font-size: 14pt;"><?= strtoupper($nm_skpd); ?></span>
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
                <?php } elseif ($id_ttd_spt == 1) { ?>

                    <tr>
                        <td  colspan="2" valign='top'>
                    <center>
                        <img src='<?= base_url(); ?>assets/img/garuda.png' width='12%' class="img-responsive">
                    </center>
                    </td>
                    <tr>
                        <td class="center" colspan="2">
                            <span style="font-size: 16pt;margin-top: 0px; margin-bottom: 5px;">BUPATI HULU SUNGAI TENGAH</span>
                        </td>

                    </tr>
                <?php } elseif ($id_ttd_spt == 2) { ?>

                    <tr>
                        <td  colspan="2" valign='top'>
                    <center>
                        <img src='<?= base_url(); ?>assets/img/garuda.png' width='12%' class="img-responsive">
                    </center>
                    </td>
                    <tr>
                        <td class="center" colspan="2">
                            <span style="font-size: 16pt;font-size: 16pt;margin-top: 0px; margin-bottom: 5px;">WAKIL BUPATI HULU SUNGAI TENGAH</span>
                        </td>

                    </tr>
                <?php } ?>

            </table>
            <hr style="border-bottom: 6px double black;padding: 1;margin-bottom: 1px;margin-top: 0px;">
            <hr style="border-bottom: 6px double black;padding: 1;margin-bottom: 1px;margin-top: 0px;">
            <table repeat_header="1" cellspacing="0" class="main" >
                <tr>
                    <td colspan="8" class="center">
                        <span style="font-size: 20pt;"><u>SURAT TUGAS</u></span>
                        <br><span style="font-size: 12pt;">Nomor : <?= $no_spt; ?></span></td>
                </tr>
                <tr>
                    <td colspan="8" class="center" style="padding: 10px;"></td>
                </tr>
                <tr >
                    <td width="15%" valign="top"><strong>DASAR</strong></td>
                    <td width="3%" valign="top" class=center>:</td>
                    <td colspan="6" align="justify"><?= $dasar; ?></td>
                </tr>
                <tr>
                    <td colspan="8" class="center" style="padding: 8px;"></td>
                </tr>
                <tr>
                    <td colspan="8" class="center" style="">MENUGASKAN :</td>
                </tr>
                <tr>
                    <td colspan="8" class="center" style="padding: 5px;"></td>
                </tr>        
                <tr>
                    <td valign="top" width="15%"><strong>KEPADA</strong></td>
                    <td valign="top" width="3%" class=center>:</td>
                    <td colspan="6">
                        <table  repeat_header="1" border="1" cellspacing="0" class="main padding_3">                                    
                            <tr> 
                                <th>No</th>
                                <th width="40%">Nama / NIP</th>
                                <th>Pangkat / Gol</th>
                                <th>Jabatan</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($get_notaDinasDetailWhereIdNd as $row) {
                                if ($row->status == true) {
                                    ?>
                                    <tr>
                                        <td class="center"><?= $no; ?></td>
                                        <td>
                                            <?=
                                            $row->nama;
                                            if ($row->status_pegawai=='pns') {
                                                echo '<br>NIP. ';
                                            } else {
                                                echo '<br>NIK. ';
                                            }
                                            echo $row->nip_nik;
                                            ?>
                                        </td>
                                        <td class="center"><?= $row->pangkat_gol; ?></td>
                                        <td ><?= $row->jabatan; ?></td>
                                    </tr>    
                                    <?php
                                    $no++;
                                }
                            }
                            ?>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="8" class="center" style="padding: 5px;"></td>
                </tr>   
                <tr >
                    <td width="15%" ><strong>UNTUK</strong></td>
                    <td>:</td>
                    <td colspan="6"><?= $maksud . " di " . $tujuan; ?></td>
                </tr>
                <tr>
                    <td colspan="8" class="center" style="padding: 3px;"></td>
                </tr>   
                <tr>
                    <td ><strong></strong></td>
                    <td width="3%" class=center></td>
                    <td width="25%">Tanggal Berangkat</td>
                    <td>:</td>
                    <td colspan="4"><?= Tgl_indo::indo($tgl_berangkat); ?></td>
                </tr>
                <tr >
                    <td ><strong></strong></td>
                    <td width="3%" class=center></td>
                    <td>Tanggal Kembali</td>
                    <td>:</td>
                    <td colspan="4" align="left"><?= Tgl_indo::indo($tgl_kembali); ?></td>
                </tr>
                <tr >
                    <td ><strong></strong></td>
                    <td width="3%" class=center></td>
                    <td>Lamanya</td>
                    <td>:</td>
                    <td colspan="4" align="left"><?= $lama; ?></td>
                </tr>
                <tr>
                    <td colspan="8" class="center" style="padding: 8px;"></td>
                </tr>  
                <tr >
                    <td ><strong></strong></td>
                    <td width="3%" class=center></td>
                    <td colspan="6">Demikian surat tugas ini dibuat agar dilaksanakan dengan penuh tanggung jawab.</td>
                </tr>
                <tr>
                    <td colspan="8" class="center" style="padding: 8px;"></td>
                </tr>  
                <tr>
                    <td ><strong></strong></td>
                    <td width="3%" class=center></td>
                    <td ></td>
                    <td  class=center></td>
                    <td ></td>
                    <td colspan="3"> Dikeluarkan di Barabai</td>
                </tr>
                <tr>
                    <td ><strong></strong></td>
                    <td width="3%" class=center></td>
                    <td ></td>
                    <td class=center></td>
                    <td ></td>
                    <td colspan="3"><u>Pada Tanggal <?= Tgl_indo::indo($tgl_spt); ?></u></td>
                </tr>
                <tr>
                    <td colspan="8" class="center" style="padding: 10px;"></td>
                </tr>  
                <tr>
                    <td ><strong></strong></td>
                    <td></td>
                    <td></td>
                    <td ></td>
                    <td ></td>
                    <td colspan="3" class='center'><B><?= strtoupper($jabatan_ttd_spt); ?></b></td>
                </tr>
                <tr>
                    <td colspan="8" class="center" style="padding: 30px;"></td>
                </tr> 
                <tr>
                    <td ><strong></strong></td>
                    <td></td>
                    <td ></td>
                    <td  ></td>
                    <td></td>
                    <td colspan="3" class='center'><B><u>
                                <?=
                                strtoupper($nama_pegawai_ttd_spt) . "</b></u><br>";
                                if ($id_ttd_spt != 1 and $id_ttd_spt != 2) {
                                    echo $pangkat . " (" . $gol . ")<br>NIP." . $nip_ttd_spt;
                                }
                                ?></td>
                                </tr>
                                </table>
                                </section>
                                </body>
                                </html>