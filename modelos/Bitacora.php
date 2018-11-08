 <?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class Bitacora{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($usuarioid,$accion)
	{
		$sql="INSERT INTO bitacora(usuarioid,accion)
		VALUES ('$usuarioid','$accion')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($bitacoraid,$usuarioid,$accion)
	{

		$sql="UPDATE bitacora SET bitacoraid='$bitacoraid',usuarioid='$usuarioid',accion='$accion='
	='
		WHERE bitacoraid='$bitacoraid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la condicion
 
	 
  //muestra un tupla 
	public function mostrar($bitacoraid)
	{

		$sql="SELECT * FROM bitacora WHERE bitacoraid='$bitacoraid'";
		Return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT (bitacoraid),usuarioid,accion FROM bitacora ";
		return ejecutarConsulta($sql); //1 o 0
	}
 

}
 ?>