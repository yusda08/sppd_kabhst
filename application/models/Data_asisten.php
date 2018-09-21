<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Data_asisten
 *
 * @author zaky
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_asisten extends CI_Model {

    //put your code here
    function get_surat_masuk($as) {
        $query = $this->db->query("
select a.id, a.no, a.status_persetujuan, a.perihal, a.tgl_nota_dinas,  a.tujuan, g.nama penggunaan,a.nama_file, a.id_skpd, f.id_kewenangan,
f.id id_kewenangan_detail, c.nip_nik, h.nama, h.posting,
h.isi,
case when e.id_ttd=d.id_ttd then 'persetujuan'
else 'disposisi' end sbg 
from tbl_nota_dinas a join tbl_setting_asisten_skpd b on
a.id_skpd=b.kode_skpd
join tbl_setting_asisten c on 
c.id=b.id_asisten
join tbl_ref_asisten d on 
d.id=c.asisten
join tbl_setting_kewenangan e on 
e.id=a.id_ref_kewenangan
left join tbl_setting_kewenangan_detail f on
f.id_ttd=d.id_ttd and e.id=f.id_kewenangan
join tbl_ref_tujuan g on
a.id_ref_tujuan = g.id
left join tbl_disposisi h
on h.id_nota_dinas=a.id and h.nip_nik=c.nip_nik
where d.id='$as' and a.status_persetujuan=0");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_surat_keluar($as) {
        $query = $this->db->query("
select a.id, a.no, a.status_persetujuan, a.perihal, a.tgl_nota_dinas,  a.tujuan, g.nama penggunaan,a.nama_file, a.id_skpd, f.id_kewenangan,
f.id id_kewenangan_detail, c.nip_nik, h.nama,
h.isi,
case when e.id_ttd=d.id_ttd then 'persetujuan'
else 'disposisi' end sbg 
from tbl_nota_dinas a join tbl_setting_asisten_skpd b on
a.id_skpd=b.kode_skpd
join tbl_setting_asisten c on 
c.id=b.id_asisten
join tbl_ref_asisten d on 
d.id=c.asisten
join tbl_setting_kewenangan e on 
e.id=a.id_ref_kewenangan
left join tbl_setting_kewenangan_detail f on
f.id_ttd=d.id_ttd and e.id=f.id_kewenangan
join tbl_ref_tujuan g on
a.id_ref_tujuan = g.id
left join tbl_disposisi h
on h.id_nota_dinas=a.id and h.nip_nik=c.nip_nik
where d.id='$as' and (h.posting=1 or a.status_persetujuan=1 or a.status_persetujuan=2)");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function disposisi($id, $nip_nik) {
        $query = $this->db->query("select * from tbl_disposisi where id_nota_dinas=$id and nip_nik='$nip_nik'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_suratMasukWhereAsisten($as) {
        $query = $this->db->query("select a.*, c.asisten, c.nip_nik, c.email, d.nama as nm_pgw, d.jabatan, e.id_ttd, 
f.nama as nm_ttd, h.urutan, h.id as id_kew_det, if(h.id > 0, 'disposisi', 'persetujuan') 
as ket, i.isi, i.id as id_det_nt, i.tgl_time_disposisi from tbl_nota_dinas a 
join tbl_setting_asisten c on a.id_set_asisten=c.id 
join tbl_pegawai d on d.nip_nik=c.nip_nik 
join tbl_ref_asisten e on c.asisten=e.id 
join tbl_ref_ttd f on e.id_ttd=f.id 
left join tbl_setting_kewenangan_detail h on h.id_ttd=e.id_ttd and a.id_ref_kewenangan=h.id_kewenangan 
left join tbl_disposisi i 
 on i.id_nota_dinas=a.id and i.id_kewenangan_detail=h.id where c.asisten='$as' group by a.id  order by 
 a.id desc, a.tgl_nota_dinas desc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_asistenWhereId($as) {
        $query = $this->db->query("select a.*, b.nama, c.asisten, c.nip_nik, c.email, d.jabatan, d.nama as nm_pgw
from user a join tbl_ref_asisten b on a.kode=b.id
join tbl_setting_asisten c on b.id=c.asisten
join tbl_pegawai d on d.nip_nik=c.nip_nik
where c.asisten='$as' group by b.id");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
function count_nota_dinasMasukWhereAsisten($as) {
        $query = $this->db->query("select count(a.id)-count(i.id) as jml_md_masuk from tbl_nota_dinas a 
            join tbl_setting_asisten c on a.id_set_asisten=c.id
            join tbl_ref_asisten e on c.asisten=e.id
            join tbl_ref_ttd f on e.id_ttd=f.id
            left join tbl_setting_kewenangan_detail h on h.id_ttd=e.id_ttd and a.id_ref_kewenangan=h.id_kewenangan
            left join tbl_disposisi i on i.id_nota_dinas=a.id and i.id_kewenangan_detail=h.id
            where c.asisten='as1' and a.ttd_kepala=1 and a.status_persetujuan=0 ");
        if ($query) {
            return $query->row()->jml_md_masuk;
        } else {
            return false;
        }
    }
function count_nota_dinasKeluarWhereAsisten($as) {
        $query = $this->db->query("select count(a.id) jml_md_masuk from tbl_nota_dinas a 
            join tbl_setting_asisten c on a.id_set_asisten=c.id 
            join tbl_ref_asisten e on c.asisten=e.id
            join tbl_ref_ttd f on e.id_ttd=f.id
            left join tbl_setting_kewenangan_detail h on h.id_ttd=e.id_ttd and a.id_ref_kewenangan=h.id_kewenangan
            left join tbl_disposisi i on i.id_nota_dinas=a.id and i.id_kewenangan_detail=h.id
            where c.asisten='$as' and a.ttd_kepala=1 and (a.status_persetujuan=1 or i.id!=0)");
        if ($query) {
            return $query->row()->jml_md_masuk;
        } else {
            return false;
        }
    }
   

}
