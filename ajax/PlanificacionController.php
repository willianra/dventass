<?php 
session_start();

require_once "../modelos/Planificacion.php";

$planificacion=new Planificacion();//instanciando al modelo planificaion
 //reciviendo del formulario si existe estos objetos
$planificacionid=isset($_POST["planificacionid"])? limpiarCadena($_POST["planificacionid"]):"";
$trabajadorid=isset($_POST["trabajadorid"])? limpiarCadena($_POST["trabajadorid"]):"";
$cantidadPaqueteEstimado=isset($_POST["cantidadPaqueteEstimado"])? limpiarCadena($_POST["cantidadPaqueteEstimado"]):"";
$fechaInicio=isset($_POST["fechaInicio"])? limpiarCadena($_POST["fechaInicio"]):"";
$fechaFin=isset($_POST["fechaFin"])? limpiarCadena($_POST["fechaFin"]):"";
$almacenid=isset($_POST["almacenid"])? limpiarCadena($_POST["almacenid"]):"";

		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora(); 
 
switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($planificacionid)){
			//respuesta cero para editar
			$rspta=$planificacion->insertar($trabajadorid,$cantidadPaqueteEstimado,$fechaInicio,$fechaFin,$almacenid);
			if($rspta){
				echo "planificacion creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo planificacion :".date('Y-m-d H:i:s'));
			}else{
				echo  "planificacion no se pudo crear";
			}	

			
		}	else {
			$rspta=$planificacion->editar($planificacionid,$trabajadorid,$cantidadPaqueteEstimado,$fechaInicio,$fechaFin,$almacenid );
			if($rspta){
				echo "planificacion editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"edito un planificacion :".date('Y-m-d H:i:s'));
			}else{
				echo  "planificacion no se pudo editar";
			}
		}
	break;

	case 'desactivar':
		$rspta=$planificacion->desactivar($planificacionid);
			if($rspta){
				echo "planificacion desactivado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"desactivado un planificacion :".date('Y-m-d H:i:s'));
			}else{
				echo  "planificacion no se pudo desactivado";
			}
 		break;
	break;

	case 'activar':
		$rspta=$planificacion->activar($planificacionid);
			if($rspta){
				echo "planificacion activada";
				$bitacora->insertar(intval($_SESSION['idusuario']),"activo un planificacion :".date('Y-m-d H:i:s'));
			}else{
				echo  "planificacion no se pudo activar";
			}
 		break;
	break;

	case 'mostrar':
		$rspta=$planificacion->mostrar($planificacionid);
 		//Codificar el resultado utilizando jstrabajadorid
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
        $rspta=$planificacion->listar();
 		//Vamos a declarar un arrayssss
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->planificacionid.')">Editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->planificacionid.')">Desactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->planificacionid.')">Editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->planificacionid.')">Activar</button>',
 				"1"=>$reg->planificacionid,
 				"2"=>$reg->trabajadorid,
 				"3"=>$reg->cantidadPaqueteEstimado,
 				"4"=>$reg->fechaInicio,
 				"5"=>$reg->fechaFin,
 				"6"=>$reg->almacenid,
 				"7"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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

	case "selectAlmacen":
		require_once "../modelos/Almacen.php";
		$almacen = new Almacen();

		$rspta = $almacen->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->almacenid . '>' . $reg->departamento . '</option>';
				}
	break;

}
?>