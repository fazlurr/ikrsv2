-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 12, 2012 at 03:50 PM
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
-- Table structure for table `matakuliah`
--

CREATE TABLE IF NOT EXISTS `matakuliah` (
  `id_matkul` int(3) NOT NULL AUTO_INCREMENT,
  `kode_matkul` varchar(10) NOT NULL,
  `nama_matkul` varchar(50) NOT NULL,
  `sks` int(2) NOT NULL,
  `dosen` varchar(25) NOT NULL DEFAULT 'Kosong',
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
(8, 'DU1014', 'AGAMA KRISTEN', 3, 'dosen8'),
(9, 'DK2222', 'DASAR KEWIRAUSAHAAN', 2, 'dosen9'),
(10, 'DU2093', 'PENDIDIKAN PANCASILA & KEWARGANEGARAAN', 3, 'dosen10'),
(11, 'IF2012', 'PENGANTAR INFORMATIKA + P', 2, 'dosen11'),
(12, 'IF2063', 'INT. MANUSIA & KOMPUTER', 3, 'dosen12'),
(13, 'IF2053', 'KECAKAPAN ANTAR PERSONAL', 3, 'dosen13'),
(14, 'DK2073', 'MATEMATIKA DISKRIT I', 3, 'dosen14'),
(15, 'DK2023', 'KALKULUS II', 3, 'dosen15');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
