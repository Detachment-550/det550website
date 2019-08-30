-- MySQL dump 10.13  Distrib 8.0.17, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: afrotc_mitr
-- ------------------------------------------------------
-- Server version	8.0.17

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
-- Table structure for table `acknowledge_posts`
--

DROP TABLE IF EXISTS `acknowledge_posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `acknowledge_posts` (
                                     `user` int(11) unsigned NOT NULL,
                                     `announcement_id` int(11) NOT NULL,
                                     `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                     `acknowledge_posts_id` int(11) NOT NULL AUTO_INCREMENT,
                                     PRIMARY KEY (`acknowledge_posts_id`),
                                     KEY `acknowledge_posts_announcement_fk` (`announcement_id`),
                                     KEY `acknowledge_posts_cadet_fk` (`user`),
                                     CONSTRAINT `acknowledge_posts_announcement_fk` FOREIGN KEY (`announcement_id`) REFERENCES `announcement` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
                                     CONSTRAINT `acknowledge_posts_users_id_fk` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acknowledge_posts`
--


--
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alumni` (
                          `alumni_id` int(11) NOT NULL AUTO_INCREMENT,
                          `rank` varchar(255) NOT NULL,
                          `last_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          `email` varchar(255) NOT NULL,
                          `first_name` varchar(255) NOT NULL,
                          `last_name` varchar(255) NOT NULL,
                          `phone` varchar(20) DEFAULT NULL,
                          `major` varchar(255) NOT NULL,
                          `position` varchar(255) NOT NULL,
                          PRIMARY KEY (`alumni_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni`
--


--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcement` (
                                `title` varchar(255) COLLATE ascii_bin NOT NULL,
                                `subject` varchar(255) COLLATE ascii_bin NOT NULL,
                                `body` mediumtext COLLATE ascii_bin NOT NULL,
                                `createdBy` int(11) unsigned DEFAULT NULL,
                                `uid` int(11) NOT NULL AUTO_INCREMENT,
                                `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                                PRIMARY KEY (`uid`),
                                KEY `user_fk` (`createdBy`),
                                CONSTRAINT `announcement_users_id_fk` FOREIGN KEY (`createdBy`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` VALUES ('Test','asdlfj','<p>as;ldfkja;sdlkfa</p>\r\n<p>sdflajksdf</p>',1,1,'2019-08-08 02:41:53'),('Test','asdlfj','<p>as;ldfkja;sdlkfa</p>\r\n<p>sdflajksdf</p>',1,2,'2019-08-08 02:42:36');

--
-- Table structure for table `announcement_group_jointable`
--

DROP TABLE IF EXISTS `announcement_group_jointable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcement_group_jointable` (
                                                `announcement` int(11) NOT NULL,
                                                `group` mediumint(8) unsigned NOT NULL,
                                                `id` int(11) NOT NULL AUTO_INCREMENT,
                                                PRIMARY KEY (`id`),
                                                KEY `announcement_group_jointable_announcement_uid_fk` (`announcement`),
                                                KEY `announcement_group_jointable_groups_id_fk` (`group`),
                                                CONSTRAINT `announcement_group_jointable_announcement_uid_fk` FOREIGN KEY (`announcement`) REFERENCES `announcement` (`uid`),
                                                CONSTRAINT `announcement_group_jointable_groups_id_fk` FOREIGN KEY (`group`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcement_group_jointable`
--

INSERT INTO `announcement_group_jointable` VALUES (1,2,1),(2,2,2);

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attendance` (
                              `user` int(11) unsigned NOT NULL,
                              `eventid` int(11) NOT NULL,
                              `excused_absence` tinyint(1) DEFAULT '0',
                              `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                              `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
                              `comments` text COLLATE ascii_bin,
                              PRIMARY KEY (`attendance_id`),
                              KEY `attendance_cadetEvent_fk` (`eventid`),
                              KEY `attendance_cadet_fk` (`user`),
                              CONSTRAINT `attendance_cadetEvent_fk` FOREIGN KEY (`eventid`) REFERENCES `cadetEvent` (`eventID`) ON DELETE CASCADE ON UPDATE CASCADE,
                              CONSTRAINT `attendance_users_id_fk` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--


--
-- Table structure for table `cadetEvent`
--

DROP TABLE IF EXISTS `cadetEvent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cadetEvent` (
                              `name` varchar(255) COLLATE ascii_bin DEFAULT NULL,
                              `date` datetime DEFAULT NULL,
                              `eventID` int(11) NOT NULL AUTO_INCREMENT,
                              `pt` tinyint(1) DEFAULT '0',
                              `llab` tinyint(1) DEFAULT '0',
                              `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                              `created_by` int(11) unsigned DEFAULT NULL,
                              PRIMARY KEY (`eventID`),
                              KEY `cadetEvent_users_id_fk` (`created_by`),
                              CONSTRAINT `cadetEvent_users_id_fk` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=ascii COLLATE=ascii_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cadetEvent`
--

INSERT INTO `cadetEvent` VALUES ('Fake PT','2019-08-09 12:00:00',1,1,0,'2019-08-08 02:19:13',1);

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `emails` (
                          `uid` int(11) NOT NULL AUTO_INCREMENT,
                          `day` date NOT NULL,
                          `to` varchar(255) DEFAULT NULL,
                          `from` varchar(255) DEFAULT NULL,
                          `subject` mediumtext,
                          `message` longtext,
                          `title` varchar(255) DEFAULT NULL,
                          `user` int(11) unsigned DEFAULT NULL,
                          `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          PRIMARY KEY (`uid`),
                          KEY `emails_users_id_fk` (`user`),
                          CONSTRAINT `emails_users_id_fk` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--


--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
                          `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
                          `name` varchar(20) NOT NULL,
                          `description` varchar(100) NOT NULL,
                          PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` VALUES (1,'admin','Administrator'),(2,'members','General User');

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login_attempts` (
                                  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                  `ip_address` varchar(45) NOT NULL,
                                  `login` varchar(100) NOT NULL,
                                  `time` int(11) unsigned DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` VALUES (1,'127.0.0.1','jmessare',1565229146);

--
-- Table structure for table `memo`
--

DROP TABLE IF EXISTS `memo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `memo` (
                        `memo_id` int(11) NOT NULL AUTO_INCREMENT,
                        `user` int(10) unsigned NOT NULL,
                        `event` int(11) NOT NULL,
                        `memo_type` int(11) NOT NULL,
                        `comments` text,
                        `approved` tinyint(1) DEFAULT NULL,
                        `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        `date_reviewed` timestamp NULL DEFAULT NULL,
                        PRIMARY KEY (`memo_id`),
                        KEY `excuse_cadetEvent_eventID_fk` (`event`),
                        KEY `excuse_excuse_type_excuse_type_id_fk` (`memo_type`),
                        KEY `excuse_users_id_fk` (`user`),
                        CONSTRAINT `excuse_cadetEvent_eventID_fk` FOREIGN KEY (`event`) REFERENCES `cadetEvent` (`eventID`),
                        CONSTRAINT `excuse_excuse_type_excuse_type_id_fk` FOREIGN KEY (`memo_type`) REFERENCES `memo_type` (`memo_type_id`),
                        CONSTRAINT `excuse_users_id_fk` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memo`
--

INSERT INTO `memo` VALUES (3,1,1,1,'aasdlfkjasldkjf alsdkf jalsdkj flasdkj flaksj dfl akjs dflkjasldfkjalsd kfj laskdj flasdk fljk',NULL,'2019-08-08 03:28:39',NULL);

--
-- Table structure for table `memo_type`
--

DROP TABLE IF EXISTS `memo_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `memo_type` (
                             `memo_type_id` int(11) NOT NULL AUTO_INCREMENT,
                             `label` varchar(255) NOT NULL,
                             `description` text,
                             PRIMARY KEY (`memo_type_id`),
                             UNIQUE KEY `excuse_type_label_uindex` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memo_type`
--

INSERT INTO `memo_type` VALUES (1,'Sick','Cadet was too sick to attend the event. ');

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
                         `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                         `ip_address` varchar(45) NOT NULL,
                         `username` varchar(100) DEFAULT NULL,
                         `password` varchar(255) NOT NULL,
                         `email` varchar(254) NOT NULL,
                         `activation_selector` varchar(255) DEFAULT NULL,
                         `activation_code` varchar(255) DEFAULT NULL,
                         `forgotten_password_selector` varchar(255) DEFAULT NULL,
                         `forgotten_password_code` varchar(255) DEFAULT NULL,
                         `forgotten_password_time` int(11) unsigned DEFAULT NULL,
                         `remember_selector` varchar(255) DEFAULT NULL,
                         `remember_code` varchar(255) DEFAULT NULL,
                         `created_on` int(11) unsigned NOT NULL,
                         `last_login` int(11) unsigned DEFAULT NULL,
                         `active` tinyint(1) unsigned DEFAULT NULL,
                         `first_name` varchar(50) DEFAULT NULL,
                         `last_name` varchar(50) DEFAULT NULL,
                         `class` varchar(100) DEFAULT NULL,
                         `phone` varchar(20) DEFAULT NULL,
                         `rfid` int(10) DEFAULT NULL,
                         `major` varchar(100) DEFAULT NULL,
                         `question` varchar(255) NOT NULL,
                         `answer` varchar(255) NOT NULL,
                         `bio` text,
                         `afgoals` text,
                         `goals` text,
                         `flight` varchar(20) DEFAULT NULL,
                         `rank` varchar(100) DEFAULT NULL,
                         `position` varchar(255) DEFAULT NULL,
                         `awards` text,
                         `groupme` varchar(50) DEFAULT NULL,
                         `image` varchar(255) DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `uc_email` (`email`),
                         UNIQUE KEY `uc_activation_selector` (`activation_selector`),
                         UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
                         UNIQUE KEY `uc_remember_selector` (`remember_selector`),
                         UNIQUE KEY `users_rfid_uindex` (`rfid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES (1,'127.0.0.1','jmessare','$2y$12$HR8o1OnYveMU1WPe7TgfzuceQoON7Mno7ke8UaYtaLr9/xrTZadiq','jmessare46@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1565230565,1565231069,1,'Joseph','Messare','AS400','5855009728',NULL,'','','','','','','Alpha','Cadet','','',NULL,NULL);

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_groups` (
                                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                                `user_id` int(11) unsigned NOT NULL,
                                `group_id` mediumint(8) unsigned NOT NULL,
                                PRIMARY KEY (`id`),
                                UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
                                KEY `fk_users_groups_groups1_idx` (`group_id`),
                                KEY `fk_users_groups_users1_idx` (`user_id`),
                                CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
                                CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` VALUES (2,1,1),(3,1,2);

--
-- Table structure for table `wiki`
--

DROP TABLE IF EXISTS `wiki`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wiki` (
                        `name` varchar(255) NOT NULL,
                        `body` longtext NOT NULL,
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        PRIMARY KEY (`id`),
                        UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wiki`
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-07 23:54:22