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
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    
                    <div class="box-header with-border">
                          <h1 class="box-title">Gestionar Entrega
                            <button class="btn btn-success" 
                            id="btnagregar" onclick="mostrarform(true)"><i
                            class="fa fa-plus-circle"></i> CREAR</button>
                              <button class="btn btn-success"
                                      id="btnprint" "><i
                                          class="fa fa-plus-circle"
                              ></i> REPORTE DIARIO</button>
                              <script>
                                  var btn = document.getElementById('btnprint');
                                  btn.addEventListener('click', function() {
                                      document.location.href = '../reporte_diaria.php';
                                  });
                              </script>

                          </h1>
                        <div class="box-tools pull-right">
                        </div>

                    </div>

                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" 
                        class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>entregaid</th>
                            <th>fechaEntrega</th>
                            <th>cantidad</th>
                            <th>ID planificacion</th>
                            <th>ID paquete</th>
                          </thead>
                          <tbody> 

                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>entregaid</th>
                            <th>fechaEntrega</th>
                            <th>cantidad</th>
                            <th>ID planificacion</th>
                            <th>ID paquete</th>                            
                          </tfoot>
                        </table>
                    </div>



                    <div class="panel-body" style="height: 400px;"
                     id="formularioregistros">
                        <form name="formulario" 
                        id="formulario" method="POST">
                         <!--div responsivo-->
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>fechaEntrega:</label>
                            <input type="hidden" name="entregaid" id="entregaid">
                            <input type="date" class="form-control" name="fechaEntrega" 
                            id="fechaEntrega" maxlength="50" placeholder="2017-10-10" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>cantidad:</label>
                            <input type="number" class="form-control"
                             name="cantidad" id="cantidad" 
                             maxlength="256" 
                             placeholder="cantidad">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>ID planificacion:</label>
                            <input type="number" class="form-control"
                             name="planificacionid" id="planificacionid" 
                             maxlength="256" 
                             placeholder="ID planificacion">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>ID paquete:</label>
                            <input type="number" class="form-control"
                             name="paqueteid" id="paqueteid" 
                             maxlength="256" 
                             placeholder="ID paquete">
                          </div>                                                    
                           
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                             <!--buton de tipo submit el cual envia el formulario por el metodo por ajax   -->
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<script type="text/javascript" src="scripts/entrega.js"></script>
<?php 
}
ob_end_flush();

 ?>