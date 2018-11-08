<?php 
session_start();

require_once "../modelos/Paquete.php";

$paquete=new Paquete();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$paqueteid=isset($_POST["paqueteid"])? limpiarCadena($_POST["paqueteid"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$color=isset($_POST["color"])? limpiarCadena($_POST["color"]):"";
		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora(); 

switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($paqueteid)){//
			//respuesta cero para editar
			$rspta=$paquete->insertar($descripcion,$color);
			if($rspta){
				echo "paquete creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo paquete :".date('Y-m-d H:i:s'));
			}else{
				echo  "paquete no se pudo crear";
			}	
		}
		else {
			$rspta=$paquete->editar($paqueteid,$descripcion,$color);
			if($rspta){
				echo "paquete editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"edito un paquete :".date('Y-m-d H:i:s'));
			}else{
				echo  "paquete no se pudo editar";
			}
		}
	break;

	case 'desactivar':
		$rspta=$paquete->desactivar($paqueteid);
			if($rspta){
				echo "paquete desactivado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"desactivo un paquete :".date('Y-m-d H:i:s'));
			}else{
				echo  "paquete no se pudo desactivar";
			}
 		break;
	break;

	case 'activar':
		$rspta=$paquete->activar($paqueteid);
			if($rspta){
				echo "paquete activado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"activo un paquete :".date('Y-m-d H:i:s'));
			}else{
				echo  "paquete no se pudo activar";
			}

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
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->paqueteid.')">Editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->paqueteid.')">Desactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->paqueteid.')">Editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->paqueteid.')">Activar</button>',
 				"1"=>$reg->paqueteid,
 				"2"=>$reg->descripcion,
 				"3"=>$reg->color,
 				"4"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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