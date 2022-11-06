
DROP PROCEDURE IF EXISTS `ProcInsertInterfaz`;
DROP PROCEDURE IF EXISTS `ProcInsertLogSesion`;
DROP PROCEDURE IF EXISTS `ProcUpdateInterfaz`;
DROP PROCEDURE IF EXISTS `ProcUpdateLogSesion`;
DROP PROCEDURE IF EXISTS `ProcSelectAccionesSubCategoria`;

DELIMITER $$
CREATE PROCEDURE `ProcInsertInterfaz`(IN `P_Nombre` VARCHAR(50), IN `P_Url` VARCHAR(255), IN `P_Nivel` INT, IN `P_Modulo_principal` INT, IN `P_IdInterfaz_superior` INT, IN `P_Orden` INT, IN `P_Icono` VARCHAR(30), IN `P_Estado` INT, IN `P_Ingresado_por` INT, IN `P_Fecha_Registro` DATE, IN `P_Modificado_por` INT, IN `P_Fecha_Modificacion` DATE)
BEGIN
  
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
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`%` PROCEDURE `ProcInsertLogSesion`(IN `P_Login` VARCHAR(20), IN `P_Password` VARCHAR(40), IN `P_LoggedIn` VARCHAR(40), IN `P_IP` VARCHAR(40), IN `P_Dispositivo` VARCHAR(40), IN `P_NombreDispositivo` VARCHAR(40), IN `P_Equipo` INT)
BEGIN
  SET @IdUsuario  = 0   ; 
  IF (P_Password = '' OR  P_Login = '' )
  THEN 
    select 0 as Estado, 'Ingrese Usuario y/o contraseña' as Nota ;
  ELSEIF EXISTS (
   SELECT * FROM usuario
   WHERE Login =P_Login
   and Estado = 2
 ) THEN

    select 0 as Estado, 'Usuario Bloqueado' as Nota ;
 
 ELSEIF EXISTS (
   SELECT * FROM log_sesion lo inner join usuario us
   on lo.Login = us.Login inner join equipo eq
   on us.IdUsuario = eq.IdUsuario 
   WHERE lo.LoggedIn = 'Si'
and eq.Equipo=  P_Equipo
and lo.Login = P_Login
and lo.Password = P_Password
and lo.Dispositivo = P_Dispositivo
and lo.NombreDispositivo = P_NombreDispositivo 	
) AND  P_LoggedIn ='Si' THEN
 
select 1 as Estado, Login,			IP,	Dispositivo,	NombreDispositivo  from  log_sesion 
where LoggedIn ='Si' and  Login = P_Login
and Password = P_Password ;
 
    UPDATE log_sesion
    SET Fecha_Cierre = sysdate()
    WHERE IdEstadoKanBanDetalle in (2,3)
    AND Login = P_Login 
    AND Fecha_Cierre IS NULL;

    

    SELECT IdUsuario INTO @IdUsuario  FROM usuario
    WHERE  Login = P_Login;
 
     IF NOT EXISTS (
     SELECT * FROM equipo 
     WHERE IdUsuario =  @IdUsuario 
     
     )THEN

         INSERT INTO equipo(IdUsuario, Equipo)
         VALUES (@IdUsuario, P_Equipo);
     ELSE
         UPDATE  equipo
         SET Equipo = P_Equipo,
         Fecha_Modificacion = sysdate()
         WHERE idUsuario = @IdUsuario;
         
     END IF;     



 

ELSEIF NOT EXISTS (
   SELECT * FROM log_sesion
   WHERE LoggedIn = 'Si'
and  Login = P_Login
and Password = P_Password
   ) AND  P_LoggedIn ='Si' THEN

INSERT INTO  log_sesion (Login,	Password,	LoggedIn,	IP,	Dispositivo,	NombreDispositivo,
IdEstadoKanBanDetalle 		)
    VALUES (P_Login,	P_Password,	P_LoggedIn,	P_IP,	P_Dispositivo,	P_NombreDispositivo,
1  
 );
  select 1 as Estado, Login,			IP,	Dispositivo,	NombreDispositivo  from  log_sesion 
where LoggedIn ='Si' and  Login = P_Login
and Password = P_Password ; 
 
    UPDATE log_sesion
    SET Fecha_Cierre = sysdate()
    WHERE IdEstadoKanBanDetalle in (2,3)
    AND Login = P_Login 
    AND Fecha_Cierre IS NULL;


    SET @IdUsuario  = 0   ; 

    SELECT IdUsuario INTO @IdUsuario  FROM usuario
    WHERE  Login = P_Login;
 
     IF NOT EXISTS (
     SELECT * FROM equipo 
     WHERE IdUsuario =  @IdUsuario 
     
     )THEN

         INSERT INTO equipo(IdUsuario, Equipo)
         VALUES (@IdUsuario, P_Equipo);
     ELSE
         UPDATE  equipo
         SET Equipo = P_Equipo, 
             Fecha_Modificacion = sysdate()
         WHERE idUsuario = @IdUsuario;
     END IF;     

 
 ELSEIF  EXISTS (
   SELECT * FROM log_sesion lo inner join usuario us
   on lo.Login = us.Login inner join equipo eq
   on us.IdUsuario = eq.IdUsuario
   WHERE lo.LoggedIn = 'Si'
and  lo.Login = P_Login
and lo.Password = P_Password
and eq.Equipo <>  P_Equipo	
) AND  P_LoggedIn ='Si' THEN

  INSERT INTO  log_sesion (Login,	Password,	LoggedIn,	IP,	Dispositivo,	NombreDispositivo,
IdEstadoKanBanDetalle 		)
    VALUES (P_Login,	P_Password,	'No',	P_IP,	P_Dispositivo,	P_NombreDispositivo,
3 
 );
  select 0 as Estado, 'Existe una sesion activa' as Nota  ;
   
