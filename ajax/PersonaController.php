<?php 
session_start();

require_once "../modelos/Persona.php";

$persona=new Persona();//instanciando al modelo categoria
 //reciviendo del formulario si existe estos objetos
$personaid=isset($_POST["personaid"])? limpiarCadena($_POST["personaid"]):"";
$ci=isset($_POST["ci"])? limpiarCadena($_POST["ci"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$paterno=isset($_POST["paterno"])? limpiarCadena($_POST["paterno"]):"";
$materno=isset($_POST["materno"])? limpiarCadena($_POST["materno"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$tipoid=isset($_POST["tipoid"])? limpiarCadena($_POST["tipoid"]):"";

		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora();

switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($personaid)){
			//respuesta cero para editar
			//$personaid = getNeId
			$rspta=$persona->insertar($ci,$nombre,$paterno,$materno,$direccion,$telefono,$email,$tipoid);
			if($rspta){
				echo "persona creada";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo persona :".date('Y-m-d H:i:s'));
			}else{
				echo  "persona no se pudo crear";
			}	
         
		}else {

			$rspta=$persona->editar($personaid,$ci,$nombre,$paterno,$materno,$direccion,$telefono,$email,$tipoid);
			if($rspta){
				echo "persona modificada";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se modifico una persona :".date('Y-m-d H:i:s'));
			}else{
				echo  "persona no se pudo modificar";
			}
		}
	break;

	case 'desactivar':
		$rspta=$persona->desactivar($personaid);
			if($rspta){
				echo "Persona desactivada";
				$bitacora->insertar(intval($_SESSION['idusuario']),"desactivo un Persona :".date('Y-m-d H:i:s'));
			}else{
				echo  "Persona no se pudo desactivar";
			}

 		break;
	break;

	case 'activar':
		$rspta=$persona->activar($personaid);
			if($rspta){
				echo "Persona activada";
				$bitacora->insertar(intval($_SESSION['idusuario']),"activo un Persona :".date('Y-m-d H:i:s'));
			}else{
				echo  "Persona no se pudo activar";
			}
          //...........................
 		break;
	break;

	case 'mostrar':
		$rspta=$persona->mostrar($personaid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$persona->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->personaid.')">Editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->personaid.')">Desactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->personaid.')">Editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->personaid.')">ACtivar</button>',
 				"1"=>$reg->personaid,
 				"2"=>$reg->ci,
 				"3"=>$reg->nombre,
 				"4"=>$reg->paterno,
 				"5"=>$reg->materno,
 				"6"=>$reg->direccion,
 				"7"=>$reg->telefono,
 				"8"=>$reg->email,
 				"9"=>$reg->tipoid,
 				"10"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':
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
		require_once "../modelos/Tipo.php";
		$tipo = new Tipo();

		$rspta = $tipo->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->tipoid . '>' . $reg->descripcion . '</option>';
				}
	break;

}
?>