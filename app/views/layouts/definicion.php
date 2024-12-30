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
                <img class="img" src="../app/Assets/css/images/siderbar1.svg"/> 
                <div class="typography-wrapper"><div class="typography1">Nuevos</div></div>
             <!--    <img class="arrow" src="../app/Assets/css/images/arrow.svg"/> -->
                <div class="sub-menu">
                    <a href="#">Control De Capacidades</a>
                    <a href="#">Control De Capacidades batch</a>
                </div>
            </div>
            <div class="sidebar-option">
                <img class="img" src="../app/Assets/css/images/siderbar2.svg" />
                <div class="typography-wrapper">
                    <div class="typography1">Consultas</div>
                    <div class="sub-menu">
                        <a href="#">Registradas</a>
                        <a href="#">Pendientes</a>
                        <a href="#">Por Estados</a>
                    </div>
                </div>
                <!-- <img class="arrow" src="../app/Assets/css/images/arrow.svg" /> -->
            </div>
            <div class="sidebar-option">
                <img class="img" src="../app/Assets/css/images/siderbar3.svg" />
                <div class="typography-wrapper">
                    <div class="typography1">Reportes</div>
                    <div class="sub-menu">
                        <a href="#">Registradas</a>
                        <a href="#">Pendientes</a>
                        <a href="#">Por Estados</a>
                    </div>
                </div>
              <!--   <img class="arrow" src="../app/Assets/css/images/arrow.svg" /> -->
            </div>
            <div class="sidebar-option">
                <img class="img" src="../app/Assets/css/images/siderbar4.svg" />
                <div class="typography-wrapper">
                    <div class="typography1">Administración</div>
                </div>
              <!--   <img class="arrow" src="../app/Assets/css/images/arrow.svg" /> -->
            </div>
        </div>
        <div class="divider"></div>
        <div class="sidebar-option-2">
            <img class="locura" src="../app/Assets/css/images/siderbar5.svg" />
            <div class="div-wrapper">
                <div class="typography-wrapper">Ocultar Menú</div>
            </div>
        </div>
    </div>
    <!-- Contenido de la vista -->
    <div class="home">
        <div class="card-grande">
            <?php require_once '../app/views/definicion/index.php'; ?>
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

</script>
</body>

</html>