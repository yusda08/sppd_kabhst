<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Set_kewenangan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_setting');
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
            $record['page_name'] = 'Setting Persetujuan Kewenangan';
            $record['get_SetKewenanganJoinTtd'] = $this->Data_setting->get_SetKewenanganJoinTtd();
            $record['get_SetKewenangan'] = $this->Data_setting->get_SetKewenangan();
            $record['get_refTtd'] = $this->Data_referensi->get_refTtd();

            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/setting/set_kewenangan', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function modal_editKewenanganDetail($id, $id_kewenangan) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['get_SetAsistenWhereId'] = $this->Data_setting->get_SetKewenanganDetailWhereId($id);
            $record['get_SetKewenanganDetailWhereIdKewenangan'] =  $this->Data_setting->get_SetKewenanganDetailWhereIdKewenangan($id_kewenangan);
            $record['get_refTtd'] = $this->Data_referensi->get_refTtd();
            $get_page = $this->load->view('admin/data/modal/modal_editKewenanganDetail', $record, true);
            echo $get_page;
        }
    }

    function insert_kewenangan() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id_ttd = $this->input->post('id_ttd');
            $data['id_ttd'] = $id_ttd;
            $query = $this->Data_aksi->insert('tbl_setting_kewenangan', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Setting Kewenangan Dengan ID TTD : ' . $id_ttd;
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

    function insert_kewenangan_detail() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id_ttd = $this->input->post('id_ttd');
            $id_kewenangan = $this->input->post('id_kewenangan');
            $urutan = $this->input->post('urutan');
            $data['id_ttd'] = $id_ttd;
            $data['id_kewenangan'] = $id_kewenangan;
            $data['urutan'] = $urutan;
            $query = $this->Data_aksi->insert('tbl_setting_kewenangan_detail', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Setting Kewenangan Dengan ID TTD : ' . $id_ttd;
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

    function update_kewenangan_detail() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $id_ttd = $this->input->post('id_ttd');
            $id_kewenangan = $this->input->post('id_kewenangan');
            $urutan = $this->input->post('urutan');
            $jam_disposisi = $this->input->post('jam_disposisi');
            $data['id_ttd'] = $id_ttd;
            $data['id_kewenangan'] = $id_kewenangan;
            $data['urutan'] = $urutan;
            $data['jam_disposisi'] = $jam_disposisi;
//            var_dump($data);
//            return;
            
            $query = $this->Data_aksi->update('id',$id,'tbl_setting_kewenangan_detail', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil Diedit');
                $activity = 'Merubah Setting Kewenangan Dengan ID TTD : ' . $id_ttd . 'pada ID Kewenangan' .$id_kewenangan;
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
    
    function cek_dataKewenangan($id) {
        $cek = $this->Data_setting->count_dataKewenanganId($id);
        echo json_encode($cek);
    }
    
    function delete_kewenangan_detail() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $id_kewenangan = $this->input->post('id_kewenangan');
//            var_dump($data);
//            return;
            $query = $this->Data_aksi->delete('id',$id,'tbl_setting_kewenangan_detail');
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil Di Hapus');
                $activity = 'Menghapus Setting Kewenangan Detail Dengan ID TTD : ' . $id_kewenangan . ' dengan Nama ' .$nama;
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
    function delete_kewenangan() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
//            var_dump($data);
//            return;
            $query = $this->Data_aksi->delete('id',$id,'tbl_setting_kewenangan');
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil Di Hapus');
                $activity = 'Menghapus Setting Kewenangan Dengan ID TTD : ' . $id. ' dan Nama ' .$nama;
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
    function update_kewenangan() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $jam_persetujuan = $this->input->post('jam_persetujuan');
            $data['jam_persetujuan']=$jam_persetujuan;
            $query = $this->Data_aksi->update('id',$id,'tbl_setting_kewenangan', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil Di Edit');
                $activity = 'Update Setting Kewenangan Dengan ID TTD : ' . $id. ' dan Nama ' .$nama;
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
