<?php $a = $this->session->userdata('logged_in'); 
error_reporting(0);
?>
<!DOCTYPE html>
<html>
  <head>
    <?php echo $head; ?>    
  
  </head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- head -->
  <header class="main-header">
    <?php echo $main_header; ?>  

  </header>
   <aside class="main-sidebar">
    <?php echo $nav; ?>  
     </aside>

     <!--    <section class="content-header">
      <h1 class="bold">
        <?php echo strtoupper($page_name); ?> <small><a href="<?php echo base_url(); ?>"></a></small>
      </h1>
  breadcrumb -->
  <div class="content-wrapper">
      <?php echo $content; ?>
</div>
<!--<footer class="main-footer bg-blue" style="padding-bottom: 25px;"><?php echo $foot; ?></footer>-->
</div>

  </body>
</html>
