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
        <!--                                    <th width="5%"> Nota Dinas</th>
                                    <th width="5%"> Lampiran</th>-->
                                    <th width="5%">Aksi</th>
        <!--                            <th class="text-center" width='5%'><i class="fa fa-cogs"></i></th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 1;
                                foreach ($get_SetExecutiveWhereId_exe as $getse) {
                                    foreach ($get_suratMasukExe as $row) {
                                        if ($row->status_persetujuan == 0 and ( $row->jum_nota - $row->jum_dis) <= 0) {
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
                    <!--                                                <td class="text-center">
                                                    <button type='button' class='btn btn-success btn-xs btn-block btn-flat' 
                                                            data-toggle='modal' 
                                                            data-id='<?= $row->id; ?>'
                                                            data-jabatan="<?= $getse->jabatan ?>"
                                                            data-id_skpd='<?= $row->id_skpd; ?>'
                                                            data-id_kewenangan='<?= $row->id_kewenangan; ?>'
                                                            data-nip_nik="<?= $getse->id ?>"
                                                            data-nm_pgw="<?= $getse->nama ?>"
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
                                                <td>
                                                    <form id="form_tambah" method="POST" action="<?= base_url(); ?>index.php/laporan/Laporan_html/formulir_nota_dinas?id_skpd=<?= $row->id_skpd; ?>&id=<?= $row->id; ?>&kewenangan=persetujuan">
                                                        <input type="hidden" class="form-control" id="url" name="url" value="<?= $url ?>" >
                                                        <button  type='submit' class='btn btn-success btn-flat  btn-xs btn-block'>
                                                            <i class='fa fa-print'></i> View
                                                        </button>
                                                    </form> 
                                                </td>
                                            </tr>
                                            <?php
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
                                    <th width="5%"> Keterangan</th>
                                    <th class="text-center" width='5%'><i class="fa fa-cogs"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $n = 1;
                                foreach ($get_SetExecutiveWhereId_exe as $getse) {
                                    foreach ($get_suratMasukExe as $row) {
                                        if ($row->status_persetujuan != 0 and ( $row->jum_nota - $row->jum_dis) <= 0) {
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
                                                    <?php if ($row->status_persetujuan == 1) { ?>
                                                        <label class="label label-success" >Disetujui</label>
                                                    <?php } elseif ($row->status_persetujuan == 2) { ?>
                                                        <label class="label label-danger" >Dibatalkan</label>
                                                    <?php } elseif ($row->status_persetujuan == 3) { ?>
                                                        <label class="label label-primary" >Dikoreksi</label>
                                                    <?php } else { ?>
                                                        <label class="label label-success" >Terdisposisi</label>
                                                    <?php } ?>
                                                </td>
                    <!--                                               <td class='text-center'>
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
                                                <td>
                                                    <?php if ($row->status_persetujuan == 3) { ?>
                                                    <a href='<?= base_url(); ?>index.php/laporan/Laporan_html/formulir_nota_dinas?id_skpd=<?= $row->id_skpd; ?>&id=<?= $row->id; ?>&kewenangan=koreksi' target='_blank' type='button' class='btn btn-success btn-flat  btn-xs btn-block'>
                                                        <i class='fa fa-print'></i>
                                                    </a>
                                                    <?php }else{ ?>
                                                        <a href='<?= base_url(); ?>index.php/laporan/Laporan_html/formulir_nota_dinas?id_skpd=<?= $row->id_skpd; ?>&id=<?= $row->id; ?>' target='_blank' type='button' class='btn btn-success btn-flat  btn-xs btn-block'>
                                                        <i class='fa fa-print'></i>
                                                    </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form_tambah" method="POST" action="<?= base_url() ?>index.php/surat/Surat_masuk_keluar/setuju" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Disposisi : </h4>
                </div>
                <div class="modal-body">
                    <div class="notaDinasDetail"></div>
                    <input type="hidden" class="form-control" id="id" name="id" placeholder="">
                    <input type="hidden" class="form-control" id="url" name="url" value="<?= $url; ?>">
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

<script>

    $('#Persetujuan').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var id_skpd = button.data('id_skpd');
        var id_kewenangan = button.data('id_kewenangan');
        var modal = $(this);

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/surat/Surat_masuk_keluar/modal_detailNotaDinas/" + id + "/" + id_skpd + "/" + id_kewenangan,
            success: function (respont) {
                $('.notaDinasDetail').html(respont);
            }
        });

        modal.find('#id').val(id);
    });

</script>
