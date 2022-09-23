<?php 

include_once 'model/conexion.php';
class IncludesController
{
    private $bd; 

    
      public function redirect($url)
  {
    header("Location: $url");
  }   

 /*--------- -------CONSULTAS A LA BD------------------------------------------------------------ */
public function Consultas($sql)
    {

         $this->bd = new Conexion();
        try
        { 
            ini_set('memory_limit', -1); 
            $result = array();

            $stm = $this->bd->prepare($sql);
            $stm->execute();
            $registro = $stm->fetchAll();            
            return $registro;
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }





  
  public function consultar_row($sql)
    {

        try
        {
             ini_set('memory_limit', -1); 
            $this->bd = new Conexion();

            $stm = $this->bd->prepare($sql);
            $stm->execute();                   
            return $stm->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }


     public function validarPermiso ($idPerfil = 0,$idVista=0){

      try
        {
             ini_set('memory_limit', -1); 
        $this->pdo = new Conexion();
            $result = array();

            $stm = $this->pdo->prepare("SELECT acceder     FROM Permiso
                WHERE Vista_id = $idVista
                AND Perfil_id=$idPerfil");
            $stm->execute();
                   
            return $stm->fetch(PDO::FETCH_ASSOC);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }

  }




//*************ORDENAR ARRAY****************/
function orderMultiDimensionalArray ($toOrderArray, $field, $inverse = false) {
    $position = array();
    $newRow = array();
    foreach ($toOrderArray as $key => $row) {
            $position[$key]  = $row[$field];
            $newRow[$key] = $row;
    }
    if ($inverse) {
        arsort($position);
    }
    else {
        asort($position);
    }
    $returnArray = array();
    foreach ($position as $key => $pos) {     
        $returnArray[] = $newRow[$key];
    }
    return $returnArray;
}

/*******FORMATOS DE NUMEROS**********/
       public  function toMoney($val,$moneda='',$r=2)
{

    if($moneda=='D'){
      $symbol='$ ';
    }elseif($moneda=='S'){
      $symbol='S/. ';
    }else{
      $symbol='';
    }
    $n = $val; 
    $c = is_float($n) ? 1 : number_format($n,$r);
    $d = '.';
    $t = ',';
    $sign = ($n < 0) ? '-' : '';
    $i = $n=number_format(abs($n),$r); 
    $j = (($j = strlen($i)) > 3) ? $j % 3 : 0; 

   return  $symbol.$sign .($j ? substr($i,0, $j) + $t : ' ').preg_replace('/(\d{3})(?=\d)/',"$1" + $t,substr($i,$j)) ;

}

public function bussiness_days($day_start,$day_end,$Weekend,$DayNonWorking){


  $numberdayswork=0;
  $day_start=$day_start;
  $day_end=$day_end;

$ArrayDayNonWorking= explode(",",$DayNonWorking);

  //Mientras Fecha Inicial sea menor igual Fecha Final 
  while(strtotime($day_start) <= strtotime($day_end)){

    //Obtener Representación numérica del día de la semana
    $day_week = date('N', strtotime($day_start));
    //Si el dia de la semana es diferente a domingo incrementar contar dias laborables
    if ($day_week != 7) { 
      if(!in_array(date("Y-m-d",strtotime($day_start)),$ArrayDayNonWorking)){
         $numberdayswork++; 
      }
    };

    $day_start=date("Y-m-d  ", strtotime($day_start . " + 1 day"));


}

return $numberdayswork;
}

public  function toSymbolMoney($moneda=''){
  if($moneda=='D'){
     return $symbol='$ ';
    }elseif($moneda=='S'){
      return $symbol='S/. ';
    }else{
      return $symbol='';
    }
}

    public  function toPercent($val)
{

$valor=round($val,4)*100;
   return  $valor.' <b>%</b>';

}

    public  function to_no_Percent($val)
{

$valor=round($val,4)*100;
   return  $valor;
}

public  function noPercent($val)
{

$valor=round($val,4)*100;
   return  $valor;
}

function super_unique($array,$key)

{

   $temp_array = array();

 //  foreach ( $array as &$v ) {
  foreach ( $array as $v ) {
       if (!isset($temp_array[$v[$key]]))

       //$temp_array[$v[$key]] =& $v;
       $temp_array[$v[$key]] = $v;
   }

   $array = array_values($temp_array);

   return $array;



}


public function Semaforo($porcentaje)
{
$porcentaje=$this->noPercent($porcentaje);
   if ($porcentaje>=100) {
       return  '<ul class="semaforo verde"><li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></li></ul>';
   }elseif ($porcentaje>=70) {
       return  '<ul class="semaforo ambar"><li><i class="fa fa-hand-o-right" aria-hidden="true"></i></li></ul>';
   }else{
       return  '<ul class="semaforo rojo"><li><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></li></ul>';
   }
}









public function estado_activo($estado){

  /*
    0 -> inactivo
    1 -> activo                
  */
  if ($estado==0) {
    echo  'INACTIVO';
  }elseif ($estado==1) {
    echo  'ACTIVO';
  }
}
    
/***********************/
public function sumar_array_key_value($array_query, $clave, $valor) { 
  ini_set('memory_limit', -1); 
 ini_set('max_execution_time', -1);
  //declaramos el nuevo arreglo
  $nuevo = array();
  //recorremos el array_query para guardar las claves en un nuevo array
  foreach ($array_query as $item) {
    $array_clave[] = $item[$clave];
  }

  //eliminamos las claves duplicadas
  $array_clave_unico = array_unique($array_clave);
  //recorremos el array sin duplicados
  foreach ($array_clave_unico as $array_unico) {
    $suma =0;
    foreach ($array_query as $item_query) {
      if ($array_unico == $item_query[$clave]) {
        $suma = $suma + $item_query[$valor];
      }
    }
    $nuevo[$array_unico][$clave]=$array_unico;
    $nuevo[$array_unico]['TOTAL']=$suma;
    

    $suma = 0;
  }
  return $nuevo;
}

                



 }   


 ?>


 <?php 
class FiltrarArreglos {
        private $num;

        function __construct($num) {
                $this->num = $num;
        }
/* FILTROS POR GESTION*/
        function filtrar_por_Usuario($i) {
               return $i['IDUSUARIO'] == $this->num;
        }


        function filtrar_por_EstadoContactabilidad($i) {
               return $i['IDCONTACTABILIDAD'] == $this->num;
        }


        //RANKING SEGMENTACION;

        function filtrar_por_TipoMonto($i) {
               return $i['TIPO_MONTO'] == $this->num;
        }

        function filtrar_por_segmento($i) {
               return $i['SEGMENTO'] == $this->num;
        }

        
        function filtrar_por_Usuario_id($i) {
               return $i['USUARIO_ID'] == $this->num;
        }

        function filtrar_por_idResultado($i) {
               return $i['IDRESULTADO'] == $this->num;
        }

        function filtrar_por_Hora_Inicio($i) {
               return $i['HORA_GESTION'] == $this->num;
        }
        /*
          TABLA DESPLEGABLE
        */
        function filter_by_FirstRow($i) {
               return $i['FIRST_CODE'] == $this->num;
        }

        function filter_by_SecondRow($i) {
               return $i['SECOND_CODE'] == $this->num;
        }

        function filter_by_ThirdRow($i) {
               return $i['THIRD_CODE'] == $this->num;
        }


}
 ?>

 <?php 
class FilterArray{
        private $num;
        private $index;

        function __construct($num,$index) {
                $this->num = $num;
                $this->index = $index;
        }
/* FILTROS POR GESTION*/
        function filter_by_index($i) {
               return $i[$this->index] == $this->num;
        }


}
 ?>
