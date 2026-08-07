-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Nov 2019 pada 13.38
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saqoe`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `username` varchar(50) NOT NULL,
  `namaEvent` varchar(25) DEFAULT NULL,
  `budget` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `event`
--

INSERT INTO `event` (`username`, `namaEvent`, `budget`) VALUES
('test', '1', 0),
('tubes', 'jalan', 111),
('qw', '12', 0),
('qw', 'qwe', 0),
('qw', 'qweqwe', 0),
('faisalridwan', 'qw', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `eventhistori`
--

CREATE TABLE `eventhistori` (
  `username` varchar(50) DEFAULT NULL,
  `kategoriEvent` varchar(25) NOT NULL,
  `namaEvent` varchar(25) NOT NULL,
  `namaPemaPengEvent` varchar(25) NOT NULL,
  `kategoriPengeluaranE` varchar(25) NOT NULL,
  `tanggal` varchar(15) DEFAULT NULL,
  `jam` varchar(15) DEFAULT NULL,
  `pemasukanEvent` int(11) DEFAULT NULL,
  `pengeluaranEvent` int(11) DEFAULT NULL,
  `sisaBudget` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `eventhistori`
--

INSERT INTO `eventhistori` (`username`, `kategoriEvent`, `namaEvent`, `namaPemaPengEvent`, `kategoriPengeluaranE`, `tanggal`, `jam`, `pemasukanEvent`, `pengeluaranEvent`, `sisaBudget`) VALUES
('tubes ', 'Pemasukan', 'null', 'qwq', '-', '21-08-2018', '10:13:56', 123, 0, 123),
('tubes ', 'Pemasukan', 'jalan', 'qwe', '-', '21-08-2018', '10:17:19', 123, 0, 123),
('tubes ', 'Pengeluaran', 'jalan', 'qweq', 'Makanan & Minuman', '07-12-2018', '10:17:24', 0, 12, 111);

-- --------------------------------------------------------

--
-- Struktur dari tabel `eventpemasukan`
--

CREATE TABLE `eventpemasukan` (
  `username` varchar(50) DEFAULT NULL,
  `namaEvent` varchar(25) DEFAULT NULL,
  `namaPemasukanEvent` varchar(25) DEFAULT NULL,
  `budget` int(11) DEFAULT NULL,
  `tanggalPemasukan` varchar(25) DEFAULT NULL,
  `jamPemasukan` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `eventpemasukan`
--

INSERT INTO `eventpemasukan` (`username`, `namaEvent`, `namaPemasukanEvent`, `budget`, `tanggalPemasukan`, `jamPemasukan`) VALUES
('tubes', 'null ', 'qwq ', 123, '21-08-2018', '10:13:56'),
('tubes', 'jalan ', 'qwe ', 123, '21-08-2018', '10:17:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `eventpengeluaran`
--

CREATE TABLE `eventpengeluaran` (
  `username` varchar(50) DEFAULT NULL,
  `namaEvent` varchar(25) NOT NULL,
  `namaPengeluaranEvent` varchar(25) DEFAULT NULL,
  `besarPengeluaran` int(11) NOT NULL,
  `kategoriPengeluaranEvent` varchar(20) DEFAULT NULL,
  `tglPengeluaranEvent` varchar(15) DEFAULT NULL,
  `jamPengeluaran` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `eventpengeluaran`
--

INSERT INTO `eventpengeluaran` (`username`, `namaEvent`, `namaPengeluaranEvent`, `besarPengeluaran`, `kategoriPengeluaranEvent`, `tglPengeluaranEvent`, `jamPengeluaran`) VALUES
('tubes', 'jalan', 'qweq', 12, 'Makanan & Minuman', '07-12-2018', '10:17:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `harianhistori`
--

CREATE TABLE `harianhistori` (
  `username` varchar(50) DEFAULT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `tanggal` varchar(15) DEFAULT NULL,
  `jam` varchar(15) DEFAULT NULL,
  `kategoriHarian` varchar(25) DEFAULT NULL,
  `kategoriPengeluaranH` varchar(25) DEFAULT NULL,
  `pemasukan` int(11) DEFAULT NULL,
  `pengeluaran` int(11) DEFAULT NULL,
  `sisaSaldo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `harianhistori`
--

