-- MySQL dump 10.13  Distrib 9.7.1, for macos26.4 (arm64)
--
-- Host: localhost    Database: saqoe
-- ------------------------------------------------------
-- Server version	9.7.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ 'afa273c0-9267-11f1-9aab-d4ce8e5c239a:1-76';

--
-- Table structure for table `dompet`
--

DROP TABLE IF EXISTS `dompet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dompet` (
  `id_dompet` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `nama_dompet` varchar(50) NOT NULL,
  `saldo` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_dompet`),
  KEY `username` (`username`),
  CONSTRAINT `fk_dompet_username` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dompet`
--

LOCK TABLES `dompet` WRITE;
/*!40000 ALTER TABLE `dompet` DISABLE KEYS */;
/*!40000 ALTER TABLE `dompet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event` (
  `username` varchar(50) NOT NULL,
  `namaEvent` varchar(25) DEFAULT NULL,
  `budget` int NOT NULL,
  KEY `event_FK` (`username`),
  CONSTRAINT `event_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES ('faisalridwan','Liburan Bali',5000000),('faisalridwan','Beli Laptop',15000000),('faisalridwansiregar','Renovasi Rumah',20000000),('faisalridwan','Bali',0),('faisalridwan','Belanja Januari',500000);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventhistori`
--

DROP TABLE IF EXISTS `eventhistori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eventhistori` (
  `username` varchar(50) DEFAULT NULL,
  `kategoriEvent` varchar(25) NOT NULL,
  `namaEvent` varchar(25) NOT NULL,
  `namaPemaPengEvent` varchar(25) NOT NULL,
  `kategoriPengeluaranE` varchar(25) NOT NULL,
  `tanggal` varchar(15) DEFAULT NULL,
  `jam` varchar(15) DEFAULT NULL,
  `pemasukanEvent` int DEFAULT NULL,
  `pengeluaranEvent` int DEFAULT NULL,
  `sisaBudget` int DEFAULT NULL,
  KEY `historievent_FK` (`username`),
  CONSTRAINT `historievent_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventhistori`
--

LOCK TABLES `eventhistori` WRITE;
/*!40000 ALTER TABLE `eventhistori` DISABLE KEYS */;
INSERT INTO `eventhistori` VALUES ('faisalridwan','Pemasukan','Liburan Bali','Tabungan Gaji','-','01-08-2026','09:00:00',1000000,0,1000000),('faisalridwan','Pemasukan','Liburan Bali','Bonus Kantor','-','02-08-2026','10:00:00',500000,0,1500000),('faisalridwan','Pengeluaran','Liburan Bali','Tiket Pesawat','Transportasi','03-08-2026','11:00:00',0,800000,700000);
/*!40000 ALTER TABLE `eventhistori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventpemasukan`
--

DROP TABLE IF EXISTS `eventpemasukan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eventpemasukan` (
  `username` varchar(50) DEFAULT NULL,
  `namaEvent` varchar(25) DEFAULT NULL,
  `namaPemasukanEvent` varchar(25) DEFAULT NULL,
  `budget` int DEFAULT NULL,
  `tanggalPemasukan` varchar(25) DEFAULT NULL,
  `jamPemasukan` varchar(15) DEFAULT NULL,
  KEY `pemasukanevent_FK` (`username`),
  CONSTRAINT `pemasukanevent_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventpemasukan`
--

LOCK TABLES `eventpemasukan` WRITE;
/*!40000 ALTER TABLE `eventpemasukan` DISABLE KEYS */;
INSERT INTO `eventpemasukan` VALUES ('faisalridwan','Liburan Bali','Tabungan Gaji',1000000,'01-08-2026','09:00:00'),('faisalridwan','Liburan Bali','Bonus Kantor',500000,'02-08-2026','10:00:00');
/*!40000 ALTER TABLE `eventpemasukan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventpengeluaran`
--

DROP TABLE IF EXISTS `eventpengeluaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `eventpengeluaran` (
  `username` varchar(50) DEFAULT NULL,
  `namaEvent` varchar(25) NOT NULL,
  `namaPengeluaranEvent` varchar(25) DEFAULT NULL,
  `besarPengeluaran` int NOT NULL,
  `kategoriPengeluaranEvent` varchar(20) DEFAULT NULL,
  `tglPengeluaranEvent` varchar(15) DEFAULT NULL,
  `jamPengeluaran` varchar(15) NOT NULL,
  KEY `pengeluaranevent_FK` (`username`),
  CONSTRAINT `pengeluaranevent_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventpengeluaran`
--

LOCK TABLES `eventpengeluaran` WRITE;
/*!40000 ALTER TABLE `eventpengeluaran` DISABLE KEYS */;
INSERT INTO `eventpengeluaran` VALUES ('faisalridwan','Liburan Bali','Tiket Pesawat',800000,'Transportasi','03-08-2026','11:00:00');
/*!40000 ALTER TABLE `eventpengeluaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `harianhistori`
--

DROP TABLE IF EXISTS `harianhistori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `harianhistori` (
  `username` varchar(50) DEFAULT NULL,
  `nama` varchar(25) DEFAULT NULL,
  `tanggal` varchar(15) DEFAULT NULL,
  `jam` varchar(15) DEFAULT NULL,
  `kategoriHarian` varchar(25) DEFAULT NULL,
  `kategoriPengeluaranH` varchar(25) DEFAULT NULL,
  `pemasukan` int DEFAULT NULL,
  `pengeluaran` int DEFAULT NULL,
  `sisaSaldo` int DEFAULT NULL,
  KEY `historiharian_FK` (`username`),
  CONSTRAINT `historiharian_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `harianhistori`
--

LOCK TABLES `harianhistori` WRITE;
/*!40000 ALTER TABLE `harianhistori` DISABLE KEYS */;
INSERT INTO `harianhistori` VALUES ('faisalridwan','Gaji Bulanan','01-08-2026','08:00:00','Pemasukan','-',5000000,0,5000000),('faisalridwan','Beli Makan Siang','02-08-2026','12:30:00','Pengeluaran','Makanan & Minuman',0,50000,4950000),('faisalridwan','Beli Kopi','03-08-2026','15:00:00','Pengeluaran','Makanan & Minuman',0,25000,4925000),('faisalridwan','Nonton Bioskop','04-08-2026','19:00:00','Pengeluaran','Hiburan',0,100000,4825000),('faisalridwansiregar','Uang Jajan','01-08-2026','07:00:00','Pemasukan','-',1000000,0,1000000),('faisalridwansiregar','Beli Pulsa','02-08-2026','08:00:00','Pengeluaran','Tagihan',0,100000,900000);
/*!40000 ALTER TABLE `harianhistori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `harianpemasukan`
--

DROP TABLE IF EXISTS `harianpemasukan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `harianpemasukan` (
  `username` varchar(50) DEFAULT NULL,
  `namaPemasukan` varchar(25) DEFAULT NULL,
  `besarPemasukan` int DEFAULT NULL,
  `tanggalPemasukan` varchar(15) DEFAULT NULL,
  `jamPemasukan` varchar(15) NOT NULL,
  KEY `pemasukanharian_FK` (`username`),
  CONSTRAINT `pemasukanharian_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `harianpemasukan`
--

LOCK TABLES `harianpemasukan` WRITE;
/*!40000 ALTER TABLE `harianpemasukan` DISABLE KEYS */;
INSERT INTO `harianpemasukan` VALUES ('faisalridwan','Gaji Bulanan',5000000,'01-08-2026','08:00:00'),('faisalridwansiregar','Uang Jajan',1000000,'01-08-2026','07:00:00'),('faisalridwan','Makan Siang',40000,'2026-08-07 ','14:31:46');
/*!40000 ALTER TABLE `harianpemasukan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `harianpengeluaran`
--

DROP TABLE IF EXISTS `harianpengeluaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `harianpengeluaran` (
  `username` varchar(50) DEFAULT NULL,
  `namaPengeluaran` varchar(25) DEFAULT NULL,
  `besarPengeluaran` int DEFAULT NULL,
  `tanggalPengeluaran` varchar(15) DEFAULT NULL,
  `jamPengeluaran` varchar(15) NOT NULL,
  `kategoriPengeluaranH` varchar(25) NOT NULL,
  KEY `pengeluaranharian_FK` (`username`),
  CONSTRAINT `pengeluaranharian_FK` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `harianpengeluaran`
--

LOCK TABLES `harianpengeluaran` WRITE;
/*!40000 ALTER TABLE `harianpengeluaran` DISABLE KEYS */;
INSERT INTO `harianpengeluaran` VALUES ('faisalridwan','Beli Makan Siang',50000,'02-08-2026','12:30:00','Makanan & Minuman'),('faisalridwan','Beli Kopi',25000,'03-08-2026','15:00:00','Makanan & Minuman'),('faisalridwan','Nonton Bioskop',100000,'04-08-2026','19:00:00','Hiburan'),('faisalridwansiregar','Beli Pulsa',100000,'02-08-2026','08:00:00','Tagihan');
/*!40000 ALTER TABLE `harianpengeluaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hutang_piutang`
--

DROP TABLE IF EXISTS `hutang_piutang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hutang_piutang` (
  `id_hp` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `jenis` enum('Hutang','Piutang') NOT NULL,
  `nama_orang` varchar(100) NOT NULL,
  `nominal` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `status` enum('Belum Lunas','Lunas') DEFAULT 'Belum Lunas',
  PRIMARY KEY (`id_hp`),
  KEY `username` (`username`),
  CONSTRAINT `fk_hp_username` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hutang_piutang`
--

LOCK TABLES `hutang_piutang` WRITE;
/*!40000 ALTER TABLE `hutang_piutang` DISABLE KEYS */;
/*!40000 ALTER TABLE `hutang_piutang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengguna` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `saldo` int DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `datecreated` varchar(25) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengguna`
--

LOCK TABLES `pengguna` WRITE;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` VALUES ('faisalridwan','$2y$12$sNtNtmkfVeaSI4Z3dw0HO.JKl5FrbxGgCtBVDvV4RaSq6cT4PvBE2','Faisal Ridwan Siregar','082275007855','Jl. Bukit Kotapinang',840001,'faisalridwan@gmail.com','default.jpg','1572742356'),('faisalridwansiregar','$2y$12$/TqG1l8pDMBURuiooDg8tekQxarlykeeIUJINItOb0be5d2GeUm7y','Faisal Ridwan','08123456789','Jl. Assal',100000,'faisalridwann@gmail.com','default.jpg','1572867014'),('qwe','$2y$12$P/7zva72R.vdpvyBEUt3LurDWiI7JZMrX2d3FWRapPOKhe3/Dm0X6','qwee','qweq','se',0,'qretipstudio@gmail.com','default.jpg','1786113551');
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlist` (
  `id_wishlist` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `nama_target` varchar(100) NOT NULL,
  `harga_target` int NOT NULL,
  `saldo_terkumpul` int NOT NULL DEFAULT '0',
  `deadline` date DEFAULT NULL,
  `status` enum('Belum Tercapai','Tercapai') DEFAULT 'Belum Tercapai',
  PRIMARY KEY (`id_wishlist`),
  KEY `username` (`username`),
  CONSTRAINT `fk_wishlist_username` FOREIGN KEY (`username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-08-07 22:02:38
