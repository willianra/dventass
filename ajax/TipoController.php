<?php 
session_start();
require_once "../modelos/Tipo.php";

$tipo=new Tipo();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$tipoid=isset($_POST["tipoid"])? limpiarCadena($_POST["tipoid"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
 
		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora(); 

switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($tipoid)){//
			//respuesta cero para editar
			$rspta=$tipo->insertar($descripcion);
			if($rspta){
				echo "tipo creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo tipo :".date('Y-m-d H:i:s'));
			}else{
				echo  "tipo no se pudo crear";
			}			
		}
		else {
			$rspta=$tipo->editar($tipoid,$descripcion);
			if($rspta){
				echo "tipo editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"edito un tipo :".date('Y-m-d H:i:s'));
			}else{
				echo  "tipo no se pudo editar";
			}
		}
	break;

	case 'desactivar':
		$rspta=$tipo->desactivar($tipoid);
			if($rspta){
				echo "tipo desactivado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"desactivo un tipo :".date('Y-m-d H:i:s'));
			}else{
				echo  "tipo no se pudo desactivar";
			}
 		break;
	break;

	case 'activar':
		$rspta=$tipo->activar($tipoid);
			if($rspta){
				echo "tipo activado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"activo un tipo :".date('Y-m-d H:i:s'));
			}else{
				echo  "tipo no se pudo activar";
			}
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
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->tipoid.')">Editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->tipoid.')">Desactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->tipoid.')">Editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->tipoid.')">Activar</button>',
 				"1"=>$reg->tipoid,
 				"2"=>$reg->descripcion,
 				"3"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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