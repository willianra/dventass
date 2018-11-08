 <?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['planificacion']==1)
{
?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    
                    <div class="box-header with-border">
                          <h1 class="box-title">Gestionar Planificacion       

                            <button class="btn btn-success" 
                            id="btnagregar" onclick="mostrarform(true)"><i
                            class="fa fa-plus-circle"></i> CREAR</button>

                          </h1>
                        <div class="box-tools pull-right">
                        </div>

                    </div>
                   
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoplanificacion">
                        <table id="tbllistado" 
                        class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Planificaion id</th>
                            <th>trabajadorid</th> 
                            <th>CantPaqueEstimado</th>
                            <th>fechaInicio</th>
                            <th>FechaFin</th>
                            <th>almacenid</th>
                            <th>estado</th>
                          </thead>
                          <tbody> 

                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Planificaion id</th>
                            <th>trabajadorid</th>
                            <th>CantPaqueEstimado</th>
                            <th>fechaInicio</th>
                            <th>FechaFin</th>
                            <th>almacenid</th>
                            <th>estado</th>

                          </tfoot>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 400px;"
                     id="formularioregistros">
                        <form name="formulario" 
                        id="formulario" method="POST">
                         <!--div responsivo-->
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>trabajadorid:</label>
                          <input type="hidden" name="planificacionid" id="planificacionid">
                            <input type="number" class="form-control" name="trabajadorid" id="trabajadorid" maxlength="11" 
                            placeholder="codigo del trabajador" required>
                          </div>
                                                                              
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>cantidad paquete estimado:</label>
                            <input type="number" class="form-control"
                             name="cantidadPaqueteEstimado" id="cantidadPaqueteEstimado" 
                             maxlength="256" 
                             placeholder="cantidad paquete estimado">
                          </div>
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>fechaInicio:</label>
                            <input type="date" class="form-control"
                             name="fechaInicio" id="fechaInicio" 
                             maxlength="256" 
                             placeholder="fecha de inicio">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>fechaFin:</label>
                            <input type="date" class="form-control"
                             name="fechaFin" id="fechaFin" 
                             maxlength="256" 
                             placeholder="fechaFin">
                          </div>
                         
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>almacenid(*):</label>
                            <select id="almacenid" name="almacenid" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>
              
              
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                             <!--buton de tipo submit el cual envia el formulario por el metodo por ajax   -->
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          <button class="btn btn-info" onclick="Imprimir()" type="button"><i class="fa fa-print"></i> Imprimir</button>
                         
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}
 
require 'footer.php';
?>
<script type="text/javascript" src="scripts/planificacion.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>

<?php 
}
ob_end_flush();

 ?>