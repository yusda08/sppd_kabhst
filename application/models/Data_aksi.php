<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data_aksi extends CI_Model {

    public function insert($table, $data) {
        //insert $table($data) values($data);
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }

    public function insert_duplicate($table, $data) {
        $this->db->on_duplicate($table, $data);
        return $this->db->affected_rows();
    }

    public function update($column, $id, $table, $data) {
        //update $table set $data where $column = $id;
        $this->db->where($column, $id);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }

    public function update_multi($table, $data, $id_colum) {
        $this->db->update($table, $data, $id_colum);
        return $this->db->affected_rows();
    }

    public function delete($column, $id, $table) {
        $this->db->where($column, $id);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }
    
    public function delete_multi($table, $column) {
        $this->db->delete($table, $column);
        return $this->db->affected_rows();
    }

    function aktivitas($act) {
        date_default_timezone_set("Asia/Makassar");
        $a = $this->session->userdata('is_login');
        $username = $a['username'];
        $dt = date('Y-m-d');
        $tm = date('h:i:s');
        $data = array(
            'username' => $username,
            'time' => $tm,
            'date' => $dt,
            'keterangan' => $act,
            'nama_komputer' => gethostbyaddr($_SERVER['REMOTE_ADDR'])
        );
        $this->db->insert('aktifitas', $data);
    }

    function get_temporaryDetailWhereKd($kode) {
        $query = $this->db->query("select a.*, b.nama, b.id_jabatan, b.jabatan, b.nunker, b.status_pegawai
from temporary_detail a join tbl_pegawai b on a.nip_nik=b.nip_nik and b.nunker=a.id_skpd
where kode='$kode' order by b.id_jabatan");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function get_temporaryDetail($kode) {
        $query = $this->db->query("select a.*, b.nama, b.id_jabatan, b.jabatan, b.nunker, b.status_pegawai 
from temporary_detail a join tbl_pegawai b on a.nip_nik=b.nip_nik and b.nunker=a.id_skpd where kode='$kode' order by b.id_jabatan ");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function sendEmail($penerima, $tgl_posting) {
        $a = $this->session->userdata('is_login');
        $fromEmail = 'sppdhst@gmail.com';

        $body = "<body style='margin: 10px;'>
		<div style='width: 400px; font-family: Helvetica, sans-serif; font-size: 13px; padding:10px; line-height:150%; border:#eaeaea solid 10px;'>
		<br>
		<strong>Pesan ini memberi tahu ada notifikasi masuk pada aplikasi sppd.hulusungaitengahkab.go.id 
                <br>" . Tgl_indo::indo(substr($tgl_posting, 0, 10)) . " At : " . substr($tgl_posting, 10, 16) . "</strong>
		<br>Mohon Untuk Tidak Membalas Email.
		<br>
		</div>
		</body>";

        $mail = new PHPMailer();
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->IsHTML(true);
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = $fromEmail;
        $mail->Password = "setdaumum";
        $mail->SetFrom($fromEmail, 'Administrator SPPD HST');
        $mail->Subject = "Pemberitahuan";
        $mail->Body = $body;
        $mail->AddAddress($penerima);
        $mail->Send();
    }

}
