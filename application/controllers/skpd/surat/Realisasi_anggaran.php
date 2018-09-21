<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Realisasi_anggaran extends CI_Controller {

    var $API = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_setting');
        $this->load->model('Data_pegawai');
        $this->load->model('Data_notadinas');
        $this->load->model('Data_aksi');
        $this->load->model('Tgl_indo');
        $this->load->model('Data_surat_tugas');
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
    }


    function inputRealisasiAnggaran($id_skpd) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id['nama'] = $a['nama'];
            $id['foto'] = $a['foto'];
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', $id, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Data Input Realisasi Anggaran';
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['id_skpd'] = $id_skpd;
            $record['get_realisasiAnggaranLuarWhereSkpd'] = $this->Data_surat_tugas->get_realisasiAnggaranLuarWhereSkpd($id_skpd);
            $record['get_realisasiAnggaranDalamWhereSkpd'] = $this->Data_surat_tugas->get_realisasiAnggaranDalamWhereSkpd($id_skpd);
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/realisasi/input_realisasi', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }
}
