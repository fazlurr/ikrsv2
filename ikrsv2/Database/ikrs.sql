-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 11, 2012 at 08:02 AM
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
  `nidn` varchar(40) CHARACTER SET utf8 NOT NULL,
  `nama` varchar(40) NOT NULL,
  PRIMARY KEY (`nidn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama`) VALUES
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
  `nomor` int(4) NOT NULL AUTO_INCREMENT,
  `nrp` varchar(40) CHARACTER SET utf8 NOT NULL,
  `kode_matkul` varchar(10) NOT NULL,
  `semester` varchar(15) NOT NULL,
  `tahun` varchar(10) NOT NULL,
  `nilai` varchar(2) NOT NULL DEFAULT '-',
  `status` varchar(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`nomor`),
  KEY `nrp` (`nrp`),
  KEY `kode_matkul` (`kode_matkul`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `krs`
--

INSERT INTO `krs` (`nomor`, `nrp`, `kode_matkul`, `semester`, `tahun`, `nilai`, `status`) VALUES
(9, 'test', 'DU103', 'Ganjil', '2012/2013', 'D', 'Y'),
(11, 'test', 'IF1094', 'Ganjil', '2012/2013', 'A', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE IF NOT EXISTS `matakuliah` (
  `kode_matkul` varchar(10) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL,
  `sks` int(2) NOT NULL,
  `dosen` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`kode_matkul`),
  KEY `dosen` (`dosen`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kode_matkul`, `nama_matkul`, `sks`, `dosen`) VALUES
('DK1023', 'KALKULUS I', 3, 'dosen7'),
('DU1014', 'AGAMA KRISTEN', 3, 'dosen6'),
('DU103', 'AGAMA ISLAM', 3, 'dosen2'),
('DU2012', 'BAHASA INGGRIS', 2, 'dosen5'),
('IF1053', 'STATISTIKA PROBABILITAS', 3, 'dosen4'),
('IF1062', 'PENGANTAR TEKNOLOGI INFORMASI + P', 2, 'dosen3'),
('IF1083', 'ARSITEKTUR & ORG. KOMPUTER', 3, 'dosen8'),
('IF1094', 'KONSEP PEMROGRAMAN +P', 4, 'dosen1');

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE IF NOT EXISTS `mhs` (
  `nrp` varchar(40) CHARACTER SET utf8 NOT NULL,
  `nama` varchar(40) NOT NULL,
  `penasihat` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`nrp`),
  KEY `penasihat` (`penasihat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`nrp`, `nama`, `penasihat`) VALUES
('11510', 'Jokowi', 'dosen1'),
('11511', 'Mahasiswi', 'dosen2'),
('11512', '1212', 'dosen1'),
('test', 'Seorang Mahasiswa', 'dosen1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` varchar(40) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `password`, `type`) VALUES
('11510', 'c4ca4238a0b923820dcc509a6f75849b', 'mhs'),
('11511', 'b55796d2dc2cb0c9aff4cf90d42f5887', 'mhs'),
('11512', '646c9941d7fb1bc793a7929328ae3f2f', 'mhs'),
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
