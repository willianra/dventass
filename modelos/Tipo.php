<?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";

Class Tipo{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($tipoid,$descripcion)
	{
		$sql="INSERT INTO tipo (tipoid,descripcion,condicion)
		VALUES ('$tipoid','$descripcion','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
    public function editar($tipo,$descripcion)
	{

		$sql="UPDATE tipo SET tipoid= '$tipoid',descripcion='$descripcion' 
		WHERE tipoid='$tipoid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la condicion
	public function desactivar($tipoid)

	{
		 $sql="UPDATE tipo SET condicion='0' WHERE tipoid='$tipoid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($tipoid)
	{
		$sql="UPDATE tipo SET condicion='1' WHERE tipoid='$tipoid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($tipoid)
	{

		$sql="SELECT * FROM tipo WHERE tipoid='$tipoid'";
		Return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT *FROM tipo";
		return ejecutarConsulta($sql); //1 o 0
	}

}
 ?>