<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Surat_masuk
 *
 * @author zaky
 */
require_once APPPATH . '/libraries/vendor/autoload.php';
date_default_timezone_set("Asia/Jakarta");

class Surat_keluar extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Data_setting');
        $this->load->model('Data_pegawai');
        $this->load->model('Data_referensi');
        $this->load->model('Data_notadinas');
        $this->load->model('Data_administrator');
        $this->load->model('Data_aksi');
        $this->load->model('Tgl_indo');
        $this->load->model('Data_asisten');
//        $this->load->library('MyPHPMailer');
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
    }

    function index() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id['nama'] = $a['nama'];
            $id['foto'] = $a['foto'];
            $kode_as = $a['kode'];
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav', $id, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Surat Keluar (Persetujuan dan Disposisi)';
//            $record['kode_as'] = $kode_as;
            $record['get_suratKeluar'] = $this->Data_asisten->get_surat_keluar($kode_as);
            $record['get_refTujuan'] = $this->Data_referensi->get_refTujuan();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('asisten/data/surat_keluar', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function aksi() {
        $a = $this->session->userdata('is_login');
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $isi = $this->input->post('isi');
        $id_kewenangan_detail = $this->input->post('id_kewenangan_detail');
        $nip_nik = $this->input->post('nip_nik');
        $nama = $this->input->post('nama');
        $req = array(
            'isi' => $isi,
            'id_nota_dinas' => $id,
            'kode_user' => $a['kode'],
            'tgl_time_disposisi' => date("Y-m-d H:i:s"),
            'id_kewenangan_detail' => $id_kewenangan_detail,
            'nip_nik' => $nip_nik,
            'nama' => $nama
        );
        $query = $this->Data_aksi->insert('tbl_disposisi', $req);
        if ($query > 0) {
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Anda Berhasil Memberikan disposisi');
            $activity = 'Disposisi dengan : ' . $id . ' dan user ' . $a['kode'];
            $this->Data_aksi->aktivitas($activity);
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal Melakukan Posting');
            redirect($url);
        }
    }

    function posting() {
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $nip_nik = $this->input->post('nip_nik');
        $data = array(
            'id_nota_dinas' => $id,
            'nip_nik' => $nip_nik
        );
        $req['posting'] = 1;
        $query = $this->Data_aksi->update_multi('tbl_disposisi', $req, $data);
        if ($query > 0) {
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Anda Berhasil Memposting dan Mengirim Nota Dinas Ini');
            $activity = 'Memposting Disposisi  Dengan ID surat : ' . $id;
            $this->Data_aksi->aktivitas($activity);
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal Melakukan Posting');
            redirect($url);
        }
    }
}
