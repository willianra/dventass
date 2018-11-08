<?php 
session_start();
//this is the bitacora

require_once "../modelos/Avala.php";
$avala=new Avala();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$avalaid=isset($_POST["avalaid"])? limpiarCadena($_POST["avalaid"]):"";
$personaid=isset($_POST["personaid"])? limpiarCadena($_POST["personaid"]):"";
$planificacionid=isset($_POST["planificacionid"])? limpiarCadena($_POST["planificacionid"]):"";

		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora(); 
 
switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($avalaid)){
			//respuesta cero para editar
			//$avalaid = getNeId
			$rspta=$avala->insertar($personaid,$planificacionid);
			if($rspta){
				echo "avala creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo avala :".date('Y-m-d H:i:s'));
			}else{
				echo  "avala no se pudo crear";
			}	
         
		}else {

			$rspta=$avala->editar($avalaid,$personaid,$planificacionid );
			if($rspta){
				echo "avala editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"edito un avala :".date('Y-m-d H:i:s'));
			}else{
				echo  "avala no se pudo editar";
			}
		}
	break;

	case 'desactivar':
		$rspta=$avala->desactivar($avalaid);
			if($rspta){
				echo "avala desactivado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"desactivado un avala :".date('Y-m-d H:i:s'));
			}else{
				echo  "avala no se pudo desactivado";
			}

 		break;
	break;

	case 'activar':
		$rspta=$avala->activar($avalaid);
			if($rspta){
				echo "avala activado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"activo un avala :".date('Y-m-d H:i:s'));
			}else{
				echo  "avala no se pudo activar";
			}
          //...........................
 		break;
	break;

	case 'mostrar':
		$rspta=$avala->mostrar($avalaid); 
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$avala->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->avalaid.')">Editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->avalaid.')">Desactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->avalaid.')">Editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->avalaid.')">Activar</button>',
 				"1"=>$reg->personaid,
 				"2"=>$reg->planificacionid,
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
		require_once "../modelos/Planificacion.php";
		$planificacion = new Planificacion();

		$rspta = $planificacion->select();

		while ($reg = $rspta->fetch_object())
				{
					
					echo '<option value=' . $reg->planificacionid . '>'.$reg->planificacionid. '</option>';
				}
	break;

}
?>