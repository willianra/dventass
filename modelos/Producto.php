 <?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class producto{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($nombre,$precioCompra,$precioVenta,$proveedorid)
	{
		$sql="INSERT INTO producto (nombre,precioCompra,precioVenta,proveed,estado)
		VALUES ('$nombre','$precioCompra','$precioVenta','$proveedorid','1')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($productoid,$nombre,$precioCompra,$precioVenta,$proveedorid)
	{

		$sql="UPDATE producto SET productoid='$productoid',nombre='$nombre',precioCompra='$precioCompra',precioVenta='$precioVenta'
		,proveedorid='$proveedorid'
		WHERE productoid='$productoid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la estado
	public function desactivar($productoid)

	{
		 $sql="UPDATE producto SET estado='0' WHERE productoid='$productoid'";
		return ejecutarConsulta($sql); //1 o 0
	}

	public function activar ($productoid)
	{
		$sql="UPDATE producto SET estado='1' WHERE productoid='$productoid'";
		return ejecutarConsulta($sql); 
	}
  //muestra un tupla 
	public function mostrar($productoid)
	{

		$sql="SELECT * FROM producto WHERE productoid='$productoid'";
		return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT * FROM producto ";
		return ejecutarConsulta($sql); //1 o 0
	}
	  public function select()//mostrar todos los registros
	{
		$sql="SELECT * FROM producto WHERE estado=1";
		return ejecutarConsulta($sql); //1 o 0
	}


}
 ?>