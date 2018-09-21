<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ref_provinsi
 *
 * @author zaky
 */
class Ref_provinsi extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Data_aksi');
        $this->load->model('Data_referensi');
        $this->load->model('data_login');
        $this->load->model('Tgl_indo');
        $this->load->model('Data_pegawai');
        $this->load->model('Data_surat_tugas');
    }
    //put your code here
    function index() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id['nama'] = $a['nama'];
            $id['foto'] = $a['foto'];
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav', $id, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Referensi Provinsi';
            $record['get_refProv'] = $this->Data_referensi->get_refProv();
            $record['get_refAlatangkut'] = $this->Data_referensi->get_refAlatangkut();
//            $record['max_refTujuan'] = $this->Data_referensi->max_refTujuan();
//            $record['get_refJabatan'] = $this->Data_referensi->get_refJabatan();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/referensi/ref_provinsi', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }
    
    function insert_provinsi() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $nama = $this->input->post('nama');
            $tingkat = $this->input->post('tingkat');
            $data['nama'] = $nama;

            $query = $this->Data_aksi->insert('tbl_ref_provinsi', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Refrensi Provinsi dengan nama : ' . $nama;
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
    function update_provinsi() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            
            $data['nama'] = $nama;
            
            $query = $this->Data_aksi->update('id', $id, 'tbl_ref_provinsi', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil di Edit');
                $activity = 'Mengubah Refrensi Provinsi dengan id : ' . $id . ' Dengan Nama : ' . $nama;
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
    function insert_alat() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $alat = $this->input->post('alat');
            $biaya = $this->input->post('biaya');
            $data['alat_angkut'] = $alat;
            $data['biaya'] = $biaya;
            $query = $this->Data_aksi->insert('tbl_ref_alat_angkut', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Refrensi Alat Angkut : ' . $nama;
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
    function update_alat() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $alat = $this->input->post('alat');
            $biaya = $this->input->post('biaya');
            $data['alat_angkut'] = $alat;
            $data['biaya'] = $biaya;
            
            $query = $this->Data_aksi->update('id', $id, 'tbl_ref_alat_angkut', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil di Edit');
                $activity = 'Mengubah Refrensi Alat Angkut  id : ' . $id . ' Dengan Nama : ' . $nama;
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
    function delete_alat() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $nama = $this->input->post('alat');
            $query = $this->Data_aksi->delete('id', $id, 'tbl_ref_alat_angkut');
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil di Hapus');
                $activity = 'Menghapus Refrensi Alat Angkut : ' . $id . ' Dengan Nama : ' . $alat;
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
