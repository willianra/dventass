<?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";

Class Tipo{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($descripcion)
	{
		$sql="INSERT INTO tipo (descripcion,estado)
		VALUES ('$descripcion','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
    public function editar($tipoid,$descripcion)
	{

		$sql="UPDATE tipo SET descripcion='$descripcion' 
		WHERE tipoid='$tipoid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la condicion
	public function desactivar($tipoid)

	{
		 $sql="UPDATE tipo SET estado='0' WHERE tipoid='$tipoid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($tipoid)
	{
		$sql="UPDATE tipo SET estado='1' WHERE tipoid='$tipoid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($tipoid)
	{

		$sql="SELECT * FROM tipo WHERE tipoid='$tipoid'";
		return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT *FROM tipo";
		return ejecutarConsulta($sql); //1 o 0
	}
    
    public function select()//mostrar todos los registros
	{
		$sql="SELECT *FROM tipo WHERE estado=1";
		return ejecutarConsulta($sql); //1 o 0
	}

}
 ?>