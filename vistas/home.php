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

if ($_SESSION['escritorio']==1)
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
                          <h1 class="box-title">BIENVENIDO</h1>
                        <div class="box-tools pull-right">
                        </div>

                    </div>

                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body ">

                    	    <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    	    <img src="../imagenes/Eba1.jpg" whit="450" height="450" />
                          </div>

                    </div>


                    <div class="panel-body" style="height: 400px;">
                        
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