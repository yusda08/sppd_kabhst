<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once APPPATH . '/libraries/vendor/autoload.php';
date_default_timezone_set("Asia/Makassar");

class Nota_dinas extends CI_Controller {

    var $API = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_setting');
        $this->load->model('Data_pegawai');
        $this->load->model('Data_referensi');
        $this->load->model('Data_notadinas');
        $this->load->model('Data_administrator');
        $this->load->model('Data_aksi');
        $this->load->model('Tgl_indo');
//        $this->load->library('MyPHPMailer');
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
    }

    function index() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $level = $a['level_user'];
            if ($level == 2) {
                $kode_skpd = $a['kode'];
            } elseif ($level == 5) {
                $kode_skpd = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
            }
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['getnotadinas'] = $this->Data_notadinas->get_notadinasJoinAll($kode_skpd);
            $record['page_name'] = 'Data Surat Nota Dinas';
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/nota_dinas_skpd', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function nota_dinas($id_skpd) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Nota Dinas';
            $record['id_skpd'] = $id_skpd;
            $record['get_refTujuan'] = $this->Data_referensi->get_refTujuan();
            $record['get_notadinasJoinAll'] = $this->Data_notadinas->get_notadinasJoinAll($id_skpd);
            $record['get_kepalaSkdpWhereSkpd'] = $this->Data_setting->get_kepalaSkdpWhereSkpd($id_skpd);
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/nota_dinas', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function tambah_nota_dinas($id_skpd, $id_tujuan) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id['nama'] = $a['nama'];
            $id['foto'] = $a['foto'];
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', $id, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Form Tambah Nota Dinas';
            $record['id_skpd'] = $id_skpd;
            $record['id_tujuan'] = $id_tujuan;
            $record['get_SetKewenanganJoinTtd'] = $this->Data_setting->get_SetKewenanganJoinTtd();
            $record['get_pegawai'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
            $record['get_dataPegawaiWhereKd'] = $this->Data_pegawai->get_dataPegawaiWhereKd($id_skpd);
            $record['get_dataPegawai'] = $this->Data_pegawai->get_dataPegawai();
            $record['get_alat_angkut'] = $this->Data_referensi->get_alat_angkut();
            $record['get_skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['get_skpdWhereKun'] = json_decode($this->curl->simple_get($this->API . '/Api_skpd?kunker=' . $id_skpd));
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/aksi/tambah_nota_dinas', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function edit_nota_dinas($id_skpd, $id_tujuan) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id_nt_dinas = $this->input->get('id');
            $id['nama'] = $a['nama'];
            $id['foto'] = $a['foto'];
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', $id, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Form Edit Nota Dinas';
            $record['id_nt_dinas'] = $id_nt_dinas;
            $record['id_skpd'] = $id_skpd;
            $record['id_tujuan'] = $id_tujuan;
            $record['get_notaDinasWhereId'] = $this->Data_notadinas->get_notaDinasWhereId($id_nt_dinas);
            $record['get_editNotaDinas'] = $this->Data_notadinas->get_notaDinasDetailWhereIdNd($id_nt_dinas);
            $record['perkiraanBiaya'] = $this->Data_notadinas->get_biayaPerkiraan($id_nt_dinas);
            $record['get_SetKewenanganJoinTtd'] = $this->Data_setting->get_SetKewenanganJoinTtd();
            $record['get_pegawai'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
            $record['get_dataPegawaiWhereKd'] = $this->Data_pegawai->get_dataPegawaiWhereKd($id_skpd);
            $record['get_alat_angkut'] = $this->Data_referensi->get_alat_angkut();
            $record['get_dataPegawai'] = $this->Data_pegawai->get_dataPegawai();
            $record['get_skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['get_skpdWhereKun'] = json_decode($this->curl->simple_get($this->API . '/Api_skpd?kunker=' . $id_skpd));
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/aksi/edit_nota_dinas', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function tabel_editNotaDinas($id_nt_dinas) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $record['get_editNotaDinas'] = $this->Data_notadinas->get_notaDinasDetailWhereIdNd($id_nt_dinas);
            $get_page = $this->load->view('skpd/data/surat/tabel/tabel_edit_nota_dinas', $record, true);
            echo $get_page;
        }
    }

    function modal_traikingSurat() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id = $this->input->post('id');
            $id_kewenangan = $this->input->post('id_kewenangan');
            $id_ttd = $this->input->post('id_ttd');
            $id_skpd = $this->input->post('id_skpd');
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $record['id'] = $id;
            $record['id_skpd'] = $id_skpd;
            $record['id_ttd'] = $id_ttd;
            $record['id_kewenangan'] = $id_kewenangan;
            $record['get_setAsistenWhereIdSkpdJoinAll'] = $this->Data_setting->get_setAsistenWhereIdSkpdJoinAll($id_kewenangan, $id);
            $record['get_disposisiWhereIdNd'] = $this->Data_notadinas->get_disposisiWhereIdNd($id);
            $record['get_notaDinasWhereId'] = $this->Data_notadinas->get_notaDinasWhereId($id);
            $record['get_SetKewenanganTtdWhereId'] = $this->Data_setting->get_SetKewenanganTtdWhereId($id_kewenangan, $id);
            $get_page = $this->load->view('skpd/data/modal/modal_traikingSurat', $record, true);
            echo $get_page;
        }
    }

    function add_pegawaiSkpd($kunker) {
        $query = $this->Data_pegawai->get_dataPegawaiWhereKd($kunker);
        $get_pegawai = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
        $data = "<option value=''>-- Pilih Pegawai--</option>";
        foreach ($query as $row) {
            foreach ($get_pegawai as $que) {
                if ($row->nip_nik == $que->nip) {
//                    foreach ($get_editNotaDinas as $gend) {
//                        if ($gend->nip_nik == $row->nip_nik) {
//                            $att = 'disabled';
//                            break;
//                        } else {
//                            $att = '';
//                        }
//                    }
                    $data .= "<option value='$row->nip_nik' 
                                         data-nama='$row->nama' 
                                         data-nip='$row->nip_nik' 
                                         data-status='$row->status_pegawai' 
                                         data-pangkat='$que->PANGKAT' 
                                         data-gol='$que->NGOLRU' 
                                         data-jabatan='$row->jabatan' 
                                         > $row->nama</option>";
                }
            }
        }
        echo $data;
    }

    function add_editNdPegawaiSkpd($kunker, $id_nt_dinas) {
        $query = $this->Data_pegawai->get_dataPegawaiWhereKd($kunker);
        $get_pegawai = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
        $get_editNotaDinas = $this->Data_notadinas->get_notaDinasDetailWhereIdNd($id_nt_dinas);
        $data = "<option value=''>-- Pilih Pegawai--</option>";
        foreach ($query as $row) {
            foreach ($get_pegawai as $que) {
                if ($row->nip_nik == $que->nip) {
                    foreach ($get_editNotaDinas as $gend) {
                        if ($gend->nip_nik == $row->nip_nik) {
                            $att = 'disabled';
                            break;
                        } else {
                            $att = '';
                        }
                    }
                    $data .= "<option $att value='$row->nip_nik' 
                                         data-nama='$row->nama' 
                                         data-nip='$row->nip_nik' 
                                         data-status='$row->status_pegawai' 
                                         data-pangkat='$que->PANGKAT' 
                                         data-gol='$que->NGOLRU' 
                                         data-jabatan='$row->jabatan' 
                                         > $row->nama</option>";
                }
            }
        }
        echo $data;
    }

    function insertFile() {
        $a = $this->session->userdata('is_login');
        $nip = $this->input->post('nip');
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $pangak_gol = $this->input->post('pangkat_gol');
        $jabatan = $this->input->post('jabatan');
        $kode = $this->input->post('kode');
        $status = $this->input->post('status');
        if ($status == 'pns') {
            $req = array(
                'nip_nik' => $nip,
                'pangkat_gol' => $pangak_gol,
                'kode' => $kode,
            );
        } else {
            $req = array(
                'nip_nik' => $nik,
                'kode' => $kode
            );
        }
        $this->Data_aksi->insert('temporary_detail', $req);
        $record['get_temporaryDetailWhereKd'] = $this->Data_aksi->get_temporaryDetailWhereKd($kode);
        $this->load->view('skpd/data/surat/tabel/tabel_nota_dinas_detail', $record);
    }

    function insertPegawai() {
        $a = $this->session->userdata('is_login');
        $nip = $this->input->post('nip');
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $pangak_gol = $this->input->post('pangkat_gol');
        $jabatan = $this->input->post('jabatan');
        $kode = $this->input->post('kode');
        $id_skpd = $this->input->post('id_skpd');
        $status = $this->input->post('status');
        if ($status != 'pns') {
            $nip = $this->input->post('nik');
        }
        $get_temporaryDetail = $this->Data_aksi->get_temporaryDetail($kode);
        $bisa = true;
        foreach ($get_temporaryDetail as $row) {
            $nip_nik = $row->nip_nik;
            $kode_t = $row->kode;
            if ($kode_t == $kode and $nip_nik == $nip) {
                $bisa = false;
            }
        }
        if ($bisa == false) {
            echo '<script>alert("Sudah ada bro")</script>';
            $record['get_temporaryDetailWhereKd'] = $this->Data_aksi->get_temporaryDetailWhereKd($kode);
            $this->load->view('skpd/data/surat/tabel/tabel_nota_dinas_detail', $record);
        } else {
            if ($status == 'pns') {
                $req = array(
                    'nip_nik' => $nip,
                    'pangkat_gol' => $pangak_gol,
                    'kode' => $kode,
                    'id_skpd' => $id_skpd
                );
            } else {
                $req = array(
                    'nip_nik' => $nik,
                    'kode' => $kode,
                    'id_skpd' => $id_skpd
                );
            }
            $this->Data_aksi->insert('temporary_detail', $req);
            $record['get_temporaryDetailWhereKd'] = $this->Data_aksi->get_temporaryDetailWhereKd($kode);
            $this->load->view('skpd/data/surat/tabel/tabel_nota_dinas_detail', $record);
        }
    }

    function insertPegawaiEditNd() {
        $a = $this->session->userdata('is_login');
        $url = $this->input->post('url');
        $id_nd = $this->input->post('id_nd');
        $nip_nik = $this->input->post('nip_nik');
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $pangak_gol = $this->input->post('pangkat_gol');
        $jabatan = $this->input->post('jabatan');
        $status = $this->input->post('status');
        if ($status == 'pns') {
            $req = array(
                'id_nota_dinas' => $id_nd,
                'nip_nik' => $nip_nik,
                'jabatan' => $jabatan,
                'nama' => $nama,
                'pangkat_gol' => $pangak_gol
            );
        } else {
            $req = array(
                'id_nota_dinas' => $id_nd,
                'nip_nik' => $nik,
                'jabatan' => $jabatan,
                'nama' => $nama,
            );
        }
        $query = $this->Data_aksi->insert('tbl_nota_dinas_detail', $req);
        if ($query > 0) {
            $activity = 'Menambah Pegawai Nota Dinas ID : ' . $id_nd . ' dengan nama : ' . $nama . 'NIP :' . $nip_nik;
            $this->Data_aksi->aktivitas($activity);
            echo 'success';
        }
    }

    function hapusPegawai() {
        $id = $this->input->post('id');
        $kode = $this->input->post('kode');
        $id_skpd = $this->input->post('id_skpd');
        $this->Data_aksi->delete('id', $id, 'temporary_detail');
        $record['get_temporaryDetailWhereKd'] = $this->Data_aksi->get_temporaryDetailWhereKd($kode, $id_skpd);
        $this->load->view('skpd/data/surat/tabel/tabel_nota_dinas_detail', $record);
    }

    function hapusPegawaiEditNd() {
        $id = $this->input->post('id');
        $this->Data_aksi->delete('id', $id, 'tbl_nota_dinas_detail');
    }

    function insertNotaDinas() {
        $a = $this->session->userdata('is_login');
        $id_kewenangan = $this->input->post('id_kewenangan');
        $url = $this->input->post('url');
        $dari = $this->input->post('dari');
        $id_skpd = $this->input->post('id_skpd');
        $tgl_nota_dinas = $this->input->post('tgl_nota_dinas');
        $perihal = $this->input->post('perihal');
        $no_nota_dinas = $this->input->post('no_nota_dinas');
        $lampiran = $this->input->post('lampiran');
        $dasar = $this->input->post('dasar');
        $tujuan = $this->input->post('tujuan');
        $tgl_berangkat = $this->input->post('tgl_berangkat');
        $tgl_kembali = $this->input->post('tgl_kembali');
        $lamanya = $this->input->post('lamanya');
        $kode = $this->input->post('kode');
        $id_ref_tujuan = $this->input->post('id_ref_tujuan');
        $maksud = $this->input->post('maksud');
        $alat_angkut = $this->input->post('alat_angkut');
        $beban_biaya = $this->input->post('beban_biaya');
        $alat = implode(";", $alat_angkut);
        $nm_file = date('YmdHis') . str_replace(" ", "_", $_FILES['file']['name']);
        $filesize = $_FILES['file']['size'];
        $filetype = $_FILES['file']['type'];

        $req = array('no' => $no_nota_dinas,
            'tgl_nota_dinas' => $tgl_nota_dinas,
            'perihal' => $perihal,
            'lampiran' => $lampiran,
            'tujuan' => $tujuan,
            'id_ref_tujuan' => $id_ref_tujuan,
            'id_ref_kewenangan' => $id_kewenangan,
            'dasar' => $dasar,
            'tgl_berangkat' => $tgl_berangkat,
            'tgl_kembali' => $tgl_kembali,
            'maksud' => $maksud,
            'ttd_kepala' => 0,
            'lama' => $lamanya,
            'nama_file' => $nm_file,
            'size_file' => $filesize,
            'format_file' => $filetype,
            'dari' => $dari,
            'id_skpd' => $id_skpd,
            'alat_angkut' => $alat,
            'beban_biaya' => $beban_biaya,
            'kode' => $kode);
        $config = array(
            'upload_path' => '././assets/file/',
            'allowed_types' => 'gif|jpg|png|jpeg|bmp|pdf',
            'file_name' => $nm_file
        );
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('file')) {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Upload Data Gagal, file yang di upload harus memenuhi syarat!');
            redirect($url);
        } else {
            $perkiraan_biaya = $this->input->post('perkiraan_biaya');
            $req_biaya['kode_skpd'] = $id_skpd;
            $req_biaya['no_nota_dinas'] = $no_nota_dinas;
            if ($id_ref_tujuan == 1 or $id_ref_tujuan == 2 or $id_ref_tujuan == 3) { // jika luar provinsi
                $req_biaya['realisasi_luar'] = $perkiraan_biaya;
                $query_biaya = $this->Data_aksi->insert('tbl_realisasi_luar', $req_biaya);
            } else {
                $req_biaya['realisasi_dalam'] = $perkiraan_biaya;
                $query_biaya = $this->Data_aksi->insert('tbl_realisasi_dalam', $req_biaya);
            }
            $query = $this->Data_aksi->insert('tbl_nota_dinas', $req);
            if ($query > 0) {
                $id_nota_dinas = $this->Data_notadinas->get_notaDinasId($kode);
                $get_temporaryDetailWhereKd = $this->Data_aksi->get_temporaryDetailWhereKd($kode, $id_skpd);

                foreach ($get_temporaryDetailWhereKd as $row) {
                    $req = array(
                        'nama' => $row->nama,
                        'nip_nik' => $row->nip_nik,
                        'pangkat_gol' => $row->pangkat_gol,
                        'id_nota_dinas' => $id_nota_dinas,
                        'jabatan' => $row->jabatan
                    );
                    $this->Data_aksi->insert('tbl_nota_dinas_detail', $req);
                }
                $this->Data_aksi->delete('kode', $kode, 'temporary_detail');
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah Nota Dinas dengan ID : ' . $id_nota_dinas;
                $this->Data_aksi->aktivitas($activity);
                redirect($url);
            } else {
                $this->session->set_flashdata('tipe', 'alert-danger');
                $this->session->set_flashdata('msg', 'Gagal menambahkan data');
                redirect($url);
            }
        }
    }

    function editNotaDinas() {
        $a = $this->session->userdata('is_login');
        $id_kewenangan = $this->input->post('id_kewenangan');
        $url = $this->input->post('url');
        $url_back = $this->input->post('url_back');
        $id = $this->input->post('id');
        $id_skpd = $this->input->post('id_skpd');
        $dari = $this->input->post('dari');
        $tgl_nota_dinas = $this->input->post('tgl_nota_dinas');
        $perihal = $this->input->post('perihal');
        $no_nota_dinas = $this->input->post('no_nota_dinas');
        $lampiran = $this->input->post('lampiran');
        $dasar = $this->input->post('dasar');
        $tujuan = $this->input->post('tujuan');
        $tgl_berangkat = $this->input->post('tgl_berangkat');
        $tgl_kembali = $this->input->post('tgl_kembali');
        $lamanya = $this->input->post('lamanya');
        $id_ref_tujuan = $this->input->post('id_ref_tujuan');
        $maksud = $this->input->post('maksud');
        $alat_angkut = $this->input->post('alat_angkut');
        $alat = implode(";", $alat_angkut);
        $beban_biaya = $this->input->post('beban_biaya');
        $file_lama = $this->input->post('file_lama');
        $nm_file = $_FILES['file']['name'];
        $filesize = $_FILES['file']['size'];
        $filetype = $_FILES['file']['type'];
        if ($nm_file != '') {
            $path = '././assets/file/';
            $nm_file = date('YmdHis') . str_replace(" ", "_", $_FILES['file']['name']);
            $config = array(
                'upload_path' => $path,
                'allowed_types' => 'gif|jpg|png|jpeg|bmp|pdf',
                'file_name' => $nm_file
            );
            $req['nama_file'] = $nm_file;
            $req['size_file'] = $filesize;
            $req['format_file'] = $filetype;
            @unlink($path . $file_lama);
            $this->load->library('upload', $config);
            $this->upload->do_upload('file');
        }
        $req['no'] = $no_nota_dinas;
        $req['perihal'] = $perihal;
        $req['lampiran'] = $lampiran;
        $req['tujuan'] = $tujuan;
        $req['dari'] = $dari;
        $req['id_ref_tujuan'] = $id_ref_tujuan;
        $req['id_ref_kewenangan'] = $id_kewenangan;
        $req['dasar'] = $dasar;
        $req['tgl_berangkat'] = $tgl_berangkat;
        $req['tgl_kembali'] = $tgl_kembali;
        $req['maksud'] = $maksud;
        $req['maksud'] = $maksud;
        $req['lama'] = $lamanya;
        $req['alat_angkut'] = $alat;
        $req['beban_biaya'] = $beban_biaya;
        $query = $this->Data_aksi->update('id', $id, 'tbl_nota_dinas', $req);

        $perkiraan_biaya = $this->input->post('perkiraan_biaya');
        if ($id_ref_tujuan == 1 or $id_ref_tujuan == 2 or $id_ref_tujuan == 3) { // jika luar provinsi
            $req_biaya['realisasi_luar'] = $perkiraan_biaya;
            $query_biaya = $this->Data_aksi->update('no_nota_dinas', $no_nota_dinas,'tbl_realisasi_luar', $req_biaya);
        } else {
            $req_biaya['realisasi_dalam'] = $perkiraan_biaya;
            $query_biaya = $this->Data_aksi->update('no_nota_dinas', $no_nota_dinas,'tbl_realisasi_dalam', $req_biaya);
        }
        if ($query > 0) {
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Data berhasil Di Edit');
            $activity = 'Merobah Data Nota Dinas dengan ID : ' . $id;
            $this->Data_aksi->aktivitas($activity);
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal Edit Data data');
            redirect($url_back);
        }
    }

    function editFileNotaDinas() {
        $a = $this->session->userdata('is_login');
        $id_kewenangan = $this->input->post('id_kewenangan');
        $url = $this->input->post('url');
        $url_back = $this->input->post('url_back');
        $id = $this->input->post('id');
        $id_skpd = $this->input->post('id_skpd');
        $tgl_nota_dinas = $this->input->post('tgl_nota_dinas');
        $perihal = $this->input->post('perihal');
        $no_nota_dinas = $this->input->post('no_nota_dinas');
        $lampiran = $this->input->post('lampiran');
        $dasar = $this->input->post('dasar');
        $tujuan = $this->input->post('tujuan');
        $tgl_berangkat = $this->input->post('tgl_berangkat');
        $tgl_kembali = $this->input->post('tgl_kembali');
        $lamanya = $this->input->post('lamanya');
        $id_ref_tujuan = $this->input->post('id_ref_tujuan');
        $maksud = $this->input->post('maksud');
        $req = array(
            'no' => $no_nota_dinas,
            'perihal' => $perihal,
            'lampiran' => $lampiran,
            'tujuan' => $tujuan,
            'id_ref_tujuan' => $id_ref_tujuan,
            'id_ref_kewenangan' => $id_kewenangan,
            'dasar' => $dasar,
            'tgl_berangkat' => $tgl_berangkat,
            'tgl_kembali' => $tgl_kembali,
            'maksud' => $maksud,
            'lama' => $lamanya
        );
        $query = $this->Data_aksi->update('id', $id, 'tbl_nota_dinas', $req);
        if ($query > 0) {
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Data berhasil Di Edit');
            $activity = 'Merobah Data Nota Dinas dengan ID : ' . $id_nota_dinas;
            $this->Data_aksi->aktivitas($activity);
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal Edit Data data');
            redirect($url_back);
        }
    }

    function posting() {
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $penerima = $this->input->post('penerima');
        $tgl_posting = date('Y-m-d H:i:s');
        $no = $this->input->post('no');
        $req['posting'] = 1;
        $req['tgl_posting'] = $tgl_posting;
        $query = $this->Data_aksi->update('id', $id, 'tbl_nota_dinas', $req);
        if ($query > 0) {
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Anda Berhasil Memposting dan Mengirim Nota Dinas Ini Ke Kepala SKPD Anda');
            $activity = 'Memposting Nota Dinas  Dengan Nomor : ' . $no;
            $this->Data_aksi->aktivitas($activity);
            $this->Data_aksi->sendEmail($penerima, $tgl_posting);
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal Melakukan Posting');
            redirect($url);
        }
    }

    function delete_notaDinas() {
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $no = $this->input->post('no');
        $perihal = $this->input->post('perihal');
        $query = $this->Data_aksi->delete('id', $id, 'tbl_nota_dinas');
        $query = $this->Data_aksi->delete('id_nota_dinas', $id, 'tbl_nota_dinas_detail');
        if ($query > 0) {
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Anda Berhasil Menghapus Nota Dinas Dengan Nomor : ' . $no);
            $activity = 'Menghapus Nota Dinas  Dengan Nomor : ' . $no . ' Perihal : ' . $perihal;
            $this->Data_aksi->aktivitas($activity);
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal Melakukan Posting');
            redirect($url);
        }
    }

    function lap_spt($id_skpd) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Nota Dinas';
            $record['id_skpd'] = $id_skpd;
            $record['get_refTujuan'] = $this->Data_referensi->get_refTujuan();
            $record['get_notadinasJoinAll'] = $this->Data_notadinas->get_notadinasJoinAll($id_skpd);
            $record['get_kepalaSkdpWhereSkpd'] = $this->Data_setting->get_kepalaSkdpWhereSkpd($id_skpd);
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/lap_spt', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function lap_sppd($id_skpd) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Nota Dinas';
            //  $record['id_skpd'] = $id_skpd;
            $record['get_refTujuan'] = $this->Data_referensi->get_refTujuan();
            $record['get_notadinasJoinAll'] = $this->Data_notadinas->get_notadinasJoinAll($id_skpd);
            $record['get_kepalaSkdpWhereSkpd'] = $this->Data_setting->get_kepalaSkdpWhereSkpd($id_skpd);
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/lap_sppd', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

