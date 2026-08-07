-- FASE 1: Kategori & Limit Anggaran
CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `tipe` enum('Pemasukan','Pengeluaran') NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`),
  KEY `kategori_FK` (`username`),
  CONSTRAINT `kategori_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `pengguna` ADD COLUMN `limit_bulanan` int DEFAULT 0;

-- FASE 3: Transaksi Berulang & Struk
CREATE TABLE IF NOT EXISTS `transaksi_rutin` (
  `id_rutin` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `nominal` int NOT NULL,
  `jenis` enum('Pemasukan','Pengeluaran') NOT NULL,
  `id_dompet` int DEFAULT NULL,
  `tanggal_eksekusi` int NOT NULL,
  `kategoriHarian` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_rutin`),
  KEY `rutin_FK` (`username`),
  CONSTRAINT `rutin_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `harianhistori` ADD COLUMN `struk_img` varchar(255) DEFAULT NULL;

