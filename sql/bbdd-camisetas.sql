CREATE DATABASE  IF NOT EXISTS `camisetas` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `camisetas`;
-- MySQL dump 10.13  Distrib 8.0.25, for macos11 (x86_64)
--
-- Host: 127.0.0.1    Database: camisetas
-- ------------------------------------------------------
-- Server version	5.7.44

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK de la tabla clientes, de tipo primary autoincremental.',
  `nombre` varchar(45) NOT NULL COMMENT 'nombre del cliente. de tipo varchar.',
  `apellido` varchar(45) NOT NULL COMMENT 'apellido del cliente de tipo varchar.',
  `direccion` varchar(45) NOT NULL COMMENT 'direccion del cliente de tipo varchar.',
  `telefono` varchar(9) NOT NULL COMMENT 'telefono del cliente de tipo varchar.',
  `email` varchar(45) NOT NULL COMMENT 'email del cliente, de tipo varchar , con indice unique.',
  `contrasenia` varchar(60) NOT NULL COMMENT 'contraseña del cliente, de tipo varchar.',
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (26,'maria','maria','maria','123456789','maria@gmail.com','$2y$10$qsqvl6YM0ui1kwDfO.kwZuh4VzDNBgUaKvYpAO3RJdRTDZBi6q9we'),(27,'David','David','David','123456789','David@gmail.com','$2y$10$c0dV3cwudIwTOgYdRCEzzeexVqtvnOjy3yEKRPZOk6f9sE/J5lgfy'),(28,'VIANCA TEREZA','FRANCO RODRIGUEZ','calle berrocal 3 portal K piso 5D','123456789','tereza@gmail.com','$2y$10$x67Ph4g6zhzvpuYiqy/LY.hRCLuaUW2j8jUZBdHXlt710ae4Rf91W'),(29,'ana','vega','calle berrocal 3','234234321','ana@gmail.com','$2y$10$Enh3QCChjqxPPRF7.EDNruxHwZF0Ulsl2qy8f/Ca5q4Ol7xSLFHb2');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL COMMENT 'fecha donde se realizo el pedido, de tipo date.',
  `id_cliente` int(11) NOT NULL COMMENT 'Fk de la tabla clientes , de tipo INT con indice Index.',
  `id_producto` int(11) NOT NULL COMMENT 'Fk de la tabla productos, de tipo INT con indice Index.',
  `cantidad_producto` int(11) NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `id_producto` (`id_producto`),
  KEY `id_pedido` (`id_cliente`,`id_producto`) USING BTREE,
  KEY `idx_pedido` (`id_pedido`),
  CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (82,'2024-01-05',26,100,2),(83,'2024-01-06',29,200,4);
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL COMMENT 'PK de la tabla producto , de indice Primary',
  `nombre` varchar(45) NOT NULL COMMENT 'nombre del producto, de tipo Varchar.',
  `precio` double(10,2) NOT NULL COMMENT 'precio del producto, de tipo double para almacenar los valores reales en doble precisión.',
  `imagen` text NOT NULL COMMENT 'imagen del producto , de tipo text .',
  PRIMARY KEY (`id_producto`),
  UNIQUE KEY `codigo_producto_UNIQUE` (`id_producto`),
  UNIQUE KEY `codigo` (`id_producto`),
  UNIQUE KEY `codigo_2` (`id_producto`),
  KEY `idx_producto` (`id_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (100,'React',4.80,'img/imagen1.jpg'),(200,'Javascript',9.50,'img/imagen2.jpg'),(300,'Githud',8.50,'img/imagen3.jpg'),(400,'Drupal',8.50,'img/imagen4.jpg'),(500,'Html5',11.00,'img/imagen5.jpg'),(600,'Sass',11.00,'img/imagen7.jpg'),(700,'Nodejs',11.00,'img/imagen8.jpg'),(800,'Typescript',11.00,'img/imagen5.jpg');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-06 12:46:18