INSERT INTO `harianhistori` (`username`, `nama`, `tanggal`, `jam`, `kategoriHarian`, `kategoriPengeluaranH`, `pemasukan`, `pengeluaran`, `sisaSaldo`) VALUES
('tubes ', 'uang jajan', '07-12-2018', '10:10:56', 'Pemasukan', '-', 2000000, 0, 2000000),
('tubes ', 'beli nasi uduk', '07-12-2018', '10:11:09', 'Pengeluaran', 'Makanan & Minuman', 0, 10000, 1990000),
('tubes ', 'dikasih orang', '07-12-2018', '10:11:24', 'Pemasukan', '-', 10000, 0, 2000000),
('tubes ', 'beli sepeda', '07-12-2018', '10:11:35', 'Pengeluaran', 'Hiburan', 0, 200000, 1800000),
('qw ', 'qwe', '07-12-2018', '10:23:19', 'Pemasukan', '-', 12, 0, 12),
('qw ', 'qw', '07-12-2018', '10:23:24', 'Pengeluaran', 'Makanan & Minuman', 0, 12, 0),
('qw ', 'qw', '07-12-2018', '10:23:49', 'Pemasukan', '-', 12, 0, 12),
('qw ', '21', '07-12-2018', '10:23:54', 'Pengeluaran', 'Makanan & Minuman', 0, 1, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `harianpemasukan`
--

CREATE TABLE `harianpemasukan` (
  `username` varchar(50) DEFAULT NULL,
  `namaPemasukan` varchar(25) DEFAULT NULL,
  `besarPemasukan` int(11) DEFAULT NULL,
  `tanggalPemasukan` varchar(15) DEFAULT NULL,
  `jamPemasukan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `harianpemasukan`
--

INSERT INTO `harianpemasukan` (`username`, `namaPemasukan`, `besarPemasukan`, `tanggalPemasukan`, `jamPemasukan`) VALUES
('tubes', 'uang jajan ', 2000000, '07-12-2018', '10:10:56'),
('tubes', 'dikasih orang ', 10000, '07-12-2018', '10:11:24'),
('qw', 'qwe ', 12, '07-12-2018', '10:23:19'),
('qw', 'qw ', 12, '07-12-2018', '10:23:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `harianpengeluaran`
--

CREATE TABLE `harianpengeluaran` (
  `username` varchar(50) DEFAULT NULL,
  `namaPengeluaran` varchar(25) DEFAULT NULL,
  `besarPengeluaran` int(11) DEFAULT NULL,
  `tanggalPengeluaran` varchar(15) DEFAULT NULL,
  `jamPengeluaran` varchar(15) NOT NULL,
  `kategoriPengeluaranH` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `harianpengeluaran`
--

INSERT INTO `harianpengeluaran` (`username`, `namaPengeluaran`, `besarPengeluaran`, `tanggalPengeluaran`, `jamPengeluaran`, `kategoriPengeluaranH`) VALUES
('tubes', 'beli nasi uduk', 1990000, '07-12-2018', '10:11:09', 'Makanan & Minuman'),
('tubes', 'beli sepeda', 1800000, '07-12-2018', '10:11:35', 'Hiburan'),
('qw', 'qw', 0, '07-12-2018', '10:23:24', 'Makanan & Minuman'),
('qw', '21', 11, '07-12-2018', '10:23:54', 'Makanan & Minuman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `saldo` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `datecreated` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `name`, `phoneNumber`, `address`, `saldo`, `email`, `image`, `datecreated`) VALUES
('', '', 'Faisal Ridwan', '', '', NULL, '', '', ''),
('faisalridwan', '1234', 'Faisal Ridwan Siregar', '082275007855', 'Jl. Bukit Kotapinang', 800001, '', '', ''),
('faisalridwansiregar', '12345', 'Faisal Ridwan', '12121221', 'assal', 100000, 'faisalridwann@gmail.com', 'surf-chill_39168-13.jpg', '1572742356'),
('faisalridwansiregarr', '12345', 'Faisal Ridwan Siregar', '12121221', 'assa', 100000, 'faisalridwansiregar@gmail.com', 'default.jpg', '1572867014'),
('qw', 'qw', 'qw', 'ew', 'qwe', 11, '', '', ''),
('test', '123', 'test', '08123456789', 'jl.test', 1000000, '', '', ''),
('tubes', '12', 'tugas kecil', '082275007855', 'jl. tubes', 1800000, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD KEY `event_FK` (`username`);

--
-- Indeks untuk tabel `eventhistori`
--
ALTER TABLE `eventhistori`
  ADD KEY `historievent_FK` (`username`);

--
-- Indeks untuk tabel `eventpemasukan`
--
ALTER TABLE `eventpemasukan`
  ADD KEY `pemasukanevent_FK` (`username`);

--
-- Indeks untuk tabel `eventpengeluaran`
--
ALTER TABLE `eventpengeluaran`
  ADD KEY `pengeluaranevent_FK` (`username`);

--
-- Indeks untuk tabel `harianhistori`
--
ALTER TABLE `harianhistori`
  ADD KEY `historiharian_FK` (`username`);

--
-- Indeks untuk tabel `harianpemasukan`
--
ALTER TABLE `harianpemasukan`
  ADD KEY `pemasukanharian_FK` (`username`);

--
-- Indeks untuk tabel `harianpengeluaran`
--
ALTER TABLE `harianpengeluaran`
  ADD KEY `pengeluaranharian_FK` (`username`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`);

--
-- Ketidakleluasaan untuk tabel `eventhistori`
--
ALTER TABLE `eventhistori`
  ADD CONSTRAINT `historievent_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`);

--
-- Ketidakleluasaan untuk tabel `eventpemasukan`
--
ALTER TABLE `eventpemasukan`
  ADD CONSTRAINT `pemasukanevent_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`);

--
-- Ketidakleluasaan untuk tabel `eventpengeluaran`
--
ALTER TABLE `eventpengeluaran`
  ADD CONSTRAINT `pengeluaranevent_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`);

--
-- Ketidakleluasaan untuk tabel `harianhistori`
--
ALTER TABLE `harianhistori`
  ADD CONSTRAINT `historiharian_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`);

--
-- Ketidakleluasaan untuk tabel `harianpemasukan`
--
ALTER TABLE `harianpemasukan`
  ADD CONSTRAINT `pemasukanharian_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`);

--
-- Ketidakleluasaan untuk tabel `harianpengeluaran`
--
ALTER TABLE `harianpengeluaran`
  ADD CONSTRAINT `pengeluaranharian_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
