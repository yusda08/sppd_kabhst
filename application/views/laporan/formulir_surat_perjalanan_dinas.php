<?php
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

foreach ($skpdWhereKun as $swk) {
    $nunker = $swk->nunker;
}
foreach ($get_suratPerjalananDinasWhereSpd as $row) {
    $no_spt = $row->no_spt;
    $nm_pgw = $row->nama;
    $nip_nik = $row->nip_nik;
    $id_skpd = $row->id_skpd;
    $pangkat_gol = $row->pangkat_gol;
    $status_pegawai = $row->status_pegawai;
    $jabatan = $row->jabatan;
    $maksud = $row->maksud;
    $tujuan = $row->tujuan;
    $dari = $row->dari;
    $lama = $row->lama;
    $tgl_berangkat = $row->tgl_berangkat;
    $tgl_kembali = $row->tgl_kembali;
    $alat_angkut = $row->alat_angkut;
    $no_dpa = $row->no_dpa;
    $kode_rek = $row->kode_rekening;
    $ttd_spt = $row->id_ttd_spt;
    $nama_skpd = $row->nama_skpd;
}

foreach ($skpd as $sk1) {
    if ($id_skpd == $sk1->kunker) {
        $nm_skpd_pembuat = $sk1->nunker;
    }
}

//if ($ttd_spt != 5) {
    foreach ($get_sekda as $ttd) {
        $jabatan_ttd = $ttd->jabatan;
        $nama_ttd = $ttd->nama;
        $nip_ttd = $ttd->nip_nik;
    }
    foreach ($get_pegawai as $gp) {
        if ($nip_ttd == $gp->nip) {
            $got_ttd = $gp->NGOLRU;
            $pangkat_ttd = $gp->PANGKAT;
        }
    }
