<div class="card border-0 w-100">
    <h5 class="card-header">Registro control de capacidad</h5>
    <div class="card-body">
        <div class="container-fluid mt-3">
            <form name="registroForm" id="registroForm">
                <div class="row g-3">
                    <!-- Fecha de registro -->
                    <div class="col-md-4">
                        <label for="fechaRegistro" class="form-label">Fecha de registro</label>
                        <input type="date" class="form-control" name="fechaRegistro" id="fechaRegistro" value="<?= date('Y-m-d') ?>" placeholder="dd/mm/aaaa">
                    </div>
                    <!-- Plantas -->
                    <div class="col-md-4">
                        <label for="plantas" class="form-label">Plantas</label>
                        <select class="form-select" id="planta_id" name="planta_id" onchange="ByPlanta(this)">
                            <option value="">Seleccionar</option>
                            <?php foreach ($plantas as $value): ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->nombre_planta ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Línea -->
                    <div class="col-md-4">
                        <label for="linea" class="form-label">Línea</label>
                        <select class="form-select" id="linea_id" name="linea_id" onchange="ByLinea(this)">
                            <option value="">Seleccione una línea</option>
                        </select>
                    </div>
                    <!-- Proceso -->
                    <div class="col-md-4">
                        <label for="proceso" class="form-label">Proceso</label>
                        <select class="form-select" id="proceso_id" name="proceso_id">
                            <option value="">Seleccionar</option>
                        </select>
                    </div>
                    <!-- Nombre del operario líder -->
                    <div class="col-md-4">
                        <label for="operarioLider" class="form-label">Nombre del operario líder</label>
                        <input type="text" class="form-control" name="operarioLider" id="operarioLider" placeholder="Ingrese nombre">
                    </div>
                    <!-- Turno -->
                    <div class="col-md-4">
                        <label for="turno" class="form-label">Turno</label>
                        <select class="form-select" id="turno_id" name="turno_id" onchange="TurnoDatos(this)">
                            <option selected>Seleccionar</option>
                        </select>
                    </div>
                    <!-- Número de operarios -->
                    <div class="col-md-4">
                        <label for="numOperarios" class="form-label">No. de operarios</label>
                        <input type="text" class="form-control" id="num_operarios" name="num_operarios" onchange="handleInputChange(this)" />
                    </div>
                    <!-- Número de horas hombre -->
                    <div class="col-md-4">
                        <label for="horasHombre" class="form-label">No. horas hombre</label>
                        <input type="number" class="form-control" id="h_hombre" name="h_hombre" placeholder="Ingrese horas">
                    </div>
                    <!-- Botón de envío -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card border-0 w-100">
    <div class="card-header">
        <div class="row">
            <div class="col-md-10">
                <h5>Tiempo de Operación (TO)</h5>
            </div>
            <div class="col">
                <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop"
                    onclick="Cargar('agregarproducto', 'producto', '')">
                    Agregar Producto
                </button>

            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid mt-3">
            <input type="hidden" name="rcc_id" id="rcc_id">
            <form name="registroForm2" id="registroForm2">
                <div class="row g-3">
                    <!-- hora inicio -->
                    <div class="col-2">
                        <label for="tunidad" class="form-label">Tipo Unidad</label>
                        <input type="text" class="form-control" name="tunidad" id="tunidad" value="" placeholder="KG">
                    </div>
                    <div class="col-md-4">
                        <label for="hinicial" class="form-label">Hora Inicial</label>
                        <input type="time" class="form-control" name="hinicial" id="hinicial" value="" placeholder="(hh:mm)">
                    </div>
                    <!-- hora fin -->
                    <div class="col-md-4">
                        <label for="hfinal" class="form-label">Hora Final(hh:mm)</label>
                        <input type="time" class="form-control" name="hfinal" id="hfinal" value="" placeholder="(hh:mm)">
                    </div>
                    <!-- tiempo total  -->
                    <div class="col-md-2">
                        <label for="tiempototal" class="form-label">Tiempo Total</label>
                        <input type="text" class="form-control" name="tiempototal" id="tiempototal" value="" placeholder="Minutos">
                    </div>
                    <!-- Producción Conforme -->
                    <div class="col-md-4">
                        <label for="prodConforme" class="form-label">Producción Conforme</label>
                        <input type="number" class="form-control" name="prodConforme" id="prodConforme" value="" placeholder="cantidad">
                    </div>
                    <!-- ProducciónNoConforme -->
                    <div class="col-md-4">
                        <div class="row">
                            <label for="pnc" class="form-label">Producción No Conforme</label>
                            <div class="col">
                                <input type="number" class="form-control" name="pnc_reproceso" id="pnc_reproceso" value="" placeholder="Reproceso">
                            </div>
                            <div class="col">
                                <input type="number" class="form-control" name="pnc_mermas" id="pnc_mermas" value="" placeholder="Mermas">
                            </div>
                        </div>
                    </div>
                    <!-- Tiempo por Perdidas Ideales -->
                    <div class="col-md-4">
                        <label for="prodConforme" class="form-label">Tiempo por Perdidas Ideales</label>
                        <input type="number" class="form-control" name="prodConforme" id="prodConforme" value="" placeholder="cantidad">
                    </div>
                    <!-- Tiempo por Perdidas Reales -->
                    <div class="col-md-4">
                        <label for="prodConforme" class="form-label">Tiempo por Perdidas Reales</label>
                        <input type="number" class="form-control" name="prodConforme" id="prodConforme" value="" placeholder="cantidad">
                    </div>
                    <!--Producción Ideal-->
                    <div class="col-md-4">
                        <label for="prodConforme" class="form-label">Producción Ideal</label>
                        <input type="number" class="form-control" name="prodConforme" id="prodConforme" value="" placeholder="cantidad">
                    </div>
                    <!-- ProducciónIdeal(Hora) -->
                    <div class="col-md-4">
                        <label for="prodConforme" class="form-label">ProducciónIdeal(Hora)</label>
                        <input type="number" class="form-control" name="prodConforme" id="prodConforme" value="" placeholder="cantidad">
                    </div>
                    <!-- Botón de envío -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- <div class="container"> -->
