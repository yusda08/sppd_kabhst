<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;

$action = isset($_REQUEST['surat']) ? $_REQUEST['surat'] : "";
switch ($action) {
    case "masuk":
        ?>
        <section class="content-header alert bg-gray" style=" border-bottom-width: 19px; margin-bottom: 16px;margin-top: 0px;">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if ($tipe == 'alert-danger') {
                        $lambang = 'fa-ban';
                        $notify = 'Gagal!';
                    }
                    if ($msg) {
                        ?>
                        <div class="alert <?php echo $tipe; ?> alert-dismissable" id='notiv'>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa <?php echo $lambang; ?>"></i> <?php echo $notify; ?></h4>
                            <?php echo $msg; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <h1><?php echo strtoupper($page_name); ?></h1>
            <ol class="breadcrumb ">
                <li><a href="#">Surat Masuk</a></li>
                <li class="active">Nota Dinas</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-success">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table  class="tabel_1 table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%"> No</th>
                                    <th> Nomor Surat</th>
                                    <th > Perihal Surat</th>
                                    <th> Tanggal Surat</th>
                                    <th> SKPD</th>
        <!--                                    <th width="5%"> Sebagai</th>
                                    <th width="5%"> Tracking</th>-->
                                    <th width="5%">Dokumen</th>
        <!--                            <th class="text-center" width='5%'><i class="fa fa-cogs"></i></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 1;
                                foreach ($get_setStafAhliWhereId as $sa) {
                                    foreach ($get_suratMasukStafAhli as $row) {
                                        if ($row->tgl_time_disposisi == false) {
                                            foreach ($get_stafAhlittd as $sattd) {
                                                if ($sattd->urutan == $row->urutan - 1 and $sattd->id and $sattd->id_nota == $row->id) {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?php
                                                            echo $n;
                                                            $n++;
                                                            ?></td>
                                                        <td><?= $row->no; ?></td>
                                                        <td><?= $row->perihal; ?></td>
                                                        <td class="text-center"><?= Tgl_indo::indo($row->tgl_nota_dinas); ?></td>
                                                        <td class="text-center">
                                                            <?php
                                                            foreach ($get_skpd as $gs) {
                                                                if ($gs->kunker == $row->id_skpd) {
                                                                    echo $gs->nunker;
                                                                }
                                                            }
                                                            ?>

                                                        </td>
                            <!--                                                        <td class="text-center">
                                                            <button type='button' class='btn btn-success btn-xs btn-block btn-flat' 
                                                                    data-toggle='modal' 
                                                                    data-id='<?= $row->id; ?>'
                                                                    data-isi="<?= $row->isi ?>"
                                                                    data-tgl_time_disposisi="<?= $row->tgl_time_disposisi ?>"
                                                                    data-jabatan="<?= $sa->jabatan ?>"
                                                                    data-id_kew_det="<?= $row->id_kew_det ?>"
                                                                    data-id_kewenangan="<?= $row->id_ref_kewenangan ?>"
                                                                    data-id_ttd='<?= $row->id_ttd; ?>'
                                                                    data-id_skpd='<?= $row->id_skpd; ?>'
                                                                    data-nip_nik="<?= $sa->nip_nik ?>"
                                                                    data-nm_pgw="<?= $sa->nama ?>"
                                                                    data-target='#<?= $row->ket; ?>'><?= $row->ket; ?></button>
                                                        </td>
                                                        <td class='text-center'>
                                                        <?php
                                                        if ($row->format_file != 'application/pdf') {
                                                            echo "<center>
                                    <a class='fancybox' data-fancybox-group='pemakaian_bulanan' href='" . base_url() . "assets/file/" . $row->nama_file . "'>
                                        <img src='" . base_url() . "assets/file/" . $row->nama_file . "' class='img-responsive img-related' width='30 % '>
                                    </a>
                                        </center>";
                                                        } else {
                                                            Echo"<a target='_blank' href='" . base_url() . "index.php/admin/surat/Nota_dinas/download_file/" . $row->nama_file . "'  class = 'btn btn-hover btn-danger btn-xs btn-block'>
                                                    <i class = 'fa fa-download'></i> Pdf</a>";
                                                        }
                                                        ?></td>-->

                                                        <td class='text-center'>
                                                            <form id="form_tambah" method="POST" action="<?= base_url(); ?>index.php/laporan/Laporan_html/formulir_nota_dinas?id_skpd=<?= $row->id_skpd; ?>&id=<?= $row->id; ?>&kewenangan=<?= $row->ket; ?>">
                                                                <input type="hidden" class="form-control" id="nip_nik" name="nip_nik" value="<?= $sa->nip_nik ?>" placeholder="">
                                                                <input type="hidden" class="form-control" id="id_kew_det" name="id_kew_det" value="<?= $row->id_kew_det; ?>" placeholder="">
                                                                <input type="hidden" class="form-control" id="nm_pgw" name="nm_pgw" value="<?= $sa->nama ?>" placeholder="">
                                                                <input type="hidden" class="form-control" id="id_ttd" name="id_ttd" value="<?= $row->id_ttd ?>" placeholder="">
                                                                <input type="hidden" class="form-control" id="url" name="url" value="<?= $url ?>" >
                                                                <button type="submit" target='_blank' type='button' class='btn btn-success btn-flat  btn-xs btn-block'>
                                                                    <i class='fa fa-print'></i> View
                                                                </button>
                                                            </form>                                                    
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>


                </div><!-- /.box-body -->
            </div><!-- /.box -->       
        </section>
        <?php
        break;
    case "keluar":
        ?>
        <section class="content-header alert bg-gray" style=" border-bottom-width: 19px; margin-bottom: 16px;margin-top: 0px;">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    if ($tipe == 'alert-danger') {
                        $lambang = 'fa-ban';
                        $notify = 'Gagal!';
                    }
                    if ($msg) {
                        ?>
                        <div class="alert <?php echo $tipe; ?> alert-dismissable" id='notiv'>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa <?php echo $lambang; ?>"></i> <?php echo $notify; ?></h4>
                            <?php echo $msg; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <h1><?php echo strtoupper($page_name); ?></h1>
            <ol class="breadcrumb ">
                <li><a href="#">Surat Keluar</a></li>
                <li class="active">Nota Dinas</li>
            </ol>
        </section>
        <section class="content">
            <div class="box box-success">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table  class="tabel_1 table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%"> No</th>
                                    <th> Nomor Surat</th>
                                    <th > Perihal Surat</th>
                                    <th> Tanggal Surat</th>
                                    <th> SKPD</th>
                                    <th width="5%"> Sebagai</th>
                                    <th width="5%"> Tracking</th>
                                    <th width="5%">Dokumen</th>
        <!--                            <th class="text-center" width='5%'><i class="fa fa-cogs"></i></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 1;
                                foreach ($get_setStafAhliWhereId as $sa) {
                                    foreach ($get_suratMasukStafAhli as $row) {
                                        if ($row->tgl_time_disposisi) {
                                            foreach ($get_stafAhlittd as $sattd) {
                                                if ($sattd->urutan == $row->urutan - 1 and $sattd->id and $sattd->id_nota == $row->id) {
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?php
                                                            echo $n;
                                                            $n++;
                                                            ?></td>
                                                        <td><?= $row->no; ?></td>
                                                        <td><?= $row->perihal; ?></td>
                                                        <td class="text-center"><?= Tgl_indo::indo($row->tgl_nota_dinas); ?></td>
                                                        <td class="text-center">
                                                            <?php
                                                            foreach ($get_skpd as $gs) {
                                                                if ($gs->kunker == $row->id_skpd) {
                                                                    echo $gs->nunker;
                                                                }
                                                            }
                                                            ?>

                                                        </td>
                                                        <td class="text-center">
                                                            <label class="label label-success" >Terdisposisi</label>
                                                        </td>
                                                        <td class='text-center'>
                                                            <?php
                                                            if ($row->format_file != 'application/pdf') {
                                                                echo "<center>
                                    <a class='fancybox' data-fancybox-group='pemakaian_bulanan' href='" . base_url() . "assets/file/" . $row->nama_file . "'>
                                        <img src='" . base_url() . "assets/file/" . $row->nama_file . "' class='img-responsive img-related' width='30 % '>
                                    </a>
                                        </center>";
                                                            } else {
                                                                Echo"<a target='_blank' href='" . base_url() . "index.php/admin/surat/Nota_dinas/download_file/" . $row->nama_file . "'  class = 'btn btn-hover btn-danger btn-xs btn-block'>
                                                    <i class = 'fa fa-download'></i> Pdf</a>";
                                                            }
                                                            ?></td>
                                                        <td>
                                                            <a href='<?= base_url(); ?>index.php/laporan/Laporan_html/formulir_nota_dinas?id_skpd=<?= $row->id_skpd; ?>&id=<?= $row->id; ?>' target='_blank' type='button' class='btn btn-success btn-flat  btn-xs btn-block'>
                                                                <i class='fa fa-print'></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>


                </div><!-- /.box-body -->
            </div><!-- /.box -->       
        </section>
        <?php
        break;
}
?>

<div class="modal fade" id="Persetujuan" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form id="form_tambah" method="POST" action="<?= base_url() ?>index.php/surat/Surat_masuk_keluar/setuju" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Disposisi : </h4>
                </div>
                <div class="modal-body">
                    <label>Isi Catatan : </label>
                    <textarea class="form-control" id="catatan" name="catatan" placeholder="Isi disposisi "></textarea>
                    <input type="text" class="form-control" id="id" name="id" placeholder="">
                    <input type="text" class="form-control" id="url" name="url" value="<?= $url; ?>">
                </div>
                <div class="modal-footer bg-blue">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off" name='hasil' value="setuju">Setuju</button>
                    <button type="submit"  id="add" class="btn btn-danger" data-loading-text="Loading..." autocomplete="off" name='hasil' value="tolak">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="Disposisi" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form id="form_tambah" method="POST" action="<?= base_url() ?>index.php/surat/Surat_masuk_keluar/aksi" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Disposisi : </h4>
                </div>
                <div class="modal-body">

                    <div class="traickingSurat"></div>
                    <!--<label>Isi Disposisi : </label>-->

                    <!--<textarea class="form-control" id="isi" name="isi" rows="5" placeholder="Isi disposisi "></textarea>-->
                    <input type="hidden" class="form-control" id="nip_nik" name="nip_nik" placeholder="">
                    <input type="hidden" class="form-control" id="id_kew_det" name="id_kew_det" placeholder="">
                    <input type="hidden" class="form-control" id="nm_pgw" name="nm_pgw" placeholder="">
                    <input type="hidden" class="form-control" id="id" name="id" placeholder="">
                    <input type="hidden" class="form-control" id="url" name="url" value="<?= $url; ?>">
                </div>
                <div class="modal-footer bg-blue">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-success" data-loading-text="Loading..." autocomplete="off">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>


    $('#Disposisi').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var nip_nik = button.data('nip_nik');
        var id_asisten = button.data('id_asisten');
        var nm_pgw = button.data('nm_pgw');
        var id_kew_det = button.data('id_kew_det');
        var id_ttd = button.data('id_ttd');
        var id_skpd = button.data('id_skpd');
        var id_kewenangan = button.data('id_kewenangan');
        var modal = $(this);
//        alert(id_kewenangan);
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
        alert(id);
        var modal = $(this);
        modal.find('#id').val(id);
    });

</script>
