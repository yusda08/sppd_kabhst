<?php

class Ref_user extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
        $this->load->model('data_administrator');
        $this->load->model('data_referensi');
        $this->load->model('Data_setting');
        $this->load->model('Data_pegawai');
        $this->load->model('Data_aksi');
        $this->load->model('data_login');
        $this->load->model('Data_surat_tugas');
        $this->load->model('Tgl_indo');
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
            $record['page_name'] = 'Referensi User';
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['get_level_user'] = $this->data_login->get_level_user();
            $record['get_user_all'] = $this->data_administrator->get_user_all();
            $record['get_ref_executive'] = $this->data_referensi->get_ref_executive();
            $record['get_sekda'] = $this->Data_setting->get_sekda();
            $record['get_setStafAhli'] = $this->Data_setting->get_setStafAhli();
            $record['get_dataPegawai'] = $this->Data_pegawai->get_dataPegawai();
            $record['get_refAsisten'] = $this->data_referensi->get_refAsisten();
            $record['javasc'] = $this->load->view('js', NULL, TRUE);
            $data['content'] = $this->load->view('admin/data/referensi/ref_user', $record, TRUE);
            $this->load->view('layout', $data);
        }
    }

    function add_pegawaiSkpd($kun, $kom) {
        $query = json_decode($this->curl->simple_get($this->API . '/Api_pegawai/pegawaiSkpd?kuntp=' . $kun . '&kunkom=' . $kom));
        $query1 = $this->data_administrator->get_user_all();
        $data = "<option value=''>-- Pilih Pegawai--</option>";
        foreach ($query as $row) {
            foreach ($query1 as $que) {
                if ($que->kode == $row->nip) {
                    $att = "disabled";
                    break;
                } else {
                    $att = "";
                }
            }
            $data .= "<option " . $att . " value='" . $row->nip . "' data-nip='" . $row->nip . "'>" . $row->gldepan . " " . $row->nama . " " . $row->glblk . "</option>";
        }
        echo $data;
    }

    function cek_username($username) {
        $cek = $this->data_administrator->get_count_user_id($username);
        echo json_encode($cek);
    }
    
    function rest_pass() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id = $this->input->post('id');
            $pass_baru = md5($this->input->post('password'));
            $url = $this->input->post('url');
            $username_lama = $this->input->post('username_lama');
            $username_baru = $this->input->post('username_baru');
            $data['username'] = $username_baru;
            $data['password'] = $pass_baru;
            $query = $this->Data_aksi->update('id', $id, 'user', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil diupdate');
                $activity = 'Mengubah Password (' . $pass_baru . ')   dengan Username ' . $username_lama;
                $this->Data_aksi->aktivitas($activity);
                redirect($url);
            } else {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Password Gagal Di Reset');
                redirect($url);
            }
        } else {
            redirect('login');
        }
    }
    
    function pegawaiKepalaSkpd($kunker) {
        $query = $this->Data_setting->get_SetKepalaSkpdWhereKd($kunker);
        foreach ($query as $row){
            $id = $row->id;
            $kode_skpd = $row->kode_skpd;
            $nip = $row->nip;
            $email = $row->email;
            $jabatan = $row->jabatan;
            $nama = $row->nama;
        }
        
        $cek[] = array(
            'nama' => $nama,
            'nip' => $nip,
            'jabatan' => $jabatan,
            'id' => $id
            );
        
        echo json_encode($cek);
    }

    function insert_user() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $level = $this->input->post('level_user');
            if ($level == 1) {
                $kode = date('Ymdhsi');
                $ket = 'Administrator';
            } elseif ($level == 2) {
                $kode = $this->input->post('skpd1');
                $ket = 'SKPD';
            } elseif ($level == 3) {
                $ket = 'Executive';
                $kode = $this->input->post('kode_exe');
            } elseif ($level == 4) {
                $ket = 'Staf Ahli';
                $kode = $this->input->post('id_staf_ahli');
            } elseif ($level == 5) {
                $ket = 'Kepala SKPD';
                $kode = $this->input->post('kode_skpd');
            } elseif ($level == 6) {
                $ket = 'Sekda';
                $kode = $this->input->post('id_sekda');
            }  elseif ($level == 7) {
                $ket = 'Asisten';
                $kode = $this->input->post('asisten');
            } else {
                $ket = '';
                $kode = '';
            }
            $username = strtolower($this->input->post('username'));
            $data['keterangan'] = $ket;
            $data['username'] = $username;
            $data['kode'] = $kode;
            $data['password'] = md5($this->input->post('password'));
            $data['level_user'] = $level;
            $data['ol'] = 'N';
//            var_dump($data);
//            return true;

            $query = $this->Data_aksi->insert('user', $data);
            if ($query > 0) {
                $this->session->set_flashdata('tipe', 'alert-success');
                $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
                $activity = 'Menambah User dengan Username ' . $username . ' Ket ' . $ket;
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

    function hapus_user() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $url = $this->input->post('url');
            $id = $this->input->post('id');
            $username = $this->input->post('username');
            if ($id) {
                $query = $this->Data_aksi->delete('id', $id, 'user');
                if ($query > 0) {
                    $this->session->set_flashdata('tipe', 'alert-success');
                    $this->session->set_flashdata('msg', 'Data berhasil dihapus');
                    $activity = 'Menghapus User dengan Username ' . $username;
                    $this->Data_aksi->aktivitas($activity);
                    redirect($url);
                } else {
                    $this->session->set_flashdata('tipe', 'alert-danger');
                    $this->session->set_flashdata('msg', 'Gagal menghapus data');
                    redirect($url);
                }
            } else {
                $this->session->set_flashdata('tipe', 'alert-danger');
                $this->session->set_flashdata('msg', 'Gagal menghapus data');
                redirect($url);
            }
        } else {
            redirect('login');
        }
    }

}
