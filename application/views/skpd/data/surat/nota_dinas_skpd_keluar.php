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
                            <th  width="10%">No Nota</th>
                            <th >Tgl Nota</th>
                            <th >Tujuan</th>
                            <th >Status ND</th>
                            <th> Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($getnotadinas as $value) {
                            ?>
                        <tr class="bg-info">
                                <td style="text-align: center;"><?= $no; ?></td>
                                <td style="text-align: center;"><?= $value->no; ?></td>
                                <td style=""><?= $value->tgl_nota_dinas; ?></td>
                                 <td style="text-align: center;"><?= $value->tujuan; ?></td>
                                 <td style="text-align: center;"><?php
                               switch ($value->ttd_kepala) {
                                        case 1:
                                            $label = "Setuju";
                                            $style = "label-success";
                                            break;
                                        case 2:
                                            $label = "DiTolak";
                                            $style = "label-danger";
                                            break;
                                        default:
                                            $label = "Prosess Persetujuan";
                                            $style = "label-info";
                                            break;
                                    } ?>
                                     <span class="label <?=$style?>"><?= $label ?></span>
                                 </td>
                                    <td>
                                    <a href="<?= base_url('index.php/skpd/surat/Nota_dinas/view/'.$value->id);?>" class="btn btn-primary btn-block btn-flat btn-xs">
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
