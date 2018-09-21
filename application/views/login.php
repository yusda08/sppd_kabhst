<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SPPD KAB. HST</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <style>
            #get-notified {
                width: 50%;
                position: absolute;
                z-index: 999;
                top: 10px;
                right: 10px;
            }

            #panel, #flip {
                padding: 5px;
                text-align: center;
                border: solid 1px #c3c3c3;
                background-color: #e5eecc;
                color: #000000;
            }
            .custom-body {
                background-image: url('<?php echo base_url(); ?>assets/img/background4.png') !important; 
                background-size: auto;
                -webkit-background-size: 100% 100%;
                background-repeat : no-repeat;
                background-attachment:fixed ; 
            }
            #panel {
                padding: 5px;
                display: none;
            }
            .login{
                padding-top: 0px;
                margin-top:0px; 
            }


            .bag {
                background-color:rgba(255,255,255,0.8);
            }
        </style>
    </head>
    <?php
    $msg = $this->session->flashdata('msg');
    $tipe = $this->session->flashdata('tipe');
    $lambang = 'fa-check';
    $notify = 'Sukses!';
    ?>
    <body class="hold-transition fixed login-page custom-body login">
        <div class="container" >
            <div class="login-box">
                <div class="row">
                    <div class="col-md-12 col-md-offset-7">
                        <div class="panel bg-gray">
                            <div class="panel-heading bg-yellow text-center">
                                <h4 class="login-box-msg" style="padding-bottom: 0px;">Silahkan Login :</h4>
    <!--                            <img src="<?php echo base_url(); ?>assets/img/logoold.png" width="30%" >
                                <h4 style="color:#000000">SPPD - Kab. HST</h4>-->
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 bag">
                                        <center>
                                        <label class="label label-info">Tanggal dan waktu pada sistem SPPD</label>
                                        
                                            <div id="date"></div>
                                            <div id="time"></div>
                                            
                                        </center>
                                    </div>
                                </div>
                                <hr>


                                <div id="get-notified"></div>
                                <!--                            <h4 class="login-box-msg" style="padding-bottom: 0px;">Silahkan Login :</h4>-->
                                <form id='form-login' action="<?php echo base_url(); ?>index.php/login/validasi" method="post">
                                    <div class="form-group has-feedback">
                                        <label>Username</label>
                                        <input type="text" name='username' id='username' class="form-control" placeholder="Username">
                                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Password</label>
                                        <input type="password" id='password' name='password' class="form-control" placeholder="Password">
                                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                    </div>
                                    <div class="form-group has-feedback">
                                        <label>Level User</label>
                                        <select name="level_user" class="form-control select2" style="width: 100%;" id="level_user" required>
                                            <option value=''>--Pilih Level User---</option>
                                            <?php foreach ($get_level_user as $glu) { ?>
                                                <option value='<?php echo $glu->level ?>'><?php echo $glu->nama; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
                                        </div>
                                    </div>
                                    </form>
                                    <hr>
                                    <p class="text-center">Pemerintah Kabupaten Hulu Sungai Tengah
                                        <br>Copyright &copy; <?php echo date("Y"); ?>
                                    </P>
                            </div>
                            <!-- /.login-box-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap 3.3.7 -->
        <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/jquery-validation/dist/jquery.validate.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/jquery-validation/src/localization/messages_id.js"></script>
        <script src="<?php echo base_url(); ?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
                $(".select2").select2();
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function ()
            {
                $("#form-login").validate({
                    submitHandler: function (form) {
                        $("button[type='submit']").click(function () {
                            var $btn = $(this);
                            $btn.button('loading');
                            setTimeout(function () {
                                $btn.button('reset');
                            }, 2000);
                        });

                        var username = $("#username").val();
                        var password = $("#password").val();
                        var level_user = $("#level_user").val();

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url(); ?>index.php/login/validasi",
                            data: {
                                username: username,
                                password: password,
                                level_user: level_user
                            },

                            success: function (msg)
                            {
                                //  alert(msg);
                                if (msg == "true")

                                {
                                    $("#get-notified").html('<div class="alert alert-success alert-dismissable animated fadeIn"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <h4><i class="icon fa fa-check"></i> Sukses!</h4> Berhasil Masuk. </div>');
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    $("#get-notified").html('<div class="alert alert-danger alert-dismissible" id="alert-notification"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-ban"></i> Peringatan!</h4> Username dan Password Salah. </div>');
                                    setTimeout(function () {
                                        $('#alert-notification').fadeOut('slow');
                                    }, 2000);
                                }
                            }
                        });

                    }
                });

            });
        </script>
        <script type="text/javascript">
            function showTime() {
                var a_p = "";
                var today = new Date();
                var curr_hour = today.getHours();
                var curr_minute = today.getMinutes();
                var curr_second = today.getSeconds();
                if (curr_hour < 12) {
                    a_p = "AM";
                } else {
                    a_p = "PM";
                }
                if (curr_hour == 0) {
                    curr_hour = 12;
                }
                if (curr_hour > 12) {
                    curr_hour = curr_hour - 12;
                }
                curr_hour = checkTime(curr_hour);
                curr_minute = checkTime(curr_minute);
                curr_second = checkTime(curr_second);
                var waktu = curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p
                $('#time').html('<span style="font-size:12pt;"><strong>At : ' + waktu + '</strong></span>');
            }

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }
            setInterval(showTime, 500);

            var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth();
            var year = date.getFullYear();
            var tanggal = day + " " + months[month] + " " + year
            $('#date').html('<span style="font-size:12pt;"><strong>Tanggal : ' + tanggal + '</strong></span>');
        </script>
    </body>
</html>