ELSE

    INSERT INTO  log_sesion (Login,	Password,	LoggedIn,	IP,	Dispositivo,	NombreDispositivo,
IdEstadoKanBanDetalle 		)
    VALUES (P_Login,	P_Password,	P_LoggedIn,	P_IP,	P_Dispositivo,	P_NombreDispositivo,
2 
 );
select 0 as Estado, 'Usuario y/o contraseña incorrectos' as Nota;

 

END IF;
--
SET @intento  = 0   ; 

SELECT COUNT(1) INTO @intento  FROM log_sesion
WHERE LoggedIn = 'No' 
and Login = P_Login
and IdEstadoKanBanDetalle in (2,3)
and Fecha_Cierre IS NULL; 
--
  
  IF  @intento >=3
  THEN 
   update usuario 
   set Estado = 2
   where Login = P_Login;
   
  END IF;
 
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `ProcUpdateInterfaz`(IN `P_IdInterfaz` INT, IN `P_Nombre` VARCHAR(50), IN `P_Url` VARCHAR(255), IN `P_Nivel` INT, IN `P_Modulo_principal` INT, IN `P_IdInterfaz_superior` INT, IN `P_Orden` INT, IN `P_Icono` VARCHAR(30), IN `P_Estado` INT, IN `P_Ingresado_por` INT, IN `P_Fecha_Registro` DATE, IN `P_Modificado_por` INT, IN `P_Fecha_Modificacion` DATE)
BEGIN
 
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
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `ProcUpdateLogSesion`(IN `P_Login` VARCHAR(20), IN `P_Password` VARCHAR(40), IN `P_LoggedIn` VARCHAR(40), IN `P_IP` VARCHAR(40), IN `P_Dispositivo` VARCHAR(40), IN `P_NombreDispositivo` VARCHAR(40))
BEGIN
 
    UPDATE  log_sesion   
    SET   LoggedIn = 'No',	
          Fecha_Cierre = sysdate()
	WHERE Login = P_Login AND 
          IP = P_IP AND	
          Dispositivo = P_Dispositivo AND	
          NombreDispositivo = P_NombreDispositivo;  
 	
    
END $$
DELIMITER ;

SET GLOBAL event_scheduler = ON;


DROP EVENT borrar_sesiones_activas;

CREATE EVENT borrar_sesiones_activas
ON SCHEDULE EVERY 1 DAY STARTS '2022-10-12 01:35:00'
ENDS '2024-01-01 01:35:00'
DO update log_sesion set LoggedIn='No',Fecha_Cierre = sysdate() WHERE  Fecha_Cierre IS NULL;

DELIMITER $$
CREATE DEFINER=`root`@`%` PROCEDURE `ProcSelectAccionesSubCategoria`(IN `P_idSubCategoria` INT, IN `P_NomVariable` VARCHAR(100), IN `P_NumAccion` INT, IN `P_Nom_Accion` VARCHAR(200))
select sa.idSubCategoria, sa.Desc_SubCategoria_Accion Acciones ,
(
select  max(Num_Accion) 
from acciones_logica_detalle lod INNER JOIN subcategoria_accion sac 
on lod.idSubCategoria_Accion =sac.idSubCategoria_Accion
 WHERE sac.idSubCategoria = sa.idSubCategoria and lod.idSubCategoria_Accion = sa.idSubCategoria_Accion 
  AND   lod.Estado =1
) NroAcciones,
ld.Num_Accion, al.Nom_Accion,  ld.Desc_Accion 
from acciones_logica_detalle ld inner join acciones_logica al
on ld.id_Accion = al.idAccion inner join subcategoria_accion sa 
on sa.idSubCategoria_Accion = ld.idSubCategoria_Accion
WHERE sa.idSubCategoria= CASE WHEN P_idSubCategoria = 0 THEN sa.idSubCategoria ELSE P_idSubCategoria END 
AND sa.Desc_SubCategoria_Accion= CASE WHEN P_NomVariable = '' THEN sa.Desc_SubCategoria_Accion ELSE P_NomVariable END 
AND ld.Num_Accion = CASE WHEN P_NumAccion = 0 THEN ld.Num_Accion ELSE P_NumAccion END
AND al.Nom_Accion = CASE WHEN P_Nom_Accion ='' THEN al.Nom_Accion  ELSE P_Nom_Accion END
AND ld.Estado = 1
order by sa.Desc_SubCategoria_Accion ASC , ld.Num_Accion ASC, al.idAccion ASC$$
DELIMITER ;
