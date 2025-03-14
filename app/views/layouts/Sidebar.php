<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Alianza team</title>
  <link rel="stylesheet" href="../app/Assets/css/globals.css" />
  <link rel="stylesheet" href="../app/Assets/css/style.css" />
  <link rel="stylesheet" href="../app/Assets/css/styleguide.css" />
  <link rel="stylesheet" href="../app/Assets/bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" href="../app/Assets/datatable/datatables.css" />
  <link rel="stylesheet" href="../app/Assets/fontawesome-free-5.15.4-web/css/all.min.css">
  <style>
    #table_wrapper {
    width: 100%;  
    /* overflow-x: auto; */ /* Evita que se expanda más de la cuenta */
}

table.dataTable {
    width: 100% !important; /* Asegura que la tabla no se redimensione */
}

  </style>
</head>
<body>
  <div class="property-slider">
    <img class="image" src="../app/Assets/css/images/logo.svg" />
    <div class="divider"></div>
    <div class="typography">
      <div class="text-wrapper">METROTEAM</div>
    </div>
    <div class="frame">
      <div class="sidebar-option">
        <img class="img" src="../app/Assets/css/images/siderbar1.svg" />
        <div class="typography-wrapper">
          <div class="typography1">Nuevos</div>
        </div>
        <div class="sub-menu">
          <li class="sub-item">
            <a class="nav-link" href="<?php echo BASE_PATH; ?>controlCapacidad">Control De Capacidades</a>
          </li>
          <li class="sub-item">
            <a href="#">Control De Capacidades batch</a>
          </li>
        </div>
      </div>
      <div class="sidebar-option">
        <img class="img" src="../app/Assets/css/images/siderbar2.svg" />
        <div class="typography-wrapper">
          <div class="typography1">Consultas</div>
        </div>
        <div class="sub-menu">
          <a href="<?php echo BASE_PATH; ?>consultas">Registradas</a>
          <a href="#">Pendientes</a>
          <a href="#">Por Estados</a>
        </div>
      </div>
      <div class="sidebar-option">
        <img class="img" src="../app/Assets/css/images/siderbar3.svg" />
        <div class="typography-wrapper">
          <div class="typography1">Reportes</div>
        </div>
        <div class="sub-menu">
          <a href="<?php echo BASE_PATH; ?>reportes">Registradas</a>
          <a href="#">Pendientes</a>
          <a href="#">Por Estados</a>
        </div>
      </div>
      <div class="sidebar-option">
        <img class="img" src="../app/Assets/css/images/siderbar4.svg" />
        <div class="typography-wrapper">
          <div class="typography1">Administración</div>
        </div>
        <div class="sub-menu">
          <a href="<?php echo BASE_PATH; ?>configuracion">Consultar</a>
          <a href="<?php echo BASE_PATH; ?>configuracion/registroConfiguracion">Registrar</a>
        </div>
      </div>
      <div class="sidebar-option">
        <img class="img" src="../app/Assets/css/images/caps.svg" />
        <div class="typography-wrapper">
          <div class="typography1">Configuración</div>
        </div>
        <div class="sub-menu">
          <a href="<?php echo BASE_PATH; ?>definicion">Definición</a>
          <a href="<?php echo BASE_PATH; ?>pais">Países</a>
          <a href="<?php echo BASE_PATH; ?>ciudad">Ciudades</a>
          <a href="<?php echo BASE_PATH; ?>departamento">Departamentos</a>
          <a href="<?php echo BASE_PATH; ?>turno">Turnos</a>
          <a href="<?php echo BASE_PATH; ?>plantas">plantas</a>
          <a href="<?php echo BASE_PATH; ?>equipo">Equipos</a>
          <a href="<?php echo BASE_PATH; ?>danoequipo">Daños</a>
          <a href="<?php echo BASE_PATH; ?>proceso">Procesos</a>
          <a href="<?php echo BASE_PATH; ?>linea">Líneas</a>
          <a href="<?php echo BASE_PATH; ?>producto">Productos</a>
          <a href="<?php echo BASE_PATH; ?>lineaproducto">Línea y Productos</a>
          <a href="<?php echo BASE_PATH; ?>categoriaParos">Paros</a>
          <a href="<?php echo BASE_PATH; ?>subCategoriaParos">Sub-Paros</a>
          <a href="<?php echo BASE_PATH; ?>tiposParos">Razones</a>

          <!-- <a href="<?php echo BASE_PATH; ?>/documentos">Todos los Documentos</a> -->
        </div>
      </div>
      <div class="sidebar-option">
        <img class="img" src="../app/Assets/css/images/admin-user.svg" />
        <div class="typography-wrapper">
          <div class="typography1">Gestión y Dirección</div>
        </div>
        <div class="sub-menu">
          <a href="<?php echo BASE_PATH; ?>usuarios">Gestión de Usuarios</a>
          <a href="<?php echo BASE_PATH; ?>roles">Gestión de Roles</a>
        </div>
      </div>
      <div class="sidebar-option">
        <img class="img" src="../app/Assets/css/images/usser-logout.svg" />
        <div class="typography-wrapper">
          <div class="typography1">
            <a href="<?php echo BASE_PATH; ?>/logout">Cerrar Sesión</a>
          </div>
        </div>
      </div>

    </div>

    <div class="divider"></div>
    <button class="sidebar-option-2" id="toggleSidebar" onclick="functionContraer()">
      <img class="locura" src="../app/Assets/css/images/siderbar5.svg" />
      <div class="div-wrapper">
        <div class="typography-wrapper">Ocultar Menú</div>
      </div>
    </button>
  </div>
  <div class="home">
    <main>
      <div class="col-md-12">
        <script src="../app/Assets/jquery/jquery.min.js"></script>
        <script src="../app/Assets/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="../app/Assets/datatable/datatables.js"></script>
        <script src="../app/Assets/sweetAlert2/sweetalert2@11.js"></script>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            const sidebarOptions = document.querySelectorAll('.sidebar-option');

            sidebarOptions.forEach(option => {
              option.addEventListener('click', function() {
                const subMenu = option.querySelector('.sub-menu');

                if (subMenu.style.display === 'none' || subMenu.style.display === '') {
                  subMenu.style.display = 'flex';
                } else {
                  subMenu.style.display = 'none';
                }
              });
            });
          });

          function functionContraer() {
            const sidebar = document.querySelector('.property-slider');
            const home = document.querySelector('.home');
            const subMenus = document.querySelectorAll('.sub-menu');

            sidebar.classList.toggle('contraido');
            home.classList.toggle('contraido');

            if (sidebar.classList.contains('contraido')) {
              subMenus.forEach(subMenu => {
                subMenu.style.display = 'none';
              });
            }
          }

          function handleSidebarOptionClick() {
            const sidebar = document.querySelector('.property-slider');
            const home = document.querySelector('.home');

            if (sidebar.classList.contains('contraido')) {
              sidebar.classList.remove('contraido');
              home.classList.remove('contraido');
            }
          }

          document.querySelectorAll('.sidebar-option').forEach(option => {
            option.addEventListener('click', handleSidebarOptionClick);
          });



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
</body>

</html>