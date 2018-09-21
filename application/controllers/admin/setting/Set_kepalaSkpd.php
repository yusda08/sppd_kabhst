<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Set_kepalaSkpd extends CI_Controller {

    var $API = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_setting');
        $this->load->model('Data_pegawai');
        $this->load->model('Data_aksi');
        $this->load->model('Tgl_indo');
        $this->load->model('Data_surat_tugas');
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
    }
    
     function index() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id['nama'] = $a['nama'];
            $id['foto'] = $a['foto'];
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav', $id, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Setting Kepala SKPD';
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['get_setSkpd'] = $this->Data_setting->get_setSkpd();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/setting/set_kepalaSkpd', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }
    function pegawaiSkpd($id) {
        $query  = $this->Data_pegawai->get_dataPegawaiWhereKd($id);
        $data = "<option value=''>-- Pilih Pegawai--</option>";
        foreach ($query as $row) {
            if($row->status_pegawai == 'pns')
            $data .= "<option  value='" . $row->nip_nik . "' data-nip='" . $row->nip_nik . "'"
                    . "data-jabatan='" . $row->jabatan . "'>" . $row->nama. "</option>";
        }
        echo $data;
    }
    
     function modal_editKepalaSkpd($id) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['get_dataPegawaiWhereKd'] = $this->Data_pegawai->get_dataPegawaiWhereKd($id);
            $record['get_SetKepalaSkpdWhereKd'] = $this->Data_setting->get_SetKepalaSkpdWhereKd($id);
            $get_page = $this->load->view('admin/data/modal/modal_editKepalaSkpd', $record, true);
            echo $get_page;
        }
    }
     function modal_editSettingSkpd($id) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['get_setSkpdWhereKd'] = $this->Data_setting->get_setSkpdWhereKd($id);
            $get_page = $this->load->view('admin/data/modal/modal_editSettingSkpd', $record, true);
            echo $get_page;
        }
    }

     function update_kepalaSkpd() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $kode_skpd = $this->input->post('kode_skpd');
            $email = $this->input->post('email');
            $nip = $this->input->post('nip');
            $data['email'] = $email;
            $data['nip'] = $nip;
            $query = $this->Data_aksi->update('kode_skpd', $kode_skpd, 'tbl_setting_kepala_skpd', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil diedit');
                $activity = 'Mengedit Setting Kepala SKPD dengan NIP Pegawai : ' . $nip;
                $this->Data_aksi->aktivitas($activity);
                redirect($url);
            } else {
                $this->session->set_flashdata('tipe', 'alert-danger');
                $this->session->set_flashdata('msg', 'Gagal Mengedit data');
                redirect($url);
            }
        } else {
            redirect('login');
        }
    }
    
    function insert_kepalaSkpd() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $email = $this->input->post('email');
            $nip = $this->input->post('nip');
            $kode_skpd = $this->input->post('kode_skpd');

            $data['email'] = $email;
            $data['nip'] = $nip;
            $data['kode_skpd'] = $kode_skpd;
            $data['id_ttd'] = 6;
            $data['id'] = date('YmdHsi');

            $query = $this->Data_aksi->insert('tbl_setting_kepala_skpd', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Setting Kepala SKPD dengan NIP Pegawai : ' . $nip;
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
    function insert_settingSkpd() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $email = $this->input->post('email');
            $kode_skpd = $this->input->post('kode_skpd');
            $no_telpon = $this->input->post('no_telpon');
            $kode_pos = $this->input->post('kode_pos');
            $inisial = $this->input->post('inisial');
            $alamat = addslashes($this->input->post('alamat'));

            $data['email'] = $email;
            $data['alamat'] = $alamat;
            $data['no_telpon'] = $no_telpon;
            $data['kode_pos'] = $kode_pos;
            $data['kode_skpd'] = $kode_skpd;
            $data['inisial'] = $inisial;

            $query = $this->Data_aksi->insert('tbl_setting_skpd', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil Disetting');
                $activity = 'Menambah Setting SKPD Dengan Kode SKPD : ' . $kode_skpd;
                $this->Data_aksi->aktivitas($activity);
                redirect($url);
            } else {
                $this->session->set_flashdata('tipe', 'alert-danger');
                $this->session->set_flashdata('msg', 'Data Gagal Di Setting');
                redirect($url);
            }
        } else {
            redirect('login');
        }
    }
    
    function update_settingSkpd() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $email = $this->input->post('email');
            $kode_skpd = $this->input->post('kode_skpd');
            $no_telpon = $this->input->post('no_telpon');
            $kode_pos = $this->input->post('kode_pos');
            $inisial = $this->input->post('inisial');
            $alamat = addslashes($this->input->post('alamat'));

            $data['email'] = $email;
            $data['alamat'] = $alamat;
            $data['no_telpon'] = $no_telpon;
            $data['kode_pos'] = $kode_pos;
            $data['inisial'] = $inisial;

            $query = $this->Data_aksi->update('kode_skpd', $kode_skpd,'tbl_setting_skpd', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil Disetting');
                $activity = 'Merubah Setting SKPD Dengan Kode SKPD : ' . $kode_skpd;
                $this->Data_aksi->aktivitas($activity);
                redirect($url);
            } else {
                $this->session->set_flashdata('tipe', 'alert-danger');
                $this->session->set_flashdata('msg', 'Data Gagal Di Setting');
                redirect($url);
            }
        } else {
            redirect('login');
        }
    }
    function update_koutaAnggaranLuar() {
        $kode_skpd = $this->input->post('name');
        $value = $this->input->post('value');
        $data['kouta_anggaran_luar'] = $value;
        $query = $this->Data_aksi->update('kode_skpd', $kode_skpd,'tbl_setting_skpd', $data);
        $yes = array('success' => true, 'msg' => 'true');
        $no = array('success' => false, 'msg' => 'false');
        if ($query) {
            echo json_encode($yes);
        } else {
            echo json_encode($no);
        }
    }
    function update_koutaAnggaranDalam() {
        $kode_skpd = $this->input->post('name');
        $value = $this->input->post('value');
        $data['kouta_anggaran_dalam'] = $value;
        $query = $this->Data_aksi->update('kode_skpd', $kode_skpd,'tbl_setting_skpd', $data);
        $yes = array('success' => true, 'msg' => 'true');
        $no = array('success' => false, 'msg' => 'false');
        if ($query) {
            echo json_encode($yes);
        } else {
            echo json_encode($no);
        }
    }
    
}