//} else {
//    foreach ($get_ttdSuratTugas as $ttdst) {
//        $jabatan_ttd = $ttdst->keterangan;
//        $nama_ttd = $ttdst->nama_pegawai;
//        $nip_ttd = $ttdst->nip;
//    }
//    foreach ($get_pegawai as $gp) {
//        if ($nip_ttd == $gp->nip) {
//            $got_ttd = $gp->NGOLRU;
//            $pangkat_ttd = $gp->PANGKAT;
//        }
//    }
//    var_dump($get_ttdSuratTugas);
//    return;
//}
?>
<section class="sheet padding-10mm">
    <table repeat_header="1"  cellspacing="0"  class="main" width='100%'>
        <tr>
            <td  rowspan="3" valign='top' colspan="3" width='5%' >
        <center>
            <img src='<?= base_url(); ?>assets/img/logoold.png' class="img-responsive">
        </center>
        </td>
        <td class="center" style="border-top: 2px;" colspan="11">
            <span style="font-size: 16pt;font-size: 16pt;margin-top: 0px; margin-bottom: 5px;">PEMERINTAH KABUPATEN HULU SUNGAI TENGAH</span>
        </td>
        <td class="center" width='2%'></td>
        <td class="center top b_right b_left" style="padding:5px;" colspan="3" width='18%' ></td>
        <td class="top" width='8%' style="padding:5px;">Berangkat Dari</td>
        <td class=" top" width='1%'style="padding:5px;">:</td>
        <td class="top b_right" width='9%' style="padding:5px;"><?=$dari;?></td>
        </tr>
        <tr>

            <td class="center" colspan="11">
                <span style="font-size: 14pt;"><?= strtoupper($nm_skpd); ?></span></td>
            <td class="center"></td>
            <td class="center b_right b_left"  colspan="3" ></td>
            <td class="" style="padding:5px;">Ke</td>
            <td class="" style="padding:5px;">:</td>
            <td class="b_right"style="padding:5px;" ><?= $tujuan;?></td>
        </tr>
        <tr>
            <td class="center" colspan="11">
                <span style="font-size: 11pt;"><?= $alamat; ?></span>
            </td>
            <td class="center"width='2%'></td>
            <td class="center bottom b_right b_left"  colspan="3" ></td>
            <td class="bottom" style="padding:5px;">Pada Tanggal</td>
            <td class="bottom" style="padding:5px;" >:</td>
            <td class=" bottom b_right" style="padding:5px;"><?= Tgl_indo::indo($tgl_berangkat); ?></td>
        </tr>
        <tr>
            <td class="center" colspan="14">No Telp : <?= $no_telpon . " - Kode Pos :" . $kode_pos . " - Email :" . $email; ?><hr style="border-bottom: 4px double black;padding: 0;margin-bottom: 0px;margin-top: 0px;"></td>
            <td class="center"width='2%'></td>
            <td class="b_left" style="padding:5px;" width='8%'> Tiba di</td>
            <td class="" > :</td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left" style="padding:5px;">Berangkat Dari</td>
            <td class=""  style="padding:5px;">:</td>
            <td class=" b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td colspan="3" width='5%'>Lembar Ke</td>
            <td class="" width='2%'>:</td>
            <td class="" width='8%'></td>
            <td class="" width='4%'>Kode</td>
            <td class="" width='2%'>:</td>
            <td class="" width='8%'></td>
            <td class="" width='3%' colspan="2">Nomor</td>
            <td class="" width='1%'>:</td>
            <td class="" colspan="2" ><?= $no_spt; ?></td>
            <td class="center" width='2%'></td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;"> Pada Tanggal</td>
            <td class="" width='1%'> :</td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left"style="padding:5px;" >Ke</td>
            <td class=""  >:</td>
            <td class=" b_right"style="padding:5px;" ></td>
        </tr>
        <tr>
            <td class="center" colspan="13" style="font-size: 12pt;"><b>SURAT PERJALANAN DINAS (SPD)</b></td>
            <td class="center"></td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;"> Kepala</td>
            <td class="" width='1%'> :</td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left" style="padding:5px;">Pada Tanggal</td>
            <td class=""  >:</td>
            <td class=" b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td class="center all"style="padding:5px;" width="1%">1</td>
            <td class="all" style="padding:5px;" colspan="7">Pejabat Yang Berwenang</td>
            <td class="all" style="padding:5px;" colspan="6"><?= $jabatan_ttd; ?></td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;"></td>
            <td class="" width='1%'></td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left" style="padding:5px;">Kepala</td>
            <td class=""  ></td>
            <td class=" b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td class="center all"style="padding:5px;" width="1%">2</td>
            <td class="all" style="padding:5px;" colspan="7">Nama / NIP Pegawai Yang Melaksanakan Perjalanan Dinas</td>
            <td class="all" style="padding:5px;" colspan="6"><?php
                if ($status_pegawai == 'pns') {
                    echo $nm_pgw . " / NIP . " . $nip_nik;
                } else {
                    echo $nm_pgw;
                }
                ?></td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;"></td>
            <td class="" width='1%'></td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left" style="padding:5px;"></td>
            <td class=""  ></td>
            <td class=" b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td valign="top" class="center all" rowspan="2" style="padding:5px;" width="1%">3</td>
            <td valign="top" class="" style="padding:5px;">a.</td>
            <td valign="top" class="" style="padding:5px;" colspan="6">Pangkat dan Golongan</td>
            <td class="b_right b_left" style="padding:5px;" colspan="6">a. <?= $pangkat_gol; ?></td>
            <td class="center" width='2%'></td>
            <td class="bottom b_left" style="padding:5px;"></td>
            <td class="bottom" width='1%'></td>
            <td class="bottom b_right" style="padding:5px;"></td>
            <td class="b_left bottom" style="padding:5px;"></td>
            <td class="bottom"  ></td>
            <td class="bottom b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td valign="top" class="bottom" style="padding:5px;" width="2%">b.</td>
            <td valign="top" class="bottom" style="padding:5px;" colspan="6">Jabatan / Instansi</td>
            <td valign="top" class="bottom  b_right b_left" style="padding:5px;text-align: justify" colspan="6">b. <?= ucwords(strtolower($jabatan)) . " / " . $nm_skpd_pembuat; ?></td>
            <td class="center" width='2%'></td>
            <td class=" b_left" style="padding:5px;">Tiba di
                <br>
                Pada Tanggal </td>
            <td class="" width='1%'> :<br>:</td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left" style="padding:5px;">Berangkat dari<br>Ke</td>
            <td class=""  >:<br>:</td>
            <td class="b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td valign="top"  class="center all"style="padding:5px;" width="1%">4</td>
            <td valign="top" class="all" style="padding:5px;" colspan="7">Maksud Perjalanan Dinas</td>
            <td valign="top" class="all" style="padding:5px;text-align: justify" colspan="6"><?= $maksud; ?></td>
            <td class="center" width='2%'></td>
            <td valign="top" class="b_left" style="padding:5px;">Kepala </td>
            <td class="" width='1%'>:</td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left" style="padding:5px;">Pada Tanggal <br> Kepala</td>
            <td class=""  >:<br>:</td>
            <td class=" b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td valign="top"  class="center all"style="padding:5px;" width="1%">5</td>
            <td valign="top" class="all" style="padding:5px;" colspan="7">Alat Angkut yang dipergunakan</td>
            <td class="all" style="padding:5px;" colspan="6"><?= str_replace(";", ", ", $alat_angkut); ?>
            </td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;"></td>
            <td class="" width='1%'></td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left" style="padding:5px;"></td>
            <td class=""></td>
            <td class="b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td valign="top" class="center all" rowspan="2" style="padding:5px;" width="1%">6</td>
            <td valign="top" class="" style="padding:5px;">a.</td>
            <td valign="top" class="" style="padding:5px;" colspan="6">Tempat Berangkat</td>
            <td class="b_right b_left" style="padding:5px;" colspan="6">a. <?=$dari;?></td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;"></td>
            <td class="" width='1%'></td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left" style="padding:5px;"></td>
            <td class=""></td>
            <td class="b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td valign="top" class="bottom" style="padding:5px;">b.</td>
            <td valign="top" class="bottom" style="padding:5px;" colspan="6">Tempat Tujuan</td>
            <td class="b_right b_left bottom" style="padding:5px;" colspan="6">b. <?= $tujuan; ?></td>
            <td class="center" width='2%'></td>
            <td class="bottom b_left" style="padding:5px;"></td>
            <td class="bottom" width='1%'></td>
            <td class="bottom b_right" style="padding:5px;"></td>
            <td class="bottom b_left" style="padding:5px;"></td>
            <td class="bottom"></td>
            <td class="bottom b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td valign="top" class="center all" rowspan="3" style="padding:5px;" width="1%">7</td>
            <td valign="top" class="" style="padding:5px;">a.</td>
            <td valign="top" class="" style="padding:5px;" colspan="6">Lamanya Perjalanan Dinas</td>
            <td class="b_right b_left" style="padding:5px;" colspan="6">a. <?= $lama; ?></td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;"> Tiba di</td>
            <td class="" > :</td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left" style="padding:5px;">Berangkat Dari</td>
            <td class="">:</td>
            <td class=" b_right" style="padding:5px;"></td>

        </tr>
        <tr>
            <td valign="top" class="" style="padding:5px;">b.</td>
            <td valign="top" class="" style="padding:5px;" colspan="6">Tanggal Berangkat</td>
            <td class="b_right b_left " style="padding:5px;" colspan="6">b. <?= Tgl_indo::indo($tgl_berangkat); ?></td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;"> Pada Tanggal</td>
            <td class="" width='1%'> :</td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left"style="padding:5px;" >Ke</td>
            <td class=""  >:</td>
            <td class=" b_right"style="padding:5px;" ></td>
        </tr>
        <tr>
            <td valign="top" class="bottom" style="padding:5px;">c.</td>
            <td valign="top" class="bottom" style="padding:5px;" colspan="6">Tanggal harus kembali / tiba di tempat baru *)</td>
            <td class="b_right b_left bottom" style="padding:5px;" colspan="6">c. <?= Tgl_indo::indo($tgl_kembali); ?></td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;"> Kepala</td>
            <td class="" > :</td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left" style="padding:5px;">Pada Tanggal</td>
            <td class="">:</td>
            <td class=" b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td class="center all"style="padding:5px;" width="1%">8</td>
            <td class="bottom" style="padding:5px;" colspan="4">Pengikut :</td>
            <td class="bottom b_right" style="padding:5px;" colspan="3">Nama</td>
            <td class="bottom b_right center" style="padding:5px;" colspan="4" width='15%'>Tanggal Lahir</td>
            <td class="bottom b_right center" style="padding:5px;" colspan="2" width='15%'>KET</td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;"></td>
            <td class="" width='1%'></td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left"style="padding:5px;" >Kepala</td>
            <td class=""  >:</td>
            <td class=" b_right"style="padding:5px;" ></td>
        </tr>
        <tr>
            <td class="center all"style="padding:5px;" width="1%" rowspan="2"></td>
            <td class="" style="padding:5px;" colspan="4">1.</td>
            <td class=" b_right" style="padding:5px;" colspan="3"></td>
            <td class=" b_right center" style="padding:5px;" colspan="4" width='15%'></td>
            <td class=" b_right center" style="padding:5px;" colspan="2" width='15%'></td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;"></td>
            <td class="" width='1%'></td>
            <td class="b_right" style="padding:5px;"></td>
            <td class="b_left"style="padding:5px;" ></td>
            <td class=""  ></td>
            <td class=" b_right"style="padding:5px;" ></td>
        </tr>
        <tr>
            <td class="bottom" style="padding:5px;" colspan="4">2.</td>
            <td class="bottom b_right" style="padding:5px;" colspan="3"></td>
            <td class="bottom b_right center" style="padding:5px;" colspan="4" width='15%'></td>
            <td class="bottom b_right center" style="padding:5px;" colspan="2" width='15%'></td>
            <td class="center" width='2%'></td>         
            <td class="bottom b_left" style="padding:5px;"></td>
            <td class="bottom" width='1%'></td>
            <td class="bottom b_right" style="padding:5px;"></td>
            <td class="bottom b_left" style="padding:5px;"></td>
            <td class="bottom"  ></td>
            <td class="bottom b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td class="center all"style="padding:5px;" width="1%">9</td>
            <td class="all" style="padding:5px;" colspan="7">Pembebanan Anggaran</td>
            <td class="bottom b_right center" style="padding:5px;" colspan="6" width='15%'></td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;">Tiba di</td>
            <td class="" width='1%'>:</td>
            <td class="" style="padding:5px;"></td>
            <td class="" style="padding:5px;"></td>
            <td class=""  ></td>
            <td class=" b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td class="center all"style="padding:5px;" width="1%" rowspan="2"></td>
            <td class="b_right" style="padding:5px;" colspan="7">a. PD / SKPD</td>
            <td class="b_right" style="padding:5px;" colspan="6" width='15%'>a. <?=$nama_skpd;?></td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;" colspan="3">(Tempat Kedudukan)</td>
            <td class="" style="padding:5px;"></td>
            <td class=""></td>
            <td class=" b_right" style="padding:5px;"></td>
        </tr>
        <tr>
            <td class="b_right bottom" style="padding:5px;" colspan="7">b. Kode belanja : Program/Kegiatan/Belanja</td>
            <td class="bottom b_right" style="padding:5px;" colspan="6" width='15%'>b. <?= $no_dpa." / ".$kode_rek;?></td>
            <td class="center" width='2%'></td>
            <td class="b_left" style="padding:5px;">Pada Tanggal </td>
            <td class="" width='1%'>:</td>
            <td class="" style="padding:5px;"></td>
            <td class="" style="padding:5px;"></td>
            <td class=""  ></td>
            <td class="b_right" style="padding:5px;"></td>

        </tr>
        <tr>
            <td class="center"style="padding:20px;" width="1%" colspan="14"></td>
            <td class="center"style="padding:5px;" width="1%" ></td>
            <td class="b_right b_left" style="padding:5px;text-align: justify;" colspan="6" rowspan="2">
                Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan waktu yang sesingkat-singkatnya.
            </td>
        </tr>
        <tr>
            <td class="center" width="1%"></td>
            <td class="" colspan="7"></td>
            <td class="" style="" colspan="6" width='15%'>Dikeluarkan di Barabai</td>
        </tr>
        <tr>
            <td class="center"style="padding:5px;" width="1%"></td>
            <td class="" style="padding:5px;" colspan="7"></td>
            <td class="" style="" colspan="6" width='15%'>Tanggal : <?= Tgl_indo::indo(date('Y-m-d')); ?></td>
            <td class="center"style="padding:5px;" width="1%" ></td>
            <td class="center b_left b_right" style="padding:5px;" colspan="6"> </td>
        </tr>
        
        <tr>
            <td class="center"style="padding:5px;" width="1%"></td>
            <td class="" style="padding:5px;" colspan="7"></td>
            <td class="center" style="padding:5px;" colspan="6" width='15%'>
                <?php  echo "Sekretaris Daerah";  ?></td>
            <td class="center"style="padding:5px;" width="1%" ></td>
            <td class="center b_left b_right" style="padding:5px;" colspan="6"> 
                <?php echo "Sekretaris Daerah"; ?></td>
        </tr>
