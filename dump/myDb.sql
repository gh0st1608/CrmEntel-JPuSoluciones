-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 27-09-2022 a las 07:18:29
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
CREATE DEFINER=`user`@`%` PROCEDURE `ProcInsertLogSesion` (IN `P_Login` VARCHAR(20), IN `P_Password` VARCHAR(40), IN `P_LoggedIn` VARCHAR(40), IN `P_IP` VARCHAR(40), IN `P_Dispositivo` VARCHAR(40), IN `P_NombreDispositivo` VARCHAR(40))   BEGIN
  
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

CREATE DEFINER=`user`@`%` PROCEDURE `ProcUpdateLogSesion` (IN `P_Login` VARCHAR(20), IN `P_Password` VARCHAR(40), IN `P_LoggedIn` VARCHAR(40), IN `P_IP` VARCHAR(40), IN `P_Dispositivo` VARCHAR(40), IN `P_NombreDispositivo` VARCHAR(40))   BEGIN
 
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
(53, 'demo4', 0, 1, '2022-09-24 23:51:03', 0),
(55, 'SIN CATEGORIA', 1, 0, '2022-09-26 10:48:41', 0),
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
(36, 'TIPO DE ATENCION FINAL', 1, 0, '2022-09-26 10:48:41', 0);

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
  `IdInterfaz_superior` int(11) DEFAULT NULL,
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

