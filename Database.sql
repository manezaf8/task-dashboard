-- MySQL dump 10.13  Distrib 8.0.34, for Linux (x86_64)
--
-- Host: localhost    Database: ekomi
-- ------------------------------------------------------
-- Server version	8.0.34-0ubuntu0.22.04.1

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
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `user_id` int DEFAULT NULL,
  `completed` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `due_date` timestamp NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (3,'Task 2 edited','The second task edited 3 times',NULL,0,'2023-10-10 00:00:00','2023-10-10 12:40:09','2023-10-12 00:00:00'),(8,'AYG Task','Create a Website for them this task is done',NULL,1,'2023-10-18 00:00:00','2023-10-10 15:12:11','2023-10-11 00:00:00'),(9,'Khanye Task','This is Kanye task',NULL,0,'2023-10-18 00:00:00','2023-10-10 15:08:11','2023-10-10 15:08:11'),(10,'Brilliant idiots','The BI show needs a website',NULL,0,'2023-10-10 00:00:00','2023-10-10 15:11:31','2023-10-10 15:11:31'),(11,'Testing task','It\'s a testing task.',NULL,0,'2023-10-12 00:00:00','2023-10-10 15:46:15','2023-10-10 15:46:15'),(12,'User not being saved','Let\'s have the user ID tested ',13,0,'2023-10-10 00:00:00','2023-10-10 16:00:47','2023-10-10 16:00:47'),(13,'Display user ID','The task to display user ID.',13,0,'2023-10-10 00:00:00','2023-10-10 16:10:31','2023-10-10 16:10:31'),(14,'Testing Display','Id not pulling',13,0,'2023-10-11 00:00:00','2023-10-10 16:13:00','2023-10-10 16:13:00'),(15,'Komani','Komani\'s new website.',13,0,'2023-10-10 00:00:00','2023-10-10 16:31:46','2023-10-10 16:31:46'),(16,'Last one','The last task',14,0,'2023-10-10 00:00:00','2023-10-10 16:35:07','2023-10-10 16:35:07'),(18,'Docker image','Create a docker image',NULL,1,'2023-10-19 00:00:00','2023-10-10 19:02:22','2023-10-19 00:00:00'),(19,'Danny Project','This is a danny project ',16,0,'2023-10-20 00:00:00','2023-10-11 06:06:52','2023-10-11 06:06:52'),(20,'Dating site','The dating site for girl',21,0,'2023-10-26 00:00:00','2023-10-11 09:56:25','2023-10-11 09:56:25'),(21,'The Flagrant show','Create a website and App for Flagrant.',21,1,'2023-10-12 00:00:00','2023-10-11 10:26:28','2023-10-11 10:26:28'),(22,'The Flagrant show','Create a website and App for Flagrant.',21,1,'2023-10-12 00:00:00','2023-10-11 10:45:10','2023-10-11 10:45:10'),(23,'Create task validation','Validate the create task form to make sure than you can\'t end empty forms ',2,1,'2023-10-11 00:00:00','2023-10-11 15:30:24','2023-10-11 15:30:24');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expiration` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ntabethemba','nmabetshe@mrpricegroup.com','Fp&Lg9#5pPVvFU6e',NULL,NULL),(2,'Ntabelanga','bmaneza@gmail.com','$2y$10$6IQypJf6lFzFCuwlhwKAbeo.0VDVcFHv4cXYxoVrFJOeBy80LpfUa','fd06cd920d1334ea52efc00fd39ffd26','2023-10-11 17:16:46'),(4,'Marc','marc@gmail.com','CYkpI0n3sM30&tcF',NULL,NULL),(5,'tester','testing@gmail.com','0bJ$@Teh4Q2Px@PG',NULL,NULL),(7,'Nikie','nmabetshe@mrp.com','XJ*rTMxA1ax2q3sd',NULL,NULL),(9,'testing','test@test.com','testingTest1',NULL,NULL),(10,'testing','test@testing.com','Testing',NULL,NULL),(11,'nikie','nikie@test.com','NikieTest1',NULL,NULL),(12,'kanye','kanye@test.com','$2y$10$o2H4sBBUp5Sv7FsTTr/72e2XWyj.jGBExkZyU3sB7QfzpXlyFrUTq',NULL,NULL),(13,'maneza','maneza@test.com','$2y$10$kyc799d91Gx8t8fmxkzDv..LgcNWeWrCLGEzgn/IKPSa8WVr0.rea',NULL,NULL),(14,'Nikita Ntlombeni','nikie@testing.com','$2y$10$6C3QL.TnHDylQ55Lv8DXvex7weWEm0aGCEmtEdvF8/nssZC3CKbxS',NULL,NULL),(15,'marc','marc@test.com','$2y$10$yC9JBE/WB3s6EEwBGPM3qOiJIgp3wUojbonAdaf831OFoQZ2vWoh.','894f361ef7d38c88f60be81e68a97933','2023-10-11 16:21:54'),(16,'Danny','danny@test.com','$2y$10$k11HE1LtRSA85OmjrAYp9eSkEmi3/Ha09Bxfjk.kTNd/xIN98YJDq',NULL,NULL),(17,'kam','kam@test.com','$2y$10$kRE7EBBycJhYs4KyPI3pt.1UzMoGAjATJbsyuHGgssSqZ3XSSXSdG',NULL,NULL),(20,'Ari Shaffir','ari@test.com','$2y$10$vZbgLv4oVcn/H8fj2aKuquxdvTPFrROq3rhLSLmk5uVaMFBd4AmVC',NULL,NULL),(21,'Dillon Danis','dillion@test.com','$2y$10$kVN8el/plrLGJ.MqQJA94uOyuq5NN8PQVWn4PrXVbAjiSBubvK.re',NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-11 16:18:56
