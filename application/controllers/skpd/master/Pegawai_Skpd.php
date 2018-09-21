<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Makassar");

Class Pegawai_Skpd extends CI_Controller {

    var $API = "";

    function __construct() {
        parent::__construct();
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
        $this->load->model('Data_pegawai');
        $this->load->model('Data_referensi');
        $this->load->model('Data_aksi');
        $this->load->model('Data_notadinas');
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
            $record['page_name'] = 'DATA SKPD';
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $data['content'] = $this->load->view('admin/data/master/data_skpd', $record, TRUE);

            $this->load->view('layout', $data);
        }
    }

    function master_pegawai() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
              $kode_skpd = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'DATA Master PEGAWAI :';
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
    //        $record['get_dataPegawai'] = $this->Data_pegawai->get_dataPegawai();
               $record['get_dataPegawai'] = $this->Data_pegawai->get_dataPegawaiWhereKd($kode_skpd);
               $record['get_pegawai'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
            $data['content'] = $this->load->view('admin/data/master/data_pegawai', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }
    function pegawaiPerSkpd() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $kunker = $a['kode'];
            $kun = substr($kunker, 0, 2);
            $kom = substr($kunker, 2, 2);
            $id['nama'] = $a['nama'];
            $id['foto'] = $a['foto'];
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'DATA PEGAWAI PADA SKPD :';
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $record['get_pegawai_skpd'] = $this->Data_pegawai->get_dataPegawaiWhereKd($kunker);
            $record['get_refbank'] = $this->Data_referensi->get_refBank();
            $record['get_refJabatan'] = $this->Data_referensi->get_refJabatan();
            $record['kunker'] = $kunker;
            $record['get_pegawaiSkpd'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai/pegawaiSkpd?kuntp=' . $kun . '&kunkom=' . $kom));
            $record['get_skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['get_pegawai'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
            $record['get_skpdWhereKun'] = json_decode($this->curl->simple_get($this->API . '/Api_skpd?kunker=' . $kunker));
            $data['content'] = $this->load->view('skpd/data/master/pegawaiperskpd', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function modal_editPgwSkpd($nip, $id_skpd) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $record['get_pgwSkpdWhereNip'] = $this->Data_pegawai->get_pgwSkpdWhereNip($nip, $id_skpd);
            $record['get_refJabatan'] = $this->Data_referensi->get_refJabatan();
            $record['get_refbank'] = $this->Data_referensi->get_refBank();
            $record['get_pegawaiNip'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai?nip='.$nip));
            $get_page = $this->load->view('admin/data/modal/modal_editPgwSkpd', $record, true);
            echo $get_page;
        }
    }

    function cek_dataPgw($nik) {
        $data = $this->Data_pegawai->searchPgw($nik);
        echo json_encode($data);
    }

    function add_pegawaiSkpd($kun, $kom) {
        $query = json_decode($this->curl->simple_get($this->API . '/Api_pegawai/pegawaiSkpd?kuntp=' . $kun . '&kunkom=' . $kom));
        $query1 = $this->Data_pegawai->get_dataPegawai();
        $data = "<option value=''>-- Pilih Pegawai--</option>";
        foreach ($query as $row) {
            foreach ($query1 as $que) {
                if ($que->nip_nik == $row->nip) {
                    $att = "disabled";
                    break;
                } else {
                    $att = "";
                }
            }
            if ($row->glblk != "") {
                $data .= "<option " . $att . " value='" . $row->nama . "' "
                        . "data-nama='" . $row->gldepan . " " . ucwords(strtolower($row->nama)) . ", " . $row->glblk . "'"
                        . "data-nip_nik='" . $row->nip . "'"
                        . "data-gol='" . $row->PANGKAT . " / " . $row->NGOLRU . "'"
                        . "data-jabatan='" . $row->NJAB . "'>" . $row->gldepan . " " . ucwords(strtolower($row->nama)) . ", " . $row->glblk . "</option>";
            } else {
                $data .= "<option " . $att . " value='" . $row->nama . "' "
                        . "data-nama='" . $row->gldepan . " " . ucwords(strtolower($row->nama)) . "'"
                        . "data-nip_nik='" . $row->nip . "'"
                        . "data-gol='" . $row->PANGKAT . " / " . $row->NGOLRU . "'"
                        . "data-jabatan='" . $row->NJAB . "'>" . $row->gldepan . " " . ucwords(strtolower($row->nama)) . "</option>";
            }
        }
        echo $data;
    }

    function insert_pegawai() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $no_rekening = $this->input->post('no_rekening');
            $jabatan = $this->input->post('jabatan');
            $id_jabatan = $this->input->post('id_jabatan');
            $status = $this->input->post('status');
            $kunker = $this->input->post('kunker');
            $nama = $this->input->post('nama');
            $bank = $this->input->post('bank');

            if ($status == 'pns') {
                $nip = $this->input->post('nip_nik');
                $data['status_pegawai'] = $status;
            } else {
                $nip = $this->input->post('nik');
                $data['status_pegawai'] = $status;
            }

            $data['nama'] = $nama;
            $data['jabatan'] = $jabatan;
            $data['id_jabatan'] = $id_jabatan;
            $data['no_rekening'] = $no_rekening;
            $data['nip_nik'] = $nip;
            $data['nunker'] = $kunker;
            $data['id_bank'] = $bank;

            $query = $this->Data_aksi->insert('tbl_pegawai', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Pegawai dengan nama : ' . $nama . 'NIP :' . $nip;
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

    function update_pegawai() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $nip_nik = $this->input->post('nip_nik');
            $jabatan = $this->input->post('jabatan');
            $id_jabatan = $this->input->post('id_jabatan');
            $no_rekening = $this->input->post('no_rekening');
            $bank = $this->input->post('bank');

            $data['jabatan'] = $jabatan;
            $data['id_jabatan'] = $id_jabatan;
            $data['no_rekening'] = $no_rekening;
            $data['id_bank'] = $bank;
            
            $query = $this->Data_aksi->update('id', $id, 'tbl_pegawai', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil di edit');
                $activity = 'Mengedit Data Pegawai NIP : ' . $nip_nik;
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

    function delete_pegawai() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $nip_nik = $this->input->post('nip_nik');

            $query = $this->Data_aksi->delete('nip_nik', $nip_nik, 'tbl_pegawai');
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil dihapus');
                $activity = 'Menghapus Data Pegawai NIP : ' . $nip_nik;
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
