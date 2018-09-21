<?php

class Set_uangHarian extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Data_referensi');
        $this->load->model('Data_setting');
        $this->load->model('Data_login');
        $this->load->model('Tgl_indo');
        $this->load->model('Data_aksi');
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
            $record['page_name'] = 'Data Uang Harian Jabatan dan Tujuan';
            $record['get_refTujuan'] = $this->Data_referensi->get_refTujuan();
            $record['get_refJabatan'] = $this->Data_referensi->get_refJabatan();
            $record['get_setUangHarian'] = $this->Data_setting->get_setUangHarian();
            $record['get_setUangHarianJoinJabatan'] = $this->Data_setting->get_setUangHarianJoinJabatan();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/setting/set_uang_harian', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function modal_editUangHarian($id) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['id_jabatan'] = $id;
            $record['get_refJabWhereId'] = $this->Data_referensi->get_refJabWhereId($id);
            $record['get_setUangHarianWhereJabatan'] = $this->Data_setting->get_setUangHarianWhereJabatan($id);
            $get_page = $this->load->view('admin/data/modal/modal_editUangHarian', $record, true);
            echo $get_page;
        }
    }

    function insert_uang_harian() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id_tujuan = $this->input->post('id_ref_tujuan');
            $id_jabatan = $this->input->post('id_ref_jabatan');
            $uangHarian = $this->input->post('uangharian');
            $count = count($uangHarian);
            for ($i = 0; $i < $count; $i++) {
                $data = array(
                    'uang_harian' => $uangHarian[$i],
                    'id_ref_jabatan' => $id_jabatan[$i],
                    'id_ref_tujuan' => $id_tujuan[$i]
                );

                $query = $this->Data_aksi->insert('tbl_setting_uang_harian', $data);
            }

            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Uang Harian dengan Jabatan: ' . $id_jabatan;
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

    function update_uang_harian() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id_tujuan = $this->input->post('id_ref_tujuan');
            $id = $this->input->post('id');
            $id_jabatan = $this->input->post('id_ref_jabatan');
            $uangHarian = $this->input->post('uangharian');
            $id_ii = $this->input->post('id_ii');
            $id_jabatan1 = $this->input->post('id_ref_jabatan1');
            $uangHarian1 = $this->input->post('uangharian1');
            $id_tujuan1 = $this->input->post('id_ref_tujuan1');
            $count = count($uangHarian);

            for ($i = 0; $i < $count; $i++) {
                $data = array(
                    'uang_harian' => $uangHarian[$i],
                    'id_ref_jabatan' => $id_jabatan[$i],
                    'id_ref_tujuan' => $id_tujuan[$i]
                );
                $id_colum = array(
                    'id' => $id[$i],
                );
                $this->Data_aksi->update_multi('tbl_setting_uang_harian', $data, $id_colum);
            }
            if ($id_ii == 0) {
                $data1 = array(
                    'uang_harian' => $uangHarian1,
                    'id_ref_jabatan' => $id_jabatan1,
                    'id_ref_tujuan' => $id_tujuan1
                );
//                var_dump($data1);
//                return;
                $this->Data_aksi->insert('tbl_setting_uang_harian', $data1);
            }

            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Data berhasil Di Edit');
            $activity = 'Edit Uang Harian dengan ID Jabatan : ' . $id_jabatan;
            $this->Data_aksi->aktivitas($activity);
            redirect($url);
        } else {
            redirect('login');
        }
    }

    function delete_uang_harian() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id_jabatan = $this->input->post('id_jabatan');
            $nama_jabatan = $this->input->post('nama_jabatan');
            $query = $this->Data_aksi->delete('id_ref_jabatan', $id_jabatan, 'tbl_setting_uang_harian');

            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil Dihapus');
                $activity = 'Menghapus Uang Harian ID Jabatan : ' . $id_jabatan . ' Dengan Nama : ' . $nama_jabatan;
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
