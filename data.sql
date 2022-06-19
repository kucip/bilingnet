-- MySQL dump 10.16  Distrib 10.1.32-MariaDB, for osx10.6 (i386)
--
-- Host: mre-2.local    Database: optima-template-v2
-- ------------------------------------------------------
-- Server version	10.1.32-MariaDB

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
-- Table structure for table `docs`
--

DROP TABLE IF EXISTS `docs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docs` (
  `did` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `compId` int(11) DEFAULT NULL,
  `dnama` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`did`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docs`
--


--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--


--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `menuId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `compId` int(11) DEFAULT NULL,
  `menuNama` varchar(100) DEFAULT NULL,
  `menuRoute` varchar(100) DEFAULT NULL,
  `menuIcon` varchar(100) DEFAULT NULL,
  `menuParent` int(11) DEFAULT NULL,
  `menuOrder` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`menuId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menuId`, `compId`, `menuNama`, `menuRoute`, `menuIcon`, `menuParent`, `menuOrder`, `created_at`, `updated_at`) VALUES (0,1,'Dashboard','dashboard','icon-display4',NULL,0,'2022-04-06 06:04:09','2022-04-06 06:04:09'),(1,1,'Setup',NULL,'icon-gear',NULL,1,'2022-03-31 02:40:22','2022-03-31 02:40:22'),(2,1,'Company','company',NULL,1,1,'2022-03-31 02:40:46','2022-03-31 02:55:08'),(3,1,'Role','role',NULL,1,2,'2022-04-04 05:15:25','2022-04-04 05:15:25'),(4,1,'Menu','menu',NULL,1,3,'2022-04-04 05:15:36','2022-04-04 05:15:36'),(5,1,'User Super','user',NULL,1,5,'2022-04-04 05:16:23','2022-04-06 07:33:00'),(6,1,'Ganti Password','gantipass',NULL,1,6,'2022-04-04 05:16:45','2022-04-06 07:36:22'),(7,1,'Role Menu','rolemenu',NULL,1,4,'2022-04-06 06:12:30','2022-04-06 06:13:35'),(8,1,'Master',NULL,'icon-database4',NULL,2,'2022-04-04 05:17:33','2022-04-04 05:17:33'),(9,1,'Bendahara','bendahara',NULL,8,1,'2022-04-04 05:17:50','2022-04-06 06:17:39'),(10,1,'COA (Chart Of Account)','coa',NULL,8,NULL,'2022-04-04 05:18:19','2022-04-06 06:17:24'),(13,1,'User Company','usercomp',NULL,1,6,'2022-04-06 07:32:45','2022-04-06 07:32:45'),(14,1,'Dokumentasi',NULL,'icon-file-text2',NULL,4,'2022-04-20 09:11:07','2022-04-20 09:11:07'),(16,1,'Docs','docs',NULL,14,1,'2022-04-20 09:15:25','2022-04-20 09:15:25'),(17,1,'Menu Level 2 Child',NULL,NULL,14,2,'2022-04-20 09:15:52','2022-04-20 09:15:52'),(18,1,'Menu Level 3','#',NULL,17,1,'2022-04-20 09:16:41','2022-04-20 09:17:08'),(19,1,'Menu Level 3 Child',NULL,NULL,17,2,'2022-04-20 09:17:01','2022-04-20 09:17:01'),(20,1,'Menu Level 4','#',NULL,19,1,'2022-04-20 09:17:29','2022-04-20 09:17:29'),(21,1,'Menu Level 4 Child',NULL,NULL,19,2,'2022-04-20 09:17:46','2022-04-20 09:17:46'),(22,1,'Menu Level 5','#',NULL,21,1,'2022-04-20 09:18:04','2022-04-20 09:18:04');

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--


--
-- Table structure for table `msbendahara`
--

DROP TABLE IF EXISTS `msbendahara`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msbendahara` (
  `bendId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `compId` int(11) DEFAULT NULL,
  `bendNama` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`bendId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msbendahara`
--

