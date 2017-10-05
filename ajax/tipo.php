<?php 
require_once "../modelos/Tipo.php";

$tipo=new Tipo();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$tipoid=isset($_POST["tipoid"])? limpiarCadena($_POST["tipoid"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
 

switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($tipoid)){//
			//respuesta cero para editar
			$rspta=$tipo->editar($tipoid,$descripcion);
			echo $rspta ? "tipo actualizada" : "tipo no se pudo actualizar";
		}
		else {
			$rspta=$tipo->insertar($tipoid,$descripcion);
			  //respuesta 1  
			echo $rspta ? "tipo registrada" : "tipo  no se pudo registrar";
		}
	break;

	case 'desactivar':
		$rspta=$tipo->desactivar($tipoid);
 		echo $rspta ? "tipo Desactivada" : "tipo no se puede desactivar";
 		break;
	break;

	case 'activar':
		$rspta=$tipo->activar($tipoid);
 		echo $rspta ? "tipo activada" : "tipo no se puede activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$tipo->mostrar($tipoid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$tipo->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->tipoid.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->tipoid.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->tipoid.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->tipoid.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->tipoid,
 				"2"=>$reg->descripcion,
 				"3"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
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