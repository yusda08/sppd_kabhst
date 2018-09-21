<table  class=" table table-hover table-bordered tbl_nota_dinas">
    <thead>
        <tr>
            <th width="5%"> No </th>
            <th width="20%"> Nomor Surat</th>
            <th>Persetujuan</th>
            <th> Nama SKPD</th>
            <!--<th> id sek</th>-->
            <th>Batas Asisten</th>
            <th>Batas Sekda</th>
            <th>Batas Bup/WaBup</th>
            <th>Jam Sekarang</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($get_notaDinasAll as $row) {
            foreach ($skpd as $sk){
                if($sk->kunker == $row->id_skpd){
                    $nm_skpd = $sk->nunker; 
                }
            }
            $tgl_nota_dinas = $row->tgl_nota_dinas;
            if ($row->status_persetujuan == 0) {
                if ($row->ttd_kepala == 1) {
                    $id = $row->id;
                    $kd_user = $row->kd_user;
                    $id_kew_as = $row->id_kew_as;
                    $id_kew_sek = $row->id_kew_sek;
                    $id_kew = $row->id_ref_kewenangan;
                    $tgl_asisten = $row->tgl_asisten;
                    $tgl_sekda = $row->tgl_sekda;
                    $jam_as = $row->jam_as;
                    $jam_sek = $row->jam_sek;
                    $jam_persetujuan = $row->jam_persetujuan;
                    $jam = $row->tgl_ttd_kepala;
//                $tanggal = substr($row->tgl_ttd_kepala, 0, 10);
//                $jam = substr($row->tgl_ttd_kepala, 10, 16);
//                    $batas = strtotime("+1 HOUR", strtotime($jam));
                    $batas_jam = 'Masih Kosong';
                    $batas_jam_sek = 'Masih Kosong';
                    $batas_jam_persetujuan = 'Masih Kosong';
                    if ($id_kew == 1 or $id_kew == 2) {
                        $batas = strtotime("+" . $jam_as . " HOUR", strtotime($jam));
                        $batas_jam = date('Y-m-d H:i:s', $batas);
                        if ($tgl_asisten != 0) {
                            $batas_sek = strtotime("+" . $jam_sek . " HOUR", strtotime($tgl_asisten));
                            $batas_jam_sek = date('Y-m-d H:i:s', $batas_sek);
                        }
                        if ($tgl_sekda != 0) {
                            $batas_bup_wa = strtotime("+" . $jam_persetujuan . " HOUR", strtotime($tgl_sekda));
                            $batas_jam_persetujuan = date('Y-m-d H:i:s', $batas_bup_wa);
                        }
                    } elseif ($id_kew == 3) {
                        $batas = strtotime("+" . $jam_as . " HOUR", strtotime($jam));
                        $batas_jam = date('Y-m-d H:i:s', $batas);
                        if ($tgl_asisten != 0) {
                            $batas_sek = strtotime("+" . $jam_persetujuan . " HOUR", strtotime($tgl_asisten));
                            $batas_jam_persetujuan = date('Y-m-d H:i:s', $batas_sek);
                        }
                    } elseif ($id_kew == 4) {
                        $batas = strtotime("+" . $jam_persetujuan . " HOUR", strtotime($jam));
                        $batas_jam_persetujuan = date('Y-m-d H:i:s', $batas);
                    }
                    $status_persetujuan = $row->status_persetujuan;
                    $jam_sekarang = date('Y-m-d H:i:s');
                    ?>
                <script>
                    $(document).ready(function () {
                        var status_persetujuan = <?= $status_persetujuan; ?>;
                        var tgl_asisten = '<?= $tgl_asisten; ?>';
                        var tgl_sekda = '<?= $tgl_sekda; ?>';
                        var id_kew_as = <?= $id_kew_as; ?>;
                        var id_kew_sek = <?= $id_kew_sek; ?>;
                        var kd_user = '<?= $kd_user; ?>';
                        var id_nd = <?= $id; ?>;
                        var id_kew = <?= $id_kew; ?>;
                        if (status_persetujuan == 0) {
                            if (id_kew == 1 || id_kew == 2) {
                                if (tgl_asisten == 0) {
                                    if ('<?= $jam_sekarang; ?>' >= '<?= $batas_jam; ?>') {
            //                                            window.location.reload(true);
                                        $.ajax({
                                            type: 'POST',
                                            url: '<?php echo base_url(); ?>index.php/admin/surat/Interval/insert_interval',
                                            data: {id_nd: id_nd, id_kew_as: id_kew_as, kd_user: kd_user},
                                            success: function (data) {
            //                                                    window.location.reload(true);
                                            }
                                        });
            //                                            window.location.reload(true);
                                    }
                                } else if (tgl_asisten != 0 && tgl_sekda == 0) {
                                    if ('<?= $jam_sekarang; ?>' >= '<?= $batas_jam_sek; ?>') {
            //                                            window.location.reload(true);
                                        $.ajax({
                                            type: 'POST',
                                            url: '<?php echo base_url(); ?>index.php/admin/surat/Interval/insert_interval',
                                            data: {id_nd: id_nd, id_kew_sek: id_kew_sek, kd_user: 1},
                                            success: function (data) {
            //                                                    window.location.reload(true);
                                            }
                                        });
            //                                            window.location.reload(true);
                                    }
                                } else if (tgl_asisten != 0 && tgl_sekda != 0) {
                                    if ('<?= $jam_sekarang; ?>' >= '<?= $batas_jam_persetujuan; ?>') {
            //                                            window.location.reload(true);
                                        $.ajax({
                                            type: 'POST',
                                            url: '<?php echo base_url(); ?>index.php/admin/surat/Interval/update_interval',
                                            data: {id_nd: id_nd},
                                            success: function (data) {
            //                                                    window.location.reload(true);
                                            }
                                        });
            //                                            window.location.reload(true);
                                    }
                                }
                            } else if (id_kew == 3) {
                                if (tgl_asisten == 0) {
                                    if ('<?= $jam_sekarang; ?>' >= '<?= $batas_jam; ?>') {
                                        $.ajax({
                                            type: 'POST',
                                            url: '<?php echo base_url(); ?>index.php/admin/surat/Interval/insert_interval',
                                            data: {id_nd: id_nd, id_kew_as: id_kew_as, kd_user: kd_user},
                                            success: function (data) {
            //                                                    window.location.reload(true);
                                            }
                                        });
                                    }
                                } else if (tgl_asisten != 0) {
                                    if ('<?= $jam_sekarang; ?>' >= '<?= $batas_jam_persetujuan; ?>') {
                                        $.ajax({
                                            type: 'POST',
                                            url: '<?php echo base_url(); ?>index.php/admin/surat/Interval/update_interval',
                                            data: {id_nd: id_nd},
                                            success: function (data) {
            //                                                    window.location.reload(true);
                                            }
                                        });
                                    }
                                }
                            } else if (id_kew == 4) {
                                if ('<?= $jam_sekarang; ?>' >= '<?= $batas_jam_persetujuan; ?>') {
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url(); ?>index.php/admin/surat/Interval/update_interval',
                                        data: {id_nd: id_nd},
                                        success: function (data) {
            //                                                window.location.reload(true);
                                        }
                                    });
                                }
                            }
                        }
                    });
                </script>
                <tr>
                    <td><?= $no; ?></td>
                    <td><?= $row->no; ?></td>
                    <!--<td><?= $row->tgl_ttd_kepala; ?></td>-->
                    <!--<td><?= $row->kd_user; ?></td>-->
                    <td class="text-center">
                        <?php
                        if ($row->id_ref_kewenangan == 1) {
                            echo"Bupati";
                        } elseif ($row->id_ref_kewenangan == 2) {
                            echo"Wakil Bupati";
                        } elseif ($row->id_ref_kewenangan == 3) {
                            echo"Sekretaris Daerah";
                        } elseif ($row->id_ref_kewenangan == 4) {
                            echo "Asisten";
                        }
                        ?></td>
                                    <td><?= $nm_skpd; ?></td>
                    <!--<td><?= $row->id_kew_sek; ?></td>-->
                    <?php
                    if ($id_kew == 1 or $id_kew == 2) {
                        echo"<td>" . $batas_jam . "</td>
                <td>" . $batas_jam_sek . "</td>
                <td>" . $batas_jam_persetujuan . "</td>";
                    } elseif ($id_kew == 3) {
                        echo"<td>" . $batas_jam . "</td>
                            <td>" . $batas_jam_persetujuan . "</td>
                <td class='bg-red'></td>";
                    } elseif ($id_kew == 4) {
                        echo"<td>" . $batas_jam_persetujuan . "</td>
                            <td class='bg-red'></td>
                <td class='bg-red'></td>";
                    }
                    ?>

                    <td><?= $jam_sekarang; ?></td>
                </tr>
                <?php
                $no++;
            }
        }
    }
    ?>
</tbody>
</table>
