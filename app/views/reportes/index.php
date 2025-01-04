<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../app/Assets/css/globals.css" />
    <link rel="stylesheet" href="../app/Assets/css/styleguide.css" />
    <link rel="stylesheet" href="../app/Assets/css/style.css" />
</head>

<body>
    <div class="reportes">
        <div class="container-reportes">
            <div class="frame">
                <div class="text">
                    <div class="div-wrapper">
                        <div class="text-wrapper">Reportes control de capacidad</div>
                    </div>
                </div>
            </div>
            <div class="drops-downs">
                <div class="element">
                    <div class="textfield">
                        <div class="input">
                            <div class="div">Tipo de reporte</div>
                            <select class="select-input" id="tipo-reporte">
                                <option value="">Selecciona uno</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield">
                        <div class="input">
                            <div class="div">Planta</div>
                            <select class="select-input" id="planta">
                                <option value="">Selecciona uno</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
                <div class="element">
                    <div class="textfield-2">
                        <div class="input">
                            <div class="div">Desde</div>
                            <input type="datetime-local" class="timerlist" id="desde" />
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield-2">
                        <div class="input">
                            <div class="div">Hasta</div>
                            <input type="datetime-local" class="timerlist" id="hasta" />
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="buttom" onclick="buscar()" id="buscar-btn" disabled>
            <div class="text-wrapper-4">Buscar</div>
        </button>
    </div>

    <script>
        // Selección de elementos
        const tipoReporte = document.getElementById('tipo-reporte');
        const planta = document.getElementById('planta');
        const desde = document.getElementById('desde');
        const hasta = document.getElementById('hasta');
        const buscarBtn = document.getElementById('buscar-btn');

        // Función que comprueba si todos los campos están llenos
        function validarCampos() {
            if (tipoReporte.value !== '' && planta.value !== '' && desde.value !== '' && hasta.value !== '') {
                console.log("Todos los campos están llenos. Botón habilitado.");
                buscarBtn.disabled = false; // Habilitar botón si todos los campos están completos
            } else {
                console.log("Faltan campos por llenar. Botón deshabilitado.");
                buscarBtn.disabled = true; // Deshabilitar botón si falta algún campo
            }
        }
        function buscar() {
            window.location.href = '../app/views/reportes/resultados.php';
        }
        // Escuchar cambios en los campos
        tipoReporte.addEventListener('change', validarCampos);
        planta.addEventListener('change', validarCampos);
        desde.addEventListener('input', validarCampos);
        hasta.addEventListener('input', validarCampos);
    </script>
</body>

</html>

