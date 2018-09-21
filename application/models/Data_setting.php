<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data_setting extends CI_Model {

    function get_SetAsisten() {
        $query = $this->db->query("select a.*, c.nama as nm_as, b.nama, b.jabatan from tbl_setting_asisten a 
join tbl_pegawai b on a.nip_nik=b.nip_nik 
join tbl_ref_asisten c on c.id=a.asisten
group by a.id
order by asisten asc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetAsistenWhereId($id) {
        $query = $this->db->query("select a.*, c.nama as nm_as, b.nama, b.jabatan from tbl_setting_asisten a 
join tbl_pegawai b on a.nip_nik=b.nip_nik join tbl_ref_asisten c on c.id=a.asisten where a.id='$id'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetAsistenWhereAsisten($asisten) {
        $query = $this->db->query("select a.*, c.nama as nm_as, b.nama, b.jabatan from tbl_setting_asisten a 
join tbl_pegawai b on a.nip_nik=b.nip_nik join tbl_ref_asisten c on c.id=a.asisten where a.asisten='$asisten'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function count_SetAsisten($asisten) {
        $query = $this->db->query("select count(asisten) as cek from tbl_setting_asisten where asisten='$asisten'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetAsistenSkpdWhereAsisten($id_asisten) {
        $query = $this->db->query("select * from tbl_setting_asisten_skpd where id_asisten='$id_asisten'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function count_SetAsistenSkpd($id_asisten) {
        $query = $this->db->query("select count(id_asisten) as cek from tbl_setting_asisten_skpd where id_asisten='$id_asisten'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetAsistenSkpdWhereKdSkpd($kd_skpd) {
        $query = $this->db->query("select * from tbl_setting_asisten_skpd where kode_skpd='$kd_skpd'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetAsistenSkpd() {
        $query = $this->db->query("select * from tbl_setting_asisten_skpd");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetKepalaSkpd() {
        $query = $this->db->query("select * from tbl_setting_kepala_skpd");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_kepalaSkdpWhereSkpd($id_skpd) {
        $query = $this->db->query("select * from tbl_setting_kepala_skpd a where a.kode_skpd='$id_skpd'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetKepalaSkpdWhereKd($kd_skpd) {
        $query = $this->db->query("select a.*, b.jabatan, b.nama, b.nip_nik from tbl_setting_kepala_skpd a
join tbl_pegawai b on a.nip=b.nip_nik and a.kode_skpd=b.nunker where kode_skpd='$kd_skpd' group by kode_skpd");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_setSkpdWhereKd($kd_skpd) {
        $query = $this->db->query("select * from tbl_setting_skpd where kode_skpd='$kd_skpd'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function get_setSkpd() {
        $query = $this->db->query("select a.*, b.nip, b.email, b.ttd_kepala from tbl_setting_skpd a 
right join tbl_setting_kepala_skpd b on a.kode_skpd=b.kode_skpd");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function get_realisasiAnggaran() {
        $query = $this->db->query("select *, 
(select sum(b.realisasi_luar) from tbl_realisasi_luar b where b.kode_skpd=a.kode_skpd) as jml_realisasi_luar,
(select sum(b.realisasi_dalam) from tbl_realisasi_dalam b where b.kode_skpd=a.kode_skpd) as jml_realisasi_dalam from tbl_setting_skpd  a");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function sum_realisasiAnggaran() {
        $query = $this->db->query("select sum(kouta_anggaran_dalam) as jml_dalam, sum(kouta_anggaran_luar) as jml_luar from tbl_setting_skpd ");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    function get_setSkpdWhereLevel($kd_skpd, $level) {
        $query = $this->db->query("select a.*, b.inisial, b.alamat, b.no_telpon, b.email as email_kantor, b.kode_pos, 
c.id as id_kepala, c.nip, c.email as email_kepala, c.ttd_kepala, d.nama as nm_kepala, d.no_rekening, d.jabatan, d.id_jabatan 
from user a 
left join tbl_setting_skpd b on a.kode=b.kode_skpd 
left join tbl_setting_kepala_skpd c on b.kode_skpd=c.kode_skpd
left join tbl_pegawai d on d.nip_nik=c.nip where a.kode='$kd_skpd' and a.`level_user`=$level and d.nunker='$kd_skpd'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_representasi() {
        $query = $this->db->query("select b.id, b.id_jabatan, a.nama_jabatan, b.uang_harian from tbl_ref_jabatan a join tbl_setting_representasi b
on a.id=b.id_jabatan");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_jabatan() {
        $query = $this->db->query("select * from tbl_ref_jabatan");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function count_dataUangHarianWhereTujuan($id_tujuan) {
        $query = $this->db->query("select count(id_ref_tujuan) as cek from tbl_setting_uang_harian where id_ref_tujuan='$id_tujuan'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_setUangHarian() {
        $query = $this->db->query("select * from tbl_setting_uang_harian");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_setUangHarianJoinJabatan() {
        $query = $this->db->query("select a.id_ref_jabatan, a.id_ref_tujuan, b.nama_jabatan, b.tingkat 
from tbl_setting_uang_harian a join tbl_ref_jabatan b on a.id_ref_jabatan=b.id GROUP BY a.id_ref_jabatan");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_setUangHarianWhereJabatan($id_jabatan) {
        $query = $this->db->query("select a.id, a.uang_harian, d.nama_jabatan, d.id as id_ref_jabatan, c.nama as nama_tujuan, c.id as id_ref_tujuan from tbl_setting_uang_harian a 
join (select b.id, b.nama_jabatan from tbl_ref_jabatan b where b.id='$id_jabatan') d on d.id=a.id_ref_jabatan
right join tbl_ref_tujuan c on a.id_ref_tujuan=c.id where 
id_ref_tujuan is null or a.id_ref_jabatan='$id_jabatan'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_setPlafonPesawat() {
        $query = $this->db->query("select * from tbl_set_pesawat");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetKewenanganJoinTtd() {
        $query = $this->db->query("select a.nama, b.id, b.id_ttd, b.jam_persetujuan from tbl_ref_ttd a join tbl_setting_kewenangan b on a.id=b.id_ttd");

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    

    function get_biayaInap() {
        $query = $this->db->query("select a.id, a.biaya, b.nama, c.nama_jabatan  from tbl_set_penginapan a join tbl_ref_provinsi b on
a.id_provinsi=b.id join tbl_ref_jabatan c on c.id=a.id_jabatan
order by c.id");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetKewenanganJoinTtdWhereId($id_kewenangan) {
        $query = $this->db->query("select a.nama, b.id, b.id_ttd from tbl_ref_ttd a join tbl_setting_kewenangan b on a.id=b.id_ttd where b.id='$id_kewenangan'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetKewenanganJoinTtdAll() {
        $query = $this->db->query("select c.id as id_kwnngn_detail, c.id_kewenangan, c.id_ttd, c.urutan, b.id_ttd, a.nama as nama_tujuan, d.nama as nama_disposisi  
            from tbl_ref_ttd a  join tbl_setting_kewenangan b on a.id=b.id_ttd 
            join tbl_setting_kewenangan_detail c on c.id_kewenangan=b.id join tbl_ref_ttd d on d.id=c.id_ttd order by urutan");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetKewenanganDetailTtdWhereIdKewenangan($id_kewenangan) {
        $query = $this->db->query("select a.*, b.nama from tbl_setting_kewenangan_detail a 
join tbl_ref_ttd b on a.id_ttd=b.id='$id_kewenangan'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetKewenanganTtdWhereId($id_kewenangan, $id_nd) {
        $query = $this->db->query("select a.*, b.nama, c.id as id_nota_dinas, 
c.`no`, c.id_ref_kewenangan, c.status_persetujuan, c.catatan_persetujuan, c.tgl_persetujuan,
c.tgl_berangkat, c.tgl_kembali, c.lama, c.catatan_koreksi, c.catatan_persetujuan,
CASE c.id_ref_kewenangan	
WHEN 1 THEN  exe.email 
WHEN 2 THEN  exe.email 
WHEN 3 THEN  sek.email 
WHEN 4 THEN  asis.email
END AS email
from tbl_setting_kewenangan a 
join tbl_ref_ttd b on a.id_ttd=b.id 
join tbl_nota_dinas c on c.id_ref_kewenangan=a.id
left join (select cc.id, cc.id_ttd, ee.email from tbl_ref_executive cc 
join tbl_ref_ttd dd on dd.id=cc.id_ttd
join tbl_setting_executive ee on ee.id_executive=cc.id) exe on exe.id_ttd=b.id
left join (select e.id_ttd, g.email from tbl_ref_sekda e 
join tbl_ref_ttd f on f.id=e.id_ttd 
join tbl_setting_sekda g on g.id_ref_sekda=e.id) sek on sek.id_ttd=b.id
left join (select j.id as id_ttd, k.id, k.email from tbl_ref_asisten i
join tbl_ref_ttd j on j.id=i.id_ttd
join tbl_setting_asisten k on k.asisten=i.id) asis on asis.id=c.id_set_asisten
where a.id='$id_kewenangan' and c.id='$id_nd'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_refProvinsi() {
        $query = $this->db->query("select *from tbl_ref_provinsi");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetKewenangan() {
        $query = $this->db->query("select * from tbl_setting_kewenangan");

        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_refProvinsiJoinPenginapan() {
        $query = $this->db->query("select a.id, a.nama from tbl_ref_provinsi a join tbl_set_penginapan b on a.id=b.id_provinsi group by a.id");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetKewenanganDetailWhereIdKewenangan($id_kewenangan) {
        $query = $this->db->query("select a.nama, b.id_ttd, c.jam_disposisi, c.id, c.id_kewenangan, c.id_ttd, c.urutan, d.nama from tbl_ref_ttd a 
join tbl_setting_kewenangan b on a.id=b.id_ttd
join tbl_setting_kewenangan_detail c on c.id_kewenangan=b.id
join tbl_ref_ttd d on d.id=c.id_ttd
where c.id_kewenangan='$id_kewenangan' order by urutan");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_setbiayaInapWhereProv($id) {
        $query = $this->db->query("select a.id, a.biaya, c.nama_jabatan, c.id id_jabatan  from tbl_set_penginapan a
join tbl_ref_jabatan c on c.id=a.id_jabatan where a.id_provinsi=$id
order by c.id");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetKewenanganDetailWhereId($id) {
        $query = $this->db->query("select a.nama as nama_tujuan, c.jam_disposisi, c.id, c.id_kewenangan, c.id_ttd, c.urutan, d.nama as nama_disposisi from tbl_ref_ttd a 
join tbl_setting_kewenangan b on a.id=b.id_ttd
join tbl_setting_kewenangan_detail c on c.id_kewenangan=b.id
join tbl_ref_ttd d on d.id=c.id_ttd where c.id='$id'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function count_dataKewenanganId($id_kewenangan) {
        $query = $this->db->query("select count(id_kewenangan) as cek from tbl_setting_kewenangan_detail where id_kewenangan='$id_kewenangan'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function get_setAsistenWhereIdSkpdJoinAll($id_kewenangan, $id_nd) {
        $query = $this->db->query("select f.urutan, f.id_kewenangan, a.*,b.kode_skpd, b.id 
as id_set_asisten_detail, c.nip_nik, c.nama, c.jabatan, d.nama as nm_asisten
 from tbl_setting_asisten a join tbl_setting_asisten_skpd b on a.id=b.id_asisten 
 join tbl_pegawai c on a.nip_nik=c.nip_nik
 join tbl_ref_asisten d on d.id=a.asisten join tbl_ref_ttd e on e.id=d.id_ttd 
join tbl_setting_kewenangan_detail f on d.id_ttd=f.id_ttd
join tbl_nota_dinas g on g.id_set_asisten=a.id where f.id_kewenangan='$id_kewenangan' and g.id ='$id_nd' 
group by a.id
");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_setAsistenKewenanganWhereIdSkpdJoinAll($id_skpd, $id_kewenangan) {
        $query = $this->db->query("select  a.*,b.kode_skpd, b.id as id_set_asisten_detail, c.nip_nik, c.nama, c.jabatan, d.nama as nm_asisten  from tbl_setting_asisten a 
join tbl_setting_asisten_skpd b on a.id=b.id_asisten 
join tbl_pegawai c on a.nip_nik=c.nip_nik
join tbl_ref_asisten d on d.id=a.asisten
join tbl_ref_ttd e on e.id=d.id_ttd
join tbl_setting_kewenangan f on d.id_ttd=f.id_ttd 
where kode_skpd='$id_skpd' and f.id='$id_kewenangan'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_sekda() {
        $query = $this->db->query("select b.id, b.nip_nik,a.nama, b.email, a.jabatan from tbl_pegawai a join tbl_setting_sekda b on a.nip_nik=b.nip_nik");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_sekdaWhereLevel($level) {
        $query = $this->db->query("select c.*, b.id as id_sekda, b.nip_nik, a.nama as nm_pgw, b.email, a.jabatan from tbl_pegawai a 
join tbl_setting_sekda b on a.nip_nik=b.nip_nik
join user c on  c.kode=b.id where c.`level_user`='$level'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_executiveWhereLevel($level, $kode) {
        $query = $this->db->query("select c.*, b.nama as jabatan, b.id_ttd, a.id as id_exe, a.nama as nm_pgw, a.id_executive, a.email from tbl_setting_executive a 
join tbl_ref_executive b on a.id_executive=b.id
join user c on  c.kode=b.id where c.`level_user`='$level' and c.kode='$kode'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function get_administratorWhereLevel($level, $kode) {
        $query = $this->db->query("select * from user c where c.`level_user`='$level' and c.kode='$kode'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function    get_stafahliWhereLevel($level, $kode) {
        $query = $this->db->query("select c.*, b.id as id_stafAhli, b.nip_nik, a.nama as nm_pgw, b.email, a.jabatan from tbl_pegawai a 
join tbl_setting_staf_ahli b on a.nip_nik=b.nip_nik
join user c on  c.kode=b.id where c.`level_user`='$level' and kode='$kode'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetExecutiveJoinBank() {
        $query = $this->db->query("select a.*, b.nama_bank, b.kode, c.nama as nama_jabatan  from 
tbl_setting_executive a join tbl_ref_bank b on a.id_bank=b.id
join tbl_ref_executive c on c.id=a.id_executive order by id_executive asc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetExecutiveWhereId($id) {
        $query = $this->db->query("select * from tbl_setting_executive a where a.id='$id'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_setStafAhli() {
        $query = $this->db->query("select a.*, b.jabatan, b.nama, b.nunker from tbl_setting_staf_ahli a 
join tbl_pegawai b on a.nip_nik=b.nip_nik
join tbl_ref_ttd c on a.id_ttd=c.id");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_setStafAhliWhereId($id) {
        $query = $this->db->query("select a.*, b.jabatan, b.nama, b.nunker from tbl_setting_staf_ahli a 
join tbl_pegawai b on a.nip_nik=b.nip_nik
join tbl_ref_ttd c on a.id_ttd=c.id where a.id='$id'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetExecutiveWhereId_exe($id) {
        $query = $this->db->query("select a.id, a.nama, b.nama as jabatan from tbl_setting_executive a 
join tbl_ref_executive b on a.id_executive=b.id
where a.id_executive='$id'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_SetAsistenBidangWhereAsisten($id_asisten) {
        $query = $this->db->query("select b.kode_skpd,b.nama_urusan from tbl_setting_asisten_skpd b 
            where b.id_asisten='$id_asisten'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function sum_realisasiAnggaranSkpd($kode_skpd) {
        $query = $this->db->query("select sum(kouta_anggaran_dalam) as jml_dalam, sum(kouta_anggaran_luar) as jml_luar from tbl_setting_skpd where kode_skpd='$kode_skpd'");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
}
