<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Surat_tugas extends CI_Controller {

    var $API = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_notadinas');
        $this->load->model('Data_surat_tugas');
        $this->load->model('Data_referensi');
        $this->load->model('Data_aksi');
        $this->load->model('Tgl_indo');
//        $this->API = base_url() . "reset_api/index.php";

        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
    }

    function index() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Surat Tugas';
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $data['content'] = $this->load->view('skpd/data/surat/surat_tugas_skpd', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function surat_tugas($id_skpd) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Nota Dinas';
            $record['id_skpd'] = $id_skpd;
            $record['get_suratTugasSkpdWhereStatus'] = $this->Data_surat_tugas->get_suratTugasSkpdWhereStatus('1', $id_skpd);
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/surat_tugas', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function tambah_surat_tugas($id_skpd, $id_nd) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Form Buat Surat Tugas';
            $record['id_skpd'] = $id_skpd;
            $record['id_nd'] = $id_nd;
            $record['get_refTtdNotStafAhli'] = $this->Data_referensi->get_refTtdNotStafAhli();
            $record['get_notaDinasWhereId'] = $this->Data_notadinas->get_notaDinasWhereId($id_nd);
            $record['get_notaDinasDetailWhereIdNd'] = $this->Data_notadinas->get_notaDinasDetailWhereIdNd($id_nd);
            $record['get_skpdWhereKun'] = json_decode($this->curl->simple_get($this->API . '/Api_skpd?kunker=' . $id_skpd));
            $record['get_alat_angkut'] = $this->Data_referensi->get_alat_angkut();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/surat/aksi/tambah_surat_tugas', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }
    function edit_surat_tugas($id_skpd, $id_nd) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Form Edit Surat Tugas';
            $record['id_skpd'] = $id_skpd;
            $record['id_nd'] = $id_nd;
            $record['get_refTtdNotStafAhli'] = $this->Data_referensi->get_refTtdNotStafAhli();
            $record['get_suratTugasSkpdWhereId'] = $this->Data_surat_tugas->get_suratTugasSkpdWhereId($id_nd);
            $record['get_notaDinasDetailWhereIdNd'] = $this->Data_notadinas->get_notaDinasDetailWhereIdNd($id_nd);
            $record['get_skpdWhereKun'] = json_decode($this->curl->simple_get($this->API . '/Api_skpd?kunker=' . $id_skpd));
            $record['get_alat_angkut'] = $this->Data_referensi->get_alat_angkut();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/surat/aksi/edit_surat_tugas', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function get_ttdSpt($id, $id_skpd) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['get_ttdSuratTugas'] = $this->Data_surat_tugas->get_ttdSuratTugas($id, $id_skpd);
            $record['get_pegawai'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
            $get_page = $this->load->view('skpd/data/surat/aksi/get_ttdSpt', $record, true);
            echo $get_page;
        }
    }

    function insertSuratTugas(){
        $a = $this->session->userdata('is_login');
        $id_kewenangan = $this->input->post('id_kewenangan');
        $url = $this->input->post('url');
        $no_spt = $this->input->post('no_spt');
        $id_nd = $this->input->post('id_nd');
        $tgl_spt = $this->input->post('tgl_spt');
        $id_ttd_spt = $this->input->post('id_ttd');
        $req =array(
            'id_nota_dinas' => $id_nd,
            'no_spt' => $no_spt,
            'tgl_spt' => $tgl_spt,
            'id_ttd_spt' => $id_ttd_spt            
        );

        $query = $this->Data_aksi->insert('tbl_surat_tugas', $req);
        if ($query > 0) {
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
            $activity = 'Menambah Data Surat Tugas Nota Dinas dengan ID : ' . $id_nd;
            $this->Data_aksi->aktivitas($activity);
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal menambahkan data');
            redirect($url);
        }
    }
    function updateSuratTugas(){
        $a = $this->session->userdata('is_login');
        $id_kewenangan = $this->input->post('id_kewenangan');
        $url = $this->input->post('url');
        $no_spt = $this->input->post('no_spt');
        $id_spt = $this->input->post('id_spt');
        $id_ttd = $this->input->post('id_ttd');
        $req =array(
            'id_ttd_spt' => $id_ttd
        );
        $query = $this->Data_aksi->update('id', $id_spt, 'tbl_surat_tugas', $req);
        if ($query > 0) {
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Data berhasil dirubah');
            $activity = 'Merubah Data Surat Tugas dengan Nomor SPT : ' . $no_spt;
            $this->Data_aksi->aktivitas($activity);
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal merrubah data');
            redirect($url);
        }
    }

}
