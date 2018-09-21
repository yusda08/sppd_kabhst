<?php

class Ref_jabatan_tujuan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_aksi');
        $this->load->model('Data_referensi');
        $this->load->model('data_login');
        $this->load->model('Tgl_indo');
        $this->load->model('Data_pegawai');
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
            $record['page_name'] = 'Referensi Jabatan dan tujuan';
            $record['get_refTujuan'] = $this->Data_referensi->get_refTujuan();
            $record['max_refTujuan'] = $this->Data_referensi->max_refTujuan();
            $record['get_refJabatan'] = $this->Data_referensi->get_refJabatan();
            $record['get_refRekening'] = $this->Data_referensi->get_refRekening();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/referensi/ref_jabatan_tujuan', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function modal_editRefJabatan() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id = $this->input->post('id');
            $record['get_refJabWhereId'] = $this->Data_referensi->get_refJabWhereId($id);
            $get_page = $this->load->view('admin/data/modal/modal_editRefJabatan', $record, true);
            echo $get_page;
        }
    }
    function modal_editRefRekening() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id = $this->input->post('id');
            $record['get_refRekening'] = $this->Data_referensi->get_refRekening();
            $record['id']=$id;
            $get_page = $this->load->view('admin/data/modal/modal_editRefRekening', $record, true);
            echo $get_page;
        }
    }

    function insert_jabatan() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $nama_jabatan = $this->input->post('nama_jabatan');
            $tingkat = $this->input->post('tingkat');
            $data['nama_jabatan'] = $nama_jabatan;
            $data['tingkat'] = $tingkat;

            $query = $this->Data_aksi->insert('tbl_ref_jabatan', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Refrensi Jabatan dengan nama : ' . $nama_jabatan;
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

    function update_jabatan() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $nama_jabatan = $this->input->post('nama_jabatan');
            $tingkat = $this->input->post('tingkat');
            
            $data['nama_jabatan'] = $nama_jabatan;
            $data['tingkat'] = $tingkat;
            
            $query = $this->Data_aksi->update('id', $id, 'tbl_ref_jabatan', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil di Edit');
                $activity = 'Mengubah Refrensi Jabatan dengan id : ' . $id . ' Dengan Nama : ' . $nama_jabatan;
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

    function cek_dataJabPgw($id) {
        $cek = $this->Data_pegawai->count_dataPegawai($id);
        echo json_encode($cek);
    }

    function delete_jabatan() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $nama_jabatan = $this->input->post('nama_jabatan');
            $query = $this->Data_aksi->delete('id', $id, 'tbl_ref_jabatan');
            $this->Data_aksi->delete('id_ref_jabatan', $id, 'tbl_setting_uang_harian');
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil di Hapus');
                $activity = 'Mengubah Refrensi Jabatan dengan id : ' . $id . ' Dengan Nama : ' . $nama_jabatan;
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
    
    
    function insert_tujuan() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $nama= $this->input->post('nama');
            $rek= $this->input->post('rek');
//            $id= $this->input->post('id');
            $data['nama'] = $nama;
            $data['id_ref_rekening'] = $rek;
            $query = $this->Data_aksi->insert('tbl_ref_tujuan', $data);

            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Refrensi Tujuan dengan nama : ' . $nama;
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
     function update_tujuan() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $rek= $this->input->post('rek');
            $data['nama'] = $nama;
            $data['id_ref_rekening'] = $rek;
            $query = $this->Data_aksi->update('id', $id, 'tbl_ref_tujuan', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil di Edit');
                $activity = 'Mengubah Refrensi Tujuan dengan id : ' . $id . ' Dengan Nama : ' . $nama_jabatan;
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
    
    function delete_tujuan() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $query = $this->Data_aksi->delete('id', $id, 'tbl_ref_tujuan');
            $this->Data_aksi->delete('id_ref_tujuan', $id, 'tbl_setting_uang_harian');
            
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil di Hapus');
                $activity = 'Mengubah Refrensi Tujuan dengan id : ' . $id . ' Dengan Nama : ' . $nama_jabatan;
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
    
     function cek_dataUangHarian($id) {
        $cek = $this->Data_setting->count_dataUangHarianWhereTujuan($id);
        echo json_encode($cek);
    }

}
