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
date_default_timezone_set("Asia/Makassar");

class Surat_masuk_keluar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_notadinas');
        $this->load->model('Data_aksi');
        $this->load->model('Tgl_indo');
        $this->load->model('Data_asisten');
        $this->load->model('Data_setting');
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
    }

    function asisten() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 7) {
                $kode_as = $a['kode'];
                $data['head'] = $this->load->view('head', NULL, TRUE);
                $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
                $data['nav'] = $this->load->view('nav', NULL, TRUE);
                $data['foot'] = $this->load->view('foot', NULL, TRUE);
                $record['page_name'] = 'Surat Masuk (Persetujuan dan Disposisi)';
//            $record['kode_as'] = $kode_as;
                $record['get_notadinasAll'] = $this->Data_notadinas->get_notadinasAll();
                $record['get_suratMasuk'] = $this->Data_asisten->get_surat_masuk($kode_as);
                $record['get_suratMasukWhereAsisten'] = $this->Data_asisten->get_suratMasukWhereAsisten($kode_as);
                $record['get_skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
                $record['javasc'] = $this->load->view('js', NULL, TRUE);
                $data['content'] = $this->load->view('asisten/data/surat_masuk_keluar', $record, TRUE);
                $this->load->view('layout', $data);
            } else {
                redirect('login');
            }
        }
    }

    function sekda() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 6) {
                $surat = $this->input->get('surat');
                $data['head'] = $this->load->view('head', NULL, TRUE);
                $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
                $data['nav'] = $this->load->view('nav', NULL, TRUE);
                $data['foot'] = $this->load->view('foot', NULL, TRUE);
                if ($surat == 'masuk') {
                    $record['page_name'] = 'Surat Masuk';
                    $record['get_suratMasukDisposisiSekda'] = $this->Data_notadinas->get_suratMasukDisposisiSekda();
                    $record['get_suratMasukIdNd'] = $this->Data_notadinas->get_suratMasukIdNd();
                } else {
                    $record['page_name'] = 'Surat Keluar ';
                    $record['get_suratKeluarDisposisiSekda'] = $this->Data_notadinas->get_suratKeluarDisposisiSekda();
                    $record['get_suratMasukIdNd'] = $this->Data_notadinas->get_suratMasukIdNd();
                }
                $record['get_sekda'] = $this->Data_setting->get_sekda();
                $record['kode'] = $a['kode'];
                $record['get_skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
                $record['javasc'] = $this->load->view('js', NULL, TRUE);
                $data['content'] = $this->load->view('sekda/data/surat_masuk_keluar', $record, TRUE);
                $this->load->view('layout', $data);
            } else {
                redirect('login');
            }
        }
    }

    function staf_ahli() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 4) {
                $id = $a['kode'];
                $surat = $this->input->get('surat');
                $data['head'] = $this->load->view('head', NULL, TRUE);
                $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
                $data['nav'] = $this->load->view('nav', NULL, TRUE);
                $data['foot'] = $this->load->view('foot', NULL, TRUE);
                if ($surat == 'masuk') {
                    $record['page_name'] = 'Surat Masuk';
                } else {
                    $record['page_name'] = 'Surat Keluar ';
                }
                $record['get_stafAhlittd'] = $this->Data_notadinas->get_stafAhlittd();
                $record['get_suratMasukStafAhli'] = $this->Data_notadinas->get_suratMasukStafAhli();
                $record['get_setStafAhliWhereId'] = $this->Data_setting->get_setStafAhliWhereId($id);
                $record['kode'] = $a['kode'];
                $record['get_skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
                $record['javasc'] = $this->load->view('js', NULL, TRUE);
                $data['content'] = $this->load->view('stafahli/data/surat_masuk_keluar', $record, TRUE);
                $this->load->view('layout', $data);
            } else {
                redirect('login');
            }
        }
    }

    function modal_detailNotaDinas($id, $id_skpd, $id_kewenangan) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['catatan'] = $this->input->post('catatan');
            $record['get_notaDinasWhereId'] = $this->Data_notadinas->get_notaDinasWhereId($id);
            $record['get_notaDinasDetailWhereIdNd'] = $this->Data_notadinas->get_notaDinasDetailWhereIdNd($id);
            $record['get_disposisiWhereIdNd'] = $this->Data_notadinas->get_disposisiWhereIdNd($id);
            $record['get_skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['get_setAsistenWhereIdSkpdJoinAll'] = $this->Data_setting->get_setAsistenWhereIdSkpdJoinAll($id_skpd, $id_kewenangan);
            $record['get_SetKewenanganTtdWhereId'] = $this->Data_setting->get_SetKewenanganTtdWhereId($id_kewenangan, $id);
            $get_page = $this->load->view('admin/data/modal/modal_detailNotaDinas', $record, true);
            echo $get_page;
        }
    }

    function aksi() {
        $a = $this->session->userdata('is_login');
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $id_ttd = $this->input->post('id_ttd');
        $isi = addslashes($this->input->post('isi' . $id_ttd));
        $id_kewenangan_detail = $this->input->post('id_kew_det');
        $nip_nik = $this->input->post('nip_nik');
        $nama_pgw = $this->input->post('nm_pgw');
        $penerima = $this->input->post('penerima');
        $kembali = $this->input->post('hasil');
        $tgl = date('Y-m-d H:i:s');
        $req = array(
            'isi' => $isi,
            'id_nota_dinas' => $id,
            'kode_user' => $a['kode'],
            'tgl_time_disposisi' => date("Y-m-d H:i:s"),
            'id_kewenangan_detail' => $id_kewenangan_detail,
            'nip_nik' => $nip_nik,
            'nama' => $nama_pgw,
            'posting' => 1
        );
        $data = array(
            'id_nota_dinas' => $id,
            'nip_nik' => $nip_nik
        );
        if ($kembali != 'kembali') {
            $q = $this->Data_asisten->disposisi($id, $nip_nik);
            if ($q) {
                $query = $this->Data_aksi->update_multi('tbl_disposisi', $req, $data);
            } else {
                $query = $this->Data_aksi->insert('tbl_disposisi', $req);
            }

            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Berhasil Memberikan Disposisi');
                $activity = 'Disposisi dengan : ' . $id . ' dan user ' . $a['kode'];
                $this->Data_aksi->aktivitas($activity);
                $this->Data_aksi->sendEmail($penerima, $tgl);
                redirect($url);
            } else {
                $this->session->set_flashdata('tipe', 'alert-danger');
                $this->session->set_flashdata('msg', 'Gagal Melakukan disposisi');
                redirect($url);
            }
        }else{
            $req1 = array(
                'catatan_koreksi' => $isi,
                'posting' =>0,
                'ttd_kepala'=>0,
                'tgl_posting'=>'0000-00-00 00:00:00',
                'tgl_ttd_kepala'=>'0000-00-00 00:00:00'
            );
            $query = $this->Data_aksi->update('id',$id,'tbl_nota_dinas', $req1);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Berhasil Mengembalikan disposisi');
                $activity = 'Mengembalikan posisi ke admin nota dinas '.$id;
                $this->Data_aksi->aktivitas($activity);
                $this->Data_aksi->sendEmail($penerima, $tgl);
                redirect($url);
            } else {
                $this->session->set_flashdata('tipe', 'alert-danger');
                $this->session->set_flashdata('msg', 'Gagal Melakukan disposisi');
                redirect($url);
            }
        }
    }

    function setuju() {
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $setuju = $this->input->post('hasil');
        $penerima = $this->input->post('penerima');
        $id_detail_nd = $this->input->post('id_detail_nd');
        $status = $this->input->post('status_cek');
        $count_status = $this->input->post('cek');
        $tgl_berangkat = $this->input->post('tgl_berangkat');
        $tgl_kembali = $this->input->post('tgl_kembali');
        $lamanya = $this->input->post('lamanya');
        $ctt_koreksi = $this->input->post('ctt_koreksi');
        $count = count($id_detail_nd);

        if ($setuju == 'setuju') {
            for ($i = 0; $i < $count; $i++) {
                $data = array(
                    'status' => $status[$i]
                );
                $id_colum = array(
                    'id' => $id_detail_nd[$i]
                );
                $this->Data_aksi->update_multi('tbl_nota_dinas_detail', $data, $id_colum);
            }
            $req['status_persetujuan'] = 1;
            $req['tgl_berangkat'] = $tgl_berangkat;
            $req['tgl_kembali'] = $tgl_kembali;
            $req['lama'] = $lamanya;
            $req['catatan_persetujuan'] = 'Setuju ' . $count_status . ' Orang';
        } else if ($setuju == 'koreksi') {
            for ($i = 0; $i < $count; $i++) {
                $data = array(
                    'status' => $status[$i]
                );
//                var_dump($data);
//                return;
                $id_colum = array(
                    'id' => $id_detail_nd[$i]
                );
                $this->Data_aksi->update_multi('tbl_nota_dinas_detail', $data, $id_colum);
            }
            $req['status_persetujuan'] = 3;
            $req['tgl_berangkat'] = $tgl_berangkat;
            $req['tgl_kembali'] = $tgl_kembali;
            $req['lama'] = $lamanya;
        } else {
            $req['status_persetujuan'] = 2;
            $req['catatan_persetujuan'] = 'Dibatalkan (Tidak Setuju)';
        }
        $req['tgl_persetujuan'] = date("Y-m-d H:i:s");
        $req['catatan_koreksi'] = $ctt_koreksi;
        $tgl = date('Y-m-d H:i:s');
        $query = $this->Data_aksi->update('id', $id, 'tbl_nota_dinas', $req);
        if ($query > 0) {
            $this->session->set_flashdata('tipe', 'alert-success');
            if ($setuju == 'setuju') {
                $this->session->set_flashdata('msg', 'Anda Berhasil Menyetujui Nota Dinas');
                $activity = 'Menyetujui Nota Dinas Dengan ID surat : ' . $id;
                $this->Data_aksi->aktivitas($activity);
                $this->Data_aksi->sendEmail($penerima, $tgl);
                redirect($url);
            } else {
                $this->session->set_flashdata('msg', 'Berhasil Membatalkan Nota Dinas');
                $activity = 'Membatalkan Nota Dinas Dengan ID surat : ' . $id;
                $this->Data_aksi->aktivitas($activity);
                redirect($url);
            }
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal Melakukan Posting');
            redirect($url);
        }
    }

    function executive() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            if ($a['level_user'] == 3) {
                $id = $a['kode'];
                $surat = $this->input->get('surat');
                $data['head'] = $this->load->view('head', NULL, TRUE);
                $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
                $data['nav'] = $this->load->view('nav', NULL, TRUE);
                $data['foot'] = $this->load->view('foot', NULL, TRUE);
                if ($surat == 'masuk') {
                    $record['page_name'] = 'Surat Masuk';
                } else {
                    $record['page_name'] = 'Surat Keluar ';
                }
                $record['get_suratMasukExe'] = $this->Data_notadinas->get_suratMasukExe($id);
                $record['get_SetExecutiveWhereId_exe'] = $this->Data_setting->get_SetExecutiveWhereId_exe($id);
                $record['kode'] = $a['kode'];
                $record['get_skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
                $record['javasc'] = $this->load->view('js', NULL, TRUE);
                $data['content'] = $this->load->view('executive/data/surat_masuk_keluar', $record, TRUE);
                $this->load->view('layout', $data);
            } else {
                redirect('login');
            }
        }
    }

}
