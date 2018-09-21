<?php
foreach ($get_SetAsistenWhereId as $gsawi){
  $id = $gsawi->id;
  $nama_tujuan = $gsawi->nama_tujuan;
  $id_kewenangan = $gsawi->id_kewenangan;
  $id_ttd = $gsawi->id_ttd;
  $urutan = $gsawi->urutan;
  $nama_disposisi = $gsawi->nama_disposisi;
}
?>

<div class="form-group col-md-12">
                            <label>Persetujuan</label>
                            <select name='id_ttd' id='id_ttd' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Persetujuan --</option>
                                <?php
                                foreach ($get_refTtd as $grt) {
                                    $nama = $grt->nama;
                                    foreach ($get_SetKewenanganDetailWhereIdKewenangan as $row){
                                        if($grt->id == $row->id_ttd and $row->id_ttd != $id_ttd){
                                            $att = 'disabled';
                                            break;
                                        }else{
                                            $att = '';
                                        }
                                    }
                                    
                                    echo"<option ".$att." value='" . $grt->id . "'";
                                            if($id_ttd == $grt->id) echo"selected"; echo">" . $nama . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                       <div class="form-group col-md-12">
                                <label>Urutan</label>
                                <input type="text" class="form-control" name="urutan" value="<?= $urutan;?>" required>
                                <input type="hidden" class="form-control" name="id" value="<?= $id;?>" required>
                            </div>


<script type="text/javascript">
    $(function () {
    $(".select2").select2();
    });
    </script>