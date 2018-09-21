<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_login extends CI_Model {

    public function validate($username, $password, $level_user)
    {
        $query = $this->db->query("select a.*, b.nama from user a join level_user b on b.`level`=a.level_user where username='$username' and password='$password' and a.level_user='$level_user'");        
        if($query -> num_rows() == 1)
        {
            return $query->result();
        }
        else
        {
            return false;
        }
    }
        function get_level_user()
	{
        $query = $this->db->query("select * from level_user");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function setLogLogin($username, $date, $time)
    {
        $data = array(
           'log_date' => $date,
           'log_time' => $time,
           'ol' => 'Y'
        );

        if($username)
        {
            $this->db->where('username', $username);
            $this->db->update('user', $data);
        }
        else
        {
            return false;
        }
    }
    
    function setLastLogin($id, $date, $time)
    {
        $data = array(
           'last_date' => $date,
           'last_time' => $time,
           'ol' => 'N'
        );

        if($id)
        {
            $this->db->where('id', $id);
            $this->db->update('user', $data);
        }
        else
        {
            return false;
        }
    }
    
    
    function insert_log_akses($username, $date, $time, $akses, $ip, $keterangan)
    {
        $data = array(
            'username' => $username,
            'date' => $date,
            'time' => $time,
            'akses' => $akses,
            'ip' => $ip,
            'keterangan' => $keterangan
        );

        $this->db->insert('log_akses', $data);
    }    
}