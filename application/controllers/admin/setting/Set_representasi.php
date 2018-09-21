<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Set_representasi
 *
 * @author zaky
 */
class Set_representasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_setting');
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
            $record['page_name'] = 'Setting Representasi';
            $record['get_representasi'] = $this->Data_setting->get_representasi();
            $record['get_jabatan'] = $this->Data_setting->get_jabatan();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/setting/set_representasi', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }
    function insert_representasi(){
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $jab = $this->input->post('jab');
            $uang = $this->input->post('uang');
            $data['id_jabatan'] = $jab;
            $data['uang_harian'] = $uang;
            
            $query = $this->Data_aksi->insert('tbl_setting_representasi', $data);
                if ($query > 0) {
                    $this->session->set_flashdata('tipe', 'alert-success');
                    $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                    $activity = 'Menambah Setting Representasi dengan Jabatan id '.$jab.' dan uang .'.$uang;
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
    
    function hapus_representasi() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $uang = $this->input->post('uang');
            $nama = $this->input->post('nama');
            
            $query = $this->Data_aksi->delete('id', $id, 'tbl_setting_representasi');
                if ($query > 0) {
                    $this->session->set_flashdata('tipe', 'alert-success');
                    $this->session->set_flashdata('msg', 'Data berhasil Menghapus');
                    $activity = 'Menghapus Representasi dengan nama '.$uang.' dan jabatan '.$nama;
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
    function update_representasi(){
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $uang = $this->input->post('uang');
            $nama = $this->input->post('nama');
            $data['uang_harian'] = $uang;
            $query = $this->Data_aksi->update('id', $id, 'tbl_setting_representasi', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil diedit');
                $activity = 'Mengedit Setting Representasi : ' . $uang.'-'.$nama;
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
