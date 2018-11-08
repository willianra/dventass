<?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class almacenpersona{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($idpersona,$idalmacen)
	{
		$sql="INSERT INTO almacenpersona (idpersona,idalmacen,estado)
		VALUES ('$idpersona','$idalmacen','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($almacenpersonaid ,$idpersona,$idalmacen)
	{

		$sql="UPDATE almacenpersona SET idalmacen='$idalmacen',idpersona='$idpersona'
		WHERE almacenpersonaid='$almacenpersonaid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la estado
	public function desactivar($almacenpersonaid)

	{
		 $sql="UPDATE almacenpersona SET estado='0' WHERE almacenpersonaid='$almacenpersonaid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($almacenpersonaid)
	{
		$sql="UPDATE almacenpersona SET estado='1' WHERE almacenpersonaid='$almacenpersonaid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($almacenpersonaid)
	{
		$sql="SELECT * FROM almacenpersona WHERE almacenpersonaid='$almacenpersonaid'";
		return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT * FROM almacenpersona ";
		return ejecutarConsulta($sql); //1 o 0
	}
	
}
 ?>