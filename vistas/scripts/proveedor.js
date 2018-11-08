
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
		//Cargamos los items al select categoria

}

//Función limpia los formularios de la categoria
function limpiar()
{
	$("#proveedorid").val(""); 
	$("#nombre").val("");
	$("#departamento").val("");
	$("#direccion").val("");
	$("#telefono").val("");
 	$("#email").val("");

}

//Función mostrar formulario de registro
function mostrarform(flag)
{
	limpiar();
	if (flag) // si es verdadero  muestra el formulari
	{
		$("#listadoregistros").hide();//precioCompra del div
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();//muestra el fomulario
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
				{//obteniedo datos por get en la variable op
					url: '../ajax/ProveedorController.php?op=listar',//accedi9endo
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
		url: "../ajax/ProveedorController.php?op=guardaryeditar",
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

function mostrar(proveedorid)
{											//variable a enviar  valor enviado 
	$.post("../ajax/ProveedorController.php?op=mostrar",{proveedorid : proveedorid}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#proveedorid").val(data.proveedorid);
		$("#nombre").val(data.nombre);
		$("#departamento").val(data.departamento);
 		$("#direccion").val(data.direccion);
 		$("#telefono").val(data.telefono);
 		$("#email").val(data.email); 

 	})
}

//Función para desactivar registros
function desactivar(proveedorid)
{
	bootbox.confirm("¿Está Seguro de desactivar el proveedor?", function(result){
		if(result)
        {
        	$.post("../ajax/ProveedorController.php?op=desactivar", {proveedorid : proveedorid}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(proveedorid)
{
	bootbox.confirm("¿Está Seguro de activar el proveedor?", function(result){
		if(result)
        {
        	$.post("../ajax/ProveedorController.php?op=activar", {proveedorid : proveedorid}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();