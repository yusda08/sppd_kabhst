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
}
$get_setAsistenWhereIdSkpdJoinAll = $this->Data_setting->get_setAsistenWhereIdSkpdJoinAll($id_ref_kewenangan, $id_nd);
$get_disposisiWhereIdNd = $this->Data_notadinas->get_disposisiWhereIdNd($id);
$get_SetKewenanganTtdWhereId = $this->Data_setting->get_SetKewenanganTtdWhereId($id_ref_kewenangan, $id_nd);
?>

<div class="book">
    <div class="page">
        <table repeat_header="1" cellspacing="0"  class="main" width='100%'>
            <tr>
                <td  rowspan="4" valign='top'>
            <center>
                <img src='<?= base_url(); ?>assets/img/logoold.png' width='60%' class="img-responsive">
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
        <hr style="border-bottom: 4px double black;padding: 0;margin-bottom: 0px;margin-top: 0px;">
        <table repeat_header="1" cellspacing="0" class="main">
            <tr>
                <td colspan="3" class="center"><h3><u>NOTA DINAS</u></h3></td>
            </tr>
            <tr>
                <td width='15%' valign='top'>Kepada Yth.</td>
                <td valign='top'>:</td>
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
                <td valign='top'>Dari</td>
                <td valign='top'>:</td>
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
                <td style="text-align: justify;" ><?= $perihal; ?></td>
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
                    <table repeat_header="1" border='1px'  cellspacing="0" class="main">
                        <tr>
                            <th>No</th>
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
                                <td valign="top" class="text-center"><?= $no; ?>.</td>
                                <td width='40%'>
                                    <?php
                                    if ($status_pegawai == 'pns') {
                                        echo $nama . "<br>NIP. " . $nip;
                                    } else {
                                        echo $nama . "<br>NIK. " . $nip;
                                    }
                                    ?>

                                </td>
                                <td><?= $pangkat_gol; ?></td>
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
                <td valign='top' colspan="" >C. Tujuan</td>
                <td valign='top' class="center" width="3%">:</td>
                <td colspan="2" style="text-align: justify;" ><?= ucwords(strtolower($tujuan)); ?></td>
            </tr>

            <tr>
                <td></td>
                <td valign='top' colspan="">D. Maksud</td>
                <td valign='top' class="center" width="3%">:</td>
                <td colspan="2" style="text-align: justify;"  ><?= ucwords(strtolower($maksud)); ?></td>
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
                        <img src='<?= base_url(); ?>assets/img/ttd_kepala/<?= $ttd_kepala ?>' width='40%'></td>
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
                    <strong><u><?= ucwords(strtolower($nama_kepala)); ?></u>
                        <br>NIP. <?= $nip_ttd; ?></strong>
                </td>
            </tr>        
        </table>
    </div>
</div>
<!--//shit1-->

