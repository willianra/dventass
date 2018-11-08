 <?php 
session_start();
require_once "../modelos/Producto.php";

$producto=new Producto();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$productoid=isset($_POST["productoid"])? limpiarCadena($_POST["productoid"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$precioCompra=isset($_POST["precioCompra"])? limpiarCadena($_POST["precioCompra"]):"";
$precioVenta=isset($_POST["precioVenta"])? limpiarCadena($_POST["precioVenta"]):"";
$proveedorid=isset($_POST["proveedorid"])? limpiarCadena($_POST["proveedorid"]):"";

		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora(); 
 
switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($productoid)){//
			//respuesta cero para editar
			$rspta=$producto->insertar($nombre,$precioCompra,$precioVenta,$proveedorid );
			if($rspta){
				echo "producto creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo producto :".date('Y-m-d H:i:s'));
			}else{
				echo  "producto no se pudo crear";
			}	
		}
		else {
			$rspta=$producto->editar($productoid,$nombre,$precioCompra,$precioVenta,$proveedorid );
			if($rspta){
				echo "producto editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"edito un producto :".date('Y-m-d H:i:s'));
			}else{
				echo  "producto no se pudo editar";
			}
		}
	break;

	case 'desactivar':
		$rspta=$producto->desactivar($productoid);
			if($rspta){
				echo "producto desactivado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"desactivo un producto :".date('Y-m-d H:i:s'));
			}else{
				echo  "producto no se pudo desactivar";
			}
 		break;
	break;

	case 'activar':
		$rspta=$producto->activar($productoid);
			if($rspta){
				echo "producto activado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"activo un producto :".date('Y-m-d H:i:s'));
			}else{
				echo  "producto no se pudo activar";
			}
 		break;
	break;

	case 'mostrar':
		$rspta=$producto->mostrar($productoid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$producto->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->productoid.')">Editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->productoid.')">Desactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->productoid.')">Editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->productoid.')">Activar</button>',
 				"1"=>$reg->productoid,
 				"2"=>$reg->nombre,
 				"3"=>$reg->precioCompra,
 				"4"=>$reg->precioVenta,
 				"5"=>$reg->proveedorid,
 				"6"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	case "selectTipo":
		require_once "../modelos/Proveedor.php";
		$tipo = new Proveedor();

		$rspta = $tipo->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->proveedorid . '>' . $reg->nombre . '</option>';
				}
	break;

}
?>