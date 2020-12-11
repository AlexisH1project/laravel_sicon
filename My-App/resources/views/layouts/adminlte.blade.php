<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>SICON | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--CSS personalizadas de SICON-->
  <link rel="stylesheet" href="../css/content_header.css">
  <link rel="stylesheet" href="../css/background.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse ">
<div class="wrapper">

  <!-- Navbar -->
  
  <nav class="main-header text-sm navbar navbar-expand navbar-white navbar-dark" style="background: rgb(146, 25, 40) ">
    <!-- Left navbar links -->
    <ul class="navbar-nav ">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" 
        data-no-transition-after-reload="false"
        role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

  

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      @if (Auth::user()->id_rol==0 || Auth::user()->id_rol==1)
      <li class="nav-item">
        @if (Auth::user()->id_rol==0)
        <a href="#" class="nav-link">  
        @endif
        @if (Auth::user()->id_rol==1)
        <a href="#" class="nav-link">  
        @endif
        
          <i class="fas fa-file-signature"></i>Eventuales
        </a>
      </li>
      @endif
      <li class="nav-item">
        <a href="{{ url('/logout') }}" class="nav-link">
          <i class="fas fa-power-off"></i> CERRAR SESIÓN
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->
  <div class="menu_completo">
<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-light-secondary elevation-4" >
  <!-- Brand Logo -->
  <a href="{{route('home')}}" class="brand-link">
    <img src="../dist/img/salud.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">SICON</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar" data-accordion="true">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../dist/img/avatar_SS2.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{route('home')}}" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             @if (Auth::user()->id_rol==0 || Auth::user()->id_rol==1 || Auth::user()->id_rol==2 || Auth::user()->id_rol==3 || Auth::user()->id_rol==4)
             <li class="nav-item">
                @if (Auth::user()->id_rol==0)
              <a href="{{route('DDSCH.capDDSCH')}}" class="nav-link">
                @endif
                @if (Auth::user()->id_rol==1)
                <a href="{{route('DDSCH.autorizaDDSCH')}}" class="nav-link">
                  @endif
                @if (Auth::user()->id_rol==2)
              <a href="{{route('DSPO.autorizaDSPO')}}" class="nav-link">
                @endif
                @if (Auth::user()->id_rol==3)
              <a href="{{route('DSPO.capDSPO')}}" class="nav-link">
                @endif
                @if (Auth::user()->id_rol==4)
              <a href="{{route('DSPO.autorizaDSPO')}}" class="nav-link">
                @endif
                <i class="fas fa-file-signature"></i>
                <p>
                  Bandeja
                </p>
              </a>
            </li>
            @endif
            @if (Auth::user()->id_rol==0 || Auth::user()->id_rol==1 || Auth::user()->id_rol==4)
            <li class="nav-item">
              <a href="{{route('General.filtroDescargar')}}" class="nav-link">
                <i class="fas fa-file-download"></i>
                <p>
                 Descarga de Documentos
                </p>
              </a>
            </li>
            @endif
            @if (Auth::user()->id_rol==0 || Auth::user()->id_rol==1 || Auth::user()->id_rol==2 || Auth::user()->id_rol==4)
            <li class="nav-item">
              <a href="{{route('General.generarReporte')}}" class="nav-link">
                <i class="fas fa-book"></i>
                <p>
                  Generar Reporte
                </p>
              </a>
            </li>
            @endif
            @if (Auth::user()->id_rol==3)
            <li class="nav-item">
              <a href="{{route('DSPO.generarReportePC')}}" class="nav-link">
                <i class="fas fa-book"></i>
                <p>
                  Reporte Profesional
                </p>
              </a>
            </li>
            @endif
            @if (Auth::user()->id_rol==0 || Auth::user()->id_rol==1 || Auth::user()->id_rol==2 || Auth::user()->id_rol==3 || Auth::user()->id_rol==4 || Auth::user()->id_rol==5)
            <li class="nav-item">
              <a href="{{route('General.consultaEstado')}}" class="nav-link">
                <i class="fas fa-search"></i>
                <p>
                  Consulta
                </p>
              </a>
            </li>
            @endif
            @if (Auth::user()->id_rol==0 || Auth::user()->id_rol==1)
        <li class="nav-item has-treeview menu-open">
          <a href="" class="nav-link">
            <i class="fas fa-file-upload"></i>
            <p>Guardar</p>
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('General.guardarVista')}}" class="nav-link">
                <i class="fas fa-arrow-circle-up"></i>
                <p>Guardar Documentos</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('DDSCH.guardarVistaEventuales')}}" class="nav-link">
                <i class="fas fa-arrow-circle-up"></i>
                <p>Documentos Eventuales</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
        @if (Auth::user()->id_rol==2 || Auth::user()->id_rol==3)
        <li class="nav-item">
          <a href="{{route('General.guardarVista')}}" class="nav-link">
            <i class="fas fa-file-upload"></i>
            <p>Guardar Documentos</p>    
          </a>
        </li>
        @endif
        @if (Auth::user()->id_rol==0 || Auth::user()->id_rol==1)
        <li class="nav-item">
          <a href="{{route('DDSCH.qrtxt')}}" class="nav-link">
            <i class="fas fa-qrcode"></i>
            <p>Guardar txt</p>    
          </a>
        </li>
        @endif
        @if (Auth::user()->id_rol==0 || Auth::user()->id_rol==1)
        <li class="nav-item">
          <a href="{{route('DDSCH.actualizarFecha')}}" class="nav-link">
            <i class="fas fa-calendar-alt"></i>
            <p>Actualizar Fecha</p>
          </a>
        </li>
        @endif
        @if (Auth::user()->id_rol==2)
        <li class="nav-item">
          <a href="{{route('DSPO.correosUR')}}" class="nav-link">
            <i class="fas fa-at"></i>
            <p>Correos</p>
          </a>
        </li>
        @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
</div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="header">
        <center>
        <h3>Sistema de Control de Registro de Formato de Movimiento de Personal</h3>
     <h5>Departamento Dirección General de Recursos Humanos y Organización/Dirección integral de puestos y servicios personales</h5>
        </center>
    </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class='background_content'>
        @yield('content')
      </div>
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <footer class="main-footer text-sm">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      SICON
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019-2020 <a href="https://www.gob.mx/salud">Secretaria de Salud</a>.</strong> Todos los derechos reservados.
  </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

</body>
</html>
