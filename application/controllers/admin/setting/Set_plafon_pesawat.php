<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Set_plafon_pesawat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_setting');
        $this->load->model('Data_pegawai');
        $this->load->model('Data_referensi');
        $this->load->model('Data_aksi');
        $this->load->model('Tgl_indo');
        $this->load->model('Data_surat_tugas');
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
            $record['page_name'] = 'Setting Plafon Tiket Pesawat (PP)';
            $record['get_plafonPesawat'] = $this->Data_setting->get_setPlafonPesawat();
            $record['get_dataPegawai'] = $this->Data_pegawai->get_dataPegawai();
            $record['get_refAsisten'] = $this->Data_referensi->get_refAsisten();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/setting/set_plafon_pesawat', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }
    
    function insert_plafon() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $asal = $this->input->post('asal');
            $tujuan = $this->input->post('tujuan');
            $bisnis = $this->input->post('bisnis');
            $ekonomi = $this->input->post('ekonomi');
            $ket = $this->input->post('ket');

            $data['kota_asal'] = $asal;
            $data['kota_tujuan'] = $tujuan;
            $data['bisnis'] = $bisnis;
            $data['ekonomi'] = $ekonomi;
            $data['ket'] = $ket;

            $query = $this->Data_aksi->insert('tbl_set_pesawat', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Setting Pesawat dengan kota : ' . $asal.'-'.$tujuan;
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
    function update_plafon(){
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $asal = $this->input->post('asal');
            $tujuan = $this->input->post('tujuan');
            $ekonomi = $this->input->post('ekonomi');
            $bisnis = $this->input->post('bisnis');
            $ket = $this->input->post('ket');
            $data['kota_asal'] = $asal;
            $data['kota_tujuan'] = $tujuan;
            $data['ekonomi'] = $ekonomi;
            $data['bisnis'] = $bisnis;
            $data['ket'] = $ket;
            $query = $this->Data_aksi->update('id', $id, 'tbl_set_pesawat', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil diedit');
                $activity = 'Mengedit Setting Plafon Pesawat : ' . $asal.'-'.$tujuan;
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
    function hapus_plafon() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $asal = $this->input->post('asal');
            $tujuan = $this->input->post('tujuan');
            $query = $this->Data_aksi->delete('id', $id, 'tbl_set_pesawat');
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menghapus Setting Plafon Pesawat : ' . $asal.'-'.$tujuan;
                $this->Data_aksi->aktivitas($activity);
                redirect($url);
            } else {
                $this->session->set_flashdata('tipe', 'alert-danger');
                $this->session->set_flashdata('msg', 'Gagal Menghapus data');
                redirect($url);
            }
        } else {
            redirect('login');
        }
    }
}
