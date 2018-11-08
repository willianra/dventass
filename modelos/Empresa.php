<?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class Empresa{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($nroPatronal,$razonSocial,$nombreComercial,$tipoEmpresa)
	{
		$sql="INSERT INTO empresa(nroPatronal,razonSocial,nombreComercial,tipoEmpresa,condicion)
		VALUES ('$nroPatronal','$razonSocial','$nombreComercial','$tipoEmpresa','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($empresaid,$nroPatronal,$razonSocial,$nombreComercial,$tipoEmpresa)
	{

		$sql="UPDATE empresa SET empresaid='$empresaid',nroPatronal='$nroPatronal',razonSocial='$razonSocial',nombreComercial='$nombreComercial'
		,tipoEmpresa='$tipoEmpresa'
		WHERE empresaid='$empresaid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la condicion
	public function desactivar($empresaid)

	{
		 $sql="UPDATE empresa SET condicion='0' WHERE empresaid='$empresaid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($empresaid)
	{
		$sql="UPDATE empresa SET condicion='1' WHERE empresaid='$empresaid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($empresaid)
	{

		$sql="SELECT * FROM empresa WHERE empresaid='$empresaid'";
		Return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT * FROM empresa ";
		return ejecutarConsulta($sql); //1 o 0
	}

}
 ?>