///Kepala SKPD
    function view($id_nota) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Nota Dinas';
            //   $record['id_skpd'] = $id_skpd;
            $record['get_notaDinasWhereId'] = $this->Data_notadinas->get_notaDinasWhereId($id_nota);
            $record['get_notaDinasDetailWhereIdNd'] = $this->Data_notadinas->get_notaDinasDetailWhereIdNd($id_nota);

            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/view', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function update($id_nota) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Nota Dinas';
            //   $record['id_skpd'] = $id_skpd;
            $record['get_notaDinasWhereId'] = $this->Data_notadinas->get_notaDinasWhereId($id_nota);
            $record['get_notaDinasDetailWhereIdNd'] = $this->Data_notadinas->get_notaDinasDetailWhereIdNd($id_nota);
            $record['get_SetAsisten'] = $this->Data_setting->get_SetAsisten();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/update', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function updatestatuspersetujuan() {
        $url = $this->input->post('url');
        $id = $this->input->post('id');
        $status_persetujuan = $this->input->post('status_persetujuan');
        $penerima = $this->input->post('penerima');
        $tgl_ttd = date('Y-m-d H:i:s');
        $req['id_set_asisten'] = $this->input->post('id_assisten');
        $req['ttd_kepala'] = $status_persetujuan;
        $req['posting'] = 1;
        $req['tgl_ttd_kepala'] = $tgl_ttd;
        $query = $this->Data_aksi->update('id', $id, 'tbl_nota_dinas', $req);
        if ($query > 0) {
            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Anda Berhasil Menandatangani dan Mengirim Nota Dinas Ini Ke Asisten yang anda pilih');
            $activity = 'Menandatangani Nota Dinas  Dengan Id : ' . $id;
            $this->Data_aksi->aktivitas($activity);
            $this->Data_aksi->sendEmail($penerima, $tgl_ttd);
            redirect($url);
        } else {
            $this->session->set_flashdata('tipe', 'alert-danger');
            $this->session->set_flashdata('msg', 'Gagal Melakukan Posting');
            redirect($url);
        }
    }

    function masuk() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $level = $a['level_user'];
            if ($level == 2) {
                $kode_skpd = $a['kode'];
            } elseif ($level == 5) {
                $kode_skpd = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
            }
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['getnotadinas'] = $this->Data_notadinas->get_notadinasJoinAllbyStatus(0, $kode_skpd);
            $record['page_name'] = 'Data Surat Nota Dinas Masuk';
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/nota_dinas_skpd_masuk', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function keluar() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $level = $a['level_user'];
            if ($level == 2) {
                $kode_skpd = $a['kode'];
            } elseif ($level == 5) {
                $kode_skpd = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
            }
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['getnotadinas'] = $this->Data_notadinas->get_notadinasJoinAllbyStatus(1, $kode_skpd);
            $record['page_name'] = 'Data Surat Nota Dinas Keluar';
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/nota_dinas_skpd_keluar', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function listbidangbyidassisten() {
        if ($this->session->userdata('is_login')) {
            $id = $this->input->post('no');
            $a = $this->session->userdata('is_login');
            $id_assisten = $this->input->post('id_assisten');
            $level = $a['level_user'];
            if ($level == 2) {
                $id_skpd = $a['kode'];
            } elseif ($level == 5) {
                $id_skpd = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
            }
            $record['head'] = $this->load->view('head', NULL, TRUE);
            $record['js'] = $this->load->view('js', NULL, TRUE);
            $record['id_skpd'] = $id_skpd;
            $record['get_SetAsistenBidangWhereAsisten'] = $this->Data_setting->get_SetAsistenBidangWhereAsisten($id_assisten);
            $record['get_SetAsistenWhereAsisten'] = $this->Data_setting->get_SetAsistenWhereAsisten($id_assisten);
            $tabel = $this->load->view('skpd/data/surat/tabel/tabel_urusan', $record, true);

            echo $tabel;
        }
    }

