-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for sppd_hst
DROP DATABASE IF EXISTS `sppd_hst`;
CREATE DATABASE IF NOT EXISTS `sppd_hst` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sppd_hst`;

-- Dumping structure for table sppd_hst.aktifitas
DROP TABLE IF EXISTS `aktifitas`;
CREATE TABLE IF NOT EXISTS `aktifitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT '0',
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL,
  `keterangan` varchar(300) DEFAULT '0',
  `nama_komputer` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8739 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.level_user
DROP TABLE IF EXISTS `level_user`;
CREATE TABLE IF NOT EXISTS `level_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `level` int(1) NOT NULL,
  `link` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.log_akses
DROP TABLE IF EXISTS `log_akses`;
CREATE TABLE IF NOT EXISTS `log_akses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `time` time NOT NULL,
  `akses` varchar(50) NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL DEFAULT '0',
  `keterangan` varchar(300) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14378 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.nota_dinas
DROP TABLE IF EXISTS `nota_dinas`;
CREATE TABLE IF NOT EXISTS `nota_dinas` (
  `id` int(11) NOT NULL,
  `no` varchar(50) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `disposisi_1` text NOT NULL,
  `disposisi_2` text NOT NULL,
  `disposisi_3` text NOT NULL,
  `disposisi_4` text NOT NULL,
  `date` date NOT NULL,
  `perihal` varchar(200) NOT NULL DEFAULT '0',
  `to` varchar(200) NOT NULL DEFAULT '0',
  `from` varchar(200) NOT NULL DEFAULT '0',
  `dasar` text NOT NULL,
  `tgl_brngkt` date NOT NULL,
  `tgl_kmbl` date NOT NULL,
  `ttd_pgw` int(11) NOT NULL DEFAULT '0',
  `tujuan` varchar(200) NOT NULL DEFAULT '0',
  `maksud` varchar(200) NOT NULL DEFAULT '0',
  `lama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `no` (`no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.nota_dinas_pgw
DROP TABLE IF EXISTS `nota_dinas_pgw`;
CREATE TABLE IF NOT EXISTS `nota_dinas_pgw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nota_dinas` int(11) DEFAULT NULL,
  `nip` int(17) DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.ref_executive
DROP TABLE IF EXISTS `ref_executive`;
CREATE TABLE IF NOT EXISTS `ref_executive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.ref_katgor
DROP TABLE IF EXISTS `ref_katgor`;
CREATE TABLE IF NOT EXISTS `ref_katgor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_katgor` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.ref_pegawai_nonpns
DROP TABLE IF EXISTS `ref_pegawai_nonpns`;
CREATE TABLE IF NOT EXISTS `ref_pegawai_nonpns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.ref_tujuan
DROP TABLE IF EXISTS `ref_tujuan`;
CREATE TABLE IF NOT EXISTS `ref_tujuan` (
  `id` int(11) NOT NULL,
  `id_katgor` int(11) DEFAULT NULL,
  `nama` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_katgor` (`id_katgor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.setting_skpd
DROP TABLE IF EXISTS `setting_skpd`;
CREATE TABLE IF NOT EXISTS `setting_skpd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_skpd` varchar(50) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `nip_kepala` varchar(50) DEFAULT NULL,
  `alamat` text,
  `email` varchar(30) DEFAULT NULL,
  `kode_pos` varchar(50) DEFAULT NULL,
  `telpon` varchar(50) DEFAULT NULL,
  `inisial` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.status
DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL,
  `nm_status` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_disposisi
DROP TABLE IF EXISTS `tbl_disposisi`;
CREATE TABLE IF NOT EXISTS `tbl_disposisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nota_dinas` int(11) DEFAULT NULL,
  `isi` text,
  `posting` int(11) DEFAULT NULL,
  `kode_user` varchar(50) DEFAULT NULL,
  `tgl_time_disposisi` datetime DEFAULT NULL,
  `id_kewenangan_detail` int(11) DEFAULT NULL,
  `nip_nik` varchar(50) DEFAULT NULL,
  `status_baca` int(11) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=769 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_laporan_pd
DROP TABLE IF EXISTS `tbl_laporan_pd`;
CREATE TABLE IF NOT EXISTS `tbl_laporan_pd` (
  `id` int(11) DEFAULT NULL,
  `id_nota_dinas` int(11) DEFAULT NULL,
  `isi_laporan` varchar(50) DEFAULT NULL,
  `tgl_laporan` date DEFAULT NULL,
  `id_spt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_level_user
DROP TABLE IF EXISTS `tbl_level_user`;
CREATE TABLE IF NOT EXISTS `tbl_level_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_level` varchar(50) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_nota_dinas
DROP TABLE IF EXISTS `tbl_nota_dinas`;
CREATE TABLE IF NOT EXISTS `tbl_nota_dinas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) DEFAULT NULL,
  `tgl_nota_dinas` date DEFAULT NULL,
  `perihal` text,
  `tujuan` text,
  `dari` varchar(200) DEFAULT 'Barabai',
  `id_ref_tujuan` int(11) DEFAULT NULL,
  `id_ref_kewenangan` int(11) DEFAULT NULL,
  `catatan_koreksi` text,
  `dasar` text,
  `tgl_berangkat` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `maksud` text,
  `nama_file` varchar(200) DEFAULT NULL,
  `size_file` varchar(100) DEFAULT NULL,
  `format_file` varchar(100) DEFAULT NULL,
  `lama` varchar(50) DEFAULT NULL,
  `ttd_kepala` int(11) DEFAULT '0',
  `tgl_ttd_kepala` datetime NOT NULL,
  `narasi` text,
  `posting` int(11) DEFAULT '0',
  `tgl_posting` datetime NOT NULL,
  `id_skpd` varchar(50) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `lampiran` varchar(50) NOT NULL,
  `status_persetujuan` int(11) DEFAULT '0',
  `catatan_persetujuan` text,
  `tgl_persetujuan` datetime NOT NULL,
  `id_set_asisten` varchar(50) DEFAULT NULL,
  `alat_angkut` varchar(200) DEFAULT NULL,
  `beban_biaya` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=933 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_nota_dinas_detail
DROP TABLE IF EXISTS `tbl_nota_dinas_detail`;
CREATE TABLE IF NOT EXISTS `tbl_nota_dinas_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nota_dinas` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nip_nik` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `pangkat_gol` varchar(50) DEFAULT NULL,
  `jabatan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2397 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_pegawai
DROP TABLE IF EXISTS `tbl_pegawai`;
CREATE TABLE IF NOT EXISTS `tbl_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip_nik` varchar(50) DEFAULT NULL,
  `status_pegawai` varchar(50) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `no_rekening` varchar(50) DEFAULT NULL,
  `jabatan` text NOT NULL,
  `nunker` varchar(50) NOT NULL,
  `id_bank` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1486 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_pengikut_spd
DROP TABLE IF EXISTS `tbl_pengikut_spd`;
CREATE TABLE IF NOT EXISTS `tbl_pengikut_spd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip_nik` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_realisasi_dalam
DROP TABLE IF EXISTS `tbl_realisasi_dalam`;
CREATE TABLE IF NOT EXISTS `tbl_realisasi_dalam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_nota_dinas` varchar(50) DEFAULT NULL,
  `kode_skpd` varchar(50) DEFAULT NULL,
  `no_spt` varchar(50) DEFAULT NULL,
  `realisasi_dalam` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_realisasi_luar
DROP TABLE IF EXISTS `tbl_realisasi_luar`;
CREATE TABLE IF NOT EXISTS `tbl_realisasi_luar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_skpd` varchar(50) DEFAULT NULL,
  `no_nota_dinas` varchar(50) DEFAULT NULL,
  `no_spt` varchar(50) DEFAULT NULL,
  `realisasi_luar` double DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_alat_angkut
DROP TABLE IF EXISTS `tbl_ref_alat_angkut`;
CREATE TABLE IF NOT EXISTS `tbl_ref_alat_angkut` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alat_angkut` varchar(50) DEFAULT NULL,
  `biaya` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_asisten
DROP TABLE IF EXISTS `tbl_ref_asisten`;
CREATE TABLE IF NOT EXISTS `tbl_ref_asisten` (
  `id` varchar(5) NOT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `id_ttd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_bank
DROP TABLE IF EXISTS `tbl_ref_bank`;
CREATE TABLE IF NOT EXISTS `tbl_ref_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bank` varchar(100) DEFAULT NULL,
  `kode` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_executive
DROP TABLE IF EXISTS `tbl_ref_executive`;
CREATE TABLE IF NOT EXISTS `tbl_ref_executive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `id_ttd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_jabatan
DROP TABLE IF EXISTS `tbl_ref_jabatan`;
CREATE TABLE IF NOT EXISTS `tbl_ref_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(50) DEFAULT NULL,
  `tingkat` enum('A','B','C','D') DEFAULT 'D',
  `representasi` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_kepada
DROP TABLE IF EXISTS `tbl_ref_kepada`;
CREATE TABLE IF NOT EXISTS `tbl_ref_kepada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip_nik` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_ref_jabatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_provinsi
DROP TABLE IF EXISTS `tbl_ref_provinsi`;
CREATE TABLE IF NOT EXISTS `tbl_ref_provinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_rekening
DROP TABLE IF EXISTS `tbl_ref_rekening`;
CREATE TABLE IF NOT EXISTS `tbl_ref_rekening` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_rekening` varchar(50) DEFAULT NULL,
  `jenis_rekening` varchar(50) DEFAULT NULL,
  `no_dpa` varchar(50) DEFAULT NULL,
  `nama_skpd` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_sekda
DROP TABLE IF EXISTS `tbl_ref_sekda`;
CREATE TABLE IF NOT EXISTS `tbl_ref_sekda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `id_ttd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_staf_ahli
DROP TABLE IF EXISTS `tbl_ref_staf_ahli`;
CREATE TABLE IF NOT EXISTS `tbl_ref_staf_ahli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ttd` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_surat
DROP TABLE IF EXISTS `tbl_ref_surat`;
CREATE TABLE IF NOT EXISTS `tbl_ref_surat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tujuan` int(11) NOT NULL DEFAULT '0',
  `nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_ttd
DROP TABLE IF EXISTS `tbl_ref_ttd`;
CREATE TABLE IF NOT EXISTS `tbl_ref_ttd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ref_tujuan
DROP TABLE IF EXISTS `tbl_ref_tujuan`;
CREATE TABLE IF NOT EXISTS `tbl_ref_tujuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `id_ref_rekening` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_asisten
DROP TABLE IF EXISTS `tbl_setting_asisten`;
CREATE TABLE IF NOT EXISTS `tbl_setting_asisten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asisten` varchar(100) DEFAULT NULL,
  `nip_nik` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_asisten_skpd
DROP TABLE IF EXISTS `tbl_setting_asisten_skpd`;
CREATE TABLE IF NOT EXISTS `tbl_setting_asisten_skpd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_skpd` varchar(50) DEFAULT NULL,
  `id_asisten` int(11) DEFAULT NULL,
  `nama_urusan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_executive
DROP TABLE IF EXISTS `tbl_setting_executive`;
CREATE TABLE IF NOT EXISTS `tbl_setting_executive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL DEFAULT '0',
  `id_bank` int(11) NOT NULL DEFAULT '0',
  `no_rekening` varchar(50) NOT NULL DEFAULT '0',
  `id_executive` int(11) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_kepala_skpd
DROP TABLE IF EXISTS `tbl_setting_kepala_skpd`;
CREATE TABLE IF NOT EXISTS `tbl_setting_kepala_skpd` (
  `kode_skpd` varchar(100) NOT NULL,
  `id` varchar(50) NOT NULL,
  `nip` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `id_ttd` int(11) DEFAULT '6',
  `ttd_kepala` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`kode_skpd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_kewenangan
DROP TABLE IF EXISTS `tbl_setting_kewenangan`;
CREATE TABLE IF NOT EXISTS `tbl_setting_kewenangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ttd` int(11) DEFAULT NULL,
  `jam_persetujuan` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_kewenangan_detail
DROP TABLE IF EXISTS `tbl_setting_kewenangan_detail`;
CREATE TABLE IF NOT EXISTS `tbl_setting_kewenangan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kewenangan` int(11) DEFAULT NULL,
  `id_ttd` int(11) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  `jam_disposisi` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_persetujuan
DROP TABLE IF EXISTS `tbl_setting_persetujuan`;
CREATE TABLE IF NOT EXISTS `tbl_setting_persetujuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ref_kepada` int(11) DEFAULT NULL,
  `nip_nik` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_representasi
DROP TABLE IF EXISTS `tbl_setting_representasi`;
CREATE TABLE IF NOT EXISTS `tbl_setting_representasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jabatan` int(11) DEFAULT NULL,
  `uang_harian` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_jabatan` (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_sekda
DROP TABLE IF EXISTS `tbl_setting_sekda`;
CREATE TABLE IF NOT EXISTS `tbl_setting_sekda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip_nik` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(100) NOT NULL DEFAULT '0',
  `id_ref_sekda` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_skpd
DROP TABLE IF EXISTS `tbl_setting_skpd`;
CREATE TABLE IF NOT EXISTS `tbl_setting_skpd` (
  `kode_skpd` varchar(50) NOT NULL,
  `inisial` varchar(50) DEFAULT NULL,
  `alamat` text,
  `no_telpon` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `kode_pos` varchar(10) DEFAULT NULL,
  `kouta_anggaran_dalam` double DEFAULT NULL,
  `kouta_anggaran_luar` double DEFAULT NULL,
  PRIMARY KEY (`kode_skpd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_staf_ahli
DROP TABLE IF EXISTS `tbl_setting_staf_ahli`;
CREATE TABLE IF NOT EXISTS `tbl_setting_staf_ahli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ttd` int(11) DEFAULT NULL,
  `nip_nik` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_surat
DROP TABLE IF EXISTS `tbl_setting_surat`;
CREATE TABLE IF NOT EXISTS `tbl_setting_surat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ref_surat` int(11) DEFAULT NULL,
  `id_ref_jabatan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_surat_detail
DROP TABLE IF EXISTS `tbl_setting_surat_detail`;
CREATE TABLE IF NOT EXISTS `tbl_setting_surat_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ref_jabatan` int(11) DEFAULT NULL,
  `id_ref_asisten` varchar(50) DEFAULT NULL,
  `id_setting_surat` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_tujuan
DROP TABLE IF EXISTS `tbl_setting_tujuan`;
CREATE TABLE IF NOT EXISTS `tbl_setting_tujuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ttd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_tujuan_detail
DROP TABLE IF EXISTS `tbl_setting_tujuan_detail`;
CREATE TABLE IF NOT EXISTS `tbl_setting_tujuan_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tujuan` int(11) DEFAULT NULL,
  `id_ttd` int(11) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_setting_uang_harian
DROP TABLE IF EXISTS `tbl_setting_uang_harian`;
CREATE TABLE IF NOT EXISTS `tbl_setting_uang_harian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ref_jabatan` int(11) DEFAULT NULL,
  `id_ref_tujuan` int(11) DEFAULT NULL,
  `uang_harian` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_set_penginapan
DROP TABLE IF EXISTS `tbl_set_penginapan`;
CREATE TABLE IF NOT EXISTS `tbl_set_penginapan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `biaya` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_set_pesawat
DROP TABLE IF EXISTS `tbl_set_pesawat`;
CREATE TABLE IF NOT EXISTS `tbl_set_pesawat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kota_asal` varchar(50) DEFAULT NULL,
  `kota_tujuan` varchar(50) DEFAULT NULL,
  `bisnis` double DEFAULT NULL,
  `ekonomi` double DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_set_tambahan_transport
DROP TABLE IF EXISTS `tbl_set_tambahan_transport`;
CREATE TABLE IF NOT EXISTS `tbl_set_tambahan_transport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kota` varchar(200) DEFAULT NULL,
  `bisnis` double DEFAULT NULL,
  `ekonomi` double DEFAULT NULL,
  `ket` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_set_transport_dalamprov
DROP TABLE IF EXISTS `tbl_set_transport_dalamprov`;
CREATE TABLE IF NOT EXISTS `tbl_set_transport_dalamprov` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kota_asal` varchar(50) DEFAULT NULL,
  `kota_tujuan` varchar(50) DEFAULT NULL,
  `biaya` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_set_transport_luarprov
DROP TABLE IF EXISTS `tbl_set_transport_luarprov`;
CREATE TABLE IF NOT EXISTS `tbl_set_transport_luarprov` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kota_asal` varchar(50) DEFAULT NULL,
  `kota_tujuan` varchar(50) DEFAULT NULL,
  `biaya` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_spd
DROP TABLE IF EXISTS `tbl_spd`;
CREATE TABLE IF NOT EXISTS `tbl_spd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) DEFAULT NULL,
  `id_detail_nota_dinas` int(11) DEFAULT NULL,
  `tgl_spd` date DEFAULT NULL,
  `id_ttd_spd` int(11) DEFAULT NULL,
  `alat_angkut` varchar(50) DEFAULT NULL,
  `status_ttd_spd` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_spt
DROP TABLE IF EXISTS `tbl_spt`;
CREATE TABLE IF NOT EXISTS `tbl_spt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) DEFAULT NULL,
  `id_nota_dinas` int(11) DEFAULT NULL,
  `id_ttd_spt` int(11) DEFAULT NULL,
  `tgl_spt` date DEFAULT NULL,
  `status_ttd_spt` int(11) DEFAULT NULL,
  `alat_angkut` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_surat_tugas
DROP TABLE IF EXISTS `tbl_surat_tugas`;
CREATE TABLE IF NOT EXISTS `tbl_surat_tugas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_spt` varchar(100) DEFAULT NULL,
  `id_nota_dinas` int(11) DEFAULT NULL,
  `id_ttd_spt` int(11) DEFAULT NULL,
  `tgl_spt` date DEFAULT NULL,
  `alat_angkut` varchar(200) DEFAULT NULL,
  `status_ttd_spt` int(11) DEFAULT '0',
  `date_ttd_spt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=468 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ttd_spd
DROP TABLE IF EXISTS `tbl_ttd_spd`;
CREATE TABLE IF NOT EXISTS `tbl_ttd_spd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nip_nik` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_ttd_spt
DROP TABLE IF EXISTS `tbl_ttd_spt`;
CREATE TABLE IF NOT EXISTS `tbl_ttd_spt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `nip_nik` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.tbl_urusan
DROP TABLE IF EXISTS `tbl_urusan`;
CREATE TABLE IF NOT EXISTS `tbl_urusan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_urusan` varchar(50) DEFAULT NULL,
  `id_asisten` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.temporary_detail
DROP TABLE IF EXISTS `temporary_detail`;
CREATE TABLE IF NOT EXISTS `temporary_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip_nik` varchar(50) NOT NULL,
  `pangkat_gol` varchar(50) NOT NULL,
  `kode` varchar(50) NOT NULL,
  `id_skpd` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3083 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.temporary_file
DROP TABLE IF EXISTS `temporary_file`;
CREATE TABLE IF NOT EXISTS `temporary_file` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `kode` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `content` blob NOT NULL,
  `size` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table sppd_hst.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level_user` int(5) NOT NULL,
  `is_lock` int(11) NOT NULL,
  `id_setting_skpd` int(11) NOT NULL,
  `ol` enum('Y','N') NOT NULL,
  `last_date` date NOT NULL,
  `last_time` time NOT NULL,
  `foto` varchar(50) NOT NULL,
  `log_time` time NOT NULL,
  `log_date` date NOT NULL,
  `kode` varchar(50) DEFAULT '0',
  `keterangan` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=183 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
