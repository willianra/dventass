 

function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
		//Cargamos los items al select categoria
	$.post("../ajax/PlanificacionController.php?op=selectAlmacen", function(r){
	            $("#almacenid").html(r);
	            $('#almacenid').selectpicker('refresh');

	});
	$("#imagenmuestra").hide();

}

//Función limpia los formularios de la categoria
function limpiar()
{
	$("#planificacionid").val(""); 
	$("#trabajadorid").val("");
	$("#cantidadPaqueteEstimado").val("");
	$("#fechaInicio").val("");
	$("#fechaFin").val("");
	$("#almacenid").val("");
}

//Función mostrar formulario de registro
function mostrarform(flag)
{
	limpiar();
	if (flag) // si es verdadero  muestra el formulari
	{
		$("#listadoplanificacion").hide();// del div
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoplanificacion").show();//muestra el fomulario
		$("#formularioregistros").hide();//oculta el formulario
		$("#btnagregar").show();
	}
}

//Función cancelarform oculta el fomulario de registro 
function cancelarform()
{
	limpiar(); //limpia el formulario
	mostrarform(false);
}

//Función Listar
function listar()
{//ide del formulari '#tbllistado' tabla de l html
	//data table es un libreria 
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    // para exportar alos diferencte tipos de archivos
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax": //parametro
				{//obteniedo datos por get en la variable op $_SESSION["nombre"]
					url: "../ajax/PlanificacionController.php?op=listar",
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);//si esque hay error	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//cantidad Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden descendente)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/PlanificacionController.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}
function mostrar(planificacionid)
{											//variable a enviar  valor enviado 
	$.post("../ajax/PlanificacionController.php?op=mostrar",{planificacionid : planificacionid}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#planificacionid").val(data.planificacionid);
		$("#trabajadorid").val(data.trabajadorid);
 		$("#cantidadPaqueteEstimado").val(data.cantidadPaqueteEstimado);
 		$("#fechaInicio").val(data.fechaInicio);
 		$("#fechaFin").val(data.fechaFin);
 		$("#almacenid").val(data.almacenid);
 	})
}

//Función para desactivar registros
function desactivar(planificacionid)
{
	bootbox.confirm("¿Está Seguro de desactivar la planificacion?", function(result){
		if(result)
        {
        	$.post("../ajax/PlanificacionController.php?op=desactivar", {planificacionid : planificacionid}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(planificacionid)
{
	bootbox.confirm("¿Está Seguro de activar la planificacion?", function(result){
		if(result)
        {
        	$.post("../ajax/PlanificacionController.php?op=activar", {planificacionid : planificacionid}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function Imprimir()
{
	$("#formularioregistros").printArea();
}

init();