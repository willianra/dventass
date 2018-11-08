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
if ($_SESSION['entidad']==1)
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
                          <h1 class="box-title">Gestionar Empresa <button class="btn btn-success" 
                            id="btnagregar" onclick="mostrarform(true)"><i
                            class="fa fa-plus-circle"></i> CREAR</button></h1>
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
                            <th>empresa id</th>
                            <th>numero patronal</th>
                            <th>razon social</th>
                            <th>nombre comercial</th>
                            <th>tipo empresa</th>
                            <th>estado</th>
                          </thead>
                          <tbody> 
                          </tbody>
                          <tfoot><th>Opciones</th>
                            <th>empresa id</th>
                            <th>numero patronal</th>
                            <th>razon social</th>
                            <th>nombre comercial</th>
                            <th>tipo empresa</th>
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
                         <label>numero patronal:</label>
                          <input type="hidden" name="empresaid" id="empresaid">
                            <input type="number" class="form-control" name="nroPatronal" id="nroPatronal" maxlength="11" placeholder="codigo del trabajador" required>
                          </div>
 
                           
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>razon social:</label>
                            <input type="text" class="form-control"
                             name="razonSocial" id="razonSocial" 
                             maxlength="256" 
                             placeholder="razon social">
                          </div>
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>nombre comercial:</label>
                            <input type="text" class="form-control"
                             name="nombreComercial" id="nombreComercial" 
                             maxlength="256" 
                             placeholder="nombrecomercial">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>tipo empresa:</label>
                            <input type="text" class="form-control"
                             name="tipoEmpresa" id="tipoEmpresa" 
                             maxlength="256" 
                             placeholder="tipo empresa">
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
<script type="text/javascript" src="scripts/empresa.js"></script>
<?php 
}
ob_end_flush();

 ?>