<!-- <div class="container"> -->


<div class="card">
    <div class="card-header">
        <h5>Tiempo de Operación (TO)</h5>
    </div>
    <div class="card-body">
        <form id="operacionForm">
            <div id="productosContainer">
                <!-- <div class="producto"> -->
                <div class="row">
                    <div class="col-md-1">
                        <label for="tipoUnidad" class="form-label">Medida:</label>
                        <input type="text" class="form-control" name="tipoUnidad" value="Kg" required>
                    </div>
                    <div class="col-md-3">
                        <label for="itemProducto" class="form-label">Ítem/Producto:</label>
                        <select class="form-select" name="itemProducto" onchange="actualizarValoresReferencia(this)" required>
                            <option value="FRISOQUE - 5500">FRISOQUE - 5500</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="horaInicio" class="form-label">Hora Inicial:</label>
                        <input type="time" class="form-control" name="horaInicio" value="06:00" onchange="calcularTiempo(this)" required>
                    </div>
                    <div class="col-md-2">
                        <label for="horaFin" class="form-label">Hora Final:</label>
                        <input type="time" class="form-control" name="horaFin" value="14:00" onchange="calcularTiempo(this)" required>
                    </div>
                    <div class="col-md-2">
                        <label for="tiempoTotal" class="form-label">Total(minutos):</label>
                        <input type="number" class="form-control" name="tiempoTotal" value="480" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="produccionConforme" class="form-label">Producción Conforme:</label>
                        <input type="number" class="form-control" name="produccionConforme" value="40000" onchange="calcularTiempo(this)" required>
                    </div>
                    <div class="col-md-4">
                        <label for="produccionNoConforme" class="form-label">Producción No Conforme:</label>
                        <div class="row g-2 subitem">
                            <div class="col-md-6">
                                <label for="reproceso" class="form-label">Reproceso:</label>
                                <input type="number" class="form-control" name="reproceso" value="0" onchange="calcularTiempo(this)" required>
                            </div>
                            <div class="col-md-6">
                                <label for="mermas" class="form-label">Mermas:</label>
                                <input type="number" class="form-control" name="mermas" value="0" onchange="calcularTiempo(this)" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="tiempoPerdidoReales" class="form-label">Tiempo Perdido (Reales):</label>
                        <input type="number" class="form-control" name="tiempoPerdidoReales" value="43" onchange="calcularTiempo(this)" required>
                    </div>
                    <div class="col-md-4">
                        <label for="tiempoPerdidoIdeales" class="form-label">Tiempo Perdido (Ideales):</label>
                        <input type="number" class="form-control" name="tiempoPerdidoIdeales" value="13" onchange="calcularTiempo(this)" required>
                    </div>
                    <div class="col-md-4">
                        <label for="produccionIdealHora" class="form-label">Producción Ideal (Hora):</label>
                        <input type="number" class="form-control" name="produccionIdealHora" value="5500" readonly>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm eliminarProducto">Eliminar</button>
                    </div>
                </div>
                <hr>
            </div>
    </div>
    <div class="mt-4">
        <button type="button" class="btn btn-success btn-sm" id="agregarProducto">Agregar Producto</button>
    </div>

    <div class="mt-4">
        <button type="button" class="btn btn-primary" onclick="calcularTiempo()">Calcular Tiempo</button>
    </div>
    </form>



    <div class="mt-4 resultados">
        <h2>Resultados</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Tiempo Operación (TO)</th>
                    <th>Producción Ideal (TO)</th>
                    <th>AT</th>
                </tr>
            </thead>
            <tbody id="resultadosBody">
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="index">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('registroForm2').querySelectorAll('input, select, textarea, button').forEach(element => {
        element.disabled = true;
    });

    function ByPlanta() {
        var planta = $('#planta_id').val();
        Linea(planta);
        Turno(planta);
    }

    function ByLinea() {
        var linea = $('#linea_id').val();
        Proceso(linea);
    }

    const input = document.getElementById('num_operarios');
    input.addEventListener('input', function() {
        console.log('Valor en tiempo real:', input.value);
        result = input.value * 8;
        $('#h_hombre').val(result).attr('readonly');
    });

    function Linea(planta) {
        $.ajax({
            url: '<?php echo BASE_PATH ?>linea/getbyplanta/',
            type: 'GET',
            data: {
                planta: planta
            },
            success: function(response) {
                var lineas = JSON.parse(response);
                var select = $('#linea_id');
                select.empty();
                select.append('<option value="">Seleccione una línea</option>');
                $.each(lineas, function(i, linea) {
                    select.append($('<option>', {
                        value: linea.id,
                        text: linea.nombre
                    }));
                });
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function Turno(planta) {
        $.ajax({
            url: '<?php echo BASE_PATH ?>turno/getturnobyplanta/',
            type: 'GET',
            data: {
                planta: planta
            },
            success: function(response) {
                var turnos = JSON.parse(response);
                var select = $('#turno_id');
                select.empty();
                select.append('<option value="">Seleccione un turno</option>');
                $.each(turnos, function(i, turno) {
                    select.append($('<option>', {
                        value: turno.turno_id,
                        text: turno.turno
                    }));
                });
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function Proceso(linea) {
        $.ajax({
            url: '<?php echo BASE_PATH ?>proceso/GetProcesoByPlanta/',
            type: 'GET',
            data: {
                linea: linea
            },

            success: function(response) {
                var procesos = JSON.parse(response);
                var select = $('#proceso_id');
                select.empty();
                select.append('<option value="">Seleccione un proceso</option>');
                $.each(procesos, function(i, proceso) {
                    select.append($('<option>', {
                        value: proceso.proceso,
                        text: proceso.nombre
                    }));
                });
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    function calcularDiferenciaHoras() {
        // Obtener los valores de los inputs
        const horaInicial = document.getElementById('hinicial').value;
        const horaFinal = document.getElementById('hfinal').value;

        if (!horaInicial || !horaFinal) {
            alert('Por favor ingrese ambas horas.');
            return;
        }

        // Convertir las horas a objetos Date
        const [h1, m1] = horaInicial.split(':').map(Number);
        const [h2, m2] = horaFinal.split(':').map(Number);

        const inicio = new Date();
        inicio.setHours(h1, m1, 0);

        const fin = new Date();
        fin.setHours(h2, m2, 0);

        // Calcular la diferencia en milisegundos
        let diferenciaMs = fin - inicio;

        // Si la diferencia es negativa, se asume que el horario cruzó la medianoche
        if (diferenciaMs < 0) {
            diferenciaMs += 24 * 60 * 60 * 1000;
        }

        // Convertir la diferencia a minutos
        const diferenciaMinutos = Math.floor(diferenciaMs / (1000 * 60));

        // Mostrar el resultado en el input de tiempo total
        $('#tiempototal').val(diferenciaMinutos + ' minutos');
    }

    function TurnoDatos() {
        var turno_id = $('#turno_id').val();
        $.ajax({
            url: '<?php echo BASE_PATH ?>turno/getturnobyid/',
            type: 'GET',
            data: {
                turno_id: turno_id
            },
            success: function(response) {
                // try {
                var turnos = JSON.parse(response);
                turnos.forEach(turno => {
                    $('#hinicial').val(turno.hora_inicio);
                    $('#hfinal').val(turno.hora_fin);

                    // Calcular la diferencia en minutos
                    var ttotal = calcularDiferenciaHoras();
                    // $('#tiempototal').val(ttotal + ' minutos');
                });

                // } catch (error) {
                //     console.error('Error al procesar la respuesta JSON:', error);
                // }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    document.getElementById('agregarProducto').addEventListener('click', function() {
        const productosContainer = document.getElementById('productosContainer');
        const nuevoProducto = document.createElement('div');
        nuevoProducto.classList.add('producto');
        nuevoProducto.innerHTML = `
        <div class="row g-3">
            <div class="col-md-4">
                <label for="tipoUnidad" class="form-label">Tipo de Unidad (Kg):</label>
                <input type="text" class="form-control" name="tipoUnidad" value="Kg" required>
            </div>
            <div class="col-md-4">
                <label for="itemProducto" class="form-label">Ítem/Producto:</label>
                <select class="form-select" name="itemProducto" required>
                    <option value="FRISOQUE - 5500">FRISOQUE - 5500</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="horaInicio" class="form-label">Hora Inicial:</label>
                <input type="time" class="form-control" name="horaInicio" value="06.00" required>
            </div>
            <div class="col-md-4">
                <label for="horaFin" class="form-label">Hora Final:</label>
                <input type="time" class="form-control" name="horaFin" value="14:00" required>
            </div>
            <div class="col-md-4">
                <label for="tiempoTotal" class="form-label">Tiempo Total (minutos):</label>
                <input type="number" class="form-control" name="tiempoTotal" value="480" readonly>
            </div>
            <div class="col-md-4">
                <label for="produccionConforme" class="form-label">Producción Conforme:</label>
                <input type="number" class="form-control" name="produccionConforme" value="40000" required>
            </div>
            <div class="col-md-4">
                <label for="produccionNoConforme" class="form-label">Producción No Conforme:</label>
                <input type="number" class="form-control" name="produccionNoConforme" value="0" required>
            </div>
            <div class="col-md-4">
                <label for="Reproceso:</label>
                <input type="number" class="form-control" name="reproceso" value="0" required>
                </div>
                <div class="col-md-4">
                <label for="mermas" class="form-label">Mermas:</label>
                <input type="number" class="form-control" name="mermas" value="0" required>
                </div>
                <div class="col-md-4">
                <label for="tiempoPerdidoReales" class="form-label">Tiempo Perdido (Reales):</label>
                <input type="number" class="form-control" name="tiempoPerdidoReales" value="43" required>
                </div>
                <div class="col-md-4">
                <label for="tiempoPerdidoIdeales" class="form-label">Tiempo Perdido (Ideales):</label>
                <input type="number" class="form-control" name="tiempoPerdidoIdeales" value="13" required>
                </div>
                <div class="col-md-4">
                <label for="produccionIdealHora" class="form-label">Producción Ideal (Hora):</label>
                <input type="number" class="form-control" name="produccionIdealHora" value="5500" required>
                </div>
                <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm eliminarProducto">Eliminar</button>
                </div>
                </div>
            <hr>
`;
        productosContainer.appendChild(nuevoProducto);
        // Agregar evento para eliminar producto
        const botonesEliminar = nuevoProducto.querySelectorAll('.eliminarProducto');
        botonesEliminar.forEach(boton => {
            boton.addEventListener('click', function() {
                nuevoProducto.remove();
            });
        });
    });

    // Función para calcular los resultados
    function calcularTiempo() {
        const productos = document.querySelectorAll('.producto');
        const resultadosBody = document.getElementById('resultadosBody');
        resultadosBody.innerHTML = ''; // Limpiar resultados anteriores

        productos.forEach((producto, index) => {
            const tipoUnidad = producto.querySelector('[name="tipoUnidad"]').value;
            const itemProducto = producto.querySelector('[name="itemProducto"]').value;
            const horaInicio = producto.querySelector('[name="horaInicio"]').value;
            const horaFin = producto.querySelector('[name="horaFin"]').value;
            const tiempoTotal = parseInt(producto.querySelector('[name="tiempoTotal"]').value);
            const produccionConforme = parseInt(producto.querySelector('[name="produccionConforme"]').value);
            const produccionNoConforme = parseInt(producto.querySelector('[name="produccionNoConforme"]').value);
            const tiempoPerdidoReales = parseInt(producto.querySelector('[name="tiempoPerdidoReales"]').value);
            const tiempoPerdidoIdeales = parseInt(producto.querySelector('[name="tiempoPerdidoIdeales"]').value);
            const produccionIdealHora = parseInt(producto.querySelector('[name="produccionIdealHora"]').value);

            // Calcula los resultados (reemplaza con tu lógica específica)
            const tiempoOperacion = tiempoTotal - tiempoPerdidoReales;
            const produccionIdealTO = (produccionIdealHora / 60) * tiempoOperacion;
            const at = (produccionConforme / produccionIdealTO) * 100;

            // Muestra los resultados en la tabla
            resultadosBody.innerHTML += `
        <tr>
            <td><span class="math-inline">\{itemProducto\}</td\>
<td>{tiempoOperacion.toFixed(2)}</td>
<td>produccionIdealTO.toFixed(2)</td><td>{at.toFixed(2)}%</td>
</tr>
`;
        });
    }
</script>

<style>
    .producto {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }

    .resultados {
        margin-top: 20px;
    }

    .resultados table {
        width: 100%;
    }

    .resultados th,
    .resultados td {
        text-align: center;
    }

    .subitem {
        font-size: smaller;
    }
</style>

</style>