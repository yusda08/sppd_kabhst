<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
$msg = $this->session->flashdata('msg');
$tipe = $this->session->flashdata('tipe');
$lambang = 'fa-check';
$notify = 'Sukses!';
echo $javasc;
?>

<section class="content">
    <div class="box box-success">
        <div class="box-body">
            <div class="table-responsive">
                <table  class="table table-hover table-bordered tbl_nota_dinas">                 
                </table>
            </div>
        </div><!-- /.box-body -->
    </div><!-- /.box -->       
</section><!-- /.box -->      
<script>
    setInterval(function () {
        $('.tbl_nota_dinas').load('<?php echo base_url(); ?>index.php/admin/surat/interval/tabel_nota_dinas_all');
//        window.location.reload(true);
    }, 1000);

    setTimeout(function () {
        location.reload();
    }, 1000*60*30);
</script>