INSERT INTO `msbendahara` (`bendId`, `compId`, `bendNama`, `created_at`, `updated_at`) VALUES (4,1,'Bruce Wayne','2022-03-30 04:13:59','2022-03-30 04:13:59'),(5,1,'Tony Stark','2022-03-30 04:14:03','2022-03-30 04:14:03');

--
-- Table structure for table `mscoa`
--

DROP TABLE IF EXISTS `mscoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mscoa` (
  `coaId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `compId` int(11) DEFAULT NULL,
  `coaKode` varchar(100) DEFAULT NULL,
  `coaNama` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`coaId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mscoa`
--

INSERT INTO `mscoa` (`coaId`, `compId`, `coaKode`, `coaNama`, `created_at`, `updated_at`) VALUES (1,1,'111','Aset Lancar','2022-03-26 14:54:54','2022-03-26 14:54:54'),(2,1,'121','Aset Tetap','2022-03-26 14:55:01','2022-03-26 14:55:01'),(3,1,'201','Kewajiban','2022-03-26 14:55:22','2022-03-26 14:55:22'),(4,1,'301','Hutang','2022-03-26 14:55:29','2022-03-26 14:55:29'),(5,1,'401','Pendapatan Langganan','2022-03-26 14:56:53','2022-03-31 02:18:52'),(8,1,'404','Pendapatan Lain-Lain','2022-03-26 14:57:55','2022-03-26 14:57:55'),(9,1,'501','Belanja Listrik','2022-03-26 14:58:36','2022-03-26 14:58:36'),(11,1,'503','Pembayaran Indihome','2022-03-26 14:59:21','2022-03-26 14:59:21'),(15,1,'507','Pembelian Bahan Pasang Lainnya','2022-03-26 15:01:35','2022-03-26 15:01:35'),(16,1,'611','Penambahan Modal','2022-03-26 15:02:14','2022-03-26 15:02:14'),(17,1,'621','Pengurangan Modal','2022-03-26 15:02:58','2022-03-26 15:02:58'),(18,1,'23','sdfasdf','2022-04-04 09:35:45','2022-04-04 09:35:45'),(19,1,'324234','asdasdasdas','2022-04-04 09:35:50','2022-04-04 09:35:50'),(20,1,'34','sdfasfas','2022-04-04 09:35:55','2022-04-04 09:35:55'),(21,1,'34343','asdasdsa','2022-04-04 09:35:59','2022-04-04 09:35:59'),(22,1,'343','234234','2022-04-04 09:36:07','2022-04-04 09:36:07');

--
-- Table structure for table `mscompany`
--

DROP TABLE IF EXISTS `mscompany`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mscompany` (
  `compId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `compNama` varchar(100) DEFAULT NULL,
  `compPemilik` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`compId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mscompany`
--

INSERT INTO `mscompany` (`compId`, `compNama`, `compPemilik`, `created_at`, `updated_at`) VALUES (1,'PT. Optima Multi Sinergi','Erik Witono',NULL,'2022-03-30 04:14:53'),(16,'Wayne Enterprise, LTD','Bruce Wayne','2022-03-24 14:42:09','2022-04-06 07:50:29'),(17,'Stark Industries, INC','Tony Stark','2022-03-30 04:15:28','2022-04-06 07:50:39'),(18,'RS. Permata Hati','Pungky','2022-04-04 09:28:16','2022-04-06 07:50:47');

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--


--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`(191),`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES (17,'App\\Models\\User',5,'auth_token','3cfa08cbc2d030b910dfcb39fe30d94ff3a0030377da6bcc0cfe3941b4c10596','[\"*\"]',NULL,'2022-03-24 09:16:23','2022-03-24 09:16:23'),(18,'App\\Models\\User',6,'auth_token','85882fc1e66a4a723bcaad87974f9eaf63aab1ca457cb80001096c6e65134aff','[\"*\"]',NULL,'2022-03-24 09:49:38','2022-03-24 09:49:38'),(19,'App\\Models\\User',7,'auth_token','fc5bebea48382b6942f17114d9c75125abaf5d67b44ac0e443b6aa485c19cc27','[\"*\"]',NULL,'2022-03-24 09:51:16','2022-03-24 09:51:16'),(20,'App\\Models\\User',8,'auth_token','a44997a22c3dfd9a018b993c340983e959c81a1100d9a67517c94b4fb29b1fa7','[\"*\"]',NULL,'2022-03-24 10:14:36','2022-03-24 10:14:36'),(105,'App\\Models\\User',4,'auth_token','3300b97a199406f431b5ee87e26e5b8df6736dc69408be0df42ba01e5932f7bc','[\"*\"]',NULL,'2022-04-06 00:52:06','2022-04-06 00:52:06'),(109,'App\\Models\\User',2,'auth_token','b626dcc1646004bb5423e65c3d552611cf66bf2fc3538650e776f6745691c599','[\"*\"]',NULL,'2022-04-20 02:10:09','2022-04-20 02:10:09');

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `roleId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `compId` int(11) DEFAULT NULL,
  `roleNama` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleId`, `compId`, `roleNama`, `created_at`, `updated_at`) VALUES (1,1,'Administrator','2022-03-31 02:16:31','2022-03-31 02:16:31'),(2,1,'Pendaftaran','2022-03-31 02:17:12','2022-03-31 02:17:12'),(3,1,'Rajal','2022-03-31 02:17:27','2022-03-31 02:17:27'),(4,1,'Ranap','2022-03-31 02:17:30','2022-03-31 02:17:30'),(5,1,'Apotek','2022-03-31 02:17:33','2022-03-31 02:17:33');

--
-- Table structure for table `role_menu`
--

DROP TABLE IF EXISTS `role_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_menu` (
  `rmId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `compId` int(11) DEFAULT NULL,
  `rmRoleId` int(11) DEFAULT NULL,
  `rmMenuId` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`rmId`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`rmId`, `compId`, `rmRoleId`, `rmMenuId`, `created_at`, `updated_at`) VALUES (189,16,2,0,'2022-04-06 07:51:27','2022-04-06 07:51:27'),(190,16,2,1,'2022-04-06 07:51:27','2022-04-06 07:51:27'),(191,16,2,2,'2022-04-06 07:51:27','2022-04-06 07:51:27'),(192,16,2,3,'2022-04-06 07:51:27','2022-04-06 07:51:27'),(193,16,2,4,'2022-04-06 07:51:27','2022-04-06 07:51:27'),(194,16,2,5,'2022-04-06 07:51:27','2022-04-06 07:51:27'),(195,16,2,6,'2022-04-06 07:51:27','2022-04-06 07:51:27'),(196,16,2,7,'2022-04-06 07:51:27','2022-04-06 07:51:27'),(197,16,2,8,'2022-04-06 07:51:27','2022-04-06 07:51:27'),(198,16,2,9,'2022-04-06 07:51:27','2022-04-06 07:51:27'),(199,16,2,13,'2022-04-06 07:51:27','2022-04-06 07:51:27'),(227,1,1,0,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(228,1,1,1,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(229,1,1,2,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(230,1,1,3,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(231,1,1,4,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(232,1,1,5,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(233,1,1,6,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(234,1,1,7,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(235,1,1,8,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(236,1,1,9,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(237,1,1,10,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(238,1,1,13,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(239,1,1,14,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(240,1,1,16,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(241,1,1,17,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(242,1,1,18,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(243,1,1,19,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(244,1,1,20,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(245,1,1,21,'2022-04-20 09:18:18','2022-04-20 09:18:18'),(246,1,1,22,'2022-04-20 09:18:18','2022-04-20 09:18:18');

--
-- Table structure for table `syslog`
--

DROP TABLE IF EXISTS `syslog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `syslog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `compId` int(11) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `tabel` varchar(100) DEFAULT NULL,
  `query` varchar(100) DEFAULT NULL,
  `detail` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `syslog`
--

INSERT INTO `syslog` (`id`, `compId`, `user`, `tabel`, `query`, `detail`, `created_at`, `updated_at`) VALUES (1,1,'kucip','msbendahara','delete','{\"bendId\":9,\"compId\":1,\"bendNama\":\"asasa\",\"created_at\":\"2022-04-12T02:44:40.000000Z\",\"updated_at\":\"2022-04-12T02:44:40.000000Z\"}','2022-04-12 02:55:35','2022-04-12 02:55:35'),(2,1,'kucip','mscoa','delete','{\"coaId\":23,\"compId\":1,\"coaKode\":\"324\",\"coaNama\":\"sfsdfsdf\",\"created_at\":\"2022-04-06T14:16:30.000000Z\",\"updated_at\":\"2022-04-06T14:16:30.000000Z\"}','2022-04-12 02:55:42','2022-04-12 02:55:42'),(3,1,'kucip','mscoa','delete','{\"coaId\":22,\"compId\":1,\"coaKode\":\"343\",\"coaNama\":\"234234\",\"created_at\":\"2022-04-04T09:36:07.000000Z\",\"updated_at\":\"2022-04-04T09:36:07.000000Z\"}','2022-04-12 02:55:44','2022-04-12 02:55:44'),(4,1,'kucip','mscoa','create','{\"compId\":\"1\",\"coaKode\":\"1212\",\"coaNama\":\"asdasdas\",\"updated_at\":\"2022-04-12T02:55:51.000000Z\",\"created_at\":\"2022-04-12T02:55:51.000000Z\",\"coaId\":27}','2022-04-12 02:55:51','2022-04-12 02:55:51'),(5,1,'kucip','mscoa','update','{\"_token\":\"d6pLhwTBj5OD3tMMxCEYsQPAgdBbN1qvvK6h3a2d\",\"compId\":\"1\",\"coaKode\":\"23\",\"coaNama\":\"sdfasdf\"}','2022-04-12 02:55:56','2022-04-12 02:55:56'),(6,1,'kucip','mscoa','update','{\"_token\":\"d6pLhwTBj5OD3tMMxCEYsQPAgdBbN1qvvK6h3a2d\",\"compId\":\"1\",\"coaKode\":\"34\",\"coaNama\":\"sdfasfassd\"}','2022-04-12 02:56:00','2022-04-12 02:56:00'),(7,1,'kucip','mscompany','create','{\"compNama\":\"test\",\"compPemilik\":\"test\",\"updated_at\":\"2022-04-12T02:56:42.000000Z\",\"created_at\":\"2022-04-12T02:56:42.000000Z\",\"compId\":19}','2022-04-12 02:56:42','2022-04-12 02:56:42'),(8,1,'kucip','mscompany','update','{\"_token\":\"d6pLhwTBj5OD3tMMxCEYsQPAgdBbN1qvvK6h3a2d\",\"compNama\":\"Capsule Corp\",\"compPemilik\":\"Burma\"}','2022-04-12 02:57:00','2022-04-12 02:57:00'),(9,1,'pras','menu','create','{\"compId\":\"1\",\"menuNama\":\"Dokumentasi\",\"menuRoute\":null,\"menuIcon\":\"icon-file-text2\",\"menuOrder\":\"4\",\"menuParent\":null,\"updated_at\":\"2022-04-20T02:12:11.000000Z\",\"created_at\":\"2022-04-20T02:12:11.000000Z\",\"menuId\":15}','2022-04-20 09:12:11','2022-04-20 09:12:11'),(10,1,'pras','menu','delete','{\"menuId\":15,\"compId\":1,\"menuNama\":\"Dokumentasi\",\"menuRoute\":null,\"menuIcon\":\"icon-file-text2\",\"menuParent\":null,\"menuOrder\":4,\"created_at\":\"2022-04-20T02:12:11.000000Z\",\"updated_at\":\"2022-04-20T02:12:11.000000Z\"}','2022-04-20 09:12:17','2022-04-20 09:12:17'),(11,1,'pras','menu','create','{\"compId\":\"1\",\"menuNama\":\"Docs\",\"menuRoute\":\"docs\",\"menuIcon\":null,\"menuOrder\":\"1\",\"menuParent\":\"14\",\"updated_at\":\"2022-04-20T02:15:25.000000Z\",\"created_at\":\"2022-04-20T02:15:25.000000Z\",\"menuId\":16}','2022-04-20 09:15:25','2022-04-20 09:15:25'),(12,1,'pras','menu','create','{\"compId\":\"1\",\"menuNama\":\"Menu Level 2 Child\",\"menuRoute\":null,\"menuIcon\":null,\"menuOrder\":\"2\",\"menuParent\":\"14\",\"updated_at\":\"2022-04-20T02:15:52.000000Z\",\"created_at\":\"2022-04-20T02:15:52.000000Z\",\"menuId\":17}','2022-04-20 09:15:52','2022-04-20 09:15:52'),(13,1,'pras','menu','create','{\"compId\":\"1\",\"menuNama\":\"Menu Level 3\",\"menuRoute\":null,\"menuIcon\":null,\"menuOrder\":\"1\",\"menuParent\":\"17\",\"updated_at\":\"2022-04-20T02:16:41.000000Z\",\"created_at\":\"2022-04-20T02:16:41.000000Z\",\"menuId\":18}','2022-04-20 09:16:41','2022-04-20 09:16:41'),(14,1,'pras','menu','create','{\"compId\":\"1\",\"menuNama\":\"Menu Level 3 Child\",\"menuRoute\":null,\"menuIcon\":null,\"menuOrder\":\"2\",\"menuParent\":\"17\",\"updated_at\":\"2022-04-20T02:17:01.000000Z\",\"created_at\":\"2022-04-20T02:17:01.000000Z\",\"menuId\":19}','2022-04-20 09:17:01','2022-04-20 09:17:01'),(15,1,'pras','menu','update','{\"_token\":\"O7HRMQtruKf34jlU9Gqo4YWhzWOChCnIFgOwnOjU\",\"compId\":\"1\",\"menuNama\":\"Menu Level 3\",\"menuRoute\":\"#\",\"menuIcon\":null,\"menuOrder\":\"1\",\"menuParent\":\"17\"}','2022-04-20 09:17:08','2022-04-20 09:17:08'),(16,1,'pras','menu','create','{\"compId\":\"1\",\"menuNama\":\"Menu Level 4\",\"menuRoute\":\"#\",\"menuIcon\":null,\"menuOrder\":\"1\",\"menuParent\":\"19\",\"updated_at\":\"2022-04-20T02:17:29.000000Z\",\"created_at\":\"2022-04-20T02:17:29.000000Z\",\"menuId\":20}','2022-04-20 09:17:29','2022-04-20 09:17:29'),(17,1,'pras','menu','create','{\"compId\":\"1\",\"menuNama\":\"Menu Level 4 Child\",\"menuRoute\":null,\"menuIcon\":null,\"menuOrder\":\"2\",\"menuParent\":\"19\",\"updated_at\":\"2022-04-20T02:17:46.000000Z\",\"created_at\":\"2022-04-20T02:17:46.000000Z\",\"menuId\":21}','2022-04-20 09:17:46','2022-04-20 09:17:46'),(18,1,'pras','menu','create','{\"compId\":\"1\",\"menuNama\":\"Menu Level 5\",\"menuRoute\":\"#\",\"menuIcon\":null,\"menuOrder\":\"1\",\"menuParent\":\"21\",\"updated_at\":\"2022-04-20T02:18:04.000000Z\",\"created_at\":\"2022-04-20T02:18:04.000000Z\",\"menuId\":22}','2022-04-20 09:18:04','2022-04-20 09:18:04');

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `compId` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `compId`, `role`, `created_at`, `updated_at`) VALUES (1,'kucip','kucip@gmail.com',NULL,'$2y$10$PWbTyDAIRFQ3DrLVKOg7v.BrlXoUAqwx9QUS10rUzQpxBSJF/NSM6',NULL,1,1,'2022-03-08 03:11:48','2022-04-05 20:29:13'),(2,'pras','pras@gmail.com',NULL,'$2y$10$uBatLnuZ37l7Vbu3DOH4Ku8i1kqwvcr0VfkUV96bFJpgpvbX80hp6',NULL,1,1,'2022-03-26 01:16:36','2022-04-20 02:10:02');
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-04-21  9:51:27
