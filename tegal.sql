-- phpMyAdmin SQL Dump
-- version 4.1.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 16, 2017 at 03:29 PM
-- Server version: 5.1.67-andiunpam
-- PHP Version: 5.6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tegal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `userid` varchar(20) NOT NULL,
  `username` varchar(225) NOT NULL,
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`userid`, `username`, `password`) VALUES
('1', 'polrestegal', 'polrestegal');

-- --------------------------------------------------------

--
-- Table structure for table `admin_session`
--

CREATE TABLE IF NOT EXISTS `admin_session` (
  `userid` varchar(20) NOT NULL,
  `session` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_session`
--

INSERT INTO `admin_session` (`userid`, `session`, `created_at`, `expired_at`) VALUES
('1', 'HgfJj_eBOMIrCewlRUAMvIXUQFYEGGJb_-if_atRrSIMFOsspVtYbMuBUDxgxtSk', '2017-08-16 15:06:58', '2017-08-16 15:06:58'),
('1', '-mnzaRBey_tEgGDyKudsg_GASVcMsLNpskRcXcbMjEvYaeA_pBibZVwnDblBpawx', '2017-08-16 15:12:23', '2017-08-16 15:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `data_bbn2`
--

CREATE TABLE IF NOT EXISTS `data_bbn2` (
  `nopol` varchar(25) NOT NULL,
  `nama` varchar(500) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kendaraan` varchar(225) NOT NULL,
  `no_rangka` varchar(225) NOT NULL,
  `status` enum('sedang proses','sudah selesai') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_sim_keliling`
--

CREATE TABLE IF NOT EXISTS `jadwal_sim_keliling` (
  `tanggal` date NOT NULL,
  `lokasi` varchar(225) NOT NULL,
  `pukul_awal` time NOT NULL,
  `pukul_akhir` time NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;