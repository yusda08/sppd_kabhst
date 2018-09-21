<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_login');
    }

    public function index() {
        $a = $this->session->userdata('is_login');
        if ($a['level_user'] == '1') { 
            redirect('administrator'); //administator
        } elseif ($a['level_user'] == '2') {
            redirect('admin_skpd'); //Admin SKPD
        } elseif ($a['level_user'] == '3') {
            redirect('administrator'); //Executif
        } elseif ($a['level_user'] == '4') {
            redirect('administrator'); //Staf ahli
        } elseif ($a['level_user'] == '5') {
            redirect('admin_skpd'); //Kepala SKPD
        } elseif ($a['level_user'] == '6') {
            redirect('administrator'); //Sekretaris Daerah
        } elseif ($a['level_user'] == '7') {
            redirect('administrator'); //Asisten
        } else {
            $record['get_level_user'] = $this->Data_login->get_level_user();
            $this->load->view('login', $record);
        }
    }

    public function validasi() {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $level_user = $this->input->post('level_user');

        $query = $this->Data_login->validate($username, $password, $level_user);
        if ($query) {
            foreach ($query as $row) {
                $username = $row->username;
                $password = $row->password;
                $level_user = $row->level_user;
                $email = $row->email;
                $is_lock = $row->is_lock;
                $nama = $row->nama;
                $ol = $row->ol;
                $last_date = $row->last_date;
                $last_time = $row->last_time;
                $log_time = $row->log_time;
                $log_date = $row->log_date;
                $foto = $row->foto;
                $id = $row->id;
                $kode = $row->kode;
            }
            if ($level_user == '2') {

                if ($is_lock == 1) {
                    $is_lock = true;
                } else {
                    $is_lock = false;
                };
            }

            $data = array(
                'username' => $username,
                'nama' => $nama,
                'foto' => $foto,
                'level_user' => $level_user,
                'id' => $id,
                'is_lock' => $is_lock,
                'last_date' => $last_date,
                'last_time' => $last_time,
                'log_time' => $log_time,
                'log_date' => $log_date,
                'ol' => $ol,
                'kode' => $kode,
                'email' => $email,
                'is_login' => true
            );

            $this->session->set_userdata('is_login', $data);
            $this->log_masuk($username);
            return print_r('true');
        } else {  //username atau password salah
            return false;
        }
    }

    function log_masuk($username) {
        $date = date('Y-m-d');
        $time = date('h:i:s');
        $this->Data_login->setLogLogin($username, $date, $time);
        $this->load->library('user_agent');
        if ($this->agent->is_browser()) {
            $keterangan = $this->agent->browser() . ' ' . $this->agent->version() . ' (' . $this->agent->platform() . ')';
        } elseif ($this->agent->is_robot()) {
            $keterangan = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $keterangan = $this->agent->mobile();
        } else {
            $keterangan = 'Unidentified User Agent';
        }
        $akses = 'Masuk';
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->Data_login->insert_log_akses($username, $date, $time, $akses, $ip, $keterangan);
    }

    function logout($username) {
        $a = $this->session->userdata('is_login');
        $this->session->unset_userdata('is_login');
        $this->log_keluar($username);
        $this->session->sess_destroy();
        redirect('login');
    }

    function log_keluar($username) {
        date_default_timezone_set("Asia/Jakarta");
        $date = date('Y-m-d');
        $time = date('h:i:s');
        $this->Data_login->setLastLogin($username, $date, $time);

        $this->load->library('user_agent');
        if ($this->agent->is_browser()) {
            $keterangan = $this->agent->browser() . ' ' . $this->agent->version() . ' (' . $this->agent->platform() . ')';
        } elseif ($this->agent->is_robot()) {
            $keterangan = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $keterangan = $this->agent->mobile();
        } else {
            $keterangan = 'Unidentified User Agent';
        }
        $akses = 'Keluar';
        $ip = $_SERVER['REMOTE_ADDR'];

        $this->Data_login->insert_log_akses($username, $date, $time, $akses, $ip, $keterangan);
    }

}

?>