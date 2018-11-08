<?php 
session_start();

require_once "../modelos/Entrega.php";

$entrega=new Entrega();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$entregaid=isset($_POST["entregaid"])? limpiarCadena($_POST["entregaid"]):"";
$fechaEntrega=isset($_POST["fechaEntrega"])? limpiarCadena($_POST["fechaEntrega"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$planificacionid=isset($_POST["planificacionid"])? limpiarCadena($_POST["planificacionid"]):"";
$paqueteid=isset($_POST["paqueteid"])? limpiarCadena($_POST["paqueteid"]):"";

		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora();

switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($entregaid)){//
			//respuesta cero para editar
			$rspta=$entrega->insertar($fechaEntrega,$cantidad,$planificacionid,$paqueteid);
			if($rspta){
				echo "Entrega creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo Entrega :".date('Y-m-d H:i:s'));
			}else{
				echo  "Entrega no se pudo crear";
			}
		}
		else {
			$rspta=$entrega->editar($entregaid,$fechaEntrega,$cantidad,$planificacionid,$paqueteid);
			if($rspta){
				echo "Entrega editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se edito un Entrega :".date('Y-m-d H:i:s'));
			}else{
				echo  "Entrega no se pudo editar";
			}	
		}
	break;

	case 'desactivar':
		$rspta=$entrega->desactivar($entregaid);
 		echo $rspta ? "entrega Desactivada" : "entrega no se puede desactivar";
 		break;
	break;

	case 'activar':
		$rspta=$entrega->activar($entregaid);
 		echo $rspta ? "entrega activada" : "entrega no se puede activar";
 		break;
	break;

	case 'mostrar':
		$rspta=$entrega->mostrar($entregaid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$entrega->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->entregaid.')">Editar</button>'.
                    '<button class="btn btn-info" id=".$reg->entregaid." ><i class="fa fa-print"></i></button>
                      <script>
                        var btn = document.getElementById(\'.$reg->entregaid.\');
                        btn.addEventListener(\'click\', function() { 
                         document.location.href = \'../pdf.php\';
                        });
                        </script>',
 				"1"=>$reg->entregaid,
 				"2"=>$reg->fechaEntrega,
 				"3"=>$reg->cantidad,
 				"4"=>$reg->planificacionid,
 				"5"=>$reg->paqueteid,
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