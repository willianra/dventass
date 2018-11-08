var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
}

//Función limpia los formularios de la categoria
function limpiar()
{
	$("#empresaid").val(""); 
	$("#nroPatronal").val("");
	$("#razonSocial").val("");
	$("#nombreComercial").val("");
	$("#tipoEmpresa").val("");

}

//Función mostrar formulario de registro
function mostrarform(flag)
{
	limpiar();
	if (flag) // si es verdadero  muestra el formulari
	{
		$("#listadoregistros").hide();//nombre del div
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
					url: '../ajax/EmpresaController.php?op=listar',//accedi9endo
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
		url: "../ajax/EmpresaController.php?op=guardaryeditar",
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

function mostrar(empresaid)
{											//variable a enviar  valor enviado 
	$.post("../ajax/EmpresaController.php?op=mostrar",{empresaid : empresaid}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#empresaid").val(data.empresaid);
		$("#nroPatronal").val(data.nroPatronal);
 		$("#razonSocial").val(data.razonSocial);
 		$("#nombreComercial").val(data.nombreComercial);
 		$("#tipoEmpresa").val(data.tipoEmpresa);

 	})
}

//Función para desactivar registros
function desactivar(empresaid)
{
	bootbox.confirm("¿Está Seguro de desactivar la empresa?", function(result){
		if(result)
        {
        	$.post("../ajax/EmpresaController.php?op=desactivar", {empresaid : empresaid}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(empresaid)
{
	bootbox.confirm("¿Está Seguro de activar la empresa?", function(result){
		if(result)
        {
        	$.post("../ajax/EmpresaController.php?op=activar", {empresaid : empresaid}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();