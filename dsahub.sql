-- MySQL dump 10.13  Distrib 5.5.62, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: alumni_
-- ------------------------------------------------------
-- Server version	5.5.62-0ubuntu0.14.04.1

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
-- Current Database: `alumni_`
--


--
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumni` (
  `alumn_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `lastname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `person` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `section` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT 'others',
  `country` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `city` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `occupation_type` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `occupation` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `year_in` int(10) NOT NULL,
  `year_out` int(10) NOT NULL,
  `description` varchar(1000) COLLATE latin1_general_ci NOT NULL DEFAULT 'Keine Beschreibung wurde bis jetzt eingegeben...',
  `mailing_subscription` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'NO',
  `contact_agree` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`alumn_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni`
--

LOCK TABLES `alumni` WRITE;
/*!40000 ALTER TABLE `alumni` DISABLE KEYS */;
INSERT INTO `alumni` VALUES (11,2,'andrei.bubeneck@yahoo.com','Bubeneck','Wilhelm Andrei','student','Real-Spezialklasse','DE','MÃ¼nchen','+49Â 176Â 44214910','Life, Physical, and Social Science','Chemiestudent',2012,2016,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sagittis cursus ante vitae aliquet. Vivamus congue pretium vestibulum. Suspendisse semper volutpat sapien a iaculis. Phasellus sem eros, ullamcorper in urna ac, cursus iaculis turpis. Aenean tristique pellentesque ante. Maecenas aliquam lectus turpis, id lobortis mi ullamcorper a. Nam consectetur ipsum sed elit feugiat consequat. Vivamus rhoncus viverra neque, et dapibus orci congue non. Duis vitae arcu ornare, finibus nisl euismod, pharetra enim. Duis tristique a nulla quis elementum. Vestibulum tempus dolor nec tempus tincidunt. Praesent aliquam augue posuere nisi lobortis gravida.','YES','YES'),(12,27,'abc@abc.com','Trandafir','Anca','teacher','Informatik','RO','Bukarest','','Education, Training, and Library','Lehrer',2012,2016,'Keine Beschreibung wurde bis jetzt eingegeben...','YES','NO'),(13,28,'andrei.bubeneck@gmail.com','Smith','John','student','Human-Spezialklasse','RO','','','','',2012,2016,'','YES','YES'),(14,29,'catalinasabie@gmail.com','Sabie','Cata','student','Real-Spezialklasse','AT','Wien','','Computer and Mathematical','Student',2012,2016,'','NO','YES'),(15,30,'alumnitester@olima.de','Mustermann','Mustafah','student','Mathematik','RO','Bukarest','','Education, Training, and Library','QualitÃ¤tskontroll-Account',2012,0,'','YES','YES'),(16,32,'ro-dir@ivao.aero','Bubilinski','Bubi','student','Real-Spezialklasse','DE','MÃ¼nchen','','Life, Physical, and Social Science','Chemiestudent',2012,2016,'Das ist eine Beschreibung.','YES','YES');
/*!40000 ALTER TABLE `alumni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumni_requests`
--

DROP TABLE IF EXISTS `alumni_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumni_requests` (
  `alumn_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `lastname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `person` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `section` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT 'others',
  `country` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `city` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `occupation_type` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `occupation` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `year_in` int(10) NOT NULL,
  `year_out` int(10) NOT NULL,
  `description` varchar(1000) COLLATE latin1_general_ci NOT NULL DEFAULT 'Keine Beschreibung wurde bis jetzt eingegeben...',
  `mailing_subscription` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'NO',
  `contact_agree` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`alumn_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni_requests`
--

LOCK TABLES `alumni_requests` WRITE;
/*!40000 ALTER TABLE `alumni_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumni_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactform`
--

DROP TABLE IF EXISTS `contactform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactform` (
  `ticketId` int(6) NOT NULL AUTO_INCREMENT COMMENT 'starts at 100000',
  `surname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `subject` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `message` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`ticketId`)
) ENGINE=InnoDB AUTO_INCREMENT=100011 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactform`
--

LOCK TABLES `contactform` WRITE;
/*!40000 ALTER TABLE `contactform` DISABLE KEYS */;
INSERT INTO `contactform` VALUES (100000,'Test','Test','Test','Test','Test'),(100001,'Bubeneck','Andrei','andrei.bubeneck@yahoo.com','Telefonnummer Kollege','Wie kann ich die Telefonnummer von Andreas OhligschlÃ¤ger (2005) erhalten? Vielen Dank!'),(100002,'Bubeneck','Andrei','andrei.bubeneck@yahoo.com','Telefonnummer Kollege','Wie kann ich die Telefonnummer von Andreas OhligschlÃ¤ger (2005) erhalten? Vielen Dank!'),(100003,'Manger','Oliver','oli@olima.de','Test','Testnachricht.'),(100004,'Tester','Testos','tester.testos@test.org','Testing','Hello there! I am a test!'),(100005,'Manger','Oliver','oli@olima.de','alles wird gut','blubb'),(100006,'Tester','Testy','tester.testy@test.com','Hello world!','Ich wollte Sie nur begruessen!'),(100007,'avzvfsdf','sdfvsdfv','daerbsfg@sfvsd.com','svsdfvaewr','svsgbnishvkjdsfdrvsndfkvjdsnh'),(100008,'aervatrb','aetbargba','acssdf@dfvsbtg.com','atdbnaijetlb','oidrsdlgjbsdbf'),(100009,'ds','sd','dsadasd@fsad.ro','dsd','sd'),(100010,'Ã–Ã¤Ã¶Ã¼Ã¤ÃŸÃŸ','fjhf','hd@fgvj.com','jh','fjc');
/*!40000 ALTER TABLE `contactform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `event_id` int(10) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `event_start` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `event_end` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `event_place` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `event_type` varchar(40) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `group_id` int(10) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `group_description` varchar(1000) COLLATE latin1_general_ci NOT NULL DEFAULT 'Keine Beschreibung wurde bis jetzt eingegeben...',
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (4,'Ankunft 2012','Diese ist eine Beschreibung blubb'),(5,'Abgang 2016','Keine Beschreibung wurde bis jetzt eingegeben...'),(6,'Real-Spezialklasse','Keine Beschreibung wurde bis jetzt eingegeben...'),(7,'DE','Keine Beschreibung wurde bis jetzt eingegeben...'),(8,'Life, Physical, and Social Science','Keine Beschreibung wurde bis jetzt eingegeben...'),(9,'Muenchen','Keine Beschreibung wurde bis jetzt eingegeben...'),(10,'Chemiestudent','Keine Beschreibung wurde bis jetzt eingegeben...'),(11,'Informatik','Keine Beschreibung wurde bis jetzt eingegeben...'),(12,'RO','Keine Beschreibung wurde bis jetzt eingegeben...'),(13,'Education, Training, and Library','Keine Beschreibung wurde bis jetzt eingegeben...'),(14,'Bukarest','Keine Beschreibung wurde bis jetzt eingegeben...'),(15,'Lehrer','Keine Beschreibung wurde bis jetzt eingegeben...'),(16,'Student','Keine Beschreibung wurde bis jetzt eingegeben...'),(17,'Testgruppe','TEST'),(18,'Test2','dasdsvst'),(19,'Human-Spezialklasse','Keine Beschreibung wurde bis jetzt eingegeben...'),(20,'AT','Keine Beschreibung wurde bis jetzt eingegeben...'),(21,'Computer and Mathematical','Keine Beschreibung wurde bis jetzt eingegeben...'),(22,'Wien','Keine Beschreibung wurde bis jetzt eingegeben...'),(23,'Mathematik','Keine Beschreibung wurde bis jetzt eingegeben...'),(24,'QualitÃ¤tskontroll-Account','Keine Beschreibung wurde bis jetzt eingegeben...'),(25,'',''),(26,'Studentasdasdasd','Keine Beschreibung wurde bis jetzt eingegeben...'),(27,'MÃ¼nchen','Keine Beschreibung wurde bis jetzt eingegeben...');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `int_alumni_groups`
--

