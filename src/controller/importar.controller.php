<?php

include_once 'model/conexion.php';
require_once 'includes.controller.php';
class ImportarController extends IncludesController{
	private $bd;

	//*--FUNCION PARA IMPORTAR TELEFONOS--*//
    public function Imp_Telefono(){
    	// conectamos a la base de datos
    	$this->bd = new Conexion();
    	$ingresado_por=$_SESSION['Usuario_Actual'];	    
	    ini_set('max_execution_time', 10000);
	    $tempFile = $_FILES['DataTelefonos']['tmp_name'];
	    $nombre = $_FILES['DataTelefonos']['name'];
	    $filename = $nombre;
	    $ruta = getcwd() ."/uploads/csv/".$filename;
	    move_uploaded_file($tempFile, $ruta);
	    $fp = fopen ( $ruta , "r" );
	    $fila=0;
	    $FileTelefonos = array();
	    $origen_informacion = $this->Consultas("select * from origen where  activo=1 and eliminado=0;");
	    $array_origen = array();
        foreach ($origen_informacion as $origen) {
        	 $array_origen[$origen['descripcion']]=$origen['idOrigen'];
        }
	    while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
	    	 //declaramos las variables
	        $contador=$data[0];	
	        $documento=$data[1];
	        $tipo=$data[2];
	        $numero=$data[3];
	        $contacto=$data[4];
	        $origen=utf8_encode($data[5]);
	        $anio_origen=$data[6];
	        $observacion=utf8_encode($data[7]);

	        
	        if($fila>0){	                 
	       	$FileTelefonos[$fila]['contador']=$contador;
			$FileTelefonos[$fila]['documento']=$documento;
			$FileTelefonos[$fila]['tipo']=$tipo;
			$FileTelefonos[$fila]['numero']=$numero;
			$FileTelefonos[$fila]['contacto']=$contacto;
			$FileTelefonos[$fila]['origen']=$origen;
			$FileTelefonos[$fila]['anio_origen']=$anio_origen;
			$FileTelefonos[$fila]['observacion']=$observacion;

	        if (isset($array_origen[$origen])) {
	            $Origen_id=$array_origen[$origen];
	        }else{
	           $Origen_id=0;
	        }

			$error_registro="Registro incorrecto";
			$error_documento="";
			$registrado=0;
			$nuevo="";
/*
			1. Documento o Telefono sin datos vacio -> registro nro° incorrecto
			2. No existe cliente en la BD
			3. telefono existente			
			4. Telefono nuevo
*/
			if (strlen($documento)>7 && strlen($documento)<12 && $documento<>"" ) { 
			    $doc_valido="";
			}else{
				$doc_valido=" - documento invalido";
			}
			if (strlen($numero)>6 && strlen($numero)<10) { 
			    $numero_valido="";
			}else{
				$numero_valido=" - telefono invalido";
			}

			

	       	//consultamos el idDeudor
	       	if($doc_valido=="" && $numero<>""  && $numero_valido==""){
	       		$error_documento="No existe el deudor en la BD";
				

	       		$error_archivo="";
		        $stm = $this->bd->prepare("select * from deudor where documento='".$documento."'");
	        	$stm->execute();                   
	        	$Deudor=$stm->fetch(PDO::FETCH_ASSOC);	        
		        $Deudor_id=$Deudor['idDeudor'];
		        //si el idDeudor Existe  
		        if ($Deudor['idDeudor']!=NULL) {
		        	$nuevo="El Telefono Ya existe";
		        	
			        //consultamos el telefono del Deudor
			        $stm = $this->bd->prepare("SELECT * FROM telefono WHERE Deudor_id = $Deudor_id and numero='".$numero."' and eliminado=0");
		        	$stm->execute();                   
		        	$Telefono=$stm->fetch(PDO::FETCH_ASSOC);
		        	//si el Telefono no existe 
		        	if($Telefono['idTelefono']==NULL){
		        		// registrar el telefono
			            $stmt = $this->bd->prepare("INSERT INTO telefono(Deudor_id,tipo,numero,contacto,Origen_id,anio_origen,observacion,ingresado_por) VALUES(:Deudor_id,:tipo,:numero,:contacto,:Origen_id,:anio_origen,:observacion,:ingresado_por)");
			            $stmt->bindParam(':Deudor_id', $Deudor_id);
			            $stmt->bindParam(':tipo', $tipo);
				        $stmt->bindParam(':numero', $numero);
				        $stmt->bindParam(':contacto', $contacto);
				        $stmt->bindParam(':Origen_id',$Origen_id);
				        $stmt->bindParam(':anio_origen',$anio_origen);
				        $stmt->bindParam(':observacion', $observacion);
				        $stmt->bindParam(':ingresado_por', $ingresado_por);
				        $stmt->execute();			            
			            $nuevo="Telefono Nuevo";
			            $registrado=$stmt->rowCount();
			        }
			        $error_documento="";
		        }
		    $error_registro="";
		    }
		    $FileTelefonos[$fila]['registrado']=$registrado;
		    $FileTelefonos[$fila]['motivo']=$error_registro.$doc_valido.$numero_valido.$error_documento.$nuevo;
		    $FileTelefonos[$fila]['hora']=date("H:i:s",time());
	     
	        }
	        $fila++;
	    }
    fclose ( $fp ); 
    $this->Resultado_Importar($FileTelefonos,"TELEFONO");
    //header('Location: index.php?c=Telefono');
    }

    //*--FUNCION PARA IMPORTAR CORREOS--*//
    public function Imp_Correo(){
    	// conectamos a la base de datos
    	$this->bd = new Conexion();
    	$ingresado_por=$_SESSION['Usuario_Actual'];	    
	    ini_set('max_execution_time', 10000);
	    $tempFile = $_FILES['DataCorreos']['tmp_name'];
	    $nombre = $_FILES['DataCorreos']['name'];
	    $filename = $nombre;
	    $ruta = getcwd() ."/uploads/csv/".$filename;
	    move_uploaded_file($tempFile, $ruta);
	    $fp = fopen ( $ruta , "r" );
	    $fila=0;
	    $FileCorreos = array();
	    while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
	    	 //declaramos las variables
	        $contador=$data[0];	
	        $documento=$data[1];
	        $direccion_correo=strtolower(utf8_encode($data[2]));
	        $tipo=utf8_encode($data[3]);
	        $origen=utf8_encode($data[4]); 
	        
	        if($fila>0){	                 
	       	$FileCorreos[$fila]['contador']=$contador;
			$FileCorreos[$fila]['documento']=$documento;
			$FileCorreos[$fila]['correo']=$direccion_correo;
			$FileCorreos[$fila]['tipo']=$tipo;
			$FileCorreos[$fila]['origen']=$origen;

	        
			$error_registro="Registro incorrecto";
			$error_documento="";
			$registrado=0;
			$nuevo="";
/*
			1. Documento o Telefono sin datos vacio -> registro nro° incorrecto
			2. No existe cliente en la BD
			3. telefono existente

			4. Telefono nuevo
*/
	       	//consultamos el idDeudor
	       	if (filter_var($direccion_correo, FILTER_VALIDATE_EMAIL)) {
			    $correo_valido="";
			}else{
				$correo_valido=" - correo invalido";
			}
	       	if($documento<>"" && $direccion_correo<>"" && $correo_valido==""){
	       		$error_documento="No existe el deudor en la BD";
				

	       		$error_archivo="";
		        $stm = $this->bd->prepare("select * from deudor where documento='".$documento."'");
	        	$stm->execute();                   
	        	$Deudor=$stm->fetch(PDO::FETCH_ASSOC);	        
		        $Deudor_id=$Deudor['idDeudor'];
		        //si el idDeudor Existe  
		        if ($Deudor['idDeudor']!=NULL) {
		        	$nuevo="El Correo Ya existe";		        	
			        //consultamos el telefono del Deudor
			        $stm = $this->bd->prepare("SELECT * FROM correo WHERE Deudor_id = $Deudor_id and direccion_correo='".$direccion_correo."'");
		        	$stm->execute();                   
		        	$Correo=$stm->fetch(PDO::FETCH_ASSOC);
		        	//si el Telefono no existe 
		        	if($Correo['idCorreo']==NULL){
		        		// registrar el telefono
			            $stmt = $this->bd->prepare("INSERT INTO correo(Deudor_id,direccion_correo,tipo,origen,ingresado_por) VALUES(:Deudor_id,:direccion_correo,:tipo,:origen,:ingresado_por)");
			            $stmt->bindParam(':Deudor_id', $Deudor_id);
				        $stmt->bindParam(':direccion_correo', $direccion_correo);
				        $stmt->bindParam(':tipo',$tipo);
				        $stmt->bindParam(':origen', $origen);
				        $stmt->bindParam(':ingresado_por', $ingresado_por);
				        $stmt->execute();			            
			            $nuevo="Correo Nuevo";
			            $registrado=$stmt->rowCount();

			        }
			        $error_documento="";
		        }
		    $error_registro="";
		    }
		    $FileCorreos[$fila]['registrado']=$registrado;
		    $FileCorreos[$fila]['motivo']=$error_registro.$correo_valido.$error_documento.$nuevo;
		    $FileCorreos[$fila]['hora']=date("H:i:s",time());
	     
	        }
	        $fila++;
	    }
    fclose ( $fp ); 
    $this->Resultado_Importar($FileCorreos,"CORREO");
    //header('Location: index.php?c=Telefono');
    }
  
    public function Imp_Direccion(){
    	// conectamos a la base de datos
    	$this->bd = new Conexion();
    	$ingresado_por=$_SESSION['Usuario_Actual'];

    	ini_set('max_execution_time', 1000);    
		$tempFile = $_FILES['DataDirecciones']['tmp_name'];
		$nombre = $_FILES['DataDirecciones']['name'];
		$filename = $nombre;
		$ruta = getcwd() ."/uploads/csv/".$filename;
		move_uploaded_file($tempFile, $ruta);
		$fp = fopen ( $ruta , "r" );
		$fila=0;
		$FileDirecciones = array();
		while (( $data = fgetcsv ($fp,1000,",")) !== FALSE ){

			if($fila>0){
				$contador=$data[0];
				$documento=utf8_encode($data[1]);
				$direccion=utf8_encode(addslashes($data[2]));
				$distrito=utf8_encode($data[3]);
				$provincia=utf8_encode($data[4]);
				$departamento=utf8_encode($data[5]);
				$tipo_direccion=utf8_encode($data[6]);
				$origen=utf8_encode($data[7]);

				$FileDirecciones[$fila]['contador']=$contador;
				$FileDirecciones[$fila]['documento']=$documento;
				$FileDirecciones[$fila]['direccion']=$direccion;
				$FileDirecciones[$fila]['distrito']=$distrito;
				$FileDirecciones[$fila]['provincia']=$provincia;
				$FileDirecciones[$fila]['departamento']=$departamento;
				$FileDirecciones[$fila]['tipo_direccion']=$tipo_direccion;
				$FileDirecciones[$fila]['origen']=$origen;
				$registrado=0;

				$err_doc="";
				$err_dir="";
				$err_dist="";
				$err_prov="";
				$err_dpto="";
				$error_campo="campo : ";
				$vacio=" vacio. ";
				if($documento==""){$err_doc=" documento ";}
				if($direccion==""){$err_dir=", direccion ";}
				if($distrito==""){$err_dist=", distrito ";}
				if($provincia==""){$err_prov=", provincia ";}
				if($departamento==""){$err_dpto=", departamento";}
				//verificando que los campos no esten vacios
				if($err_doc=="" && $err_dir=="" && $err_dist=="" && $err_prov=="" && $err_dpto==""){
					$error_campo="";
					$vacio="";
					$err_dpto=" no existe el departamento";
					$err_prov=" no existe la provincia";
					$err_dist=" no existe el distrito";
					
					$stm = $this->bd->prepare("SELECT * FROM ubigeo where descripcion='".strtoupper(trim($departamento))."' and Tipo_Ubigeo='DPTO'");
				    $stm->execute();                   
				    $dpto=$stm->fetch(PDO::FETCH_ASSOC);

				    if ($dpto['Cod_Dpto']!=NULL) {
				    	$err_dpto="";

		        		$stm = $this->bd->prepare("SELECT * FROM ubigeo where descripcion='".strtoupper(trim($provincia))."' and  Tipo_Ubigeo='PROV' and Cod_Dpto='".$dpto['Cod_Dpto']."' ");
		        		$stm->execute();                   
		        		$prov=$stm->fetch(PDO::FETCH_ASSOC);

				        if ($prov['Cod_Prov']!=NULL) {
				        	$err_prov="";

		        			$stm = $this->bd->prepare("SELECT * FROM ubigeo where descripcion='".strtoupper(trim($distrito))."' and  Tipo_Ubigeo='DIST' and Cod_Dpto='".$dpto['Cod_Dpto']."' and Cod_Prov='".$prov['Cod_Prov']."'");
		        			$stm->execute();                   
		        			$dist=$stm->fetch(PDO::FETCH_ASSOC);

				        	if($dist['idUbigeo']!=NULL){
				        		$err_dist="";
				        		$err_doc="no existe el deudor en el sistema";

								$ubigeo_id=$dist['idUbigeo'];
						   		//consultamos el idDeudor
					        	$stm = $this->bd->prepare("select * from deudor where documento='".$documento."'");
				        		$stm->execute();                   
				        		$Deudor=$stm->fetch(PDO::FETCH_ASSOC);	        
					        	$Deudor_id=$Deudor['idDeudor'];		        
					        	
					        	//si el idDeudor Existe
								if ($Deudor['idDeudor']!=NULL) {


									//actualizar ubigeo
									if ($Deudor['Ubigeo_id']==0) {
										$stmt = $this->bd->prepare("UPDATE deudor SET Ubigeo_id=:Ubigeo_id where idDeudor=:idDeudor;");
							        	$stmt->bindParam(':idDeudor',$Deudor_id);
					 					$stmt->bindParam(':Ubigeo_id',$ubigeo_id);
						        		$stmt->execute();  	
									}
									$err_doc="";
									$err_dir="ya existe la direccion en el sistema";
									//IDENTIFICANOD EL ID_UBIGEO								   		 
							        $stmt = $this->bd->prepare("SELECT * FROM direccion where Deudor_id=:Deudor_id and direccion=:direccion;");
							        $stmt->bindParam(':Deudor_id',$Deudor_id);
					 				$stmt->bindParam(':direccion',$direccion);
						        	$stmt->execute();                   
						        	$Direccion=$stmt->fetch(PDO::FETCH_ASSOC);

						 			if($Direccion['idDireccion']==NULL){
						 				$err_dir="direccion nueva";
					 					$stmt = $this->bd->prepare("INSERT INTO direccion(Deudor_id,direccion,distrito,provincia,departamento,ubigeo_id,tipo,origen,ingresado_por) VALUES(:Deudor_id,:direccion,:distrito,:provincia,:departamento,:ubigeo_id,:tipo,:origen,:ingresado_por)");
					 					$stmt->bindParam(':Deudor_id',$Deudor_id);
					 					$stmt->bindParam(':direccion',$direccion);
					 					$stmt->bindParam(':distrito',$distrito);
					 					$stmt->bindParam(':provincia',$provincia);
					 					$stmt->bindParam(':departamento',$departamento);
					 					$stmt->bindParam(':ubigeo_id',$ubigeo_id);
					 					$stmt->bindParam(':tipo',$tipo_direccion);
					 					$stmt->bindParam(':origen',$origen);
					 					$stmt->bindParam(':ingresado_por',$ingresado_por);
							        	$stmt->execute();
							        	$registrado=$stmt->rowCount();		 					
									}
								}
							}
						}
					}
				}
				$FileDirecciones[$fila]['registrado']=$registrado;
		    	$FileDirecciones[$fila]['motivo']=$error_campo.$err_doc.$err_dir.$err_dist.$err_prov.$err_dpto.$vacio;
		    	$FileDirecciones[$fila]['hora']=date("H:i:s",time());
			}
		 $fila++;
		}
		fclose ($fp);
		$this->Resultado_Importar($FileDirecciones,"DIRECCION");
		//header('Location: index.php?c=Telefono');			
    }

    public function Imp_Camp(){
    	$this->bd = new Conexion();
    	$Campana_id=$_REQUEST['idCampana'];
	    ini_set('max_execution_time', -1);
	    $tempFile = $_FILES['DataObligacion']['tmp_name'];
	    $nombre = $_FILES['DataObligacion']['name'];
	    $filename = $nombre;
	    $ruta = getcwd() ."/uploads/csv/".$filename;
	    move_uploaded_file($tempFile, $ruta);
	    $fp = fopen ( $ruta , "r" );
	    $fila=0;
	    $ingresado_por=$_SESSION['Usuario_Actual'];
	    $nuevos=0;
	    $antiguos=0;
	    $FileObligaciones = array();
	    
		ini_set('memory_limit', '-1');
	    while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
		    setlocale(LC_ALL, 'es_ES.UTF8');
		    $i = 0;
	        if($fila>0){	                 
		        $contador=$data[0];
		        $nrooperacion=$data[1];   
		        $operacion=$data[2];
		        $tipo_doc=$data[3];   
		        $documento=$data[4];   
		        $cliente=utf8_encode($data[5]);
		        $producto=utf8_encode($data[6]);    
		        $moneda=$data[7];  
		        $capital=$data[8];         
		        $deuda_total=$data[9];         
		        $deuda_vencida=$data[10];           
		        $monto_campania=$data[11];
		        $desc_campania=utf8_encode($data[12]);  
		        $dias_mora=$data[13];   
		        $fecha_vencimiento=utf8_encode($data[13]);   
		        $nro_cuota=$data[15];    
		        $plazo=$data[16];   
		        $segmento=utf8_encode($data[17]);
		        $fecha_asignacion=$data[18];

		        $FileObligaciones[$fila]['contador']=$contador;
		        $FileObligaciones[$fila]['nrooperacion']=$nrooperacion;
		        $FileObligaciones[$fila]['operacion']=$operacion;
		        $FileObligaciones[$fila]['tipo_doc']=$tipo_doc;
		        $FileObligaciones[$fila]['documento']=$documento;
		        $FileObligaciones[$fila]['cliente']=$cliente;
		        $FileObligaciones[$fila]['producto']=$producto;
		        $FileObligaciones[$fila]['moneda']=$moneda;
		        $FileObligaciones[$fila]['capital']=$capital;
		        $FileObligaciones[$fila]['deuda_total']=$deuda_total;
		        $FileObligaciones[$fila]['deuda_vencida']=$deuda_vencida;
		        $FileObligaciones[$fila]['monto_campania']=$monto_campania;
		        $FileObligaciones[$fila]['desc_campania']=$desc_campania;
		        $FileObligaciones[$fila]['dias_mora']=$dias_mora;
		        $FileObligaciones[$fila]['fecha_vencimiento']=$fecha_vencimiento;
		        $FileObligaciones[$fila]['nro_cuota']=$nro_cuota;
		        $FileObligaciones[$fila]['plazo']=$plazo;
		        $FileObligaciones[$fila]['segmento']=$segmento;
		        $FileObligaciones[$fila]['fecha_asignacion']=$fecha_asignacion;
		        $Deudor_registrado=0;
				$obligacion_registrada=0;
						
				$error_nroope="";
				$error_oper="";
				$error_doc="";
				$error_tipo_doc="";
				$error_cli="";
				if($nrooperacion == ""){$error_nroope ="nrooperacion vacio";}else{$error_nroope="";} 
				//if($operacion == ""){$error_oper = "operacion vacio";}else{$error_oper = "";} 
				if($tipo_doc == ""){$error_tipo_doc = "tipo doc vacio";}else{$error_tipo_doc = "";}
				if($documento == ""){$error_doc = "documento vacio";}else{$error_doc = "";} 
				if($cliente == ""){$error_cli = "cliente vacio";}else{$error_cli = "";} 

		        if($error_nroope==""   && $error_tipo_doc=="" && $error_doc=="" && $error_cli=="" ){
		        	if ($tipo_doc=="RUC") {
						$ruc=$documento;
						$tipo_ruc=substr($documento,0,2);
						if ($tipo_ruc==10) {
							$documento=substr($ruc, 2,8);
							$tipo_doc=="DNI";
						}else{
							$documento=$ruc;
						}
					}else{
						$ruc=NULL;
						$documento=$documento;
					}

			        $stmt = $this->bd->prepare("select * from deudor where documento=:documento or ruc=:ruc; ");
			        $stmt->bindParam(':documento',$documento);
			        $stmt->bindParam(':ruc',$ruc);
			       if (!$stmt->execute()) {print_r($stmt->errorInfo());}                  
			        $Deudor=$stmt->fetch(PDO::FETCH_ASSOC);
			        $Deudor_id=0;
			        if($Deudor['idDeudor']==NULL){  
			        	$error_doc="cliente nuevo";          
			            $stmt = $this->bd->prepare("INSERT INTO deudor(documento,ruc,tipo_doc,razon_social,ingresado_por) VALUES(:documento,:ruc,:tipo_doc,:razon_social,:ingresado_por)");
			            $stmt->bindParam(':documento',$documento);
			            $stmt->bindParam(':ruc',$ruc);
			             $stmt->bindParam(':tipo_doc',$tipo_doc);
			            $stmt->bindParam(':razon_social',$cliente);
			            $stmt->bindParam(':ingresado_por',$ingresado_por);
						if (!$stmt->execute()) {print_r($stmt->errorInfo());}						
			            $Deudor_id=$this->bd->lastInsertId();
			            $Deudor_registrado=$stmt->rowCount();
			            $ultimo_ges_call_bd=0;
						$mejor_ges_call_bd=0;
						$mejor_ges_campo_bd=0;
						$ultimo_ges_campo_bd=0;
			        }else{
			        	$error_doc="el cliente ya existe en la BD";
			            $Deudor_id=$Deudor['idDeudor'];
			            $ultimo_ges_call_bd=$Deudor['call_mejor_ges_id'];
  						$mejor_ges_call_bd=$Deudor['call_ultimo_ges_id']; 
  						$mejor_ges_campo_bd=$Deudor['campo_mejor_ges_id'];
  						$ultimo_ges_campo_bd=$Deudor['campo_ultimo_ges_id'];         
			        }

			        if($Deudor_id<>0){
			        	$error_nroope="nrooperacion ya existe";
			        	
			        		$error_nroope="nrooperacion nueva";
			        	 	if($capital != ""){$capital = $capital;}else{$capital = 0;}       
					        if($deuda_total != ""){$deuda_total = $deuda_total;}else{$deuda_total = 0;}        
					        if($deuda_vencida != ""){$deuda_vencida = $deuda_vencida;}else{$deuda_vencida = 0;}
					        if($monto_campania != ""){$monto_campania = $monto_campania;}else{$monto_campania = 0;}
					        if($dias_mora != ""){$dias_mora = $dias_mora;}else{$dias_mora = 0;}
					        if ($fecha_asignacion!=''){$fecha_asignacion=date('Y-m-d',strtotime($fecha_asignacion));}else{$fech_asignacion=NULL;}
  
					        $stmt = $this->bd->prepare("INSERT INTO Obligacion(Campana_id,Deudor_id,nrooperacion,operacion,producto,moneda,capital,deuda_total,deuda_vencida,monto_campania,desc_campania,dias_mora,fecha_vencimiento,nro_cuota,plazo,segmento,fecha_asignacion,ultimo_ges_call_bd,mejor_ges_call_bd,mejor_ges_campo_bd,ultimo_ges_campo_bd,ingresado_por) VALUES(:Campana_id,:Deudor_id,:nrooperacion,:operacion,:producto,:moneda,:capital,:deuda_total,:deuda_vencida,:monto_campania,:desc_campania,:dias_mora,:fecha_vencimiento,:nro_cuota,:plazo,:segmento,:fecha_asignacion,:ultimo_ges_call_bd,:mejor_ges_call_bd,:mejor_ges_campo_bd,:ultimo_ges_campo_bd,:ingresado_por)");

					       	$stmt->bindParam(':Campana_id',$Campana_id);
					       	$stmt->bindParam(':Deudor_id',$Deudor_id);
					       	$stmt->bindParam(':nrooperacion',$nrooperacion);
					       	$stmt->bindParam(':operacion',$operacion);
					       	$stmt->bindParam(':producto',$producto);
					       	$stmt->bindParam(':moneda',$moneda);
					       	$stmt->bindParam(':capital',$capital);
					       	$stmt->bindParam(':deuda_total',$deuda_total);
					       	$stmt->bindParam(':deuda_vencida',$deuda_vencida);
					       	$stmt->bindParam(':monto_campania',$monto_campania);
					       	$stmt->bindParam(':desc_campania',$desc_campania);
					       	$stmt->bindParam(':dias_mora',$dias_mora);
					       	$stmt->bindParam(':fecha_vencimiento',$fecha_vencimiento);
					       	$stmt->bindParam(':nro_cuota',$nro_cuota);
					       	$stmt->bindParam(':plazo',$plazo);
					       	$stmt->bindParam(':segmento',$segmento);
					       	$stmt->bindParam(':fecha_asignacion',$fecha_asignacion);
					       	$stmt->bindParam(':ultimo_ges_call_bd',$ultimo_ges_call_bd);
							$stmt->bindParam(':mejor_ges_call_bd',$mejor_ges_call_bd);
							$stmt->bindParam(':mejor_ges_campo_bd',$mejor_ges_campo_bd);
							$stmt->bindParam(':ultimo_ges_campo_bd',$ultimo_ges_campo_bd);
					       	$stmt->bindParam(':ingresado_por',$ingresado_por);		       	
					        
					        if (!$stmt->execute()) {print_r($stmt->errorInfo());}
					        $obligacion_registrada=$stmt->rowCount();
					        if($obligacion_registrada==0){
					        	$error_nroope="nrooperacion ya existe";
					        }	
			        	
			       		
			        }
			        	
		        }
		        $FileObligaciones[$fila]['registrado_deudor']=$Deudor_registrado;
		        $FileObligaciones[$fila]['motivo_deudor']=$error_doc.$error_cli;
		        $FileObligaciones[$fila]['registrado_obligacion']=$obligacion_registrada;
		    	$FileObligaciones[$fila]['motivo_obligacion']=$error_nroope.$error_oper;
		    	$FileObligaciones[$fila]['hora']=date("H:i:s",time());
		         
	        }	    
	    	 //echo $fila++.'->'.$Deudor_id.'->'.date("H:i:s",time()).'<br>';
	       	$fila++;
	    }
	    fclose ( $fp );
	    //$this->Resultado_Importar_Clientes($subir_registros);
	    $this->Resultado_Importar($FileObligaciones,"OBLIGACION");
	   // header('Location: index.php?c=Campana&a=v_Importar&idCampana='.$Campana_id);
    }


    public function Act_Campana(){
        $this->bd = new Conexion();
        $Campana_id=$_REQUEST['idCampana'];
        // conectamos a la base de datos
        ini_set('max_execution_time', 10000);
        $tempFile = $_FILES['DataObligacionAct']['tmp_name'];
        $nombre = $_FILES['DataObligacionAct']['name'];
        $filename = $nombre;
        $ruta = getcwd() ."/uploads/csv/".$filename;
        move_uploaded_file($tempFile, $ruta);
        $fp = fopen ( $ruta , "r" );
        $fila=0;
        $nuevos=0;
        $antiguos=0;
        $FileObligaciones = array();

        $stmt = $this->bd->prepare("select nrooperacion,Deudor_id,operacion,retirado,activo from obligacion where campana_id=$Campana_id;");
        $stmt->execute();
        $registro_campana = $stmt->fetchAll();  
        $array_obligaciones = array();
        foreach ($registro_campana as $registro) {
        	$array_obligaciones[$registro['nrooperacion']]['nrooperacion']=$registro['nrooperacion'];
        	$array_obligaciones[$registro['nrooperacion']]['Deudor_id']=$registro['Deudor_id'];
        	$array_obligaciones[$registro['nrooperacion']]['operacion']=$registro['operacion'];
        	$array_obligaciones[$registro['nrooperacion']]['retirado']=$registro['retirado'];
        	$array_obligaciones[$registro['nrooperacion']]['activo']=$registro['activo'];
        }
        while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
        setlocale(LC_ALL, 'es_ES.UTF8');
        $i = 0;
            if($fila>0){
            	$contador=$data[0];
                $nrooperacion=$data[1];
                $operacion=$data[2];
                $producto=utf8_encode($data[3]);
                $moneda=$data[4];
                $capital=$data[5];
                $deuda_total=$data[6];
                $deuda_vencida=$data[7];
                $monto_campania=utf8_encode($data[8]);
                $desc_campania=$data[9];
                $monto_camp_min=$data[10];
                $desc_camp_min=utf8_encode($data[11]);
                $dias_mora=$data[12];
                $fecha_vencimiento=utf8_encode($data[13]);
                $nrocuota=$data[14];
                $plazo=$data[15];
                $origen=$data[16];
                $segmento=utf8_encode($data[17]);
                $prioridad=$data[18];
                $estrategia1=$data[19];
                $estrategia2=$data[20];
                $estrategia3=$data[21];
                if ($data[22]!='') {$fecha_asignacion=date('Y-m-d',strtotime($data[22]));}else{$fecha_asignacion='';}   
                $Operador_id=$data[23];
                $activo=$data[24];
                $retirado=$data[25];
                $monto_asignado=$data[26];
                $tiene_pago=$data[27];
                if ($data[28]!='') {$fecha_pago=date('Y-m-d',strtotime($data[28]));}else{$fecha_pago='';}
                $monto_pago=$data[29];
                $monto_negociacion=$data[30];

				$FileObligaciones[$fila]['contador']=$contador;
				$FileObligaciones[$fila]['nrooperacion']=$nrooperacion;
				$FileObligaciones[$fila]['operacion']=$operacion;
				$FileObligaciones[$fila]['producto']=$producto;
				$FileObligaciones[$fila]['moneda']=$moneda;
				$FileObligaciones[$fila]['capital']=$capital;
				$FileObligaciones[$fila]['deuda_total']=$deuda_total;
				$FileObligaciones[$fila]['deuda_vencida']=$deuda_vencida;
				$FileObligaciones[$fila]['monto_campania']=$monto_campania;
				$FileObligaciones[$fila]['desc_campania']=$desc_campania;
				$FileObligaciones[$fila]['monto_camp_min']=$monto_camp_min;
				$FileObligaciones[$fila]['desc_camp_min']=$desc_camp_min;
				$FileObligaciones[$fila]['dias_mora']=$dias_mora;
				$FileObligaciones[$fila]['fecha_vencimiento']=$fecha_vencimiento;
				$FileObligaciones[$fila]['nrocuota']=$nrocuota;
				$FileObligaciones[$fila]['plazo']=$plazo;
				$FileObligaciones[$fila]['origen']=$origen;
				$FileObligaciones[$fila]['segmento']=$segmento;
				$FileObligaciones[$fila]['prioridad']=$prioridad;
				$FileObligaciones[$fila]['estrategia1']=$estrategia1;
				$FileObligaciones[$fila]['estrategia2']=$estrategia2;
				$FileObligaciones[$fila]['estrategia3']=$estrategia3;
				$FileObligaciones[$fila]['fecha_asignacion']=$fecha_asignacion;
				$FileObligaciones[$fila]['Operador_id']=$Operador_id;
				$FileObligaciones[$fila]['activo']=$activo;
				$FileObligaciones[$fila]['retirado']=$retirado;
				$FileObligaciones[$fila]['monto_asignado']=$monto_asignado;
				$FileObligaciones[$fila]['tiene_pago']=$tiene_pago;
				$FileObligaciones[$fila]['fecha_pago']=$fecha_pago;
				$FileObligaciones[$fila]['monto_pago']=$monto_pago;
				$FileObligaciones[$fila]['monto_negociacion']=$monto_negociacion;
				$error_nroope="nrooperacion no existe";
				$nrooperacion_actualizada=0;
				$error_act="";
                if (isset($array_obligaciones[$nrooperacion])){
	                $error_nroope="";
	                if($operacion != ""){$operacion = ", operacion='".$operacion."'";}else{$operacion = "";}
	                if($producto != ""){$producto = ", producto='".$producto."'";}else{$producto = "";}
	                if($moneda != ""){$moneda = ", moneda='".$moneda."'";}else{$moneda = "";}
	                if($capital != ""){$capital = ", capital=$capital";}else{$capital = "";}
	                if($deuda_total != ""){$deuda_total = ", deuda_total=$deuda_total";}else{$deuda_total = "";}
	                if($deuda_vencida != ""){$deuda_vencida = ", deuda_vencida=$deuda_vencida";}else{$deuda_vencida = "";}
	                if($monto_campania != ""){$monto_campania = ", monto_campania=$monto_campania";}else{$monto_campania = "";}
	                if($desc_campania != ""){$desc_campania = ", desc_campania='".$desc_campania."'";}else{$desc_campania = "";}
	                if($monto_camp_min != ""){$monto_camp_min = ", monto_camp_min=$monto_camp_min";}else{$monto_camp_min = "";}
	                if($desc_camp_min != ""){$desc_camp_min = ", desc_camp_min='".$desc_camp_min."'";}else{$desc_camp_min = "";}
	                if($dias_mora != ""){$dias_mora = ", dias_mora=$dias_mora";}else{$dias_mora = "";}
	                if($fecha_vencimiento != ""){$fecha_vencimiento = ", fecha_vencimiento='".$fecha_vencimiento."'";}else{$fecha_vencimiento = "";}
	                if($nrocuota != ""){$nrocuota = ", nrocuota='".$nrocuota."'";}else{$nrocuota = "";}
	                if($plazo != ""){$plazo = ", plazo='".$plazo."'";}else{$plazo = "";}
	                if($origen != ""){$origen = ", origen='".$origen."'";}else{$origen = "";}
	                if($segmento != ""){$segmento = ", segmento='".$segmento."'";}else{$segmento = "";}
	                if($prioridad != ""){$prioridad = ", prioridad='".$prioridad."'";}else{$prioridad = "";}
	                if($estrategia1 != ""){$estrategia1 = ", estrategia1='".$estrategia1."'";}else{$estrategia1 = "";}
	                if($estrategia2 != ""){$estrategia2 = ", estrategia2='".$estrategia2."'";}else{$estrategia2 = "";}
	                if($estrategia3 != ""){$estrategia3 = ", estrategia3='".$estrategia3."'";}else{$estrategia3 = "";}
	                if($fecha_asignacion != ""){$fecha_asignacion = ", fecha_asignacion='".$fecha_asignacion."'";}else{$fecha_asignacion = "";}
	                if($Operador_id != ""){$Operador_id = ", Operador_id=$Operador_id";}else{$Operador_id = "";}
	                if($activo != ""){$activo = ", activo='".$activo."'";}else{$activo = "";}
	                if($retirado != ""){$retirado = ", retirado='".$retirado."'";}else{$retirado = "";}
	                if($monto_asignado != ""){$monto_asignado = ", monto_asignado='".$monto_asignado."'";}else{$monto_asignado = "";}
	                if($tiene_pago != ""){$tiene_pago = ", tiene_pago='".$tiene_pago."'";}else{$tiene_pago = "";}
	                if($fecha_pago != ""){$fecha_pago = ", fecha_pago='".$fecha_pago."'";}else{$fecha_pago = "";}
	                if($monto_pago != ""){$monto_pago = ", monto_pago='".$monto_pago."'";}else{$monto_pago = "";}
	                if($monto_negociacion != ""){$monto_negociacion = ", monto_negociacion='".$monto_negociacion."'";}else{$monto_negociacion = "";}
	                $campo_actualizar="$operacion$producto$moneda$capital$deuda_total$deuda_vencida$monto_campania$desc_campania$monto_camp_min$desc_camp_min$dias_mora$fecha_vencimiento$nrocuota$plazo$origen$segmento$prioridad$estrategia1$estrategia2$estrategia3$fecha_asignacion$Operador_id$activo$retirado$monto_asignado$tiene_pago$fecha_pago$monto_pago$monto_negociacion";            
	                if(strpos($campo_actualizar,",")==0){
	                    $campo_actualizar=substr($campo_actualizar,1);
	                }
	                $stmt = $this->bd->prepare("UPDATE obligacion SET $campo_actualizar WHERE Campana_id=$Campana_id and nrooperacion='".$nrooperacion."';");
	                
	                if (!$stmt->execute()) {
				            $errors = $stmt->errorInfo();
				            //echo ($errors[2]);
				           $error_act=$errors[2];          
				            //print_r($stmt->errorInfo());
				    }else{
				    	$nrooperacion_actualizada=$stmt->rowCount();
		                $error_act="registro actualizado";
		                if($nrooperacion_actualizada==0){
						        	$error_act="ninguna modificacion";
						}
				    }

	                	
            	}
            	$FileObligaciones[$fila]['actualizado']=$nrooperacion_actualizada;
		    	$FileObligaciones[$fila]['motivo_obligacion']=$error_nroope.$error_act;
		    	$FileObligaciones[$fila]['hora']=date("H:i:s",time());
            }
            //echo $fila++.'->'.date("H:i:s",time()).'<br>';
             $fila++;
        }
        fclose ($fp);
        //header('Location: index.php?c=Campana&a=v_Importar&idCampana='.$Campana_id);
       
        $this->Resultado_Importar($FileObligaciones,"ACT_OBLIGACION");
    }

  
  /*==================importar pagos======================*/
    public function Imp_Pagos_Camp(){
        $this->bd = new Conexion();
        $Campana_id=$_REQUEST['idCampana'];
        // conectamos a la base de datos
        ini_set('max_execution_time', 10000);
        $tempFile = $_FILES['DataPagosCamp']['tmp_name'];
        $nombre = $_FILES['DataPagosCamp']['name'];
        $filename = $nombre;
        $ruta = getcwd() ."/uploads/csv/".$filename;
        move_uploaded_file($tempFile, $ruta);
        $fp = fopen ( $ruta , "r" );
        $fila=0;
        $nuevos=0;
        $antiguos=0;
        $ingresado_por=$_SESSION['Usuario_Actual'];
        $FilePagos = array();
		
        $stmt = $this->bd->prepare("select idObligacion,nrooperacion,Deudor_id,operacion,retirado,activo,Operador_id,Gestor_id from obligacion where campana_id=$Campana_id;");
        $stmt->execute();
        $registro_campana = $stmt->fetchAll();  
        $array_obligaciones = array();
        foreach ($registro_campana as $registro) {
        	$array_obligaciones[$registro['nrooperacion']]['idObligacion']=$registro['idObligacion'];
        	$array_obligaciones[$registro['nrooperacion']]['nrooperacion']=$registro['nrooperacion'];
        	$array_obligaciones[$registro['nrooperacion']]['Deudor_id']=$registro['Deudor_id'];
        	$array_obligaciones[$registro['nrooperacion']]['Gestor_id']=$registro['Gestor_id'];
        	$array_obligaciones[$registro['nrooperacion']]['Operador_id']=$registro['Operador_id'];
        	$array_obligaciones[$registro['nrooperacion']]['operacion']=$registro['operacion'];
        	$array_obligaciones[$registro['nrooperacion']]['retirado']=$registro['retirado'];
        	$array_obligaciones[$registro['nrooperacion']]['activo']=$registro['activo'];
        	
        }

        $stmt = $this->bd->prepare("select * from pago where campana_id=$Campana_id and eliminado=0;");
        $stmt->execute();
        $registro_pago = $stmt->fetchAll();  
        $array_pagos = array();
        foreach ($registro_pago as $registro) {
        	$array_pagos[$registro['nrooperacion']]['idPago']=$registro['idPago'];
        	$array_pagos[$registro['nrooperacion']]['nrooperacion']=$registro['nrooperacion'];
        	$array_pagos[$registro['nrooperacion']]['Deudor_id']=$registro['Deudor_id'];
        	$array_pagos[$registro['nrooperacion']]['tipo_pago']=$registro['tipo_pago'];
        	$array_pagos[$registro['nrooperacion']]['fecha_pago']=$registro['fecha_pago'];
        	$array_pagos[$registro['nrooperacion']]['moneda']=$registro['moneda'];
        	$array_pagos[$registro['nrooperacion']]['monto']=$registro['monto'];
        	$array_pagos[$registro['nrooperacion']]['fecha_registro']=$registro['fecha_registro'];

        }
        while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
        setlocale(LC_ALL, 'es_ES.UTF8');
        $i = 0;
            if($fila>0){
            	$contador=$data[0];
                $nrooperacion=$data[1];
                $tipo_pago=$data[2];
                if ($data[3]!='') {$fecha_pago=date('Y-m-d',strtotime($data[3]));}else{$fecha_pago='';}
                $moneda=$data[4];
                $monto=$data[5];

				$FilePagos[$fila]['contador']=$contador;
				$FilePagos[$fila]['nrooperacion']=$nrooperacion;
				$FilePagos[$fila]['tipo_pago']=$tipo_pago;
				$FilePagos[$fila]['fecha_pago']=$fecha_pago;
				$FilePagos[$fila]['moneda']=$moneda;
				$FilePagos[$fila]['monto']=$monto;
				$error_nroope="nrooperacion no existe";
				$registrado=0;
                if (isset($array_obligaciones[$nrooperacion])){
	                $error_nroope="";

	                if (isset($array_pagos[$nrooperacion])){
	               		
	               		$fecha_pago_bd=$array_pagos[$nrooperacion]['fecha_pago'];
	            		$monto_pago_bd=$array_pagos[$nrooperacion]['monto'];
	            		$moneda_pago_bd=$array_pagos[$nrooperacion]['moneda'];
	            		if($fecha_pago<>$fecha_pago_bd){
	            				
	            			$stmt = $this->bd->prepare("INSERT INTO pago(Campana_id,Deudor_id,Obligacion_id,Gestor_id,Operador_id,nrooperacion,tipo_pago,fecha_pago,moneda,monto,ingresado_por) VALUES(:Campana_id,:Deudor_id,:Obligacion_id,:Gestor_id,:Operador_id,:nrooperacion,:tipo_pago,:fecha_pago,:moneda,:monto,:ingresado_por)");
				            $stmt->bindParam(':Campana_id', $Campana_id);
				            $stmt->bindParam(':Deudor_id', $array_obligaciones[$nrooperacion]['Deudor_id']);
					        $stmt->bindParam(':Obligacion_id', $array_obligaciones[$nrooperacion]['idObligacion']);
					        $stmt->bindParam(':Gestor_id', $array_obligaciones[$nrooperacion]['Gestor_id']);
					        $stmt->bindParam(':Operador_id', $array_obligaciones[$nrooperacion]['Operador_id']);
					        $stmt->bindParam(':nrooperacion',$nrooperacion);
					        $stmt->bindParam(':tipo_pago', $tipo_pago);
					        $stmt->bindParam(':fecha_pago', $fecha_pago);
					        $stmt->bindParam(':moneda', $moneda);
					        $stmt->bindParam(':monto', $monto);
					        $stmt->bindParam(':ingresado_por', $ingresado_por);
					        $stmt->execute();
					        $Pago_id=$this->bd->lastInsertId();
				            $registrado=$stmt->rowCount();
				            
				            $upd_stmt = $this->bd->prepare("UPDATE obligacion SET  tiene_pago=1,fecha_pago=:fecha_pago,monto_pago=:monto_pago WHERE idObligacion=:idObligacion");
					        $upd_stmt->bindParam(':idObligacion',$array_obligaciones[$nrooperacion]['idObligacion']);
					        $upd_stmt->bindParam(':fecha_pago',$fecha_pago);
					        $upd_stmt->bindParam(':monto_pago',$monto);
					        $upd_stmt->execute();

					        $upd_stmt = $this->bd->prepare("UPDATE compromiso SET  estado_compromiso=2,Pago_id=:Pago_id WHERE  Campana_id=:Campana_id and Obligacion_id=:Obligacion_id  and estado_compromiso in (1,3)");

					        $upd_stmt->bindParam(':Campana_id',$Campana_id);
					        $upd_stmt->bindParam(':Obligacion_id',$array_obligaciones[$nrooperacion]['idObligacion']);
					        $upd_stmt->bindParam(':Pago_id', $Pago_id);
					        $upd_stmt->execute();
				            //print_r($stmt->errorInfo());
		                	 //$registrado.'-'.$nrooperacion.'-'.$array_obligaciones[$nrooperacion]['idObligacion'].' -> no hay pagos <br>';
		                		$error_pago="Pago nuevo";
	            		}else{
							$error_pago="Pago existente en la BD";
	            		}


	                }else{
	                	$error_pago="Pago nuevo";
	                	$stmt = $this->bd->prepare("INSERT INTO pago(Campana_id,Deudor_id,Obligacion_id,Gestor_id,Operador_id,nrooperacion,tipo_pago,fecha_pago,moneda,monto,ingresado_por) VALUES(:Campana_id,:Deudor_id,:Obligacion_id,:Gestor_id,:Operador_id,:nrooperacion,:tipo_pago,:fecha_pago,:moneda,:monto,:ingresado_por)");
				            $stmt->bindParam(':Campana_id', $Campana_id);
				            $stmt->bindParam(':Deudor_id', $array_obligaciones[$nrooperacion]['Deudor_id']);
					        $stmt->bindParam(':Obligacion_id', $array_obligaciones[$nrooperacion]['idObligacion']);
					        $stmt->bindParam(':Gestor_id', $array_obligaciones[$nrooperacion]['Gestor_id']);
					        $stmt->bindParam(':Operador_id', $array_obligaciones[$nrooperacion]['Operador_id']);
					        $stmt->bindParam(':nrooperacion',$nrooperacion);
					        $stmt->bindParam(':tipo_pago', $tipo_pago);
					        $stmt->bindParam(':fecha_pago', $fecha_pago);
					        $stmt->bindParam(':moneda', $moneda);
					        $stmt->bindParam(':monto', $monto);
					        $stmt->bindParam(':ingresado_por', $ingresado_por);
					        $stmt->execute();
					        $Pago_id=$this->bd->lastInsertId();
				            $registrado=$stmt->rowCount();
				            //print_r($stmt->errorInfo());
				            $upd_stmt = $this->bd->prepare("UPDATE obligacion SET  tiene_pago=1,fecha_pago=:fecha_pago,monto_pago=:monto_pago WHERE idObligacion=:idObligacion");
					        $upd_stmt->bindParam(':idObligacion',$array_obligaciones[$nrooperacion]['idObligacion']);
					        $upd_stmt->bindParam(':fecha_pago',$fecha_pago);
					        $upd_stmt->bindParam(':monto_pago',$monto);
					        $upd_stmt->execute();
					   		//echo $registrado.'-'.$nrooperacion.'-'.$array_obligaciones[$nrooperacion]['idObligacion'].' -> no hay pagos <br>';

					   		$upd_stmt = $this->bd->prepare("UPDATE compromiso SET  estado_compromiso=2,Pago_id=:Pago_id WHERE  Campana_id=:Campana_id and Obligacion_id=:Obligacion_id  and estado_compromiso in (1,3)");

					        $upd_stmt->bindParam(':Campana_id',$Campana_id);
					        $upd_stmt->bindParam(':Obligacion_id',$array_obligaciones[$nrooperacion]['idObligacion']);
					        $upd_stmt->bindParam(':Pago_id', $Pago_id);
					        $upd_stmt->execute();
	                }	            
            	}
            	$FilePagos[$fila]['registrado']=$registrado;
		    	$FilePagos[$fila]['motivo']=$error_nroope.$error_pago;
		    	$FilePagos[$fila]['hora']=date("H:i:s",time());
            }
            //echo $fila++.'->'.date("H:i:s",time()).'<br>';
             $fila++;
        }
        fclose ($fp);
        //header('Location: index.php?c=Campana&a=v_Importar&idCampana='.$Campana_id);
       
        $this->Resultado_Importar($FilePagos,"PAGO");
    }

    public function Act_Info_Deudor()
    {
    	//establecemos que no tenga limite de tiempo de ejecucion
    	ini_set('max_execution_time', -1); 
    	// conectamos a la base de datos
    	$this->bd = new Conexion();
    	//obtemos y almacenamos la variable del usuario logueado
    	$ingresado_por=$_SESSION['Usuario_Actual'];
    	   
		$tempFile = $_FILES['DataDeudores']['tmp_name'];
		$nombre = $_FILES['DataDeudores']['name'];
		$filename = $nombre;
		$ruta = getcwd() ."/uploads/csv/".$filename;
		move_uploaded_file($tempFile, $ruta);
		$fp = fopen ( $ruta , "r" );
		$fila=0;
		//declaramos el array que va a almacenar el resultado de la importacion
		$FileDeudores = array();
		while (( $data = fgetcsv ($fp,1000,",")) !== FALSE )
		{
			if($fila>0)
			{
				//declaramos variables segun los campo a actualizar y almacenamos los datos obtenidos del csv en cada variable segun la posicion
				$contador=$data[0];
				$tipo_doc=utf8_encode($data[1]);
				$documento=$data[2];
				$razon_social=utf8_encode(addslashes($data[3]));
				$ruc=$data[4];
				$ApellidoPaterno=utf8_encode(addslashes($data[5]));
				$ApellidoMaterno=utf8_encode(addslashes($data[6]));
				$PrimerNombre=utf8_encode(addslashes($data[7]));
				$SegundoNombre=utf8_encode(addslashes($data[8]));
				$sexo=utf8_encode($data[9]);
				if ($data[10]!='')
				{
					$fecha_nacimiento=date('Y-m-d',strtotime($data[10]));
		        }else
		        {
		        	$fecha_nacimiento=NULL;
		        }
		        $tipo_deudor=$data[11];
		        $empresa_trab=utf8_encode(addslashes($data[12]));
		        $sueldo=$data[13];
		        $cargo=utf8_encode(addslashes($data[14]));
		        $conyuge=utf8_encode(addslashes($data[15]));
		        $fallecido=$data[16];
		        //guardamos el registro obtenido del csv en el array de resultado
				$FileDeudores[$fila]['contador']=$contador;
				$FileDeudores[$fila]['tipo']=$tipo_doc;
				$FileDeudores[$fila]['documento']=$documento;
				$FileDeudores[$fila]['razon_social']=$razon_social;
				$FileDeudores[$fila]['ruc']=$razon_social;
				$FileDeudores[$fila]['ApellidoPaterno']=$ApellidoPaterno;
				$FileDeudores[$fila]['ApellidoMaterno']=$ApellidoMaterno;
				$FileDeudores[$fila]['PrimerNombre']=$PrimerNombre;
				$FileDeudores[$fila]['SegundoNombre']=$SegundoNombre;
				$FileDeudores[$fila]['sexo']=$sexo;
				$FileDeudores[$fila]['fecha_nacimiento']=$fecha_nacimiento;
				$FileDeudores[$fila]['empresa_trab']=$empresa_trab;
				$FileDeudores[$fila]['tipo_deudor']=$tipo_deudor;
				$FileDeudores[$fila]['sueldo']=$sueldo;
				$FileDeudores[$fila]['cargo']=$sueldo;
				$FileDeudores[$fila]['conyuge']=$conyuge;
				$FileDeudores[$fila]['fallecido']=$fallecido;
				$actualizado=0;			

				        	
		   		//preparamos la consulta sql para verificar si el deudor esta registrado en la Tabla Deudor de la BD
	        	$stmt = $this->bd->prepare("SELECT * FROM deudor WHERE documento=:documento");
	        	//relacionamos los parametros que tiene la consulta sql
	        	$stmt->bindParam(':documento',$documento);
	        	//ejecutamos la consulta sql
        		$stmt->execute();
        		//asignamos los registros obtenidos de la consulta en la variable $Deudor                   
        		$Deudor=$stmt->fetch(PDO::FETCH_ASSOC);
        		//declaramos y asignamos idDeudor obtenido de la consulta sql	        
	        	$Deudor_id=$Deudor['idDeudor'];	 
	        	//verificamos si el idDeudor Existe
	        	$error_deudor="No existe en la BD";
				if ($Deudor['idDeudor']!=NULL)
				{
					$error_deudor="";
					//verificamos si los campos del archivo csv que tengan datos
					if($tipo_doc != ""){$tipo_doc = ", tipo_doc='".$tipo_doc."'";}else{$tipo_doc = "";}
	                if($razon_social != ""){$razon_social = ", razon_social='".$razon_social."'";}else{$razon_social = "";}
	                if($ruc != ""){$ruc = ", ruc='".$ruc."'";}else{$ruc = "";}
	                if($ApellidoPaterno != ""){$ApellidoPaterno = ", ApellidoPaterno='".$ApellidoPaterno."'";}else{$ApellidoPaterno = "";}
	                if($ApellidoMaterno != ""){$ApellidoMaterno = ", ApellidoMaterno='".$ApellidoMaterno."'";}else{$ApellidoMaterno = "";}
	                if($PrimerNombre != ""){$PrimerNombre = ", PrimerNombre='".$PrimerNombre."'";}else{$PrimerNombre = "";}
	                if($SegundoNombre != ""){$SegundoNombre = ", SegundoNombre='".$SegundoNombre."'";}else{$SegundoNombre = "";}
	                if($sexo != ""){$sexo = ", sexo='".$sexo."'";}else{$sexo = "";}
	                if($fecha_nacimiento != ""){$fecha_nacimiento = ", fecha_nacimiento='".$fecha_nacimiento."'";}else{$fecha_nacimiento = "";}
	                if($tipo_deudor != ""){$tipo_deudor = ", tipo_deudor='".$tipo_deudor."'";}else{$tipo_deudor = "";}
	                if($empresa_trab != ""){$empresa_trab = ", empresa_trab='".$empresa_trab."'";}else{$empresa_trab = "";}
	                if($sueldo != ""){$sueldo = ", sueldo='".$sueldo."'";}else{$sueldo = "";}
	                if($cargo != ""){$cargo = ", cargo_trab='".$cargo."'";}else{$cargo = "";}
	                if($conyuge != ""){$conyuge = ", conyuge='".$conyuge."'";}else{$conyuge = "";}
	                if($fallecido != ""){$fallecido = ", fallecido='".$fallecido."'";}else{$fallecido = "";}
	               //agrupamos las variables con los campos a actualizar
	                $campo_actualizar="$tipo_doc$razon_social$ruc$ApellidoPaterno$ApellidoMaterno$PrimerNombre$SegundoNombre$sexo$fecha_nacimiento$tipo_deudor$empresa_trab$sueldo$cargo$conyuge$fallecido";
	                //verificamos si hay una ultima coma para eliminar             
	                if(strpos($campo_actualizar,",")==0)
	                {
	                    $campo_actualizar=substr($campo_actualizar,1);
	                }

	                //preparamos la sentencia UPDATE para actualizar la informacion del deudor
	                $stmt = $this->bd->prepare("UPDATE deudor SET $campo_actualizar WHERE idDeudor=$Deudor_id ");
					//ejecutamos la sentencia                
	                $stmt->execute();
	                //obtenemos el nro de filas afectadas 
		        	$actualizado=$stmt->rowCount();									
				}
				//almacenamos en el array el nro de filas afectadas
				$FileDeudores[$fila]['actualizado']=$actualizado;
				//asignamos el motivo del proceso
		    	$FileDeudores[$fila]['motivo']=$error_deudor;
		    	//asignamos la hora en que se realizo el proceso
		    	$FileDeudores[$fila]['hora']=date("H:i:s",time());
			}
		 $fila++;
		}
		fclose ($fp);

		//llamamos al funcion que exporta el resultado de la importacion
		$this->Resultado_Importar($FileDeudores,"DEUDOR");
		 			
    }


    //*--FUNCION PARA IMPORTAR CORREOS--*//
    public function Imp_Gest_Call(){
    	// conectamos a la base de datos
    	$this->bd = new Conexion();
    	$ingresado_por=$_SESSION['Usuario_Actual'];	    
	    ini_set('max_execution_time', 10000);
	    $tempFile = $_FILES['DataGestionesCall']['tmp_name'];
	    $nombre = $_FILES['DataGestionesCall']['name'];
	    $filename = $nombre;
	    $ruta = getcwd() ."/uploads/csv/".$filename;
	    move_uploaded_file($tempFile, $ruta);
	    $fp = fopen ( $ruta , "r" );
	    $fila=0;
	    $FileGestiones = array();

	     $tipo_contacto = $this->Consultas("select * from contacto where  activo=1 and eliminado=0;");
	    $array_tipo_cto = array();
        foreach ($tipo_contacto as $item) {
        	 $array_tipo_cto[$item['descripcion']]=$item['idContacto'];
        }

 		$motivo_no_pago = $this->Consultas("select * from motivo where  activo=1 and eliminado=0;");
	    $array_motivo = array();
        foreach ($motivo_no_pago as $item) {
        	 $array_motivo[$item['descripcion']]=$item['idMotivo'];
        }



	    while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
	    	 //declaramos las variables
	      
	        
	        if($fila>0){
	        	$registrado=0;
	        	$error_resultado="";
				$error_telefono="";
				$error_tipogestion="";
				$error_deudor="";
				$error_persona="";
				$error_operador="";
				$error_campana="";
	        	$id=$data[0];
				$campana=$data[1];
				$persona=$data[2];
				$operador=$data[3];
				$documento=$data[4];
				$tipo_gestion=$data[5];
				$telefono=$data[6];
				$tipo_tel=$data[7];
				if ($data[8]!=''){$fecha_gestion=date('Y-m-d',strtotime($data[8]));}else{$fecha_gestion=NULL;}
				$hora_inicio=$data[9];
				$hora_fin=$data[10];
				$codigo_resultado=$data[11];
				$contacto=$data[12];
				$motivo=$data[13];
				$nrooperacion=$data[14];
				if ($data[15]!=''){$fecha_comp=date('Y-m-d',strtotime($data[15]));}else{$fecha_comp=NULL;}
				$monto_comp=$data[16];
				$moneda_comp=$data[17];
				$observaciones=$data[18];

				$FileGestiones[$fila]['id']=$id;
				$FileGestiones[$fila]['campana']=$campana;
				$FileGestiones[$fila]['codigo_persona']=$persona;
				$FileGestiones[$fila]['operador']=$operador;
				$FileGestiones[$fila]['documento']=$documento;
				$FileGestiones[$fila]['tipo_gestion']=$tipo_gestion;
				$FileGestiones[$fila]['telefono']=$telefono;
				$FileGestiones[$fila]['tipo_tel']=$tipo_tel;
				$FileGestiones[$fila]['fecha_gestion']=$fecha_gestion;
				$FileGestiones[$fila]['hora_inicio']=$hora_inicio;
				$FileGestiones[$fila]['hora_fin']=$hora_fin;
				$FileGestiones[$fila]['codigo_resultado']=$codigo_resultado;
				$FileGestiones[$fila]['contacto']=$contacto;
				$FileGestiones[$fila]['motivo']=$motivo;
				$FileGestiones[$fila]['nrooperacion']=$nrooperacion;
				$FileGestiones[$fila]['fecha_comp']=$fecha_comp;
				$FileGestiones[$fila]['monto_comp']=$monto_comp;
				$FileGestiones[$fila]['moneda_comp']=$moneda_comp;
				$FileGestiones[$fila]['observaciones']=$observaciones;

				
				/*Consultar idCampana*/
				$stmt = $this->bd->prepare("select * from campana where idCampana=:idCampana;");
				$stmt->bindParam(':idCampana', $campana);
	        	$stmt->execute();
	        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                 
	        	$Campana=$stmt->fetch(PDO::FETCH_ASSOC);
	        	if ($Campana['idCampana']!=NULL) {
	        		$Campana_id=$Campana['idCampana'];
	        		/*gestiones*/


	        		/*Consultar USUARIO*/
	        		$stmt = $this->bd->prepare("select * from persona where codigo=:codigo;");
					$stmt->bindParam(':codigo', $persona);
		        	$stmt->execute();
		        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
		        	$Persona=$stmt->fetch(PDO::FETCH_ASSOC);
		        	
			        if ($Persona['idPersona']!=NULL) {
			        	$Persona_id=$Persona['idPersona'];

						$stmt = $this->bd->prepare("select * from operador where nombre=:nombre;");
						$stmt->bindParam(':nombre', $operador);
			        	$stmt->execute();
			        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
			        	$Operador=$stmt->fetch(PDO::FETCH_ASSOC);
			        	if ($Operador['idOperador']!=NULL) {
			        		$Operador_id=$Operador['idOperador'];

			        		$stmt = $this->bd->prepare("SELECT idDeudor,tipo_doc,documento,deudor.activo,hora_contacto,deudor.eliminado,deudor.call_mejor_ges_id,resultado.ranking FROM deudor 
left JOIN gestion on gestion.idGestion=deudor.call_mejor_ges_id
left JOIN resultado ON resultado.idResultado=gestion.resultado_id   WHERE documento=:documento;");
							$stmt->bindParam(':documento', $documento);
				        	$stmt->execute();
				        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
				        	$Deudor=$stmt->fetch(PDO::FETCH_ASSOC);
				        	if ($Deudor['idDeudor']!=NULL) {
				        		$Deudor_id=$Deudor['idDeudor'];
				        		$stmt = $this->bd->prepare("SELECT HOUR(hora_inicio) as hora,count(gestion.idGestion) as nro_gestiones FROM gestion
inner join resultado ON resultado.idResultado=gestion.resultado_id
inner join contactabilidad ON contactabilidad.idContactabilidad=resultado.contactabilidad_id
where gestion.tipogestion_id=1 and gestion.Deudor_id=:Deudor_id  and idContactabilidad=2 and  gestion.fecha_gestion > (curdate()-interval 12 month) group by  HOUR(hora_inicio) order by nro_gestiones desc LIMIT 1;");
								$stmt->bindParam(':Deudor_id', $Deudor_id);
				        		$stmt->execute();
				        		$q_hora_cto=$stmt->fetch(PDO::FETCH_ASSOC);
				        		if($q_hora_cto['hora']==NULL){
				        			$hora_contacto=-1;
				        		}else{
				        			$hora_contacto=$q_hora_cto['hora'];
				        		}	


				        		$stmt = $this->bd->prepare("select * from tipogestion where descripcion=:descripcion;");
								$stmt->bindParam(':descripcion', $tipo_gestion);
					        	$stmt->execute();
					        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
					        	$TipoGestion=$stmt->fetch(PDO::FETCH_ASSOC);
					        	if ($TipoGestion['idTipoGestion']!=NULL) {
					        		 $TipoGestion_id=$TipoGestion['idTipoGestion'];

					        		$stmt = $this->bd->prepare("SELECT idTelefono,telefono.Deudor_id,numero,tipo,Origen_id,observacion,telefono.activo,telefono.eliminado,mejor_ges_id,resultado.ranking FROM telefono 
left join gestion on gestion.idGestion=telefono.mejor_ges_id
left join resultado on resultado.idResultado=gestion.Resultado_id where telefono.Deudor_id=:Deudor_id and numero=:numero ;");

									$stmt->bindParam(':Deudor_id', $Deudor_id);
									$stmt->bindParam(':numero', $telefono);
						        	$stmt->execute();
						        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
						        	$Telefono=$stmt->fetch(PDO::FETCH_ASSOC);
									if ($Telefono['idTelefono']!=NULL) {
										$Telefono_id=$Telefono['idTelefono'];

										$stmt = $this->bd->prepare("select * from resultado where codigo=:codigo ;");
										$stmt->bindParam(':codigo', $codigo_resultado);
							        	$stmt->execute();
							        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
							        	$Resultado=$stmt->fetch(PDO::FETCH_ASSOC);
										if ($Resultado['idResultado']!=NULL) {
											$Resultado_id=$Resultado['idResultado'];
											if (isset($array_tipo_cto[$contacto])) {$Contacto_id=$array_tipo_cto[$contacto];}else{$Contacto_id=0;}
											if (isset($array_motivo[$motivo])) {$Motivo_id=$array_motivo[$motivo];}else{$Motivo_id=0;}

											
											$fecha_gestion=$fecha_gestion;
											$hora_inicio=$hora_inicio;
											$hora_fin=$hora_fin;
											$observaciones=$observaciones;

											$stmt = $this->bd->prepare("INSERT INTO gestion (Campana_id,Gestor_id,Operador_id,Deudor_id,TipoGestion_id,Telefono_id,fecha_gestion,hora_inicio,hora_fin,Resultado_id,Contacto_id,Motivo_id,observaciones,ingresado_por) VALUES(:Campana_id,:Gestor_id,:Operador_id,:Deudor_id,:TipoGestion_id,:Telefono_id,:fecha_gestion,:hora_inicio,:hora_fin,:Resultado_id,:Contacto_id,:Motivo_id,:observaciones,:ingresado_por)");

											$stmt->bindValue(':Campana_id',$Campana_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Gestor_id',$Persona_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Operador_id',$Operador_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Deudor_id',$Deudor_id,PDO::PARAM_INT);
									        $stmt->bindValue(':TipoGestion_id',$TipoGestion_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Telefono_id',$Telefono_id,PDO::PARAM_INT);
									        $stmt->bindValue(':fecha_gestion',$fecha_gestion,PDO::PARAM_STR);
									        $stmt->bindValue(':hora_inicio',$hora_inicio,PDO::PARAM_STR);
									        $stmt->bindValue(':hora_fin',$hora_fin,PDO::PARAM_INT);
									        $stmt->bindValue(':Resultado_id',$Resultado_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Contacto_id',$Contacto_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Motivo_id',$Motivo_id,PDO::PARAM_INT);
									        $stmt->bindValue(':observaciones',$observaciones,PDO::PARAM_STR);
									        $stmt->bindValue(':ingresado_por',$ingresado_por,PDO::PARAM_INT);							           	
								           	if (!$stmt->execute()) {print_r($stmt->errorInfo());}else{
								           		$Gestion_id=$this->bd->lastInsertId();
								           	}
								            $registrado=$stmt->rowCount();
											/*compromisos*/
											if ($registrado==1) {
												$rkng_Resultado=$Resultado['ranking'];
												$rkng_Deudor=$Deudor['ranking'];
												$rkng_Telefono=$Telefono['ranking'];
												$mejor_ges_id_deudor=$Gestion_id;
												$mejor_ges_id_tel=$Gestion_id;

												if($Deudor['ranking']==NULL){
									        		$mejor_ges_id_deudor=$Gestion_id;
									        	}elseif ($rkng_Resultado<=$rkng_Deudor) {
													$mejor_ges_id_deudor=$Gestion_id;
												}else{
													$mejor_ges_id_deudor=$Deudor['call_mejor_ges_id'];
												}
												$stmt = $this->bd->prepare("UPDATE deudor SET  call_mejor_ges_id=:call_mejor_ges_id,call_ultimo_ges_id=:call_ultimo_ges_id,hora_contacto=:hora_contacto WHERE idDeudor=:idDeudor");
										        $stmt->bindParam(':idDeudor',$Deudor_id);
										        $stmt->bindParam(':call_mejor_ges_id',$mejor_ges_id_deudor);
										        $stmt->bindParam(':call_ultimo_ges_id',$Gestion_id);
										        $stmt->bindParam(':hora_contacto',$hora_contacto);
										        $stmt->execute();
										        if($Telefono['ranking']==NULL){
									        		$mejor_ges_id_tel=$Gestion_id;
									        	}elseif ($rkng_Resultado<=$rkng_Telefono) {
													$mejor_ges_id_tel=$Gestion_id;
												}else{
													$mejor_ges_id_tel=$Telefono['mejor_ges_id'];
												}
												$stmt = $this->bd->prepare("UPDATE telefono SET  mejor_ges_id=:mejor_ges_id,ultimo_ges_id=:ultimo_ges_id WHERE idTelefono=:idTelefono");
										        $stmt->bindParam(':idTelefono',$Telefono_id);
										        $stmt->bindParam(':mejor_ges_id',$mejor_ges_id_tel);
										        $stmt->bindParam(':ultimo_ges_id',$Gestion_id);
										        $stmt->execute();

										        $stmt = $this->bd->prepare("SELECT mejor_ges_call_cmp,resultado.ranking FROM obligacion
												LEFT JOIN gestion on gestion.idGestion=obligacion.mejor_ges_call_cmp
												LEFT JOIN resultado on resultado.idResultado=gestion.Resultado_id
												 WHERE obligacion.Campana_id=:Campana_id AND obligacion.Deudor_id=:Deudor_id ORDER BY ranking LIMIT 1;");
												$stmt->bindParam(':Campana_id', $Campana_id);
												$stmt->bindParam(':Deudor_id', $Deudor_id);
									        	$stmt->execute();
									        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}								        	                   
									        	$Obligacion=$stmt->fetch(PDO::FETCH_ASSOC);
									        	$rkng_Obligacion=$Obligacion['ranking'];
									        	$mejor_ges_id_obligacion=$Gestion_id;

									        	if($Obligacion['ranking']==NULL){
									        		$mejor_ges_id_obligacion=$Gestion_id;
									        	}
									        	elseif ($rkng_Resultado<=$rkng_Obligacion) {
													$mejor_ges_id_obligacion=$Gestion_id;
												}else{
													$mejor_ges_id_obligacion=$Obligacion['mejor_ges_call_cmp'];
												}

												$stmt = $this->bd->prepare("UPDATE obligacion SET  mejor_ges_call_cmp=:mejor_ges_call_cmp,ultimo_ges_call_cmp=:ultimo_ges_call_cmp,mejor_ges_call_bd=:mejor_ges_call_bd,ultimo_ges_call_bd=:ultimo_ges_call_bd,t_gest_call=t_gest_call+1 WHERE Campana_id=:Campana_id AND Deudor_id=:Deudor_id");
										        $stmt->bindParam(':Campana_id',$Campana_id);
										        $stmt->bindParam(':Deudor_id',$Deudor_id);
										        $stmt->bindParam(':mejor_ges_call_cmp',$mejor_ges_id_obligacion);
										        $stmt->bindParam(':ultimo_ges_call_cmp',$Gestion_id);
										        $stmt->bindParam(':mejor_ges_call_bd',$mejor_ges_id_deudor);
										        $stmt->bindParam(':ultimo_ges_call_bd',$Gestion_id);
										        $stmt->execute();

											}
											if ($Resultado['mostrar_formulario']==2) {

												$nrooperacion=$nrooperacion;
												$fecha_comp=$fecha_comp;
												$monto_comp=$monto_comp;
												$moneda_comp=$moneda_comp;

												$stmt = $this->bd->prepare("SELECT idObligacion,nrooperacion FROM obligacion where Campana_id=:Campana_id and nrooperacion=:nrooperacion;");
												$stmt->bindParam(':Campana_id', $Campana_id);
												$stmt->bindParam(':nrooperacion', $nrooperacion);
									        	$stmt->execute();
									        	$Obligacion=$stmt->fetch(PDO::FETCH_ASSOC);

												if ($Obligacion['idObligacion']!=NULL) {
													$Obligacion_id=$Obligacion['idObligacion'];
													$stmt = $this->bd->prepare("INSERT INTO compromiso (Gestion_id,Campana_id,Gestor_id,Operador_id,Deudor_id,Obligacion_id,fecha_compromiso,hora,moneda,monto,ingresado_por) VALUES(:Gestion_id,:Campana_id,:Gestor_id,:Operador_id,:Deudor_id,:Obligacion_id,:fecha_compromiso,:hora,:moneda,:monto,:ingresado_por)");
													$stmt->bindValue(':Gestion_id',$Gestion_id,PDO::PARAM_INT);
										            $stmt->bindValue(':Campana_id',$Campana_id,PDO::PARAM_INT);
										            $stmt->bindValue(':Gestor_id',$Persona_id,PDO::PARAM_INT);
										            $stmt->bindValue(':Operador_id',$Operador_id,PDO::PARAM_INT);
										            $stmt->bindValue(':Deudor_id',$Deudor_id,PDO::PARAM_INT);
										            $stmt->bindValue(':Obligacion_id',$Obligacion_id,PDO::PARAM_INT);
										            $stmt->bindValue(':fecha_compromiso',$fecha_comp,PDO::PARAM_STR);
										            $stmt->bindValue(':hora','18:02:37',PDO::PARAM_STR);
										            $stmt->bindValue(':moneda',$moneda_comp,PDO::PARAM_STR);
										            $stmt->bindValue(':monto',$monto_comp,PDO::PARAM_STR);
										            $stmt->bindValue(':ingresado_por',$ingresado_por,PDO::PARAM_INT);
										            if (!$stmt->execute()) {print_r($stmt->errorInfo());}
												}
											}
											if ($Resultado['desactivar_informacion']==1) {
												$stmt = $this->bd->prepare("UPDATE telefono SET  activo=0 WHERE idTelefono=:idTelefono");
										        $stmt->bindParam(':idTelefono',$Telefono_id);
										        $stmt->execute();
											}

										}else{
						        			$error_resultado=" No Existe Codigo de Resultado";
						        		}									
									}else{
					        			$error_telefono=" No Existe telefono";
					        		}								
					        	}else{
				        			$error_tipogestion=" No Existe Tipo de Gestion";
				        		}			        		
				        	}else{
			        			$error_deudor=" No Existe Deudor";
			        		}						
			        	}else{
		        			$error_operador=" No Existe Operador";
		        		} 
		        	}else{
	        		$error_persona=" No Existe Gestor";
	        		} 
	        	}else{
	        		$error_campana=" No Existe Campana";
	        	} 

	        	$FileGestiones[$fila]['registrado']=$registrado;
			    $FileGestiones[$fila]['motivo']=$error_resultado.$error_telefono.$error_tipogestion.$error_deudor.$error_persona.$error_operador.$error_campana;
			    $FileGestiones[$fila]['hora']=date("H:i:s",time());	     
	        }
	        $fila++;
	    }
    fclose ( $fp ); 
    $this->Resultado_Importar($FileGestiones,"GESTIONES");
    //header('Location: index.php?c=Telefono');
    }

    //*--FUNCION PARA IMPORTAR CORREOS--*//
    public function Solicitar_visitas(){
    	// conectamos a la base de datos
    	$this->bd = new Conexion();
    	$Campana_id=$_REQUEST['idCampana'];
    	$solicitado_por=$_SESSION['Usuario_Actual'];	    
	    ini_set('max_execution_time', 10000);
	    $tempFile = $_FILES['DataSolVisitCamp']['tmp_name'];
	    $nombre = $_FILES['DataSolVisitCamp']['name'];
	    $filename = $nombre;
	    $ruta = getcwd() ."/uploads/csv/".$filename;
	    move_uploaded_file($tempFile, $ruta);
	    $fp = fopen ( $ruta , "r" );
	    $fila=0;
	    $FileSolicitudVisitas = array();
	    while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
	    	 //declaramos las variables
	      
	        
	        if($fila>0){

				$id=$data[0];
				$documento=$data[1];
				$direccion_id=$data[2];
				$idhojaruta=$data[3];
				$codigo_gestor=$data[4];
				if ($data[5]!=''){$fecha_entrega=date('Y-m-d',strtotime($data[5]));}else{$fecha_entrega_gestor=NULL;}
				if ($data[6]!=''){$fecha_limite=date('Y-m-d',strtotime($data[6]));}else{$fecha_ult_dia_visita=NULL;}

				$idVisita="";
				$registrado=0;
				
				$error_id="";
				$error_documento="";
				$error_direccion_id="";
				$error_idhojaruta="";
				$error_codigo_gestor="";
				$error_fecha_entrega="";
				$error_fecha_limite="";

				$FileSolicitudVisitas[$fila]['id']=$id;
				$FileSolicitudVisitas[$fila]['documento']=$documento;
				$FileSolicitudVisitas[$fila]['direccion_id']=$direccion_id;
				$FileSolicitudVisitas[$fila]['idhojaruta']=$idhojaruta;
				$FileSolicitudVisitas[$fila]['codigo_gestor']=$codigo_gestor;
				$FileSolicitudVisitas[$fila]['fecha_entrega']=$fecha_entrega;
				$FileSolicitudVisitas[$fila]['fecha_limite']=$fecha_limite;
				/*Consultar USUARIO*/
	        		$stmt = $this->bd->prepare("select * from persona where codigo=:codigo;");
					$stmt->bindParam(':codigo', $codigo_gestor);
		        	$stmt->execute();
		        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
		        	$Persona=$stmt->fetch(PDO::FETCH_ASSOC);
		        	
			        if ($Persona['idPersona']!=NULL)
			        {
			        		$Persona_id=$Persona['idPersona'];

			        		$stmt = $this->bd->prepare("SELECT idDeudor,tipo_doc,documento,deudor.activo,hora_contacto,deudor.eliminado FROM deudor WHERE documento=:documento;");
							$stmt->bindParam(':documento', $documento);
				        	$stmt->execute();
				        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
				        	$Deudor=$stmt->fetch(PDO::FETCH_ASSOC);
				        	if ($Deudor['idDeudor']!=NULL)
				        	{
				        		$Deudor_id=$Deudor['idDeudor'];
				        		$stmt = $this->bd->prepare("SELECT * FROM direccion where idDireccion=:idDireccion and Deudor_id=:Deudor_id;");
				        		$stmt->bindParam(':idDireccion',$direccion_id);
							    $stmt->bindParam(':Deudor_id',$Deudor_id);
					 			

						        $stmt->execute();
						        if (!$stmt->execute()) {print_r($stmt->errorInfo());}                   
						        $Direccion=$stmt->fetch(PDO::FETCH_ASSOC);

								if($Direccion['idDireccion']!=NULL)
								{
									$Direccion_id=$Direccion['idDireccion'];
									$stmt = $this->bd->prepare("INSERT INTO visita (Campana_id,Deudor_id,Direccion_id,idHojaRuta,Entregado_a,fecha_entrega,fecha_limite,solicitado_por) VALUES(:Campana_id,:Deudor_id,:Direccion_id,:idHojaRuta,:Entregado_a,:fecha_entrega,:fecha_limite,:solicitado_por)");
									$stmt->bindParam(':Campana_id',$Campana_id);
									$stmt->bindParam(':Deudor_id',$Deudor_id);
									$stmt->bindParam(':Direccion_id',$Direccion_id);
									$stmt->bindParam(':idHojaRuta',$idhojaruta);
									$stmt->bindParam(':Entregado_a',$Persona_id);
									$stmt->bindParam(':fecha_entrega',$fecha_entrega);
									$stmt->bindParam(':fecha_limite',$fecha_limite);
									$stmt->bindParam(':solicitado_por',$solicitado_por);
						           	if (!$stmt->execute()) {print_r($stmt->errorInfo());}else{
						           		$idVisita=$this->bd->lastInsertId();
						           	}
						            $registrado=$stmt->rowCount();
						 				
						 		}else{
						 			$error_direccion_id=" No Existe Direccion";
						 		}
				        	}else{
				        		$error_documento=" No Existe Deudor";
				        	}

			        }else{
			        	$error_codigo_gestor=" No Existe Codigo de Gestor";
			        }

			    $FileSolicitudVisitas[$fila]['idVisita']=$idVisita;
			    $FileSolicitudVisitas[$fila]['registrado']=$registrado;
			    $FileSolicitudVisitas[$fila]['motivo']=$error_id.$error_documento.$error_direccion_id.$idhojaruta.$error_codigo_gestor.$error_fecha_entrega.$error_fecha_limite;
			    $FileSolicitudVisitas[$fila]['hora']=date("H:i:s",time());

	        }
	        $fila++;
	    }
    fclose ( $fp ); 
    

    $this->Resultado_Importar($FileSolicitudVisitas,"SOLICITUD_VISITAS");
  
    }

    //*--FUNCION PARA REGISTRAR VISITAS--*//
    public function Registrar_visitas(){
    	// conectamos a la base de datos
    	$this->bd = new Conexion();
    	$Campana_id=$_REQUEST['idCampana'];
    	$ingresado_por=$_SESSION['Usuario_Actual'];	    
	    ini_set('max_execution_time', 10000);
	    $tempFile = $_FILES['DataRegistrarVisitasCamp']['tmp_name'];
	    $nombre = $_FILES['DataRegistrarVisitasCamp']['name'];
	    $filename = $nombre;
	    $ruta = getcwd() ."/uploads/csv/".$filename;
	    move_uploaded_file($tempFile, $ruta);
	    $fp = fopen ( $ruta , "r" );
	    $fila=0;
	    $FileRegistrarVisitas = array();

	    $TiposGestion = $this->Consultas("select * from tipogestion where  activo=1 and eliminado=0;");
	    $array_origen = array();
        foreach ($TiposGestion as $TipoGestion) {
        	 $arrayTipoGestion[$TipoGestion['descripcion']]=$TipoGestion['idTipoGestion'];
        }

	    while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
	    	 //declaramos las variables
	      
	        
	        if($fila>0){

				$id=$data[0];
				$cod_visita=$data[1];
				$codigo_gestor=$data[2];
				$documento=$data[3];
				$tipo_gestion=$data[4];
				if ($data[5]!=''){$fecha_gestion=date('Y-m-d',strtotime($data[5]));}else{$fecha_gestion=NULL;}
				$hora_gestion=$data[6];
				$codigo_resultado=$data[7];
				$motivo=$data[8];
				$contacto=$data[9];
				$nrooperacion=$data[10];
				if ($data[11]!=''){$fecha_comp=date('Y-m-d',strtotime($data[11]));}else{$fecha_comp=NULL;}
				$monto_comp=$data[12];
				$moneda_comp=$data[13];
				$descripcion=utf8_encode($data[14]);
				$observacion=utf8_encode($data[15]);



				$idVisita="";
				$registrado=0;
				
				$error_id="";
				$error_cod_visita="";
				$error_codigo_gestor="";
				$error_documento="";
				$error_tipo_gestion="";
				$error_fecha_gestion="";
				$error_hora_gestion="";
				$error_codigo_resultado="";
				$error_motivo="";
				$error_contacto="";
				$error_nrooperacion="";
				$error_fecha_comp="";
				$error_monto_comp="";
				$error_moneda_comp="";
				$error_descripcion="";
				$error_observacion="";

				$FileRegistrarVisitas[$fila]['id']=$id;
				$FileRegistrarVisitas[$fila]['cod_visita']=$cod_visita;
				$FileRegistrarVisitas[$fila]['codigo_gestor']=$codigo_gestor;
				$FileRegistrarVisitas[$fila]['documento']=$documento;
				$FileRegistrarVisitas[$fila]['tipo_gestion']=$tipo_gestion;
				$FileRegistrarVisitas[$fila]['fecha_gestion']=$fecha_gestion;
				$FileRegistrarVisitas[$fila]['hora_gestion']=$hora_gestion;
				$FileRegistrarVisitas[$fila]['codigo_resultado']=$codigo_resultado;
				$FileRegistrarVisitas[$fila]['motivo']=$motivo;
				$FileRegistrarVisitas[$fila]['contacto']=$contacto;
				$FileRegistrarVisitas[$fila]['nrooperacion']=$nrooperacion;
				$FileRegistrarVisitas[$fila]['fecha_comp']=$fecha_comp;
				$FileRegistrarVisitas[$fila]['monto_comp']=$monto_comp;
				$FileRegistrarVisitas[$fila]['moneda_comp']=$moneda_comp;
				$FileRegistrarVisitas[$fila]['descripcion']=$descripcion;
				$FileRegistrarVisitas[$fila]['observacion']=$observacion;

				$stmt = $this->bd->prepare("SELECT idVisita,visita.Campana_id,visita.Deudor_id,visita.Direccion_id,Entregado_a,direccion.mejor_ges_id_campo ,res_dir.ranking as ranking_direccion,deudor.campo_mejor_ges_id as campo_mejor_ges_deudor,res_deudor.ranking as ranking_deudor from visita
INNER JOIN deudor on deudor.idDeudor=visita.Deudor_id 
INNER JOIN direccion on direccion.idDireccion=visita.Direccion_id
left JOIN gestion as gest_deudor on gest_deudor.idGestion=deudor.campo_mejor_ges_id
left JOIN resultado as res_deudor ON res_deudor.idResultado=gest_deudor.Resultado_id
left join gestion as gest_dir on gest_dir.idGestion=direccion.mejor_ges_id_campo
left join resultado as res_dir on res_dir.idResultado=gest_dir.Resultado_id
  where idVisita=:idVisita;");
				$stmt->bindParam(':idVisita', $cod_visita);
	        	$stmt->execute();
	        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
	        	$Visita=$stmt->fetch(PDO::FETCH_ASSOC);
	        	
		        if ($Visita['idVisita']!=NULL)
		        {
		        	$idVisita=$Visita['idVisita'];
		        	$Campana_id=$Visita['Campana_id'];
		        	$Deudor_id=$Visita['Deudor_id'];
		        	$Direccion_id=$Visita['Direccion_id'];
		        	$stmt = $this->bd->prepare("select * from persona where codigo=:codigo;");
					$stmt->bindParam(':codigo', $codigo_gestor);
		        	$stmt->execute();
		        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
		        	$Persona=$stmt->fetch(PDO::FETCH_ASSOC);
		        	
			        if ($Persona['idPersona']!=NULL) {
			        	$Persona_id=$Persona['idPersona'];
			        	if (isset($arrayTipoGestion[$tipo_gestion]))
			        	{
				            $TipoGestion_id=$arrayTipoGestion[$tipo_gestion];

				            $stmt = $this->bd->prepare("select * from resultado where codigo=:codigo ;");
							$stmt->bindParam(':codigo', $codigo_resultado);
				        	$stmt->execute();
				        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
				        	$Resultado=$stmt->fetch(PDO::FETCH_ASSOC);
							if ($Resultado['idResultado']!=NULL) {
								$Resultado_id=$Resultado['idResultado'];
								$stmt = $this->bd->prepare("select * from contacto where descripcion=:descripcion;");
								$stmt->bindParam(':descripcion', $contacto);
					        	$stmt->execute();
					        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
					        	$Contacto=$stmt->fetch(PDO::FETCH_ASSOC);
								if ($Contacto['idContacto']!=NULL) {
									$Contacto_id=$Contacto['idContacto'];

									$stmt = $this->bd->prepare("INSERT INTO gestion (Campana_id,Gestor_id,Deudor_id,TipoGestion_id,Direccion_id,fecha_gestion,hora_inicio,hora_fin,Resultado_id,Contacto_id,Motivo_id,observaciones,ingresado_por) VALUES(:Campana_id,:Gestor_id,:Deudor_id,:TipoGestion_id,:Direccion_id,:fecha_gestion,:hora_inicio,:hora_fin,:Resultado_id,:Contacto_id,:Motivo_id,:observaciones,:ingresado_por)");
											$Motivo_id=0;
											$stmt->bindValue(':Campana_id',$Campana_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Gestor_id',$Persona_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Deudor_id',$Deudor_id,PDO::PARAM_INT);
									        $stmt->bindValue(':TipoGestion_id',$TipoGestion_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Direccion_id',$Direccion_id,PDO::PARAM_INT);
									        $stmt->bindValue(':fecha_gestion',$fecha_gestion,PDO::PARAM_STR);
									        $stmt->bindValue(':hora_inicio',$hora_gestion,PDO::PARAM_STR);
									        $stmt->bindValue(':hora_fin',$hora_gestion,PDO::PARAM_INT);
									        $stmt->bindValue(':Resultado_id',$Resultado_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Contacto_id',$Contacto_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Motivo_id',$Motivo_id,PDO::PARAM_INT);
									        $stmt->bindValue(':observaciones',$observacion,PDO::PARAM_STR);
									        $stmt->bindValue(':ingresado_por',$ingresado_por,PDO::PARAM_INT);							           	
								           	if (!$stmt->execute()) {print_r($stmt->errorInfo());}else{
								           		$Gestion_id=$this->bd->lastInsertId();
								           	}
								            $registrado=$stmt->rowCount();
								            if ($registrado==1) {
								            	$rkng_Resultado=$Resultado['ranking'];
												$rkng_Direccion=$Visita['ranking_direccion'];
												$rkng_Deudor=$Visita['ranking_deudor'];



								            	$stmt = $this->bd->prepare("UPDATE visita SET Gestion_id=:Gestion_id,fecha_visita=:fecha_visita,hora_visita=:hora_visita,visitado_por=:visitado_por,descripcion_predio=:descripcion_predio,observacion=:observacion,estado=1,modificado_por=:modificado_por WHERE idVisita=:idVisita");
								            	$stmt->bindParam(':idVisita',$cod_visita);
								            	$stmt->bindParam(':Gestion_id',$Gestion_id);
								            	$stmt->bindParam(':fecha_visita',$fecha_gestion);
								            	$stmt->bindParam(':hora_visita',$hora_gestion);
								            	$stmt->bindParam(':visitado_por',$Persona_id);
								            	$stmt->bindParam(':descripcion_predio',$descripcion);
								            	$stmt->bindParam(':observacion',$observacion);
								            	$stmt->bindParam(':modificado_por',$ingresado_por);										      
										        $stmt->execute();


												$campo_mejor_ges_id_Deudor=$Gestion_id;
												$campo_mejor_ges_id_dir=$Gestion_id;

												if($Visita['ranking_deudor']==NULL){
									        		$campo_mejor_ges_id_Deudor=$Gestion_id;
									        	}elseif ($rkng_Resultado<=$rkng_Deudor) {
													$campo_mejor_ges_id_Deudor=$Gestion_id;
												}else{
													$campo_mejor_ges_id_Deudor=$Visita['campo_mejor_ges_deudor'];
												}

										        
										        if($Visita['ranking_direccion']==NULL){
									        		$campo_mejor_ges_id_dir=$Gestion_id;
									        	}elseif ($rkng_Resultado<=$rkng_Direccion) {
													$campo_mejor_ges_id_dir=$Gestion_id;
												}else{
													$campo_mejor_ges_id_dir=$Visita['mejor_ges_id_campo'];
												}

												

												if ($Resultado['desactivar_informacion']==1) {
													$desactivar_direc=1;
												}else{
													$desactivar_direc=0;
												}

												$stmt = $this->bd->prepare("SELECT mejor_ges_campo_cmp,resultado.ranking FROM obligacion 
												left join gestion on gestion.idGestion=obligacion.mejor_ges_campo_cmp
												left join resultado on resultado.idResultado=gestion.Resultado_id 
												WHERE obligacion.Campana_id=:Campana_id AND obligacion.Deudor_id=:Deudor_id ORDER BY ranking LIMIT 1;");
												$stmt->bindParam(':Campana_id', $Campana_id);
												$stmt->bindParam(':Deudor_id', $Deudor_id);
									        	$stmt->execute();

									        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}	

										        	$Obligacion=$stmt->fetch(PDO::FETCH_ASSOC);
										        	$rkng_Obligacion=$Obligacion['ranking'];
										        	$campo_mejor_ges_id_obligacion=$Gestion_id;
										        	if($Obligacion['ranking']==NULL){
									        			$campo_mejor_ges_id_obligacion=$Gestion_id;
									        		}elseif ($rkng_Resultado<=$rkng_Obligacion) {
														$campo_mejor_ges_id_obligacion=$Gestion_id;
													}else{
														$campo_mejor_ges_id_obligacion=$Obligacion['mejor_ges_campo_cmp'];
													}
											
													$stmt = $this->bd->prepare("UPDATE obligacion SET  mejor_ges_campo_cmp=:mejor_ges_campo_cmp,ultimo_ges_campo_cmp=:ultimo_ges_campo_cmp,mejor_ges_campo_bd=:mejor_ges_campo_bd,ultimo_ges_campo_bd=:ultimo_ges_campo_bd, t_gest_campo=t_gest_campo+1 WHERE Campana_id=:Campana_id AND Deudor_id=:Deudor_id");
											        $stmt->bindParam(':Campana_id',$Campana_id);
											        $stmt->bindParam(':Deudor_id',$Deudor_id);
											        $stmt->bindParam(':mejor_ges_campo_cmp',$campo_mejor_ges_id_obligacion);
											        $stmt->bindParam(':ultimo_ges_campo_cmp',$Gestion_id);
											        $stmt->bindParam(':mejor_ges_campo_bd',$campo_mejor_ges_id_Deudor);
											        $stmt->bindParam(':ultimo_ges_campo_bd',$Gestion_id);
											        $stmt->execute();

													
													$stmt = $this->bd->prepare("UPDATE direccion SET  mejor_ges_id_campo=:mejor_ges_id_campo,ultimo_ges_id_campo=:ultimo_ges_id_campo,activo=:activo WHERE idDireccion=:idDireccion");
											        $stmt->bindParam(':idDireccion',$Direccion_id);
											        $stmt->bindParam(':mejor_ges_id_campo',$campo_mejor_ges_id_dir);
											        $stmt->bindParam(':ultimo_ges_id_campo',$Gestion_id);
											        $stmt->bindParam(':activo',$desactivar_direc);
											        $stmt->execute();

											        $stmt = $this->bd->prepare("UPDATE deudor SET  campo_mejor_ges_id=:campo_mejor_ges_id,campo_ultimo_ges_id=:campo_ultimo_ges_id WHERE idDeudor=:idDeudor");
											        $stmt->bindParam(':idDeudor',$Deudor_id);
											        $stmt->bindParam(':campo_mejor_ges_id',$campo_mejor_ges_id_Deudor);
											        $stmt->bindParam(':campo_ultimo_ges_id',$Gestion_id);;
											        $stmt->execute();

											        if ($Resultado['mostrar_formulario']==2) {

														$nrooperacion=$nrooperacion;
														$fecha_comp=$fecha_comp;
														$monto_comp=$monto_comp;
														$moneda_comp=$moneda_comp;

														$stmt = $this->bd->prepare("SELECT idObligacion,nrooperacion,Operador_id FROM obligacion where Campana_id=:Campana_id and nrooperacion=:nrooperacion;");
														$stmt->bindParam(':Campana_id', $Campana_id);
														$stmt->bindParam(':nrooperacion', $nrooperacion);
											        	$stmt->execute();
											        	$Obligacion=$stmt->fetch(PDO::FETCH_ASSOC);

														if ($Obligacion['idObligacion']!=NULL) {
															$Obligacion_id=$Obligacion['idObligacion'];
															$stmt = $this->bd->prepare("INSERT INTO compromiso (Gestion_id,Campana_id,Gestor_id,Operador_id,Deudor_id,Obligacion_id,fecha_compromiso,hora,moneda,monto,ingresado_por) VALUES(:Gestion_id,:Campana_id,:Gestor_id,:Operador_id,:Deudor_id,:Obligacion_id,:fecha_compromiso,:hora,:moneda,:monto,:ingresado_por)");
															$stmt->bindValue(':Gestion_id',$Gestion_id,PDO::PARAM_INT);
												            $stmt->bindValue(':Campana_id',$Campana_id,PDO::PARAM_INT);
												            $stmt->bindValue(':Gestor_id',$Persona_id,PDO::PARAM_INT);
												            $stmt->bindValue(':Operador_id',$Obligacion['Operador_id'],PDO::PARAM_INT);
												            $stmt->bindValue(':Deudor_id',$Deudor_id,PDO::PARAM_INT);
												            $stmt->bindValue(':Obligacion_id',$Obligacion_id,PDO::PARAM_INT);
												            $stmt->bindValue(':fecha_compromiso',$fecha_comp,PDO::PARAM_STR);
												            $stmt->bindValue(':hora','18:02:37',PDO::PARAM_STR);
												            $stmt->bindValue(':moneda',$moneda_comp,PDO::PARAM_STR);
												            $stmt->bindValue(':monto',$monto_comp,PDO::PARAM_STR);
												            $stmt->bindValue(':ingresado_por',$ingresado_por,PDO::PARAM_INT);
												            if (!$stmt->execute()) {print_r($stmt->errorInfo());}
														}
												}

												if ($Resultado['desactivar_informacion']==1) {
													$stmt = $this->bd->prepare("UPDATE direccion SET  activo=0 WHERE idDireccion=:idDireccion");
											        $stmt->bindParam(':idDireccion',$Direccion_id);
											        $stmt->execute();
												}
								            	
								            }

									
								}else{
									$error_contacto="No existe tipo de contacto";
								}

							}else{
								$error_codigo_resultado="No existe codigo de Resultado";
							}
				        }else{
				           $error_tipo_gestion=" No Existe Tipo de Gestion";
				        }
			        	
			        }else{
			        	$error_codigo_gestor=" No Existe Codigo de Gestor";
			        }
			    }else{
			    	$error_cod_visita=" Codigo de Visita Invalido";
			   	}

			   $FileRegistrarVisitas[$fila]['registrado']=$registrado;
			    $FileRegistrarVisitas[$fila]['motivo']=$error_id.$error_cod_visita.$error_codigo_gestor.$error_tipo_gestion.$error_fecha_gestion.$error_hora_gestion.$error_codigo_resultado.$error_motivo.$error_contacto.$error_nrooperacion.$error_fecha_comp.$error_monto_comp.$error_moneda_comp.$error_descripcion.$error_observacion;
			    $FileRegistrarVisitas[$fila]['hora']=date("H:i:s",time());

	        }
	        $fila++;
	    }
    fclose ( $fp ); 
    

    $this->Resultado_Importar($FileRegistrarVisitas,"REGISTRAR_VISITAS");
  
    }

    //*--FUNCION PARA REGISTRAR VISITAS--*//
    public function Registrar_visitas_courier(){
    	// conectamos a la base de datos
    	$this->bd = new Conexion();
    	$Campana_id=$_REQUEST['idCampana'];
    	$ingresado_por=$_SESSION['Usuario_Actual'];	    
	    ini_set('max_execution_time', 10000);
	    $tempFile = $_FILES['DataRegistrarVisitasCourierCamp']['tmp_name'];
	    $nombre = $_FILES['DataRegistrarVisitasCourierCamp']['name'];
	    $filename = $nombre;
	    $ruta = getcwd() ."/uploads/csv/".$filename;
	    move_uploaded_file($tempFile, $ruta);
	    $fp = fopen ( $ruta , "r" );
	    $fila=0;
	    $FileRegistrarVisitas = array();

	    $TiposGestion = $this->Consultas("select * from tipogestion where  activo=1 and eliminado=0;");
	    $array_origen = array();
        foreach ($TiposGestion as $TipoGestion) {
        	 $arrayTipoGestion[$TipoGestion['descripcion']]=$TipoGestion['idTipoGestion'];
        }

	    while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
	    	 //declaramos las variables
	      
	        
	        if($fila>0){

				$id=$data[0];
				$cod_visita=$data[1];
				$codigo_gestor=$data[2];
				$documento=$data[3];
				$tipo_gestion=$data[4];
				if ($data[5]!=''){$fecha_gestion=date('Y-m-d',strtotime($data[5]));}else{$fecha_gestion=NULL;}
				$hora_gestion=$data[6];
				$codigo_resultado=$data[7];
				$motivo=$data[8];
				$contacto=$data[9];
				$nrooperacion=$data[10];
				if ($data[11]!=''){$fecha_comp=date('Y-m-d',strtotime($data[11]));}else{$fecha_comp=NULL;}
				$monto_comp=$data[12];
				$moneda_comp=$data[13];
				$descripcion=utf8_encode($data[14]);
				$observacion=utf8_encode($data[15]);



				$idVisita="";
				$registrado=0;
				
				$error_id="";
				$error_cod_visita="";
				$error_codigo_gestor="";
				$error_documento="";
				$error_tipo_gestion="";
				$error_fecha_gestion="";
				$error_hora_gestion="";
				$error_codigo_resultado="";
				$error_motivo="";
				$error_contacto="";
				$error_nrooperacion="";
				$error_fecha_comp="";
				$error_monto_comp="";
				$error_moneda_comp="";
				$error_descripcion="";
				$error_observacion="";

				$FileRegistrarVisitas[$fila]['id']=$id;
				$FileRegistrarVisitas[$fila]['cod_visita']=$cod_visita;
				$FileRegistrarVisitas[$fila]['codigo_gestor']=$codigo_gestor;
				$FileRegistrarVisitas[$fila]['documento']=$documento;
				$FileRegistrarVisitas[$fila]['tipo_gestion']=$tipo_gestion;
				$FileRegistrarVisitas[$fila]['fecha_gestion']=$fecha_gestion;
				$FileRegistrarVisitas[$fila]['hora_gestion']=$hora_gestion;
				$FileRegistrarVisitas[$fila]['codigo_resultado']=$codigo_resultado;
				$FileRegistrarVisitas[$fila]['motivo']=$motivo;
				$FileRegistrarVisitas[$fila]['contacto']=$contacto;
				$FileRegistrarVisitas[$fila]['nrooperacion']=$nrooperacion;
				$FileRegistrarVisitas[$fila]['fecha_comp']=$fecha_comp;
				$FileRegistrarVisitas[$fila]['monto_comp']=$monto_comp;
				$FileRegistrarVisitas[$fila]['moneda_comp']=$moneda_comp;
				$FileRegistrarVisitas[$fila]['descripcion']=$descripcion;
				$FileRegistrarVisitas[$fila]['observacion']=$observacion;

				$stmt = $this->bd->prepare("SELECT idVisita,visita.Campana_id,visita.Deudor_id,visita.Direccion_id,Entregado_a,direccion.mejor_ges_id_courier as mejor_resultado_direccion,res_dir.ranking as ranking_direccion,deudor.courier_mejor_ges_id as courier_mejor_ges_deudor,res_deudor.ranking as ranking_deudor from visita
					INNER JOIN deudor on deudor.idDeudor=visita.Deudor_id 
					INNER JOIN direccion on direccion.idDireccion=visita.Direccion_id 
left JOIN gestion as gest_deudor on gest_deudor.idGestion=deudor.courier_mejor_ges_id
left JOIN resultado as res_deudor ON res_deudor.idResultado=gest_deudor.Resultado_id
left join gestion as gest_dir on gest_dir.idGestion=direccion.mejor_ges_id_courier
left join resultado as res_dir on res_dir.idResultado=gest_dir.Resultado_id  where idVisita=:idVisita;");
				$stmt->bindParam(':idVisita', $cod_visita);
	        	$stmt->execute();
	        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
	        	$Visita=$stmt->fetch(PDO::FETCH_ASSOC);
	        	
		        if ($Visita['idVisita']!=NULL)
		        {
		        	$idVisita=$Visita['idVisita'];
		        	$Campana_id=$Visita['Campana_id'];
		        	$Deudor_id=$Visita['Deudor_id'];
		        	$Direccion_id=$Visita['Direccion_id'];
		        	$stmt = $this->bd->prepare("select * from persona where codigo=:codigo;");
					$stmt->bindParam(':codigo', $codigo_gestor);
		        	$stmt->execute();
		        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
		        	$Persona=$stmt->fetch(PDO::FETCH_ASSOC);
		        	
			        if ($Persona['idPersona']!=NULL) {
			        	$Persona_id=$Persona['idPersona'];
			        	if (isset($arrayTipoGestion[$tipo_gestion]))
			        	{
				            $TipoGestion_id=$arrayTipoGestion[$tipo_gestion];

				            $stmt = $this->bd->prepare("select * from resultado where codigo=:codigo ;");
							$stmt->bindParam(':codigo', $codigo_resultado);
				        	$stmt->execute();
				        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
				        	$Resultado=$stmt->fetch(PDO::FETCH_ASSOC);
							if ($Resultado['idResultado']!=NULL) {
								$Resultado_id=$Resultado['idResultado'];
								$stmt = $this->bd->prepare("select * from contacto where descripcion=:descripcion;");
								$stmt->bindParam(':descripcion', $contacto);
					        	$stmt->execute();
					        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
					        	$Contacto=$stmt->fetch(PDO::FETCH_ASSOC);
								if ($Contacto['idContacto']!=NULL) {
									$Contacto_id=$Contacto['idContacto'];

									$stmt = $this->bd->prepare("INSERT INTO gestion (Campana_id,Gestor_id,Deudor_id,TipoGestion_id,Direccion_id,fecha_gestion,hora_inicio,hora_fin,Resultado_id,Contacto_id,Motivo_id,observaciones,ingresado_por) VALUES(:Campana_id,:Gestor_id,:Deudor_id,:TipoGestion_id,:Direccion_id,:fecha_gestion,:hora_inicio,:hora_fin,:Resultado_id,:Contacto_id,:Motivo_id,:observaciones,:ingresado_por)");
											$Motivo_id=0;
											$stmt->bindValue(':Campana_id',$Campana_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Gestor_id',$Persona_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Deudor_id',$Deudor_id,PDO::PARAM_INT);
									        $stmt->bindValue(':TipoGestion_id',$TipoGestion_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Direccion_id',$Direccion_id,PDO::PARAM_INT);
									        $stmt->bindValue(':fecha_gestion',$fecha_gestion,PDO::PARAM_STR);
									        $stmt->bindValue(':hora_inicio',$hora_gestion,PDO::PARAM_STR);
									        $stmt->bindValue(':hora_fin',$hora_gestion,PDO::PARAM_INT);
									        $stmt->bindValue(':Resultado_id',$Resultado_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Contacto_id',$Contacto_id,PDO::PARAM_INT);
									        $stmt->bindValue(':Motivo_id',$Motivo_id,PDO::PARAM_INT);
									        $stmt->bindValue(':observaciones',$observacion,PDO::PARAM_STR);
									        $stmt->bindValue(':ingresado_por',$ingresado_por,PDO::PARAM_INT);							           	
								           	if (!$stmt->execute()) {print_r($stmt->errorInfo());}else{
								           		$Gestion_id=$this->bd->lastInsertId();
								           	}
								            $registrado=$stmt->rowCount();
								            if ($registrado==1) {
								            	$rkng_Resultado=$Resultado['ranking'];
												$rkng_Direccion=$Visita['ranking_direccion'];
												$rkng_Deudor=$Visita['ranking_deudor'];
								            	$stmt = $this->bd->prepare("UPDATE visita SET Gestion_id=:Gestion_id,fecha_visita=:fecha_visita,hora_visita=:hora_visita,visitado_por=:visitado_por,descripcion_predio=:descripcion_predio,observacion=:observacion,estado=1,modificado_por=:modificado_por WHERE idVisita=:idVisita");
								            	$stmt->bindParam(':idVisita',$cod_visita);
								            	$stmt->bindParam(':Gestion_id',$Gestion_id);
								            	$stmt->bindParam(':fecha_visita',$fecha_gestion);
								            	$stmt->bindParam(':hora_visita',$hora_gestion);
								            	$stmt->bindParam(':visitado_por',$Persona_id);
								            	$stmt->bindParam(':descripcion_predio',$descripcion);
								            	$stmt->bindParam(':observacion',$observacion);
								            	$stmt->bindParam(':modificado_por',$ingresado_por);										      
										        $stmt->execute();

										        $courier_mejor_ges_id_Deudor=$Gestion_id;
												$courier_mejor_ges_id_dir=$Gestion_id;

												if($Visita['ranking_deudor']==NULL){
									        		$campo_mejor_ges_id_Deudor=$Gestion_id;
									        	}elseif ($rkng_Resultado<=$rkng_Deudor) {
													$courier_mejor_ges_id_Deudor=$Gestion_id;
												}else{
													$courier_mejor_ges_id_Deudor=$Visita['courier_mejor_ges_deudor'];
												}

												if($Visita['ranking_direccion']==NULL){
									        		$courier_mejor_ges_id_dir=$Gestion_id;
									        	}elseif ($rkng_Resultado<=$rkng_Direccion) {
													$courier_mejor_ges_id_dir=$Gestion_id;
												}else{
													$courier_mejor_ges_id_dir=$Visita['mejor_resultado_direccion'];
												}




												if ($Resultado['desactivar_informacion']==1) {
													$desactivar_direc=1;
												}else{
													$desactivar_direc=0;
												}

												$stmt = $this->bd->prepare("SELECT mejor_ges_courier_cmp,resultado.ranking FROM obligacion 
												left JOIN gestion on gestion.idGestion=obligacion.mejor_ges_courier_cmp
												left JOIN resultado ON resultado.idResultado=gestion.Resultado_id 
												WHERE obligacion.Campana_id=:Campana_id AND obligacion.Deudor_id=:Deudor_id ORDER BY ranking LIMIT 1;");
												$stmt->bindParam(':Campana_id', $Campana_id);
												$stmt->bindParam(':Deudor_id', $Deudor_id);
									        	$stmt->execute();

									        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}	

										        	$Obligacion=$stmt->fetch(PDO::FETCH_ASSOC);
										        	$rkng_Obligacion=$Obligacion['ranking'];

										        	$courier_mejor_ges_id_obligacion=$Gestion_id;
										        	if($Obligacion['ranking']==NULL){
									        			$courier_mejor_ges_id_obligacion=$Gestion_id;
									        		}elseif ($rkng_Resultado<=$rkng_Obligacion) {
														$courier_mejor_ges_id_obligacion=$Gestion_id;
													}else{
														$courier_mejor_ges_id_obligacion=$Obligacion['mejor_ges_courier_cmp'];
													}


													$stmt = $this->bd->prepare("UPDATE obligacion SET  mejor_ges_courier_cmp=:mejor_ges_courier_cmp, t_gest_courier=t_gest_courier+1 WHERE Campana_id=:Campana_id AND Deudor_id=:Deudor_id");
											        $stmt->bindParam(':Campana_id',$Campana_id);
											        $stmt->bindParam(':Deudor_id',$Deudor_id);
											        $stmt->bindParam(':mejor_ges_courier_cmp',$courier_mejor_ges_id_obligacion);
											        $stmt->execute();

													
													$stmt = $this->bd->prepare("UPDATE direccion SET  mejor_ges_id_courier=:mejor_ges_id_courier,ultimo_ges_id_courier=:ultimo_ges_id_courier,activo=:activo WHERE idDireccion=:idDireccion");
											        $stmt->bindParam(':idDireccion',$Direccion_id);
											        $stmt->bindParam(':mejor_ges_id_courier',$courier_mejor_ges_id_obligacion);
											        $stmt->bindParam(':ultimo_ges_id_courier',$Gestion_id);
											        $stmt->bindParam(':activo',$desactivar_direc);
											        $stmt->execute();

											        $stmt = $this->bd->prepare("UPDATE deudor SET  courier_mejor_ges_id=:courier_mejor_ges_id,courier_ultimo_ges_id=:courier_ultimo_ges_id WHERE idDeudor=:idDeudor");
											        $stmt->bindParam(':idDeudor',$Deudor_id);
											        $stmt->bindParam(':courier_mejor_ges_id',$courier_mejor_ges_id_Deudor);
											        $stmt->bindParam(':courier_ultimo_ges_id',$Gestion_id);
											        $stmt->execute();


												if ($Resultado['desactivar_informacion']==1) {
													$stmt = $this->bd->prepare("UPDATE direccion SET  activo=0 WHERE idDireccion=:idDireccion");
											        $stmt->bindParam(':idDireccion',$Direccion_id);
											        $stmt->execute();
												}
								            	
								            }

									
								}else{
									$error_contacto="No existe tipo de contacto";
								}

							}else{
								$error_codigo_resultado="No existe codigo de Resultado";
							}
				        }else{
				           $error_tipo_gestion=" No Existe Tipo de Gestion";
				        }
			        	
			        }else{
			        	$error_codigo_gestor=" No Existe Codigo de Gestor";
			        }
			    }else{
			    	$error_cod_visita=" Codigo de Visita Invalido";
			   	}

			   $FileRegistrarVisitas[$fila]['registrado']=$registrado;
			    $FileRegistrarVisitas[$fila]['motivo']=$error_id.$error_cod_visita.$error_codigo_gestor.$error_tipo_gestion.$error_fecha_gestion.$error_hora_gestion.$error_codigo_resultado.$error_motivo.$error_contacto.$error_nrooperacion.$error_fecha_comp.$error_monto_comp.$error_moneda_comp.$error_descripcion.$error_observacion;
			    $FileRegistrarVisitas[$fila]['hora']=date("H:i:s",time());

	        }
	        $fila++;
	    }
    fclose ( $fp ); 
    

    $this->Resultado_Importar($FileRegistrarVisitas,"REGISTRAR_VISITAS");
  
    }

  //*--FUNCION PARA IMPORTAR GESTIONES SMS--*//
    public function Imp_Gest_SMS(){
    	// conectamos a la base de datos
    	$this->bd = new Conexion();
    	$Campana_id=$_REQUEST['idCampana'];
    	$ingresado_por=$_SESSION['Usuario_Actual'];
    	$Persona_id=$_SESSION['Persona_Actual'];	    
	    ini_set('max_execution_time', 10000);
	    $tempFile = $_FILES['DataGestionesSMS']['tmp_name'];
	    $nombre = $_FILES['DataGestionesSMS']['name'];
	    $filename = $nombre;
	    $ruta = getcwd() ."/uploads/csv/".$filename;
	    move_uploaded_file($tempFile, $ruta);
	    $fp = fopen ( $ruta , "r" );
	    $fila=0;
	    $FileGestiones_sms = array();
	    $Resultados_sms = $this->Consultas("select * from resultado where TipoGestion_id=7 and activo=1 and eliminado=0;");
	    $array_origen = array();
        foreach ($Resultados_sms as $Resultado) {
        	 $arrayResultado_sms[$Resultado['codigo']]['idResultado']=$Resultado['idResultado'];
        	 $arrayResultado_sms[$Resultado['codigo']]['desactivar_informacion']=$Resultado['desactivar_informacion'];
        	 
        }
	    while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
	    	 //declaramos las variables
	      
	        
	        if($fila>0){

				$id=$data[0];
				$documento=$data[1];
				$numero=$data[2];
				if ($data[3]!=''){$fecha_gestion=date('Y-m-d',strtotime($data[3]));}else{$fecha_gestion=NULL;}
				$hora_envio=$data[4];
				$resultado=$data[5];
				$observaciones=utf8_encode(strtoupper($data[6]));
				$registrado=0;
				$error_id="";
				$error_documento="";
				$error_celular="";
				$error_fecha_gestion="";
				$error_hora_envio="";
				$error_resultado="";
				$error_observaciones="";

				$FileGestiones_sms[$fila]['id']=$id;
				$FileGestiones_sms[$fila]['documento']=$documento;
				$FileGestiones_sms[$fila]['numero']=$numero;
				$FileGestiones_sms[$fila]['fecha_gestion']=$fecha_gestion;
				$FileGestiones_sms[$fila]['hora_envio']=$hora_envio;
				$FileGestiones_sms[$fila]['resultado']=$resultado;
				$FileGestiones_sms[$fila]['observaciones']=$observaciones;

				$stmt = $this->bd->prepare("SELECT idDeudor,tipo_doc,documento,deudor.activo,hora_contacto,deudor.eliminado FROM deudor WHERE documento=:documento;");
				$stmt->bindParam(':documento', $documento);
	        	$stmt->execute();
	        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
	        	$Deudor=$stmt->fetch(PDO::FETCH_ASSOC);
	        	if ($Deudor['idDeudor']!=NULL)
	        	{
	        		$Deudor_id=$Deudor['idDeudor'];
	        		$stmt = $this->bd->prepare("SELECT idTelefono,Deudor_id,numero FROM telefono where Deudor_id=:Deudor_id and numero=:numero ;");
					$stmt->bindParam(':Deudor_id', $Deudor_id);
					$stmt->bindParam(':numero', $numero);
		        	$stmt->execute();
		        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
		        	$Telefono=$stmt->fetch(PDO::FETCH_ASSOC);
					if ($Telefono['idTelefono']!=NULL) {
						$Telefono_id=$Telefono['idTelefono'];

						if (isset($arrayResultado_sms[$resultado])) {
				            $Resultado_id=$arrayResultado_sms[$resultado]['idResultado'];
				        }else{
				            $Resultado_id=NULL;
				        }

				        if ($Resultado_id!=NULL)
	        			{
	        				$TipoGestion_id=7;
	        				$stmt = $this->bd->prepare("INSERT INTO gestion (Campana_id,Gestor_id,Deudor_id,TipoGestion_id,Telefono_id,fecha_gestion,hora_inicio,hora_fin,Resultado_id,Contacto_id,observaciones,ingresado_por) VALUES(:Campana_id,:Gestor_id,:Deudor_id,:TipoGestion_id,:Telefono_id,:fecha_gestion,:hora_inicio,:hora_fin,:Resultado_id,:Contacto_id,:observaciones,:ingresado_por)");
							$stmt->bindValue(':Campana_id',$Campana_id,PDO::PARAM_INT);
					        $stmt->bindValue(':Gestor_id',$Persona_id,PDO::PARAM_INT);
					        $stmt->bindValue(':Deudor_id',$Deudor_id,PDO::PARAM_INT);
					        $stmt->bindValue(':TipoGestion_id',$TipoGestion_id,PDO::PARAM_INT);
					        $stmt->bindValue(':Telefono_id',$Telefono_id,PDO::PARAM_INT);
					        $stmt->bindValue(':fecha_gestion',$fecha_gestion,PDO::PARAM_STR);
					        $stmt->bindValue(':hora_inicio',$hora_envio,PDO::PARAM_STR);
					        $stmt->bindValue(':hora_fin',$hora_envio,PDO::PARAM_INT);
					        $stmt->bindValue(':Resultado_id',$Resultado_id,PDO::PARAM_INT);
					        $stmt->bindValue(':Contacto_id',10,PDO::PARAM_INT);
					        $stmt->bindValue(':observaciones',$observaciones,PDO::PARAM_STR);
					        $stmt->bindValue(':ingresado_por',$ingresado_por,PDO::PARAM_INT);
					        if (!$stmt->execute()) {print_r($stmt->errorInfo());}  
					        $registrado=$stmt->rowCount();
					        if ($registrado==1) {
					        	

					        	$stmt = $this->bd->prepare("UPDATE obligacion SET  t_gest_sms=t_gest_sms+1 WHERE Campana_id=:Campana_id AND Deudor_id=:Deudor_id");
						        $stmt->bindParam(':Campana_id',$Campana_id);
						        $stmt->bindParam(':Deudor_id',$Deudor_id);
						        $stmt->execute();

						        $stmt = $this->bd->prepare("UPDATE telefono SET  NroGestSms=NroGestSms+1 WHERE idTelefono=:idTelefono AND Deudor_id=:Deudor_id");
						        $stmt->bindParam(':idTelefono',$Telefono_id);
						        $stmt->bindParam(':Deudor_id',$Deudor_id);
						        $stmt->execute();


						        if ($arrayResultado_sms[$resultado]['desactivar_informacion']==1) {
						            $stmt = $this->bd->prepare("UPDATE telefono SET  activo=0 WHERE idTelefono=:idTelefono");
							        $stmt->bindParam(':idTelefono',$Telefono_id);
							        $stmt->execute();							        
						        }

			


					        }
	        			}else{
	        				$error_resultado="No existe resultado";
	        			}

					}else{
						$error_celular="No existe numero";
					}

	        	}else{
	        		$error_documento="No existe Deudor";
	        	}
				

				
	
	        	$FileGestiones_sms[$fila]['registrado']=$registrado;
			    $FileGestiones_sms[$fila]['motivo_registro']=$error_id.$error_documento.$error_celular.$error_fecha_gestion.$error_hora_envio.$error_resultado;
			    $FileGestiones_sms[$fila]['hora']=date("H:i:s",time());	     
	        }
	        $fila++;
	    }
    fclose ( $fp ); 


    $this->Resultado_Importar($FileGestiones_sms,"GESTIONES_SMS");

    }

    //*--FUNCION PARA IMPORTAR GESTIONES SMS--*//
    public function Imp_Gest_IVR(){
    	// conectamos a la base de datos
    	$this->bd = new Conexion();
    	$Campana_id=$_REQUEST['idCampana'];
    	$ingresado_por=$_SESSION['Usuario_Actual'];
    	$Persona_id=$_SESSION['Persona_Actual'];	    
	    ini_set('max_execution_time', 10000);
	    $tempFile = $_FILES['DataGestionesIVR']['tmp_name'];
	    $nombre = $_FILES['DataGestionesIVR']['name'];
	    $filename = $nombre;
	    $ruta = getcwd() ."/uploads/csv/".$filename;
	    move_uploaded_file($tempFile, $ruta);
	    $fp = fopen ( $ruta , "r" );
	    $fila=0;
	    $FileGestiones_IVR = array();
	    $Resultados_ivr = $this->Consultas("select * from resultado where TipoGestion_id=6 and activo=1 and eliminado=0;");
	    $arrayResultado_ivr = array();
        foreach ($Resultados_ivr as $Resultado) {
        	 $arrayResultado_ivr[$Resultado['codigo']]['idResultado']=$Resultado['idResultado'];
        	 $arrayResultado_ivr[$Resultado['codigo']]['desactivar_informacion']=$Resultado['desactivar_informacion'];
        	 $arrayResultado_ivr[$Resultado['codigo']]['InfoValida']=$Resultado['InfoValida'];
        }
	    while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
	    	 //declaramos las variables
	      
	        
	        if($fila>0){

				$id=$data[0];
				$documento=$data[1];
				$numero=$data[2];
				if ($data[3]!=''){$fecha_gestion=date('Y-m-d',strtotime($data[3]));}else{$fecha_gestion=NULL;}
				$hora_envio=$data[4];
				$resultado=$data[5];
				$observaciones=utf8_encode(strtoupper($data[6]));
				$registrado=0;
				$error_id="";
				$error_documento="";
				$error_celular="";
				$error_fecha_gestion="";
				$error_hora_envio="";
				$error_resultado="";

				$FileGestiones_IVR[$fila]['id']=$id;
				$FileGestiones_IVR[$fila]['documento']=$documento;
				$FileGestiones_IVR[$fila]['numero']=$numero;
				$FileGestiones_IVR[$fila]['fecha_gestion']=$fecha_gestion;
				$FileGestiones_IVR[$fila]['hora_envio']=$hora_envio;
				$FileGestiones_IVR[$fila]['resultado']=$resultado;
				$FileGestiones_IVR[$fila]['observaciones']=$observaciones;
				
				$stmt = $this->bd->prepare("SELECT idDeudor,tipo_doc,documento,deudor.activo,hora_contacto,deudor.eliminado FROM deudor WHERE documento=:documento;");
				$stmt->bindParam(':documento', $documento);
	        	$stmt->execute();
	        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
	        	$Deudor=$stmt->fetch(PDO::FETCH_ASSOC);
	        	if ($Deudor['idDeudor']!=NULL)
	        	{
	        		$Deudor_id=$Deudor['idDeudor'];
	        		$stmt = $this->bd->prepare("SELECT idTelefono,Deudor_id,numero FROM telefono where Deudor_id=:Deudor_id and numero=:numero ;");
					$stmt->bindParam(':Deudor_id', $Deudor_id);
					$stmt->bindParam(':numero', $numero);
		        	$stmt->execute();
		        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
		        	$Telefono=$stmt->fetch(PDO::FETCH_ASSOC);
					if ($Telefono['idTelefono']!=NULL) {
						$Telefono_id=$Telefono['idTelefono'];

						if (isset($arrayResultado_ivr[$resultado])) {
				            $Resultado_id=$arrayResultado_ivr[$resultado]['idResultado'];
				        }else{
				            $Resultado_id=NULL;
				        }

				        if ($Resultado_id!=NULL)
	        			{
	        				$TipoGestion_id=6;
	        				$stmt = $this->bd->prepare("INSERT INTO gestion (Campana_id,Gestor_id,Deudor_id,TipoGestion_id,Telefono_id,fecha_gestion,hora_inicio,hora_fin,Resultado_id,Contacto_id,observaciones,ingresado_por) VALUES(:Campana_id,:Gestor_id,:Deudor_id,:TipoGestion_id,:Telefono_id,:fecha_gestion,:hora_inicio,:hora_fin,:Resultado_id,:Contacto_id,:observaciones,:ingresado_por)");
	
							$stmt->bindValue(':Campana_id',$Campana_id,PDO::PARAM_INT);
					        $stmt->bindValue(':Gestor_id',$Persona_id,PDO::PARAM_INT);
					        $stmt->bindValue(':Deudor_id',$Deudor_id,PDO::PARAM_INT);
					        $stmt->bindValue(':TipoGestion_id',$TipoGestion_id,PDO::PARAM_INT);
					        $stmt->bindValue(':Telefono_id',$Telefono_id,PDO::PARAM_INT);
					        $stmt->bindValue(':fecha_gestion',$fecha_gestion,PDO::PARAM_STR);
					        $stmt->bindValue(':hora_inicio',$hora_envio,PDO::PARAM_STR);
					        $stmt->bindValue(':hora_fin',$hora_envio,PDO::PARAM_INT);
					        $stmt->bindValue(':Resultado_id',$Resultado_id,PDO::PARAM_INT);
					        $stmt->bindValue(':Contacto_id',8,PDO::PARAM_INT);
					        $stmt->bindValue(':observaciones',$observaciones,PDO::PARAM_STR);
					        $stmt->bindValue(':ingresado_por',$ingresado_por,PDO::PARAM_INT);
					        if (!$stmt->execute()) {print_r($stmt->errorInfo());}  
					        $registrado=$stmt->rowCount();
					        if ($registrado==1) {

					        	$stmt = $this->bd->prepare("UPDATE obligacion SET  t_gest_ivr=t_gest_ivr+1 WHERE Campana_id=:Campana_id AND Deudor_id=:Deudor_id");
						        $stmt->bindParam(':Campana_id',$Campana_id);
						        $stmt->bindParam(':Deudor_id',$Deudor_id);
						        $stmt->execute();

						        if (isset($arrayResultado_ivr[$resultado]['InfoValida'])==1) {
						            $stmt = $this->bd->prepare("UPDATE telefono SET  Timbra=1, NroGestIVR=NroGestIVR+1 WHERE idTelefono=:idTelefono");
							        $stmt->bindParam(':idTelefono',$Telefono_id);
							        $stmt->execute();
						        }	

					        }
	        			}else{
	        				$error_resultado="No existe resultado";
	        			}

					}else{
						$error_celular="No existe numero";
					}

	        	}else{
	        		$error_documento="No existe Deudor";
	        	}
				

				
	
	        	$FileGestiones_IVR[$fila]['registrado']=$registrado;
			    $FileGestiones_IVR[$fila]['motivo_registro']=$error_id.$error_documento.$error_celular.$error_fecha_gestion.$error_hora_envio.$error_resultado;
			    $FileGestiones_IVR[$fila]['hora']=date("H:i:s",time());	     
	        }
	        $fila++;
	    }
    fclose ( $fp ); 


    $this->Resultado_Importar($FileGestiones_IVR,"GESTIONES_IVR");

    }
    //*--FUNCION PARA IMPORTAR GESTIONES SMS--*//
    public function Imp_Gest_Correo(){
    	// conectamos a la base de datos
    	$this->bd = new Conexion();
    	$Campana_id=$_REQUEST['idCampana'];
    	$ingresado_por=$_SESSION['Usuario_Actual'];
    	$Persona_id=$_SESSION['Persona_Actual'];	    
	    ini_set('max_execution_time', 10000);
	    $tempFile = $_FILES['DataGestionesCorreo']['tmp_name'];
	    $nombre = $_FILES['DataGestionesCorreo']['name'];
	    $filename = $nombre;
	    $ruta = getcwd() ."/uploads/csv/".$filename;
	    move_uploaded_file($tempFile, $ruta);
	    $fp = fopen ( $ruta , "r" );
	    $fila=0;
	    $FileGestiones_Correo = array();
	    $Resultados_correo = $this->Consultas("select * from resultado where TipoGestion_id=5 and activo=1 and eliminado=0;");
	    $arrayResultado_correo = array();
        foreach ($Resultados_correo as $Resultado) {
        	 $arrayResultado_correo[$Resultado['codigo']]['idResultado']=$Resultado['idResultado'];
        	 $arrayResultado_correo[$Resultado['codigo']]['desactivar_informacion']=$Resultado['desactivar_informacion'];
        	 $arrayResultado_correo[$Resultado['codigo']]['ranking']=$Resultado['ranking'];
        }
	    while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
	    	 //declaramos las variables
	      
	        
	        if($fila>0){

				$id=$data[0];
				$documento=$data[1];
				$correo=$data[2];
				if ($data[3]!=''){$fecha_gestion=date('Y-m-d',strtotime($data[3]));}else{$fecha_gestion=NULL;}
				$hora_envio=$data[4];
				$resultado=$data[5];
				$observaciones=utf8_encode(strtoupper($data[6]));
				$registrado=0;
				$error_id="";
				$error_documento="";
				$error_correo="";
				$error_fecha_gestion="";
				$error_hora_envio="";
				$error_resultado="";

				$FileGestiones_Correo[$fila]['id']=$id;
				$FileGestiones_Correo[$fila]['documento']=$documento;
				$FileGestiones_Correo[$fila]['correo']=$correo;
				$FileGestiones_Correo[$fila]['fecha_gestion']=$fecha_gestion;
				$FileGestiones_Correo[$fila]['hora_envio']=$hora_envio;
				$FileGestiones_Correo[$fila]['resultado']=$resultado;
				$FileGestiones_Correo[$fila]['observaciones']=$observaciones;
				
				$stmt = $this->bd->prepare("SELECT idDeudor,tipo_doc,documento,deudor.activo,hora_contacto,deudor.eliminado FROM deudor WHERE documento=:documento;");
				$stmt->bindParam(':documento', $documento);
	        	$stmt->execute();
	        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
	        	$Deudor=$stmt->fetch(PDO::FETCH_ASSOC);
	        	if ($Deudor['idDeudor']!=NULL)
	        	{
	        		$Deudor_id=$Deudor['idDeudor'];
	        		$stmt = $this->bd->prepare("SELECT idCorreo,correo.Deudor_id,direccion_correo,mejor_ges_id,resultado.ranking FROM correo 
left join gestion on gestion.idGestion=correo.mejor_ges_id
left join resultado on resultado.idResultado=gestion.Resultado_id where correo.Deudor_id=:Deudor_id and correo.direccion_correo=:direccion_correo ;");
					$stmt->bindParam(':Deudor_id', $Deudor_id);
					$stmt->bindParam(':direccion_correo', $correo);
		        	if (!$stmt->execute()) {print_r($stmt->errorInfo());}                     
		        	$Correo=$stmt->fetch(PDO::FETCH_ASSOC);
					if ($Correo['idCorreo']!=NULL) {
						$Correo_id=$Correo['idCorreo'];

						if (isset($arrayResultado_correo[$resultado])) {
				            $Resultado_id=$arrayResultado_correo[$resultado]['idResultado'];
				           
				        }else{
				            $Resultado_id=NULL;
				        }

				        if ($Resultado_id!=NULL)
	        			{
	        				
	        				$TipoGestion_id=5;
	        				$stmt = $this->bd->prepare("INSERT INTO gestion (Campana_id,Gestor_id,Deudor_id,TipoGestion_id,Correo_id,fecha_gestion,hora_inicio,hora_fin,Resultado_id,observaciones,ingresado_por) VALUES(:Campana_id,:Gestor_id,:Deudor_id,:TipoGestion_id,:Correo_id,:fecha_gestion,:hora_inicio,:hora_fin,:Resultado_id,:observaciones,:ingresado_por)");
							$observacion=$observaciones;
							$stmt->bindValue(':Campana_id',$Campana_id,PDO::PARAM_INT);
					        $stmt->bindValue(':Gestor_id',$Persona_id,PDO::PARAM_INT);
					        $stmt->bindValue(':Deudor_id',$Deudor_id,PDO::PARAM_INT);
					        $stmt->bindValue(':TipoGestion_id',$TipoGestion_id,PDO::PARAM_INT);
					        $stmt->bindValue(':Correo_id',$Correo_id,PDO::PARAM_INT);
					        $stmt->bindValue(':fecha_gestion',$fecha_gestion,PDO::PARAM_STR);
					        $stmt->bindValue(':hora_inicio',$hora_envio,PDO::PARAM_STR);
					        $stmt->bindValue(':hora_fin',$hora_envio,PDO::PARAM_INT);
					        $stmt->bindValue(':Resultado_id',$Resultado_id,PDO::PARAM_INT);
					        $stmt->bindValue(':observaciones',$observacion,PDO::PARAM_STR);
					        $stmt->bindValue(':ingresado_por',$ingresado_por,PDO::PARAM_INT);					        

					        if (!$stmt->execute()) {print_r($stmt->errorInfo());}else{$Gestion_id=$this->bd->lastInsertId();} 

					        $registrado=$stmt->rowCount();
					        if ($registrado==1) {
					        	$rkng_Resultado=$arrayResultado_correo[$resultado]['ranking'];
								$rkng_Correo=$Correo['ranking'];
								

									$mejor_ges_id_correo=$Gestion_id;
								if($Correo['ranking']==NULL){
									$mejor_ges_id_correo=$Gestion_id;
								}elseif ($rkng_Resultado<=$rkng_Correo) {
									$mejor_ges_id_correo=$Gestion_id;
								}else{
									$mejor_ges_id_correo=$Correo['mejor_ges_id'];
								}

								$stmt = $this->bd->prepare("UPDATE correo SET  mejor_ges_id=:mejor_ges_id,ultimo_ges_id=:ultimo_ges_id WHERE idCorreo=:idCorreo");
								$stmt->bindParam(':idCorreo',$Correo_id);
								$stmt->bindParam(':mejor_ges_id',$mejor_ges_id_correo);
								$stmt->bindParam(':ultimo_ges_id',$Gestion_id);
								 if (!$stmt->execute()) {print_r($stmt->errorInfo());}  

					        	$stmt = $this->bd->prepare("UPDATE obligacion SET  t_gest_email=t_gest_email+1 WHERE Campana_id=:Campana_id AND Deudor_id=:Deudor_id");
						        $stmt->bindParam(':Campana_id',$Campana_id);
						        $stmt->bindParam(':Deudor_id',$Deudor_id);
						        $stmt->execute();

						        if ($arrayResultado_correo[$resultado]['desactivar_informacion']==1) {
						            $stmt = $this->bd->prepare("UPDATE correo SET  activo=0 WHERE idCorreo=:idCorreo");
							        $stmt->bindParam(':idCorreo',$Correo_id);
							        $stmt->execute();
							        
						        }					       

					        }
	        			}else{
	        				$error_resultado="No existe resultado";
	        			}

					}else{
						$error_correo="No existe Correo";
					}

	        	}else{
	        		$error_documento="No existe Deudor";
	        	}
				

				
	
	        	$FileGestiones_Correo[$fila]['registrado']=$registrado;
			    $FileGestiones_Correo[$fila]['motivo_registro']=$error_id.$error_documento.$error_correo.$error_fecha_gestion.$error_hora_envio.$error_resultado;
			    $FileGestiones_Correo[$fila]['hora']=date("H:i:s",time());	     
	        }
	        $fila++;
	    }
    fclose ( $fp ); 


    $this->Resultado_Importar($FileGestiones_Correo,"GESTIONES_CORREO");

    }


  

    public function Imp_ObligCartera(){
    	$this->bd = new Conexion();
    	$Cartera_id=$_REQUEST['idCartera'];
	    ini_set('max_execution_time', -1);
	    $tempFile = $_FILES['DataObligacionCartera']['tmp_name'];
	    $nombre = $_FILES['DataObligacionCartera']['name'];
	    $filename = $nombre;
	    $ruta = getcwd() ."/uploads/csv/".$filename;
	    move_uploaded_file($tempFile, $ruta);
	    $fp = fopen ( $ruta , "r" );
	    $fila=0;
	    $ingresado_por=$_SESSION['Usuario_Actual'];
	    $nuevos=0;
	    $antiguos=0;
	    $FileObligaciones = array();

	    ini_set('max_execution_time', -1);
		ini_set('memory_limit', '-1');
	    while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
		    setlocale(LC_ALL, 'es_ES.UTF8');
		    $i = 0;
	        if($fila>0){


		        $contador=$data[0];
				$nrooperacion=$data[1];
				$nrocuenta=$data[2];
				$tipo_doc=utf8_encode($data[3]); 
				$documento=utf8_encode($data[4]);
				$cliente=utf8_encode($data[5]);
				$moneda=$data[6];
				$capital_inicial=$data[7];
				$deuda_total_inicial=$data[8];
				 if ($data[9]!='') {$fecha_asignacion=date('Y-m-d',strtotime($data[9]));}else{$fecha_asignacion='';} 

		

		        $FileObligaciones[$fila]['contador']=$contador;
		        $FileObligaciones[$fila]['nrooperacion']=$nrooperacion;
		        $FileObligaciones[$fila]['nrocuenta']=$nrocuenta;
		        $FileObligaciones[$fila]['tipo_doc']=$tipo_doc;
		        $FileObligaciones[$fila]['documento']=$documento;
		        $FileObligaciones[$fila]['cliente']=$cliente;
		        $FileObligaciones[$fila]['moneda']=$moneda;
		        $FileObligaciones[$fila]['capital_inicial']=$capital_inicial;
		        $FileObligaciones[$fila]['deuda_total_inicial']=$deuda_total_inicial;
		        $FileObligaciones[$fila]['fecha_asignacion']=$fecha_asignacion;
		        $Deudor_registrado=0;
				$obligacion_registrada=0;
						
				$error_nroope="";
				$erro_nrocuenta="";
				$error_doc="";
				$error_tipo_doc="";
				$error_cli="";
				if($nrooperacion == ""){$error_nroope ="nrooperacion vacio";}else{$error_nroope="";} 
				if($nrocuenta == ""){$error_nrocuenta = "nrocuenta vacio";}else{$error_nrocuenta = "";} 
				if($tipo_doc == ""){$error_tipo_doc = "tipo doc vacio";}else{$error_tipo_doc = "";}
				if($documento == ""){$error_doc = "documento vacio";}else{$error_doc = "";} 
				if($cliente == ""){$error_cli = "cliente vacio";}else{$error_cli = "";} 

		        if($error_nroope==""  && $erro_nrocuenta=="" && $error_tipo_doc=="" && $error_doc=="" && $error_cli=="" ){
		        	if ($tipo_doc=="RUC") {
						$ruc=$documento;
						$tipo_ruc=substr($documento,0,2);
						if ($tipo_ruc==10) {
							$documento=substr($ruc, 2,8);
						}else{
							$documento=$ruc;
						}
					}else{
						$ruc=NULL;
						$documento=$documento;
					}

			        $stmt = $this->bd->prepare("select * from deudor where documento=:documento or ruc=:ruc; ");
			        $stmt->bindParam(':documento',$documento);
			        $stmt->bindParam(':ruc',$ruc);
			        if (!$stmt->execute()) {$errors = $stmt->errorInfo(); $error_doc=$errors[2]; } else{ $error_doc=''; }                 
			        $Deudor=$stmt->fetch(PDO::FETCH_ASSOC);
			        $Deudor_id=0;
			        if($Deudor['idDeudor']==NULL){  
			        	$error_doc="Deudor Nuevo";          
			            $stmt = $this->bd->prepare("INSERT INTO deudor(documento,ruc,tipo_doc,razon_social,ingresado_por) VALUES(:documento,:ruc,:tipo_doc,:razon_social,:ingresado_por)");
			            $stmt->bindParam(':documento',$documento);
			            $stmt->bindParam(':ruc',$ruc);
			             $stmt->bindParam(':tipo_doc',$tipo_doc);
			            $stmt->bindParam(':razon_social',$cliente);
			            $stmt->bindParam(':ingresado_por',$ingresado_por);
			             if (!$stmt->execute()) {$errors = $stmt->errorInfo(); $error_doc=$errors[2]; } else{ $error_doc='Deudor Nuevo'; }						
			            $Deudor_id=$this->bd->lastInsertId();
			            $Deudor_registrado=$stmt->rowCount();
			        }else{
			        	$error_doc="El Deudor ya existe en la BD";
			            $Deudor_id=$Deudor['idDeudor'];
			        }

			        if($Deudor_id<>0){
			        	
			        	
			        		
			        	 	if($capital_inicial != ""){$capital_inicial = $capital_inicial;}else{$capital_inicial = 0;}       
					        if($deuda_total_inicial != ""){$deuda_total_inicial = $deuda_total_inicial;}else{$deuda_total_inicial = 0;}        
					        if($moneda != ""){$moneda = $moneda;}else{$moneda = NULL;}
					        if ($fecha_asignacion!=''){$fecha_asignacion=date('Y-m-d',strtotime($fecha_asignacion));}else{$fech_asignacion=NULL;}
  
					        $stmt = $this->bd->prepare("INSERT INTO ObligacionCartera(Cartera_id,Deudor_id,NroOperacion,NroCuenta,Moneda,Capital_Inicial,DeudaTotal_Inicial,FechAsig,Ingresado_Por) VALUES(:Cartera_id,:Deudor_id,:NroOperacion,:NroCuenta,:Moneda,:Capital_Inicial,:DeudaTotal_Inicial,:FechAsig,:Ingresado_Por)");

					       	$stmt->bindParam(':Cartera_id',$Cartera_id);
					       	$stmt->bindParam(':Deudor_id',$Deudor_id);
					       	$stmt->bindParam(':NroOperacion',$nrooperacion);
					       	$stmt->bindParam(':NroCuenta',$nrocuenta);
					       	$stmt->bindParam(':Moneda',$moneda);
					       	$stmt->bindParam(':Capital_Inicial',$capital_inicial);
					       	$stmt->bindParam(':DeudaTotal_Inicial',$deuda_total_inicial);
					       	$stmt->bindParam(':FechAsig',$fecha_asignacion);
					       	$stmt->bindParam(':Ingresado_Por',$ingresado_por);					        
					        if (!$stmt->execute()) {$errors = $stmt->errorInfo(); $error_nroope=$errors[2]; } else{ $error_nroope=''; }	
					        $obligacion_registrada=$stmt->rowCount();
					        if($obligacion_registrada==0){
					        	$error_nroope="nrooperacion ya existe";
					        }else{
					        	$error_nroope="nrooperacion nueva";
					        }	
			        	
			       		
			        }
			        	
		        }
		        $FileObligaciones[$fila]['registrado_deudor']=$Deudor_registrado;
		        $FileObligaciones[$fila]['motivo_deudor']=$error_doc.$error_cli;
		        $FileObligaciones[$fila]['registrado_obligacion']=$obligacion_registrada;
		    	$FileObligaciones[$fila]['motivo_obligacion']=$error_nroope.$error_nrocuenta;
		    	$FileObligaciones[$fila]['hora']=date("H:i:s",time());
		         
	        }	    
	    	 //echo $fila++.'->'.$Deudor_id.'->'.date("H:i:s",time()).'<br>';
	       	$fila++;
	    }
	    fclose ( $fp );

	    $this->Resultado_Importar($FileObligaciones,"OBLIGACION_CARTERA");
	    //header('Location: index.php?c=Cartera&a=v_Importar&idCartera='.$Cartera_id);
    }

    public function Act_ObligCartera(){
        $this->bd = new Conexion();
        $Cartera_id=$_REQUEST['idCartera'];
        // conectamos a la base de datos
 
        $tempFile = $_FILES['DataObligacionCarteraAct']['tmp_name'];
        $nombre = $_FILES['DataObligacionCarteraAct']['name'];
        $filename = $nombre;
        $ruta = getcwd() ."/uploads/csv/".$filename;
        move_uploaded_file($tempFile, $ruta);
        $fp = fopen ( $ruta , "r" );
        $fila=0;
        $nuevos=0;
        $antiguos=0;
        $FileObligaciones = array();
		/*
        $stmt = $this->bd->prepare("select nrooperacion,Deudor_id,operacion,retirado,activo from obligacion where campana_id=$Campana_id;");
        $stmt->execute();
        $registro_campana = $stmt->fetchAll();  
        $array_obligaciones = array();
        foreach ($registro_campana as $registro) {
        	$array_obligaciones[$registro['nrooperacion']]['nrooperacion']=$registro['nrooperacion'];
        	$array_obligaciones[$registro['nrooperacion']]['Deudor_id']=$registro['Deudor_id'];
        	$array_obligaciones[$registro['nrooperacion']]['operacion']=$registro['operacion'];
        	$array_obligaciones[$registro['nrooperacion']]['retirado']=$registro['retirado'];
        	$array_obligaciones[$registro['nrooperacion']]['activo']=$registro['activo'];
        }*/
        ini_set('max_execution_time', -1);
		ini_set('memory_limit', '-1');
        while (( $data = fgetcsv ($fp,10000,",")) !== FALSE ){
        setlocale(LC_ALL, 'es_ES.UTF8');
        $i = 0;
            if($fila>0){

                $contador=$data[0];
				$NroOperacion=$data[1];
				$NroCuenta=$data[2];
				$Moneda=$data[3];
				$Capital_Inicial=$data[4];
				$DeudaTotal_Inicial=$data[5];
				$Total_Intereses=$data[6];
				$Tasa_Interes=$data[7];
				$Total_Pagos=$data[8];
				$Capital_Actual=$data[9];
				$DeudaTotal_Actual=$data[10];
				$Producto=utf8_encode($data[11]);
				$Cat_Producto=utf8_encode($data[12]);
				if ($data[13]!='') {$FechVenc=date('Y-m-d',strtotime($data[13]));}else{$FechVenc='';}
				if ($data[14]!='') {$FechCast=date('Y-m-d',strtotime($data[14]));}else{$FechCast='';}
				$Situacion=utf8_encode($data[15]);
				$Seguro=$data[16];
				if ($data[17]!='') {$UltFechPago=date('Y-m-d',strtotime($data[17]));}else{$UltFechPago='';}
				$MontUltPago=$data[18];
				if ($data[19]!='') {$FechDesembolso=date('Y-m-d',strtotime($data[19]));}else{$FechDesembolso='';}
				$MontDesembolso=$data[20];
				$Garantia=utf8_encode($data[21]);
				$Plazo=utf8_encode($data[22]);
				$NroCuotas=utf8_encode($data[23]);
				$CuotasPag=utf8_encode($data[24]);
				$CuotasVenc=utf8_encode($data[25]);
				$Agencia=utf8_encode($data[26]);
				if ($data[27]!='') {$FechComp=date('Y-m-d',strtotime($data[27]));}else{$FechComp='';}
				$Cosecha=utf8_encode($data[28]);
				$Entidad=utf8_encode($data[29]);
				$Portafolio=utf8_encode($data[30]);
				$DocAval=utf8_encode($data[31]);
				$NomAval=utf8_encode($data[32]);
				$DocConyuge=utf8_encode($data[33]);
				$NomConyuge=utf8_encode($data[34]);
				if ($data[35]!='') {$FechAsig=date('Y-m-d',strtotime($data[35]));}else{$FechAsig='';}
				$Dir_Legal=utf8_encode(addslashes($data[36]));
				$Dist_Legal=utf8_encode(addslashes($data[37]));
				$Prov_Legal=utf8_encode(addslashes($data[38]));
				$Dpto_Legal=utf8_encode(addslashes($data[39]));
				$Ubigeo_Legal=$data[40];
				$MejorGest_Call=$data[41];
				$UltGest_Call=$data[42];
				$MejorGest_Campo=$data[43];
				$UltGest_Campo=$data[44];
				$MejorGest_Courier=$data[45];
				$NroGest_Call=$data[46];
				$NroGestCall_CD=$data[47];
				$NroGestCall_CI=$data[48];
				$NroGestCall_CNE=$data[49];
				$NroGest_Campo=$data[50];
				$NroGest_Courier=$data[51];
				$NroGest_Sms=$data[52];
				$NroGest_Email=$data[53];
				$Estado_Tel=$data[54];
				$NroTel=$data[55];
				$NroTel_Activo=$data[56];
				$NroTel_Inactivo=$data[57];
				$Activo=$data[58];
				$Motivo_Retiro=$data[59];
				$Observacion_Retiro=utf8_encode($data[60]);
				$Eliminado=$data[61];


				$FileObligaciones[$fila]['contador']=$contador;
				$FileObligaciones[$fila]['NroOperacion']=$NroOperacion;
				$FileObligaciones[$fila]['NroCuenta']=$NroCuenta;
				$FileObligaciones[$fila]['Moneda']=$Moneda;
				$FileObligaciones[$fila]['Capital_Inicial']=$Capital_Inicial;
				$FileObligaciones[$fila]['DeudaTotal_Inicial']=$DeudaTotal_Inicial;
				$FileObligaciones[$fila]['Total_Intereses']=$Total_Intereses;
				$FileObligaciones[$fila]['Tasa_Interes']=$Tasa_Interes;
				$FileObligaciones[$fila]['Total_Pagos']=$Total_Pagos;
				$FileObligaciones[$fila]['Capital_Actual']=$Capital_Actual;
				$FileObligaciones[$fila]['DeudaTotal_Actual']=$DeudaTotal_Actual;
				$FileObligaciones[$fila]['Producto']=$Producto;
				$FileObligaciones[$fila]['Cat_Producto']=$Cat_Producto;
				$FileObligaciones[$fila]['FechVenc']=$FechVenc;
				$FileObligaciones[$fila]['FechCast']=$FechCast;
				$FileObligaciones[$fila]['Situacion']=$Situacion;
				$FileObligaciones[$fila]['Seguro']=$Seguro;
				$FileObligaciones[$fila]['UltFechPago']=$UltFechPago;
				$FileObligaciones[$fila]['MontUltPago']=$MontUltPago;
				$FileObligaciones[$fila]['FechDesembolso']=$FechDesembolso;
				$FileObligaciones[$fila]['MontDesembolso']=$MontDesembolso;
				$FileObligaciones[$fila]['Garantia']=$Garantia;
				$FileObligaciones[$fila]['Plazo']=$Plazo;
				$FileObligaciones[$fila]['NroCuotas']=$NroCuotas;
				$FileObligaciones[$fila]['CuotasPag']=$CuotasPag;
				$FileObligaciones[$fila]['CuotasVenc']=$CuotasVenc;
				$FileObligaciones[$fila]['Agencia']=$Agencia;
				$FileObligaciones[$fila]['FechComp']=$FechComp;
				$FileObligaciones[$fila]['Cosecha']=$Cosecha;
				$FileObligaciones[$fila]['Entidad']=$Entidad;
				$FileObligaciones[$fila]['Portafolio']=$Portafolio;
				$FileObligaciones[$fila]['DocAval']=$DocAval;
				$FileObligaciones[$fila]['NomAval']=$NomAval;
				$FileObligaciones[$fila]['DocConyuge']=$DocConyuge;
				$FileObligaciones[$fila]['NomConyuge']=$NomConyuge;
				$FileObligaciones[$fila]['FechAsig']=$FechAsig;
				$FileObligaciones[$fila]['Dir_Legal']=$Dir_Legal;
				$FileObligaciones[$fila]['Dist_Legal']=$Dist_Legal;
				$FileObligaciones[$fila]['Prov_Legal']=$Prov_Legal;
				$FileObligaciones[$fila]['Dpto_Legal']=$Dpto_Legal;
				$FileObligaciones[$fila]['Ubigeo_Legal']=$Ubigeo_Legal;
				$FileObligaciones[$fila]['MejorGest_Call']=$MejorGest_Call;
				$FileObligaciones[$fila]['UltGest_Call']=$UltGest_Call;
				$FileObligaciones[$fila]['MejorGest_Campo']=$MejorGest_Campo;
				$FileObligaciones[$fila]['UltGest_Campo']=$UltGest_Campo;
				$FileObligaciones[$fila]['MejorGest_Courier']=$MejorGest_Courier;
				$FileObligaciones[$fila]['NroGest_Call']=$NroGest_Call;
				$FileObligaciones[$fila]['NroGestCall_CD']=$NroGestCall_CD;
				$FileObligaciones[$fila]['NroGestCall_CI']=$NroGestCall_CI;
				$FileObligaciones[$fila]['NroGestCall_CNE']=$NroGestCall_CNE;
				$FileObligaciones[$fila]['NroGest_Campo']=$NroGest_Campo;
				$FileObligaciones[$fila]['NroGest_Courier']=$NroGest_Courier;
				$FileObligaciones[$fila]['NroGest_Sms']=$NroGest_Sms;
				$FileObligaciones[$fila]['NroGest_Email']=$NroGest_Email;
				$FileObligaciones[$fila]['Estado_Tel']=$Estado_Tel;
				$FileObligaciones[$fila]['NroTel']=$NroTel;
				$FileObligaciones[$fila]['NroTel_Activo']=$NroTel_Activo;
				$FileObligaciones[$fila]['NroTel_Inactivo']=$NroTel_Inactivo;
				$FileObligaciones[$fila]['Activo']=$Activo;
				$FileObligaciones[$fila]['Motivo_Retiro']=$Motivo_Retiro;
				$FileObligaciones[$fila]['Observacion_Retiro']=$Observacion_Retiro;
				$FileObligaciones[$fila]['Eliminado']=$Eliminado;

				
				$nrooperacion_actualizada=0;
				$error_act="";
					if($NroOperacion != ""){
					if($NroCuenta != ""){$NroCuenta=", NroCuenta='".$NroCuenta."'";}else{$NroCuenta="";}
					if($Moneda != ""){$Moneda=", Moneda='".$Moneda."'";}else{$Moneda="";}
					if($Capital_Inicial != ""){$Capital_Inicial=", Capital_Inicial=$Capital_Inicial";}else{$Capital_Inicial="";}
					if($DeudaTotal_Inicial != ""){$DeudaTotal_Inicial=", DeudaTotal_Inicial=$DeudaTotal_Inicial";}else{$DeudaTotal_Inicial="";}
					if($Total_Intereses != ""){$Total_Intereses=", Total_Intereses=$Total_Intereses";}else{$Total_Intereses="";}
					if($Tasa_Interes != ""){$Tasa_Interes=", Tasa_Interes=$Tasa_Interes";}else{$Tasa_Interes="";}
					if($Total_Pagos != ""){$Total_Pagos=", Total_Pagos=$Total_Pagos";}else{$Total_Pagos="";}
					if($Capital_Actual != ""){$Capital_Actual=", Capital_Actual=$Capital_Actual";}else{$Capital_Actual="";}
					if($DeudaTotal_Actual != ""){$DeudaTotal_Actual=", DeudaTotal_Actual=$DeudaTotal_Actual";}else{$DeudaTotal_Actual="";}
					if($Producto != ""){$Producto=", Producto='".$Producto."'";}else{$Producto="";}
					if($Cat_Producto != ""){$Cat_Producto=", Cat_Producto='".$Cat_Producto."'";}else{$Cat_Producto="";}
					if($FechVenc != ""){$FechVenc=", FechVenc='".$FechVenc."'";}else{$FechVenc="";}
					if($FechCast != ""){$FechCast=", FechCast='".$FechCast."'";}else{$FechCast="";}
					if($Situacion != ""){$Situacion=", Situacion='".$Situacion."'";}else{$Situacion="";}
					if($Seguro != ""){$Seguro=", Seguro='".$Seguro."'";}else{$Seguro="";}
					if($UltFechPago != ""){$UltFechPago=", UltFechPago='".$UltFechPago."'";}else{$UltFechPago="";}
					if($MontUltPago != ""){$MontUltPago=", MontUltPago=$MontUltPago";}else{$MontUltPago="";}
					if($FechDesembolso != ""){$FechDesembolso=", FechDesembolso='".$FechDesembolso."'";}else{$FechDesembolso="";}
					if($MontDesembolso != ""){$MontDesembolso=", MontDesembolso=$MontDesembolso";}else{$MontDesembolso="";}					
					if($Garantia != ""){$Garantia=", Garantia='".$Garantia."'";}else{$Garantia="";}
					if($Plazo != ""){$Plazo=", Plazo='".$Plazo."'";}else{$Plazo="";}
					if($NroCuotas != ""){$NroCuotas=", NroCuotas='".$NroCuotas."'";}else{$NroCuotas="";}
					if($CuotasPag != ""){$CuotasPag=", CuotasPag='".$CuotasPag."'";}else{$CuotasPag="";}
					if($CuotasVenc != ""){$CuotasVenc=", CuotasVenc='".$CuotasVenc."'";}else{$CuotasVenc="";}
					if($Agencia != ""){$Agencia=", Agencia='".$Agencia."'";}else{$Agencia="";}
					if($FechComp != ""){$FechComp=", FechComp='".$FechComp."'";}else{$FechComp="";}
					if($Cosecha != ""){$Cosecha=", Cosecha='".$Cosecha."'";}else{$Cosecha="";}
					if($Entidad != ""){$Entidad=", Entidad='".$Entidad."'";}else{$Entidad="";}
					if($Portafolio != ""){$Portafolio=", Portafolio='".$Portafolio."'";}else{$Portafolio="";}
					if($DocAval != ""){$DocAval=", DocAval='".$DocAval."'";}else{$DocAval="";}
					if($NomAval != ""){$NomAval=", NomAval='".$NomAval."'";}else{$NomAval="";}
					if($DocConyuge != ""){$DocConyuge=", DocConyuge='".$DocConyuge."'";}else{$DocConyuge="";}
					if($NomConyuge != ""){$NomConyuge=", NomConyuge='".$NomConyuge."'";}else{$NomConyuge="";}
					if($FechAsig != ""){$FechAsig=", FechAsig='".$FechAsig."'";}else{$FechAsig="";}
					if($Dir_Legal != ""){$Dir_Legal=", Dir_Legal='".$Dir_Legal."'";}else{$Dir_Legal="";}
					if($Dist_Legal != ""){$Dist_Legal=", Dist_Legal='".$Dist_Legal."'";}else{$Dist_Legal="";}
					if($Prov_Legal != ""){$Prov_Legal=", Prov_Legal='".$Prov_Legal."'";}else{$Prov_Legal="";}
					if($Dpto_Legal != ""){$Dpto_Legal=", Dpto_Legal='".$Dpto_Legal."'";}else{$Dpto_Legal="";}
					if($Ubigeo_Legal != ""){$Ubigeo_Legal=", Ubigeo_Legal=$Ubigeo_Legal";}else{$Ubigeo_Legal="";}
					if($MejorGest_Call != ""){$MejorGest_Call=", MejorGest_Call=$MejorGest_Call";}else{$MejorGest_Call="";}
					if($UltGest_Call != ""){$UltGest_Call=", UltGest_Call=$UltGest_Call";}else{$UltGest_Call="";}
					if($MejorGest_Campo != ""){$MejorGest_Campo=", MejorGest_Campo=$MejorGest_Campo";}else{$MejorGest_Campo="";}
					if($UltGest_Campo != ""){$UltGest_Campo=", UltGest_Campo=$UltGest_Campo";}else{$UltGest_Campo="";}
					if($MejorGest_Courier != ""){$MejorGest_Courier=", MejorGest_Courier=$MejorGest_Courier";}else{$MejorGest_Courier="";}
					if($NroGest_Call != ""){$NroGest_Call=", NroGest_Call=$NroGest_Call";}else{$NroGest_Call="";}
					if($NroGestCall_CD != ""){$NroGestCall_CD=", NroGestCall_CD=$NroGestCall_CD";}else{$NroGestCall_CD="";}
					if($NroGestCall_CI != ""){$NroGestCall_CI=", NroGestCall_CI=$NroGestCall_CI";}else{$NroGestCall_CI="";}
					if($NroGestCall_CNE != ""){$NroGestCall_CNE=", NroGestCall_CNE=$NroGestCall_CNE";}else{$NroGestCall_CNE="";}
					if($NroGest_Campo != ""){$NroGest_Campo=", NroGest_Campo=$NroGest_Campo";}else{$NroGest_Campo="";}
					if($NroGest_Courier != ""){$NroGest_Courier=", NroGest_Courier=$NroGest_Courier";}else{$NroGest_Courier="";}
					if($NroGest_Sms != ""){$NroGest_Sms=", NroGest_Sms=$NroGest_Sms";}else{$NroGest_Sms="";}
					if($NroGest_Email != ""){$NroGest_Email=", NroGest_Email=$NroGest_Email";}else{$NroGest_Email="";}
					if($Estado_Tel != ""){$Estado_Tel=", Estado_Tel=$Estado_Tel";}else{$Estado_Tel="";}
					if($NroTel != ""){$NroTel=", NroTel=$NroTel";}else{$NroTel="";}
					if($NroTel_Activo != ""){$NroTel_Activo=", NroTel_Activo=$NroTel_Activo";}else{$NroTel_Activo="";}
					if($NroTel_Inactivo != ""){$NroTel_Inactivo=", NroTel_Inactivo=$NroTel_Inactivo";}else{$NroTel_Inactivo="";}
					if($Activo != ""){$Activo=", Activo=$Activo";}else{$Activo="";}
					if($Motivo_Retiro != ""){$Motivo_Retiro=", Motivo_Retiro=$Motivo_Retiro";}else{$Motivo_Retiro="";}
					if($Observacion_Retiro != ""){$Observacion_Retiro=", Observacion_Retiro='".$Observacion_Retiro."'";}else{$Observacion_Retiro="";}
					if($Eliminado != ""){$Eliminado=", Eliminado=$Eliminado";}else{$Eliminado="";}



	                $campo_actualizar="$NroCuenta$Moneda$Capital_Inicial$DeudaTotal_Inicial$Total_Intereses$Tasa_Interes$Total_Pagos$Capital_Actual$DeudaTotal_Actual$Producto$Cat_Producto$FechVenc$FechCast$Situacion$Seguro$UltFechPago$MontUltPago$FechDesembolso$MontDesembolso$Garantia$Plazo$NroCuotas$CuotasPag$CuotasVenc$Agencia$FechComp$Cosecha$Entidad$Portafolio$DocAval$NomAval$DocConyuge$NomConyuge$FechAsig$Dir_Legal$Dist_Legal$Prov_Legal$Dpto_Legal$Ubigeo_Legal$MejorGest_Call$UltGest_Call$MejorGest_Campo$UltGest_Campo$MejorGest_Courier$NroGest_Call$NroGestCall_CD$NroGestCall_CI$NroGestCall_CNE$NroGest_Campo$NroGest_Courier$NroGest_Sms$NroGest_Email$Estado_Tel$NroTel$NroTel_Activo$NroTel_Inactivo$Activo$Motivo_Retiro$Observacion_Retiro$Eliminado";            
	                if(strpos($campo_actualizar,",")==0){
	                    $campo_actualizar=substr($campo_actualizar,1);
	                }
	                $stmt = $this->bd->prepare("UPDATE ObligacionCartera SET $campo_actualizar WHERE Cartera_id=$Cartera_id and nrooperacion='".$NroOperacion."';");
	                
	                if (!$stmt->execute()) {
				            $errors = $stmt->errorInfo();
				            //echo ($errors[2]);
				           $error_act=$errors[2];          
				            //print_r($stmt->errorInfo());
				    }else{
				    	$nrooperacion_actualizada=$stmt->rowCount();
		                $error_act="Registro Actualizado";
		                if($nrooperacion_actualizada==0){
						        	$error_act="No se hizo ninguna modificacion";
						}
				    }
				}else{$error_act ="Campo NroOperacion vacio";}

	                	
            
            	$FileObligaciones[$fila]['actualizado']=$nrooperacion_actualizada;
		    	$FileObligaciones[$fila]['motivo_obligacion']=$error_act;
		    	$FileObligaciones[$fila]['hora']=date("H:i:s",time());
            }
            //echo $fila++.'->'.date("H:i:s",time()).'<br>';
             $fila++;
        }
        fclose ($fp);
        //header('Location: index.php?c=Campana&a=v_Importar&idCampana='.$Campana_id);       	
        $this->Resultado_Importar($FileObligaciones,"ACT_OBLIGACION_CARTERA");
    }

 public function Resultado_Importar($registros,$informacion){
      
        header("Content-type: application/vnd.ms-excel");  
        header("Content-Disposition: attachment; filename=RES_FILE_IMP_".$informacion.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");    

        require_once 'view/procesos/importar/resultado_importacion.php';

    }

}