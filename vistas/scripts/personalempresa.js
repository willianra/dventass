
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
		//Cargamos los items al select categoria
	$.post("../ajax/PersonalEmpresaController.php?op=selectTipo1", function(r){
	            $("#idpersona").html(r);
	            $('#idpersona').selectpicker('refresh');

	});

	$.post("../ajax/PersonalEmpresaController.php?op=selectTipo2", function(r){
	            $("#idsucursal").html(r);
	            $('#idsucursal').selectpicker('refresh');

	});
	$("#imagenmuestra").hide();

}

//Función limpia los formularios de la categoria
function limpiar()
{
	$("#personalsucursalid").val(""); 
	$("#idpersona").val("");
	$("#idsucursal").val("");


}

//Función mostrar formulario de registro
function mostrarform(flag)
{
	limpiar();
	if (flag) // si es verdadero  muestra el formulari
	{
		$("#listadopersonalEmpresa").hide();//idpersona del div
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadopersonalEmpresa").show();//muestra el fomulario
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
					url: '../ajax/PersonalEmpresaController.php?op=listar',//accedi9endo
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
		url: "../ajax/PersonalEmpresaController.php?op=guardaryeditar",
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

function mostrar(personalsucursalid)
{											//variable a enviar  valor enviado 
	$.post("../ajax/PersonalEmpresaController.php?op=mostrar",{personalsucursalid : personalsucursalid}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#personalsucursalid").val(data.personalsucursalid);
		$("#idpersona").val(data.idpersona);
 		$("#idsucursal").val(data.idsucursal); 		 

 	})
}

//Función para desactivar registros
function desactivar(personalsucursalid)
{
	bootbox.confirm("¿Está Seguro de desactivar el personal de Empresa?", function(result){
		if(result)
        {
        	$.post("../ajax/PersonalEmpresaController.php?op=desactivar", {personalsucursalid : personalsucursalid}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(personalsucursalid)
{
	bootbox.confirm("¿Está Seguro de activar el personal de Empresa?", function(result){
		if(result)
        {
        	$.post("../ajax/PersonalEmpresaController.php?op=activar", {personalsucursalid : personalsucursalid}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();