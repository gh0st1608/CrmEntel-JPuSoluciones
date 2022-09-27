﻿# Host: 200.48.133.206  (Version 5.5.5-10.1.13-MariaDB)
# Date: 2022-09-27 01:15:13
# Generator: MySQL-Front 5.3  (Build 5.39)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "categoria"
#

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idCategoria`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "categoria"
#

/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (0,'SIN CATEGORIA',1,0,'2022-09-26 10:48:41',0),(1,'BASE LLAMADA',1,0,'2022-09-26 10:48:41',0),(2,'CAMPAÑA NETCALL',1,0,'2022-09-26 10:48:41',0),(3,'SUB CAMPAÑA',1,0,'2022-09-26 10:48:41',0),(4,'DETALLE SUB CAMPAÑA',1,0,'2022-09-26 10:48:41',0),(5,'CF MAX LINEA (MOVIL)',1,0,'2022-09-26 10:48:41',0),(6,'TIPO ETIQUETA',1,0,'2022-09-26 10:48:41',0),(7,'CANT MESES PARA FINANCIAR EQUIPOS',1,0,'2022-09-26 10:48:41',0),(8,'CLIENTE ENTEL',1,0,'2022-09-26 10:48:41',0),(9,'CLIENTE PROMO / DSCTO',1,0,'2022-09-26 10:48:41',0),(10,'TIPO DOCUMENTO',1,0,'2022-09-26 10:48:41',0),(11,'TIPO DESPACHO',1,0,'2022-09-26 10:48:41',0),(12,'RANGO ENTREGA DESPACHO',1,0,'2022-09-26 10:48:41',0),(13,'RANGO HORARIO DESPACHO',1,0,'2022-09-26 10:48:41',0),(14,'TIENDA RETIRO',1,0,'2022-09-26 10:48:41',0),(15,'RETAIL RETIRO',1,0,'2022-09-26 10:48:41',0),(16,'VENTA ENTREGA PARA',1,0,'2022-09-26 10:48:41',0),(17,'VENTA DESTINO PARA',1,0,'2022-09-26 10:48:41',0),(18,'TIPO DIRECCION ENTREGA',1,0,'2022-09-26 10:48:41',0),(19,'TIPO DE CONTACTO OL',1,0,'2022-09-26 10:48:41',0),(20,'TIPO OFRECIMIENTO',1,0,'2022-09-26 10:48:41',0),(21,'TIPO VENTA',1,0,'2022-09-26 10:48:41',0),(22,'OPERADOR CEDENTE',1,0,'2022-09-26 10:48:41',0),(23,'ORIGEN',1,0,'2022-09-26 10:48:41',0),(24,'PLAN TARIFARIO',1,0,'2022-09-26 10:48:41',0),(25,'CARGO FIJO PLAN',1,0,'2022-09-26 10:48:41',0),(26,'TIPO DE PRODUCTO',1,0,'2022-09-26 10:48:41',0),(27,'ACCESORIO DE REGALO',1,0,'2022-09-26 10:48:41',0),(28,'CANT ACCESORIOS',1,0,'2022-09-26 10:48:41',0),(29,'TIPO PAGO',1,0,'2022-09-26 10:48:41',0),(30,'PROMOCIONES BANCOS',1,0,'2022-09-26 10:48:41',0),(31,'ESTADO VENTA BO',1,0,'2022-09-26 10:48:41',0),(32,'SUB ESTADO VENTA BO',1,0,'2022-09-26 10:48:41',0),(33,'CANTIDAD ORDENES FICHA',1,0,'2022-09-26 10:48:41',0),(34,'FICHA LIMPIA',1,0,'2022-09-26 10:48:41',0),(35,'ERRORES COMUNES EN FICHA',1,0,'2022-09-26 10:48:41',0),(36,'TIPO DE ATENCION FINAL',1,0,'2022-09-26 10:48:41',0);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;