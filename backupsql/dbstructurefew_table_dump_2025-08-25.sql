-- MySQL dump 10.13  Distrib 5.7.19, for Win64 (x86_64)
--
-- Host: localhost    Database: esurv
-- ------------------------------------------------------
-- Server version	5.7.19

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
-- Table structure for table `ai_alerts_alive`
--

DROP TABLE IF EXISTS `ai_alerts_alive`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ai_alerts_alive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `panelid` varchar(10) NOT NULL,
  `seqno` varchar(100) DEFAULT NULL,
  `zone` varchar(3) DEFAULT NULL,
  `alarm` varchar(3) DEFAULT NULL,
  `createtime` datetime NOT NULL,
  `receivedtime` datetime DEFAULT CURRENT_TIMESTAMP,
  `comment` varchar(500) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'O',
  `sendtoclient` char(1) DEFAULT NULL,
  `closedBy` varchar(20) DEFAULT NULL,
  `closedtime` datetime DEFAULT NULL,
  `sendip` varchar(15) DEFAULT NULL,
  `alerttype` varchar(50) DEFAULT NULL,
  `location` char(1) DEFAULT NULL,
  `priority` char(1) DEFAULT NULL,
  `AlertUserStatus` varchar(50) DEFAULT NULL,
  `ATMCode` varchar(50) DEFAULT NULL,
  `File_loc` mediumtext,
  PRIMARY KEY (`id`),
  KEY `receivedtime` (`receivedtime`),
  KEY `status` (`status`),
  KEY `closedBy` (`closedBy`),
  KEY `createtime` (`createtime`),
  KEY `sendip` (`sendip`),
  KEY `alerttype` (`alerttype`),
  KEY `ATMCode` (`ATMCode`)
) ENGINE=MyISAM AUTO_INCREMENT=1079252 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `exception_alerts`
--

DROP TABLE IF EXISTS `exception_alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exception_alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alert_string` text NOT NULL,
  `exception_msg` text NOT NULL,
  `edatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1382491 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `wsites`
--

DROP TABLE IF EXISTS `wsites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wsites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(20) CHARACTER SET utf8 NOT NULL,
  `wdata` text CHARACTER SET utf8 NOT NULL,
  `rtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `panelid` varchar(6) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rtime` (`rtime`),
  KEY `ip` (`ip`),
  KEY `panelid` (`panelid`),
  KEY `idx_wsites` (`panelid`,`rtime`)
) ENGINE=MyISAM AUTO_INCREMENT=24394173 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-26 13:00:18
