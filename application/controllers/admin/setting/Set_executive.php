<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Set_executive extends CI_Controller {

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
            $record['page_name'] = 'Setting Executive';
            $record['get_SetExecutiveJoinBank'] = $this->Data_setting->get_SetExecutiveJoinBank();
            $record['get_ref_executive'] = $this->Data_referensi->get_ref_executive();
            $record['get_refbank'] = $this->Data_referensi->get_refBank();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/setting/set_executive', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }


    function modal_editExecutive($id) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['get_SetExecutiveWhereId'] = $this->Data_setting->get_SetExecutiveWhereId($id);
           $record['get_ref_executive'] = $this->Data_referensi->get_ref_executive();
            $record['get_refbank'] = $this->Data_referensi->get_refBank();
            $get_page = $this->load->view('admin/data/modal/modal_editExecutive', $record, true);
            echo $get_page;
        }
    }
    function insert_executive() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $email = $this->input->post('email');
            $nama = $this->input->post('nama');
            $id_bank = $this->input->post('id_bank');
            $no_rek = $this->input->post('no_rekening');
            $id_executive = $this->input->post('id_executive');

            $data['email'] = $email;
            $data['nama'] = $nama;
            $data['id_bank'] = $id_bank;
            $data['no_rekening'] = $no_rek;
            $data['id_executive'] = $id_executive;

            $query = $this->Data_aksi->insert('tbl_setting_executive', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Exekutif Dengan Nama : ' . $nama;
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
    
    function update_executive() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $email = $this->input->post('email');
            $nama = $this->input->post('nama');
            $id_bank = $this->input->post('id_bank');
            $no_rek = $this->input->post('no_rekening');
            $id_executive = $this->input->post('id_executive');
            $data['email'] = $email;
            $data['nama'] = $nama;
            $data['id_bank'] = $id_bank;
            $data['no_rekening'] = $no_rek;
            $data['id_executive'] = $id_executive;
            $query = $this->Data_aksi->update('id', $id, 'tbl_setting_executive', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil diedit');
                $activity = 'Mengedit Setting Executif dengan nama ID : ' . $id;
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


}
