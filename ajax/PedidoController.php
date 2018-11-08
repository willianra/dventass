<?php 
session_start();
require_once "../modelos/Pedido.php";

$pedido=new Pedido();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$pedidoid=isset($_POST["pedidoid"])? limpiarCadena($_POST["pedidoid"]):"";
$fechaEntrega=isset($_POST["fechaEntrega"])? limpiarCadena($_POST["fechaEntrega"]):"";
$cantidad=isset($_POST["cantidad"])? limpiarCadena($_POST["cantidad"]):"";
$vigencia=isset($_POST["vigencia"])? limpiarCadena($_POST["vigencia"]):"";
$almacenid=isset($_POST["almacenid"])? limpiarCadena($_POST["almacenid"]):"";
$productoid=isset($_POST["productoid"])? limpiarCadena($_POST["productoid"]):"";

		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora(); 
 
switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($pedidoid)){//
			//respuesta cero para editar
			$rspta=$pedido->insertar($fechaEntrega,$cantidad,$vigencia,$almacenid,$productoid);
			if($rspta){
				echo "pedido creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo pedido :".date('Y-m-d H:i:s'));
			}else{
				echo  "pedido no se pudo crear";
			}	
		}
		else {
			$rspta=$pedido->editar($pedidoid,$fechaEntrega,$cantidad,$vigencia,$almacenid,$productoid );
			if($rspta){
				echo "pedido editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"edito un pedido :".date('Y-m-d H:i:s'));
			}else{
				echo  "pedido no se pudo editar";
			}
		}
	break;

	case 'desactivar':
		$rspta=$pedido->desactivar($pedidoid);
			if($rspta){
				echo "pedido desactivado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"desactivo un pedido :".date('Y-m-d H:i:s'));
			}else{
				echo  "pedido no se pudo desactivar";
			}
 		break;
	break;

	case 'activar':
		$rspta=$pedido->activar($pedidoid);
			if($rspta){
				echo "pedido activado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"activo un pedido :".date('Y-m-d H:i:s'));
			}else{
				echo  "pedido no se pudo activar";
			}
 		break;
	break;

	case 'mostrar':
		$rspta=$pedido->mostrar($pedidoid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$pedido->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->pedidoid.')">Editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->pedidoid.')">Desactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->pedidoid.')">Editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->pedidoid.')">Activar</button>',
 				"1"=>$reg->pedidoid,
 				"2"=>$reg->fechaEntrega,
 				"3"=>$reg->cantidad,
 				"4"=>$reg->vigencia,
 				"5"=>$reg->almacenid,
 				"6"=>$reg->productoid,
 				"7"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	case "selectProducto":
		require_once "../modelos/Producto.php";
		$tipo = new Producto();

		$rspta = $tipo->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->productoid . '>' . $reg->nombre . '</option>';
				}
	break;

	case "selectAlmacen":
		require_once "../modelos/Almacen.php";
		$tipo = new Almacen();

		$rspta = $tipo->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->almacenid . '>' . $reg->departamento . '</option>';
				}
	break;

}
?> 