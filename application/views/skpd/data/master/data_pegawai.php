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
        <li><a href="#">Master Pegawai</a></li>
        <li class="active">Data Master Pegawai</li>
    </ol>
</section>
<section class="content">

    <div class="box box-success">
        <div class="box-header with-border">
        </div><!-- /.box-header -->
        <div class="box-body">
            <div class="table-responsive">
                <table  class="tabel_3 table table-hover table-bordered table-striped">
                    <thead>
                        <tr >
                            <th width="5%">No</th>
                            <th width="25%">Nama<br>NIP</th>
                            <th>Jabatan</th>
                            <th width="15%">Pangkat<br>(Gol)</th>
                            <th width="20%">Status Pegawai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_dataPegawai as $row) {
                            ?>
                            <tr>
                                <td class="text-center"><?= $no; ?></td>
                                <td class=""><?= $row->nama . "<br>" . $row->nip_nik; ?></td>
                                <td class=""><?= $row->jabatan; ?></td>
                                <td class="">
                                    <?php
                                    foreach ($get_pegawai as $pgw) {
                                        if ($row->nip_nik == $pgw->nip) {
                                            echo $pgw->PANGKAT . " <br>(" . $pgw->NGOLRU . ")";
                                        }
                                    }
                                    ?>

                                </td>
                                <td class=""><?= $row->status_pegawai = 'pns' ? 'Pegawai Negeri Sipil (PNS)' : 'Non Pegawai Negeri Sipil (NON PNS)'; ?></td>
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


