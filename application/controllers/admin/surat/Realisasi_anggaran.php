<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Realisasi_anggaran extends CI_Controller {

    var $API = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_setting');
        $this->load->model('Data_pegawai');
        $this->load->model('Data_aksi');
        $this->load->model('Tgl_indo');
        $this->load->model('Data_surat_tugas');
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
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
            $record['page_name'] = 'Data Realisasi Anggaran SKPD';
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['get_realisasiAnggaran'] = $this->Data_setting->get_realisasiAnggaran();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/realisasi/list_skpd', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function inputRealisasiAnggaran($id_skpd) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id['nama'] = $a['nama'];
            $id['foto'] = $a['foto'];
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav', $id, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Data Input Realisasi Anggaran';
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['id_skpd'] = $id_skpd;
            $record['get_realisasiAnggaranLuarWhereSkpd'] = $this->Data_surat_tugas->get_realisasiAnggaranLuarWhereSkpd($id_skpd);
            $record['get_realisasiAnggaranDalamWhereSkpd'] = $this->Data_surat_tugas->get_realisasiAnggaranDalamWhereSkpd($id_skpd);
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/realisasi/input_realisasi', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function cek_sisaPagu($id_skpd, $info) {
        $cek_realisasi = $this->Data_setting->get_realisasiAnggaran();
        foreach ($cek_realisasi as $row) {
            if ($id_skpd == $row->kode_skpd) {
                $jml_dalam = ceil($row->kouta_anggaran_dalam - $row->jml_realisasi_dalam);
                $jml_luar = ceil($row->kouta_anggaran_luar - $row->jml_realisasi_luar);
            }
        }
        if ($info == 'dalam') {
            $cek = array(
                'cek' => $jml_dalam
            );
        } else {
            $cek = array(
                'cek' => $jml_luar
            );
        }
        echo json_encode($cek);
    }

    function insertRealisasiAnggaran() {
        $id_skpd = $this->input->post('id_skpd');
        $id = $this->input->post('id');
        $realisasi = $this->input->post('realisasi');
        $no_spt = $this->input->post('no_spt');
        $no_nd = $this->input->post('no_nd');
        $info = $this->input->post('info');
        $data['kode_skpd'] = $id_skpd;
        $data['no_spt'] = $no_spt;
        $data['no_nota_dinas'] = $no_nd;
        $query = '';
        if ($info == 'dalam') {
            $data['realisasi_dalam'] = $realisasi;
            $query = $this->Data_aksi->insert('tbl_realisasi_dalam', $data);
        } elseif ($info == 'luar') {
            $data['realisasi_luar'] = $realisasi;
            $query = $this->Data_aksi->insert('tbl_realisasi_luar', $data);
        }
        if ($query) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function updateRealisasiAnggaran() {
        $id = $this->input->post('id');
        $realisasi = $this->input->post('realisasi');
        $no_spt = $this->input->post('no_spt');
        $info = $this->input->post('info');
        $data['no_spt'] = $no_spt;
        $query = '';
        if ($info == 'dalam') {
            $data['realisasi_dalam'] = $realisasi;
            $query = $this->Data_aksi->update('id', $id, 'tbl_realisasi_dalam', $data);
        } elseif ($info == 'luar') {
            $data['realisasi_luar'] = $realisasi;
            $query = $this->Data_aksi->update('id', $id, 'tbl_realisasi_luar', $data);
        }
        if ($query) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    function deleteRealisasiAnggaran() {
        $id = $this->input->post('id');
        $info = $this->input->post('info');
        $query = '';
        if ($info == 'dalam') {
            $query = $this->Data_aksi->delete('id', $id, 'tbl_realisasi_dalam');
        } elseif ($info == 'luar') {
            $query = $this->Data_aksi->delete('id', $id, 'tbl_realisasi_luar');
        }
        if ($query) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

}
