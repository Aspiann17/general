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
  `kode_supir` varchar(11) DEFAULT NULL,
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
  `nama` varchar(75) NOT NULL,
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
  CONSTRAINT `penumpang_ibfk_1` FOREIGN KEY (`kode_tujuan`) REFERENCES `tujuan` (`kode_tujuan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penumpang`
--

LOCK TABLES `penumpang` WRITE;
/*!40000 ALTER TABLE `penumpang` DISABLE KEYS */;
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

-- Dump completed on 2024-09-22 14:10:50
