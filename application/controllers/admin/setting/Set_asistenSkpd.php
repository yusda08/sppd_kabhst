<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Set_asistenSkpd extends CI_Controller {

    var $API = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_setting');
        $this->load->model('Data_aksi');
        $this->load->model('Tgl_indo');
        $this->load->model('Data_surat_tugas');
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
    }
    
     function lihat_asistenSkpd($id_asisten) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id['nama'] = $a['nama'];
            $id['foto'] = $a['foto'];
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav', $id, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Setting Bidang Urusan / Sub Asisten';
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['get_SetAsistenSkpdWhereAsisten'] = $this->Data_setting->get_SetAsistenSkpdWhereAsisten($id_asisten);
            $record['get_SetAsistenWhereId'] = $this->Data_setting->get_SetAsistenWhereId($id_asisten);
            $record['id_asisten'] = $id_asisten;
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/setting/lihat_asisten_skpd', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

function modal_tambahSkpdAsisten($id) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $record['get_SetAsistenWhereId'] = $this->Data_setting->get_SetAsistenWhereId($id);
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $get_page = $this->load->view('admin/data/modal/modal_tambahSkpdAsisten', $record, true);
            echo $get_page;
        }
    }
    function insert_urusanAsisten() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $asisten = $this->input->post('asisten');
            $id_asisten = $this->input->post('id_asisten');
            $skpd = $this->input->post('skpd');
            $jum = count($skpd);
       
                $query = $this->Data_aksi->insert('tbl_setting_asisten_skpd', $data);
         
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambah');
                $activity = 'Menambahkan Setting SKPD dengan Asisten : ' . $asisten;
                $this->Data_aksi->aktivitas($activity);
                redirect($url);
            } else {
                $this->session->set_flashdata('tipe', 'alert-danger');
                $this->session->set_flashdata('msg', 'Gagal menambahkan data');
                redirect($url);
            }
        } else {
            redirect('login');
        }
    }
    
    function insert_skpdAsisten() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
          //  $asisten = $this->input->post('asisten');
            $data['id_asisten'] = $this->input->post('id_asisten');
           $data['nama_urusan'] = $this->input->post('nama_urusan');
           $query = $this->Data_aksi->insert('tbl_setting_asisten_skpd', $data);
            if ($query) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambah');
                $activity = 'Menambahkan Setting Urusan';
                $this->Data_aksi->aktivitas($activity);
                redirect($url);
            } else {
                $this->session->set_flashdata('tipe', 'alert-danger');
                $this->session->set_flashdata('msg', 'Gagal menambahkan data');
                redirect($url);
            }
        } else {
            redirect('login');
        }
    }
    function delete_asistenSkpd() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $query = $this->Data_aksi->delete('id', $id, 'tbl_setting_asisten_skpd');
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil dihapus');
                $activity = 'Menghapus Setting Asisten SKPD dengan  ID: ' . $id;
                $this->Data_aksi->aktivitas($activity);
                redirect($url);
            } else {
                $this->session->set_flashdata('tipe', 'alert-danger');
                $this->session->set_flashdata('msg', 'Gagal menghapus data');
                redirect($url);
            }
        } else {
            redirect('login');
        }
    }
}
