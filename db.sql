-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `userid` varchar(20) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `admin` (`userid`, `username`, `password`) VALUES
('1',	'polrestegal',	'polrestegal'),
('2',	'admin',	'polrestegal');

DROP TABLE IF EXISTS `admin_session`;
CREATE TABLE `admin_session` (
  `userid` varchar(20) NOT NULL,
  `session` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `data_bbn2`;
CREATE TABLE `data_bbn2` (
  `nopol` varchar(25) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kendaraan` varchar(225) NOT NULL,
  `no_rangka` varchar(225) NOT NULL,
  `status` enum('sedang proses','sudah selesai') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `jadwal_samsat_keliling`;
CREATE TABLE `jadwal_samsat_keliling` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `lokasi` varchar(225) NOT NULL,
  `pukul_awal` varchar(20) NOT NULL,
  `pukul_akhir` varchar(20) NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `jadwal_samsat_keliling` (`id_jadwal`, `tanggal`, `lokasi`, `pukul_awal`, `pukul_akhir`) VALUES
(5,	'2017-08-17',	'sukowati',	'03:09',	'13:15'),
(6,	'2017-08-26',	'gajahmada',	'16:04',	'11:12'),
(7,	'2017-08-20',	'paringan',	'06:09',	'10:14'),
(8,	'2017-08-28',	'karangpandan',	'11:11',	'06:18');

DROP TABLE IF EXISTS `jadwal_sim_keliling`;
CREATE TABLE `jadwal_sim_keliling` (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `lokasi` varchar(225) NOT NULL,
  `pukul_awal` varchar(10) NOT NULL,
  `pukul_akhir` varchar(10) NOT NULL,
  PRIMARY KEY (`id_jadwal`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `jadwal_sim_keliling` (`id_jadwal`, `tanggal`, `lokasi`, `pukul_awal`, `pukul_akhir`) VALUES
(33,	'2017-08-20',	'perempatan soto girin',	'05:05',	'08:06'),
(34,	'2017-08-28',	'toko samura',	'08:14',	'10:05'),
(35,	'2017-08-23',	'depan stasiun',	'11:19',	'10:12');

-- 2017-08-16 17:52:04
