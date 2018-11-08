<?php 
session_start();

require_once "../modelos/Proveedor.php";

$proveedor=new Proveedor();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$proveedorid=isset($_POST["proveedorid"])? limpiarCadena($_POST["proveedorid"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$departamento=isset($_POST["departamento"])? limpiarCadena($_POST["departamento"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
	
		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora(); 	
 
switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($proveedorid)){
			//respuesta cero para editar
			//$proveedorid = getNeId
			$rspta=$proveedor->insertar($nombre,$departamento,$direccion,$telefono,$email);
			if($rspta){
				echo "proveedor creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo proveedor :".date('Y-m-d H:i:s'));
			}else{
				echo  "proveedor no se pudo crear";
			}	
         
		}else {

			$rspta=$proveedor->editar($proveedorid,$nombre,$departamento,$direccion,$telefono,$email);
			if($rspta){
				echo "proveedor editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"edito un proveedor :".date('Y-m-d H:i:s'));
			}else{
				echo  "proveedor no se pudo editar";
			}
		}
	break;

	case 'desactivar':
		$rspta=$proveedor->desactivar($proveedorid);
			if($rspta){
				echo "proveedor desactivado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"desactivo un proveedor :".date('Y-m-d H:i:s'));
			}else{
				echo  "proveedor no se pudo desactivar";
			}

 		break;
	break;

	case 'activar':
		$rspta=$proveedor->activar($proveedorid);
			if($rspta){
				echo "proveedor activado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"activo un proveedor :".date('Y-m-d H:i:s'));
			}else{
				echo  "proveedor no se pudo activar";
			}
          //...........................
 		break;
	break;

	case 'mostrar':
		$rspta=$proveedor->mostrar($proveedorid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$proveedor->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->proveedorid.')">Editar</i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->proveedorid.')">Desactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->proveedorid.')">Editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->proveedorid.')">Activar</button>',
 				"1"=>$reg->proveedorid,
 				"2"=>$reg->nombre,
 				"3"=>$reg->departamento,
 				"4"=>$reg->direccion,
 				"5"=>$reg->telefono,
 				"6"=>$reg->email,
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

	// case "selectproveedor":
	// 	require_once "../modelos/Avala.php";
	// 	$proveedor = new proveedor();

	// 	$rspta = $proveedor->select();

	// 	while ($reg = $rspta->fetch_object())
	// 			{
	// 				echo '<option value=' . $reg . '>' . $reg->descripcion . '</option>';
	// 			}
	// break;

}
?>