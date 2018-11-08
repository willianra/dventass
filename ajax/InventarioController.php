<?php 
session_start();
//this is the bitacora
require_once "../modelos/inventario.php";

$inventario=new inventario();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$inventarioid=isset($_POST["inventarioid"])? limpiarCadena($_POST["inventarioid"]):"";
$productoid=isset($_POST["productoid"])? limpiarCadena($_POST["productoid"]):"";
$almacenid=isset($_POST["almacenid"])? limpiarCadena($_POST["almacenid"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";

		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora(); 
 
switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($inventarioid)){
			$rspta=$inventario->insertar($productoid,$almacenid,$stock);
			if($rspta){
				echo "Inventario creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo Inventario :".date('Y-m-d H:i:s'));
			}else{
				echo  "Inventario no se pudo crear";
			}	         
		}else {

			$rspta=$inventario->editar($inventarioid,$productoid,$almacenid,$stock );
			if($rspta){
				echo "Inventario editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"edito un Inventario :".date('Y-m-d H:i:s'));
			}else{
				echo  "Inventario no se pudo editar";
			}			
		}
	break;


	case 'mostrar':
		$rspta=$inventario->mostrar($inventarioid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$inventario->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->inventarioid.')">Editar</button>',
 				"1"=>$reg->productoid,
 				"2"=>$reg->almacenid,
 				"3"=>$reg->stock,
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
		require_once "../modelos/Producto.php";
		$producto = new Producto();

		$rspta = $producto->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->productoid . '>' . $reg->nombre . '</option>';
				}
	break;

	case "selectTipo2":
		require_once "../modelos/Almacen.php";
		$almacen = new Almacen();

		$rspta = $almacen->select();

		while ($reg = $rspta->fetch_object())
				{
					
					echo '<option value=' . $reg->almacenid . '>'.$reg->almacenid. '</option>';
				}
	break;

}
?>