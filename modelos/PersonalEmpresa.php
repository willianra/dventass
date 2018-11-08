<?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class personalEmpresa{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($idpersona,$idsucursal)
	{
		$sql="INSERT INTO personalsucursal (idpersona,idsucursal,estado)
		VALUES ('$idpersona','$idsucursal','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($personalsucursalid ,$idpersona,$idsucursal)
	{

		$sql="UPDATE personalsucursal SET idpersona='$idpersona',idsucursal='$idsucursal'
		WHERE personalsucursalid='$personalsucursalid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la estado
	public function desactivar($personalsucursalid)

	{
		 $sql="UPDATE personalsucursal SET estado='0' WHERE personalsucursalid='$personalsucursalid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($personalsucursalid)
	{
		$sql="UPDATE personalsucursal SET estado='1' WHERE personalsucursalid='$personalsucursalid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($personalsucursalid)
	{
		$sql="SELECT * FROM personalsucursal WHERE personalsucursalid='$personalsucursalid'";
		return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT * FROM personalsucursal ";
		return ejecutarConsulta($sql); //1 o 0
	}
	
}
 ?>