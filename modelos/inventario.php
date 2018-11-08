 <?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class inventario{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($productoid,$almacenid,$stock)
	{
		$sql="INSERT INTO inventario(productoid,almacenid,stock)
		VALUES ('$productoid','$almacenid','$stock')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($inventarioid ,$productoid,$almacenid,$stock)
	{
		$sql="UPDATE inventario SET productoid='$productoid',almacenid='$almacenid',stock='$stock'
		WHERE inventarioid='$inventarioid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la condicion
	public function mostrar($inventarioid)
	{

		$sql="SELECT * FROM inventario WHERE inventarioid='$inventarioid'";
		return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT * FROM inventario ";
		return ejecutarConsulta($sql); //1 o 0
	}
	
}
 ?>