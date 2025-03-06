<!DOCTYPE html>
<html lang="es">
<?php $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/'); ?>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>MetroTeam</title>
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
  <link rel="icon" href="<?php echo $basePath; ?>/Assets/img/kaiadmin/favicon.ico" type="image/x-icon" />


  <script src="../../app/Assets/echarts-master/dist/echarts.js"></script>


  <!-- Fonts and icons -->
  <script src="<?php echo $basePath; ?>/Assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Public Sans:300,400,500,600,700"]
      },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["<?php echo $basePath; ?>/Assets/css/fonts.min.css"],
      },
      active: function() {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->

  <link rel="stylesheet" href="<?php echo $basePath; ?>/Assets/css/plugins.min.css" />
  <link rel="stylesheet" href="<?php echo $basePath; ?>/Assets/css/kaiadmin.min.css" />
  <link rel="stylesheet" href="<?php echo $basePath; ?>/Assets/css/globals.css" />
  <link rel="stylesheet" href="<?php echo $basePath; ?>/Assets/css/style.css" />
  <link rel="stylesheet" href="<?php echo $basePath; ?>/Assets/css/styleguide.css" />
  <link rel="stylesheet" href="<?php echo $basePath; ?>/Assets/bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" href="<?php echo $basePath; ?>/Assets/datatable/datatables.css" />
  <link rel="stylesheet" href="<?php echo $basePath; ?>/Assets/fontawesome-free-5.15.4-web/css/all.min.css">

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link rel="stylesheet" href="assets/css/demo.css" />

  <style>
    .btn{
      border: none !important;
    }
    .btn:hover{
    background:  #0a843c !important;
    }
    .boton-cerrar {
      display: none;
    }

    .sidebar .nav-collapse li a .sub-item:before,
    .sidebar[data-background-color=white] .nav-collapse li a .sub-item:before {
      display: none;
    }

    @media (max-width: 900px) {

      .boton-cerrar {
        display: block !important;
      }

      .gg-more-vertical-alt {
        display: none !important;

      }


    }
  </style>
</head>

<body>
  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #e4ebdb;">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header">
          <a href="index.html" class="logo">
            <img src="<?php echo $basePath; ?>/Assets/css/images/logo.svg" alt="navbar brand" class="navbar-brand"
              height="50" />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>
        <!-- End Logo Header -->
      </div>

      <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class=" container">
          <hr>
          <div class="row">
            <div class="col-xl-8 col-sm-7 text-end p-0">
              <h6 style="color:#6F8695 !important; font-size:1.1rem" class="text-section">Metroteam</h6>
            </div>
            <div class="col-sm-4 text-end p-0 boton-cerrar">
              <button class="btn btn-toggle sidenav-toggler ">
                <i style="color:#2a543b" class="gg-menu-left"></i>
              </button>
            </div>


          </div>


        </div>

        <!-- ACA VA EL MENU DEL SIDEBAR  -->
        <div class="sidebar-content">
          <ul class="nav nav-secondary">
            <li class="nav-item active">
              <a href="<?php echo BASE_PATH; ?>usuarios/dashboard">
                <i class="fas fa-home"></i>
                <p>Inicio</p>

              </a>

            </li>

            <li class="nav-section">
              <span class="sidebar-mini-icon">
                <i class="fa fa-ellipsis-h"></i>
              </span>
            </li>

            <!-- Control de Capacidades -->
           <!--  <li class="nav-item">
              <a href="<?php echo BASE_PATH; ?>controlCapacidad"">
                <i class=" fas fa-plus"></i>
                <p>Control De Capacidades</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="controlCapacidades">
                <ul class="nav nav-collapse">
                  <li><a href="<?php echo BASE_PATH; ?>controlCapacidad"><span class="sub-item">Control De
                        Capacidades</span></a></li>
                  <li><a href="#"><span class="sub-item">Control De Capacidades Batch</span></a></li>
                </ul>
              </div>
            </li> -->
            <!-- Control de Capacidades -->

            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#capacidades">
                <i class=" fas fa-plus"></i>
                <p>Control De Capacidades</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="capacidades">
                <ul class="nav nav-collapse">
                  <li><a href="<?php echo BASE_PATH; ?>controlCapacidad"><span class="sub-item">Control De
                        Capacidades</span></a></li>
                  <li><a href="#"><span class="sub-item">Control De Capacidades Batch</span></a></li>
                </ul>
              </div>
            </li>


            <!-- Consultas -->
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#consultas">
                <i class="fas fa-layer-group"></i>
                <p>Consultas</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="consultas">
                <ul class="nav nav-collapse">
                  <li><a href="<?php echo BASE_PATH; ?>consultas"><span class="sub-item">Registradas</span></a></li>
                  <li><a href="#"><span class="sub-item">Pendientes</span></a></li>
                  <li><a href="#"><span class="sub-item">Por Estado</span></a></li>
                </ul>
              </div>
            </li>

            <!-- Reportes -->
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#reportes">

                <i class="fa fa-chart-pie"></i>
                <p>Reportes</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="reportes">
                <ul class="nav nav-collapse">
                  <li><a href="<?php echo BASE_PATH; ?>reportes"><span class="sub-item">Registradas</span></a></li>
                  <li><a href="#"><span class="sub-item">Pendientes</span></a></li>
                  <li><a href="#"><span class="sub-item">Por Estado</span></a></li>
                </ul>
              </div>
            </li>

            <!-- Administración -->
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#administracion">
                <i class="fas fa-cogs"></i>
                <p>Administración</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="administracion">
                <ul class="nav nav-collapse">
                  <li><a href="<?php echo BASE_PATH; ?>configuracion"><span class="sub-item">Consultar</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>configuracion/registroConfiguracion"><span
                        class="sub-item">Registrar</span></a></li>
                </ul>
              </div>
            </li>

            <!-- Configuración -->
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#configuracion">
                <i class="fas fa-cog"></i>
                <p>Configuración</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="configuracion">
                <ul class="nav nav-collapse">
                  <li><a href="<?php echo BASE_PATH; ?>definicion"><span class="sub-item">Definición</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>pais"><span class="sub-item">Países</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>ciudad"><span class="sub-item">Ciudades</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>departamento"><span class="sub-item">Departamentos</span></a>
                  </li>
                  <li><a href="<?php echo BASE_PATH; ?>turno"><span class="sub-item">Turnos</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>plantas"><span class="sub-item">Plantas</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>equipo"><span class="sub-item">Equipos</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>danoequipo"><span class="sub-item">Daños</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>proceso"><span class="sub-item">Procesos</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>linea"><span class="sub-item">Líneas</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>producto"><span class="sub-item">Productos</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>lineaproducto"><span class="sub-item">Línea y
                        Productos</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>categoriaParos"><span class="sub-item">Paros</span></a></li>
                  <li><a href="<?php echo BASE_PATH; ?>subCategoriaParos"><span class="sub-item">Sub-Paros</span></a>
                  </li>
                  <li><a href="<?php echo BASE_PATH; ?>tiposParos"><span class="sub-item">Razones</span></a></li>
                </ul>
              </div>
            </li>

            <!-- Gestión y Dirección -->
            <li class="nav-item">
              <a data-bs-toggle="collapse" href="#gestion">
                <i class="fas fa-user-cog"></i>
                <p>Gestión y Dirección</p>
                <span class="caret"></span>
              </a>
              <div class="collapse" id="gestion">
                <ul class="nav nav-collapse">
                  <li><a href="<?php echo BASE_PATH; ?>usuarios"><span class="sub-item">Gestión de Usuarios</span></a>
                  </li>
                  <li><a href="<?php echo BASE_PATH; ?>roles"><span class="sub-item">Gestión de Roles</span></a></li>
                </ul>
              </div>
            </li>

            <!-- Cerrar Sesión -->
            <li class="nav-item">
              <a href="<?php echo BASE_PATH; ?>revocarAcceso">
                <i class="fas fa-sign-out-alt"></i>
                <p>Cerrar Sesión</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div> <!-- End Sidebar -->
    <div style="background-color: #f2f5f4;" class="main-header">
      <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header">
          <a href="index.html" class="logo">
            <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
          </a>

        </div>
        <!-- End Logo Header -->
      </div>
      <!-- Navbar Header -->

      <!-- End Navbar -->
    </div>

    <div style="background-color: #f2f5f4; padding:2%;" class="main-panel">
      <script>
        $(document).ready(function() {
          $('#table').DataTable({
            "language": {
              "sProcessing": "Procesando...",
              "sLengthMenu": "Mostrar _MENU_ registros",
              "sZeroRecords": "No se encontraron resultados",
              "sEmptyTable": "Ningún dato disponible en esta tabla",
              "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix": "",
              "sSearch": "Buscar:",
              "sUrl": "",
              "sInfoThousands": ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
              },
              "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
            }
          });
        });
      </script>