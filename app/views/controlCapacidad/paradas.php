<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../../app/Assets/css/globals.css" />
    <link rel="stylesheet" href="../../app/Assets/css/styleguide.css" />
    <link rel="stylesheet" href="../../app/Assets/css/style.css" />
</head>

<body>
    <div class="paradas">
        <div class="frame">
            <button class="text-wrapper" onclick="goBack()">
                < Volver</button>
        </div>
            <div class="actividad-de">
                <div class="header">
                    <div class="div-wrapper">
                        <div class="text">
                            <div class="div">Paros registrados</div>
                            <div class="frame-2">
                                <div class="text-2">
                                    <div class="text-wrapper-2">Producto:</div>
                                </div>
                                <div class="text-2">
                                    <p class="p">1101260 - AC Girasol gota de oro - 12x1000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="buttom"> <img class="img" src="../../app/Assets/css/images/circle-fill.svg" />
                        <div class="text-wrapper-3">Agregar paro</div>
                    </button>
                    <div class="input-select">
                        <select class="filter" id="tipoParo">
                            <option value="" selected hidden>Filtrar por tipo de paro</option>
                            <option value="1">Todos los paros</option>
                            <option value="2">Tiempo planeado de no operación</option>
                            <option value="3">Tiempo en paros y/o ajustes(Mantenimiento)</option>
                            <option value="4">Tiempo en paros y/o ajustes(Proceso)</option>
                            <option value="5">Tiempo en perdidas de Velocidad</option>
                            <option value="6">Tiempo en perdidas de Calidad</option>
                        </select>
                        <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                    </div>
                </div>
            </div>
            <div class="actividad-de">
                <div class="header">
                    <div class="text">
                        <p class="text-wrapper-5">Tiempo planeado de no operación</p>
                    </div>
                </div>
                <div class="div-2">
                    <table class="custom-table" id="tablaDefinicion">
                        <thead>
                            <tr>
                                <th>Tipo de paro</th>
                                <th>Paro</th>
                                <th>Sub paro</th>
                                <th>Razón</th>
                                <th>Tiempo</th>
                                <th>Comentarios</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Tiempo planeado de no operación</td>
                                <td>Tiempo fuera de programación</td>
                                <td>Tiempo no programado</td>
                                <td>Tiempo no programado para operar</td>
                                <td>150</td>
                                <td>La planta arranco a las 12 am</td>
                                <td rowspan="3">

                                    <button class="btn-warning">
                                        <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                                    </button>
                                    <button class="btn-danger">
                                        <img src="/metro/app/Assets/css/images/delete.svg" title="Eliminar">
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function goBack() {
        window.history.back();
    }
    document.getElementById('tipoParo').addEventListener('change', function() {
            filtrarTabla();
        });


        function filtrarTabla() {
            var tipoParo = document.getElementById('tipoParo').value;

            var filas = document.querySelectorAll('#tablaDefinicion tbody tr');

            filas.forEach(function(fila) {
                var tipoParo = fila.cells[0].textContent.trim(); // Columna "ID" (usada para comparar)

                // Filtrar por ciudad ID o departamento, si corresponde
                if ((tipoParo === "" || tipoParo == tipoParo) &&
                    (departamentoSeleccionado === "" || departamento == departamentoSeleccionado)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        }
</script>

</html>