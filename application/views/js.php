<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);</script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>-->
<!--<script src="<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-validation/src/localization/messages_id.js"></script>
<!--<script src="//cdn.ckeditor.com/4.7.2/full/ckeditor.js"></script>-->
<script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/fancybox/jquery.fancybox.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.autocomplete.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-fileupload.js"></script>
<script src="<?php echo base_url(); ?>assets/md5/js/md5.min.js"></script>
<!--<script src="http://code.jquery.com/jquery-2.0.3.min.js"></script>-->
<link href="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript">
    setTimeout(function () {
        $('#notiv').fadeOut('slow');
    }, 4000);
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
    $(function () {
        $(".select2").select2();
        $('.tabel_1').DataTable();
        $('.tabel_2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': false,
            'autoWidth': false
        });
        $('.tabel_4').DataTable({
            'paging': false,
            'lengthChange': false,
            'searching': true,
            'ordering': false,
            'info': false,
            'autoWidth': false
        });
        $('.tabel_3').DataTable({
            "scrollY": "450px",
            "scrollX": true,
            "scrollCollapse": true,
            "paging": false
        });
    });
    $(function () {
        $(".datepicker").datepicker({
            format: 'dd-mm-yyyy',
            showOtherMonths: true,
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            minDate: 0
        });
    });

    $(document).ready(function () {
        $('#to-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 600);
            return false;
        });
    });
</script>   
<script>
    $(document).ready(function () {
        var heights = $(".rata_rata").map(function () {
            return $(this).height();
        }).get(),
                maxHeight = Math.max.apply(null, heights);
        $(".rata_rata").height(maxHeight);
        $('.fancybox').fancybox();
    });
    $("#form-registrasi").validate();
     
</script>