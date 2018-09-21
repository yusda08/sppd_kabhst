<?php

//include_once APPPATH . '/third_party/mpdf60/mpdf.php';
require_once APPPATH . '/third_party/vendor/mpdf/mpdf/mpdf.php';

class Laporan_html extends CI_Controller {

    var $API = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Data_setting');
        $this->load->model('Data_notadinas');
        $this->load->model('Data_surat_tugas');
        $this->load->model('Data_aksi');
        $this->load->model('Tgl_indo');
//        $this->API = base_url() . "reset_api/index.php";
        $this->API = "http://simpeg.hulusungaitengahkab.go.id/reset_api/index.php";
    }

    function formulir_nota_dinas() {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id = $this->input->get('id');
            $id_skpd = $this->input->get('id_skpd');
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
            $record['get_realisasiAnggaranLuarWhereSkpd'] = $this->Data_surat_tugas->get_realisasiAnggaranLuarWhereSkpd($id_skpd);
            $record['get_realisasiAnggaranDalamWhereSkpd'] = $this->Data_surat_tugas->get_realisasiAnggaranDalamWhereSkpd($id_skpd);
            $record['get_realisasiAnggaran'] = $this->Data_setting->get_realisasiAnggaran();
            $record['get_notaDinasDetailWhereIdNd'] = $this->Data_notadinas->get_notaDinasDetailWhereIdNd($id);
            $record['get_SetKewenanganJoinTtd'] = $this->Data_setting->get_SetKewenanganJoinTtd();
            $data['content'] = $this->load->view('laporan/formulir_nota_dinas', $record, true);
            $this->load->view('laporan/paper', $data);
        } else {
            redirect('login');
        }
    }

    function formulir_surat_tugas($id_skpd) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id_nd = $this->input->get('id_nd');
            $record['head'] = $this->load->view('head', NULL, TRUE);
            $record['js'] = $this->load->view('js', NULL, TRUE);
            $record['id_nd'] = $id_nd;
            $record['id_skpd'] = $id_skpd;
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['get_pegawai'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
            $record['coverSuratTugas'] = $this->Data_surat_tugas->coverSuratTugas();
            $record['get_suratTugasSkpdWhereId'] = $this->Data_surat_tugas->get_suratTugasSkpdWhereId($id_nd);
            $record['get_notaDinasDetailWhereIdNd'] = $this->Data_notadinas->get_notaDinasDetailWhereIdNd($id_nd);
            $record['get_pegawai'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
            $data['content'] = $this->load->view('laporan/formulir_surat_tugas', $record, true);
            $this->load->view('laporan/paper', $data);
        } else {
            redirect('login');
        }
    }
    
    function formulir_surat_perjalanan_dinas($id_skpd) {
        if ($this->session->userdata('is_login')) {
            $a = $this->session->userdata('is_login');
            $id_nd = $this->input->get('id_spd');
            $record['head'] = $this->load->view('head', NULL, TRUE);
            $record['js'] = $this->load->view('js', NULL, TRUE);
            $record['id_nd'] = $id_nd;
            $record['id_skpd'] = $id_skpd;
            $record['skpd'] = json_decode($this->curl->simple_get($this->API . '/api_skpd'));
            $record['skpdWhereKun'] = json_decode($this->curl->simple_get($this->API . '/api_skpd?kunker=' . $id_skpd));
            $record['get_pegawai'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
            $record['coverSuratTugas'] = $this->Data_surat_tugas->coverSuratTugas();
            $record['get_sekda'] = $this->Data_setting->get_sekda();
//            $record['get_ttdSuratTugas'] = $this->Data_surat_tugas->get_ttdSuratTugas(5, $id_skpd, $id_nd);
            $record['get_suratPerjalananDinasWhereSpd'] = $this->Data_surat_tugas->get_suratPerjalananDinasWhereSpd($id_skpd, $id_nd);
            $record['get_pegawai'] = json_decode($this->curl->simple_get($this->API . '/Api_pegawai'));
            $data['content'] = $this->load->view('laporan/formulir_surat_perjalanan_dinas', $record, true);
            $this->load->view('laporan/paper_land', $data);
        } else {
            redirect('login');
        }
    }

}