<!--        <tr>
            <td class="center"style="padding:5px;" width="1%"></td>
            <td class="" style="padding:5px;" colspan="7"></td>
            <td class="center" style="padding:5px;" colspan="6" width='15%'>
                <?php 
                if ($ttd_spt != 5) { echo "Pengguna Anggaran"; }else{ echo "Pejabat yang ditunjuk"; } ?></td>
            <td class="center"style="padding:5px;" width="1%" ></td>
            <td class="center b_left b_right" style="padding:5px;" colspan="6"> <?php 
                if ($ttd_spt != 5) { echo "Pengguna Anggaran"; }else{ echo "Pejabat yang ditunjuk"; } ?></td>
        </tr>-->
        <tr>
            <td class="center"style="padding:10px;" width="1%"></td>
            <td class="" style="padding:5px;" colspan="7"></td>
            <td class="center" style="padding:5px;" colspan="6" width='15%'></td>
            <td class="center"style="padding:5px;" width="1%"></td>
            <td class="center b_left b_right"style="padding:5px;" width="1%" colspan="6" ></td>
        </tr>
        <tr>
            <td class="center"style="padding:10px;" width="1%"></td>
            <td class="" style="padding:5px;" colspan="7"></td>
            <td class="center" style="padding:5px;" colspan="6" width='15%'></td>
            <td class="center"style="padding:5px;" width="1%"></td>
            <td class="center b_left b_right"style="padding:5px;" width="1%" colspan="6" ></td>
        </tr>
        <tr>
            <td class="center"style="padding:10px;" width="1%"></td>
            <td class="" style="padding:5px;" colspan="7"></td>
            <td class="center" style="padding:5px;" colspan="6" width='15%'></td>
            <td class="center"style="padding:5px;" width="1%"></td>
            <td class="center b_left b_right"style="padding:5px;" width="1%" colspan="6" ></td>
        </tr>
        <tr>
            <td class="center"style="padding:5px;" width="1%"></td>
            <td class="" style="padding:5px;" colspan="7"></td>
            <td class="center" style="" colspan="6" width='15%'><b><?= $nama_ttd; ?></b></td>
            <td class="center"style="padding:5px;" width="1%" ></td>
            <td class="center b_left b_right" style="" colspan="6"><b><?= $nama_ttd; ?></b></td>
        </tr>
        <tr>
            <td class="center"style="padding:5px;" width="1%"></td>
            <td class="" style="padding:5px;" colspan="7"></td>
            <td class="center" style="" colspan="6" width='15%'><b>NIP.<?= $nip_ttd; ?></b></td>
            <td class="center"style="padding:5px;" width="1%" ></td>
            <td class="center b_left b_right bottom" style="" colspan="6"><b>NIP.<?= $nip_ttd; ?></b></td>
        </tr>
    </table>
</section>