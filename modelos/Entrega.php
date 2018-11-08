<?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";

Class Entrega{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($fechaEntrega,$cantidad,$planificacionid,$paqueteid)
	{
		$sql="INSERT INTO entrega (fechaEntrega,cantidad,planificacionid,paqueteid)
		VALUES ('$fechaEntrega','$cantidad','$planificacionid','$paqueteid')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
    public function editar($entregaid,$fechaEntrega,$cantidad,$planificacionid,$paqueteid)
	{

		$sql="UPDATE entrega SET entregaid= '$entregaid',fechaEntrega='$fechaEntrega',cantidad='$cantidad',planificacionid='$planificacionid',paqueteid='$paqueteid'
		WHERE entregaid='$entregaid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la condicion

  //muestra un tupla 
	public function mostrar($entregaid)
	{

		$sql="SELECT * FROM entrega WHERE entregaid='$entregaid'";
		return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT *FROM entrega";
		return ejecutarConsulta($sql); //1 o 0
	}

    public function preview($entregaid)
    {

    }
}
 ?>