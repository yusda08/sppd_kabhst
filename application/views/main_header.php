<?php
$a = $this->session->userdata('is_login');
$nama = $a['nama'];
$foto = $a['foto'];
$level = $a['level_user'];

?>

<a href="#" class="logo">
    <span class="logo-mini">SPPD</span>
    <?php echo"<span class='logo-lg'><b>" . $a['nama'] . "</b></span>"; ?>
</a>
<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown notifications-menu hidden-xs">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <strong>Informasi Tanggal Dan Waktu Sistem :</strong>
            </a>
          </li>
            <li class="dropdown notifications-menu hidden-xs">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <div id="date"></div>
            </a>
          </li>
            <li class="">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <div id="time"></div>
            </a>
          </li>
            
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php if (empty($foto)) { ?>
                        <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                    <?php } else { ?>
                        <img src="<?php echo base_url(); ?>assets/img/user/<?= $foto; ?>" class="user-image" alt="<?= $nama; ?>">
                    <?php } ?>
                    <span class="hidden-xs"><?= $a['nama']; ?></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
<?php if (empty($foto)) { ?>
                            <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        <?php } else { ?>
                            <img src="<?php echo base_url(); ?>assets/img/user/<?= $foto; ?>" class="img-circle" alt="<?= $nama; ?>">
                        <?php } ?>
                        <p>
                        <?php
                        if ($level == 7) {
                            $get_asistenWhereId = $this->Data_asisten->get_asistenWhereId($a['kode']);
                            foreach ($get_asistenWhereId as $row) {
                                $jabatan = $row->jabatan;
                            }
                            echo $jabatan;
                        }
                            ?>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?= base_url();?>index.php/administrator/profil.html" class="btn btn-info btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url(); ?>index.php/login/logout/<?= $a['username']; ?>" class="btn btn-danger btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
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
                $('#time').html('<span style="font-size:12pt;"><strong>At : '+waktu+'</strong></span>');
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
            var tanggal = day + " " + months[month] + " " +year
            $('#date').html('<span style="font-size:12pt;"><strong>Tanggal : '+tanggal+'</strong></span>');
        </script>
   