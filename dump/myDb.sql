-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 30-09-2022 a las 19:59:41
-- Versión del servidor: 5.7.39
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `myDb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`%` PROCEDURE `ProcInsertInterfaz` (IN `P_Nombre` VARCHAR(50), IN `P_Url` VARCHAR(255), IN `P_Nivel` INT, IN `P_Modulo_principal` INT, IN `P_IdInterfaz_superior` INT, IN `P_Orden` INT, IN `P_Icono` VARCHAR(30), IN `P_Estado` INT, IN `P_Ingresado_por` INT, IN `P_Fecha_Registro` DATE, IN `P_Modificado_por` INT, IN `P_Fecha_Modificacion` DATE)   BEGIN
  
  IF (P_Nivel = 1 )
  THEN 
 
 UPDATE interfaz
 SET Orden = Orden + 1
 WHERE Orden >= P_Orden AND
 Nivel = P_Nivel ;
    
    INSERT INTO interfaz(Nombre,Url,Nivel,Modulo_Principal,IdInterfaz_Superior,Orden,Icono,Estado,Ingresado_por,Fecha_registro) 
     VALUES(P_Nombre,P_Url,P_Nivel,P_Modulo_Principal,0,P_Orden,P_Icono,1,P_Ingresado_por,sysdate());
 
 
 ELSEIF ( P_Nivel = 2 	
) THEN
 
 UPDATE interfaz
 SET Orden = Orden + 1
 WHERE Orden >= P_Orden AND
 Nivel = 2 and IdInterfaz_superior = P_IdInterfaz_superior;
 
INSERT INTO interfaz(Nombre,Url,Nivel,Modulo_Principal,IdInterfaz_Superior,Orden,Icono,Estado,Ingresado_por,Fecha_registro) VALUES(P_Nombre,P_Url,P_Nivel,P_Modulo_Principal,P_IdInterfaz_Superior,P_Orden,P_Icono,1,P_Ingresado_por, sysdate());
 
 
 
 
  ELSEIF ( P_Nivel = 3
) THEN

 UPDATE interfaz
 SET Orden = Orden + 1
 WHERE Orden >= P_Orden AND
 Nivel = 3 and IdInterfaz_superior = P_IdInterfaz_superior;
 
INSERT INTO interfaz(Nombre,Url,Nivel,Modulo_Principal,IdInterfaz_Superior,Orden,Icono,Estado,Ingresado_por,Fecha_registro) VALUES(P_Nombre,P_Url,P_Nivel,P_Modulo_Principal,P_IdInterfaz_Superior,P_Orden,P_Icono,1,P_Ingresado_por,sysdate());
 
 

 
END IF;
 
 
END$$

CREATE DEFINER=`root`@`%` PROCEDURE `ProcInsertLogSesion` (IN `P_Login` VARCHAR(20), IN `P_Password` VARCHAR(40), IN `P_LoggedIn` VARCHAR(40), IN `P_IP` VARCHAR(40), IN `P_Dispositivo` VARCHAR(40), IN `P_NombreDispositivo` VARCHAR(40))   BEGIN
  
  IF (P_Password = '' OR  P_Login = '' )
  THEN 
    select 0 as Estado  ;
 ELSEIF EXISTS (
   SELECT * FROM log_sesion
   WHERE LoggedIn = 'Si'
and IP =  P_IP 
and Login = P_Login
and Password = P_Password
and Dispositivo = P_Dispositivo
and NombreDispositivo = P_NombreDispositivo 	
) AND  P_LoggedIn ='Si' THEN
 
select 1 as Estado, Login,			IP,	Dispositivo,	NombreDispositivo  from  log_sesion 
where LoggedIn ='Si' and  Login = P_Login
and Password = P_Password ;

ELSEIF NOT EXISTS (
   SELECT * FROM log_sesion
   WHERE LoggedIn = 'Si'
and  Login = P_Login
and Password = P_Password
   ) AND  P_LoggedIn ='Si' THEN

INSERT INTO  log_sesion (Login,	Password,	LoggedIn,	IP,	Dispositivo,	NombreDispositivo,
IdEstadoKanBanDetalle		)
    VALUES (P_Login,	P_Password,	P_LoggedIn,	P_IP,	P_Dispositivo,	P_NombreDispositivo,
1
 );
  select 1 as Estado, Login,			IP,	Dispositivo,	NombreDispositivo  from  log_sesion 
where LoggedIn ='Si' and  Login = P_Login
and Password = P_Password ; 
 
 ELSEIF  EXISTS (
   SELECT * FROM log_sesion
   WHERE LoggedIn = 'Si'
and  Login = P_Login
and Password = P_Password
and (IP <>  P_IP  
or Dispositivo <> P_Dispositivo
or NombreDispositivo <> P_NombreDispositivo )	
) AND  P_LoggedIn ='Si' THEN

  INSERT INTO  log_sesion (Login,	Password,	LoggedIn,	IP,	Dispositivo,	NombreDispositivo,
IdEstadoKanBanDetalle		)
    VALUES (P_Login,	P_Password,	'No',	P_IP,	P_Dispositivo,	P_NombreDispositivo,
3
 );
  select 0 as Estado;
   
ELSE

    INSERT INTO  log_sesion (Login,	Password,	LoggedIn,	IP,	Dispositivo,	NombreDispositivo,
IdEstadoKanBanDetalle		)
    VALUES (P_Login,	P_Password,	P_LoggedIn,	P_IP,	P_Dispositivo,	P_NombreDispositivo,
2
 );
select 0 as Estado;

END IF;
--
SET @intento  = 0   ; 

SELECT COUNT(1) INTO @intento  FROM log_sesion
WHERE LoggedIn = 'No' 
and Login = P_Login
and IdEstadoKanBanDetalle = 2;
--
  
  IF  @intento >=3
  THEN 
   update usuario 
   set Estado = 2
   where Login = P_Login;
 
  END IF;
 
END$$

CREATE DEFINER=`root`@`%` PROCEDURE `ProcUpdateInterfaz` (IN `P_IdInterfaz` INT, IN `P_Nombre` VARCHAR(50), IN `P_Url` VARCHAR(255), IN `P_Nivel` INT, IN `P_Modulo_principal` INT, IN `P_IdInterfaz_superior` INT, IN `P_Orden` INT, IN `P_Icono` VARCHAR(30), IN `P_Estado` INT, IN `P_Ingresado_por` INT, IN `P_Fecha_Registro` DATE, IN `P_Modificado_por` INT, IN `P_Fecha_Modificacion` DATE)   BEGIN
 
     UPDATE interfaz
     SET Orden = Orden + 1
     WHERE Orden >= P_Orden AND
     Nivel = P_Nivel ;
    
    UPDATE   interfaz
    SET Nombre = P_Nombre,
    Url = P_Url,
    Orden = P_Orden, 
    IdInterfaz_superior = P_IdInterfaz_Superior,
    Modificado_por = P_Ingresado_por,
    Fecha_Modificacion = sysdate() 
    WHERE idInterfaz = P_idInterfaz;
      
 
END$$

CREATE DEFINER=`root`@`%` PROCEDURE `ProcUpdateLogSesion` (IN `P_Login` VARCHAR(20), IN `P_Password` VARCHAR(40), IN `P_LoggedIn` VARCHAR(40), IN `P_IP` VARCHAR(40), IN `P_Dispositivo` VARCHAR(40), IN `P_NombreDispositivo` VARCHAR(40))   BEGIN
 
    UPDATE  log_sesion   
    SET   LoggedIn = 'No',	
          Fecha_Cierre = sysdate()
	WHERE Login = P_Login AND 
          IP = P_IP AND	
          Dispositivo = P_Dispositivo AND	
          NombreDispositivo = P_NombreDispositivo;  
 	
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `Nombre`, `Estado`, `Ingresado_por`, `Fecha_Registro`, `Eliminado`) VALUES
(52, 'categoria 1', 0, 1, '2022-09-24 23:45:40', 1),
(53, 'DEMO5', 0, 1, '2022-09-24 23:51:03', 1),
(55, 'SIN CATEGORIAA', 1, 1, '2022-09-26 10:48:41', 0),
(1, 'BASE LLAMADA', 1, 0, '2022-09-26 10:48:41', 0),
(2, 'CAMPAÑA NETCALL', 1, 0, '2022-09-26 10:48:41', 0),
(3, 'SUB CAMPAÑA', 1, 0, '2022-09-26 10:48:41', 0),
(4, 'DETALLE SUB CAMPAÑA', 1, 0, '2022-09-26 10:48:41', 0),
(5, 'CF MAX LINEA (MOVIL)', 1, 0, '2022-09-26 10:48:41', 0),
(6, 'TIPO ETIQUETA', 1, 0, '2022-09-26 10:48:41', 0),
(7, 'CANT MESES PARA FINANCIAR EQUIPOS', 1, 0, '2022-09-26 10:48:41', 0),
(8, 'CLIENTE ENTEL', 1, 0, '2022-09-26 10:48:41', 0),
(9, 'CLIENTE PROMO / DSCTO', 1, 0, '2022-09-26 10:48:41', 0),
(10, 'TIPO DOCUMENTO', 1, 0, '2022-09-26 10:48:41', 0),
(11, 'TIPO DESPACHO', 1, 0, '2022-09-26 10:48:41', 0),
(12, 'RANGO ENTREGA DESPACHO', 1, 0, '2022-09-26 10:48:41', 0),
(13, 'RANGO HORARIO DESPACHO', 1, 0, '2022-09-26 10:48:41', 0),
(14, 'TIENDA RETIRO', 1, 0, '2022-09-26 10:48:41', 0),
(15, 'RETAIL RETIRO', 1, 0, '2022-09-26 10:48:41', 0),
(16, 'VENTA ENTREGA PARA', 1, 0, '2022-09-26 10:48:41', 0),
(17, 'VENTA DESTINO PARA', 1, 0, '2022-09-26 10:48:41', 0),
(18, 'TIPO DIRECCION ENTREGA', 1, 0, '2022-09-26 10:48:41', 0),
(19, 'TIPO DE CONTACTO OL', 1, 0, '2022-09-26 10:48:41', 0),
(20, 'TIPO OFRECIMIENTO', 1, 0, '2022-09-26 10:48:41', 0),
(21, 'TIPO VENTA', 1, 0, '2022-09-26 10:48:41', 0),
(22, 'OPERADOR CEDENTE', 1, 0, '2022-09-26 10:48:41', 0),
(23, 'ORIGEN', 1, 0, '2022-09-26 10:48:41', 0),
(24, 'PLAN TARIFARIO', 1, 0, '2022-09-26 10:48:41', 0),
(25, 'CARGO FIJO PLAN', 1, 0, '2022-09-26 10:48:41', 0),
(26, 'TIPO DE PRODUCTO', 1, 0, '2022-09-26 10:48:41', 0),
(27, 'ACCESORIO DE REGALO', 1, 0, '2022-09-26 10:48:41', 0),
(28, 'CANT ACCESORIOS', 1, 0, '2022-09-26 10:48:41', 0),
(29, 'TIPO PAGO', 1, 0, '2022-09-26 10:48:41', 0),
(30, 'PROMOCIONES BANCOS', 1, 0, '2022-09-26 10:48:41', 0),
(31, 'ESTADO VENTA BO', 1, 0, '2022-09-26 10:48:41', 0),
(32, 'SUB ESTADO VENTA BO', 1, 0, '2022-09-26 10:48:41', 0),
(33, 'CANTIDAD ORDENES FICHA', 1, 0, '2022-09-26 10:48:41', 0),
(34, 'FICHA LIMPIA', 1, 0, '2022-09-26 10:48:41', 0),
(35, 'ERRORES COMUNES EN FICHA', 1, 0, '2022-09-26 10:48:41', 0),
(36, 'TIPO DE ATENCION FINAL', 1, 0, '2022-09-26 10:48:41', 0),
(56, 'Cargo', 1, 1, '2022-09-27 19:11:59', 0),
(57, 'TEST 1', 1, 1, '2022-09-27 19:28:37', 0),
(58, 'TipoDocumento', 1, 1, '2022-09-28 02:28:48', 0),
(59, 'Sexo', 1, 1, '2022-09-29 06:21:34', 0),
(60, 'TIPO VENTA', 1, 1, '2022-09-29 19:47:37', 0),
(61, 'TESTYAA', 1, 1, '2022-09-29 20:24:23', 0),
(62, 'PRUEBA GAA 2', 1, 1, '2022-09-29 20:30:51', 0),
(63, 'test1000', 1, 1, '2022-09-29 21:00:04', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EstadoKanBan`
--

