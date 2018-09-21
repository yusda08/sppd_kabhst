<?php

foreach ($get_refJabWhereId as $grjwi){
    $tingkat=$grjwi->tingkat;
}
?>   

<select name='tingkat' id='tingkat' class="btn btn-default select2" style="width: 100%" required>
                                <option value='' >-- Pilih Tingkat --</option>
                                <?php
                                if(A==$tingkat){
                                echo"<option value='A' selected>A</option>
                                <option value='B'>B</option>
                                <option value='C'>C</option>
                                <option value='D'>D</option>";
                                }elseif(B==$tingkat){
                                echo"<option value='A' >A</option>
                                <option value='B' selected>B</option>
                                <option value='C'>C</option>
                                <option value='D'>D</option>";
                                }elseif(C==$tingkat){
                                echo"<option value='A' >A</option>
                                <option value='B' >B</option>
                                <option value='C' selected>C</option>
                                <option value='D'>D</option>";
                                }else{
                                echo"<option value='A' >A</option>
                                <option value='B' >B</option>
                                <option value='C'>C</option>
                                <option value='D' selected>D</option>";
                                } ?>
                                
                            </select> 

<script type="text/javascript">
    $(function () {
    $(".select2").select2();
    });
    </script>