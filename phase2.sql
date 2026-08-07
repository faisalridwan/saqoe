CREATE TABLE IF NOT EXISTS `dompet` (
  `id_dompet` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `nama_dompet` varchar(50) NOT NULL,
  `saldo` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_dompet`),
  KEY `username` (`username`),
  CONSTRAINT `fk_dompet_username` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id_wishlist` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `nama_target` varchar(100) NOT NULL,
  `harga_target` int(11) NOT NULL,
  `saldo_terkumpul` int(11) NOT NULL DEFAULT '0',
  `deadline` date DEFAULT NULL,
  `status` enum('Belum Tercapai','Tercapai') DEFAULT 'Belum Tercapai',
  PRIMARY KEY (`id_wishlist`),
  KEY `username` (`username`),
  CONSTRAINT `fk_wishlist_username` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `hutang_piutang` (
  `id_hp` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `jenis` enum('Hutang','Piutang') NOT NULL,
  `nama_orang` varchar(100) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `status` enum('Belum Lunas','Lunas') DEFAULT 'Belum Lunas',
  PRIMARY KEY (`id_hp`),
  KEY `username` (`username`),
  CONSTRAINT `fk_hp_username` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
