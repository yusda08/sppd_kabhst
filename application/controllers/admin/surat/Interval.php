<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once APPPATH . '/libraries/vendor/autoload.php';
date_default_timezone_set("Asia/Makassar");

class Interval extends CI_Controller {

    var $API = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_setting');
        $this->load->model('Data_pegawai');
        $this->load->model('Data_referensi');
        $this->load->model('Data_notadinas');
        $this->load->model('Data_administrator');
        $this->load->model('Data_surat_tugas');
        $this->load->model('Data_aksi');
        $this->load->model('Tgl_indo');
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
    }

    function index() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $data['head'] = $this->load->view('head', NULL, TRUE);
//            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
//            $data['nav'] = $this->load->view('nav', NULL, TRUE);
//            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Nota Dinas';
            $record['get_notaDinasAll'] = $this->Data_notadinas->get_notaDinasAll();
            
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/surat/interval/nota_dinas_all', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function tabel_nota_dinas_all() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['get_notaDinasAll'] = $this->Data_notadinas->get_notaDinasAll();
            $record['get_SetKewenangan'] = $this->Data_setting->get_SetKewenangan();
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $get_page = $this->load->view('admin/data/surat/interval/tabel_nota_dinas_all', $record, true);
            echo $get_page;
        }
    }

    function insert_interval() {
        $kd_user = $this->input->post('kd_user');
        $id_nd = $this->input->post('id_nd');
        if ($kd_user != 1) {
            $id_kew = $this->input->post('id_kew_as');
            $data['kode_user'] = $kd_user;
        } else {
            $id_kew = $this->input->post('id_kew_sek');
            $data['kode_user'] = $kd_user;
        }
        $data['tgl_time_disposisi'] = date('Y-m-d H:i:s');
        $data['id_nota_dinas'] = $id_nd;
        $data['id_kewenangan_detail'] = $id_kew;
        $data['posting'] = 1;
//        var_dump($data);
//        return;
        $this->Data_aksi->insert('tbl_disposisi', $data);
    }

    function update_interval() {
        $id = $this->input->post('id_nd');
        $data['status_persetujuan'] = 1;
        $data['tgl_persetujuan'] = date('Y-m-d H:i:s');
        $data['catatan_persetujuan'] = 'Setuju';
        $this->Data_aksi->update('id', $id, 'tbl_nota_dinas', $data);
    }

}
