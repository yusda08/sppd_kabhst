<?php

Class Rest_pegawai extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
//        $this->API= base_url()."reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
    }
    
    function index(){
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');

            $id['nama'] = $a['nama'];
            $id['foto'] = $a['foto'];
            $id['get_refKatgor'] = $this->Data_ref->get_refKatgor();
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav', $id, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Data Pegawai';
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $record['pegawai'] = json_decode($this->curl->simple_get($this->API.'/api_pegawai'));
            $data['content'] = $this->load->view('admin/data/pegawai', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }
}