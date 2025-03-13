
  <div class="container">
  <div class="config-view">
    <div class="reportes">
      <div class="frame">
        <div class="text">
          <div class="text-wrapper">Consultar</div>
        </div>
      </div>
      <div class="drops-downs">
        <div class="element">
          <div class="textfield">
            <div class="input">
              <div class="div">Selecciona que necesitas consultar</div>
                  <div class="div-2">
                    <select class="config-filter">
                      <option value="" disabled selected>Seleccionar</option>
                      <option value="definicion">Definición</option>
                      <option value="paises">Países</option>
                      <option value="ciudad">Ciudad</option>
                      <option value="departamentos">Departamentos</option>
                      <option value="equipos">Equipos</option>
                      <option value="daños">Daños</option>
                      <option value="procesos">Procesos</option>
                      <option value="lineas">Líneas</option>
                      <option value="productos">Productos</option>
                      <option value="lineaproducto">Linea y Productos</option>
                      <option value="paros">Paros</option>
                      <option value="subparos">Sub-Paros</option>
                      <option value="turnos">Turnos</option>
                    </select> 
                </div> <img class="underline" src="../app/Assets/css/images/underline.svg" />
                <div class="div-3">Planta</div>
                <div class="div-2">
                  <select class="config-filter">
                    <option value="" disabled selected>Seleccionar</option>
                    <option value="1">Buga</option>
                    <option value="2">Cali</option>
                    <option value="3">Bucaramanga</option>
                  </select>
                </div>
                <img class="underline" src="../app/Assets/css/images/underline.svg" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <button class="button-admin" id="buscar" onclick="buscar()">
      <div class="text-wrapper-3">Buscar</div>
    </button>
    </div>
  </div>
  </div>
  

<script>
document.addEventListener('DOMContentLoaded', function() {
  const firstSelect = document.querySelector('.config-filter');
  const div3 = document.querySelector('.div-3');
  const underline2 = document.querySelector('.underline:nth-of-type(2)');
  const secondSelect = document.querySelectorAll('.config-filter')[1];
  const buscarBtn = document.getElementById('buscar');

  // Inicialmente ocultar elementos
  div3.style.display = 'none';
  underline2.style.display = 'none';
  secondSelect.style.display = 'none';

  // Mostrar/ocultar elementos según la selección del primer select
  firstSelect.addEventListener('change', function() {
    if (firstSelect.value !== "") {
      div3.style.display = 'block';
      underline2.style.display = 'block';
      secondSelect.style.display = 'block';
    } else {
      div3.style.display = 'none';
      underline2.style.display = 'none';
      secondSelect.style.display = 'none';
    }
  });

  // Redireccionar cuando se hace clic en el botón "Buscar"
  buscarBtn.addEventListener('click', function() {
    // Coloca aquí las redirecciones según la selección
    let redirectUrl = '';

    switch (firstSelect.value) {
      case 'definicion':
        redirectUrl = '<?php echo BASE_PATH; ?>/definicion';
        break;
      case 'paises':
        redirectUrl = '<?php echo BASE_PATH; ?>/pais'; 
        break;
      case 'ciudad':
        redirectUrl = '<?php echo BASE_PATH; ?>/ciudad'; 
        break;
      case 'departamentos':
        redirectUrl = '<?php echo BASE_PATH; ?>/departamento'; 
        break;
      case 'equipos':
        redirectUrl = '<?php echo BASE_PATH; ?>/equipo'; 
        break;
      case 'daños':
        redirectUrl = '<?php echo BASE_PATH; ?>/danoequipo'; 
        break;
      case 'procesos':
        redirectUrl = '<?php echo BASE_PATH; ?>/proceso'; 
        break;
      case 'lineas':
        redirectUrl = '<?php echo BASE_PATH; ?>/linea'; 
        break;
      case 'productos':
        redirectUrl = '<?php echo BASE_PATH; ?>/producto'; 
        break;
      case 'lineaproducto':
        redirectUrl = '<?php echo BASE_PATH; ?>/lineaproducto'; 
        break;
      case 'paros':
        redirectUrl = '<?php echo BASE_PATH; ?>/paros'; 
        break;
      case 'sub-paros':
        redirectUrl = '<?php echo BASE_PATH; ?>/subparos'; 
        break;
      case 'turnos':
        redirectUrl = '<?php echo BASE_PATH; ?>/turnos'; 
        break;
      // añade más casos según tus necesidades
      default:
        break;
    }

    if (redirectUrl !== '') {
      window.location.href = redirectUrl;
    }
  });
});

function buscar() {
  // Puedes mantener esta función vacía o eliminarla si ya no es necesaria
}


</script>
