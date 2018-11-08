<?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class Avala{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($personaid,$planificacionid)
	{
		$sql="INSERT INTO avala (personaid,planificacionid,estado)
		VALUES ('$personaid','$planificacionid','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($avalaid ,$personaid,$planificacionid)
	{

		$sql="UPDATE avala SET planificacionid='$planificacionid',personaid='$personaid'
		WHERE avalaid='$avalaid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la estado
	public function desactivar($avalaid)

	{
		 $sql="UPDATE avala SET estado='0' WHERE avalaid='$avalaid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($avalaid)
	{
		$sql="UPDATE avala SET estado='1' WHERE avalaid='$avalaid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($avalaid)
	{

		$sql="SELECT * FROM avala WHERE avalaid='$avalaid'";
		return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT * FROM avala ";
		return ejecutarConsulta($sql); //1 o 0
	}
	
}
 ?>