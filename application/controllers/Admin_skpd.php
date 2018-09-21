<?php

class Admin_skpd extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->API = 'http://sppd.hulusungaitengahkab.go.id/reset_api/index.php';
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
        $this->load->model('data_administrator');
        $this->load->model('Data_aksi');
        $this->load->model('data_login');
        $this->load->model('Tgl_indo');
        $this->load->model('Data_setting');
        $this->load->model('Data_notadinas');
        $this->load->model('Data_surat_tugas');
    }

    function index() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $level = $a['level_user'];
            if ($level == 2) {
                $kode_skpd = $a['kode'];
            } elseif ($level == 5) {
                $kode_skpd = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
            }
            
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Dashboard';
            $record['kode_skpd'] = $kode_skpd;
            $record['totalskpd'] = $this->Data_notadinas->get_totalnotadinasbystatus($kode_skpd);
            $record['sum'] = $this->Data_setting->sum_realisasiAnggaranSkpd($kode_skpd);
            $record['jml_dalam'] = $this->Data_surat_tugas->sum_realisasiAnggaranDalamSkpd($kode_skpd);
            $record['jml_luar'] = $this->Data_surat_tugas->sum_realisasiAnggaranLuarSkpd($kode_skpd);
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            if ($level == 2) {
                $record['get_skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            } elseif ($level == 5) {
                $record['get_setSkpdWhereLevel'] = $this->Data_setting->get_setSkpdWhereLevel($kode_skpd, $level);
            }
            $data['content'] = $this->load->view('skpd/dashboard', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

}
