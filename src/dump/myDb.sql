--CREATE DATABASE  IF NOT EXISTS `bd_csa_spartax` /*!40100 DEFAULT CHARACTER SET latin1 */;
--USE `bd_csa_spartax`;
-- MySQL dump 10.13  Distrib 5.7.38, for Win64 (x86_64)
--
-- Host: 200.48.133.206    Database: bd_csa_spartax
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interfaz`
--

DROP TABLE IF EXISTS `interfaz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interfaz` (
  `idInterfaz` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) DEFAULT NULL,
  `Url` varchar(255) DEFAULT NULL,
  `Nivel` tinyint(1) DEFAULT NULL,
  `Modulo_Principal` int(11) DEFAULT NULL,
  `Modulo_Superior` int(11) DEFAULT NULL,
  `Orden` int(11) DEFAULT NULL,
  `Icono` varchar(30) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modificado_por` int(11) DEFAULT NULL,
  `Fecha_Modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idInterfaz`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interfaz`
--

LOCK TABLES `interfaz` WRITE;
/*!40000 ALTER TABLE `interfaz` DISABLE KEYS */;
INSERT INTO `interfaz` VALUES (1,'Seguridad','?c=Usuario&a=Index',1,1,0,1,'fa fa-user',1,1,'2016-04-30 02:17:36',1,'2022-09-20 21:41:53',0),(2,'Administracion','#',2,2,0,2,NULL,1,1,'2016-04-30 02:18:13',1,NULL,0),(3,'Gestion','#',3,3,0,3,NULL,1,1,'2016-10-21 18:19:53',1,NULL,0);
/*!40000 ALTER TABLE `interfaz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_sesion`
--

DROP TABLE IF EXISTS `log_sesion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log_sesion` (
  `idLog_Sesion` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(20) DEFAULT NULL,
  `Password` varchar(40) DEFAULT NULL,
  `LoggedIn` varchar(40) DEFAULT NULL,
  `IP` varchar(40) DEFAULT NULL,
  `Dispositivo` varchar(40) DEFAULT NULL,
  `NombreDispositivo` varchar(40) DEFAULT NULL,
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idLog_Sesion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_sesion`
--

LOCK TABLES `log_sesion` WRITE;
/*!40000 ALTER TABLE `log_sesion` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_sesion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `idPerfil` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modificado_por` int(11) DEFAULT NULL,
  `Fecha_Modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idPerfil`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
INSERT INTO `perfil` VALUES (1,'Root',1,1,'2022-09-20 16:19:39',1,'2022-09-20 18:19:24',0),(2,'Administrador',1,1,'2022-09-20 16:19:44',NULL,'2022-09-20 16:20:03',0),(3,'Back Office',1,1,'2022-09-20 16:19:47',NULL,'2022-09-20 16:20:04',0),(4,'Vendedor',1,1,'2022-09-20 16:19:52',NULL,'2022-09-20 16:20:07',0);
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permiso`
--

DROP TABLE IF EXISTS `permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permiso` (
  `idPermiso` int(11) NOT NULL AUTO_INCREMENT,
  `Perfil_id` int(11) NOT NULL DEFAULT '0',
  `Interfaz_id` int(11) NOT NULL DEFAULT '0',
  `Acceder` tinyint(1) DEFAULT '0',
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modificado_por` int(11) DEFAULT NULL,
  `Fecha_Modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idPermiso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permiso`
--

LOCK TABLES `permiso` WRITE;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
INSERT INTO `permiso` VALUES (1,1,1,1,1,1,'2016-10-21 19:06:20',NULL,'2016-10-21 19:06:27',0),(2,1,2,0,1,1,'2016-10-21 19:06:26',NULL,'2022-09-20 21:42:55',0),(3,1,3,1,1,1,'2016-10-21 19:06:37',NULL,NULL,0);
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `persona` (
  `idPersona` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo_Documento` char(10) DEFAULT NULL,
  `Documento` char(11) NOT NULL DEFAULT '',
  `Primer_Nombre` varchar(50) DEFAULT '',
  `Segundo_Nombre` varchar(50) DEFAULT '',
  `Apellido_Paterno` varchar(50) DEFAULT '',
  `Apellido_Materno` varchar(50) DEFAULT '',
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Sexo` char(1) NOT NULL DEFAULT '',
  `Celular` varchar(11) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Cargo_id_SubCategoria` int(11) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modificado_por` int(11) DEFAULT NULL,
  `Fecha_Modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idPersona`),
  UNIQUE KEY `dni` (`Documento`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,NULL,'71886624','Jose','Luis','Ayala','Benito','1996-06-07','M','945191447','jayalab@jpusoluciones.com',0,1,1,'2019-02-06 13:47:45',NULL,'2019-02-06 13:49:05',0),(2,NULL,'11111111','Supervisor','','1','','2019-02-06','F','','supervisor1@correo.com',1,1,1,'2019-02-06 14:21:03',2,'2019-02-06 16:16:02',0),(3,NULL,'22222222','Teleoperador','','Ventas','1','2019-02-06','F','','teleoperadorventas1@correo.com',1,1,1,'2019-02-06 14:23:48',NULL,NULL,0),(4,NULL,'33333333','Teleoperador','','Ventas','2','2019-02-06','F','','teleoperadorventas2@correo.com',1,1,1,'2019-02-06 14:25:57',NULL,NULL,0);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subcategoria`
--

DROP TABLE IF EXISTS `subcategoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subcategoria` (
  `idSubCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `Categoria_id` int(11) DEFAULT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idSubCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subcategoria`
--

LOCK TABLES `subcategoria` WRITE;
/*!40000 ALTER TABLE `subcategoria` DISABLE KEYS */;
/*!40000 ALTER TABLE `subcategoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Persona_id` int(11) NOT NULL DEFAULT '0',
  `Perfil_id` int(11) DEFAULT NULL,
  `Login` varchar(20) DEFAULT NULL,
  `Password` varchar(40) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modificado_por` int(11) DEFAULT NULL,
  `Fecha_Modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `login` (`Login`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,1,1,'16110401','16110401',1,0,'2019-02-06 13:49:59',1,'2019-02-06 14:21:13',0),(2,2,4,'19020601','19020601',1,1,'2019-02-06 14:21:26',1,'2022-09-20 18:55:21',0),(3,3,9,'19020602','19020602',1,1,'2019-02-06 14:26:07',NULL,NULL,0),(4,4,9,'19020603','19020603',1,1,'2019-02-06 14:26:15',NULL,NULL,0);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-20 19:18:59
