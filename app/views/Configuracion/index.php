<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="../app/Assets/css/globals.css" />
  <link rel="stylesheet" href="../app/Assets/css/styleguide.css" />
  <link rel="stylesheet" href="../app/Assets/css/style.css" />
</head>

<body>
  <div class="config-view">
    <div class="info">
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
                      <option value="Procesos">Procesos</option>
                      <option value="Lineas">Líneas</option>
                      <option value="Productos">Productos</option>
                      <option value="Paros">Paros</option>
                      <option value="Sub-Paros">Sub-Paros</option>
                      <option value="Turnos">Turnos</option>
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
</body>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const firstSelect = document.querySelector('.config-filter');
  const div3 = document.querySelector('.div-3');
  const underline2 = document.querySelector('.underline:nth-of-type(2)');
  const secondSelect = document.querySelectorAll('.config-filter')[1];

  // Inicialmente ocultar elementos
  div3.style.display = 'none';
  underline2.style.display = 'none';
  secondSelect.style.display = 'none';

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
});

function buscar() {
  window.location.href = 'configuracion/verRegistro';
} 
</script>
</html>