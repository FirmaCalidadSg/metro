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
                                <option value="1">Eficiencia</option>
                                <option value="2">Capacidad</option>
                                <option value="3">Capacidad de Producción</option>
                                <option value="4">Mantenimiento</option>
                                <option value="5">Producción</option>
                                <option value="6">Distribución de tiempo</option>
                            </select>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield">
                        <div class="input">
                            <div class="div">Planta</div>
                            <select class="select-input" id="planta">
                                <option value="">Selecciona uno</option>
                                <option value="1">Buga</option>
                                <option value="2">Cali</option>
                                <option value="3">Bogotá</option>
                            </select>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
                <div class="element">
                    <div class="textfield-2">
                        <div class="input">
                            <div class="div">Desde</div>
                            <input type="date" class="timerlist" id="desde" />
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield-2">
                        <div class="input">
                            <div class="div">Hasta</div>
                            <input type="date" class="timerlist" id="hasta" />
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
                buscarBtn.disabled = false;
                buscarBtn.style.outline = 'none';
                buscarBtn.style.border = 'none';
                
            } else {
                console.log("Faltan campos por llenar. Botón deshabilitado.");
                buscarBtn.disabled = true;
            }
        }
        function buscar() {
            window.location.href = '../app/reportes/resultados';
        }
        // Escuchar cambios en los campos
        tipoReporte.addEventListener('change', validarCampos);
        planta.addEventListener('change', validarCampos);
        desde.addEventListener('input', validarCampos);
        hasta.addEventListener('input', validarCampos);
    </script>
</body>

</html>

