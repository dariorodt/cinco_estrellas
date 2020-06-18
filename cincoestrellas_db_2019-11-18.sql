-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: CincoEstrellasMain
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.16.04.1

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
-- Table structure for table `admin_profiles`
--

DROP TABLE IF EXISTS `admin_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(10) unsigned NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_profiles_admin_id_foreign` (`admin_id`),
  CONSTRAINT `admin_profiles_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_profiles`
--

LOCK TABLES `admin_profiles` WRITE;
/*!40000 ALTER TABLE `admin_profiles` DISABLE KEYS */;
INSERT INTO `admin_profiles` VALUES (1,1,'active','Super Admin','images/super-admin.jpg','2019-11-18 02:10:26','2019-11-18 02:10:26');
/*!40000 ALTER TABLE `admin_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`),
  KEY `admins_role_id_foreign` (`role_id`),
  CONSTRAINT `admins_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,1,'SuperAdmin','superadmin@cincoestrellas.cl','2019-11-18 02:10:26','$2y$10$1HNkP0qfTMYTvnGzlMsXO.5z.97aBeUmfnHOYCC83ggYi00oqG03y',NULL,NULL,NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` int(10) unsigned NOT NULL,
  `worker_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `applications_job_id_foreign` (`job_id`),
  KEY `applications_worker_id_foreign` (`worker_id`),
  CONSTRAINT `applications_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `service_orders` (`id`),
  CONSTRAINT `applications_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (1,1,4,'2019-11-18 02:10:27','2019-11-18 02:10:27'),(2,15,3,'2019-11-18 02:10:27','2019-11-18 02:10:27'),(3,12,1,'2019-11-18 02:10:27','2019-11-18 02:10:27'),(4,3,1,'2019-11-18 02:10:27','2019-11-18 02:10:27'),(5,15,5,'2019-11-18 02:10:27','2019-11-18 02:10:27'),(6,1,2,'2019-11-18 02:10:27','2019-11-18 02:10:27'),(7,3,7,'2019-11-18 02:10:27','2019-11-18 02:10:27');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_profiles`
--

DROP TABLE IF EXISTS `client_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rut` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comunity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `client_profiles_rut_unique` (`rut`),
  KEY `client_profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `client_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_profiles`
--

LOCK TABLES `client_profiles` WRITE;
/*!40000 ALTER TABLE `client_profiles` DISABLE KEYS */;
INSERT INTO `client_profiles` VALUES (1,1,'active','José','Martínez','7818123-0','1997-01-23','564446365555','male','Chile','Lampa','Santiago','Las Américas','98','Dispuesto y bien plantado','images/clients/1569189410.jpg',NULL,NULL),(2,2,'active','Victor','Contreras','24585256-8','1995-09-26','564446361346','male','Chile','Pedro Aguirre Cerda','Santiago','Arismendi','489','Soy libre. Voy donde me lleve el viento','images/clients/1569190014.jpg',NULL,NULL),(3,3,'active','Teresa','Medina','12211921-1','1993-07-07','564623238855','female','Chile','San Pedro','Santiago','Felipe Torres','635','Dulce como la miel, intensa como el sol','images/clients/1569190192.jpg',NULL,NULL),(4,4,'active','Miguel','Castaños','10154404-4','1987-09-22','565556354859','male','Chile','Paine','Santiago','Santa Fe','78','Cuando veas las bardas de tu vecino arder pon las tuyas en remojo','images/clients/1569190661.jpg',NULL,NULL),(5,5,'active','Gabriela','Lara','23701213-5','1993-02-26','569891636688','female','Chile','La Cisterna','Santiago','Manuel Regente','556','Soy fuerte. Valiente. Enfrento la vida con optimismo y valor','images/clients/1569191203.jpg',NULL,NULL),(6,6,'active','Daniela','Rodríguez','7855855-5','1997-08-06','562323499944','female','Chile','Vitacura','Santiago','Los Jardines','565','Vivo la vida a toda velocidad','images/clients/1569191382.jpg',NULL,NULL),(7,7,'active','Gerardo','Vélez','22516239-5','1997-05-14','569884897152','male','Chile','Til til','Santiago','Colina','705','Yoga todas las noches. Deportes los fines de semana','images/clients/1569191558.jpg',NULL,NULL);
/*!40000 ALTER TABLE `client_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_ratings`
--

DROP TABLE IF EXISTS `client_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_order_id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `sender_id` int(10) unsigned NOT NULL,
  `stars` decimal(2,1) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_ratings_service_order_id_foreign` (`service_order_id`),
  KEY `client_ratings_client_id_foreign` (`client_id`),
  KEY `client_ratings_sender_id_foreign` (`sender_id`),
  CONSTRAINT `client_ratings_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`),
  CONSTRAINT `client_ratings_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `workers` (`id`),
  CONSTRAINT `client_ratings_service_order_id_foreign` FOREIGN KEY (`service_order_id`) REFERENCES `service_orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_ratings`
--

LOCK TABLES `client_ratings` WRITE;
/*!40000 ALTER TABLE `client_ratings` DISABLE KEYS */;
INSERT INTO `client_ratings` VALUES (1,1,1,3,4.0,'Muy respetuoso y atento.',NULL,NULL),(2,3,1,5,3.0,'Muy exigente',NULL,NULL),(3,15,1,7,4.0,'Cliente muy amable y cordial. Lo recomiendo.',NULL,NULL),(4,14,2,3,5.0,'Lo recomiento',NULL,NULL),(5,17,2,6,5.0,'Cliente muy recomendable.',NULL,NULL),(6,2,3,1,3.0,'Amable pero indeciso',NULL,NULL),(7,8,3,4,1.0,'No pudimos ponernos de acuerdo',NULL,NULL),(8,19,3,2,2.0,'Muy malgeniado',NULL,NULL),(9,4,4,7,3.0,'Bueno, amable',NULL,NULL),(10,12,4,2,5.0,'Muy educado y amable.',NULL,NULL),(11,18,4,6,2.0,'No expresa bien lo que requiere',NULL,NULL),(12,5,5,5,4.0,'Muy buen cliente',NULL,NULL),(13,7,5,1,4.0,'Muy atento y considerado',NULL,NULL),(14,11,5,3,5.0,'Responsable y puntual',NULL,NULL),(15,6,6,2,4.0,'Atento. Trata bien al trabajador',NULL,NULL),(16,10,6,5,3.0,'Atento',NULL,NULL),(17,13,6,4,4.0,'Me trató muy bien. Muy consciente',NULL,NULL),(18,9,7,6,5.0,'Muy amable',NULL,NULL),(19,16,7,5,4.0,'Buen trato',NULL,NULL);
/*!40000 ALTER TABLE `client_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companies_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_profiles`
--

DROP TABLE IF EXISTS `company_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_profiles_user_id_foreign` (`user_id`),
  CONSTRAINT `company_profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_profiles`
--

LOCK TABLES `company_profiles` WRITE;
/*!40000 ALTER TABLE `company_profiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_ratings`
--

DROP TABLE IF EXISTS `company_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned NOT NULL,
  `sender_id` int(10) unsigned NOT NULL,
  `stars` tinyint(4) NOT NULL,
  `coment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company_ratings_company_id_foreign` (`company_id`),
  KEY `company_ratings_sender_id_foreign` (`sender_id`),
  CONSTRAINT `company_ratings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  CONSTRAINT `company_ratings_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_ratings`
--

LOCK TABLES `company_ratings` WRITE;
/*!40000 ALTER TABLE `company_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_user_id_foreign` (`user_id`),
  CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `job_id` int(10) unsigned NOT NULL,
  `worker_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `sender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_job_id_foreign` (`job_id`),
  KEY `messages_user_id_foreign` (`user_id`),
  KEY `messages_worker_id_foreign` (`worker_id`),
  CONSTRAINT `messages_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `service_orders` (`id`),
  CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `messages_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,1,4,1,'client','Hola ¿qué tal?',NULL,NULL),(2,1,4,1,'worker','Hola. Bien todo ¿cómo está usted?',NULL,NULL);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_08_13_095659_create_roles_table',1),(2,'2019_08_13_100000_create_users_table',1),(3,'2019_08_13_100001_create_password_resets_table',1),(4,'2019_08_13_103551_create_workers_table',1),(5,'2019_08_13_103650_create_client_profiles_table',1),(6,'2019_08_13_103650_create_companies_table',1),(7,'2019_08_13_103715_create_admins_table',1),(8,'2019_08_13_103720_create_admin_profiles_table',1),(9,'2019_08_13_103747_create_services_table',1),(10,'2019_08_13_103748_create_service_orders_table',1),(11,'2019_08_13_103750_create_client_ratings_table',1),(12,'2019_08_15_023526_create_company_profiles_table',1),(13,'2019_08_15_111302_create_company_ratings_table',1),(14,'2019_08_15_111657_create_worker_profiles_table',1),(15,'2019_08_15_112300_create_worker_ratings_table',1),(16,'2019_08_15_114105_create_documents_table',1),(17,'2019_09_20_105846_create_service_worker_table',1),(18,'2019_10_01_130723_create_messages_table',1),(19,'2019_10_04_123139_create_worker_documents_table',1),(20,'2019_10_04_143828_create_applications_table',1),(21,'2019_10_13_124601_create_notifications_table',1),(22,'2019_10_14_120809_create_payments_table',1),(23,'2019_11_08_133904_create_worker_payments_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `worker_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `token_ws` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authorization_code` int(11) NOT NULL,
  `payment_type` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shares_amount` decimal(12,2) NOT NULL,
  `shares_number` tinyint(4) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `card_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_expire_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `worker_paid` tinyint(1) NOT NULL DEFAULT '0',
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_user_id_foreign` (`user_id`),
  KEY `payments_worker_id_foreign` (`worker_id`),
  KEY `payments_order_id_foreign` (`order_id`),
  CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `service_orders` (`id`),
  CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `payments_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_level` tinyint(3) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'SuperAdmin',29,NULL,NULL),(2,'Admin',28,NULL,NULL),(3,'Supporter',12,NULL,NULL),(4,'Operator',11,NULL,NULL),(5,'Finanzas',21,NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_orders`
--

DROP TABLE IF EXISTS `service_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `worker_id` int(10) unsigned DEFAULT NULL,
  `admin_id` int(10) unsigned DEFAULT NULL,
  `service_id` int(10) unsigned DEFAULT NULL,
  `status` enum('open','active','closed','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'open',
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL,
  `starting_time` time NOT NULL,
  `ending_time` time NOT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comunity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aditional_info` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_orders_user_id_foreign` (`user_id`),
  KEY `service_orders_worker_id_foreign` (`worker_id`),
  KEY `service_orders_admin_id_foreign` (`admin_id`),
  KEY `service_orders_service_id_foreign` (`service_id`),
  CONSTRAINT `service_orders_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`),
  CONSTRAINT `service_orders_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`),
  CONSTRAINT `service_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `service_orders_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_orders`
--

LOCK TABLES `service_orders` WRITE;
/*!40000 ALTER TABLE `service_orders` DISABLE KEYS */;
INSERT INTO `service_orders` VALUES (1,1,4,NULL,2,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(2,3,NULL,NULL,3,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(3,1,NULL,NULL,8,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(4,4,NULL,NULL,2,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(5,5,NULL,NULL,3,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(6,6,NULL,NULL,8,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(7,5,NULL,NULL,8,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(8,3,NULL,NULL,2,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(9,7,NULL,NULL,8,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(10,6,NULL,NULL,3,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(11,5,NULL,NULL,8,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(12,4,NULL,NULL,5,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(13,6,NULL,NULL,7,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(14,2,NULL,NULL,6,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(15,1,NULL,NULL,6,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(16,7,NULL,NULL,2,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(17,2,NULL,NULL,5,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(18,4,NULL,NULL,5,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27'),(19,3,NULL,NULL,5,'open','2019-11-22','2019-11-24','09:00:00','14:00:00','Metropolitana','Santiago','Santiago','Información adicional','2019-11-18 02:10:27','2019-11-18 02:10:27');
/*!40000 ALTER TABLE `service_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_worker`
--

DROP TABLE IF EXISTS `service_worker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_worker` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL,
  `worker_id` int(10) unsigned NOT NULL,
  `visit_required` tinyint(1) NOT NULL DEFAULT '0',
  `visit_cost` decimal(10,2) DEFAULT NULL,
  `day_cost` decimal(8,2) DEFAULT NULL,
  `night_cost` decimal(8,2) DEFAULT NULL,
  `days` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_worker`
--

LOCK TABLES `service_worker` WRITE;
/*!40000 ALTER TABLE `service_worker` DISABLE KEYS */;
INSERT INTO `service_worker` VALUES (1,5,1,0,NULL,110.00,180.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(2,8,1,0,NULL,120.00,200.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(3,2,2,1,NULL,150.00,230.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(4,3,2,1,NULL,150.00,230.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(5,4,3,1,NULL,120.00,200.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(6,6,3,1,NULL,110.00,180.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(7,2,4,1,NULL,110.00,180.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(8,3,4,1,NULL,150.00,230.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(9,8,4,0,NULL,120.00,200.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(10,6,5,1,NULL,150.00,230.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(11,5,6,0,NULL,120.00,200.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(12,7,6,0,NULL,150.00,230.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(13,5,7,0,NULL,110.00,180.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL),(14,8,7,0,NULL,150.00,230.00,'{\"dom_am\": false, \"dom_pm\": false, \"jue_am\": false, \"jue_pm\": true, \"lun_am\": false, \"lun_pm\": true, \"mar_am\": false, \"mar_pm\": true, \"mie_am\": false, \"mie_pm\": true, \"sab_am\": false, \"sab_pm\": true, \"vie_am\": false, \"vie_pm\": true, \"dom_24h\": false, \"jue_24h\": false, \"lun_24h\": false, \"mar_24h\": false, \"mie_24h\": false, \"sab_24h\": false, \"vie_24h\": false}',NULL,NULL);
/*!40000 ALTER TABLE `service_worker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'active','Aseo','Limpieza doméstica y empresaral. Sólo pisos, muebles, baños y cocinas. No incluye cuidado de personas',NULL,'2019-11-18 02:14:10'),(2,'active','Cocina','Preparado de platos para desayunos, comidas y cenas.',NULL,'2019-11-18 02:15:25'),(3,'active','Niñera','Cuidado de niños hasta 11 años. No incluye niños con condiciones especiales.',NULL,'2019-11-18 02:15:32'),(4,'active','Lavado de autos','Lavado de vehículos de uso personal. No incluye vehículos comerciales.',NULL,'2019-11-18 02:15:44'),(5,'active','Compras','Realización de compras domésticas, mercados, enseres, artículos del hogar...',NULL,'2019-11-18 02:15:52'),(6,'active','Mecánica','Mecánica automotriz a domicilio. Solo vehículos de uso personal.',NULL,'2019-11-18 02:16:02'),(7,'active','Citas Médicas','Agendamos tus citas y te recordamos la fecha. Hacemos seguimiento.',NULL,'2019-11-18 02:16:10'),(8,'active','Trámites','Realizamos trámites personales, bancarios e institucionales en horario comercial.',NULL,'2019-11-18 02:16:27');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rut` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_rut_unique` (`rut`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'josemartinez@example.com','7818123-0','564446365555','2019-11-18 02:10:24','$2y$10$h.xxAAqQ8.4NZ7lPtsRi9.PdVpTVRR52kfH5siaE0VfVNSpHENkK2',NULL,NULL,NULL),(2,'victorcontreras@example.com','24585256-8','564446361346','2019-11-18 02:10:25','$2y$10$WSf1Db2ldaKZ8N2ErHmIu.y9WTX/apUTc8NrtYNZUL1LCJd4BJYv6',NULL,NULL,NULL),(3,'teresamedina@example.com','12211921-1','564623238855','2019-11-18 02:10:25','$2y$10$dnu3AIyVE1QMr57LIkabguCasB8FXIwzNcMkijczTCSDVEloAkYjK',NULL,NULL,NULL),(4,'miguelcastanos@example.com','10154404-4','565556354859','2019-11-18 02:10:25','$2y$10$y/JbLdg26FK9u3Wy2RJOgOqfy.KYiStdwoFc7/SdAQnSQubXGjiy6',NULL,NULL,NULL),(5,'gabrielalara@example.com','23701213-5','569891636688','2019-11-18 02:10:25','$2y$10$VGHErx1A/ru2BZVgypMSbuH297GjZrNsHhcKByJJGQPM5B9m/4Ucu',NULL,NULL,NULL),(6,'danielarodriguez@example.com','7855855-5','562323499944','2019-11-18 02:10:25','$2y$10$BGplCCxL/Iwsy0GpZQT.6uHYI.airaOLE3b1XOWYrdqtaFkGz5qL2',NULL,NULL,NULL),(7,'gerardovelez@example.com','22516239-5','569884897152','2019-11-18 02:10:25','$2y$10$Jo6t3uXrqdQLSrSOwBcHnOqzII77cd0kDB3e2RXvh.hd5OxfnJQ1C',NULL,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worker_documents`
--

DROP TABLE IF EXISTS `worker_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `worker_documents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `worker_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `worker_documents_worker_id_foreign` (`worker_id`),
  CONSTRAINT `worker_documents_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worker_documents`
--

LOCK TABLES `worker_documents` WRITE;
/*!40000 ALTER TABLE `worker_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `worker_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worker_payments`
--

DROP TABLE IF EXISTS `worker_payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `worker_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `worker_id` int(10) unsigned NOT NULL,
  `service_order_id` int(10) unsigned NOT NULL,
  `f_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rut` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `worker_payments_worker_id_foreign` (`worker_id`),
  KEY `worker_payments_service_order_id_foreign` (`service_order_id`),
  CONSTRAINT `worker_payments_service_order_id_foreign` FOREIGN KEY (`service_order_id`) REFERENCES `service_orders` (`id`),
  CONSTRAINT `worker_payments_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worker_payments`
--

LOCK TABLES `worker_payments` WRITE;
/*!40000 ALTER TABLE `worker_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `worker_payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worker_profiles`
--

DROP TABLE IF EXISTS `worker_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `worker_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `worker_id` int(10) unsigned NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `l_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comunity` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `block` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_path` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `worker_profiles_worker_id_foreign` (`worker_id`),
  CONSTRAINT `worker_profiles_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worker_profiles`
--

LOCK TABLES `worker_profiles` WRITE;
/*!40000 ALTER TABLE `worker_profiles` DISABLE KEYS */;
INSERT INTO `worker_profiles` VALUES (1,1,'inactive','Ismael','Salazar','1996-10-08','563324596658','male','Chile','Santiago','Santiago','56','642','Soy el mero, mero','images/workers/1568213635.jpg',NULL,NULL),(2,2,'inactive','Patricia','Toledo','1992-11-06','568489658896','female','Chile','Santiago','Santiago','Los cerezos','357','Bella como una flor','images/workers/1568213788.jpg',NULL,NULL),(3,3,'inactive','Fernando','Quevedo','1968-07-23','563325669191','male','Chile','Santiago','Santiago','Las acacias','369','Frenético y enfocado','images/workers/1568213950.jpg',NULL,NULL),(4,4,'inactive','Estefanía','Pérez','1995-09-06','584129490074','female','Chile','Santiago','Santiago','La Paz','357','Soy el viento que golpea la ola','images/workers/1568233988.jpg',NULL,NULL),(5,5,'inactive','Lisandro','Gómez','1977-07-12','563228286495','male','Chile','Santiago','Santiago','Cáceres','456','Ambicioso y centrado','images/workers/1568214300.jpg',NULL,NULL),(6,6,'inactive','Mariela','Diamante','1996-11-28','568559658485','female','Chile','Santiago','Santiago','Viñedos','97','Soy del tamaño del problema que tengo en frente','images/workers/1568214432.jpg',NULL,NULL),(7,7,'inactive','Sofía','Herrádez','1989-04-04','563224515566','female','Chile','Santiago','Santiago','La Luz','987','Enfocada y analítica','images/workers/1568214594.jpg',NULL,NULL);
/*!40000 ALTER TABLE `worker_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `worker_ratings`
--

DROP TABLE IF EXISTS `worker_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `worker_ratings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_order_id` int(10) unsigned NOT NULL,
  `worker_id` int(10) unsigned NOT NULL,
  `sender_id` int(10) unsigned NOT NULL,
  `stars` decimal(2,1) NOT NULL,
  `comment` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `worker_ratings_service_order_id_foreign` (`service_order_id`),
  KEY `worker_ratings_worker_id_foreign` (`worker_id`),
  KEY `worker_ratings_sender_id_foreign` (`sender_id`),
  CONSTRAINT `worker_ratings_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`),
  CONSTRAINT `worker_ratings_service_order_id_foreign` FOREIGN KEY (`service_order_id`) REFERENCES `service_orders` (`id`),
  CONSTRAINT `worker_ratings_worker_id_foreign` FOREIGN KEY (`worker_id`) REFERENCES `workers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `worker_ratings`
--

LOCK TABLES `worker_ratings` WRITE;
/*!40000 ALTER TABLE `worker_ratings` DISABLE KEYS */;
INSERT INTO `worker_ratings` VALUES (1,1,4,1,3.0,'Muy amable...',NULL,NULL),(2,2,1,2,4.0,'Muy amable...',NULL,NULL),(3,3,1,4,2.0,'Muy amable...',NULL,NULL),(4,4,2,5,3.0,'Muy amable...',NULL,NULL),(5,5,2,2,4.0,'Muy amable...',NULL,NULL),(6,6,3,7,2.0,'Muy amable...',NULL,NULL),(7,7,3,4,3.0,'Muy amable...',NULL,NULL),(8,8,3,6,5.0,'Muy amable...',NULL,NULL),(9,9,4,6,2.0,'Muy amable...',NULL,NULL),(10,10,4,3,3.0,'Muy amable...',NULL,NULL),(11,11,4,7,4.0,'Muy amable...',NULL,NULL),(12,12,5,3,5.0,'Muy amable...',NULL,NULL),(13,13,5,3,5.0,'Muy amable...',NULL,NULL),(14,14,6,6,5.0,'Muy amable...',NULL,NULL),(15,15,6,4,5.0,'Muy amable...',NULL,NULL),(16,16,7,1,3.0,'Muy amable...',NULL,NULL),(17,17,7,4,3.0,'Muy amable...',NULL,NULL),(18,18,7,1,2.0,'Muy amable...',NULL,NULL),(19,19,7,3,1.0,'Muy amable...',NULL,NULL);
/*!40000 ALTER TABLE `worker_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workers`
--

DROP TABLE IF EXISTS `workers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `workers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rut` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `workers_email_unique` (`email`),
  UNIQUE KEY `workers_rut_unique` (`rut`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workers`
--

LOCK TABLES `workers` WRITE;
/*!40000 ALTER TABLE `workers` DISABLE KEYS */;
INSERT INTO `workers` VALUES (1,'ismaelsalazar@example.com','24696786-5','563324596658','2019-11-18 02:10:25','$2y$10$h4Lxjd3b0BWS7f3P3/c4WeGgDu/DMeWxz7WFlqF9X5dxpJ1oHYV.i',NULL,NULL,NULL),(2,'patriciatoledo@example.com','7134060-0','568489658896','2019-11-18 02:10:25','$2y$10$JvLZUjZhi2AVCvai1SGJI.7gSv0CMjzoG0/u5IC18UQklmIfiI2VG',NULL,NULL,NULL),(3,'fernandoquevedo@example.com','8535283-0','563325669191','2019-11-18 02:10:25','$2y$10$afbxNIcUcDss.YfZeIy0quzXQF2qv3WJuC6SQAZgjk49TvJ.u0q0S',NULL,NULL,NULL),(4,'estefaniaperez@example.com','16659093-0','584129490074','2019-11-18 02:10:25','$2y$10$uUtuWeVrTVWysCxLvowKquDhudCJs1ey8CGO3KjTJi2ZsATCKVltO',NULL,NULL,NULL),(5,'lisandrogomez@example.com','10034122-0','563228286495','2019-11-18 02:10:25','$2y$10$knMgYmfTWKp9U4nezTpn4ugNp2TBKVXxulpBsiw/7ELpIuEu7xZe6',NULL,NULL,NULL),(6,'marieladiamante@example.com','21431065-1','568559658485','2019-11-18 02:10:25','$2y$10$/Q6xFOK8rEr265m/gQiz3e8Wii8GxEdfhixOQ8z7Y/GFpmCONyQa.',NULL,NULL,NULL),(7,'sofiaherradez@example.com','12228912-5','563224515566','2019-11-18 02:10:26','$2y$10$D5RZSRLTqqe9cGc.ZF2zhO4tzTex8eRjgDOu56WsarKPN5423o/fS',NULL,NULL,NULL);
/*!40000 ALTER TABLE `workers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-11-18  9:01:45
