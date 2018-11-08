<?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class Persona{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($ci,$nombre,$paterno,$materno,$direccion,$telefono,$email,$tipoid)
	{
		$sql="INSERT INTO persona(ci,nombre,paterno,materno,direccion,telefono,email,tipoid,condicion)
		VALUES ('$ci','$nombre','$paterno','$materno','$direccion','$telefono','$email','$tipoid','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($personaid,$ci,$nombre,$paterno,$materno,$direccion,$telefono,$email,$tipoid)
	{

		$sql="UPDATE persona SET personaid='$personaid',ci='$ci',nombre='$nombre',paterno='$paterno'
		,materno='$materno',direccion='$direccion',telefono='$telefono',email='$email',tipoid='$tipoid'
		WHERE personaid='$personaid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la condicion
	public function desactivar($personaid)

	{
		 $sql="UPDATE persona SET condicion='0' WHERE personaid='$personaid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($personaid)
	{
		$sql="UPDATE persona SET condicion='1' WHERE personaid='$personaid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($personaid)
	{

		$sql="SELECT * FROM persona WHERE personaid='$personaid'";
		return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT * FROM persona ";
		return ejecutarConsulta($sql); //1 o 0
	}
	  public function select()//mostrar todos los registros
	{
		$sql="SELECT *FROM persona WHERE condicion=1";
		return ejecutarConsulta($sql); //1 o 0
	}

	 public function getTipo($personaid)//mostrar todos los registros
	{
		$sql="SELECT tipoid FROM persona WHERE personaid='$personaid'";
		return ejecutarConsulta($sql); //1 o 0
	}	

}
 ?>