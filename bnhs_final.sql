-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: bnhs_final
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.31-MariaDB

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
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `acc_id` int(13) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `acc_status` enum('Active','Deactivated') NOT NULL,
  `acc_type` enum('Admin','Faculty','Student','Parent','Treasurer') NOT NULL,
  `acc_details` enum('New','Old') NOT NULL DEFAULT 'New',
  `timestamp_acc` datetime NOT NULL,
  PRIMARY KEY (`acc_id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
INSERT INTO `accounts` VALUES (1,'philipsalvador01','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Admin','New','0000-00-00 00:00:00'),(2,'gloriarosario02','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Faculty','New','0000-00-00 00:00:00'),(3,'johnmarkdelacruz03','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Student','New','0000-00-00 00:00:00'),(4,'josephinedelacruz04','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Parent','New','0000-00-00 00:00:00'),(5,'marlynfernandez05','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Treasurer','New','0000-00-00 00:00:00'),(6,'valeriepe06','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Student','New','0000-00-00 00:00:00'),(7,'adrianbasangan07','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Student','New','0000-00-00 00:00:00'),(8,'cassiemondragon08','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Student','New','0000-00-00 00:00:00'),(9,'luzvimindamanzano09','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Parent','New','0000-00-00 00:00:00'),(10,'magdalenabasangan10','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Parent','New','0000-00-00 00:00:00'),(11,'rominamondragon11','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Parent','New','0000-00-00 00:00:00'),(12,'teresitamorante12','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Faculty','New','0000-00-00 00:00:00'),(13,'gladysnarciso13','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Faculty','New','0000-00-00 00:00:00'),(14,'alexanderpatacsil14','$2y$10$OJsocyOeEr8YtDSPMtlT2eJ.Eq.qvrtABuTJwH2EG9fmr9qbrm17W','Active','Faculty','New','0000-00-00 00:00:00'),(124,'MAGalatcha124','$2y$10$nVgjj0IGOZEQyRx6KDSrf.9IGDLqaoVGAm2gLvAxNmnmj57kW43MG','Active','Student','New','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admann`
--

DROP TABLE IF EXISTS `admann`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admann` (
  `adminn_id` int(11) NOT NULL,
  `annn_id` int(13) NOT NULL,
  PRIMARY KEY (`adminn_id`,`annn_id`),
  KEY `annn_id_idx` (`annn_id`),
  CONSTRAINT `adminn_id` FOREIGN KEY (`adminn_id`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `annn_id` FOREIGN KEY (`annn_id`) REFERENCES `announcements` (`ann_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admann`
--

LOCK TABLES `admann` WRITE;
/*!40000 ALTER TABLE `admann` DISABLE KEYS */;
/*!40000 ALTER TABLE `admann` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `adm_fname` varchar(45) NOT NULL,
  `adm_lname` varchar(45) NOT NULL,
  `adm_midname` varchar(45) NOT NULL,
  `acc_admid` int(13) NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `acc_admid` (`acc_admid`),
  CONSTRAINT `acc_admid` FOREIGN KEY (`acc_admid`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `ann_id` int(13) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `date_start` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post` varchar(5000) COLLATE utf8_bin DEFAULT NULL,
  `view_lim` set('0','1','2','3','4') COLLATE utf8_bin NOT NULL,
  `attachment` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `timestamp_ann` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_adminid` int(13) DEFAULT NULL,
  `post_facid` int(13) DEFAULT NULL,
  `gr_sec` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ann_id`),
  KEY `post_adminid` (`post_adminid`),
  KEY `post_facid` (`post_facid`),
  CONSTRAINT `post_adminid` FOREIGN KEY (`post_adminid`) REFERENCES `admin` (`admin_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_facid` FOREIGN KEY (`post_facid`) REFERENCES `faculty` (`fac_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance` (
  `att_id` int(13) NOT NULL AUTO_INCREMENT,
  `att_date` date NOT NULL,
  `remarks` enum('Late','Absent') COLLATE utf8_bin NOT NULL,
  `timestamp_att` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stud_ida` int(12) NOT NULL,
  `fac_idb` int(13) NOT NULL,
  `subjatt_id` int(12) NOT NULL,
  PRIMARY KEY (`att_id`),
  KEY `fac_idb` (`fac_idb`),
  KEY `subjatt_id` (`subjatt_id`),
  KEY `stud_ida` (`stud_ida`),
  CONSTRAINT `fac_idb` FOREIGN KEY (`fac_idb`) REFERENCES `faculty` (`fac_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stud_ida` FOREIGN KEY (`stud_ida`) REFERENCES `student` (`stud_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subjatt_id` FOREIGN KEY (`subjatt_id`) REFERENCES `subject` (`subj_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `balance`
--

DROP TABLE IF EXISTS `balance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `balance` (
  `bal_id` int(13) NOT NULL AUTO_INCREMENT,
  `misc_fee` double NOT NULL,
  `bal_amt` double NOT NULL,
  `bal_status` enum('Cleared','Not Cleared') COLLATE utf8_bin NOT NULL,
  `stud_idb` int(12) NOT NULL,
  PRIMARY KEY (`bal_id`),
  KEY `stud_idb` (`stud_idb`),
  CONSTRAINT `stud_idb` FOREIGN KEY (`stud_idb`) REFERENCES `student` (`stud_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `balance`
--

LOCK TABLES `balance` WRITE;
/*!40000 ALTER TABLE `balance` DISABLE KEYS */;
INSERT INTO `balance` VALUES (1,1350,1350,'Not Cleared',1),(2,1350,1350,'Not Cleared',2),(3,1350,1350,'Not Cleared',3),(4,1350,1350,'Not Cleared',4);
/*!40000 ALTER TABLE `balance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `balpay`
--

DROP TABLE IF EXISTS `balpay`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `balpay` (
  `bal_ida` int(13) NOT NULL,
  `pay_ida` int(13) NOT NULL,
  PRIMARY KEY (`bal_ida`,`pay_ida`),
  KEY `pay_ida_idx` (`pay_ida`),
  CONSTRAINT `bal_ida` FOREIGN KEY (`bal_ida`) REFERENCES `balance` (`bal_id`) ON UPDATE CASCADE,
  CONSTRAINT `pay_ida` FOREIGN KEY (`pay_ida`) REFERENCES `payment` (`pay_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `balpay`
--

LOCK TABLES `balpay` WRITE;
/*!40000 ALTER TABLE `balpay` DISABLE KEYS */;
/*!40000 ALTER TABLE `balpay` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `behavior`
--

DROP TABLE IF EXISTS `behavior`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `behavior` (
  `bhv_id` int(12) NOT NULL AUTO_INCREMENT,
  `bhv_grading` enum('1st','2nd','3rd','4th') NOT NULL,
  `bhv_remarks` enum('AO','SO','RO','NO') NOT NULL,
  `timestamp_behavior` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `core_values` int(12) NOT NULL,
  `stud_idy` int(12) NOT NULL,
  `fac_idx` int(12) NOT NULL,
  `sec_idx` int(12) NOT NULL,
  PRIMARY KEY (`bhv_id`),
  KEY `stud_idy` (`stud_idy`),
  KEY `sec_idx` (`sec_idx`),
  KEY `fac_idx` (`fac_idx`),
  KEY `core_values_idx` (`core_values`),
  CONSTRAINT `core_values` FOREIGN KEY (`core_values`) REFERENCES `core_values` (`cv_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fac_idx` FOREIGN KEY (`fac_idx`) REFERENCES `facsec` (`fac_idy`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sec_idx` FOREIGN KEY (`sec_idx`) REFERENCES `facsec` (`sec_idy`) ON UPDATE CASCADE,
  CONSTRAINT `stud_idy` FOREIGN KEY (`stud_idy`) REFERENCES `student` (`stud_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `behavior`
--

LOCK TABLES `behavior` WRITE;
/*!40000 ALTER TABLE `behavior` DISABLE KEYS */;
/*!40000 ALTER TABLE `behavior` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `budget_info`
--

DROP TABLE IF EXISTS `budget_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `budget_info` (
  `budget_id` int(13) NOT NULL AUTO_INCREMENT,
  `budget_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `total_amount` double NOT NULL DEFAULT '0',
  `acc_amount` double NOT NULL DEFAULT '0',
  `timestamp_binfo` datetime NOT NULL,
  PRIMARY KEY (`budget_id`),
  UNIQUE KEY `budget_name_UNIQUE` (`budget_name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `budget_info`
--

LOCK TABLES `budget_info` WRITE;
/*!40000 ALTER TABLE `budget_info` DISABLE KEYS */;
/*!40000 ALTER TABLE `budget_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `core_values`
--

DROP TABLE IF EXISTS `core_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `core_values` (
  `cv_id` int(12) NOT NULL AUTO_INCREMENT,
  `cv_name` enum('Makatao','Makadiyos','Makakalikasan','Makabansa') NOT NULL,
  `timestamp_cv` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cv_id`),
  UNIQUE KEY `cv_name_UNIQUE` (`cv_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `core_values`
--

LOCK TABLES `core_values` WRITE;
/*!40000 ALTER TABLE `core_values` DISABLE KEYS */;
INSERT INTO `core_values` VALUES (1,'Makatao','2019-04-24 05:43:55'),(2,'Makadiyos','2019-04-24 05:43:55'),(3,'Makakalikasan','2019-04-24 05:43:55'),(4,'Makabansa','2019-04-24 05:43:55');
/*!40000 ALTER TABLE `core_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facann`
--

DROP TABLE IF EXISTS `facann`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facann` (
  `fac_idb` int(13) NOT NULL,
  `ann_ida` int(13) NOT NULL,
  PRIMARY KEY (`fac_idb`,`ann_ida`),
  KEY `ann_ida_idx` (`ann_ida`),
  CONSTRAINT `ann_ida` FOREIGN KEY (`ann_ida`) REFERENCES `announcements` (`ann_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fa_idb` FOREIGN KEY (`fac_idb`) REFERENCES `faculty` (`fac_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facann`
--

LOCK TABLES `facann` WRITE;
/*!40000 ALTER TABLE `facann` DISABLE KEYS */;
/*!40000 ALTER TABLE `facann` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `facsec`
--

DROP TABLE IF EXISTS `facsec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `facsec` (
  `fac_idy` int(12) NOT NULL,
  `sec_idy` int(12) NOT NULL,
  PRIMARY KEY (`fac_idy`,`sec_idy`),
  KEY `facc_idy` (`fac_idy`),
  KEY `sec_idy_idx` (`sec_idy`),
  CONSTRAINT `fac_idy` FOREIGN KEY (`fac_idy`) REFERENCES `schedsubj` (`fw_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sec_idy` FOREIGN KEY (`sec_idy`) REFERENCES `schedsubj` (`sw_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `facsec`
--

LOCK TABLES `facsec` WRITE;
/*!40000 ALTER TABLE `facsec` DISABLE KEYS */;
/*!40000 ALTER TABLE `facsec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty` (
  `fac_id` int(13) NOT NULL AUTO_INCREMENT,
  `fac_no` varchar(15) COLLATE utf8_bin NOT NULL,
  `fac_fname` varchar(45) COLLATE utf8_bin NOT NULL,
  `fac_lname` varchar(45) COLLATE utf8_bin NOT NULL,
  `fac_midname` varchar(45) COLLATE utf8_bin NOT NULL,
  `fac_dept` enum('Filipino','Math','MAPEH','Science','AP','English','TLE','Values') COLLATE utf8_bin NOT NULL,
  `fac_adviser` enum('Yes','No') COLLATE utf8_bin NOT NULL DEFAULT 'No',
  `timestamp_fac` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sec_privilege` enum('Yes','No') COLLATE utf8_bin NOT NULL DEFAULT 'No',
  `acc_idz` int(13) NOT NULL,
  PRIMARY KEY (`fac_id`),
  UNIQUE KEY `fac_no_UNIQUE` (`fac_no`),
  KEY `acc_idz` (`acc_idz`),
  CONSTRAINT `acc_idz` FOREIGN KEY (`acc_idz`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty`
--

LOCK TABLES `faculty` WRITE;
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
INSERT INTO `faculty` VALUES (1,'1','Gloria','Rosario','Valencia','Math','Yes','2019-04-21 05:22:27','Yes',2),(2,'2','Teresita','Morante','Galvez','Science','Yes','2019-04-25 09:16:09','No',12),(3,'3','Gladys','Narciso','Culati','MAPEH','Yes','2019-04-25 09:16:09','No',13),(4,'4','Alexander','Patacsil','Adamo','English','Yes','2019-04-25 09:16:09','No',14);
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grades` (
  `grade_id` int(12) NOT NULL AUTO_INCREMENT,
  `grade` int(11) DEFAULT NULL,
  `grading` enum('1st','2nd','3rd','4th') COLLATE utf8_bin NOT NULL,
  `remarks` varchar(100) COLLATE utf8_bin NOT NULL,
  `timestamp_grades` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `studd_id` int(12) NOT NULL,
  `facd_id` int(12) NOT NULL,
  `secd_id` int(12) NOT NULL,
  `subj_ide` int(12) NOT NULL,
  PRIMARY KEY (`grade_id`),
  KEY `facd_id` (`facd_id`),
  KEY `subj_ide` (`subj_ide`),
  KEY `studd_id` (`studd_id`),
  KEY `secd_id_idx` (`secd_id`),
  CONSTRAINT `facd_id` FOREIGN KEY (`facd_id`) REFERENCES `facsec` (`fac_idy`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `secd_id` FOREIGN KEY (`secd_id`) REFERENCES `facsec` (`sec_idy`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `studd_id` FOREIGN KEY (`studd_id`) REFERENCES `student` (`stud_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `subj_ide` FOREIGN KEY (`subj_ide`) REFERENCES `subject` (`subj_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grades`
--

LOCK TABLES `grades` WRITE;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;
/*!40000 ALTER TABLE `grades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guardian`
--

DROP TABLE IF EXISTS `guardian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guardian` (
  `guar_id` int(11) NOT NULL AUTO_INCREMENT,
  `guar_fname` varchar(45) COLLATE utf8_bin NOT NULL,
  `guar_lname` varchar(45) COLLATE utf8_bin NOT NULL,
  `guar_midname` varchar(45) COLLATE utf8_bin NOT NULL,
  `guar_address` varchar(100) COLLATE utf8_bin NOT NULL,
  `guar_mobno` varchar(11) COLLATE utf8_bin NOT NULL,
  `guar_telno` varchar(11) COLLATE utf8_bin DEFAULT NULL,
  `timestamp_guar` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `acc_idx` int(13) NOT NULL,
  PRIMARY KEY (`guar_id`),
  KEY `acc_idx` (`acc_idx`),
  CONSTRAINT `acc_idx` FOREIGN KEY (`acc_idx`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guardian`
--

LOCK TABLES `guardian` WRITE;
/*!40000 ALTER TABLE `guardian` DISABLE KEYS */;
INSERT INTO `guardian` VALUES (1,'Josephine','Dela Cruz','Pagar','Bakakeng Norte Baguio City','09123456789',NULL,'0000-00-00 00:00:00',4),(2,'Luzviminda','Manzano','Cruz','Bakakeng Norte Baguio City','09502361478',NULL,'0000-00-00 00:00:00',9),(3,'Magdalena','Basangan','Jutie','Bakakeng Norte Baguio City','09236589741',NULL,'0000-00-00 00:00:00',10),(4,'Romina','Mondragon','Bautista','Bakakeng Norte Baguio City','09265987562',NULL,'0000-00-00 00:00:00',11);
/*!40000 ALTER TABLE `guardian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `log_id` int(12) NOT NULL AUTO_INCREMENT,
  `log_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `log_event` enum('Insert','Update','Delete','Reset') NOT NULL,
  `log_desc` varchar(300) NOT NULL,
  `user_id` int(13) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=383 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (381,'2019-04-25 03:29:14','Insert','Created an account for a student.',2),(382,'2019-04-25 03:29:15','Insert','Enrolled Mitch A. Galatcha',2);
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `pay_id` int(12) NOT NULL AUTO_INCREMENT,
  `pay_amt` double NOT NULL,
  `remain_bal` double NOT NULL,
  `pay_date` datetime NOT NULL,
  `orno` varchar(10) COLLATE utf8_bin NOT NULL,
  `timestamp_pm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `balb_id` int(12) NOT NULL,
  `budg_ida` int(12) NOT NULL,
  PRIMARY KEY (`pay_id`),
  KEY `budg_ida` (`budg_ida`),
  KEY `balb_id` (`balb_id`),
  CONSTRAINT `balb_id` FOREIGN KEY (`balb_id`) REFERENCES `balance` (`bal_id`) ON UPDATE CASCADE,
  CONSTRAINT `budg_ida` FOREIGN KEY (`budg_ida`) REFERENCES `budget_info` (`budget_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rank`
--

DROP TABLE IF EXISTS `rank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rank` (
  `rank_id` int(12) NOT NULL AUTO_INCREMENT,
  `average` float NOT NULL,
  `rank` varchar(45) NOT NULL,
  `gr_level` enum('7','8','9','10') NOT NULL,
  `stud_idf` int(12) NOT NULL,
  PRIMARY KEY (`rank_id`),
  KEY `stud_idf` (`stud_idf`),
  CONSTRAINT `stud_idf` FOREIGN KEY (`stud_idf`) REFERENCES `student` (`stud_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rank`
--

LOCK TABLES `rank` WRITE;
/*!40000 ALTER TABLE `rank` DISABLE KEYS */;
/*!40000 ALTER TABLE `rank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedsubj`
--

DROP TABLE IF EXISTS `schedsubj`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedsubj` (
  `schedsubja_id` int(12) NOT NULL,
  `schedsubjb_id` int(12) NOT NULL,
  `day` set('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `fw_id` int(12) NOT NULL,
  `sw_id` int(12) NOT NULL,
  `timestamp_ss` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`schedsubja_id`,`schedsubjb_id`,`fw_id`,`sw_id`),
  KEY `schedsubjb_id_idx` (`schedsubjb_id`),
  KEY `schedsubja_id` (`schedsubja_id`),
  KEY `schedsubjb_id` (`schedsubjb_id`),
  KEY `fw_id_idx` (`fw_id`),
  KEY `sw_id_idx` (`sw_id`),
  CONSTRAINT `fw_id` FOREIGN KEY (`fw_id`) REFERENCES `faculty` (`fac_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `schedsubja_id` FOREIGN KEY (`schedsubja_id`) REFERENCES `schedule` (`sched_id`) ON UPDATE CASCADE,
  CONSTRAINT `schedsubjb_id` FOREIGN KEY (`schedsubjb_id`) REFERENCES `subject` (`subj_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sw_id` FOREIGN KEY (`sw_id`) REFERENCES `section` (`sec_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedsubj`
--

LOCK TABLES `schedsubj` WRITE;
/*!40000 ALTER TABLE `schedsubj` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedsubj` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule` (
  `sched_id` int(12) NOT NULL AUTO_INCREMENT,
  `sched_yrlevel` enum('7','8','9','10') COLLATE utf8_bin NOT NULL,
  `timestamp_sched` datetime NOT NULL,
  PRIMARY KEY (`sched_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `section` (
  `sec_id` int(12) NOT NULL AUTO_INCREMENT,
  `sec_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `grade_lvl` enum('7','8','9','10') COLLATE utf8_bin NOT NULL,
  `timestamp_sec` datetime NOT NULL,
  `fac_idv` int(12) DEFAULT NULL,
  PRIMARY KEY (`sec_id`),
  UNIQUE KEY `sec_name_UNIQUE` (`sec_name`),
  KEY `fac_idv` (`fac_idv`),
  CONSTRAINT `fac_idv` FOREIGN KEY (`fac_idv`) REFERENCES `faculty` (`fac_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `section`
--

LOCK TABLES `section` WRITE;
/*!40000 ALTER TABLE `section` DISABLE KEYS */;
INSERT INTO `section` VALUES (1,'Hope','7','0000-00-00 00:00:00',1),(2,'Wisdom','8','0000-00-00 00:00:00',2),(3,'Dignity','9','0000-00-00 00:00:00',3),(4,'Independence','10','0000-00-00 00:00:00',4);
/*!40000 ALTER TABLE `section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `stud_id` int(12) NOT NULL AUTO_INCREMENT,
  `stud_lrno` bigint(13) NOT NULL,
  `last_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `first_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `middle_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8_bin NOT NULL,
  `year_level` enum('7','8','9','10') COLLATE utf8_bin NOT NULL,
  `school_year` year(4) NOT NULL,
  `stud_address` varchar(100) COLLATE utf8_bin NOT NULL,
  `stud_bday` date NOT NULL,
  `mother_name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `father_name` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `nationality` varchar(45) COLLATE utf8_bin NOT NULL,
  `ethnicity` varchar(45) COLLATE utf8_bin NOT NULL,
  `year_in` year(4) NOT NULL,
  `year_out` year(4) DEFAULT NULL,
  `blood_type` enum('O','A','B','AB') COLLATE utf8_bin NOT NULL,
  `medical_stat` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `stud_status` enum('Officially Enrolled','Temporarily Enrolled','Not Enrolled','Graduated','Transferred') COLLATE utf8_bin NOT NULL,
  `curr_stat` enum('Old','New') COLLATE utf8_bin NOT NULL,
  `sec_stat` enum('Temporary','Permanent') COLLATE utf8_bin NOT NULL DEFAULT 'Permanent',
  `timestamp_stud` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `accc_id` int(13) NOT NULL,
  `secc_id` int(12) NOT NULL,
  `guar_id` int(11) NOT NULL,
  PRIMARY KEY (`stud_id`),
  UNIQUE KEY `lr_no_UNIQUE` (`stud_lrno`),
  KEY `accc_id` (`accc_id`),
  KEY `secc_id` (`secc_id`),
  KEY `guar_id_idx` (`guar_id`),
  CONSTRAINT `accc_id` FOREIGN KEY (`accc_id`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `guar_id` FOREIGN KEY (`guar_id`) REFERENCES `guardian` (`guar_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `secc_id` FOREIGN KEY (`secc_id`) REFERENCES `section` (`sec_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (1,10011001,'Dela Cruz','John Mark','Pagar','Male','7',2019,'Bakakeng Norte Baguio City','2007-04-06','Josephine P. Dela Cruz','Jasper A. Dela Cruz','Filipino','Panggalatok',2019,2001,'O','1','Temporarily Enrolled','New','Permanent','2019-04-25 06:50:46',3,1,1),(2,10011002,'Manzano','Katherine','Cruz','Female','8',2019,'Bakakeng Norte Baguio City','2006-08-19','Luzviminda C. Manzano','Mario B. Manzano','Filipino','Ilocano',2018,2001,'A',NULL,'Officially Enrolled','Old','Permanent','0000-00-00 00:00:00',6,2,2),(3,10011003,'Basangan','Adrian','Jutie','Male','9',2019,'Bakakeng Norte Baguio City','2005-12-17','Magdalena J. Basangan','Ireneo C. Basangan','Filipino','Kankanaey',2017,2001,'B','1','Officially Enrolled','Old','Permanent','2019-04-25 06:50:46',7,3,3),(4,10011004,'Mondragon','Cassie','Bautista','Female','10',2019,'Bakakeng Norte Baguio City','2004-10-02','Rominda B. Mondragon','Robert D. Mondragon','Filipino','Tagalog',2016,2001,'AB','1','Officially Enrolled','Old','Permanent','2019-04-25 06:50:46',8,4,4);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `subj_id` int(12) NOT NULL AUTO_INCREMENT,
  `subj_level` enum('7','8','9','10') COLLATE utf8_bin NOT NULL,
  `subj_dept` enum('Filipino','Math','MAPEH','Science','AP','English','TLE','Values') COLLATE utf8_bin NOT NULL,
  `subj_name` varchar(45) COLLATE utf8_bin NOT NULL,
  `timestamp_subj` datetime NOT NULL,
  PRIMARY KEY (`subj_id`),
  UNIQUE KEY `subj_name_UNIQUE` (`subj_name`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `treasurer`
--

DROP TABLE IF EXISTS `treasurer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `treasurer` (
  `tr_id` int(12) NOT NULL AUTO_INCREMENT,
  `tr_fname` varchar(45) NOT NULL,
  `tr_midname` varchar(45) NOT NULL,
  `tr_lname` varchar(45) NOT NULL,
  `tr_sy` year(4) NOT NULL,
  `acc_trid` int(13) NOT NULL,
  PRIMARY KEY (`tr_id`),
  KEY `tr_acc_idx` (`acc_trid`),
  CONSTRAINT `tr_acc` FOREIGN KEY (`acc_trid`) REFERENCES `accounts` (`acc_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `treasurer`
--

LOCK TABLES `treasurer` WRITE;
/*!40000 ALTER TABLE `treasurer` DISABLE KEYS */;
INSERT INTO `treasurer` VALUES (1,'Marlyn','Gomez','Fernandez',2019,5);
/*!40000 ALTER TABLE `treasurer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-25 17:39:57
