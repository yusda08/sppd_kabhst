<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data_referensi extends CI_Model {

    function get_refBank(){
        $query = $this->db->query("select * from tbl_ref_bank");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_refJabatan(){
        $query = $this->db->query("select * from tbl_ref_jabatan order by tingkat asc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_refJabWhereId($id)
	{
        $query = $this->db->query("select * from tbl_ref_jabatan where id='$id'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }   

    
    function get_refTujuan() {
        $query = $this->db->query("select a.id, a.nama, b.kode_rekening, b.jenis_rekening, b.id id_rek from "
                . "tbl_ref_tujuan a left join tbl_ref_rekening b on a.id_ref_rekening=b.id order by a.id");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function max_refTujuan() {
        $query = $this->db->query("select max(id) as id from tbl_ref_tujuan");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_ref_executive() {
        $query = $this->db->query("select * from tbl_ref_executive");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_refAsisten() {
        $query = $this->db->query("select * from tbl_ref_asisten");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function count_refAsisten() {
        $query = $this->db->query("select count(id) as countId from tbl_ref_asisten");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_refProv() {
        $query = $this->db->query("select * from tbl_ref_provinsi");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function get_refProvWhereId($id){
        $query = $this->db->query("select * from tbl_ref_provinsi where id=$id");
        
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function get_refTtd() {
        $query = $this->db->query("select * from tbl_ref_ttd");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_refTtdNotStafAhli() {
        $query = $this->db->query("select * from tbl_ref_ttd where id not in(4,6)");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_refRekening() {
        $query = $this->db->query("select * from tbl_ref_rekening");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function get_alat_angkut(){
        $query = $this->db->query("select * from tbl_ref_alat_angkut");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_refAlatangkut() {
        $query = $this->db->query("select * from tbl_ref_alat_angkut");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

}
