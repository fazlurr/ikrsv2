-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2012 at 05:47 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE IF NOT EXISTS `krs` (
  `nomor` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(40) CHARACTER SET utf8 NOT NULL,
  `kode_matkul` varchar(10) NOT NULL,
  `semester` varchar(15) NOT NULL,
  `tahun` varchar(9) NOT NULL,
  `nilai` varchar(2) DEFAULT NULL,
  `status` varchar(5) NOT NULL,
  PRIMARY KEY (`nomor`),
  KEY `user_id` (`user_id`),
  KEY `kode_matkul` (`kode_matkul`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`nomor`, `user_id`, `kode_matkul`, `semester`, `tahun`, `nilai`, `status`) VALUES
(1, 'test', 'IF1062', 'Ganjil', '2012/2013', NULL, ''),
(2, 'test', 'IF1094', 'Ganjil', '2012/2013', NULL, ''),
(3, 'test', 'DU1013', 'Ganjil', '2012/2013', NULL, ''),
(4, 'test', 'IF1053', 'Ganjil', '2012/2013', NULL, ''),
(5, 'test', 'DU2012', 'Ganjil', '2012/2013', NULL, ''),
(6, 'test', 'DK1023', 'Ganjil', '2012/2013', NULL, ''),
(7, 'test', 'IF1083', 'Ganjil', '2012/2013', NULL, ''),
(8, '11510', 'IF1062', 'Ganjil', '2012/2013', NULL, ''),
(9, '11510', 'IF1094', 'Ganjil', '2012/2013', NULL, ''),
(10, '11510', 'IF1053', 'Ganjil', '2012/2013', NULL, ''),
(11, '11510', 'DU2012', 'Ganjil', '2012/2013', NULL, ''),
(12, '11510', 'DK1023', 'Ganjil', '2012/2013', NULL, ''),
(13, '11510', 'IF1083', 'Ganjil', '2012/2013', NULL, ''),
(14, '11510', 'DU1014', 'Ganjil', '2012/2013', NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE IF NOT EXISTS `matakuliah` (
  `id_matkul` int(3) NOT NULL AUTO_INCREMENT,
  `kode_matkul` varchar(10) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL,
  `sks` int(2) NOT NULL,
  `dosen` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id_matkul`),
  UNIQUE KEY `kode_matkul` (`kode_matkul`),
  KEY `dosen` (`dosen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`id_matkul`, `kode_matkul`, `nama_matkul`, `sks`, `dosen`) VALUES
(1, 'IF1062', 'PENGANTAR TEKNOLOGI INFORMASI + P', 2, 'dosen1'),
(2, 'IF1094', 'KONSEP PEMROGRAMAN + P', 4, 'dosen2'),
(3, 'DU1013', 'AGAMA ISLAM', 3, 'dosen3'),
(4, 'IF1053', 'STATISTIKA PROBABILITAS', 3, 'dosen4'),
(5, 'DU2012', 'BAHASA INGGRIS', 2, 'dosen5'),
(6, 'DK1023', 'KALKULUS I', 3, 'dosen6'),
(7, 'IF1083', 'ARSITEKTUR & ORG. KOMPUTER', 3, 'dosen7'),
(8, 'DU1014', 'AGAMA KRISTEN', 3, 'dosen8');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE IF NOT EXISTS `nilai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(40) CHARACTER SET utf8 NOT NULL,
  `kode_matkul` varchar(10) NOT NULL,
  `nilai` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `kode_matkul` (`kode_matkul`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(40) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `penasihat` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  KEY `penasihat` (`penasihat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `password`, `type`, `penasihat`) VALUES
('11510', 'Fin', '5bcbb819023630661a60ca318639c604', 'user', 'dosen2'),
('admin1', 'Mas Admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', NULL),
('dosen1', 'Pak Dosen', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen', NULL),
('dosen2', 'Bu Dosen', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen', NULL),
('dosen3', 'Bapak A', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen', NULL),
('dosen4', 'Bu B', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen', NULL),
('dosen5', 'A', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen', NULL),
('dosen6', 'B', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen', NULL),
('dosen7', 'C', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen', NULL),
('dosen8', 'D', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen', NULL),
('test', 'Mas Bro', '202cb962ac59075b964b07152d234b70', 'user', 'dosen1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krs_ibfk_5` FOREIGN KEY (`kode_matkul`) REFERENCES `matakuliah` (`kode_matkul`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
