<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login'); 
 $this->load->model('Tgl_indo');
?>
<div class="pull-right hidden-xs">
     Design By IT/Programmer Kab. HST<br>
    <small>Last In <?= Tgl_indo::indo($a['last_date']). " AT " . $a['last_time'];?></small>
    </div>
<strong>Copyright &copy; <?php echo date("Y");?></strong> Hak Cipta Dilindungi Undang-undang.<br>
