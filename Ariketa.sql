-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: ml
-- ------------------------------------------------------
-- Server version	8.0.39

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `produktuak`
--

DROP TABLE IF EXISTS `produktuak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produktuak` (
  `id` int NOT NULL AUTO_INCREMENT,
  `izena` varchar(255) NOT NULL,
  `mota` varchar(100) NOT NULL,
  `prezioa` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produktuak`
--

LOCK TABLES `produktuak` WRITE;
/*!40000 ALTER TABLE `produktuak` DISABLE KEYS */;
INSERT INTO `produktuak` VALUES (3,'Consola PlayStation 5','Kontsola',499.99),(4,'Consola Xbox Series X','Kontsola',499.99),(5,'Nintendo Switch OLED','Kontsola',349.99),(6,'Entzungailu Gaming','Cascos',79.99),(7,'Entzungailu Bluetooth','Cascos',49.99),(8,'Pantaila Gaming 144Hz','Periferiko',199.99),(9,'Teclatu Mekanikoa','Periferiko',99.99),(10,'Sagua Inalabrikoduna','Periferiko',59.99),(11,'Webkamera Full HD','Periferiko',69.99),(12,'Impresora Multifuntzioa','Periferiko',129.99),(13,'Altaboz Bluetooth','Periferiko',59.99),(14,'Micrófono Streaming','Periferiko',89.99),(15,'Diska Gogorra 1TB','Portatil',79.99),(16,'SSD NVMe 512GB','Portatil',99.99),(17,'RAM 16GB DDR4','Portatil',89.99),(18,'Plaka Base B550','Portatil',149.99),(19,'Prozesadore Ryzen 5','Portatil',229.99),(20,'GPU RTX 4060','Portatil',399.99),(21,'Router WiFi 6','Periferiko',129.99),(22,'Switch Ethernet 8 Portu','Periferiko',49.99),(23,'Power Bank 20000mAh','Periferiko',39.99),(25,'USB Hub 4 Portu','Periferiko',19.99),(26,'Kit Hozte RGB','Periferiko',49.99),(27,'Silla Gaming','Periferiko',179.99),(28,'Raspberry Pi 4','Periferiko',69.99),(29,'ad','Kontsola',232.00),(30,'ad','Kontsola',232.00);
/*!40000 ALTER TABLE `produktuak` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-30 23:19:45
