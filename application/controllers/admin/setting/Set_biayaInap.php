<?php

class Set_biayaInap extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Data_refJabatan');
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
            $record['page_name'] = 'Data Penginapan dan Biaya';
            $record['get_refJabatan'] = $this->Data_refJabatan->get_refJabatan();
            $record['get_refTujuan'] = $this->Data_referensi->get_refTujuan();
            $record['get_biayaInap'] = $this->Data_setting->get_biayaInap();
            $record['get_refProvinsi'] = $this->Data_setting->get_refProvinsi();
            $record['get_refProvinsiJoinPenginapan'] = $this->Data_setting->get_refProvinsiJoinPenginapan();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/setting/set_biaya_inap', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function modal_editBiayaInap($id) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['id_provinsi'] = $id;
            $record['get_refProvWhereId'] = $this->Data_referensi->get_refProvWhereId($id);
            $record['get_setbiayaInapWhereProv'] = $this->Data_setting->get_setbiayaInapWhereProv($id);
            $get_page = $this->load->view('admin/data/modal/modal_editBiayaInap', $record, true);
            echo $get_page;
        }
    }

    function insert_biayaInap() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id_jabatan = $this->input->post('id_jabatan');
            $id_provinsi = $this->input->post('id_provinsi');
            $biaya = $this->input->post('biaya');
            $count = count($biaya);
            for ($i = 0; $i < $count; $i++) {
                $data = array(
                    'biaya' => $biaya[$i],
                    'id_provinsi' => $id_provinsi[0],
                    'id_jabatan' => $id_jabatan[$i]
                );

                $query = $this->Data_aksi->insert('tbl_set_penginapan', $data);
            }

            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Biaya Inap dengan provinsi: ' . $id_provinsi;
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

    function update_biaya_inap() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $biaya = $this->input->post('biaya');
            $count = count($biaya);

            for ($i = 0; $i < $count; $i++) {
                $data = array(
                    'biaya' => $biaya[$i]
                );
                $id_colum = array(
                    'id' => $id[$i],
                );
                $this->Data_aksi->update_multi('tbl_set_penginapan', $data, $id_colum);
            }

            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Data berhasil Di Edit');
            $activity = 'Edit Biaya Inap dengan prov : ' . $id_provinsi;
            $this->Data_aksi->aktivitas($activity);
            redirect($url);
        } else {
            redirect('login');
        }
    }

    function delete_biaya_inap() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id_provinsi = $this->input->post('id_provinsi');
            $nama_provinsi = $this->input->post('nama_provinsi');
            $query = $this->Data_aksi->delete('id_provinsi', $id_provinsi, 'tbl_set_penginapan');

            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil Dihapus');
                $activity = 'Menghapus Biaya Inap ID Provinsi : ' . $id_provinsi . ' Dengan Nama : ' . $nama_provinsi;
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
