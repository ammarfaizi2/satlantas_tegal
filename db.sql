-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `admin` (
  `userid` varchar(20) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `admin` (`userid`, `username`, `password`) VALUES
('1', 'polrestegal',  'polrestegal'),
('2', 'admin',  'polrestegal');

CREATE TABLE `admin_session` (
  `userid` varchar(20) NOT NULL,
  `session` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `admin_session` (`userid`, `session`, `created_at`, `expired_at`) VALUES
('2', 'Ik_xCHv_sRn-XWHehJxLjN_i--xgMLmxugcvFm-IroEl-d_rcKRfv-NJEFBuna-_', '2017-08-17 01:07:05',  '2017-08-17 01:07:05'),
('2', 'ILcQshHAIdwXmFATwqxMUH_aROp_HSQJOBAGQJ_Pl_rPAlKlcljAFWJ_a-cw-NZR', '2017-08-17 01:06:20',  '2017-08-17 01:06:20'),
('2', 'TqXiZYwfhgWuXnGAyv-bElBHyApbRvDgEpuxU_zzXHvJKGD_hLAoUrmZoCQK_dq_', '2017-08-17 01:02:08',  '2017-08-17 01:02:08'),
('2', 'MMzrAUGkvWz__bSLaKbOPWtcD_w__qmxBzo-Afy_uzwYW_YJrll_hZymW-MTZ_e_', '2017-08-17 05:42:31',  '2017-08-17 05:42:31'),
('2', 'NBByfJoskz-aZ_OT_-s-cot-dg__CqRsiCtJKwEOsMRiRKpBQ-akq-nOkmqPcsTW', '2017-08-17 17:00:05',  '2017-08-17 17:00:05');

CREATE TABLE `data_bbn2` (
  `nopol` varchar(25) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kendaraan` varchar(225) NOT NULL,
  `no_rangka` varchar(225) NOT NULL,
  `status` enum('sedang proses','sudah selesai') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `jadwal_samsat_keliling` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `lokasi` varchar(225) NOT NULL,
  `pukul_awal` varchar(20) NOT NULL,
  `pukul_akhir` varchar(20) NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `jadwal_samsat_keliling` (`id_jadwal`, `tanggal`, `lokasi`, `pukul_awal`, `pukul_akhir`) VALUES
(5, '2017-08-17', 'sukowati', '03:09',  '13:15'),
(6, '2017-08-26', 'gajahmada',  '16:04',  '11:12'),
(7, '2017-08-20', 'paringan', '06:09',  '10:14'),
(8, '2017-08-28', 'karangpandan', '11:11',  '06:18');

CREATE TABLE `jadwal_sim_keliling` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `lokasi` varchar(225) NOT NULL,
  `pukul_awal` varchar(10) NOT NULL,
  `pukul_akhir` varchar(10) NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `jadwal_sim_keliling` (`id_jadwal`, `tanggal`, `lokasi`, `pukul_awal`, `pukul_akhir`) VALUES
(33,  '2017-08-20', 'perempatan soto girin',  '05:05',  '08:06'),
(34,  '2017-08-28', 'toko samura',  '08:14',  '10:05'),
(35,  '2017-08-23', 'depan stasiun',  '11:19',  '10:12');

CREATE TABLE `tilang` (
  `nomor_register_tilang` varchar(225) NOT NULL,
  `tanggal_perkara` date NOT NULL,
  `form` varchar(20) NOT NULL,
  `nomor_pembayaran` varchar(64) NOT NULL,
  `nrp_petugas` varchar(64) NOT NULL,
  `nama_petugas` varchar(225) NOT NULL,
  `nama` varchar(225) NOT NULL,
  `alamat` text,
  `pasal` text,
  `barang_bukti` varchar(225) DEFAULT NULL,
  `jenis_kendaraan` varchar(225) DEFAULT NULL,
  `nomor_polisi` varchar(25) DEFAULT NULL,
  `uang_titipan` bigint(20) DEFAULT NULL,
  `kode_satker_pn` varchar(20) DEFAULT NULL,
  `nomor_perkara` varchar(225) DEFAULT NULL,
  `nama_hakim` varchar(225) DEFAULT NULL,
  `nama_panitera` varchar(225) DEFAULT NULL,
  `kode_satker_kejaksaan` varchar(15) DEFAULT NULL,
  `tanggal_sidang` date DEFAULT NULL,
  `hadir_atau_verstek` varchar(225) DEFAULT NULL,
  `denda` bigint(20) DEFAULT NULL,
  `ongkos_perkara` bigint(20) DEFAULT NULL,
  `subsidair` varchar(225) DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `sisa_titipan` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-08-17 10:30:28
