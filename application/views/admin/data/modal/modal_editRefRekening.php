<?php
?>   

<select name='rek' id='rek' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Kode Rekening--</option>
                                <?php 
                                $att="";
                                foreach($get_refRekening as $grr){
                                    if($grr->id==$id){
                                        $att="selected";
                                    }else{
                                        $att="";
                                    }
                                    ?>
                                <option value='<?= $grr->id ?>' <?= $att ?>><?= $grr->kode_rekening.' - '.$grr->jenis_rekening ?></option>
                                <?php } ?>
                            </select> 

<script type="text/javascript">
    $(function () {
    $(".select2").select2();
    });
    </script>