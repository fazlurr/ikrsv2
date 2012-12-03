-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 03, 2012 at 04:38 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ikrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE IF NOT EXISTS `dosen` (
  `nidn` varchar(10) CHARACTER SET utf8 NOT NULL,
  `nama` varchar(40) NOT NULL,
  PRIMARY KEY (`nidn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama`) VALUES
('030103', 'Bu Listiawati'),
('dosen1', 'Bapak Dosen'),
('dosen2', 'Bu Dosen'),
('dosen3', 'Dosen A'),
('dosen4', 'Dosen 4'),
('dosen5', 'Dosen 5'),
('dosen6', 'Dosen 6'),
('dosen7', 'Dosen 7'),
('dosen8', 'Dosen 8');

-- --------------------------------------------------------

--
-- Table structure for table `krs`
--

CREATE TABLE IF NOT EXISTS `krs` (
  `nomor` int(10) NOT NULL AUTO_INCREMENT,
  `nrp` varchar(9) CHARACTER SET utf8 NOT NULL,
  `kode_matkul` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `nilai` varchar(2) NOT NULL DEFAULT '-',
  `status` varchar(1) NOT NULL DEFAULT 'N',
  `nilai_uts` int(2) NOT NULL,
  `nilai_uas` int(2) NOT NULL,
  `tugas` int(2) NOT NULL,
  `absensi` int(2) NOT NULL,
  PRIMARY KEY (`nomor`),
  KEY `nrp` (`nrp`),
  KEY `kode_matkul` (`kode_matkul`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`nomor`, `nrp`, `kode_matkul`, `semester`, `tahun`, `nilai`, `status`, `nilai_uts`, `nilai_uas`, `tugas`, `absensi`) VALUES
(10, 'test', 'DK1023', 'Ganjil', '2012/2013', '-', 'Y', 0, 0, 0, 0),
(12, 'test', 'DU2012', 'Ganjil', '2012/2013', '-', 'Y', 0, 0, 0, 0),
(13, 'test', 'IF1053', 'Ganjil', '2012/2013', '-', 'Y', 0, 0, 0, 0),
(14, 'test', 'IF1062', 'Ganjil', '2012/2013', '-', 'Y', 0, 0, 0, 0),
(15, 'test', 'IF1083', 'Ganjil', '2012/2013', '-', 'Y', 0, 0, 0, 0),
(16, 'test', 'IF1094', 'Ganjil', '2012/2013', 'B', 'Y', 40, 80, 90, 100),
(17, 'test', 'IF2053', 'Ganjil', '2012/2013', '-', 'Y', 0, 0, 0, 0),
(18, 'test', 'DU1014', 'Ganjil', '2012/2013', '-', 'Y', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE IF NOT EXISTS `matakuliah` (
  `kode_matkul` varchar(10) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL,
  `sks` int(2) NOT NULL,
  `dosen` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`kode_matkul`),
  KEY `dosen` (`dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kode_matkul`, `nama_matkul`, `sks`, `dosen`) VALUES
('DK1023', 'KALKULUS I', 3, 'dosen7'),
('DU1013', 'AGAMA ISLAM', 2, 'dosen3'),
('DU1014', 'AGAMA KRISTEN', 3, 'dosen6'),
('DU2012', 'BAHASA INGGRIS', 2, 'dosen5'),
('IF1053', 'STATISTIKA PROBABILITAS', 3, 'dosen4'),
('IF1062', 'PENGANTAR TEKNOLOGI INFORMASI + P', 2, 'dosen3'),
('IF1083', 'ARSITEKTUR & ORG. KOMPUTER', 3, 'dosen8'),
('IF1094', 'KONSEP PEMROGRAMAN +P', 4, 'dosen1'),
('IF2053', 'RPL', 3, 'dosen4');

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE IF NOT EXISTS `mhs` (
  `nrp` varchar(9) CHARACTER SET utf8 NOT NULL,
  `nama` varchar(40) NOT NULL,
  `penasihat` varchar(10) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`nrp`),
  KEY `penasihat` (`penasihat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`nrp`, `nama`, `penasihat`) VALUES
('115100001', 'Asep', 'dosen1'),
('115100002', 'Angkasa Purnama', 'dosen2'),
('115100003', 'Doddy Agung Faiskara', 'dosen1'),
('115100004', 'M Agus Ferdiyyanto', 'dosen2'),
('115100005', 'Hezron Core Doke', '030103'),
('115100006', 'Niko Aswidiyoko', 'dosen2'),
('115100007', 'Mhs 7', 'dosen1'),
('test', 'Seorang Mahasiswa', 'dosen1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(10) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `type`) VALUES
('030103', '03dd4300a9e48b4413396333dd82066d', 'dosen'),
('115100001', '96e29ba9e455ca78c15d1198daf1fc68', 'mhs'),
('115100002', '96e29ba9e455ca78c15d1198daf1fc68', 'mhs'),
('115100003', 'f5d9cc3b554df735f4d774d7f03727ec', 'mhs'),
('115100004', 'd495170dd5bf8b0756b4b0c1e0a95700', 'mhs'),
('115100005', '7b7a000e2bff2262fe604eeee82e05f9', 'mhs'),
('115100006', '41b554b9fcaa929e3356adb73b11fa0d', 'mhs'),
('115100007', '951aa299430d358df9944b90e1d5cdaa', 'mhs'),
('admin1', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
('dosen1', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen'),
('dosen2', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen'),
('dosen3', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen'),
('dosen4', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen'),
('dosen5', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen'),
('dosen6', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen'),
('dosen7', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen'),
('dosen8', 'ce28eed1511f631af6b2a7bb0a85d636', 'dosen'),
('test', 'c4ca4238a0b923820dcc509a6f75849b', 'mhs');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`nidn`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `krs`
--
ALTER TABLE `krs`
  ADD CONSTRAINT `krs_ibfk_3` FOREIGN KEY (`nrp`) REFERENCES `mhs` (`nrp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `krs_ibfk_4` FOREIGN KEY (`kode_matkul`) REFERENCES `matakuliah` (`kode_matkul`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD CONSTRAINT `matakuliah_ibfk_1` FOREIGN KEY (`dosen`) REFERENCES `dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mhs`
--
ALTER TABLE `mhs`
  ADD CONSTRAINT `mhs_ibfk_1` FOREIGN KEY (`nrp`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mhs_ibfk_2` FOREIGN KEY (`penasihat`) REFERENCES `dosen` (`nidn`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
