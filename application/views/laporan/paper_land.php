<!DOCTYPE html>
<html>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <title>View</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/bower_components/fancybox/jquery.fancybox.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css">
            body{
                font-size: 11pt;
                text-align: left;
            }
            
            table, table .main {
                width: 100%;
                border-collapse: collapse;
                background: #fff;
                text-align: left;
                padding: 3px;
            }
            
            table tr th{
                padding: 3px;
                border-collapse: collapse;
                text-align: center;
            }
            table .padding_8 tr td{
                padding: 8px;
            }
            table .padding_3 tr th{
                padding: 3px;
            }
            table .padding_3 tr td{
                padding: 3px;
            }
            .left {text-align: left;}
            .putus { border-bottom: 1px dotted #666; border-top: 1px dotted #666; }
            .bawah { border-bottom: 0px ; }
            .atas { border-top: 0px ; }
            .kanan { border-right: 0px ; }
            .kiri { border-left: 0px ; }
            .b_left { border-left: 1px solid #666; }
            .b_right { border-right: 1px solid #666; }
            .top { border-top: 1px solid #666; }
            .bottom { border-bottom: 1px solid #666; ; }
            .all { border: 1px solid #666; }
            .center {text-align: center;}
            .form-check{
                display:inline-block; 
                position:relative; 
                width:50px; 
                height:25px;
            }
        </style>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    </head>
    <body class="legal text-center">
        <?php echo $content; ?>
    </body>
    <script src="<?php echo base_url(); ?>assets/bower_components/fancybox/jquery.fancybox.js"></script>
</html>
