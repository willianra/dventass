<?php 
session_start();
//this is the bitacora

require_once "../modelos/AlmacenPersona.php";
$almacenpersona=new almacenpersona();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$almacenpersonaid=isset($_POST["almacenpersonaid"])? limpiarCadena($_POST["almacenpersonaid"]):"";
$idpersona=isset($_POST["idpersona"])? limpiarCadena($_POST["idpersona"]):"";
$idalmacen=isset($_POST["idalmacen"])? limpiarCadena($_POST["idalmacen"]):"";
		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora(); 
 
switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($almacenpersonaid)){

			$rspta=$almacenpersona->insertar($idpersona,$idalmacen);
			if($rspta){
				echo "Personal Almacen creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo Personal Almacen :".date('Y-m-d H:i:s'));
			}else{
				echo  "Personal Almacen no se pudo crear";
			}				
         
		}else {

			$rspta=$almacenpersona->editar($almacenpersonaid,$idpersona,$idalmacen );
			if($rspta){
				echo "Personal Almacen editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"edito un Personal Almacen :".date('Y-m-d H:i:s'));
			}else{
				echo  "Personal Almacen no se pudo editar";
			}			
		}
	break;

	case 'desactivar':
		$rspta=$almacenpersona->desactivar($almacenpersonaid);
			if($rspta){
				echo "Personal Almacen desactivado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"desactivo un Personal Almacen :".date('Y-m-d H:i:s'));
			}else{
				echo  "Personal Almacen no se pudo desactivar";
			}
 		break;
	break;

	case 'activar':
		$rspta=$almacenpersona->activar($almacenpersonaid);
			if($rspta){
				echo "Personal Almacen activado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"activo un Personal Almacen :".date('Y-m-d H:i:s'));
			}else{
				echo  "Personal Almacen no se pudo activar";
			}
          //...........................
 		break;
	break;

	case 'mostrar':
		$rspta=$almacenpersona->mostrar($almacenpersonaid); 
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$almacenpersona->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->almacenpersonaid.')">Editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->almacenpersonaid.')">Desactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->almacenpersonaid.')">Editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->almacenpersonaid.')">Activar</button>',
 				"1"=>$reg->idpersona,
 				"2"=>$reg->idalmacen,
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

	case "selectTipo1":
		require_once "../modelos/Persona.php";
		$persona = new Persona();

		$rspta = $persona->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->personaid . '>' . $reg->personaid . '</option>';
				}
	break;

	case "selectTipo2":
		require_once "../modelos/Almacen.php";
		$planificacion = new Almacen();

		$rspta = $planificacion->select();

		while ($reg = $rspta->fetch_object())
				{
					
					echo '<option value=' . $reg->almacenid . '>'.$reg->almacenid. '</option>';
				}
	break;

}
?>