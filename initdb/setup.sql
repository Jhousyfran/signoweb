CREATE DATABASE  IF NOT EXISTS `signo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `signo`;
-- MySQL dump 10.13  Distrib 5.7.30, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: signo
-- ------------------------------------------------------
-- Server version	5.7.28

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
-- Table structure for table `enquetes`
--

DROP TABLE IF EXISTS `enquetes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enquetes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(350) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `criado_em` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enquetes`
--

LOCK TABLES `enquetes` WRITE;
/*!40000 ALTER TABLE `enquetes` DISABLE KEYS */;
INSERT INTO `enquetes` VALUES (11,'Seu voto para presidente?','2020-07-18','2020-07-22','2020-07-18 17:25:08'),(12,'Qual melhor Jogador do mundo??','2020-07-20','2020-07-31','2020-07-18 18:10:48'),(13,'Melhor Desenho ?','2020-07-01','2020-07-11','2020-07-18 21:52:18');
/*!40000 ALTER TABLE `enquetes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-18 23:40:04

--
-- Table structure for table `enquete_respostas`
--

DROP TABLE IF EXISTS `enquete_respostas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enquete_respostas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `resposta` varchar(350) NOT NULL,
  `enquete_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enquete_respostas_enquetes_idx` (`enquete_id`),
  CONSTRAINT `fk_enquete_respostas_enquetes` FOREIGN KEY (`enquete_id`) REFERENCES `enquetes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enquete_respostas`
--

LOCK TABLES `enquete_respostas` WRITE;
/*!40000 ALTER TABLE `enquete_respostas` DISABLE KEYS */;
INSERT INTO `enquete_respostas` VALUES (4,'Bolsonaro',11),(5,'Ciro Gomes',11),(6,'Marina',11),(7,'Lula',11),(8,'Sergio Moro',11),(69,'Dragon Ball Z',13),(70,'Os simpsons',13),(71,'Medabots',13),(72,'Super 11',13),(73,'Neymar Jr',12),(74,'Cristiano Ronaldo',12),(75,'Lionel Messi',12);
/*!40000 ALTER TABLE `enquete_respostas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-18 23:40:04



--
-- Table structure for table `enquete_votos`
--

DROP TABLE IF EXISTS `enquete_votos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enquete_votos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `enquete_id` bigint(20) NOT NULL,
  `resposta_id` bigint(20) NOT NULL,
  `criado_em` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enquete_votos_enquetes1_idx` (`enquete_id`),
  KEY `fk_enquete_votos_enquete_respostas1_idx` (`resposta_id`),
  CONSTRAINT `fk_enquete_votos_enquete_respostas1` FOREIGN KEY (`resposta_id`) REFERENCES `enquete_respostas` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_enquete_votos_enquetes1` FOREIGN KEY (`enquete_id`) REFERENCES `enquetes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enquete_votos`
--

LOCK TABLES `enquete_votos` WRITE;
/*!40000 ALTER TABLE `enquete_votos` DISABLE KEYS */;
INSERT INTO `enquete_votos` VALUES (1,11,5,'2020-07-18 22:37:32'),(2,11,4,'2020-07-18 22:37:53'),(3,11,7,'2020-07-18 22:37:56'),(4,11,4,'2020-07-18 22:37:58'),(5,11,8,'2020-07-18 22:38:39'),(6,11,4,'2020-07-18 22:38:45'),(7,11,4,'2020-07-18 22:51:05'),(8,11,4,'2020-07-18 22:51:17'),(9,11,4,'2020-07-18 22:51:19'),(10,11,4,'2020-07-18 22:51:21'),(11,11,8,'2020-07-18 22:51:22'),(12,11,6,'2020-07-18 22:51:24'),(13,11,6,'2020-07-18 22:51:25'),(14,11,4,'2020-07-19 02:09:15'),(15,11,5,'2020-07-19 02:09:30');
/*!40000 ALTER TABLE `enquete_votos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-07-18 23:40:04