CREATE TABLE `EstadoKanBan` (
  `IdEstadoKanBan` int(11) NOT NULL,
  `NomEstadoKanBan` varchar(100) NOT NULL,
  `Estado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `EstadoKanBan`
--

INSERT INTO `EstadoKanBan` (`IdEstadoKanBan`, `NomEstadoKanBan`, `Estado`) VALUES
(1, 'Registro de Session', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `EstadoKanBanDetalle`
--

CREATE TABLE `EstadoKanBanDetalle` (
  `IdEstadoKanBanDetalle` int(11) NOT NULL,
  `IdEstadoKanBan` int(11) NOT NULL,
  `NomEstadoKanBanDetalle` varchar(100) NOT NULL,
  `Estado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `EstadoKanBanDetalle`
--

INSERT INTO `EstadoKanBanDetalle` (`IdEstadoKanBanDetalle`, `IdEstadoKanBan`, `NomEstadoKanBanDetalle`, `Estado`) VALUES
(1, 1, 'Acceso exitoso', 'A'),
(2, 1, 'Usuario y/o contraseña incorrectos', 'A'),
(3, 1, 'Ya existe una conexion en otro equipo', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interfaz`
--

CREATE TABLE `interfaz` (
  `idInterfaz` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Url` varchar(255) DEFAULT NULL,
  `Nivel` tinyint(1) DEFAULT NULL,
  `Modulo_Principal` int(11) DEFAULT NULL,
  `idInterfaz_superior` int(11) DEFAULT NULL,
  `Orden` int(11) DEFAULT NULL,
  `Icono` varchar(30) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modificado_por` int(11) DEFAULT NULL,
  `Fecha_Modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `interfaz`
--

INSERT INTO `interfaz` (`idInterfaz`, `Nombre`, `Url`, `Nivel`, `Modulo_Principal`, `idInterfaz_superior`, `Orden`, `Icono`, `Estado`, `Ingresado_por`, `Fecha_Registro`, `Modificado_por`, `Fecha_Modificacion`, `Eliminado`) VALUES
(1, 'Seguridad', '#', 1, 1, 0, 2, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-30 19:46:06', 0),
(2, 'Administracion', '#', 1, 2, 0, 3, NULL, 1, 1, '2016-04-30 02:18:13', 1, '2022-09-30 19:46:06', 0),
(3, 'Procesos', '#', 1, 3, 0, 4, NULL, 1, 1, '2016-10-21 18:19:53', 1, '2022-09-30 19:46:06', 0),
(4, 'Ventas', '#', 1, 4, 0, 5, NULL, 1, 1, '2016-10-21 18:19:53', 1, '2022-09-30 19:46:06', 0),
(5, 'Reportes', '#', 1, 5, 0, 6, NULL, 1, 1, '2016-10-21 18:19:53', 1, '2022-09-30 19:46:06', 0),
(6, 'Dashboard', '#', 1, 6, 0, 7, NULL, 1, 1, '2016-10-21 18:19:53', 1, '2022-09-30 19:46:06', 0),
(7, 'Interfaz', 'index.php?c=Interfaz', 2, 1, 1, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 05:51:00', 0),
(8, 'Perfil', 'index.php?c=Perfil', 2, 1, 1, 2, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:20:12', 0),
(9, 'Usuario', 'index.php?c=Usuario', 2, 1, 1, 3, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-28 16:24:45', 0),
(10, 'Persona', 'index.php?c=Persona', 2, 2, 2, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:21:08', 0),
(11, 'Categoria', 'index.php?c=Categoria', 2, 2, 2, 2, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:21:20', 0),
(12, 'SubCategoria', 'index.php?c=SubCategoria', 2, 2, 2, 3, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:21:30', 0),
(13, 'Importar', 'index.php?c=#', 2, 3, 3, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:22:18', 0),
(14, 'Registra y Actualizar Ficha', 'index.php?c=#', 2, 4, 4, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:21:55', 0),
(15, 'Visualizar Ficha', 'index.php?c=#', 2, 4, 4, 2, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:21:52', 0),
(16, 'Listar Fichas', 'index.php?c=#', 2, 4, 4, 3, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:22:35', 0),
(17, 'Ventas', 'index.php?c=#', 2, 5, 5, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:21:46', 0),
(18, 'Metricas Vendedor', 'index.php?c=#', 2, 6, 6, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:22:45', 0),
(19, 'Metricas Back Office', 'index.php?c=#', 2, 6, 6, 2, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:22:57', 0),
(23, 'ConsultasExternas', 'index.php?c=Consultas', 1, NULL, 0, 8, '<i class=\"fa fa-eye\"></i> ', 1, 1, '2022-09-30 19:46:06', 0, '2022-09-30 19:56:05', 1),
(24, 'Reniec', 'index.php?c=Interfaz&a=v_Registrar', 2, 23, 23, 1, '<i class=\"fa fa-trash\"></i> ', 1, 1, '2022-09-30 19:50:07', NULL, '2022-09-30 19:55:58', 1),
(25, 'Registrar', 'index?c=ConsultasExternas&a=v_Registrar', 3, 23, 24, 1, '<i class=\"fa fa-trash\"></i> ', 1, 1, '2022-09-30 19:53:38', NULL, '2022-09-30 19:55:47', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_sesion`
--

CREATE TABLE `log_sesion` (
  `idLog_Sesion` int(11) NOT NULL,
  `Login` varchar(20) DEFAULT NULL,
  `Password` varchar(40) DEFAULT NULL,
  `LoggedIn` varchar(40) DEFAULT NULL,
  `IP` varchar(40) DEFAULT NULL,
  `Dispositivo` varchar(40) DEFAULT NULL,
  `NombreDispositivo` varchar(40) DEFAULT NULL,
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Fecha_Cierre` timestamp NULL DEFAULT NULL,
  `IdEstadoKanBanDetalle` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `log_sesion`
--

INSERT INTO `log_sesion` (`idLog_Sesion`, `Login`, `Password`, `LoggedIn`, `IP`, `Dispositivo`, `NombreDispositivo`, `Fecha_Registro`, `Fecha_Cierre`, `IdEstadoKanBanDetalle`) VALUES
(335, '16110401', '16110401', 'Si', '172.27.0.1', 'Windows', 'Other', '2022-09-30 19:40:45', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `idPerfil` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modificado_por` int(11) DEFAULT NULL,
  `Fecha_Modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`idPerfil`, `Nombre`, `Estado`, `Ingresado_por`, `Fecha_Registro`, `Modificado_por`, `Fecha_Modificacion`, `Eliminado`) VALUES
(1, 'Root', 1, 1, '2022-09-20 16:19:39', 1, '2022-09-20 18:19:24', 0),
(2, 'Administrador', 1, 1, '2022-09-20 16:19:44', NULL, '2022-09-20 16:20:03', 0),
(3, 'Back Office', 1, 1, '2022-09-20 16:19:47', NULL, '2022-09-20 16:20:04', 0),
(4, 'Vendedor', 0, 1, '2022-09-20 16:19:52', 1, '2022-09-29 23:30:26', 1),
(5, 'Perfil Test', 0, 1, '2022-09-29 19:54:23', 1, '2022-09-29 23:30:22', 1),
(6, 'TESTING', 0, 1, '2022-09-29 23:21:20', 1, '2022-09-29 23:30:29', 1),
(7, 'testing', 0, 1, '2022-09-29 23:24:21', NULL, NULL, 0),
(8, 'ultimo', 0, 1, '2022-09-29 23:25:30', 1, '2022-09-29 23:26:23', 0),
(9, 'HOLI', 1, 1, '2022-09-30 19:43:55', 1, '2022-09-30 19:44:41', 1),
(10, 'HOLI2', 1, 1, '2022-09-30 19:44:33', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idPermiso` int(11) NOT NULL,
  `Perfil_id` int(11) NOT NULL DEFAULT '0',
  `Interfaz_id` int(11) NOT NULL DEFAULT '0',
  `Acceder` tinyint(1) DEFAULT '0',
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modificado_por` int(11) DEFAULT NULL,
  `Fecha_Modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idPermiso`, `Perfil_id`, `Interfaz_id`, `Acceder`, `Estado`, `Ingresado_por`, `Fecha_Registro`, `Modificado_por`, `Fecha_Modificacion`, `Eliminado`) VALUES
(1, 1, 1, 1, 1, 1, '2016-10-21 19:06:20', NULL, '2016-10-21 19:06:27', 0),
(2, 1, 2, 0, 1, 1, '2016-10-21 19:06:26', NULL, '2022-09-20 21:42:55', 0),
(3, 1, 3, 1, 1, 1, '2016-10-21 19:06:37', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idPersona` int(11) NOT NULL,
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
  `Fecha_Ingreso` varchar(20) DEFAULT NULL,
  `Eliminado` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idPersona`, `Tipo_Documento`, `Documento`, `Primer_Nombre`, `Segundo_Nombre`, `Apellido_Paterno`, `Apellido_Materno`, `Fecha_Nacimiento`, `Sexo`, `Celular`, `Correo`, `Cargo_id_SubCategoria`, `Estado`, `Ingresado_por`, `Fecha_Registro`, `Modificado_por`, `Fecha_Modificacion`, `Fecha_Ingreso`, `Eliminado`) VALUES
(1, 'DNI', '71886624', 'Joseito2', 'Juliño2', 'Ayalalito', 'Benitito', '1996-06-07', 'M', '999111333', 'jayalabgaa@jpusoluciones.com', NULL, 1, 1, '2019-02-06 13:47:45', 1, '2022-09-29 07:17:46', NULL, 0),
(2, 'DNI', '11111111', 'Supervisor', '', '1', '', '2019-02-06', 'F', '', 'supervisor1@correo.com', 1, 1, 1, '2019-02-06 14:21:03', 1, '2022-09-29 04:32:53', NULL, 1),
(3, 'CE', '22222222', 'Teleoperador', '', 'Ventas', '1', '2019-02-06', 'F', '', 'teleoperadorventas1@correo.com', 1, 1, 1, '2019-02-06 14:23:48', 1, '2022-09-29 04:32:56', NULL, 1),
(4, 'RUC', '33333333', 'Teleoperador', '', 'Ventas', '2', '2019-02-06', 'F', '', 'teleoperadorventas2@correo.com', 1, 1, 1, '2019-02-06 14:25:57', 1, '2022-09-29 04:32:59', NULL, 1),
(30, 'DNI', '51111111', 'ERI', 'ERI', 'ERI', 'ERI', NULL, '', NULL, NULL, NULL, 1, 0, '2022-09-29 22:22:09', NULL, NULL, NULL, 0),
(28, 'CE', '41516161', 'haaha', 'aaaaa', 'ahaha', 'nmsaa', NULL, '', NULL, NULL, NULL, 1, 0, '2022-09-29 22:13:15', NULL, NULL, NULL, 0),
(29, 'DNI', '51515151', 'ba', 'ba', 'ba', 'ba', NULL, '', NULL, NULL, NULL, 1, 0, '2022-09-29 22:20:44', NULL, NULL, NULL, 0),
(27, 'DNI', '44444444', 'tast', 'tast', 'tast', 'tast', '1900-09-16', 'M', '912392321', 'erickmga123@gmail.com', NULL, 0, 0, '2022-09-29 19:41:33', 1, '2022-09-29 19:43:14', NULL, 0),
(26, 'DNI', '12345678', 'ERICK', 'ERICK', 'ERICK', 'ERICK', NULL, '', NULL, NULL, NULL, 1, 0, '2022-09-29 04:34:04', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `idSubCategoria` int(11) NOT NULL,
  `Categoria_id` int(11) NOT NULL DEFAULT '0',
  `Nombre` varchar(255) DEFAULT NULL,
  `Orden` int(10) NOT NULL DEFAULT '1',
  `Aplicar_Logica` tinyint(3) DEFAULT '0',
  `Logica_Json` text,
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`idSubCategoria`, `Categoria_id`, `Nombre`, `Orden`, `Aplicar_Logica`, `Logica_Json`, `Estado`, `Ingresado_por`, `Fecha_Registro`, `Eliminado`) VALUES
(2, 2, 'INBOUND', 2, 0, NULL, 1, 0, '2022-09-26 11:48:09', 0),
(1, 2, 'OUTBOUND', 1, 0, NULL, 1, 0, '2022-09-26 11:48:09', 0),
(4, 0, 'SIN ETIQUETA', 1, 0, NULL, 1, 0, '2022-09-26 11:48:09', 0),
(3, 2, 'OTROS', 3, 0, NULL, 1, 0, '2022-09-26 11:48:09', 0),
(5, 2, NULL, 1, 0, NULL, NULL, 1, '2022-09-27 07:54:45', 0),
(6, 2, 'CON ETIQUETA TEST', 1, 0, NULL, NULL, 1, '2022-09-27 07:57:05', 0),
(7, 2, 'CON ETIQUETA TEST 2', 1, 0, NULL, 1, 1, '2022-09-27 07:58:06', 0),
(26, 58, 'RUC', 1, 0, NULL, 1, 1, '2022-09-28 02:29:37', 1),
(25, 58, 'CE2', 1, 0, NULL, 0, 1, '2022-09-28 02:29:37', 0),
(24, 58, 'DNI2', 1, 0, NULL, 1, 1, '2022-09-28 02:29:37', 0),
(14, 56, 'Gerentetest', 1, 0, NULL, 0, 1, '2022-09-27 19:24:41', 0),
(15, 56, 'Recursos Humanos', 1, 0, NULL, 1, 1, '2022-09-27 19:24:41', 0),
(16, 56, 'Supervisor', 1, 0, NULL, 1, 1, '2022-09-27 19:24:41', 0),
(17, 56, 'CARGO 1', 1, 0, NULL, 1, 1, '2022-09-27 19:32:10', 0),
(18, 56, 'CARGO 2', 1, 0, NULL, 1, 1, '2022-09-27 19:32:10', 0),
(19, 56, 'CARGO 3', 1, 0, NULL, 1, 1, '2022-09-27 19:32:10', 1),
(27, 58, 'Pasaporte', 1, 0, NULL, 1, 1, '2022-09-28 02:29:37', 1),
(28, 56, 'CARGO 4', 1, 1, NULL, 1, 1, '2022-09-28 06:04:19', 0),
(29, 56, 'CARGO 5', 1, 1, NULL, 1, 1, '2022-09-28 06:04:19', 0),
(30, 56, 'CARGO 6', 1, 1, NULL, 1, 1, '2022-09-28 06:04:19', 0),
(31, 56, 'CARGO 7', 1, 1, NULL, 1, 1, '2022-09-28 06:09:09', 0),
(32, 56, 'CARGO 8', 1, 1, NULL, 1, 1, '2022-09-28 06:09:09', 0),
(33, 56, 'CARGO 9', 1, 1, NULL, 1, 1, '2022-09-28 06:09:09', 0),
(34, 56, 'CARGO 10', 1, 1, NULL, 1, 1, '2022-09-28 06:13:56', 0),
(35, 56, 'CARGO 11', 1, 1, '{\r\n    \"Cargo\": \r\n    [\r\n        {\r\n        \"Nombre\": \"CARGO 11\",\r\n        \"Estado\": 1\r\n        },\r\n        {\r\n        \"Nombre\": \"CARGO 12\",\r\n        \"Estado\": 1\r\n        }\r\n    ]\r\n}							', 1, 1, '2022-09-28 06:16:33', 0),
(36, 56, 'CARGO 12', 1, 1, '{\n    \"Cargo\": \n    [\n        {\n        \"Nombre\": \"CARGO 11\",\n        \"Estado\": 1\n        },\n        {\n        \"Nombre\": \"CARGO 12\",\n        \"Estado\": 1\n        }\n    ]\n}							', 1, 1, '2022-09-28 06:16:33', 0),
(37, 59, 'M', 1, 1, '{\r\n    \"Sexo\":\r\n        [\r\n            {\r\n                \"Nombre\": \"M\",\r\n                \"Estado\": 1\r\n            },\r\n            {\r\n                \"Nombre\": \"S\",\r\n                \"Estado\": 1\r\n            }\r\n        ]\r\n}							', 1, 1, '2022-09-29 06:21:52', 0),
(38, 59, 'F', 1, 1, '{\r\n    \"Sexo\":\r\n        [\r\n            {\r\n                \"Nombre\": \"M\",\r\n                \"Estado\": 1\r\n            },\r\n            {\r\n                \"Nombre\": \"S\",\r\n                \"Estado\": 1\r\n            }\r\n        ]\r\n}							', 1, 1, '2022-09-29 06:21:52', 0),
(39, 60, 'Contado', 1, 1, '{\r\n    \"Categoria\":\r\n        [\r\n            {\r\n                \"Nombre\": \"Contado\",\r\n                \"Estado\": 0\r\n            },\r\n            {\r\n                \"Nombre\": \"Transferencia\",\r\n                \"Estado\": 0\r\n            }\r\n        ]\r\n}							', 0, 1, '2022-09-29 19:49:28', 0),
(40, 60, 'Transferencia', 1, 1, '{\r\n    \"Categoria\":\r\n        [\r\n            {\r\n                \"Nombre\": \"Contado\",\r\n                \"Estado\": 0\r\n            },\r\n            {\r\n                \"Nombre\": \"Transferencia\",\r\n                \"Estado\": 0\r\n            }\r\n        ]\r\n}							', 0, 1, '2022-09-29 19:49:28', 0),
(41, 55, 'raaaaaa', 1, 0, '							', 1, 1, '2022-09-29 22:16:43', 0),
(42, 55, 'raaaaaa2', 1, 0, '							', 1, 1, '2022-09-29 22:17:35', 0),
(43, 55, 'gaaaaaaaaaaaaaaa', 1, 0, '							', 1, 1, '2022-09-29 22:18:38', 0),
(44, 55, 'gaaaaaaaaaaaaaaa', 1, 0, '							', 1, 1, '2022-09-29 22:18:53', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `Persona_id` int(11) NOT NULL DEFAULT '0',
  `Perfil_id` int(11) DEFAULT NULL,
  `Login` varchar(20) DEFAULT NULL,
  `Password` varchar(40) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT '1',
  `Ingresado_por` int(11) NOT NULL DEFAULT '0',
  `Fecha_Registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modificado_por` int(11) DEFAULT NULL,
  `Fecha_Modificacion` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Eliminado` tinyint(1) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Persona_id`, `Perfil_id`, `Login`, `Password`, `Estado`, `Ingresado_por`, `Fecha_Registro`, `Modificado_por`, `Fecha_Modificacion`, `Eliminado`) VALUES
(1, 1, 1, '16110401', '16110401', 1, 0, '2019-02-06 13:49:59', 1, '2022-09-29 19:38:07', 0),
(2, 2, 4, '19020601', '19020601', 1, 1, '2019-02-06 14:21:26', 1, '2022-09-29 19:38:10', 0),
(3, 3, 1, '19020602', '19020602', 1, 1, '2019-02-06 14:26:07', NULL, '2022-09-29 19:38:13', 0),
(22, 30, 1, '51111111', '11441144', 1, 0, '2022-09-29 22:22:09', NULL, '2022-09-30 19:41:23', NULL),
(21, 29, 1, '51515151', 'bbbbbbbb', 1, 0, '2022-09-29 22:20:44', NULL, NULL, 0),
(20, 28, 1, '41516161', '98979787', 1, 0, '2022-09-29 22:13:15', NULL, '2022-09-30 19:42:39', NULL),
(19, 27, 2, '44444444', 'tast', 1, 0, '2022-09-29 19:41:33', NULL, NULL, 0),
(18, 26, 1, '11111111', 'test', 1, 0, '2022-09-29 19:39:52', NULL, NULL, 0),
(17, 26, 3, '12345678', '12345678', 1, 0, '2022-09-29 04:34:04', 1, '2022-09-29 04:34:52', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `EstadoKanBan`
--
ALTER TABLE `EstadoKanBan`
  ADD UNIQUE KEY `IDEstadoKanBan` (`IdEstadoKanBan`);

--
-- Indices de la tabla `EstadoKanBanDetalle`
--
ALTER TABLE `EstadoKanBanDetalle`
  ADD PRIMARY KEY (`IdEstadoKanBanDetalle`);

--
-- Indices de la tabla `interfaz`
--
ALTER TABLE `interfaz`
  ADD PRIMARY KEY (`idInterfaz`);

--
-- Indices de la tabla `log_sesion`
--
ALTER TABLE `log_sesion`
  ADD PRIMARY KEY (`idLog_Sesion`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`idPerfil`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idPermiso`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`),
  ADD UNIQUE KEY `dni` (`Documento`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`idSubCategoria`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `login` (`Login`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT de la tabla `interfaz`
--
ALTER TABLE `interfaz`
  MODIFY `idInterfaz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `log_sesion`
--
ALTER TABLE `log_sesion`
  MODIFY `idLog_Sesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idPerfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `idSubCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
