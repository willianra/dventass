<?php
if (strlen(session_id()) < 1) 
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>eba | www.eba.com</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

    <!-- DATATABLES -->
    
   <link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css">    
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

  </head>
  <body class="hold-transition skin-blue-light sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
          <a href="home.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>EBA</b>DIS</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>EBADIS</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
     <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">
                    <p>
                      www.eba.com - Desarrollando Software
                      <small>www.eba.com/willian rojas </small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                    <a href="../ajax/usuario.php?op=salir" 
                    class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>

              <?php 
            if ($_SESSION['escritorio']==1)
            {
              echo '<li>
              <a href="home.php"> 
 
              </a>
            </li>';
            }
            ?>
             
            <?php 
            if ($_SESSION['entidad']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>ENTIDAD</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="InterfazEmpresa.php"><i class="fa fa-circle-o"></i> gestionar Empresa</a></li>
                <li><a href="InterfazSucursal.php"><i class="fa fa-circle-o"></i> gestionar Sucursal</a></li>
                  <li><a href="InterfazTipo.php"><i class="fa fa-circle-o"></i> gestionar Tipo</a></li>
                  <li><a href="InterfazPersona.php"><i class="fa fa-circle-o"></i> gestionar persona</a></li>
                  <li><a href="usuario.php"><i class="fa fa-circle-o"></i> gestionar usuarios</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php 
            if ($_SESSION['planificacion']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>PLANIFICACION</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="InterfazAvala.php"><i class="fa fa-circle-o"></i> Gestionar Avala</a></li>
                <li><a href="InterfazPlanificacion.php"><i class="fa fa-circle-o"></i> Gestionar Planificacion</a></li>
                <li><a href="InterfazEntrega.php"><i class="fa fa-circle-o"></i> Gestionar Entrega</a></li>
              </ul>
            </li>';
            }
            ?>

            <!-- PAQUETE 2  -->

             <?php 
            if ($_SESSION['inventario']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>INVENTARIO</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="InterfazAlmacen.php"><i class="fa fa-circle-o"></i> Gestinar Almacen</a></li>
                <li><a href="InterfazPedido.php"><i class="fa fa-circle-o"></i> Gestinar Pedido</a></li>
                <li><a href="InterfazPaquete.php"><i class="fa fa-circle-o"></i> Gestinar Paquete</a></li>
                <li><a href="InterfazDetallepaquete.php"><i class="fa fa-circle-o"></i> Administrar Detalle Paquete</a></li>
                <li><a href="InterfazInventario.php"><i class="fa fa-circle-o"></i> Administrar Inventario</a></li>
                <li><a href="InterfazProducto.php"><i class="fa fa-circle-o"></i> Gestinar Producto</a></li>
                 
              </ul>
            </li>';
            }
            ?>
            
                                       <!-- PAQUETE 4  -->
             <?php 
            if ($_SESSION['negocio']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>NEGOCIO</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="InterfazProveedor.php"><i class="fa fa-circle-o"></i> Gestionar Proveedor</a></li>
                <li><a href="InterfazAlmacenpersona.php"><i class="fa fa-circle-o"></i> Administrar Personal Almacen</a></li>
                <li><a href="InterfazEmpresa.php"><i class="fa fa-circle-o"></i> Administrar Personal Empresa</a></li>
              </ul>
            </li>';
            }
            ?>
    
            <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
