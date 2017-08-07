-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 07 Agu 2017 pada 12.43
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restjurnal`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jurnal`
--

CREATE TABLE `tbl_jurnal` (
  `id` int(5) NOT NULL,
  `id_univ` int(5) NOT NULL,
  `nama_jurnal` varchar(60) NOT NULL,
  `url_jurnal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jurnal`
--

INSERT INTO `tbl_jurnal` (`id`, `id_univ`, `nama_jurnal`, `url_jurnal`) VALUES
(1, 1, 'Jurnal Online Informatika', 'http://join.if.uinsgd.ac.id'),
(5, 11, 'Jurnal Cybermatika', 'http://cybermatika.stei.itb.ac.id'),
(6, 14, 'Jurnal Komputer dan Informatika', 'http://komputa.if.unikom.ac.id'),
(7, 1, 'Jurnal Biodjati', 'http://bio.uinsgd.ac.id/jurnal-biodjati/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_jurnal_root`
--

CREATE TABLE `tbl_jurnal_root` (
  `id` int(5) NOT NULL,
  `nama_jurnal` varchar(60) NOT NULL,
  `url_jurnal` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_jurnal_root`
--

INSERT INTO `tbl_jurnal_root` (`id`, `nama_jurnal`, `url_jurnal`) VALUES
(1, 'eJournal of Sunan Gunung Djati State Islamic University', 'http://journal.uinsgd.ac.id/'),
(2, 'ITB Journal', 'http://journal.itb.ac.id/'),
(3, 'E-Journal UIN Syarif Hidayatullah', 'http://journal.uinjkt.ac.id/'),
(4, 'PORTAL JURNAL UPI', 'http://jurnal.upi.edu/'),
(5, 'MAJALAH ILMIAH UNIKOM', 'http://jurnal.unikom.ac.id/');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_univ`
--

CREATE TABLE `tbl_univ` (
  `id` int(5) NOT NULL,
  `nama_univ` varchar(60) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telp` varchar(13) NOT NULL,
  `jurnal_root` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_univ`
--

INSERT INTO `tbl_univ` (`id`, `nama_univ`, `alamat`, `telp`, `jurnal_root`) VALUES
(1, 'UIN SUNAN GUNUNG DJATI BANDUNG', 'Jl. A.H. Nasution ', ' 0227800525', 1),
(10, 'UIN SYARIF HIDAYATULLAH', 'Jalan Ir. H. Juanda No.95 ', '62217401925', 3),
(11, 'INSTITUT TEKKNOLOGI BANDUNG', ' Jl. Ganesha No.10', '62222500935', 2),
(14, 'UNIVERSITAS KOMPUTER', 'Jl. Dipatiukur', '62222504119', 5),
(15, 'UNIVERSITAS PENDIDIKAN INDONESIA', 'Jl. Setiabudi No. 299', '62222013163', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_jurnal`
--
ALTER TABLE `tbl_jurnal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_univ` (`id_univ`);

--
-- Indexes for table `tbl_jurnal_root`
--
ALTER TABLE `tbl_jurnal_root`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_univ`
--
ALTER TABLE `tbl_univ`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_jurnal`
--
ALTER TABLE `tbl_jurnal`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_jurnal_root`
--
ALTER TABLE `tbl_jurnal_root`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_univ`
--
ALTER TABLE `tbl_univ`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_jurnal`
--
ALTER TABLE `tbl_jurnal`
  ADD CONSTRAINT `fk_univ` FOREIGN KEY (`id_univ`) REFERENCES `tbl_univ` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