//Laporan
    function indexnd() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $level = $a['level_user'];
            if ($level == 2) {
                $kode_skpd = $a['kode'];
            } elseif ($level == 5) {
                $kode_skpd = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
            }
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['getnotadinas'] = $this->Data_notadinas->get_notadinasJoinAll($kode_skpd);
            $record['page_name'] = 'Data Surat Nota Dinas';
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/index_nota_dinas', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function viewnd($id_nota) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id = $id_nota;
            $level = $a['level_user'];
            if ($level == 2) {
                $id_skpd = $a['kode'];
            } elseif ($level == 5) {
                $id_skpd = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
            }
            $record['head'] = $this->load->view('head', NULL, TRUE);
            $record['js'] = $this->load->view('js', NULL, TRUE);
            $record['skpdWhereKun'] = json_decode($this->curl->simple_get($this->API . '/api_skpd?kunker=' . $id_skpd));
            $record['id'] = $id;
            $record['id_skpd'] = $id_skpd;
            $record['get_pegawai'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
            $record['get_setSkpdWhereKd'] = $this->Data_setting->get_setSkpdWhereKd($id_skpd);
            $record['get_SetKepalaSkpdWhereKd'] = $this->Data_setting->get_SetKepalaSkpdWhereKd($id_skpd);
            $record['get_SetKewenanganJoinTtd'] = $this->Data_setting->get_SetKewenanganJoinTtd();
            $record['get_notaDinasWhereId'] = $this->Data_notadinas->get_notaDinasWhereId($id);
            $record['get_notaDinasDetailWhereIdNd'] = $this->Data_notadinas->get_notaDinasDetailWhereIdNd($id);
            $record['get_SetKewenanganJoinTtd'] = $this->Data_setting->get_SetKewenanganJoinTtd();
            $data['content'] = $this->load->view('skpd/data/surat/viewnd', $record, true);
            $this->load->view('laporan/paper', $data);
        } else {
            redirect('login');
        }
    }

    public function rekap() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $level = $a['level_user'];
            if ($level == 2) {
                $kode_skpd = $a['kode'];
            } elseif ($level == 5) {
                $kode_skpd = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
            }
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['getnotadinas'] = $this->Data_notadinas->get_notadinasJoinAllbyStatus(2, $kode_skpd);
            $record['page_name'] = 'Setting Kepala SKPD';
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/rekap', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    public function lapnota() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $level = $a['level_user'];
            if ($level == 2) {
                $kode_skpd = $a['kode'];
            } elseif ($level == 5) {
                $kode_skpd = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
            }
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['getnotadinas'] = $this->Data_notadinas->get_notadinasJoinAllbyStatus(2, $kode_skpd);
            $record['get_notadinasJoinAll'] = $this->Data_notadinas->get_notadinasJoinAll($kode_skpd);
            $record['page_name'] = 'Pencarian Nota Dinas';
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('skpd/data/surat/lapnota', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    public function carinota() {

        if ($this->session->userdata('is_login')) {
            $id = $this->input->post('no');
            $a = $this->session->userdata('is_login');
            $id = $this->input->post('no');
            $level = $a['level_user'];
            if ($level == 2) {
                $id_skpd = $a['kode'];
            } elseif ($level == 5) {
                $id_skpd = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
            }
            $record['head'] = $this->load->view('head', NULL, TRUE);
            $record['js'] = $this->load->view('js', NULL, TRUE);
            $record['skpdWhereKun'] = json_decode($this->curl->simple_get($this->API . '/api_skpd?kunker=' . $id_skpd));
            $record['id'] = $id;
            $record['id_skpd'] = $id_skpd;
            $record['get_pegawai'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
            $record['get_setSkpdWhereKd'] = $this->Data_setting->get_setSkpdWhereKd($id_skpd);
            $record['get_SetKepalaSkpdWhereKd'] = $this->Data_setting->get_SetKepalaSkpdWhereKd($id_skpd);
            $record['get_SetKewenanganJoinTtd'] = $this->Data_setting->get_SetKewenanganJoinTtd();
            $record['get_notaDinasWhereId'] = $this->Data_notadinas->get_notaDinasWhereId($id);
            $record['get_notaDinasDetailWhereIdNd'] = $this->Data_notadinas->get_notaDinasDetailWhereIdNd($id);
            $record['get_SetKewenanganJoinTtd'] = $this->Data_setting->get_SetKewenanganJoinTtd();
            $data['content'] = $this->load->view('laporan/formulir_nota_dinas', $record, true);
            $dok = $this->load->view('laporan/paper', $data, true);
            echo $dok;
//            $record['javasc'] = $this->load->view('js', NULL, TRUE);
//              $record['get_notaDinasWhereId'] = $this->Data_notadinas->get_notaDinasWhereId($id);
//             $get_page = $this->load->view('skpd/data/modal/tabel_nota_dinas', $record, true);
//            echo $get_page;
        }
    }

}

//
//    function insertNotaDinasDetail() {
//        $a = $this->session->userdata('is_login');
//        $kode = $this->input->post('kode');
//        $id_ref_tujuan = $this->input->post('id_ref_tujuan');
//        $id_skpd = $this->input->post('id_skpd');
//
//        redirect('admin/surat/Nota_dinas');
//    }
