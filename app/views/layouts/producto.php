<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />

  <link rel="stylesheet" href="../app/Assets/css/globals.css" />
  <link rel="stylesheet" href="../app/Assets/css/style.css" />
  <link rel="stylesheet" href="../app/Assets/css/styleguide.css" />
</head>

<body>
  <div class="property-slider">
    <img class="image" src="../app/Assets/css/images/logo.svg" />
    <div class="divider"></div>
    <div class="typography">
      <div class="text-wrapper">Acciones</div>
    </div>
    <div class="frame">
      <div class="sidebar-option">
        <img class="img" src="../app/Assets/css/images/siderbar1.svg" />
        <div class="typography-wrapper">
          <div class="typography1">Nuevos</div>
        </div>
        <!--    <img class="arrow" src="../app/Assets/css/images/arrow.svg"/> -->
        <div class="sub-menu">
          <a class="nav-link" href="<?php echo BASE_PATH; ?>/controlCapacidad">Control De Capacidades</a>
          <a href="#">Control De Capacidades batch</a>
        </div>
      </div>
      <div class="sidebar-option">
        <img class="img" src="../app/Assets/css/images/siderbar2.svg" />
        <div class="typography-wrapper">
          <div class="typography1">Consultas</div>
        </div>
        <div class="sub-menu">
          <a href="<?php echo BASE_PATH; ?>/consultas">Registradas</a>
          <a href="#">Pendientes</a>
          <a href="#">Por Estados</a>
        </div>
        <!-- <img class="arrow" src="../app/Assets/css/images/arrow.svg" /> -->
      </div>
      <div class="sidebar-option">
        <img class="img" src="../app/Assets/css/images/siderbar3.svg" />
        <div class="typography-wrapper">
          <div class="typography1">Reportes</div>
        </div>
        <div class="sub-menu">
          <a href="<?php echo BASE_PATH; ?>/reportes">Registradas</a>
          <a href="#">Pendientes</a>
          <a href="#">Por Estados</a>
        </div>
        <!--   <img class="arrow" src="../app/Assets/css/images/arrow.svg" /> -->
      </div>
      <div class="sidebar-option">
        <img class="img" src="../app/Assets/css/images/siderbar4.svg" />
        <div class="typography-wrapper">
          <div class="typography1">Administración</div>
        </div>
        <div class="sub-menu">
          <a href="<?php echo BASE_PATH; ?>/configuracion">Consultar</a>
          <a href="#">Registrar</a>
        </div>
        <!--   <img class="arrow" src="../app/Assets/css/images/arrow.svg" /> -->
      </div>
      <div class="sidebar-option">
        <img class="img" src="../app/Assets/css/images/siderbar4.svg" />
        <div class="typography-wrapper">
          <div class="typography1">Configuración</div>
        </div>
        <div class="sub-menu">
      <a href="<?php echo BASE_PATH; ?>/definicion">Definición</a>
      <a href="<?php echo BASE_PATH; ?>/pais">Países</a>
      <a href="<?php echo BASE_PATH; ?>/ciudad">Ciudades</a>
      <a href="<?php echo BASE_PATH; ?>/departamento">Departamentos</a>
      <a href="<?php echo BASE_PATH; ?>/equipo">Equipos</a>
      <a href="<?php echo BASE_PATH; ?>/danoequipo">Daños</a>
      <a href="<?php echo BASE_PATH; ?>/proceso">Procesos</a>
      <a href="<?php echo BASE_PATH; ?>/linea">Líneas</a>
      <a href="<?php echo BASE_PATH; ?>/producto">Productos</a>
      <a href="<?php echo BASE_PATH; ?>/lineaproducto">Línea y Productos</a>
      <a href="<?php echo BASE_PATH; ?>/paros">Paros</a>
      <a href="<?php echo BASE_PATH; ?>/subparos">Sub-Paros</a>
      <a href="<?php echo BASE_PATH; ?>/turnos">Turnos</a>
      <a href="<?php echo BASE_PATH; ?>/documentos">Todos los Documentos</a>
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
  <!-- Contenido de la vista -->
  <div class="home">
    <?php require_once '../app/views/producto/index.php'; ?>

  </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const sidebarOptions = document.querySelectorAll('.sidebar-option');

      sidebarOptions.forEach(option => {
        option.addEventListener('click', function() {
          const subMenu = option.querySelector('.sub-menu');

          // Alternar la visibilidad del submenú
          if (subMenu.style.display === 'none' || subMenu.style.display === '') {
            subMenu.style.display = 'flex';
          } else {
            subMenu.style.display = 'none';
          }
        });
      });
    });
    $(document).ready(function() {
      $('.property-slider .main-item').on('click', function() {
        $(this).next('.sub-menu').toggle(); /* Alterna la visibilidad del submenú */
      });
    });

    function functionContraer() {
    const sidebar = document.querySelector('.property-slider');
    const home = document.querySelector('.home');
    
    // Alternar la clase 'contraido'
    sidebar.classList.toggle('contraido');
    home.classList.toggle('contraido');
}

function functionContraer() {
    const sidebar = document.querySelector('.property-slider');
    const home = document.querySelector('.home');
    
    // Alternar la clase 'contraido'
    sidebar.classList.toggle('contraido');
    home.classList.toggle('contraido');
}

// Función para remover la clase 'contraido' cuando se hace clic en una opción del sidebar
function handleSidebarOptionClick() {
    const sidebar = document.querySelector('.property-slider');
    const home = document.querySelector('.home');

    if (sidebar.classList.contains('contraido')) {
        sidebar.classList.remove('contraido');
        home.classList.remove('contraido');
    }
}

// Añadir el evento de clic a cada opción del sidebar
document.querySelectorAll('.sidebar-option').forEach(option => {
    option.addEventListener('click', handleSidebarOptionClick);
});


  </script>
</body>

</html>