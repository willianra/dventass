 <?php 
//todos los modelos con mayuscula
require "../config/Conexion.php";
 
Class Detallepaquete{

  //constructor
	public function __construct()
	{


	}
	//metodo para insertar registros
		public function insertar($paqueteid,$productoid,$cantidad)
	{
		$sql="INSERT INTO detallepaquete(paqueteid,productoid,cantidad)
		VALUES ('$paqueteid','$productoid','$cantidad')";
		return ejecutarConsulta($sql); //retorna 1 si la ejecucion fue correcta
	}
    //metodo para editar registro categoria funcion js 
        public function editar($detallepaqueteid ,$paqueteid,$productoid,$cantidad)
	{

		$sql="UPDATE detallepaquete SET productoid='$productoid',paqueteid='$paqueteid',cantidad='$cantidad'
		WHERE detallepaqueteid='$detallepaqueteid'";
		return ejecutarConsulta($sql);
	}
     
     //eliminar categoria solo desactiva  la condicion
	public function mostrar($detallepaqueteid)
	{

		$sql="SELECT * FROM detallepaquete WHERE detallepaqueteid='$detallepaqueteid'";
		return ejecutarConsultasimplefila($sql);//retorna valores  
	}
	//sirve para obtener todas las tuplas de la tabla categoria
	public function listar()//mostrar todos los registros
	{
		$sql="SELECT * FROM detallepaquete ";
		return ejecutarConsulta($sql); //1 o 0
	}
	
}
 ?>