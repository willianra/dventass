<?php 
session_start();
//this is the bitacora
require_once "../modelos/Detallepaquete.php";

$detallepaquete=new Detallepaquete();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$detallepaqueteid=isset($_POST["detallepaqueteid"])? limpiarCadena($_POST["detallepaqueteid"]):"";
$paqueteid=isset($_POST["paqueteid"])? limpiarCadena($_POST["paqueteid"]):"";
$productoid=isset($_POST["productoid"])? limpiarCadena($_POST["productoid"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";

		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora(); 
 
switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($detallepaqueteid)){
			$rspta=$detallepaquete->insertar($paqueteid,$productoid,$cantidad);
			if($rspta){
				echo "Detalle de paquete creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo Detalle de paquete :".date('Y-m-d H:i:s'));
			}else{
				echo  "Detalle de paquete no se pudo crear";
			}	         
		}else {

			$rspta=$detallepaquete->editar($detallepaqueteid,$paqueteid,$productoid,$cantidad );
			if($rspta){
				echo "Detalle de paquete editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"edito un Detalle de paquete :".date('Y-m-d H:i:s'));
			}else{
				echo  "Detalle de paquete no se pudo editar";
			}			
		}
	break;


	case 'mostrar':
		$rspta=$detallepaquete->mostrar($detallepaqueteid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$detallepaquete->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->detallepaqueteid.')">Editar</button>',
 				"1"=>$reg->detallepaqueteid,
 				"2"=>$reg->paqueteid,
 				"3"=>$reg->productoid,
 				"4"=>$reg->cantidad,
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
		require_once "../modelos/Paquete.php";
		$paquete = new Paquete();

		$rspta = $paquete->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->paqueteid . '>' . $reg->descripcion . '</option>';
				}
	break;

	case "selectTipo2":
		require_once "../modelos/Producto.php";
		$producto = new Producto();

		$rspta = $producto->select();

		while ($reg = $rspta->fetch_object())
				{
					
					echo '<option value=' . $reg->productoid . '>'.$reg->nombre. '</option>';
				}
	break;

}
?>