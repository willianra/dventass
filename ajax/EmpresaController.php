 <?php 
session_start();
require_once "../modelos/Empresa.php";

$empresa=new Empresa();//instanciando al modelo empresa
 //reciviendo del formulario si existe estos objetos
$empresaid=isset($_POST["empresaid"])? limpiarCadena($_POST["empresaid"]):"";
$nroPatronal=isset($_POST["nroPatronal"])? limpiarCadena($_POST["nroPatronal"]):"";
$razonSocial=isset($_POST["razonSocial"])? limpiarCadena($_POST["razonSocial"]):"";
$nombreComercial=isset($_POST["nombreComercial"])? limpiarCadena($_POST["nombreComercial"]):"";
$tipoEmpresa=isset($_POST["tipoEmpresa"])? limpiarCadena($_POST["tipoEmpresa"]):"";

		date_default_timezone_set('America/La_Paz');
	    require_once "../modelos/Bitacora.php";
		$bitacora = new Bitacora();
 
switch ($_GET["op"]){//operaciones q son enviados desde un js
	case 'guardaryeditar':
		if (empty($empresaid)){//
			//respuesta cero para editar
			$rspta=$empresa->insertar($nroPatronal,$razonSocial,$nombreComercial,$tipoEmpresa);
			if($rspta){
				echo "empresa creado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se creo nuevo empresa :".date('Y-m-d H:i:s'));
			}else{
				echo  "empresa no se pudo crear";
			}

		}
		else {
			$rspta=$empresa->editar($empresaid,$nroPatronal,$razonSocial,$nombreComercial,$tipoEmpresa );
			if($rspta){
				echo "empresa editado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se edito un empresa :".date('Y-m-d H:i:s'));
			}else{
				echo  "empresa no se pudo editar";
			}				  			
		}
	break;

	case 'desactivar':
		$rspta=$empresa->desactivar($empresaid);
			if($rspta){
				echo "empresa desactivado";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se desactivo un empresa :".date('Y-m-d H:i:s'));
			}else{
				echo  "empresa no se pudo desactivar";
			}		
 		break;
	break;

	case 'activar':
		$rspta=$empresa->activar($empresaid);
			if($rspta){
				echo "empresa se activo";
				$bitacora->insertar(intval($_SESSION['idusuario']),"Se desactivo un empresa :".date('Y-m-d H:i:s'));
			}else{
				echo  "empresa no se pudo activar";
			}	
 		break;
	break;

	case 'mostrar':
		$rspta=$empresa->mostrar($empresaid);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
 		break;
	break;

	case 'listar':
		$rspta=$empresa->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				//campos del la tabla categoria
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->empresaid.')">Editar</button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->empresaid.')">Desactivar</button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->empresaid.')">Editar</button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->empresaid.')">Activar</button>',
 				"1"=>$reg->empresaid,
 				"2"=>$reg->nroPatronal,
 				"3"=>$reg->razonSocial,
 				"4"=>$reg->nombreComercial,
 				"5"=>$reg->tipoEmpresa,
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
 

}
?>