DROP TABLE IF EXISTS `int_alumni_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `int_alumni_groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `alumn_id` int(10) NOT NULL,
  `group_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alumn_id` (`alumn_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `11` FOREIGN KEY (`alumn_id`) REFERENCES `alumni` (`alumn_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `int_alumni_groups`
--

LOCK TABLES `int_alumni_groups` WRITE;
/*!40000 ALTER TABLE `int_alumni_groups` DISABLE KEYS */;
INSERT INTO `int_alumni_groups` VALUES (3,11,5),(4,11,6),(6,11,8),(7,11,9),(9,12,4),(10,12,11),(11,12,12),(12,12,13),(13,12,14),(14,12,15),(20,11,7),(23,11,16),(24,11,10),(25,11,17),(27,13,4),(28,13,5),(29,13,19),(30,13,12),(31,14,4),(32,14,5),(33,14,6),(34,14,20),(35,14,21),(36,14,22),(37,14,16),(38,11,14),(39,15,4),(40,15,23),(41,15,12),(42,15,13),(43,15,14),(44,15,24),(46,11,20),(47,11,12),(48,11,22),(49,11,27),(50,11,4),(51,16,4),(52,16,5),(53,16,6),(54,16,7),(55,16,8),(56,16,27),(57,16,10);
/*!40000 ALTER TABLE `int_alumni_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `int_events_gropus`
--

DROP TABLE IF EXISTS `int_events_gropus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `int_events_gropus` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `event_id` int(10) NOT NULL,
  `group_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `event_id` (`event_id`),
  CONSTRAINT `5` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `6` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `int_events_gropus`
--

LOCK TABLES `int_events_gropus` WRITE;
/*!40000 ALTER TABLE `int_events_gropus` DISABLE KEYS */;
/*!40000 ALTER TABLE `int_events_gropus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `int_mails_groups`
--

DROP TABLE IF EXISTS `int_mails_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `int_mails_groups` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `group_id` int(10) NOT NULL,
  `mail_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `mail_id` (`mail_id`),
  CONSTRAINT `1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `int_mails_groups_ibfk_1` FOREIGN KEY (`mail_id`) REFERENCES `mails` (`mail_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `int_mails_groups`
--

LOCK TABLES `int_mails_groups` WRITE;
/*!40000 ALTER TABLE `int_mails_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `int_mails_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `attempt_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `time` varchar(30) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`attempt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
INSERT INTO `login_attempts` VALUES (1,26,'1464123413'),(2,2,'1473952888'),(3,2,'1474112017'),(4,30,'1474308781'),(5,2,'1482663613'),(6,2,'1544296061'),(7,2,'1571573330');
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mails`
--

DROP TABLE IF EXISTS `mails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mails` (
  `mail_id` int(10) NOT NULL,
  `subject` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `message` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `timing` int(10) NOT NULL,
  PRIMARY KEY (`mail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mails`
--

LOCK TABLES `mails` WRITE;
/*!40000 ALTER TABLE `mails` DISABLE KEYS */;
/*!40000 ALTER TABLE `mails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `lastname` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `firstname` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `email` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `password` char(128) COLLATE latin1_general_ci NOT NULL,
  `salt` char(128) COLLATE latin1_general_ci NOT NULL,
  `access` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'teacher','asd','dsad','Testy','test@example.com','00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc','f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef','user'),(2,'student','Bubeneck','Wilhelm Andrei','AndreiChim','andrei.bubeneck@yahoo.com','358f5229c5751aec3102e22bda8c57f7f62fb3be6def89c9066f9150340dba547dd2155aacc350363a7b75e9ae021a52eea671ec88a79872c578f59310a54e58','4259c8dea08464e4c2c5056e37915a46d9586d711b7ccaac0b72ff6d3d643df7a789696bb060dd890dd5a3f73d773a718246c0b670051080d29656a67081ef4d','admin'),(24,'student','asdasd','sdasd','dum2@dum.dum','dum2@dum.dum','76ffe848131b724161a54d56cfac87c83cd98a1121213c3a3743d9ca0c91cfa4d7910bec18d2b3fec532f3ca1f0025867b97a2a15efb7026d790f02bc60b69a1','5f3b08eccc48b244d6492ee637c6271527a4350c8133ce4188828b5bb1dad4b282e8512fa78121bbe9cc042b800bf6003679a80b75e0a02b92622dc66d549e51','user'),(25,'teacher','sdfsdfdfsdf','sdfgdfxvxvs','dummy@olima.de','dummy@olima.de','f31a6a0e315b1574efaab0629c2eb750a9f74a0c5c2376465e035ceaa0358daef73a8e497af81a78a0d8be56052c19c758ed8d3a56780e1500dd9bef1dddbaab','490d3bade3252cfeb4d1b3f08631fe6d73f4ab37cd60ba05dec9578737bf80501092387042ed7d5bb0e89f5b5990d519bdfa49746d1d566fe5ae1b427495d2e4','user'),(26,'student','Ionescu','Ionel','abcdefc@test.co.uk','abcdefc@test.co.uk','c373918cca27d101262c84e8109e29110156b459e537073a472756b5843e60a29b8fcf25f8f88f9064150a600bce1362732658e4907b46b1b114f3bda80cdeb5','f2e51405f297d298508ad031aba3155d5c9d8dd6e5bfd8c050f2f7dbb947634a8cf1cab3797db2fc83524edb9012f9c1b47e734393d0fca869e9558fa2e7e80e','user'),(27,'teacher','Trandafir','Anca','abc@abc.com','abc@abc.com','a86ec4bb3b8cff133412b9f5ddbee48309c92377b6af7626443a6a5fd03b30d058fbdc092afc8ce41cfc17b938d29cd990244d1566ec7a220026d70dc1713008','325d23770a9cb3f82ed29fd5d0895d0426569b856f0781d464e30ae078fec80e4b0d500cb7f56e088727844c1558c2e02465954b9156ee77da9964553956e7c5','user'),(28,'student','Smith','John','andrei.bubeneck@gmail.com','andrei.bubeneck@gmail.com','e68358d66e12ed03ff62287621ef10e252b008ee2bf8481decc8154d9b922f3c345926a0a9057129c186b5b85fea942a827444bbb9c7c89da1869d992f0b4abe','591801ce62dafa4ffdb74f130dc93f4e39c122d9d84c568f989fb6915bf8638bb0d9c5af6c6765d73b66ce512590c29a9ee81871cce0948f53ff6ba90447f553','user'),(29,'student','Sabie','Cata','catalinasabie@gmail.com','catalinasabie@gmail.com','4f9707c10b77e88d50599f335066d7c8f14af5bad303a3820c77a9a46faef73468d8af5afd8ff4d06a29de7d2918d4518a568b2725dece2d047d22c53da591da','cbfff5342d3aae93765019e99513b4061f0b5e8d371198dfd59b13c12de6dfe9187dc4c753af0f868d6fbd1cde472a9269e03ea1fb52e6e48a4002381b418459','admin'),(30,'student','Mustermann','Mustafah','alumnitester@olima.de','alumnitester@olima.de','f80d05d65ba97dfb87d5488de2e8cf81cafb2989be79cb0a19b98da6536cd0053679a4c286722ca6c9bb908248e5cb76650d6289c1e9da5a8ff60f8e9a25cb5a','1c3a6993ee03e36287bdde56df28503bfa138aec14f51cd5d2648f9102ab07537415ccaa577a42381ed81e12d4a19bcf3698f4b95950c8b6bd2c92c5187ef38e','admin'),(31,'teacher','Bubi','Bubisor','ro-tc@ivao.aero','ro-tc@ivao.aero','b6f7350122c50b5d4f7c4953f279829d31cf68c20cbcccb98fe7366228aac40c328a7b06b435b798927e0e2873a1ef81694e99cbabb2a80fdf579a0d9055d242','f44f7c8cedd15f5784af0d17b649d67b1e833a3ce9cb07ad5b918c1a03ddc6ecf96e0010424f5302b788699e74f714faac21dfd4730b89fdd9e941c4857f2a54','user'),(32,'student','Bubilinski','Bubi','ro-dir@ivao.aero','ro-dir@ivao.aero','f28893223fe27319fc1eedc1537a02635cd0af432648b5cb2b967bb61ba6a46b61890674b67ccba2a44d4209818eaf76173f684f7e18d360746539e4b8f41703','3a1b58f50d9999b965d718d1fe18ed65d82665812c8a498a9708c02159592fda9d8c0cf173b1c0b658ffeaea57701c3d7911b669dd3950c748b9d8b55b97b7ba','user'),(34,'student','Bubeneck','Wilhelm','andrei.bubeneck@tum.de','andrei.bubeneck@tum.de','20a72f88934d46586ab47adfa9ff73de767cae1bfadebd577e1b63c662003b5c07f407dbe898dd4241d80221f79fe714f3fbc998f51aff981c6d06b868ccdafc','0d28e40d2a7efc8b2427bb95380a47af2feecab6237250a38af31c3d45a2a1140843efd5b5764a209fb0998d3cd57c3f7c6666e07306dee47e23e51be9c15b70','user');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pw_reset_requests`
--

DROP TABLE IF EXISTS `pw_reset_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pw_reset_requests` (
  `request_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `token` char(40) CHARACTER SET latin1 NOT NULL,
  `time_stamp` int(40) NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pw_reset_requests`
--

LOCK TABLES `pw_reset_requests` WRITE;
/*!40000 ALTER TABLE `pw_reset_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `pw_reset_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registration_requests`
--

DROP TABLE IF EXISTS `registration_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration_requests` (
  `request_id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `token` char(40) CHARACTER SET latin1 NOT NULL,
  `time_stamp` int(40) NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration_requests`
--

LOCK TABLES `registration_requests` WRITE;
/*!40000 ALTER TABLE `registration_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `registration_requests` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-15 12:59:56

