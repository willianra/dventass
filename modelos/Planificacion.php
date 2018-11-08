 <?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class Planificacion{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($trabajadorid, $cantidadPaqueteEstimado,$fechaInicio,$fechaFin,$almacenid)
	{
		$sql="INSERT INTO planificacion (trabajadorid ,cantidadPaqueteEstimado,fechaInicio,fechaFin,almacenid,condicion)
		VALUES ('$trabajadorid' ,'$cantidadPaqueteEstimado','$fechaInicio','$fechaFin','$almacenid','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($planificacionid,$trabajadorid, $cantidadPaqueteEstimado,$fechaInicio,$fechaFin,$almacenid)
	{

		$sql="UPDATE planificacion SET planificacionid='$planificacionid',trabajadorid='$trabajadorid' ,cantidadPaqueteEstimado='$cantidadPaqueteEstimado',fechaInicio='$fechaInicio'
		,fechaFin='$fechaFin',almacenid='$almacenid'
		WHERE planificacionid='$planificacionid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la condicion
	public function desactivar($planificacionid)

	{
		 $sql="UPDATE planificacion SET condicion='0' WHERE planificacionid='$planificacionid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($planificacionid)
	{
		$sql="UPDATE planificacion SET condicion='1' WHERE planificacionid='$planificacionid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($planificacionid)
	{

		$sql="SELECT * FROM planificacion WHERE planificacionid='$planificacionid'";
		Return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT * FROM planificacion ";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function listar2($idusuario)//mostrar todos los registros
	{
		$sql="SELECT * FROM planificacion   ";
		return ejecutarConsulta($sql); //1 o 0
	} 

	 public function select()//mostrar todos los registros
	{
		$sql="SELECT *FROM planificacion WHERE condicion=1";
		return ejecutarConsulta($sql); //1 o 0
	}


}
 ?>