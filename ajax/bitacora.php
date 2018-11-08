 <?php 
session_start();
require_once "../modelos/Bitacora.php";

$bitacora=new Bitacora();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$bitacoraid=isset($_POST["bitacoraid"])? limpiarCadena($_POST["bitacoraid"]):"";
$usuarioid=isset($_POST["usuarioid"])? limpiarCadena($_POST["usuarioid"]):"";
$accion=isset($_POST["accion"])? limpiarCadena($_POST["accion"]):"";
 
switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($bitacoraid)){//
			//respuesta cero para editar
			$rspta=$bitacora->insertar($usuarioid,$accion);
			echo $rspta ? "bitacora insertada" : "bitacora no se pudo insertar";
		}
		else {
			$rspta=$bitacora->editar($bitacoraid,$usuarioid,$accion);
			  //respuesta 1  
			echo $rspta ? "bitacora actualizada" : "bitacora  no se pudo actulizar";
		}
	break;
 

	case 'mostrar':
		$rspta=$bitacora->mostrar($bitacoraid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$bitacora->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 	  
 				"0"=>$reg->bitacoraid,
 				"1"=>$reg->usuarioid,
 				"2"=>$reg->accion, 
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);//array de resultados

	break;


}
?>