<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Data_refJabatan extends CI_Model {
    
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

}