<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Set_stafAhli extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_setting');
        $this->load->model('Data_pegawai');
        $this->load->model('Data_aksi');
        $this->load->model('Data_surat_tugas');
        $this->load->model('Tgl_indo');
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
            $record['page_name'] = 'Setting Staf Ahli Bupati';
            $record['get_setStafAhli'] = $this->Data_setting->get_setStafAhli();
            $record['get_dataPegawai'] = $this->Data_pegawai->get_dataPegawai();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/setting/set_stafAhli', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function modal_editStafAhli($id) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['get_setStafAhliWhereId'] = $this->Data_setting->get_setStafAhliWhereId($id);
            $record['get_dataPegawai'] = $this->Data_pegawai->get_dataPegawai();
            $get_page = $this->load->view('admin/data/modal/modal_editStafAhli', $record, true);
            echo $get_page;
        }
    }

    function insert_stafAhli() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $email = $this->input->post('email');
            $nip = $this->input->post('nip');
            $asisten = $this->input->post('asisten');

            $data['email'] = $email;
            $data['nip_nik'] = $nip;
            $data['id_ttd'] = 4;

            $query = $this->Data_aksi->insert('tbl_setting_staf_ahli', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Setting Setting Staf Ahli dengan nama NIP Pegawai : ' . $nip;
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
    function update_stafAhli() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $email = $this->input->post('email');
            $nip = $this->input->post('nip');

            $data['email'] = $email;
            $data['nip_nik'] = $nip;


            $query = $this->Data_aksi->update('id',$id, 'tbl_setting_staf_ahli', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Merobah Setting Setting Staf Ahli dengan ID : ' . $id;
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

}
