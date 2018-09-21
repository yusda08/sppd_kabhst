<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
//echo 'Masih di alam pikiran bawah sadar';
?>
<section class="content">
<div class="panel panel-primary">
    <div class="panel-heading">
        Pencarian Nota Dinas
    </div>
    <div class="panel-body">
        <select name="notadinas" class="select2" id="notadinas">
            <option value="0">--- PIlih Nota dinas ---</option>
            <?php foreach($get_notadinasJoinAll as $value){ ?>
            <option value="<?=$value->id?>"><?= $value->no ?></option>
            <?php }?>
        </select>
        <input type="button" value="Cari" onclick="cari_nd()" class="btn btn-primary"/>
    </div>
</div>    
    <div id="datanya">
        
    </div>
</section>
<script>
function cari_nd()
{
    var notadinas = $("#notadinas").val();
 //   alert(notadinas);
    var posting = $.post("<?= base_url() . '/index.php/skpd/surat/nota_dinas/carinota' ?>",{
        no : notadinas
    })
    
    posting.done(function(data){
        $('#datanya').html(data)
    })
}
</script>