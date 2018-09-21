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
class Data_notadinas extends CI_Model {

    //put your code here

    function intervalTtd($id_nd) {
        $query = $this->db->query("select a.id, a.`no`, a.posting, a.tgl_posting, date_add(a.tgl_posting, interval 2 MINUTE) as jatuh_tempo from tbl_nota_dinas a where a.id='$id_nd'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_notadinasWhereIdTujuan($id_skpd, $id_tujuan) {
        $query = $this->db->query("select a.*, c.nama from tbl_nota_dinas a 
join tbl_setting_kewenangan b on b.id=a.id_ref_kewenangan
join tbl_ref_ttd c on b.id_ttd=c.id where a.id_skpd='$id_skpd' and a.id_ref_tujuan='$id_tujuan' order by tgl_nota_dinas desc, id desc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    
    function countNdWhereSkpd($id_skpd){
        $query = $this->db->query("select count(a.id) as jml_nd from tbl_nota_dinas a 
left join tbl_surat_tugas b on a.id=b.id_nota_dinas
where a.status_persetujuan=1 and a.id_skpd='$id_skpd' and isnull(b.id)");
        if ($query) {
            return $query->row()->jml_nd;
        } else {
            return false;
        }
    }
    
    function countNdDisetujui(){
        $query = $this->db->query("select count(a.id) as jml_nd from tbl_nota_dinas a 
left join tbl_surat_tugas b on a.id=b.id_nota_dinas
where a.status_persetujuan=1 and isnull(b.id)");
        if ($query) {
            return $query->row()->jml_nd;
        } else {
            return false;
        }
    }
    function countNdSdhJdSpt(){
        $query = $this->db->query("select count(a.id) as jml_nd from tbl_nota_dinas a 
join tbl_surat_tugas b on a.id=b.id_nota_dinas
where a.status_persetujuan=1");
        if ($query) {
            return $query->row()->jml_nd;
        } else {
            return false;
        }
    }

    function countNotaDinasAndDetailWhereSkpd($persetujuan, $id_skpd) {
        $query = $this->db->query("select count(distinct(a.id)) as jml_nota_dinas, count(b.id) as jml_detail_nd, a.id_skpd from tbl_nota_dinas a join
tbl_nota_dinas_detail b on a.id=b.id_nota_dinas
where a.id_skpd='$id_skpd' and a.status_persetujuan=$persetujuan");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    function countNotaDinasDet($persetujuan) {
        $query = $this->db->query("select count(distinct(a.id)) as jml_nota_dinas, count(b.id) as jml_detail_nd from tbl_nota_dinas a join
tbl_nota_dinas_detail b on a.id=b.id_nota_dinas
where a.status_persetujuan=$persetujuan");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    
    function countNotaDinasAndDetail($persetujuan) {
        $query = $this->db->query("select count(a.id) as jml_nota_dinas, det.jml_detail_nd  from tbl_nota_dinas a
join (select count(id) as jml_detail_nd, id_nota_dinas from tbl_nota_dinas_detail) det on det.id_nota_dinas=a.id
where status_persetujuan ='$persetujuan'");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }

    function get_notadinasJoinAll($id_skpd) {
        $query = $this->db->query("select a.*, c.nama, d.nama as nama_tujuan from tbl_nota_dinas a 
join tbl_setting_kewenangan b on b.id=a.id_ref_kewenangan 
join tbl_ref_ttd c on b.id_ttd=c.id
join tbl_ref_tujuan d on a.id_ref_tujuan=d.id
where a.id_skpd='$id_skpd' order by tgl_nota_dinas desc, id desc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function get_notaDinasAll() {
        $query = $this->db->query("select a.*, a.no, a.id_ref_kewenangan, d.id_nota_dinas, d.id as id_dis, e.asisten as kd_user,
max(case when c.id_ttd=5 then d.tgl_time_disposisi else 0 end) tgl_asisten,
max(case when c.id_ttd=3 then d.tgl_time_disposisi else 0 end) tgl_sekda,
sum(case when c.id_ttd=5 then c.id else 0 end) id_kew_as,
sum(case when c.id_ttd=3 then c.id else 0 end) id_kew_sek,
sum(case when c.id_ttd=5 then c.jam_disposisi else 0 end) jam_as,
sum(case when c.id_ttd=3 then c.jam_disposisi else 0 end) jam_sek,
b.jam_persetujuan
 from tbl_nota_dinas a
join tbl_setting_kewenangan b on a.id_ref_kewenangan=b.id 
left join tbl_setting_kewenangan_detail c on b.id=c.id_kewenangan and a.id_ref_kewenangan=c.id_kewenangan
left join tbl_disposisi d on d.id_kewenangan_detail=c.id and d.id_nota_dinas=a.id
left join tbl_setting_asisten e on e.id=a.id_set_asisten where a.ttd_kepala=1 and a.tgl_nota_dinas>='2018-02-09'
group by a.id");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_notaDinasWhereId($id) {
        $query = $this->db->query("select a.*, c.nama, d.nama as nama_tujuan, e.email as email_skpd from tbl_nota_dinas a 
join tbl_setting_kewenangan b on b.id=a.id_ref_kewenangan  join tbl_ref_ttd c on b.id_ttd=c.id 
join tbl_ref_tujuan d on a.id_ref_tujuan=d.id 
left join tbl_setting_skpd e on a.id_skpd= e.kode_skpd
where a.id='$id'");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_notaDinasId($kode) {
        $query = $this->db->query("select id from tbl_nota_dinas where kode='$kode'");
        if ($query) {
            return $query->row()->id;
        } else {
            return false;
        }
    }

    function get_notaDinasDetailWhereIdNd($id_nt_dns) {
        $query = $this->db->query("select a.*, b.status_pegawai,b.nunker, b.id_jabatan from tbl_nota_dinas_detail a 
join tbl_pegawai b on a.nip_nik=b.nip_nik where a.id_nota_dinas='$id_nt_dns' group by a.nip_nik 
order by b.id_jabatan asc, status_pegawai desc, pangkat_gol asc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_disposisiWhereIdNd($id_nd) {
        $query = $this->db->query("select a.*, 
b.nama, 
c.`no`, 
c.tgl_nota_dinas, 
c.perihal, 
e.isi, 
f.email,
c.id as id_nota_dinas, 
e.tgl_time_disposisi as tgl_disposisi from tbl_setting_kewenangan_detail a 
join tbl_ref_ttd b on a.id_ttd=b.id 
join tbl_nota_dinas c on a.id_kewenangan=c.id_ref_kewenangan 
left join tbl_disposisi e on a.id=e.id_kewenangan_detail and c.id=e.id_nota_dinas 
left join tbl_ref_sekda g on g.id_ttd=a.id_ttd
left join tbl_setting_sekda f on f.id_ref_sekda=g.id
having id_nota_dinas='$id_nd' order by urutan");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_suratMasukDisposisiSekda() {
        $query = $this->db->query("select a.format_file, a.id, a.no, a.perihal, a.tgl_nota_dinas, a.id_skpd, a.nama_file, a.status_persetujuan,
c.id_kewenangan, c.id id_kew_det, c.urutan, c.id_ttd,
case when b.id_ttd=3 then
'persetujuan'
when c.id_ttd=3 then
'disposisi' end ket, d.id id_disposisi, d.isi, d.tgl_time_disposisi
 from tbl_nota_dinas a
join tbl_setting_kewenangan b on a.id_ref_kewenangan=b.id
join tbl_setting_kewenangan_detail c on c.id_kewenangan=b.id
left join tbl_disposisi d on d.id_nota_dinas=a.id and c.id=d.id_kewenangan_detail
where (b.id_ttd=3 or c.id_ttd=3) and a.status_persetujuan=0 and a.posting=1");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }
    function count_suratMasukKeluarSekda() {
        $query = $this->db->query("select count(a.id) as jml_asisten, keluar.jml_keluar, count(a.id)-keluar.jml_keluar as jml_masuk
from tbl_nota_dinas a
join tbl_setting_kewenangan b on a.id_ref_kewenangan=b.id
join tbl_setting_kewenangan_detail c on c.id_kewenangan=b.id
join tbl_disposisi d on d.id_nota_dinas=a.id and c.id=d.id_kewenangan_detail
join (select count(e.id) as jml_keluar
from tbl_nota_dinas e
join tbl_setting_kewenangan f on e.id_ref_kewenangan=f.id
join tbl_setting_kewenangan_detail g on g.id_kewenangan=f.id
left join tbl_disposisi h on h.id_nota_dinas=e.id and g.id=h.id_kewenangan_detail
join tbl_ref_sekda i on i.id_ttd=f.id_ttd or i.id_ttd=g.id_ttd where (e.status_persetujuan!=0  
or !isnull(h.id_kewenangan_detail)) and e.posting=1
) keluar
where c.urutan=1 and a.posting=1");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    function count_suratMasukExe() {
        $query = $this->db->query("select count(e.id) as jml_surat_masuk
from tbl_nota_dinas e
join tbl_setting_kewenangan f on e.id_ref_kewenangan=f.id
join tbl_setting_kewenangan_detail g on g.id_kewenangan=f.id
join tbl_disposisi h on h.id_nota_dinas=e.id and g.id=h.id_kewenangan_detail
join tbl_ref_sekda i on i.id_ttd=f.id_ttd or i.id_ttd=g.id_ttd where e.id_ref_kewenangan=1 and g.urutan=2 and e.status_persetujuan=0");
        if ($query) {
            return $query->row()->jml_surat_masuk;
        } else {
            return false;
        }
    }
    
    function count_suratKeluarExe() {
        $query = $this->db->query("select count(e.id) as jml_surat_keluar
from tbl_nota_dinas e
join tbl_setting_kewenangan f on e.id_ref_kewenangan=f.id
join tbl_setting_kewenangan_detail g on g.id_kewenangan=f.id
join tbl_disposisi h on h.id_nota_dinas=e.id and g.id=h.id_kewenangan_detail
join tbl_ref_sekda i on i.id_ttd=f.id_ttd or i.id_ttd=g.id_ttd where e.id_ref_kewenangan=1 and g.urutan=2 and e.status_persetujuan!=0");
        if ($query) {
            return $query->row()->jml_surat_keluar;
        } else {
            return false;
        }
    }

    function get_suratKeluarDisposisiSekda() {
        $query = $this->db->query("select a.id, a.no, a.perihal, a.tgl_nota_dinas, a.id_skpd, a.nama_file, a.status_persetujuan,
c.id_kewenangan, c.id id_kew_det, c.urutan, a.catatan_koreksi,
case when b.id_ttd=3 then
'persetujuan'
when c.id_ttd=3 then
'disposisi' end ket, d.id id_disposisi, d.isi, d.tgl_time_disposisi, a.catatan_persetujuan, a.tgl_persetujuan
 from tbl_nota_dinas a
join tbl_setting_kewenangan b on a.id_ref_kewenangan=b.id
join tbl_setting_kewenangan_detail c on c.id_kewenangan=b.id
left join tbl_disposisi d on d.id_nota_dinas=a.id and c.id=d.id_kewenangan_detail
where (b.id_ttd=3 or c.id_ttd=3) and a.posting=1");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_suratMasukIdNd() {
        $query = $this->db->query("select i.id_nota_dinas, a.id_ref_kewenangan
from tbl_nota_dinas a 
join tbl_setting_asisten_skpd b on a.id_skpd=b.kode_skpd
join tbl_setting_asisten c on b.id_asisten=c.id 
join tbl_pegawai d on d.nip_nik=c.nip_nik
join tbl_ref_asisten e on c.asisten=e.id
join tbl_ref_ttd f on e.id_ttd=f.id
left join tbl_setting_kewenangan_detail h on h.id_ttd=e.id_ttd and a.id_ref_kewenangan=h.id_kewenangan
left join tbl_disposisi i on i.id_nota_dinas=a.id and i.id_kewenangan_detail=h.id order by a.id desc, a.tgl_nota_dinas desc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    //begin Arief
    function get_notadinasJoinAllbyStatus($status, $kode_skpd) {
        $query = $this->db->query("select a.*, c.nama, d.nama as nama_tujuan from tbl_nota_dinas a 
join tbl_setting_kewenangan b on b.id=a.id_ref_kewenangan 
join tbl_ref_ttd c on b.id_ttd=c.id
join tbl_ref_tujuan d on a.id_ref_tujuan=d.id
where a.ttd_kepala='$status' and a.id_skpd='$kode_skpd'order by tgl_nota_dinas, id desc");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_totalnotadinasbystatus($kode_skpd) {
        $query = $this->db->query("select sum(if(a.ttd_kepala=0,1,0)) as ndmasuk,
sum(if(a.ttd_kepala=1,1,0)) as ndkeluar,count(a.ttd_kepala) as totnd
from tbl_nota_dinas a where a.id_skpd='$kode_skpd' and a.posting=1
group by a.id_skpd");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_kodeSkpdLevel5($kode) {
        $query = $this->db->query("select b.kode_skpd from user a
left join tbl_setting_kepala_skpd b on a.kode=b.kode_skpd where a.`level_user`=5 and a.kode='$kode'");
        if ($query) {
            return $query->row()->kode_skpd;
        } else {
            return false;
        }
    }

    
    function count_suratMasukStafAhli() {
        $query = $this->db->query("select count(a.id) as jml_sekda, keluar.jml_keluar, count(a.id)-keluar.jml_keluar as jml_masuk
from tbl_nota_dinas a
join tbl_setting_kewenangan b on a.id_ref_kewenangan=b.id
join tbl_setting_kewenangan_detail c on c.id_kewenangan=b.id
join tbl_disposisi d on d.id_nota_dinas=a.id and c.id=d.id_kewenangan_detail
join (select count(e.id) as jml_keluar, g.id_ttd
from tbl_nota_dinas e
join tbl_setting_kewenangan f on e.id_ref_kewenangan=f.id
join tbl_setting_kewenangan_detail g on g.id_kewenangan=f.id
join tbl_disposisi h on h.id_nota_dinas=e.id and g.id=h.id_kewenangan_detail
where g.id_ttd=4) keluar
where c.urutan=2");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    function count_executiveMasukStafAhli() {
        $query = $this->db->query("select count(a.id) as jml_sekda, keluar.jml_keluar, count(a.id)-keluar.jml_keluar as jml_masuk
from tbl_nota_dinas a
join tbl_setting_kewenangan b on a.id_ref_kewenangan=b.id
join tbl_setting_kewenangan_detail c on c.id_kewenangan=b.id
join tbl_disposisi d on d.id_nota_dinas=a.id and c.id=d.id_kewenangan_detail
join (select count(e.id) as jml_keluar, g.id_ttd
from tbl_nota_dinas e
join tbl_setting_kewenangan f on e.id_ref_kewenangan=f.id
join tbl_setting_kewenangan_detail g on g.id_kewenangan=f.id
join tbl_disposisi h on h.id_nota_dinas=e.id and g.id=h.id_kewenangan_detail
where g.id_ttd=4) keluar
where c.urutan=2");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }


    function get_stafAhlittd() {
        $query = $this->db->query("
select a.id as id_nota, c.urutan, c.id_ttd, d.id from tbl_nota_dinas a 
join tbl_setting_kewenangan b on a.id_ref_kewenangan=b.id
join tbl_setting_kewenangan_detail c on b.id=c.id_kewenangan
left join tbl_disposisi d on a.id=d.id_nota_dinas and d.id_kewenangan_detail=c.id
where b.id in (select a.id from tbl_setting_kewenangan a join 
tbl_setting_kewenangan_detail b on a.id=b.id_kewenangan where b.id_ttd=4)
order by a.id, c.urutan");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_suratMasukExe($kode) {
        $query = $this->db->query("select a.format_file, a.id, a.no, a.perihal, a.tgl_nota_dinas, a.id_skpd, a.nama_file, 
a.status_persetujuan, 'Persetujuan' as ket,
a.id_skpd, a.id_ref_kewenangan as id_kewenangan, count(a.id) jum_nota, count(g.id) jum_dis from tbl_nota_dinas a 
join tbl_setting_kewenangan b on a.id_ref_kewenangan=b.id
join tbl_ref_ttd c on c.id=b.id_ttd
join tbl_ref_executive d on d.id_ttd=c.id
join tbl_setting_executive e on e.id_executive=d.id
join tbl_setting_kewenangan_detail f on f.id_kewenangan=b.id
left join tbl_disposisi g on g.id_nota_dinas=a.id and g.id_kewenangan_detail=f.id
where d.id=$kode
group by a.id");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function get_exeTtd($kode) {
        $query = $this->db->query("select a.id as id_nota,count(a.id) jum_nota, count(g.id) jum_dis, c.urutan, c.id_ttd, g.id from tbl_nota_dinas a 
join tbl_setting_kewenangan b on a.id_ref_kewenangan=b.id
join tbl_setting_kewenangan_detail c on b.id=c.id_kewenangan
join tbl_ref_ttd d on d.id=b.id_ttd
join tbl_ref_executive e on e.id_ttd=b.id_ttd
join tbl_setting_executive f on f.id_executive=e.id
left join tbl_disposisi g on a.id=g.id_nota_dinas and g.id_kewenangan_detail=c.id
where e.id=$kode
group by a.id
");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function cek_disposisi($id, $urutan) {
        $query = $this->db->query("select a.id as id_nota, c.urutan, c.id_ttd, g.id id_hasil from tbl_nota_dinas a 
join tbl_setting_kewenangan b on a.id_ref_kewenangan=b.id
join tbl_setting_kewenangan_detail c on b.id=c.id_kewenangan
join tbl_ref_ttd d on d.id=b.id_ttd
left join tbl_disposisi g on a.id=g.id_nota_dinas and g.id_kewenangan_detail=c.id
where a.id=$id and c.urutan=$urutan
order by a.id
");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }

    function cek_setuju($id) {
        $query = $this->db->query("select a.id, count(a.id) jum_isi, count(d.id) jum_dis, count(a.id)-count(d.id) total_disposisi from tbl_nota_dinas a
join tbl_setting_kewenangan b on a.id_ref_kewenangan=b.id
join tbl_setting_kewenangan_detail c on c.id_kewenangan=b.id
left join tbl_disposisi d on d.id_nota_dinas=a.id and d.id_kewenangan_detail=c.id
group by a.id having a.id=$id");
        if ($query) {
            return $query->row();
        } else {
            return false;
        }
    }
    
    function get_biayaPerkiraan($id_nt_dinas){
        $query = $this->db->query("select
case when isnull(b.realisasi_luar)
then c.realisasi_dalam
else b.realisasi_luar end biaya  from tbl_nota_dinas a 
left join tbl_realisasi_luar b on a.no=b.no_nota_dinas
left join tbl_realisasi_dalam c on c.no_nota_dinas=a.no
where a.id=$id_nt_dinas");
        if ($query) {
            return $query->row()->biaya;
        } else {
            return false;
        }
    }
}
