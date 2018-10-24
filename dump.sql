-- MySQL dump 10.13  Distrib 5.7.21, for Win64 (x86_64)
--
-- Host: localhost    Database: gaji
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.26-MariaDB

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

--
-- Table structure for table `sys_groups`
--

DROP TABLE IF EXISTS `sys_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_groups` (
  `node_group` int(11) NOT NULL,
  `group` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`node_group`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_groups`
--

LOCK TABLES `sys_groups` WRITE;
/*!40000 ALTER TABLE `sys_groups` DISABLE KEYS */;
INSERT INTO `sys_groups` VALUES (1,'DATA MASTER','fa fa-database'),(2,'LAPORAN','fa fa-recycle'),(3,'LEMBUR','fa fa-money'),(4,'SLIP GAJI','fa fa-cubes');
/*!40000 ALTER TABLE `sys_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_menus`
--

DROP TABLE IF EXISTS `sys_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_menus` (
  `node_group` int(11) NOT NULL,
  `node_menu` int(11) NOT NULL,
  `menu` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_access` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`node_group`,`node_menu`) USING BTREE,
  CONSTRAINT `sys_menus_ibfk_1` FOREIGN KEY (`node_group`) REFERENCES `sys_groups` (`node_group`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_menus`
--

LOCK TABLES `sys_menus` WRITE;
/*!40000 ALTER TABLE `sys_menus` DISABLE KEYS */;
INSERT INTO `sys_menus` VALUES (1,1,'KARYAWAN','/user','10232,10236,10235','Y','fa fa-users'),(1,2,'UPLOAD ABSESNI','/upload_absensi','10232,10236','Y','fa fa-cloud-upload'),(2,1,'DAFTAR GAJI','/daftar-gaji','10232,10236','Y','fa fa-file-text'),(2,2,'CEK LAPORAN  GAJI','/approv-gaji','10232,10235,10233','Y','fa fa-check-circle'),(3,1,'BUAT SPL','/buat-spl','10232,10237','Y','fa fa-envelope-open-o'),(3,2,'INPUT LEMBUR','/input-lembur','10232,10236,10235,38801,38802,38803,38804,38805,38806,38807,38808,38809,38810,38811,38812,38813,38814,38815,38816,38817,38818','N','fa fa-pencil-square'),(3,3,'CEK LEMBUR','/approv-lembur','10232,10237','Y','fa fa-calendar-check-o'),(4,1,'SLIP','/slip','10236,10237,10235,10233,38801,38802,38803,38804,38805,38806,38807,38808,38809,38810,38811,38812,38813,38814,38815,38816,38817,38818,10232','Y','fa fa-barcode');
/*!40000 ALTER TABLE `sys_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_pengunjung`
--

DROP TABLE IF EXISTS `sys_pengunjung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_pengunjung` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_NAME` varchar(20) DEFAULT NULL,
  `TANGGAL` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_pengunjung`
--

LOCK TABLES `sys_pengunjung` WRITE;
/*!40000 ALTER TABLE `sys_pengunjung` DISABLE KEYS */;
INSERT INTO `sys_pengunjung` VALUES (1,'admin','2018-06-25 21:11:26'),(2,'admin','2018-06-25 21:14:42'),(3,'admin','2018-06-25 21:16:34'),(4,'admin','2018-06-25 21:18:37'),(5,'admin','2018-06-25 21:35:02'),(6,'admin','2018-06-25 21:35:11'),(7,'admin','2018-06-25 21:43:28'),(8,'admin','2018-06-25 21:44:46'),(9,'helmi.widiyarto','2018-06-25 22:10:32'),(10,'admin','2018-06-25 22:12:47'),(11,'admin','2018-06-25 22:56:24'),(12,'admin','2018-06-25 23:10:16'),(13,'kurob','2018-06-26 20:26:03'),(14,'admin','2018-06-26 20:28:25'),(15,'admin','2018-06-26 22:54:17'),(16,'admin','2018-06-26 22:54:41'),(17,'admin','2018-06-28 20:18:02'),(18,'admin','2018-06-28 20:31:28'),(19,'asdasd','2018-06-28 21:36:36'),(20,'admin','2018-06-28 21:36:52'),(21,'admin','2018-06-28 21:56:47'),(22,'admin','2018-06-29 22:13:38'),(23,'admin','2018-07-20 09:01:28'),(24,'admin','2018-07-28 13:27:02'),(25,'admin','2018-07-28 13:37:25'),(26,'admin','2018-07-28 14:04:33'),(27,'admin','2018-08-04 00:32:01'),(28,'adi.rifatullah','2018-08-04 01:26:37'),(29,'admin','2018-08-04 01:26:47'),(30,'admin','2018-08-05 13:36:00'),(31,'admin','2018-08-06 22:28:02'),(32,'TEGUH.ABADI','2018-08-06 22:31:52'),(33,'admin','2018-08-06 22:32:01'),(34,'admin','2018-08-06 22:32:10'),(35,'TEGUH.ABADI','2018-08-06 22:51:31'),(36,'admin','2018-08-07 22:32:39'),(37,'TEGUH.ABADI','2018-08-07 23:09:33'),(38,'admin','2018-08-09 22:55:20'),(39,'admin','2018-08-10 00:00:47'),(40,'admin','2018-08-10 22:30:19'),(41,'adi.rifatullah','2018-08-11 00:45:15'),(42,'admin','2018-08-11 00:45:23'),(43,'adi.rifatullah','2018-08-11 00:46:29'),(44,'admin','2018-08-11 00:47:07'),(45,'TEGUH.ABADI','2018-08-11 00:50:12'),(46,'admin','2018-08-11 00:50:29'),(47,'PUTRA','2018-08-11 01:00:03'),(48,'admin','2018-08-11 01:28:26'),(49,'cahyo.antarikso','2018-08-11 01:28:46'),(50,'admin','2018-08-11 01:34:51'),(51,'admin','2018-08-12 17:32:51'),(52,'admin','2018-08-21 05:40:08'),(53,'admin','2018-08-29 20:41:21'),(54,'admin','2018-08-30 21:32:48'),(55,'admin','2018-08-31 22:58:15'),(56,'admin','2018-09-06 23:19:52'),(57,'admin','2018-09-07 02:37:37'),(58,'admin','2018-09-07 02:38:06'),(59,'AGUS.GUNAWAN','2018-09-07 02:39:32'),(60,'TEGUH.ABADI','2018-09-07 02:40:07'),(61,'AGUS.GUNAWAN','2018-09-07 02:42:04'),(62,'TEGUH.ABADI','2018-09-07 02:43:03'),(63,'AGUS.GUNAWAN','2018-09-07 02:43:24'),(64,'admin','2018-09-07 03:00:39'),(65,'admin','2018-09-09 02:38:27'),(66,'admin','2018-09-10 23:53:24'),(67,'admin','2018-09-17 21:22:10'),(68,'admin','2018-09-20 09:56:33'),(69,'admin','2018-10-05 23:17:57'),(70,'admin','2018-10-06 01:37:27'),(71,'admin','2018-10-06 01:37:27'),(72,'admin','2018-10-06 01:56:59'),(73,'admin','2018-10-06 15:46:31'),(74,'admin','2018-10-06 23:01:08'),(75,'AGUS.GUNAWAN','2018-10-06 23:02:06'),(76,'admin','2018-10-06 23:03:02'),(77,'admin','2018-10-07 02:06:06'),(78,'admin','2018-10-08 20:28:04'),(79,'admin','2018-10-08 20:32:06'),(80,'admin','2018-10-10 22:14:25'),(81,'admin','2018-10-14 08:20:09'),(82,'admin','2018-10-14 15:43:58'),(83,'admin','2018-10-15 19:37:49'),(84,'admin','2018-10-16 19:37:13'),(85,'admin','2018-10-17 20:44:30'),(86,'cahyo.antarikso','2018-10-18 00:18:39'),(87,'ADI.RIFATULLAH','2018-10-18 00:18:56'),(88,'admin','2018-10-18 00:19:23'),(89,'admin','2018-10-22 22:31:26');
/*!40000 ALTER TABLE `sys_pengunjung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_users`
--

DROP TABLE IF EXISTS `sys_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_users` (
  `nik` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `basic` double(40,2) DEFAULT NULL,
  `bpjs` double(40,2) DEFAULT NULL,
  `jamsostek` double(40,2) DEFAULT NULL,
  `uang_makan` double(40,2) DEFAULT NULL,
  `uang_transport` double(40,2) DEFAULT NULL,
  PRIMARY KEY (`nik`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_users`
--

LOCK TABLES `sys_users` WRITE;
/*!40000 ALTER TABLE `sys_users` DISABLE KEYS */;
INSERT INTO `sys_users` VALUES ('10232','admin','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','ADMIN','ADMINISTRATOR','admin@gmail.com',NULL,NULL,5.00,0.00,5.00,0.00,4.00),('10233','cahyo.antarikso','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','CAHYO ANTARIKSO','HRD','cahyo.antarikso@gmail.com',NULL,NULL,66.00,777.00,888.00,9995.00,66677.00),('10235','TEGUH.ABADI','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','TEGUH ABADI','KEUANGAN','TEGUH.ABADI@GMAIL.COM',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('10236','AGUS.GUNAWAN','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','AGUS GUNAWAN','PAYROLL','AGUS.GUNAWAN@GMAIL.COM',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('10237','SYAMSUL.ANAM','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','SYAMSUL ANAM','FACTORY MANAGER','SYAMSUL.ANAM@GMAIL.COM',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38801','PUTRA','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','PUTRA','OPERATOR PRODUKSI','PUTRA@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38802','ADI.RIFATULLAH','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','ADI RIFATULLAH','OPERATOR PRODUKSI','ADI.RIFATULLAH@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38803','KURNIAWAN','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','KURNIAWAN','OPERATOR PRODUKSI','KURNIAWAN@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38804','BUDI','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','BUDI','OPERATOR PRODUKSI','BUDI@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38805','EKO.SETIAWAN','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','EKO SETIAWAN','OPERATOR PRODUKSI','EKO.SETIAWAN@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38806','ARIEF.ILHAM','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','ARIEF ILHAM','OPERATOR PRODUKSI','ARIEF.ILHAM@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38807','INDRA','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','INDRA','OPERATOR PRODUKSI','INDRA@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38808','RIZKI.PURNAMA','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','RIZKI PURNAMA','OPERATOR PRODUKSI','RIZKI.PURNAMA@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38809','YUSUF.MANSYUR','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','YUSUF MANSYUR','OPERATOR PRODUKSI','YUSUF.MANSYUR@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38810','FAJAR.ILAHI','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','FAJAR ILAHI','OPERATOR PRODUKSI','FAJAR.ILAHI@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38811','BAYU.SALAM','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','BAYU SALAM','OPERATOR PRODUKSI','BAYU.SALAM@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38812','NUGROHO','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','NUGROHO','OPERATOR PRODUKSI','NUGROHO@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38813','ABDUL.SALAM','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','ABDUL SALAM','OPERATOR PRODUKSI','ABDUL.SALAM@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38814','SETIWAN','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','SETIWAN','OPERATOR PRODUKSI','SETIWAN@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38815','RISKI','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','RISKI','OPERATOR PRODUKSI','RISKI@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38816','BAGUS','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','BAGUS','OPERATOR PRODUKSI','BAGUS@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38817','HIDAYAT','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','HIDAYAT','OPERATOR PRODUKSI','HIDAYAT@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL),('38818','JIMMY','$2y$12$2NuTHvJx2W6BY33LfssqGOJldmSmY1wSFjYRtnbCVJfqOUGEnMfY6','JIMMY','OPERATOR PRODUKSI','JIMMY@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `sys_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_absensi`
--

DROP TABLE IF EXISTS `tb_absensi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_absensi` (
  `nik` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `masuk` time DEFAULT NULL,
  `keluar` time DEFAULT NULL,
  PRIMARY KEY (`nik`,`tanggal`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_absensi`
--

LOCK TABLES `tb_absensi` WRITE;
/*!40000 ALTER TABLE `tb_absensi` DISABLE KEYS */;
INSERT INTO `tb_absensi` VALUES ('38801','2018-08-25','07:45:00','16:45:00'),('38801','2018-10-25','07:45:00','16:45:00'),('38802','2018-08-25','07:45:00','16:45:00'),('38802','2018-10-25','07:45:00','16:45:00'),('38803','2018-08-25','07:45:00','16:45:00'),('38803','2018-10-25','07:45:00','16:45:00'),('38804','2018-08-25','07:45:00','16:45:00'),('38804','2018-10-25','07:45:00','16:45:00'),('38805','2018-08-25','07:45:00','16:45:00'),('38805','2018-10-25','07:45:00','16:45:00'),('38806','2018-08-25','07:45:00','16:45:00'),('38806','2018-10-25','07:45:00','16:45:00'),('38807','2018-08-25','07:45:00','16:45:00'),('38807','2018-10-25','07:45:00','16:45:00'),('38808','2018-08-25','07:45:00','16:45:00'),('38808','2018-10-25','07:45:00','16:45:00'),('38809','2018-08-25','07:45:00','16:45:00'),('38809','2018-10-25','07:45:00','16:45:00'),('38810','2018-08-25','07:45:00','16:45:00'),('38810','2018-10-25','07:45:00','16:45:00'),('38811','2018-08-25','07:45:00','16:45:00'),('38811','2018-10-25','07:45:00','16:45:00'),('38812','2018-08-25','07:45:00','16:45:00'),('38812','2018-10-25','07:45:00','16:45:00'),('38813','2018-08-25','07:45:00','16:45:00'),('38813','2018-10-25','07:45:00','16:45:00'),('38814','2018-08-25','07:45:00','16:45:00'),('38814','2018-10-25','07:45:00','16:45:00'),('38815','2018-08-25','07:45:00','16:45:00'),('38815','2018-10-25','07:45:00','16:45:00'),('38816','2018-08-25','07:45:00','16:45:00'),('38816','2018-10-25','07:45:00','16:45:00'),('38817','2018-08-25','07:45:00','16:45:00'),('38817','2018-10-25','07:45:00','16:45:00'),('38818','2018-08-25','07:45:00','16:45:00'),('38818','2018-10-25','07:45:00','16:45:00');
/*!40000 ALTER TABLE `tb_absensi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_lembur`
--

DROP TABLE IF EXISTS `tb_lembur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_lembur` (
  `nik` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `masuk` time DEFAULT NULL,
  `keluar` time DEFAULT NULL,
  `approv` char(1) DEFAULT NULL,
  `nik_approv` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`nik`,`tanggal`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lembur`
--

LOCK TABLES `tb_lembur` WRITE;
/*!40000 ALTER TABLE `tb_lembur` DISABLE KEYS */;
INSERT INTO `tb_lembur` VALUES ('10232','2018-10-18','18:00:00','23:55:00',NULL,NULL,NULL,NULL),('10232','2018-10-24','18:00:00','23:55:00',NULL,NULL,NULL,NULL),('10232','2018-10-25','17:54:00','17:55:00',NULL,NULL,'2018-10-22 18:56:00','2018-10-22 18:56:00'),('10232','2018-10-28','09:46:00','20:46:00',NULL,NULL,'2018-10-22 16:49:25','2018-10-22 16:49:25'),('10233','2018-10-17','18:00:00','23:00:00',NULL,NULL,NULL,NULL),('10233','2018-10-25','17:54:00','17:55:00',NULL,NULL,'2018-10-22 18:56:00','2018-10-22 18:56:00'),('10235','2018-10-25','17:54:00','17:55:00',NULL,NULL,'2018-10-22 18:56:00','2018-10-22 18:56:00'),('10236','2018-10-25','17:54:00','17:55:00',NULL,NULL,'2018-10-22 18:56:00','2018-10-22 18:56:00'),('10237','2018-10-25','17:54:00','17:55:00',NULL,NULL,'2018-10-22 18:56:00','2018-10-22 18:56:00'),('38801','2018-10-17','18:00:00','23:00:00',NULL,NULL,NULL,NULL),('38801','2018-10-25','17:54:00','17:55:00',NULL,NULL,'2018-10-22 18:56:00','2018-10-22 18:56:00'),('38802','2018-10-17','18:00:00','23:00:00',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tb_lembur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_lembur_temp`
--

DROP TABLE IF EXISTS `tb_lembur_temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_lembur_temp` (
  `nik` int(11) NOT NULL,
  PRIMARY KEY (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lembur_temp`
--

LOCK TABLES `tb_lembur_temp` WRITE;
/*!40000 ALTER TABLE `tb_lembur_temp` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_lembur_temp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'gaji'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-10-24 20:14:16
