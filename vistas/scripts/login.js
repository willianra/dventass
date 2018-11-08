$("#frmAcceso").on('submit',function(e)
{       
    e.preventDefault();
    logina=$("#logina").val();
    clavea=$("#clavea").val();

    $.post("../ajax/usuario.php?op=verificar",
        {"logina":logina,"clavea":clavea},
        function(data)
    {    //si hay datos 
        if (data!="null")
        {//mostrar
            $(location).attr("href","home.php");            
        }
        else
        { 
            bootbox.alert("Usuario y/o Password incorrectos");
        }
    });

    
})