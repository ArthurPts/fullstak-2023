-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: fullstack
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `akun` (
  `username` varchar(20) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nrp_mahasiswa` char(9) DEFAULT NULL,
  `npk_dosen` char(6) DEFAULT NULL,
  `isadmin` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`username`),
  KEY `fk_akun_mahasiswa_idx` (`nrp_mahasiswa`),
  KEY `fk_akun_dosen1_idx` (`npk_dosen`),
  CONSTRAINT `fk_akun_dosen1` FOREIGN KEY (`npk_dosen`) REFERENCES `dosen` (`npk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_akun_mahasiswa` FOREIGN KEY (`nrp_mahasiswa`) REFERENCES `mahasiswa` (`nrp`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akun`
--

LOCK TABLES `akun` WRITE;
/*!40000 ALTER TABLE `akun` DISABLE KEYS */;
INSERT INTO `akun` VALUES ('admin','$2y$10$n/Qb8qVnqpCN6RNKuwZs9e/fX0PVXO4h2wxohpsmZE3g7nU1Y1X2e',NULL,NULL,1),('D000001','$2y$10$SGhpCTece4tcCeuCeuenA.EpVdfqcgeypWQbBpgbL4F/VKIxZC3iS',NULL,'000001',0),('D000002','$2y$10$N8LkwFzuikR80iw35StR9Ozw5QAO3RTgpx52W.31Wd917O3oY5F5G',NULL,'000002',0),('D000003','$2y$10$hz6IUvXgheoorVEJx/GhnubV7ykZbPB1iqTqpXTVUigTDrBWiqM2q',NULL,'000003',0),('D000004','$2y$10$WOgV/LWUvAJbK62mzBSooeccp1Zt4.Kuh0vbJMHbDneI4dpx3N6pO',NULL,'000004',0),('D000005','$2y$10$6Q7FV.sO6bOAdFpiXpIl7OgnptzO6Teutg8FuYfknYoni5VilIF1W',NULL,'000005',0),('D222222','$2y$10$yhqmLzaDplZUrGy0VcxZ7uEidE0I8FFUYS3lyquvepGoE29cneaHe',NULL,'222222',0),('M000000001','$2y$10$McvpsX2HHl9BJL77qC7vZ..Gbi.dJGG.JjnpzGOUkcf5KPXMZfMea','000000001',NULL,0),('M000000002','$2y$10$yxkoipWVOjqfG0ehKvd56uC5KrD8cpcNqvk5Qymx.rX8wQitIGxLe','000000002',NULL,0),('M000000003','$2y$10$pb1aeZOk7SrjnJGAHFep.OtjzUqWUOhU8wISkuMTUl.KggO2RCf3e','000000003',NULL,0),('M000000004','$2y$10$8bI3fKzqbOvt3JVbQuWPou6ZjKxQY9BMwbBvnBGJV06JPADrEmc.W','000000004',NULL,0),('M000000022','$2y$10$CCPVXohnm2.CN//SF4ZFGe5nspy1ev7VMXgJdUioG/QiSOvsB.Fci','000000022',NULL,0);
/*!40000 ALTER TABLE `akun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chat`
--

DROP TABLE IF EXISTS `chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `chat` (
  `idchat` int(11) NOT NULL AUTO_INCREMENT,
  `idthread` int(11) NOT NULL,
  `username_pembuat` varchar(20) NOT NULL,
  `isi` text DEFAULT NULL,
  `tanggal_pembuatan` datetime DEFAULT NULL,
  PRIMARY KEY (`idchat`),
  KEY `fk_chat_thread1_idx` (`idthread`),
  KEY `fk_chat_akun1_idx` (`username_pembuat`),
  CONSTRAINT `fk_chat_akun1` FOREIGN KEY (`username_pembuat`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_chat_thread1` FOREIGN KEY (`idthread`) REFERENCES `thread` (`idthread`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chat`
--

LOCK TABLES `chat` WRITE;
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
INSERT INTO `chat` VALUES (1,3,'admin','hai','2025-12-29 18:00:09'),(2,3,'D000005','ok','2025-12-29 18:04:57'),(3,3,'M000000001','bisa','2025-12-29 21:45:14'),(4,3,'M000000001','bisa','2025-12-29 21:46:43'),(5,3,'M000000001','nah','2025-12-29 21:49:42'),(6,3,'M000000001','pls','2025-12-29 21:50:06'),(7,3,'M000000002','hmmm','2025-12-29 21:50:12'),(8,3,'M000000002',NULL,'2025-12-29 21:50:21'),(9,3,'M000000001','okeh','2025-12-30 08:59:59'),(10,3,'M000000001','okehh','2025-12-30 09:02:54'),(11,3,'M000000002','bisa nih','2025-12-30 09:05:54'),(12,3,'M000000001','hm','2025-12-30 09:17:10'),(13,3,'D000005','gimana','2025-12-30 09:20:54');
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dosen`
--

DROP TABLE IF EXISTS `dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dosen` (
  `npk` char(6) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `foto_extension` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`npk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dosen`
--

LOCK TABLES `dosen` WRITE;
/*!40000 ALTER TABLE `dosen` DISABLE KEYS */;
INSERT INTO `dosen` VALUES ('000001','ubaya1','jpg'),('000002','ubaya2','jpg'),('000003','ubaya3',''),('000004','ubaya4',''),('000005','ubaya5','jpg'),('222222','testingadmindosen','');
/*!40000 ALTER TABLE `dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event` (
  `idevent` int(11) NOT NULL AUTO_INCREMENT,
  `idgrup` int(11) NOT NULL,
  `judul` varchar(45) DEFAULT NULL,
  `judul-slug` varchar(45) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `jenis` enum('Privat','Publik') DEFAULT NULL,
  `poster_extension` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`idevent`),
  KEY `fk_event_grup1_idx` (`idgrup`),
  CONSTRAINT `fk_event_grup1` FOREIGN KEY (`idgrup`) REFERENCES `grup` (`idgrup`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,1,'Workshop Python Dasar','workshop-python-dasar','2025-06-01 13:00:00','Belajar dasar-dasar bahasa Python.','Publik','jpg'),(2,3,'Ngoding Bareng #1','ngoding-bareng-1','2025-06-15 19:00:00','Sesi ngoding bersama untuk pemula.','Privat',NULL),(3,2,'Hunting Foto Surabaya','hunting-foto-surabaya','2025-07-10 08:00:00','Hunting outdoor di area kota tua Surabaya.','Publik','png'),(4,4,'Turnamen Esports Internal','turnamen-esports-internal','2025-08-20 18:00:00','Kompetisi internal antar anggota komunitas.','Publik','jpg'),(5,5,'Seminar Riset AI','seminar-riset-ai','2025-09-05 10:00:00','Presentasi progres riset AI terbaru.','Privat',NULL),(6,16,'ubaya','sby','2025-12-01 03:08:00','universitas','Privat','jpg'),(13,18,'yuyi','yiyi','2025-12-01 14:26:00','yiyi','Privat','png'),(14,18,'gogert','gog','2025-12-01 14:32:00','ogo','Publik','jpg');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grup`
--

DROP TABLE IF EXISTS `grup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grup` (
  `idgrup` int(11) NOT NULL AUTO_INCREMENT,
  `username_pembuat` varchar(20) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `deskripsi` varchar(45) DEFAULT NULL,
  `tanggal_pembentukan` datetime DEFAULT NULL,
  `jenis` enum('Privat','Publik') DEFAULT NULL,
  `kode_pendaftaran` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idgrup`),
  KEY `fk_grup_akun1_idx` (`username_pembuat`),
  CONSTRAINT `fk_grup_akun1` FOREIGN KEY (`username_pembuat`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grup`
--

LOCK TABLES `grup` WRITE;
/*!40000 ALTER TABLE `grup` DISABLE KEYS */;
INSERT INTO `grup` VALUES (1,'admin','Grup Belajar Pemrograman','Diskusi materi coding','2025-01-10 10:00:00','Publik','GBLJR2025'),(2,'D000002','Komunitas Fotografi','Sharing teknik foto','2025-02-15 14:30:00','Publik','FOTO2025'),(3,'D000001','Kelas Bimbingan Dosen 01','Grup bimbingan akademik','2025-03-01 09:00:00','Privat','BIMD001'),(4,'D000002','Esports UBAYA','Tim dan komunitas esports','2025-04-05 20:00:00','Publik','ESPT2025'),(5,'D000003','Penelitian AI','Grup riset kecerdasan buatan','2025-05-12 08:45:00','Privat','RISAI2025'),(13,'D000003','YAKIN BISA','pasti  bisa','2025-11-28 12:27:02','Privat','facc76'),(16,'D000001','testing','pembuatan grup','2025-12-01 03:07:11','Publik','b7f7ee'),(17,'D000001','test222','test222','2025-12-01 11:46:44','Publik','78791c'),(18,'D000005','jaya5','jaya','2025-12-01 13:42:12','Publik','37feaf');
/*!40000 ALTER TABLE `grup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mahasiswa`
--

DROP TABLE IF EXISTS `mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mahasiswa` (
  `nrp` char(9) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `gender` enum('Pria','Wanita') DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `angkatan` year(4) DEFAULT NULL,
  `foto_extention` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`nrp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mahasiswa`
--

LOCK TABLES `mahasiswa` WRITE;
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;
INSERT INTO `mahasiswa` VALUES ('000000001','mahasiswa1','Pria','2025-10-24',2020,'jpg'),('000000002','mahasiswa2','Wanita','2025-10-02',2012,'jpg'),('000000003','mahasiswa3','Pria','2025-09-30',2023,'jpg'),('000000004','mahasiswa4','Pria','2025-10-31',2025,''),('000000022','alamak','Pria','2025-10-27',2020,'jpg');
/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_grup`
--

DROP TABLE IF EXISTS `member_grup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_grup` (
  `idgrup` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`idgrup`,`username`),
  KEY `fk_grup_has_akun_akun1_idx` (`username`),
  KEY `fk_grup_has_akun_grup1_idx` (`idgrup`),
  CONSTRAINT `fk_grup_has_akun_akun1` FOREIGN KEY (`username`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_grup_has_akun_grup1` FOREIGN KEY (`idgrup`) REFERENCES `grup` (`idgrup`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_grup`
--

LOCK TABLES `member_grup` WRITE;
/*!40000 ALTER TABLE `member_grup` DISABLE KEYS */;
INSERT INTO `member_grup` VALUES (1,'admin'),(1,'D000001'),(1,'M000000001'),(1,'M000000003'),(1,'M000000004'),(2,'D000001'),(2,'M000000002'),(3,'D000001'),(3,'M000000001'),(4,'M000000003'),(4,'M000000004'),(5,'D000003'),(5,'M000000002'),(13,'D000003'),(16,'D000001'),(17,'D000001'),(17,'D000005'),(18,'admin'),(18,'D000005'),(18,'D222222'),(18,'M000000001');
/*!40000 ALTER TABLE `member_grup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thread`
--

DROP TABLE IF EXISTS `thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `thread` (
  `idthread` int(11) NOT NULL AUTO_INCREMENT,
  `username_pembuat` varchar(20) NOT NULL,
  `idgrup` int(11) NOT NULL,
  `tanggal_pembuatan` datetime DEFAULT NULL,
  `status` enum('Open','Close') DEFAULT 'Open',
  PRIMARY KEY (`idthread`),
  KEY `fk_thread_akun1_idx` (`username_pembuat`),
  KEY `fk_thread_grup1_idx` (`idgrup`),
  CONSTRAINT `fk_thread_akun1` FOREIGN KEY (`username_pembuat`) REFERENCES `akun` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_thread_grup1` FOREIGN KEY (`idgrup`) REFERENCES `grup` (`idgrup`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thread`
--

LOCK TABLES `thread` WRITE;
/*!40000 ALTER TABLE `thread` DISABLE KEYS */;
INSERT INTO `thread` VALUES (1,'admin',18,'2025-12-08 22:02:31','Open'),(2,'D000005',18,'2025-12-08 22:08:16','Close'),(3,'admin',18,'2025-12-14 22:24:08','Open'),(4,'admin',1,'2025-12-16 20:57:45','Open');
/*!40000 ALTER TABLE `thread` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-12 20:46:40
