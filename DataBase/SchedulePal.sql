CREATE DATABASE  IF NOT EXISTS `schedulepal` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `schedulepal`;
-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: schedulepal
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `fakultas`
--

DROP TABLE IF EXISTS `fakultas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fakultas` (
  `id_fakultas` int NOT NULL AUTO_INCREMENT,
  `nama_fakultas` varchar(50) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_fakultas`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fakultas`
--

LOCK TABLES `fakultas` WRITE;
/*!40000 ALTER TABLE `fakultas` DISABLE KEYS */;
INSERT INTO `fakultas` VALUES (2,'Fakultas Teknik',NULL),(3,'Fakultas Ekonomi dan Bisnis',NULL),(4,'Fakultas Hukum',NULL),(5,'Fakultas Kedokteran',NULL),(6,'Fakultas Psikologi',NULL),(7,'Fakultas Ilmu Sosial dan Politik',NULL),(8,'Fakultas Seni Rupa dan Desain',NULL),(9,'Fakultas Matematika dan Ilmu Pengetahuan Alam',NULL),(10,'Fakultas Pertanian',NULL),(11,'Fakultas Admin',NULL),(12,'Fakultas  Gaming',NULL),(13,'Fakultas Pemancing',NULL);
/*!40000 ALTER TABLE `fakultas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `schedule` (
  `id_acara` int NOT NULL AUTO_INCREMENT,
  `judul_acara` varchar(50) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `waktu` time NOT NULL,
  `tanggal` date NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `status` enum('Diterima','Ditolak','Tunggu') DEFAULT NULL,
  `NIM` bigint DEFAULT NULL,
  `fakultas` int NOT NULL,
  PRIMARY KEY (`id_acara`),
  KEY `fakultas` (`fakultas`),
  KEY `NIM` (`NIM`),
  CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE CASCADE,
  CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`NIM`) REFERENCES `users` (`NIM`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
INSERT INTO `schedule` VALUES (9,'Seminar Ekonomi','Seminar tentang perkembangan ekonomi global.','13:00:00','2024-12-10','Aula Fakultas Ekonomi','Diterima',12345678903,3),(10,'Pelatihan Hukum','Pelatihan keterampilan hukum bagi mahasiswa.','10:00:00','2024-11-20','Ruang Diskusi Fakultas Hukum','Tunggu',12345678905,4),(12,'Pelatihan Hukum','Pelatihan keterampilan hukum bagi mahasiswa.','10:00:00','2024-11-20','Ruang Diskusi Fakultas Hukum','Tunggu',12345678905,4),(13,'test','test','03:02:00','2026-03-02','test','Tunggu',2309106000,2),(14,'Lomba Minecraft','akan di lakukan lomba di kampus','15:02:00','2024-02-03','unmul','Diterima',2309106000,2);
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `NIM` bigint NOT NULL,
  `username` varchar(20) NOT NULL,
  `fakultas` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`NIM`),
  KEY `fakultas` (`fakultas`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`fakultas`) REFERENCES `fakultas` (`id_fakultas`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (999,'admin',11,'$2y$10$9h3plJhS6R.nBD8d0AiCkuGW9AGaq0kmxT49.ZCC34p3R0oEYUm.y','admin',NULL),(2309106000,'dummy',2,'$2y$10$sQrefZjHvFm7hKp14fCQB.lAVrA6Oe9/dvC4gVgY6G.fS74UmeuWG','user','2309106000_1732284813_Screenshot (150).png'),(12345678902,'janedoe',2,'password456','user',NULL),(12345678903,'alice',3,'password789','admin',NULL),(12345678905,'charlie',4,'password654','user',NULL);
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

-- Dump completed on 2024-11-22 22:28:49
