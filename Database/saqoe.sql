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
('faisalridwan', 'Liburan Bali', 5000000),
('faisalridwan', 'Beli Laptop', 15000000),
('faisalridwansiregar', 'Renovasi Rumah', 20000000);

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
('faisalridwan', 'Pemasukan', 'Liburan Bali', 'Tabungan Gaji', '-', '01-08-2026', '09:00:00', 1000000, 0, 1000000),
('faisalridwan', 'Pemasukan', 'Liburan Bali', 'Bonus Kantor', '-', '02-08-2026', '10:00:00', 500000, 0, 1500000),
('faisalridwan', 'Pengeluaran', 'Liburan Bali', 'Tiket Pesawat', 'Transportasi', '03-08-2026', '11:00:00', 0, 800000, 700000);

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
('faisalridwan', 'Liburan Bali', 'Tabungan Gaji', 1000000, '01-08-2026', '09:00:00'),
('faisalridwan', 'Liburan Bali', 'Bonus Kantor', 500000, '02-08-2026', '10:00:00');

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
('faisalridwan', 'Liburan Bali', 'Tiket Pesawat', 800000, 'Transportasi', '03-08-2026', '11:00:00');

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
('faisalridwan', 'Gaji Bulanan', '01-08-2026', '08:00:00', 'Pemasukan', '-', 5000000, 0, 5000000),
('faisalridwan', 'Beli Makan Siang', '02-08-2026', '12:30:00', 'Pengeluaran', 'Makanan & Minuman', 0, 50000, 4950000),
('faisalridwan', 'Beli Kopi', '03-08-2026', '15:00:00', 'Pengeluaran', 'Makanan & Minuman', 0, 25000, 4925000),
('faisalridwan', 'Nonton Bioskop', '04-08-2026', '19:00:00', 'Pengeluaran', 'Hiburan', 0, 100000, 4825000),
('faisalridwansiregar', 'Uang Jajan', '01-08-2026', '07:00:00', 'Pemasukan', '-', 1000000, 0, 1000000),
('faisalridwansiregar', 'Beli Pulsa', '02-08-2026', '08:00:00', 'Pengeluaran', 'Tagihan', 0, 100000, 900000);

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
('faisalridwan', 'Gaji Bulanan', 5000000, '01-08-2026', '08:00:00'),
('faisalridwansiregar', 'Uang Jajan', 1000000, '01-08-2026', '07:00:00');

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
('faisalridwan', 'Beli Makan Siang', 50000, '02-08-2026', '12:30:00', 'Makanan & Minuman'),
('faisalridwan', 'Beli Kopi', 25000, '03-08-2026', '15:00:00', 'Makanan & Minuman'),
('faisalridwan', 'Nonton Bioskop', 100000, '04-08-2026', '19:00:00', 'Hiburan'),
('faisalridwansiregar', 'Beli Pulsa', 100000, '02-08-2026', '08:00:00', 'Tagihan');

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
('faisalridwan', '$2y$12$sNtNtmkfVeaSI4Z3dw0HO.JKl5FrbxGgCtBVDvV4RaSq6cT4PvBE2', 'Faisal Ridwan Siregar', '082275007855', 'Jl. Bukit Kotapinang', 800001, 'faisalridwan@gmail.com', 'default.jpg', '1572742356'),
('faisalridwansiregar', '$2y$12$/TqG1l8pDMBURuiooDg8tekQxarlykeeIUJINItOb0be5d2GeUm7y', 'Faisal Ridwan', '08123456789', 'Jl. Assal', 100000, 'faisalridwann@gmail.com', 'default.jpg', '1572867014');

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
