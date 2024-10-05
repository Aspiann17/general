-- MySQL dump 10.13  Distrib 5.7.35-38, for Linux (x86_64)
--
-- Host: localhost    Database: tugas_dbs_aspian
-- ------------------------------------------------------
-- Server version	5.7.35-38

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*!50717 SELECT COUNT(*) INTO @rocksdb_has_p_s_session_variables FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'performance_schema' AND TABLE_NAME = 'session_variables' */;
/*!50717 SET @rocksdb_get_is_supported = IF (@rocksdb_has_p_s_session_variables, 'SELECT COUNT(*) INTO @rocksdb_is_supported FROM performance_schema.session_variables WHERE VARIABLE_NAME=\'rocksdb_bulk_load\'', 'SELECT 0') */;
/*!50717 PREPARE s FROM @rocksdb_get_is_supported */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;
/*!50717 SET @rocksdb_enable_bulk_load = IF (@rocksdb_is_supported, 'SET SESSION rocksdb_bulk_load = 1', 'SET @rocksdb_dummy_bulk_load = 0') */;
/*!50717 PREPARE s FROM @rocksdb_enable_bulk_load */;
/*!50717 EXECUTE s */;
/*!50717 DEALLOCATE PREPARE s */;

--
-- Table structure for table `armada`
--

DROP TABLE IF EXISTS `armada`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `armada` (
  `plat` varchar(11) NOT NULL,
  `jenis` varchar(21) DEFAULT NULL,
  `warna` varchar(21) DEFAULT NULL,
  `kursi` varchar(2) DEFAULT NULL,
  `kode_supir` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`plat`),
  KEY `kode_supir` (`kode_supir`),
  CONSTRAINT `armada_ibfk_1` FOREIGN KEY (`kode_supir`) REFERENCES `supir` (`kode_supir`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `armada`
--

LOCK TABLES `armada` WRITE;
/*!40000 ALTER TABLE `armada` DISABLE KEYS */;
INSERT INTO `armada` VALUES ('p001','Kapal Karam','Hijau','99','su001'),('p002','Kapal Selam','Pink','50','su002');
/*!40000 ALTER TABLE `armada` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursi`
--

DROP TABLE IF EXISTS `kursi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kursi` (
  `kode_kursi` varchar(11) NOT NULL,
  `nomor` varchar(21) DEFAULT NULL,
  `plat` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`kode_kursi`),
  KEY `plat` (`plat`),
  CONSTRAINT `kursi_ibfk_1` FOREIGN KEY (`plat`) REFERENCES `armada` (`plat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursi`
--

LOCK TABLES `kursi` WRITE;
/*!40000 ALTER TABLE `kursi` DISABLE KEYS */;
INSERT INTO `kursi` VALUES ('k001','01','p001'),('k002','02','p001'),('k003','01','p002'),('k004','02','p002');
/*!40000 ALTER TABLE `kursi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penumpang`
--

DROP TABLE IF EXISTS `penumpang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penumpang` (
  `kode_penumpang` varchar(11) NOT NULL,
  `nama` varchar(75) DEFAULT NULL,
  `alamat` text,
  `jk` varchar(15) DEFAULT NULL,
  `umur` varchar(9) DEFAULT NULL,
  `telepon` varchar(21) DEFAULT NULL,
  `kode_tujuan` varchar(11) DEFAULT NULL,
  `kode_kursi` varchar(11) DEFAULT NULL,
  `plat` varchar(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`kode_penumpang`),
  KEY `kode_tujuan` (`kode_tujuan`),
  KEY `kode_kursi` (`kode_kursi`),
  KEY `plat` (`plat`),
  CONSTRAINT `penumpang_ibfk_1` FOREIGN KEY (`kode_tujuan`) REFERENCES `tujuan` (`kode_tujuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penumpang_ibfk_2` FOREIGN KEY (`kode_kursi`) REFERENCES `kursi` (`kode_kursi`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penumpang_ibfk_3` FOREIGN KEY (`plat`) REFERENCES `armada` (`plat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penumpang`
--

LOCK TABLES `penumpang` WRITE;
/*!40000 ALTER TABLE `penumpang` DISABLE KEYS */;
INSERT INTO `penumpang` VALUES ('c001','Reno Halimawan','Bati Bati','Pria','20','+62bbbbbbbbbbb','tu010','k004','p002','2024-09-29'),('c002','Ali Baba','Sungai Andai','Pria','19','+62ccccccccccc','tu002','k004','p002','2025-11-21'),('c004','Fulana','Kelayan C','Pria','16','+62eeeeeeeeeee','tu004','k003','p002','2045-01-01');
/*!40000 ALTER TABLE `penumpang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supir`
--

DROP TABLE IF EXISTS `supir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supir` (
  `kode_supir` varchar(7) NOT NULL,
  `nama` varchar(75) DEFAULT NULL,
  `jk` varchar(11) DEFAULT NULL,
  `alamat` text,
  `telepon` varchar(33) DEFAULT NULL,
  `umur` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`kode_supir`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supir`
--

LOCK TABLES `supir` WRITE;
/*!40000 ALTER TABLE `supir` DISABLE KEYS */;
INSERT INTO `supir` VALUES ('su001','Johan','Pria','JL. Simpang Siur','+62aaaaaaaaaaa','39'),('su002','Aditya Surya','Wanita','JL. Simpang Ampat','','25');
/*!40000 ALTER TABLE `supir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tujuan`
--

DROP TABLE IF EXISTS `tujuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tujuan` (
  `kode_tujuan` varchar(11) NOT NULL,
  `tujuan` text,
  `harga` varchar(11) DEFAULT NULL,
  `jam` varchar(17) DEFAULT NULL,
  PRIMARY KEY (`kode_tujuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tujuan`
--

LOCK TABLES `tujuan` WRITE;
/*!40000 ALTER TABLE `tujuan` DISABLE KEYS */;
INSERT INTO `tujuan` VALUES ('tu002','Pulau Kembang','Rp30.000','09:05'),('tu004','Sungai Andai','Rp25.000','07:90'),('tu010','Siring','Rp10.000','08:10');
/*!40000 ALTER TABLE `tujuan` ENABLE KEYS */;
UNLOCK TABLES;
/*!50112 SET @disable_bulk_load = IF (@is_rocksdb_supported, 'SET SESSION rocksdb_bulk_load = @old_rocksdb_bulk_load', 'SET @dummy_rocksdb_bulk_load = 0') */;
/*!50112 PREPARE s FROM @disable_bulk_load */;
/*!50112 EXECUTE s */;
/*!50112 DEALLOCATE PREPARE s */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-05 13:22:38
