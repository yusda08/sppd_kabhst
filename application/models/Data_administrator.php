<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Data_administrator extends CI_Model {
    
    function get_user_all()
	{
        $query = $this->db->query("select * from user");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function get_userWhereLevel($level_user)
	{
        $query = $this->db->query("select * from user where level_user='$level_user'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_count_user_id($username)
	{
        $query = $this->db->query("select count(username) as cek from user where username='$username'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_user_username($username)
	{
        $query = $this->db->query("select * from user where username='$username'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
   }