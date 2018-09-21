<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$pengirim = $a['email'];
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
foreach ($get_kepalaSkdpWhereSkpd as $guks) {
    $penerima = $guks->email;
}
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

        <li><a href="#">Surat</a></li>
        <li class="active">Nota Dinas</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-3">

            <label>Nota Dinas Penggunaan Untuk :</label>
        </div>        
        <div class="col-md-4">
            <?php
            $id_tujuan = isset($_REQUEST['id_tujuan']) ? $_REQUEST['id_tujuan'] : "";
            ?>
            <form name='ftujuan' method='get' >
                <select name='id_tujuan'class="btn btn-default select2" style="width: 100%"  onchange='document.ftujuan.submit();'>
                    <option value=''> Pilih Jenis Nota Dinas</option>
                    <?php
                    foreach ($get_refTujuan as $grt) {
                        echo"<option value='$grt->id'";
                        if ($id_tujuan == $grt->id)
                            echo" selected";
                        echo">$grt->nama</option>";
                    }
                    ?>
                </select>
            </form>
        </div>
    </div>
    <hr>


    <?php
    if (!empty($id_tujuan)) {
        $get_notadinasWhereIdTujuan = $this->Data_notadinas->get_notadinasWhereIdTujuan($id_skpd, $id_tujuan);
        ?>
        <div class="box box-success">
            <div class="box-header with-border">
                <a href="<?= base_url('index.php/skpd/surat/Nota_dinas/tambah_nota_dinas/' . $id_skpd . '/' . $id_tujuan); ?>" class="btn btn-primary">
                    <i class='fa fa-plus'></i>&nbsp;Tambah Nota Dinas</a>

            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table  class="tabel_1 table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="5%"> No</th>
                                <th width="20%"> Nomor Surat</th>
                                <!--<th > Perihal Surat</th>-->
                                <th width="13%"> Tanggal Surat</th>
                                <th width="7%"> Persetujuan</th>
                                <th width="5%"> Status ND</th>
                                <th width="7%"> File</th>
                                <th width="5%"> Tracking</th>
                                <th class="text-center" width='5%'><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                            foreach ($get_notadinasWhereIdTujuan as $row) {
                                $id = $row->id;
                                $id_tujuan = $row->id_ref_tujuan;
                                $id_kewenangan = $row->id_ref_kewenangan;
                                ?>
                                <tr>
                                    <td class="text-center"><?php
                                        echo $n;
                                        $n++;
                                        ?></td>
                                    <td><?= $row->no; ?></td>
                                    <!--<td><?= $row->perihal; ?></td>-->
                                    <td class="text-center"><?= Tgl_indo::indo($row->tgl_nota_dinas); ?></td>
                                    <td class="text-center"><?= $row->nama; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($row->posting == 0) {
                                            echo"<label class='label label-danger'>Belum Di Posting<br><small>$row->catatan_koreksi</small></label>";
                                        } else {
                                            if ($row->ttd_kepala == 0) {
                                                echo"<label class='label label-info'>Surat Belum Di TTD Kepala</label>";
                                            } else {
                                                if ($row->status_persetujuan == 0) {
                                                    echo"<label class='label label-warning'>Dalam Proses</label>";
                                                } elseif ($row->status_persetujuan == 1) {
                                                    echo"<label class='label label-success'>Diterima</label>";
                                                } elseif ($row->status_persetujuan == 2) {
                                                    echo"<label class='label label-danger'>Di Batal</label>";
                                                } elseif ($row->status_persetujuan == 3) {
                                                    echo"<label class='label label-default'>Di Koreksi</label>";
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row->format_file != 'application/pdf') {
                                            echo "<center>
                                    <a class='fancybox' data-fancybox-group='pemakaian_bulanan' href='" . base_url() . "assets/file/" . $row->nama_file . "'>
                                        <img src='" . base_url() . "assets/file/" . $row->nama_file . "' class='img-responsive img-related' width='30 % '>
                                    </a>
                                        </center>";
                                        } else {
                                            Echo"<a target='_blank' href='" . base_url() . "assets/file/" . $row->nama_file . "' class = 'btn btn-hover btn-danger btn-xs btn-block'>
                                                    <i class = 'fa fa-download'></i> Pdf</a>";
                                        }
                                        ?>
                                    </td>
                                    <?php
                                    if ($row->posting == 0) {
                                        echo"<td><button type='button' class='btn btn-success btn-xs btn-block btn-flat' 
                                                            data-toggle='modal'
                                                            data-penerima='" . $penerima . "' 
                                                            data-pengirim='" . $pengirim . "' 
                                                            data-id='" . $id . "' 
                                                            data-no='" . $row->no . "' 
                                                            data-perihal='" . $row->perihal . "' 
                                                            data-target='#posting'>
                                                        <i class='fa fa-check'></i> Posting</button></td> 
                                            <td><div class='btn-group'>
                                            <button type='button' class='btn btn-default btn-xs dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <i class='fa fa-cogs'></i> <span class='caret'></span>
                                            </button>
                                            <ul class='dropdown-menu dropdown-menu-right'>
                                                <li> <a href='" . base_url('index.php/skpd/surat/Nota_dinas/edit_nota_dinas/' . $id_skpd . '/' . $id_tujuan . '?id=' . $id) . "' class='btn btn-warning btn-flat btn-xs btn-block'>
                                                    <i class='fa fa-pencil'></i> Edit</a></li>
                                                <li><button type='button' class='btn btn-danger btn-xs btn-block btn-flat' 
                                                            data-toggle='modal'
                                                            data-id='$id'
                                                            data-no='$row->no' 
                                                            data-perihal='$row->perihal' 
                                                            data-target='#delete'>
                                                        <i class='fa fa-trash-o'></i> Hapus</button></li>
                                            </ul>
                                        </div>
                                        </td>";
                                    } else {
                                        if ($row->ttd_kepala == 0) {
                                            ?>
                                            <td class='text-center'><button type='button' class='btn btn-primary btn-xs btn-block btn-flat' 
                                                                            data-toggle='modal'
                                                                            data-id='<?= $id; ?>'
                                                                            data-id_skpd='<?= $id_skpd; ?>'
                                                                            data-id_kewenangan='<?= $id_kewenangan; ?>'
                                                                            data-target='#lihat_traicking'>
                                                    <i class='fa fa-search-plus'></i> Lihat</button></td>
                                            <td><a href='<?= base_url('index.php/skpd/surat/Nota_dinas/edit_nota_dinas/' . $id_skpd . '/' . $id_tujuan . '?id=' . $id); ?>' class='btn btn-warning btn-flat btn-xs btn-block'>
                                                    <i class='fa fa-pencil'></i></a></td>
            <?php } else { ?>
                                            <td class='text-center'><button type='button' class='btn btn-primary btn-xs btn-block btn-flat' 
                                                                            data-toggle='modal'
                                                                            data-id='<?= $id; ?>'
                                                                            data-id_skpd='<?= $id_skpd; ?>'
                                                                            data-id_kewenangan='<?= $id_kewenangan; ?>'
                                                                            data-target='#lihat_traicking'>
                                                    <i class='fa fa-search-plus'></i> Lihat</button></td>
                                            <td>
                                                <a href='<?= base_url(); ?>index.php/laporan/Laporan_pdf/formulir_nota_dinas?id_skpd=<?= $id_skpd; ?>&id=<?= $id; ?>' target='_blank' type='button' class='btn btn-danger btn-flat  btn-xs btn-block'><i class='fa fa-download'></i></a>
                                            </td>
                                            <?php
                                        }
                                    }
                                    echo"</tr>";
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->       
<?php } else { ?>
        <div class="box box-success">
            <div class="box-header with-border">
                Data Nota Dinas 
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table  class="tabel_1 table table-hover table-bordered">

                        <thead class=''>
                            <tr>
                                <th width="5%"> No</th>
                                <th width="18%"> Nomor Surat</th>
                                <th > Tanggal Surat</th>
                                <th > Tujuan Surat</th>
                                <th > Penggunaan</th>

                                <th > Status ND</th>
                                <th > File</th>
                                <th width="5%"> Traicking</th>
                                <th class="text-center" width='5%'><i class="fa fa-cogs"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $n = 1;
                            foreach ($get_notadinasJoinAll as $row) {
                                $id = $row->id;
                                $id_tujuan = $row->id_ref_tujuan;
                                $id_kewenangan = $row->id_ref_kewenangan;
                                ?>
                                <tr>
                                    <td class="text-center"><?php
                                        echo $n;
                                        $n++;
                                        ?></td>
                                    <td><?= $row->no; ?></td>
                                    <td class="text-center"><?= Tgl_indo::indo($row->tgl_nota_dinas); ?></td>
                                    <td class="text-center"><?= $row->nama; ?></td>
                                    <td class=""><?= $row->nama_tujuan; ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($row->posting == 0) {
                                            echo"<label class='label label-danger'>Belum Di Posting</label><br><small>$row->catatan_koreksi</small>";
                                        } else {
                                            if ($row->ttd_kepala == 0) {
                                                echo"<label class='label label-info'>Surat Belum Di TTD Kepala</label>";
                                            } else {
                                                if ($row->status_persetujuan == 0) {
                                                    echo"<label class='label label-warning'>Dalam Proses</label>";
                                                } elseif ($row->status_persetujuan == 1) {
                                                    echo"<label class='label label-success'>Diterima</label>";
                                                } elseif ($row->status_persetujuan == 2) {
                                                    echo"<label class='label label-success'>Di Batal</label>";
                                                }elseif ($row->status_persetujuan == 3) {
                                                    echo"<label class='label label-default'>Di Koreksi</label>";
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row->format_file != 'application/pdf') {
                                            echo "<center>
                                    <a class='fancybox' data-fancybox-group='pemakaian_bulanan' href='" . base_url() . "assets/file/" . $row->nama_file . "'>
                                        <img src='" . base_url() . "assets/file/" . $row->nama_file . "' class='img-responsive img-related' width='30 % '>
                                    </a>
                                        </center>";
                                        } else {
                                            Echo"<a target='_blank' href='" . base_url() . "assets/file/" . $row->nama_file . "'  class = 'btn btn-hover btn-danger btn-xs btn-block'>
                                                    <i class = 'fa fa-download'></i> Pdf</a>";
                                        }
                                        ?>
                                    </td>

                                    <?php
                                    if ($row->posting == 0) {
                                        echo"<td><button type='button' class='btn btn-success btn-xs btn-block btn-flat' 
                                                            data-toggle='modal'
                                                            data-penerima='" . $penerima . "' 
                                                            data-pengirim='" . $pengirim . "'
                                                            data-id='" . $id . "' 
                                                            data-no='" . $row->no . "' 
                                                            data-perihal='" . $row->perihal . "' 
                                                            data-target='#posting'>
                                                        <i class='fa fa-check'></i> Posting</button></td> 
                                            <td><div class='btn-group'>
                                            <button type='button' class='btn btn-default btn-xs dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <i class='fa fa-cogs'></i> <span class='caret'></span>
                                            </button>
                                            <ul class='dropdown-menu dropdown-menu-right'>
                                                <li> <a href='" . base_url('index.php/skpd/surat/Nota_dinas/edit_nota_dinas/' . $id_skpd . '/' . $id_tujuan . '?id=' . $id) . "' class='btn btn-warning btn-flat btn-xs btn-block'>
                                                    <i class='fa fa-pencil'></i> Edit</a></li>
                                                 <li><button type='button' class='btn btn-danger btn-xs btn-block btn-flat' 
                                                            data-toggle='modal'
                                                            data-id='$id'
                                                            data-no='$row->no' 
                                                            data-perihal='$row->perihal' 
                                                            data-target='#delete'>
                                                        <i class='fa fa-trash-o'></i> Hapus</button></li>
                                            </ul>
                                        </div></td>";
                                    } else {
                                        if ($row->ttd_kepala == 0) {
                                            ?>
                                            <td class='text-center'><button type='button' class='btn btn-primary btn-xs btn-block btn-flat' 
                                                                            data-toggle='modal'
                                                                            data-id='<?= $id; ?>'
                                                                            data-id_skpd='<?= $id_skpd; ?>'
                                                                            data-id_kewenangan='<?= $id_kewenangan; ?>'
                                                                            data-target='#lihat_traicking'>
                                                    <i class='fa fa-search-plus'></i> </button></td>
                                            <td><a href='<?= base_url('index.php/skpd/surat/Nota_dinas/edit_nota_dinas/' . $id_skpd . '/' . $id_tujuan . '?id=' . $id); ?>' class='btn btn-warning btn-flat btn-xs btn-block'>
                                                    <i class='fa fa-pencil'></i></a></td>
            <?php } else { ?>
                                            <td class='text-center'><button type='button' class='btn btn-primary btn-xs btn-block btn-flat' 
                                                                            data-toggle='modal'
                                                                            data-id='<?= $id; ?>'
                                                                            data-id_skpd='<?= $id_skpd; ?>'
                                                                            data-id_kewenangan='<?= $id_kewenangan; ?>'
                                                                            data-target='#lihat_traicking'>
                                                    <i class='fa fa-search-plus'></i> </button></td>
                                            <td>
                                                <a href='<?= base_url(); ?>index.php/laporan/Laporan_pdf/formulir_nota_dinas?id_skpd=<?= $id_skpd; ?>&id=<?= $id; ?>' target='_blank' type='button' class='btn btn-danger btn-flat  btn-xs btn-block'><i class='fa fa-download'></i></a>
                                            </td>
                                            <?php
                                        }
                                    }
                                    echo"</tr>";
                                }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->      
<?php } ?>
</section>

<div class="modal fade" id="lihat_traicking" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <form id="form_tambah" method="POST" action="<?= base_url() ?>index.php/skpd/surat/Nota_dinas/posting" enctype="multipart/form-data">
                <div class="modal-header bg-blue">
                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Disposisi : </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!--                        <div class="form-group col-md-12">
                                                    <h4 class="alert alert-info"></h4>
                                                </div>-->
                        <div class="form-group col-md-12">
                            <div class="traickingSurat"></div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="email" name="email" placeholder="">
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

<div class="modal fade" id="posting" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="form_tambah" method="POST" action="<?= base_url() ?>index.php/skpd/surat/Nota_dinas/posting" enctype="multipart/form-data">
                <div class="modal-header bg-green-gradient">
                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Posting Nota Dinas</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <h4 class="alert alert-success">Apakah Anda Yakin Memposting Pekerjaan Ini...!!!</h4>
                            <label>Nomor Nota Dinas</label>
                            <input type="text" class="form-control" name="no" id='no' readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Perihal</label>
                            <div class="perihal_nd"></div>
                        </div>
                    </div>

                    <input type="hidden" class="form-control" id="penerima" name="penerima" placeholder="">
                    <input type="hidden" class="form-control" id="id" name="id" placeholder="">
                    <input type="hidden" class="form-control" id="url" name="url" value="<?= $url; ?>">
                </div>
                <div class="modal-footer bg-green-gradient">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-warning" data-loading-text="Loading..." autocomplete="off">Posting</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="delete" role="dialog" aria-labelledby="editlabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form_tambah" method="POST" action="<?= base_url() ?>index.php/skpd/surat/Nota_dinas/delete_notaDinas" enctype="multipart/form-data">
                <div class="modal-header bg-red-gradient">
                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="editlabel"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Form Hapus Nota Dinas</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <h4 class="alert alert-danger">Apakah Anda Yakin Menghapus Nota Dinas Ini...!!!</h4>
                            <label>Nomor Nota Dinas</label>
                            <input type="text" class="form-control" name="no" id='no' readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Perihal</label>
                            <div class="delete_perihal"></div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="id" name="id" placeholder="">
                    <input type="hidden" class="form-control" id="url" name="url" value="<?= $url; ?>">
                </div>
                <div class="modal-footer bg-red-gradient">
                    <button type="button" class="btn btn-default" id="add-close-modal" data-dismiss="modal">Tutup</button>
                    <button type="submit"  id="add" class="btn btn-warning" data-loading-text="Loading..." autocomplete="off">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $('#lihat_traicking').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id_kewenangan = button.data('id_kewenangan');
        var id_skpd = button.data('id_skpd');
        var id = button.data('id');
//        alert(id_kewenangan);
        var modal = $(this);
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url(); ?>index.php/skpd/surat/Nota_dinas/modal_traikingSurat/",
            data: {
                id_skpd: id_skpd,
                id_kewenangan: id_kewenangan,
                id: id
            },
            success: function (respont) {
                $('.traickingSurat').html(respont);
            }
        });
    });

    $('#posting').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var penerima = button.data('penerima');
        var pengirim = button.data('pengirim');
        var no = button.data('no');
        var perihal = button.data('perihal');
        var id = button.data('id');
        var modal = $(this);
        modal.find('#no').val(no);
        modal.find('#pengirim').val(pengirim);
        modal.find('#penerima').val(penerima);
        modal.find('.perihal_nd').html('<textarea class="form-control" readonly name="perihal" rows="3" required>' + perihal + '</textarea>');
        modal.find('#id').val(id);
    });
    $('#delete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var id = button.data('id');
        var no = button.data('no');
        var perihal = button.data('perihal');
//        alert(perihal);
        var modal = $(this);
        modal.find('#no').val(no);
        modal.find('.delete_perihal').html('<textarea class="form-control" name="perihal" readonly rows="3" required>' + perihal + '</textarea>');
        modal.find('#id').val(id);
    });

</script>
