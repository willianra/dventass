 <?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class Proveedor{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($nombre,$departamento,$direccion,$telefono,$email)
	{
		$sql="INSERT INTO proveedor (nombre,departamento,direccion,telefono,email,estado)
		VALUES ('$nombre','$departamento','$direccion','$telefono','$email','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($proveedorid,$nombre,$departamento,$direccion,$telefono,$email)
	{

		$sql="UPDATE proveedor SET proveedorid='$proveedorid',nombre='$nombre',departamento='$departamento',direccion='$direccion',telefono='$telefono',email='$email'
		WHERE proveedorid='$proveedorid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la estado
	public function desactivar($proveedorid)
	{
		 $sql="UPDATE proveedor SET estado='0' WHERE proveedorid='$proveedorid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($proveedorid)
	{
		$sql="UPDATE proveedor SET estado='1' WHERE proveedorid='$proveedorid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($proveedorid)
	{

		$sql="SELECT * FROM proveedor WHERE proveedorid='$proveedorid'";
		return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT * FROM proveedor ";
		return ejecutarConsulta($sql); //1 o 0
	}
	  public function select()//mostrar todos los registros
	{
		$sql="SELECT * FROM proveedor WHERE estado=1";
		return ejecutarConsulta($sql); //1 o 0
	}


}
 ?>