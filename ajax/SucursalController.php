<?php 
session_start();
require_once "../modelos/Sucursal.php";

$sucursal=new Sucursal();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$sucursalid=isset($_POST["sucursalid"])? limpiarCadena($_POST["sucursalid"]):"";
$departamento=isset($_POST["departamento"])? limpiarCadena($_POST["departamento"]):"";
$municipio=isset($_POST["municipio"])? limpiarCadena($_POST["municipio"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$fax=isset($_POST["fax"])? limpiarCadena($_POST["fax"]):"";
$empresaid=isset($_POST["empresaid"])? limpiarCadena($_POST["empresaid"]):"";
 
		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora();

switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($sucursalid)){//
			//respuesta cero para editar
			$rspta=$sucursal->insertar($departamento,$municipio,$direccion,$telefono,$fax,$empresaid);
			if($rspta){
				echo "sucursal creada";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nueva sucursal :".date('Y-m-d H:i:s'));
			}else{
				echo  "sucursal no se pudo crear";
			}			
		}
		else {
			$rspta=$sucursal->editar($sucursalid,$departamento,$municipio,$direccion,$telefono,$fax,$empresaid);
			if($rspta){
				echo "sucursal editada";
				$bitacora->insertar(intval($_SESSION['idusuario']),"edito una sucursal :".date('Y-m-d H:i:s'));
			}else{
				echo  "sucursal no se pudo editar";
			}				
		}
	break;

	case 'desactivar':
		$rspta=$sucursal->desactivar($sucursalid);
			if($rspta){
				echo "sucursal desactivada";
				$bitacora->insertar(intval($_SESSION['idusuario']),"desactivo una sucursal :".date('Y-m-d H:i:s'));
			}else{
				echo  "sucursal no se pudo desactivar";
			}	
 		break;
	break;

	case 'activar':
		$rspta=$sucursal->activar($sucursalid);
			if($rspta){
				echo "sucursal activada";
				$bitacora->insertar(intval($_SESSION['idusuario']),"activo una sucursal :".date('Y-m-d H:i:s'));
			}else{
				echo  "sucursal no se pudo activar";
			}	
 		break;
	break;

	case 'mostrar':
		$rspta=$sucursal->mostrar($sucursalid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$sucursal->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->sucursalid.')">Editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->sucursalid.')">Desactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->sucursalid.')">Editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->sucursalid.')">Activar</button>',
 				"1"=>$reg->sucursalid, 				
 				"2"=>$reg->departamento,
 				"3"=>$reg->municipio,
 				"4"=>$reg->direccion,
 				"5"=>$reg->telefono,
 				"6"=>$reg->fax,
 				"7"=>$reg->empresaid,
 				"8"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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