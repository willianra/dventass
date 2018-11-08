<?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";

Class Sucursal{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($departamento,$municipio,$direccion,$telefono,$fax,$empresaid)
	{
		$sql="INSERT INTO sucursal (departamento,municipio,direccion,telefono,fax,empresaid)
		VALUES ('$departamento','$municipio','$direccion','$telefono','fax','$empresaid','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
    public function editar($sucursalid,$departamento,$municipio,$direccion,$telefono,$fax,$empresaid)
	{

		$sql="UPDATE sucursal SET departamento='$departamento',municipio='$municipio',direccion= '$direccion',telefono= '$telefono',fax= '$fax',empresaid= '$empresaid' 
		WHERE sucursalid='$sucursalid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la condicion
	public function desactivar($sucursalid)
	{
		 $sql="UPDATE sucursal SET estado='0' WHERE sucursalid='$sucursalid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($sucursalid)
	{
		$sql="UPDATE sucursal SET estado='1' WHERE sucursalid='$sucursalid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($sucursalid)
	{

		$sql="SELECT * FROM sucursal WHERE sucursalid='$sucursalid'";
		return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registr
	{		
	   $sql="SELECT *FROM sucursal";
		return ejecutarConsulta($sql); //1 o 0
	}
    
    public function select()//mostrar todos los registros
	{
		$sql="SELECT *FROM sucursal WHERE estado=1";
		return ejecutarConsulta($sql); //1 o 0
	}

}
 ?>