<!--//shit2-->
<div class="book">
    <div class="page">
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

        <?php
        $action = isset($_REQUEST['kewenangan']) ? $_REQUEST['kewenangan'] : "";
        switch ($action) {
            case "persetujuan":
                ?>
                <hr>
                <div class="row">
                    <div class="col-lg-3 col-xs-6 pull-right">      
                        <button type='button' class='btn btn-success btn-xs btn-block btn-flat' 
                                data-toggle='modal'
                                data-id='<?= $id; ?>'
                                data-id_skpd='<?= $id_skpd; ?>'
                                data-cek='0'
                                data-url='<?= $_POST['url']; ?>'
                                data-id_kewenangan='<?= $id_ref_kewenangan; ?>'
                                data-target='#Persetujuan'>Persetujuan</button>
                    </div>
                    <div class="col-lg-3 col-xs-6 pull-right">  
                        <?php
                        if ($gndwi->format_file != 'application/pdf') {
                            echo "<center><note>Lampiran File :</note>
<a class='fancybox' data-fancybox-group='pemakaian_bulanan' href='" . base_url() . "assets/file/" . $gndwi->nama_file . "'>
                                        <img src='" . base_url() . "assets/file/" . $gndwi->nama_file . "' class='img-responsive img-related' width='100% '>
</a><note>Klik untuk melihat </note>
                                        </center>";
                        } else {
                            Echo"<a target='_blank' href='" . base_url() . "assets/file/" . $gndwi->nama_file . "'  class = 'btn btn-hover btn-danger btn-xs btn-block'>
                                                    <i class = 'fa fa-download'></i>  Download File Lampiran</a>";
                        }
                        ?>
                    </div>
                    <?php
                    break;
                case 'disposisi':
                    ?>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3 col-xs-6 pull-right">      
                            <button type='button' class='btn btn-success btn-xs btn-block btn-flat' 
                                    data-toggle='modal'
                                    data-id='<?= $id; ?>'
                                    data-id_skpd='<?= $id_skpd; ?>'
                                    data-id_ttd='<?= $_POST['id_ttd']; ?>'
                                    data-id='<?= $row->id; ?>'
                                    data-id_kew_det="<?= $_POST['id_kew_det']; ?>"
                                    data-nip_nik="<?= $_POST['nip_nik']; ?>"
                                    data-nm_pgw="<?= $_POST['nm_pgw']; ?>"
                                    data-id_kewenangan='<?= $id_ref_kewenangan; ?>'
                                    data-target='#Disposisi'>Disposisi</button>
                        </div>
                        <div class="col-lg-3 col-xs-6 pull-right">  
                            <?php
                            if ($gndwi->format_file != 'application/pdf') {
                                echo "<center><note>Lampiran File :</note>
<a class='fancybox' data-fancybox-group='pemakaian_bulanan' href='" . base_url() . "assets/file/" . $gndwi->nama_file . "'>
                                        <img src='" . base_url() . "assets/file/" . $gndwi->nama_file . "' class='img-responsive' width='100% '>
</a>    <note>Klik untuk melihat </note>
                                        </center>";
                            } else {
                                Echo"<a target='_blank' href='" . base_url() . "assets/file/" . $gndwi->nama_file . "'  class = 'btn btn-hover btn-danger btn-xs btn-block'>
                                                    <i class = 'fa fa-download'></i>  Download File Lampiran</a>";
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                    break;
            }
            ?>

        </div>
    </div>
    <div class="modal fade" id="Disposisi" role="dialog" aria-labelledby="editlabel">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <form id="form_tambah" method="POST" action="<?= base_url() ?>index.php/Surat/Surat_masuk_keluar/aksi" enctype="multipart/form-data">
                    <div class="modal-header bg-blue">
                        <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Disposisi : </h4>
                    </div>
                    <div class="modal-body">
                        <div class="traickingSurat"></div>
                        <input type="hidden" class="form-control" id="pendisposisi" name="pendisposisi" value="pendisposisi" placeholder="">
                        <input type="hidden" class="form-control" id="nip_nik" name="nip_nik" placeholder="">
                        <input type="hidden" class="form-control" id="id_kew_det" name="id_kew_det"  placeholder="">
                        <input type="hidden" class="form-control" id="nm_pgw" name="nm_pgw" >
                        <input type="hidden" class="form-control" id="id" name="id">
                        <input type="hidden" class="form-control" id="url" name="url" value="<?= $_POST['url']; ?>">
                        <input type="hidden" class="form-control" id="id_ttd" name="id_ttd" value="<?= $_POST['id_ttd']; ?>" >
                    </div>
                    <div class="modal-footer bg-blue">
                        <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                        <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Persetujuan" role="dialog" aria-labelledby="editlabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="form_setuju" method="POST" action="<?= base_url() ?>index.php/Surat/Surat_masuk_keluar/setuju" enctype="multipart/form-data">
                    <div class="modal-header bg-blue">
                        <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Persetujuan : </h4>
                    </div>
                    <div class="modal-body left">
                        <div class="notaDinasDetail"></div>
                        <input type="hidden" class="form-control" id="id" name="id" placeholder="">
                        <input type="hidden" class="form-control" id="url" name="url" value="<?= $_POST['url']; ?>">
                    </div>
                    <div class="modal-footer bg-blue">
                        <input type = "hidden" class = "form-control" name = "url" id="url" value="<?= base_url(); ?>index.php/Surat/Surat_masuk_keluar/executive.html?surat=masuk">
                        <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                        <button type="button"  id="setuju" class="btn btn-success setuju" data-loading-text="Loading..." autocomplete="off">Setuju</button>
                        <input type="submit" id="setujuHidden" style="display: none;" name='hasil' value="setuju">
                        <button type="submit" id="batal" class="btn btn-danger batal" data-loading-text="Loading..." autocomplete="off" name='hasil' value="tolak">Tolak</button>
                        <button type="submit" id="koreksi" class="btn btn-primary" data-loading-text="Loading..." autocomplete="off" name='hasil' value="koreksi" disabled>Koreksi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        //    $('#Persetujuan').on('show.bs.modal', function (event) {
        //       
        //        alert(cek);
        //        if(add == 'setuju'){
        //        if (cek == 0) {
        //           $('.setuju').attr('disabled', 'disabled');
        //            alert('Pilih Dulu Pegawai Sebelum Menyetujui');
        //        }else{
        //            alert('berhasil');
        //        }
        //    }
        //    });
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
                url: "<?php echo base_url(); ?>index.php/Surat/Surat_masuk_keluar/modal_detailNotaDinas/" + id + "/" + id_skpd + "/" + id_kewenangan,
                success: function (respont) {
                    $('.notaDinasDetail').html(respont);
                }
            });
            modal.find('#id').val(id);
            modal.find('#url').val(url);
            modal.find('.cek').val(cek);
        });

    </script>