INSERT INTO `interfaz` (`idInterfaz`, `Nombre`, `Url`, `Nivel`, `Modulo_Principal`, `IdInterfaz_superior`, `Orden`, `Icono`, `Estado`, `Ingresado_por`, `Fecha_Registro`, `Modificado_por`, `Fecha_Modificacion`, `Eliminado`) VALUES
(1, 'Seguridad', '#', 1, 1, 0, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:23:14', 0),
(2, 'Administracion', '#', 1, 2, 0, 2, NULL, 1, 1, '2016-04-30 02:18:13', 1, '2022-09-27 01:21:48', 0),
(3, 'Procesos', '#', 1, 3, 0, 3, NULL, 1, 1, '2016-10-21 18:19:53', 1, '2022-09-27 01:34:52', 0),
(4, 'Ventas', '#', 1, 4, 0, 4, NULL, 1, 1, '2016-10-21 18:19:53', 1, '2022-09-27 01:52:35', 0),
(5, 'Reportes', '#', 1, 5, 0, 5, NULL, 1, 1, '2016-10-21 18:19:53', 1, '2022-09-27 01:52:42', 0),
(6, 'Dashboard', '#', 1, 6, 0, 6, NULL, 1, 1, '2016-10-21 18:19:53', 1, '2022-09-27 01:52:46', 0),
(7, 'Interfaz', 'index.php?c=Interfaz', 2, 1, 1, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 05:51:00', 0),
(8, 'Perfil', 'index.php?c=Perfil', 2, 1, 1, 2, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:20:12', 0),
(9, 'Usuarios', 'index.php?c=Usuario', 2, 1, 1, 3, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:19:54', 0),
(10, 'Persona', 'index.php?c=Persona', 2, 2, 2, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:21:08', 0),
(11, 'Categoria', 'index.php?c=Categoria', 2, 2, 2, 2, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:21:20', 0),
(12, 'SubCategoria', 'index.php?c=SubCategoria', 2, 2, 2, 3, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:21:30', 0),
(13, 'Importar', 'index.php?c=#', 2, 3, 3, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:22:18', 0),
(14, 'Registra y Actualizar Ficha', 'index.php?c=#', 2, 4, 4, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:21:55', 0),
(15, 'Visualizar Ficha', 'index.php?c=#', 2, 4, 4, 2, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:21:52', 0),
(16, 'Listar Fichas', 'index.php?c=#', 2, 4, 4, 3, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:22:35', 0),
(17, 'Ventas', 'index.php?c=#', 2, 5, 5, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:21:46', 0),
(18, 'Metricas Vendedor', 'index.php?c=#', 2, 6, 6, 1, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:22:45', 0),
(19, 'Metricas Back Office', 'index.php?c=#', 2, 6, 6, 2, 'fa fa-user', 1, 1, '2016-04-30 02:17:36', 1, '2022-09-27 04:22:57', 0);

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
(274, '16110401', '16110401', 'No', '172.19.0.1', 'Windows', 'Other', '2022-09-24 17:56:13', '2022-09-27 00:24:35', 1),
(275, '16110401', '16110401', 'Si', '172.19.0.1', 'Windows', 'Other', '2022-09-27 00:24:57', NULL, 1);

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
(4, 'Vendedor', 1, 1, '2022-09-20 16:19:52', NULL, '2022-09-20 16:20:07', 0);

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
(1, NULL, '71886624', 'Jose', 'Luis', 'Ayala', 'Benito', '1996-06-07', 'M', '945191447', 'jayalab@jpusoluciones.com', 0, 1, 1, '2019-02-06 13:47:45', NULL, '2019-02-06 13:49:05', NULL, 0),
(2, NULL, '11111111', 'Supervisor', '', '1', '', '2019-02-06', 'F', '', 'supervisor1@correo.com', 1, 1, 1, '2019-02-06 14:21:03', 1, '2022-09-25 00:05:55', NULL, 1),
(3, NULL, '22222222', 'Teleoperador', '', 'Ventas', '1', '2019-02-06', 'F', '', 'teleoperadorventas1@correo.com', 1, 1, 1, '2019-02-06 14:23:48', 1, '2022-09-25 00:03:59', NULL, 1),
(4, NULL, '33333333', 'Teleoperador', '', 'Ventas', '2', '2019-02-06', 'F', '', 'teleoperadorventas2@correo.com', 1, 1, 1, '2019-02-06 14:25:57', 1, '2022-09-24 23:57:37', NULL, 1),
(5, NULL, '', 'asdasd', '', '', '', NULL, '', NULL, NULL, NULL, 1, 0, '2022-09-25 00:12:47', NULL, NULL, NULL, 0),
(6, NULL, '45454545', 'omar', 'omar', 'omar', 'omar', NULL, '', NULL, NULL, NULL, 1, 0, '2022-09-25 00:41:20', NULL, NULL, NULL, 0),
(7, NULL, '70347435', 'omar', 'omar', 'omar', 'omar', NULL, '', NULL, NULL, NULL, 1, 0, '2022-09-25 00:41:47', NULL, NULL, NULL, 0),
(9, NULL, '71886629', 'omar', 'omar', 'omar', 'omar', NULL, '', '9999966', 'ascdfacdfas@uni.pe', NULL, 1, 0, '2022-09-25 00:53:33', NULL, NULL, '02/10/2022', 0),
(10, NULL, '70347422', 'omar', 'omar', 'omar', 'omar', NULL, '', '972290520', 'cpaucarv@uni.pe', NULL, 1, 0, '2022-09-25 00:54:17', NULL, NULL, '2022-08-11', 0);

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
(3, 2, 'OTROS', 3, 0, NULL, 1, 0, '2022-09-26 11:48:09', 0);

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
(1, 1, 1, '16110401', '16110401', 1, 0, '2019-02-06 13:49:59', 1, '2022-09-24 17:56:06', 0),
(2, 2, 4, '19020601', '19020601', 1, 1, '2019-02-06 14:21:26', 1, '2022-09-20 18:55:21', 0),
(3, 3, 9, '19020602', '19020602', 1, 1, '2019-02-06 14:26:07', NULL, NULL, 0),
(4, 4, 9, '19020603', '19020603', 1, 1, '2019-02-06 14:26:15', NULL, NULL, 0);

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
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `interfaz`
--
ALTER TABLE `interfaz`
  MODIFY `idInterfaz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `log_sesion`
--
ALTER TABLE `log_sesion`
  MODIFY `idLog_Sesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `idPerfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idPermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `idSubCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
