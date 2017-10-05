<?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";

Class Paquete{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($paqueteid,$descripcion,$color)
	{
		$sql="INSERT INTO paquete (paqueteid,descripcion,color,condicion)
		VALUES ('$paqueteid','$descripcion','$color','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
    public function editar($paqueteid,$descripcion,$color)
	{

		$sql="UPDATE paquete SET paqueteid= '$paqueteid',descripcion='$descripcion',color='$color'
		WHERE paqueteid='$paqueteid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la condicion
	public function desactivar($paqueteid)

	{
		 $sql="UPDATE paquete SET condicion='0' WHERE paqueteid='$paqueteid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($paqueteid)
	{
		$sql="UPDATE paquete SET condicion='1' WHERE paqueteid='$paqueteid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($paqueteid)
	{

		$sql="SELECT * FROM paquete WHERE paqueteid='$paqueteid'";
		Return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT *FROM paquete";
		return ejecutarConsulta($sql); //1 o 0
	}

}
 ?>