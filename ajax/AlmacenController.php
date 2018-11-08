<?php 
session_start();
require_once "../modelos/Almacen.php";

$almacen=new Almacen();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$almacenid=isset($_POST["almacenid"])? limpiarCadena($_POST["almacenid"]):"";
$departamento=isset($_POST["departamento"])? limpiarCadena($_POST["departamento"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora(); 

switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($almacenid)){//
			//respuesta cero para editar
			$rspta=$almacen->insertar($departamento,$direccion,$email,$telefono);
			if($rspta){
				echo "almacen creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo almacen :".date('Y-m-d H:i:s'));
			}else{
				echo  "almacen no se pudo crear";
			}	
		}
		else {
			$rspta=$almacen->editar($almacenid,$departamento,$direccion,$email,$telefono);
			if($rspta){
				echo "almacen editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"edito un almacen :".date('Y-m-d H:i:s'));
			}else{
				echo  "almacen no se pudo editar";
			}
		}
	break;

	case 'desactivar':
		$rspta=$almacen->desactivar($almacenid);
			if($rspta){
				echo "almacen desactivado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"desactivo un almacen :".date('Y-m-d H:i:s'));
			}else{
				echo  "almacen no se pudo desactivar";
			}
 		break;
	break;

	case 'activar':
		$rspta=$almacen->activar($almacenid);
			if($rspta){
				echo "almacen activado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"activo un almacen :".date('Y-m-d H:i:s'));
			}else{
				echo  "almacen no se pudo activar";
			}
 		break;
	break;

	case 'mostrar':
		$rspta=$almacen->mostrar($almacenid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$almacen->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->almacenid.')">Editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->almacenid.')">Desactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->almacenid.')">Editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->almacenid.')">Activar</button>',
 				"1"=>$reg->almacenid,
 				"2"=>$reg->departamento,
 				"3"=>$reg->direccion,
 				"4"=>$reg->email,
 				"5"=>$reg->telefono,
 				"6"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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