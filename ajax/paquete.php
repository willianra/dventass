<?php 
require_once "../modelos/Paquete.php";

$paquete=new Paquete();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$paqueteid=isset($_POST["paqueteid"])? limpiarCadena($_POST["paqueteid"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$color=isset($_POST["color"])? limpiarCadena($_POST["color"]):"";

switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($paqueteid)){//
			//respuesta cero para editar
			$rspta=$paquete->editar($paqueteid,$descripcion,$color);
			echo $rspta ? "Paquete actualizada" : "Paquete no se pudo actualizar";
		}
		else {
			$rspta=$paquete->insertar($paqueteid,$descripcion,$color);
			  //respuesta 1  
			echo $rspta ? "Paquete registrada" : "Paquete  no se pudo registrar";
		}
	break;

	case 'desactivar':
		$rspta=$paquete->desactivar($paqueteid);
 		echo $rspta ? "Paquete Desactivada" : "Paquete no se puede desactivar";
 		break;
	break;

	case 'activar':
		$rspta=$paquete->activar($paqueteid);
 		echo $rspta ? "Paquete activada" : "Paquete no se puede activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$paquete->mostrar($paqueteid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$paquete->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->paqueteid.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->paqueteid.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->paqueteid.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->paqueteid.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->paqueteid,
 				"2"=>$reg->descripcion,
 				"3"=>$reg->color,
 				"4"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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