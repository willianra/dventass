<?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class Almacen{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($departamento,$direccion,$email, $telefono)
	{
		$sql="INSERT INTO almacen( departamento,direccion,email,telefono ,condicion)
		VALUES ( '$departamento','$direccion','$email','$telefono','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($almacenid,$departamento,$direccion,$email, $telefono)
	{

		$sql="UPDATE almacen SET almacenid='$almacenid',departamento='$departamento',direccion='$direccion',email='$email'
		 ,telefono='$telefono'
		WHERE almacenid='$almacenid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la condicion
	public function desactivar($almacenid)

	{
		 $sql="UPDATE almacen SET condicion='0' WHERE almacenid='$almacenid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($almacenid)
	{
		$sql="UPDATE almacen SET condicion='1' WHERE almacenid='$almacenid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($almacenid)
	{

		$sql="SELECT * FROM almacen WHERE almacenid='$almacenid'";
		Return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT * FROM almacen ";
		return ejecutarConsulta($sql); //1 o 0
	}
	 public function select()//mostrar todos los registros
	{
		$sql="SELECT *FROM almacen WHERE condicion=1";
		return ejecutarConsulta($sql); //1 o 0
	}

	

}
 ?>