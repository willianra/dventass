<?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class Pedido{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($fechaEntrega,$cantidad,$vigencia,$almacenid,$productoid )
	{
		$sql="INSERT INTO pedido (fechaEntrega,cantidad,vigencia,almacenid,productoid,estado)
		VALUES ( '$fechaEntrega','$cantidad','$vigencia','$almacenid','$productoid','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($pedidoid,$fechaEntrega,$cantidad,$vigencia,$almacenid,$productoid  )
	{

		$sql="UPDATE pedido SET pedidoid='$pedidoid',fechaEntrega='$fechaEntrega',cantidad='$cantidad'
		,vigencia='$vigencia',almacenid='$almacenid',productoid='$productoid'
		WHERE pedidoid='$pedidoid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la estado
	public function desactivar($pedidoid)

	{
		 $sql="UPDATE pedido SET estado='0' WHERE pedidoid='$pedidoid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($pedidoid)
	{
		$sql="UPDATE pedido SET estado='1' WHERE pedidoid='$pedidoid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($pedidoid)
	{

		$sql="SELECT * FROM pedido WHERE pedidoid='$pedidoid'";
		Return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT * FROM pedido ";
		return ejecutarConsulta($sql); //1 o 0
	}

}
 ?>