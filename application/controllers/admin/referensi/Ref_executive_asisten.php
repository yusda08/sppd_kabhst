<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ref_executive
 *
 * @author zaky
 */
class Ref_executive_asisten extends CI_Controller {
  public function __construct() {
        parent::__construct();
        $this->load->model('Data_aksi'); 
        $this->load->model('data_referensi'); 
        $this->load->model('data_login'); 
        $this->load->model('tgl_indo');
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
            $record['page_name'] = 'Referensi Executive dan asisten';
            $record['get_ref_executive'] = $this->data_referensi->get_ref_executive();
            $record['get_refAsisten'] = $this->data_referensi->get_refAsisten();
            $record['count_refAsisten'] = $this->data_referensi->count_refAsisten();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/referensi/ref_executive_asisten', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }
    function insert_executive() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $nama = $this->input->post('nama');
            $data['nama'] = $nama;
            
            $query = $this->Data_aksi->insert('tbl_ref_executive', $data);
                if ($query > 0) {
                    $this->session->set_flashdata('tipe', 'alert-success');
                    $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                    $activity = 'Menambah Refrensi Executive dengan nama : '.$nama;
                    $this->Data_aksi->aktivitas($activity);
                    redirect($url);
                }else{
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
            $nama = $this->input->post('nama');
            $data['nama'] = $nama;
            
            $query = $this->Data_aksi->update('id',$id,'tbl_ref_executive', $data);
                if ($query > 0) {
                    $this->session->set_flashdata('tipe', 'alert-success');
                    $this->session->set_flashdata('msg', 'Data berhasil diedit');
                    $activity = 'Mengedit Refrensi Executive dengan id : '.$id. ' Nama Baru : '.$nama;
                    $this->Data_aksi->aktivitas($activity);
                    redirect($url);
                }else{
                    $this->session->set_flashdata('tipe', 'alert-danger');
                    $this->session->set_flashdata('msg', 'Gagal Mengedit data');
                    redirect($url);
                }
            } else {
            redirect('login');
        }
    }
    function delete_executive() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            
            $query = $this->Data_aksi->delete('id',$id,'tbl_ref_executive');
                if ($query > 0) {
                    $this->session->set_flashdata('tipe', 'alert-success');
                    $this->session->set_flashdata('msg', 'Data berhasil Di Hapus');
                    $activity = 'Menghapus Refrensi Executive dengan id : '.$id. ' Dengan Nama : '.$nama;
                    $this->Data_aksi->aktivitas($activity);
                    redirect($url);
                }else{
                    $this->session->set_flashdata('tipe', 'alert-danger');
                    $this->session->set_flashdata('msg', 'Gagal Menghapus data');
                    redirect($url);
                }
            } else {
            redirect('login');
        }
    }
    
    function insert_asisten() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $nama = $this->input->post('nama');
            $id = $this->input->post('id');
            $data['nama'] = $nama;
            $data['id'] = $id;
            
            $query = $this->Data_aksi->insert('tbl_ref_asisten', $data);
                if ($query > 0) {
                    $this->session->set_flashdata('tipe', 'alert-success');
                    $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                    $activity = 'Menambah Refrensi Asisten dengan nama : '.$nama;
                    $this->Data_aksi->aktivitas($activity);
                    redirect($url);
                }else{
                    $this->session->set_flashdata('tipe', 'alert-danger');
                    $this->session->set_flashdata('msg', 'Gagal menambahkan data');
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
            
            $query = $this->Data_aksi->delete('id', $id, 'tbl_ref_asisten');
                if ($query > 0) {
                    $this->session->set_flashdata('tipe', 'alert-success');
                    $this->session->set_flashdata('msg', 'Data berhasil Menghapus');
                    $activity = 'Menghapus Refrensi Asisten dengan id : '.$id;
                    $this->Data_aksi->aktivitas($activity);
                    redirect($url);
                }else{
                    $this->session->set_flashdata('tipe', 'alert-danger');
                    $this->session->set_flashdata('msg', 'Gagal menambahkan data');
                    redirect($url);
                }
            } else {
            redirect('login');
        }
    }
}
