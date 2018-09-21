<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Set_asisten extends CI_Controller {

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
            $record['page_name'] = 'Setting Asisten';
            $record['get_SetAsisten'] = $this->Data_setting->get_SetAsisten();
            $record['get_dataPegawai'] = $this->Data_pegawai->get_dataPegawai();
            $record['get_refAsisten'] = $this->Data_referensi->get_refAsisten();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/setting/set_asisten', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function cek_dataSetAsisten($id) {
        $cek = $this->Data_setting->count_SetAsistenSkpd($id);
        echo json_encode($cek);
    }
    function cek_dataAsisten($id) {
        $cek = $this->Data_setting->count_SetAsisten($id);
        echo json_encode($cek);
    }

    function modal_editAsisten($id) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['get_SetAsistenWhereId'] = $this->Data_setting->get_SetAsistenWhereId($id);
            $record['get_refAsisten'] = $this->Data_referensi->get_refAsisten();
            $record['get_dataPegawai'] = $this->Data_pegawai->get_dataPegawai();
            $get_page = $this->load->view('admin/data/modal/modal_editAsisten', $record, true);
            echo $get_page;
        }
    }

    function modal_hapusAsisten($id) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['get_SetAsistenWhereId'] = $this->Data_setting->get_SetAsistenWhereId($id);
            $get_page = $this->load->view('admin/data/modal/modal_hapusAsisten', $record, true);
            echo $get_page;
        }
    }
    

    function insert_asisten() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $email = $this->input->post('email');
            $nip = $this->input->post('nip');
            $asisten = $this->input->post('asisten');

            $data['email'] = $email;
            $data['nip_nik'] = $nip;
            $data['asisten'] = $asisten;

            $query = $this->Data_aksi->insert('tbl_setting_asisten', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Setting Asisten dengan nama NIP Pegawai : ' . $nip;
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
    

    function update_asisten() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $email = $this->input->post('email');
            $nip = $this->input->post('nip');
            $asisten = $this->input->post('asisten');
            $data['email'] = $email;
            $data['nip_nik'] = $nip;
            $data['asisten'] = $asisten;
            $query = $this->Data_aksi->update('id', $id, 'tbl_setting_asisten', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil diedit');
                $activity = 'Mengedit Setting Asisten dengan nama NIP Pegawai : ' . $nip;
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

    function delete_asisten() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $email = $this->input->post('email');
            $nip = $this->input->post('nip');
            $asisten = $this->input->post('asisten');
            $query = $this->Data_aksi->delete('id', $id, 'tbl_setting_asisten');
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menghapus Setting Asisten dengan nama NIP Pegawai : ' . $nip . 'dan ID :' . $id;
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
