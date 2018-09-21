<title>Administrator SPPD HST</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower_components/fancybox/jquery.fancybox.css">
<style> 
    @media screen and (max-width: 768px) {
        .h3{
            font-size:14px;
        }
    }
    
    .h3{
        font-size:14px;
    }
    #notiv {
        width: 40%;
        position: absolute;
        z-index: 999;
    }

    #notivs {
        width: 50%;
        position: absolute;
        z-index: 999;
        top: 10px;
        right: 10px;
    }

    thead tr th 
    {
        text-align:center ;
        font-weight: bold;
        font-size: 10pt;
        background-color: #D2E0E6 ;
        color: #000000;

    }
    td
    {
        font-size: 10pt;
    }

    .bag1{background:#000;opacity:0.4;filter:alpha(opacity=40);}
    .bag2{background:rgba(0,0,0,0.4);}
    .bg {  background: #F0FFFF;}
    .bag { background-color:rgba(255,255,255,0.8);}
    body { font-family: Arial;
           color:#000000; }
    .row-table {
        display: table;
        border-radius: 10px;
        border-radius: 10px;
        table-layout: fixed;
        width: 100%;
        height: 100%;
    }
    .col-table {
        display: table-cell;

        float: none;
        height: 100%;
    }
    @media (min-width: 480px) {
        .row-xs-table {
            display: table;
            background-color:rgba(255,255,255,0.8);
            table-layout: fixed;
            border-radius: 10px;
            width: 100%;
            height: 100%;
        }
        .col-xs-table {
            display: table-cell;
            border-radius: 10px;
            float: none;
            height: 100%;
        }
    }

    @media (min-width: 768px) {
        .row-sm-table {
            display: table;
            table-layout: fixed;
            border-radius: 10px;
            width: 100%;
            height: 100%;
        }
        .col-sm-table {
            display: table-cell;
            border-radius: 10px;
            height: 100%;
        }
    }

    @media (min-width: 992px) {
        .row-md-table {
            display: table;
            table-layout: fixed;
            width: 100%;
            height: 100%;
        }
        .col-md-table {
            display: table-cell;
            float: none;
            height: 100%;
        }
    }

    @media (min-width: 1200px) {
        .row-lg-table {
            display: table;
            table-layout: fixed;
            width: 100%;
            height: 100%;
        }
        .col-lg-table {
            display: table-cell;
            float: none;
            height: 100%;
        }
    }
    .txt{
        height:90px; /*atur angkanya sampe dirasa udah pas*/
        background:	#FF0000; 
        padding:10px; 
        color:#fff;
        border-radius: 10px;
    }

    .txt1{
        height:90px; /*atur angkanya sampe dirasa udah pas*/
        background:#000066; 
        padding:10px; 
        color:#fff;
        border-radius: 10px;
        font-size: 12pt;
    }

    .wrapper {
        min-height: 100%;
    }


    #footer {
        height: 80px;
        clear:both;
    }

</style>