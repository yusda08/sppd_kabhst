<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
?>
<section class="content-header alert bg-gray" style=" border-bottom-width: 19px; margin-bottom: 16px;margin-top: 0px;">
    <h1><?php echo strtoupper($page_name); ?></h1>
    <ol class="breadcrumb ">
        <li><a href="#">Nota Dinas</a></li>
        <li class="active">Data SKPD</li>
    </ol>
</section>
<section class="content">
    <div class="box box-success">
        <div class="box-body">
            <div class="table-responsive">
                <table class="tabel_3 table table-hover table-bordered table-striped" width="100%">
                    <thead >
                        <tr>
                            <th style="width: 10px;">No</th>
                            <th  width="10%">Kode SKPD</th>
                            <th >Nama SKPD</th>
                            <th >Jumlah Surat Tugas</th>
                            <th width="7%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($skpd as $skp) {
                            ?>
                        <tr class="bg-info">
                                <td style="text-align: center;"><?= $no; ?></td>
                                <td style="text-align: center;"><?= $skp->kunker; ?></td>
                                <td style=""><?= $skp->nunker; ?></td>
                                <td style="">
                                    
                                </td>
                                <td style="">
                                <a href="<?= base_url('index.php/admin/surat/Surat_tugas/surat_tugas/'.$skp->kunker);?>" class="btn btn-primary btn-block btn-flat btn-xs">
                    <i class='fa fa-search'></i>&nbsp;Lihat</a>
                                </td>
                            </tr>

                            <?php
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>


        </div><!-- /.box-body -->
    </div><!-- /.box -->          
</section>
