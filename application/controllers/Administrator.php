<?php

class Administrator extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
        $this->load->model('Data_administrator');
        $this->load->model('Data_asisten');
        $this->load->model('Data_notadinas');
        $this->load->model('Data_surat_tugas');
        $this->load->model('Data_pegawai');
        $this->load->model('Data_setting');
        $this->load->model('Data_aksi');
        $this->load->model('data_login');
        $this->load->model('Tgl_indo');
    }

    function index() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $level = $a['level_user'];
            $kode = $a['kode'];
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            $data['nav'] = $this->load->view('nav', NULL, TRUE);
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Dashboard';

            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            //super admin
            if ($level == 1) {
                $record['countNotaDinasAndDetail'] = $this->Data_notadinas->countNotaDinasAndDetail('1');
                $record['jml_pegawai'] = $this->Data_pegawai->count_dataPegawai('pns');
                $record['jml_nonpegawai'] = $this->Data_pegawai->count_dataPegawai('non_pns');
                $record['jml_nd'] = $this->Data_notadinas->countNdDisetujui();
                $record['jml_nd_jd'] = $this->Data_notadinas->countNdSdhJdSpt();
                $record['row'] = $this->Data_notadinas->countNotaDinasDet('1');
                $record['sum'] = $this->Data_setting->sum_realisasiAnggaran();
                $record['jml_dalam'] = $this->Data_surat_tugas->sum_realisasiAnggaranDalam();
                $record['jml_luar'] = $this->Data_surat_tugas->sum_realisasiAnggaranLuar();
                $data['content'] = $this->load->view('admin/dashboard', $record, TRUE);
            } elseif ($level == 3) {
                $record['get_executiveWhereLevel'] = $this->Data_setting->get_executiveWhereLevel($level, $kode);
                $data['content'] = $this->load->view('executive/dashboard', $record, TRUE);
            } elseif ($level == 4) {
                $record['get_stafahliWhereLevel'] = $this->Data_setting->get_stafahliWhereLevel($level, $kode);
                $data['content'] = $this->load->view('stafahli/dashboard', $record, TRUE);
            } elseif ($level == 6) {
                $record['get_suratMasukDisposisiSekda'] = $this->Data_notadinas->get_suratMasukDisposisiSekda();
                $record['get_sekdaWhereLevel'] = $this->Data_setting->get_sekdaWhereLevel($level);
                $data['content'] = $this->load->view('sekda/dashboard', $record, TRUE);
            } elseif ($level == 7) {
                $record['get_asistenWhereId'] = $this->Data_asisten->get_asistenWhereId($a['kode']);
                $data['content'] = $this->load->view('asisten/dashboard', $record, TRUE);
            }

            $this->load->view('layout', $data);
        }
    }

    function profil() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $level = $a['level_user'];
            if ($level == 5) {
                $kode = $this->Data_notadinas->get_kodeSkpdLevel5($a['kode']);
            } else{
                $kode = $a['kode'];
            }
            $data['head'] = $this->load->view('head', NULL, TRUE);
            $data['main_header'] = $this->load->view('main_header', NULL, TRUE);
            if ($level == 2 or $level == 5) {
                $data['nav'] = $this->load->view('nav_skpd', NULL, TRUE);
            } else {
                $data['nav'] = $this->load->view('nav', NULL, TRUE);
            }
            $data['foot'] = $this->load->view('foot', NULL, TRUE);
            $record['page_name'] = 'Profil';
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            if ($level == 7) {
                $record['get_asistenWhereId'] = $this->Data_asisten->get_asistenWhereId($kode);
                $data['content'] = $this->load->view('asisten/profil', $record, TRUE);
            } elseif ($level == 6) {
                $record['get_sekdaWhereLevel'] = $this->Data_setting->get_sekdaWhereLevel($level);
                $data['content'] = $this->load->view('sekda/profil', $record, TRUE);
            } elseif ($level == 4) {
                $record['get_stafahliWhereLevel'] = $this->Data_setting->get_stafahliWhereLevel($level, $kode);
                $data['content'] = $this->load->view('stafahli/profil', $record, TRUE);
            } elseif ($level == 3) {
                $record['get_executiveWhereLevel'] = $this->Data_setting->get_executiveWhereLevel($level, $kode);
                $data['content'] = $this->load->view('executive/profil', $record, TRUE);
            } elseif ($level == 1) {
                $record['get_administratorWhereLevel'] = $this->Data_setting->get_administratorWhereLevel($level, $kode);
                $data['content'] = $this->load->view('admin/profil', $record, TRUE);
            } elseif ($level == 2 or $level == 5) {
                $record['get_skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
                $record['get_pegawai'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
                $record['get_setSkpdWhereLevel'] = $this->Data_setting->get_setSkpdWhereLevel($kode , $level);
                $record['get_dataPegawaiWhereKd'] = $this->Data_pegawai->get_dataPegawaiWhereKd($kode);
                $record['get_dataKepalaSkpdWhereKd'] = $this->Data_pegawai->get_dataKepalaSkpdWhereKd($kode);
                $data['content'] = $this->load->view('skpd/profil', $record, TRUE);
            } 
            $this->load->view('layout', $data);
        }
    }

    function update_user() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $username = $this->input->post('username');
            $email = $this->input->post('email');
            $pass_baru = md5($this->input->post('password_baru'));
            $foto = $_FILES['foto']['name'];
            if ($foto != '') {
                $path = './assets/img/user/';
                $config = array(
                    'upload_path' => $path,
                    'allowed_types' => 'gif|jpg|png|jpeg|bmp|pdf',
                    'file_name' => $foto
                );
                $data['foto'] = str_replace(" ", "_", $foto);
                @unlink($path . $foto);
                $this->load->library('upload', $config);
                $this->upload->do_upload('foto');
                $config2 = array(
                    'image_library' => 'gd2',
                    'source_image' => $this->upload->upload_path . $this->upload->file_name,
                    'new_image' => './assets/img/resize/',
                    'maintain_ratio' => TRUE,
                    'width' => 300,
                    'height' => 300);
                $this->load->library('image_lib', $config2);
                if (!$this->image_lib->resize()) {
                    $this->session->set_flashdata('tipe', 'alert-danger');
                    $this->session->set_flashdata('msg', 'Data Gagal Menyimmpan');
                    redirect($url);
                }
            }
            $data['password'] = $pass_baru;
            $data['username'] = $username;
            $data['email'] = $email;
            $this->Data_aksi->update('id', $id, 'user', $data);
            $data1['email'] = $email;
            if ($a['level_user'] == 7) {
                $asisten = $this->input->post('asisten');
                $this->Data_aksi->update('asisten', $asisten, 'tbl_setting_asisten', $data1);
            } elseif ($a['level_user'] == 4) {
                $id_stafAhli = $this->input->post('id_stafAhli');
                $this->Data_aksi->update('id', $id_stafAhli, 'tbl_setting_staf_ahli', $data1);
            } elseif ($a['level_user'] == 6) {
                $id_sekda = $this->input->post('id_sekda');
                $this->Data_aksi->update('id', $id_sekda, 'tbl_setting_sekda', $data1);
            } elseif ($a['level_user'] == 3) {
                $id_exe = $this->input->post('id_exe');
                $this->Data_aksi->update('id', $id_exe, 'tbl_setting_executive', $data1);
            } elseif ($a['level_user'] == 2) {
                $kode_skpd = $this->input->post('kode_skpd');
                $email_kepala = $this->input->post('email_kepala');
                $data2['inisial'] = $this->input->post('inisial');
                $data2['no_telpon'] = $this->input->post('no_telp');
                $data2['kode_pos'] = $this->input->post('kode_pos');
                $data2['email'] = $email;
                $data2['alamat'] = addslashes($this->input->post('alamat'));
                $data2['kode_skpd'] = $kode_skpd;
                
                $data3['kode_skpd'] = $kode_skpd;
                $data3['nip'] = $this->input->post('nip');
                $data3['email'] = $this->input->post('email_kepala');
                $ttd_kepala = $_FILES['ttd_kepala']['name'];
                if ($ttd_kepala != '') {
                    $path = './assets/img/ttd_kepala/';
                    $config = array(
                        'upload_path' => $path,
                        'allowed_types' => 'gif|jpg|png|jpeg',
                        'file_name' => $ttd_kepala
                    );
                    $data3['ttd_kepala'] = str_replace(" ", "_", $ttd_kepala);
                    @unlink($path . $ttd_kepala);
                    $this->load->library('upload', $config);
                    $this->upload->do_upload('ttd_kepala');
                    $config2 = array(
                        'image_library' => 'gd2',
                        'source_image' => $this->upload->upload_path . $this->upload->file_name,
                        'new_image' => './assets/img/resize/',
                        'maintain_ratio' => TRUE,
                        'width' => 300,
                        'height' => 300);
                    $this->load->library('image_lib', $config2);
                    if (!$this->image_lib->resize()) {
                        $this->session->set_flashdata('tipe', 'alert-danger');
                        $this->session->set_flashdata('msg', 'Data Gagal Menyimmpan Karena File TTD Kepala Tidak Di Dukung');
                        redirect($url);
                    }
                }
                $this->Data_aksi->insert_duplicate('tbl_setting_skpd', $data2);
                $this->Data_aksi->insert_duplicate('tbl_setting_kepala_skpd', $data3);
//                $this->Data_aksi->update('kode_skpd',$kode_skpd,'tbl_setting_kepala_skpd', $data3);
            } elseif ($a['level_user'] == 5) {
                $id_kepala = $this->input->post('id_kepala');;
                $this->Data_aksi->update('id', $id_kepala, 'tbl_setting_kepala_skpd', $data1);
            }

            $this->session->set_flashdata('tipe', 'alert-success');
            $this->session->set_flashdata('msg', 'Data berhasil diupdate');
            $activity = 'Update Profil';
            $this->Data_aksi->aktivitas($activity);
            redirect('login/logout/' . $username);
        } else {
            redirect('login');
        }
    }

}
