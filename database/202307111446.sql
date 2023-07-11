-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: saloon
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.2

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

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint unsigned NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_buffered` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_service_id_foreign` (`service_id`),
  CONSTRAINT `bookings_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,2,'2023-07-11','16:00','17:00','17:10','irfan','mumtaz','irfan.mumtaz@gmail.com',NULL,NULL),(2,2,'2023-07-11','16:00','17:00','17:10','irfan','mumtaz','irfan.mumtaz@gmail.com',NULL,NULL),(3,2,'2023-07-11','16:00','17:00','17:10','irfan','mumtaz','irfan.mumtaz@gmail.com',NULL,NULL),(4,1,'2023-07-13','18:10','18:40','18:45','irfan','mumtaz','irfan.mumtaz@gmail.com',NULL,NULL),(5,1,'2023-07-11','18:10','18:40','18:45','irfan','mumtaz','irfan.mumtaz@gmail.com',NULL,NULL),(6,1,'2023-07-11','18:10','18:40','18:45','irfan','mumtaz','irfan.mumtaz@gmail.com',NULL,NULL),(7,1,'2023-07-11','18:10','18:40','18:45','irfan','mumtaz','irfan.mumtaz@gmail.com',NULL,NULL),(8,1,'2023-07-11','18:20','18:50','18:55','irfan','mumtaz','irfan.mumtaz@gmail.com',NULL,NULL),(9,1,'2023-07-11','18:20','18:50','18:55','irfan','mumtaz','irfan.mumtaz@gmail.com',NULL,NULL),(10,1,'2023-07-11','18:20','18:50','18:55','irfan','mumtaz','irfan.mumtaz@gmail.com',NULL,NULL),(11,1,'2023-07-11','18:30','19:00','19:05','irfan','mumtaz','irfan.mumtaz@gmail.com',NULL,NULL);
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1),(2,'2023_07_10_131521_create_services_table',1),(3,'2023_07_10_131537_create_service_availables_table',1),(4,'2023_07_10_131548_create_service_unavailables_table',1),(6,'2023_07_11_035414_create_bookings_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_availables`
--

DROP TABLE IF EXISTS `service_availables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_availables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `service_id` bigint unsigned NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_availables_service_id_foreign` (`service_id`),
  CONSTRAINT `service_availables_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_availables`
--

LOCK TABLES `service_availables` WRITE;
/*!40000 ALTER TABLE `service_availables` DISABLE KEYS */;
INSERT INTO `service_availables` VALUES (1,1,NULL,'mon','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(2,1,NULL,'tue','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(3,1,NULL,'wed','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(4,1,NULL,'thu','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(5,1,NULL,'fri','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(6,1,NULL,'sat','10:00','22:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(7,2,NULL,'mon','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(8,2,NULL,'tue','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(9,2,NULL,'wed','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(10,2,NULL,'thu','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(11,2,NULL,'fri','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(12,2,NULL,'sat','10:00','22:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(13,3,NULL,'mon','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(14,3,NULL,'tue','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(15,3,NULL,'wed','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(16,3,NULL,'thu','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(17,3,NULL,'fri','08:00','20:00','2023-07-10 13:46:24','2023-07-10 13:46:24'),(18,3,NULL,'sat','10:00','22:00','2023-07-10 13:46:24','2023-07-10 13:46:24');
/*!40000 ALTER TABLE `service_availables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_unavailables`
--

DROP TABLE IF EXISTS `service_unavailables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `service_unavailables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time_end` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_unavailables`
--

LOCK TABLES `service_unavailables` WRITE;
/*!40000 ALTER TABLE `service_unavailables` DISABLE KEYS */;
INSERT INTO `service_unavailables` VALUES (1,NULL,'mon','12:00','13:00','Lunch Break','2023-07-10 14:33:57','2023-07-10 14:33:57'),(2,NULL,'tue','12:00','13:00','Lunch Break','2023-07-10 14:33:57','2023-07-10 14:33:57'),(3,NULL,'wed','12:00','13:00','Lunch Break','2023-07-10 14:33:57','2023-07-10 14:33:57'),(4,NULL,'thu','12:00','13:00','Lunch Break','2023-07-10 14:33:57','2023-07-10 14:33:57'),(5,NULL,'fri','12:00','13:00','Lunch Break','2023-07-10 14:33:57','2023-07-10 14:33:57'),(6,NULL,'sat','12:00','13:00','Lunch Break','2023-07-10 14:33:57','2023-07-10 14:33:57'),(7,NULL,'mon','15:00','16:00','Cleaning Break','2023-07-10 14:33:57','2023-07-10 14:33:57'),(8,NULL,'tue','15:00','16:00','Cleaning Break','2023-07-10 14:33:57','2023-07-10 14:33:57'),(9,NULL,'wed','15:00','16:00','Cleaning Break','2023-07-10 14:33:57','2023-07-10 14:33:57'),(10,NULL,'thu','15:00','16:00','Cleaning Break','2023-07-10 14:33:57','2023-07-10 14:33:57'),(11,NULL,'fri','15:00','16:00','Cleaning Break','2023-07-10 14:33:57','2023-07-10 14:33:57'),(12,NULL,'sat','15:00','16:00','Cleaning Break','2023-07-10 14:33:57','2023-07-10 14:33:57'),(13,'2023-07-12',NULL,'08:00','20:00','Public Holiday','2023-07-10 14:33:57','2023-07-10 14:33:57'),(14,'2023-07-13',NULL,'08:00','12:00','Public Holiday','2023-07-10 14:33:57','2023-07-10 14:33:57'),(15,'2023-07-14',NULL,'12:00','20:00','Public Holiday','2023-07-10 14:33:57','2023-07-10 14:33:57');
/*!40000 ALTER TABLE `service_unavailables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration_minutes` int NOT NULL,
  `capacity` int NOT NULL,
  `sloting_minutes` int NOT NULL,
  `sloting_break` int NOT NULL,
  `booking_capacity_days` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Men Hair Cutting',30,3,10,5,7,'2023-07-10 08:45:39','2023-07-10 08:45:39'),(2,'Women Hair Cutting',60,3,60,10,7,'2023-07-10 08:45:39','2023-07-10 08:45:39'),(3,'Hair Coloring',120,3,60,15,7,'2023-07-10 08:45:39','2023-07-10 08:45:39');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'saloon'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-11 14:46:22
