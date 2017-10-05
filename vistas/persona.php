<?php
require 'header.php';
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
                          <h1 class="box-title">persona <button class="btn btn-success" 
                            id="btnagregar" onclick="mostrarform(true)"><i
                            class="fa fa-plus-circle"></i> Agregar una nueva persona</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>

                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadopersona">
                        <table id="tbllistado" 
                        class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Codigo</th>
                            <th>Ci</th>
                            <th>Nombre</th>
                            <th>Paterno</th>
                            <th>Materno</th>
                            <th>direcion</th>
                            <th>Telefono</th>
                            <th>email</th>
                            <th>tipoid</th>
                            <th>estado</th>
                          </thead>
                          <tbody> 

                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Codigo</th>
                            <th>Ci</th>
                            <th>Nombre</th>
                            <th>Paterno</th>
                            <th>Materno</th>
                            <th>direcion</th>
                            <th>Telefono</th>
                            <th>email</th>
                            <th>tipoid</th>
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
                         <label>Codigo:</label>
                            <input type="hidden" name="personaid" id="personaid">
                            <input type="number" class="form-control" name="personaid" id="personaid" maxlength="50" placeholder="codigo" required>
                          </div>
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label>ci:</label>
                            <input type="hidden" name="ci" id="ci">
                            <input type="number" class="form-control" name="ci" id="ci" maxlength="50" placeholder="codigo" required>
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>nombre:</label>
                            <input type="text" class="form-control"
                             name="nombre" id="nombre" 
                             maxlength="256" 
                             placeholder="nombre">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>paterno:</label>
                            <input type="text" class="form-control"
                             name="paterno" id="paterno" 
                             maxlength="256" 
                             placeholder="paterno">
                          </div>
                          
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>materno:</label>
                            <input type="text" class="form-control"
                             name="materno" id="materno" 
                             maxlength="256" 
                             placeholder="materno">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>direccion:</label>
                            <input type="text" class="form-control"
                             name="direccion" id="direccion" 
                             maxlength="256" 
                             placeholder="direccion">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>telefono:</label>
                            <input type="number" class="form-control"
                             name="telefono" id="telefono" 
                             maxlength="20" 
                             placeholder="telefono">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>email:</label>
                            <input type="text" class="form-control"
                             name="email" id="email" 
                             maxlength="256" 
                             placeholder="email">
                          </div>

                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>tipoid:</label>
                            <input type="number" class="form-control"
                             name="tipoid" id="tipoid" 
                             maxlength="256" 
                             placeholder="tipoid">
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
require 'footer.php';
?>
<script type="text/javascript" src="scripts/persona.js"></script>