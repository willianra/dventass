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

if ($_SESSION['inventario']==1)
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
                          <h1 class="box-title">Gestionar Pedido
                            <button class="btn btn-success" 
                            id="btnagregar" onclick="mostrarform(true)"><i
                            class="fa fa-plus-circle"></i> CREAR</button>

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
                            <th>pedidoid</th>
                            <th>fechaEntrega</th>
                            <th>cantidad</th>
                            <th>vigencia</th>
                            <th>almacenid</th>
                            <th>productoid</th>
                            <th>estado</th>
                           
                          </thead>
                          <tbody> 

                          </tbody>
                          <tfoot>   
                           <th>Opciones</th>
                            <th>pedidoid</th>
                            <th>fechaEntrega</th>
                            <th>cantidad</th>
                            <th>vigencia</th>
                            <th>almacenid</th>
                            <th>productoid</th>
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
                         <label>fecha de entrega:</label>
                          <input type="hidden" name="pedidoid" id="pedidoid">
                            <input type="date" class="form-control" name="fechaEntrega" id="fechaEntrega"  placeholder="fecha" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>cantidad:</label>
                            <input type="number" class="form-control"
                             name="cantidad" id="cantidad" 
                             maxlength="14" 
                             placeholder="cantidad">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>vigencia:</label>
                            <input type="number" class="form-control"
                             name="vigencia" id="vigencia" 
                             maxlength="256" 
                             placeholder="vigencia">
                          </div>
                          
                           

                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>almacenid(*):</label>
                            <select id="almacenid" name="almacenid" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>
              
                           
                       <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>productoid(*):</label>
                            <select id="productoid" name="productoid" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>
              
                          
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                             <!--buton de tipo submit el cual envia el formulario por el metodo por ajax   -->
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>

                      <div class="panel-body" style="height: 400px;">
                        select pedido:
                          <form  method="get" action="../reporte_planificacion.php">
                              <select name="pedidoid">
                                  <?php
                                  $con=mysqli_connect('localhost','root','');
                                  mysqli_select_db($con,'basedatosebaf');

                                  $query = mysqli_query($con,'select * from pedido');
                                    while ($pedido = mysqli_fetch_array($query)){
                                        echo "<option value='".$pedido['pedidoid']."'>".$pedido['pedidoid']."</option>";
                                    }
                                  ?>
                              </select>
                              <input type="submit" value="Generar PDF">
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
<script type="text/javascript" src="scripts/pedido.js"></script>
<?php 
}
ob_end_flush();

 ?>