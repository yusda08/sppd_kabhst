<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pegawai extends CI_Model {

    function count_dataPegawaiWhereJab($id_jabatan) {
        $query = $this->db->query("select count(id_jabatan) as cek from tbl_pegawai where id_jabatan='$id_jabatan'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function count_dataPegawaiWhereSkpd($id_skpd) {
        $query = $this->db->query("select count(a.nip_nik) as jml_pegawai 
from (select * from tbl_pegawai group by nip_nik, nunker) a where a.nunker='$id_skpd'");
        if ($query) {
            return $query->row()->jml_pegawai;
        } else {
            return false;
        }
    }

    function count_dataPegawai($status) {
        $query = $this->db->query("select count(a.nip_nik) as jml_pegawai from tbl_pegawai a where status_pegawai='$status'");
        if ($query) {
            return $query->row()->jml_pegawai;
        } else {
            return false;
        }
    }

    function get_dataPegawai() {
        $query = $this->db->query("select a.*,b.nama_jabatan, b.tingkat, c.nama_bank from tbl_pegawai a 
                left join tbl_ref_jabatan b on a.id_jabatan=b.id 
                left join tbl_ref_bank c on c.id=a.id_bank group by a.nip_nik, a.nunker
                 order by a.nunker asc, status_pegawai desc, id_jabatan asc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_dataPegawaiWhereKd($kd_skpd) {
        $query = $this->db->query("select a.*,b.nama_jabatan, b.tingkat, c.nama_bank from tbl_pegawai a 
left join tbl_ref_jabatan b on a.id_jabatan=b.id 
left join tbl_ref_bank c on c.id=a.id_bank
where a.nunker='$kd_skpd' group by a.nip_nik, a.nunker
order by status_pegawai desc, id_jabatan asc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_dataKepalaSkpdWhereKd($kd_skpd) {
        $query = $this->db->query("select a.*, 
c.id as id_kepala, c.nip, c.email as email_kepala, c.ttd_kepala, d.nama as nm_kepala, d.no_rekening, d.jabatan, d.id_jabatan 
from user a 
join tbl_setting_kepala_skpd c on a.kode=c.id
join tbl_pegawai d on d.nip_nik=c.nip where c.kode_skpd='$kd_skpd' and a.`level_user`=5");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_pgwSkpdWhereNip($nip, $id_skpd) {
        $query = $this->db->query("select a.*,b.nama_jabatan,b.tingkat from tbl_pegawai a 
join tbl_ref_jabatan b on a.id_jabatan=b.id where nip_nik='$nip' and a.nunker='$id_skpd'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function searchPgw($nik) {
        $query = $this->db->query("select count(nip_nik) as cek from tbl_pegawai where nip_nik='$nik'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

}
