<?php
foreach ($get_SetAsistenWhereId as $gsawi){
    $id = $gsawi->id;
    $nm_as = $gsawi->nm_as;
}
?>
<input type="hidden" name="asisten" value="<?=$nm_as;?>">
<input type="hidden" name="id_asisten" value="<?=$id;?>">
<h3 class="alert alert-info text-center"><?=$nm_as;?> </h4>
<div class="table-responsive">
                <!-- //table here -->
                <table class="tabel_3 table table-hover table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th >No</th>
                            <th  >Kode SKPD</th>
                            <th >Nama SKPD</th>
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        foreach ($skpd as $skp){
                            $att='';
                            $chek='checked';
                            $get_SetAsistenSkpdWhereKdSkpd = $this->Data_setting->get_SetAsistenSkpdWhereKdSkpd($skp->kunker);
                            foreach ($get_SetAsistenSkpdWhereKdSkpd as $gsaswks){
                                $kode_skpd = $gsaswks->kode_skpd;
                            if($kode_skpd == $skp->kunker){
                                $att = 'disabled';
                                $chek = 'checked';
                                break;
                            }
                            }
                            ?>
                        <tr class="bg-danger">
                            <td style="text-align: center;"><?= $no;?></td>
                            <td style="text-align: center;"><?=  $skp->kunker;?></td>
                            <td style=""><?= $skp->nunker;?></td>
                            <td class="text-center">
                               <input <?=$att. " " .$chek;?>  type="checkbox" name="skpd[]" value="<?=$skp->kunker;?>">
                            </td>
                        </tr>
                            
                            <?php $no++; } ?>
                    </tbody>
                </table>
            </div>

<script type="text/javascript">
    $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
    $(function () {
    $('.tabel_3').DataTable( {
        "scrollY":        "300px",
        "scrollX":        true,
        "scrollCollapse": true,
        "retrieve": true,
        "paging":         false
    } );
  });
</script>