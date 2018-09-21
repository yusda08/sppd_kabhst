<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Set_sekda
 *
 * @author zaky
 */
class Set_sekda extends CI_Controller{
    //put your code here
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
            $record['page_name'] = 'Setting Sekda';
            $record['get_sekda'] = $this->Data_setting->get_sekda();
            $record['get_dataPegawai'] = $this->Data_pegawai->get_dataPegawai();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/setting/set_sekda', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }
    
    function update_sekda() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $nip = $this->input->post('nip');
            $email = $this->input->post('email');
            
            $data['nip_nik'] = $nip;
            $data['email'] = $email;
            
            $query = $this->Data_aksi->update('id', $id, 'tbl_setting_sekda', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil di Edit');
                $activity = 'Mengubah Sekda dengan id : ' . $id . ' Dengan NIP : ' . $nip;
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
