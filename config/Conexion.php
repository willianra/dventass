<?php 
require_once "global.php";
$conexion=new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
mysqli_query($conexion,'SET NAMES "'.DB_ENCODE.'"');

  
 IF(mysqli_connect_errno())
{
    
	printf("error:$s\n",mysqli_connect_error);
	exit();
}



if(!function_exists('ejecutarConsulta'))
{
  function ejecutarConsulta($sql)
  {
  	global $conexion;
  	$query=$conexion->query($sql); 
  	return $query;
 } 
 function ejecutarConsultasimplefila($sql)
 {
 	global $conexion;
 	$query =$conexion->query($sql);
 	$row=$query->fetch_assoc();
 	return row;//retorna un a fila 
 }
 function ejecutarConsulta_retornarID($sql)
 {
 	global $conexion;
 	$query=$conexion->query($sql);
 	return $conexion->insert_id;
 }
 function limpiarCadena($str)
 {
 	global $conexion;
 	$str=mysqli_real_escape_string($conexion,trim($str));
 	return htmlspecialchars($str);
 }
}
 ?>