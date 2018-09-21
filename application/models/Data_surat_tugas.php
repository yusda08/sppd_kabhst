<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Data_notadinas
 *
 * @author zaky
 */
class Data_surat_tugas extends CI_Model {

    //put your code here
    function get_suratTugasSkpdWhereStatus($status, $id_skpd) {
        $query = $this->db->query("select a.*, b.no_spt, b.id as id_spt, b.id_ttd_spt, b.alat_angkut, b.tgl_spt, b.status_ttd_spt from tbl_nota_dinas a "
                . "left join tbl_surat_tugas b on a.id=b.id_nota_dinas where a.status_persetujuan='$status' and a.id_skpd='$id_skpd' order by b.tgl_spt desc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function countSptSkpd($status, $id_skpd) {
        $query = $this->db->query("select count(b.id) as jml_spt 
from tbl_nota_dinas a 
left join tbl_surat_tugas b on a.id=b.id_nota_dinas 
where a.status_persetujuan='$status' and a.id_skpd='$id_skpd' and !isnull(b.id)");
        if ($query) {
            return $query->row()->jml_spt;
        } else {
            return false;
        }
    }
    function countSptSkpdBlmTtd($id_skpd) {
        $query = $this->db->query("select count(b.id) as jml_spt 
from tbl_nota_dinas a 
left join tbl_surat_tugas b on a.id=b.id_nota_dinas 
where a.status_persetujuan=1 and b.status_ttd_spt=0 and a.id_skpd='$id_skpd'");
        if ($query) {
            return $query->row()->jml_spt;
        } else {
            return false;
        }
    }

    function get_suratTugasSkpdWhereId($id_nd) {
        $query = $this->db->query("select a.*, b.no_spt, b.id as id_spt, b.alat_angkut, b.id_ttd_spt, b.tgl_spt, b.status_ttd_spt from tbl_nota_dinas a "
                . "left join tbl_surat_tugas b on a.id=b.id_nota_dinas where a.id='$id_nd'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function get_realisasiAnggaranLuarWhereSkpd($id_skpd) {
        $query = $this->db->query("select * from tbl_realisasi_luar b where b.kode_skpd='$id_skpd'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_realisasiAnggaranDalamWhereSkpd($id_skpd) {
        $query = $this->db->query("select * from tbl_realisasi_dalam b where b.kode_skpd='$id_skpd'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function sum_realisasiAnggaranLuar() {
        $query = $this->db->query("select sum(realisasi_luar) as jml_luar from tbl_realisasi_luar");
        if ($query) {
            return $query->row()->jml_luar;
        } else {
            return false;
        }
    }
    function sum_realisasiAnggaranDalam() {
        $query = $this->db->query("select sum(realisasi_dalam) as jml_dalam from tbl_realisasi_dalam");
        if ($query) {
            return $query->row()->jml_dalam;
        } else {
            return false;
        }
    }

    function get_suratPerjalananDinasWhereSt($id_skpd, $id_spt) {
        $query = $this->db->query("select a.*, c.id as id_spd, b.no_spt, b.id as id_spt, b.id_ttd_spt, b.tgl_spt, b.status_ttd_spt, b.alat_angkut, c.nama, c.nip_nik, 
c.`status`, c.pangkat_gol, c.jabatan, d.status_pegawai
 from tbl_nota_dinas a
join tbl_surat_tugas b on a.id=b.id_nota_dinas 
join tbl_nota_dinas_detail c on b.id_nota_dinas=c.id_nota_dinas
join tbl_pegawai d on d.nip_nik=c.nip_nik
where a.id_skpd='$id_skpd' and c.`status`=1 and b.id='$id_spt' group by d.nip_nik order by d.id_jabatan");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_suratPerjalananDinasWhereSpd($id_skpd, $id_spd) {
        $query = $this->db->query("select a.*, 
 b.no_spt, b.id as id_spt, b.id_ttd_spt, b.tgl_spt, b.status_ttd_spt, 
 case when isnull(a.alat_angkut) then b.alat_angkut else a.alat_angkut end alat_angkut, 
c.id as id_spd, c.nama, c.nip_nik, 
c.`status`, c.pangkat_gol, c.jabatan, d.status_pegawai, e.nama as nm_keg, f.kode_rekening, f.no_dpa, f.nama_skpd
 from tbl_nota_dinas a
join tbl_surat_tugas b on a.id=b.id_nota_dinas 
join tbl_nota_dinas_detail c on b.id_nota_dinas=c.id_nota_dinas
join tbl_pegawai d on d.nip_nik=c.nip_nik
join tbl_ref_tujuan e on e.id=a.id_ref_tujuan
join tbl_ref_rekening f on f.id=e.id_ref_rekening
where a.id_skpd='$id_skpd' and c.`status`=1 and c.id='$id_spd' order by d.id_jabatan");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function coverSuratTugas() {
        $query = $this->db->query("select * from tbl_setting_skpd where kode_skpd='1001000000'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function countSpt() {
        $query = $this->db->query("select ceil(count(id)+1) as jml from tbl_surat_tugas");
        if ($query) {
            return $query->row()->jml;
        } else {
            return false;
        }
    }
    function countSptAndNdWhereSkpd($id_skpd) {
        $query = $this->db->query("select count(c.id)-st.jml_st jml_nd, klr.jml_spt, c.id_skpd from tbl_nota_dinas c join 
(select count(b.no_spt) as jml_st, a.id_skpd from tbl_nota_dinas a 
left join tbl_surat_tugas b on a.id=b.id_nota_dinas where a.id_skpd='$id_skpd')
st 
join (select count(e.id) as jml_spt 
from tbl_nota_dinas d
left join tbl_surat_tugas e on d.id=e.id_nota_dinas 
where d.status_persetujuan='1' and e.status_ttd_spt=0 and d.id_skpd='$id_skpd') klr
where c.id_skpd='$id_skpd' and c.status_persetujuan='1';");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    function countSptAndNdWhereSkpdAll(){
        $query = $this->db->query("select count(c.id)-st.jml_st jml_nd, klr.jml_spt, c.id_skpd from tbl_nota_dinas c join 
(select count(b.no_spt) as jml_st, a.id_skpd from tbl_nota_dinas a 
left join tbl_surat_tugas b on a.id=b.id_nota_dinas where a.status_persetujuan='1')
st 
join (select count(e.id) as jml_spt 
from tbl_nota_dinas d
left join tbl_surat_tugas e on d.id=e.id_nota_dinas 
where d.status_persetujuan='1' and e.status_ttd_spt=0 ) klr
where  c.status_persetujuan='1'");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    

    function get_ttdSuratTugas($id, $id_skpd, $id_nd) {
        $query = $this->db->query("SELECT a.id, CASE a.id	WHEN 1 THEN exe.nm_exe  
								WHEN 2 THEN exe.nm_exe
								WHEN 3 THEN sek.jabatan
								WHEN 5 THEN asisten.jabatan 
								when 6 then kpl_skpd.jabatan
								END AS keterangan,
				CASE a.id	WHEN 1 THEN exe.nm_pgw  
								WHEN 2 THEN exe.nm_pgw
								WHEN 3 THEN sek.nm_pgw
								WHEN 5 THEN asisten.nm_pgw 
								when 6 then kpl_skpd.nm_pgw
								END AS nama_pegawai,				
                                CASE a.id WHEN 3 THEN sek.nip_nik
								WHEN 5 THEN asisten.nip_nik 
								when 6 then kpl_skpd.nip_nik
								END AS nip				
												
								FROM tbl_ref_ttd a
left join (select c.id, c.nama as nm_exe, c.id_ttd, n.nama as nm_pgw, n.email from tbl_ref_executive c 
join tbl_ref_ttd d on d.id=c.id_ttd
join tbl_setting_executive n on n.id_executive=c.id)
exe on exe.id_ttd=a.id
left join (select e.id, e.nama as nm_sekda, e.id_ttd, g.nip_nik, h.nama as nm_pgw, h.jabatan from tbl_ref_sekda e 
join tbl_ref_ttd f on f.id=e.id_ttd 
join tbl_setting_sekda g on g.id_ref_sekda=e.id
join tbl_pegawai h on h.nip_nik=g.nip_nik)
sek on sek.id_ttd=a.id

left join (select i.id, i.id_ttd, l.nip_nik, l.jabatan, l.nama as nm_pgw 
 from tbl_ref_asisten i join tbl_ref_ttd j on j.id=i.id_ttd 
 join tbl_setting_asisten k on k.asisten=i.id 
 join tbl_pegawai l on l.nip_nik=k.nip_nik 
 join tbl_nota_dinas m on m.id_set_asisten=k.id
  where m.id='$id_nd' group by i.id)
asisten on asisten.id_ttd=a.id 

left join (select q.nip_nik, q.jabatan, q.nama as nm_pgw, p.nama as nm_ttd, o.kode_skpd, o.email, o.id_ttd from tbl_setting_kepala_skpd o
join tbl_ref_ttd p on p.id=o.id_ttd
join tbl_pegawai q on q.nip_nik=o.nip where o.kode_skpd='$id_skpd')
kpl_skpd on kpl_skpd.id_ttd=a.id
where a.id=$id");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function sum_realisasiAnggaranLuarSkpd($kode_skpd) {
        $query = $this->db->query("select sum(realisasi_luar) as jml_luar from tbl_realisasi_luar where kode_skpd='$kode_skpd'");
        if ($query) {
            return $query->row()->jml_luar;
        } else {
            return false;
        }
    }
    function sum_realisasiAnggaranDalamSkpd($kode_skpd) {
        $query = $this->db->query("select sum(realisasi_dalam) as jml_dalam from tbl_realisasi_dalam where kode_skpd='$kode_skpd'");
        if ($query) {
            return $query->row()->jml_dalam;
        } else {
            return false;
        }
    }

}
