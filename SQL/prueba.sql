-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: basededatosprueba
-- ------------------------------------------------------
-- Server version	8.0.33

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
-- Table structure for table `candidato`
--

DROP TABLE IF EXISTS `candidato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `candidato` (
  `idcandidato` int NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcandidato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidato`
--

LOCK TABLES `candidato` WRITE;
/*!40000 ALTER TABLE `candidato` DISABLE KEYS */;
INSERT INTO `candidato` VALUES (3,'Jose Galleguillos'),(4,'Kim jong Un');
/*!40000 ALTER TABLE `candidato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comunas`
--

DROP TABLE IF EXISTS `comunas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comunas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `idRegion` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idRegion` (`idRegion`),
  CONSTRAINT `comunas_ibfk_1` FOREIGN KEY (`idRegion`) REFERENCES `regiones` (`idRegion`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comunas`
--

LOCK TABLES `comunas` WRITE;
/*!40000 ALTER TABLE `comunas` DISABLE KEYS */;
INSERT INTO `comunas` VALUES (1,'Arica',15),(2,'Camarones',15),(3,'Iquique',1),(4,'Alto Hospicio',1),(5,'Antofagasta',2),(6,'Mejillones',2),(7,'Copiapó',3),(8,'Tierra Amarilla',3),(9,'La Serena',4),(10,'Coquimbo',4),(11,'Valparaíso',5),(12,'Viña del Mar',5),(13,'Santiago',13),(14,'Puente Alto',13),(15,'Rancagua',6),(16,'Machalí',6),(17,'Talca',7),(18,'Curicó',7),(19,'Chillán',16),(20,'Bulnes',16),(21,'Concepción',8),(22,'Talcahuano',8),(23,'Temuco',9),(24,'Padre Las Casas',9),(25,'Valdivia',14),(26,'La Unión',14),(27,'Puerto Montt',10),(28,'Osorno',10),(29,'Coyhaique',11),(30,'Puerto Aysén',11),(31,'Punta Arenas',12),(32,'Cabo de Hornos (Ex Navarino)',12),(33,'Antártica',12),(34,'Porvenir',12),(35,'Río Verde',12),(36,'Primavera',12),(37,'Timaukel',12);
/*!40000 ALTER TABLE `comunas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formulario`
--

DROP TABLE IF EXISTS `formulario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formulario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_apellido` varchar(255) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `rut` varchar(20) NOT NULL,
  `region_id` int NOT NULL,
  `comuna_id` int NOT NULL,
  `candidato_id` int NOT NULL,
  `fecha_votacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rut` (`rut`),
  KEY `region_id` (`region_id`),
  KEY `comuna_id` (`comuna_id`),
  KEY `candidato_id` (`candidato_id`),
  CONSTRAINT `formulario_ibfk_1` FOREIGN KEY (`region_id`) REFERENCES `regiones` (`idRegion`),
  CONSTRAINT `formulario_ibfk_2` FOREIGN KEY (`comuna_id`) REFERENCES `comunas` (`id`),
  CONSTRAINT `formulario_ibfk_3` FOREIGN KEY (`candidato_id`) REFERENCES `candidato` (`idcandidato`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formulario`
--

LOCK TABLES `formulario` WRITE;
/*!40000 ALTER TABLE `formulario` DISABLE KEYS */;
INSERT INTO `formulario` VALUES (1,'andres garcia','andres12','velizandres96@gmail.com','19396500-8',2,6,3,'2023-06-13 01:43:23'),(2,'andres garcia','andres12','velizandres96@gmail.com','19256883.8',2,5,3,'2023-06-13 01:43:38');
/*!40000 ALTER TABLE `formulario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regiones`
--

DROP TABLE IF EXISTS `regiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `regiones` (
  `idRegion` int NOT NULL,
  `nombre_region` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idRegion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regiones`
--

LOCK TABLES `regiones` WRITE;
/*!40000 ALTER TABLE `regiones` DISABLE KEYS */;
INSERT INTO `regiones` VALUES (1,'Región de Tarapacá'),(2,'Región de Antofagasta'),(3,'Región de Atacama'),(4,'Región de Coquimbo'),(5,'Región de Valparaíso'),(6,'Región del Lib Gral Bernardo O\'Higgins'),(7,'Región del Maule'),(8,'Región del Biobío'),(9,'Región de La Araucanía'),(10,'Región de Los Lagos'),(11,'Región de Aysén'),(12,'Región de Magallanes'),(13,'Región Metropolitana'),(14,'Región de Los Ríos'),(15,'Región de Arica y Parinacota'),(16,'Región de Ñuble');
/*!40000 ALTER TABLE `regiones` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-12 21:49:12
