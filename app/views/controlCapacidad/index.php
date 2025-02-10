<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6>Información Básica</h6>
            </div>
            <div class="card-body">
                <form name="registroForm" id="registroForm">
                    <div class="row g-3">
                        <!-- Fecha de registro -->
                        <div class="col-md-4">
                            <label for="fechaRegistro" class="form-label">Fecha de registro</label>
                            <input type="date" class="form-control" name="fechaRegistro" id="fechaRegistro"
                                value="<?= date('Y-m-d') ?>" placeholder="dd/mm/aaaa">
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
                            <input type="text" class="form-control" name="operarioLider" id="operarioLider"
                                placeholder="Ingrese nombre">
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
                            <input type="text" class="form-control" id="num_operarios" name="num_operarios"
                                onchange="handleInputChange(this)" />
                        </div>
                        <!-- Número de horas hombre -->
                        <div class="col-md-4">
                            <label for="horasHombre" class="form-label">No. horas hombre</label>
                            <input type="number" class="form-control" id="h_hombre" name="h_hombre"
                                placeholder="Ingrese horas">
                        </div>
                        <!-- Botón de envío -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6>Tiempo de Operación (TO)</h6>
            </div>
            <div class="card-body">
                <form id="toForm">
                    <div class="row g-3">
                        <div class="col-3">
                            <label for="medidaSelect" class="form-label">Medida</label>
                            <select class="form-select" id="medidaSelect">
                                <option value="kg">Kg</option>
                                <option value="unidades">Unidades</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="itemInput" class="form-label">Ítem/Producto</label>
                            <input type="text" class="form-control" id="itemInput">
                        </div>

                        <div class="col">
                            <label for="hinicial" class="form-label">Hora Inicial</label>
                            <input type="time" class="form-control" id="hinicial">
                        </div>
                        <div class="col">
                            <label for="hfinal" class="form-label">Hora Final</label>
                            <input type="time" class="form-control" id="hfinal">
                        </div>
                        <div class="col-3">
                            <label for="produccionConformeInput" class="form-label">Producción Conforme</label>
                            <input type="number" class="form-control" id="produccionConformeInput">
                        </div>
                        <div class="col-3">
                            <label for="tiempoPerdidoRealesInput" class="form-label">Tiempo Perdido (Reales)</label>
                            <input type="number" class="form-control" id="tiempoPerdidoRealesInput">
                        </div>
                        <div class="col-3">
                            <label for="tiempoPerdidoIdealesInput" class="form-label">Tiempo Perdido (Ideales)</label>
                            <input type="number" class="form-control" id="tiempoPerdidoIdealesInput">
                        </div>
                        <div class="col-3">
                            <label for="produccionIdealHoraInput" class="form-label">Producción Ideal (Hora)</label>
                            <input type="number" class="form-control" id="produccionIdealHoraInput">
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <label for="reprocesoInput" class="form-label">Reproceso</label>
                                    <input type="number" class="form-control" id="reprocesoInput">
                                </div>
                                <div class="col">
                                    <label for="mermasInput" class="form-label">Mermas</label>
                                    <input type="number" class="form-control" id="mermasInput">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <button type="button" class="btn btn-primary" id="agregarProducto">Agregar
                                    Producto</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-danger" id="calcularTiempo">Calcular
                                    Tiempo</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card card-stats card-success card-round">
        <div class="card-body text-center">
            <div class="numbers">
                <p class="card-category ">
                <h6>Caratecriscas de las paradas</h6>
                </p>
                <h4 class="card-title">1345</h4>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h6>Tiempo Planeado de No Operación (TPNO)</h6>
        </div>
        <div class="card-body">
            <div class="row g-3">

            </div>
        </div>
    </div>



    <script>
        //    calcula las horas hombre
        const input = document.getElementById('num_operarios');
        input.addEventListener('input', function () {
            console.log('Valor en tiempo real:', input.value);
            result = input.value * 8;
            $('#h_hombre').val(result).attr('readonly');
        });

        //carga los datos de las lineas segun la palnta
        function ByPlanta() {
            var planta = $('#planta_id').val();
            Linea(planta);
            Turno(planta);
        }
        function Linea(planta) {
            $.ajax({
                url: '<?php echo BASE_PATH ?>linea/getbyplanta/',
                type: 'GET',
                data: {
                    planta: planta
                },
                success: function (response) {
                    var lineas = JSON.parse(response);
                    var select = $('#linea_id');
                    select.empty();
                    select.append('<option value="">Seleccione una línea</option>');
                    $.each(lineas, function (i, linea) {
                        select.append($('<option>', {
                            value: linea.id,
                            text: linea.nombre
                        }));
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }
        function ByLinea() {
            var linea = $('#linea_id').val();
            Proceso(linea);
        }
        function Turno(planta) {

            $.ajax({
                url: '<?php echo BASE_PATH ?>turno/getturnobyplanta/',
                type: 'GET',
                data: {
                    planta: planta
                },
                success: function (response) {
                    var turnos = JSON.parse(response);
                    var select = $('#turno_id');
                    select.empty();
                    select.append('<option value="">Seleccione un turno</option>');
                    $.each(turnos, function (i, turno) {
                        select.append($('<option>', {
                            value: turno.turno_id,
                            text: turno.turno
                        }));
                    });
                },
                error: function (xhr, status, error) {
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

                success: function (response) {
                    var procesos = JSON.parse(response);
                    var select = $('#proceso_id');
                    select.empty();
                    select.append('<option value="">Seleccione un proceso</option>');
                    $.each(procesos, function (i, proceso) {
                        select.append($('<option>', {
                            value: proceso.proceso,
                            text: proceso.nombre
                        }));
                    });
                },
                error: function (xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        function calcularDiferenciaHoras(horaInicio, horaFin) {
            var [h1, m1] = horaInicio.split(':').map(Number);
            var [h2, m2] = horaFin.split(':').map(Number);

            var minutosInicio = h1 * 60 + m1;
            var minutosFin = h2 * 60 + m2;

            var diferencia = minutosFin - minutosInicio;
            if (diferencia < 0) {
                diferencia += 24 * 60; // Ajuste para diferencias en horas cruzadas de medianoche
            }

            return diferencia;
        }


        function TurnoDatos() {
            var turno_id = $('#turno_id').val();
            $.ajax({
                url: '<?php echo BASE_PATH ?>turno/getturnobyid/',
                type: 'GET',
                data: { turno_id: turno_id },
                dataType: "json",
                success: function (response) {
                    if (response && response.length > 0) {
                        var turno = response[0]; // Solo un turno según la estructura JSON

                        $('#hinicial').val(turno.hora_inicio);
                        $('#hfinal').val(turno.hora_fin);

                        // Calcular la diferencia en minutos
                        var ttotal = calcularDiferenciaHoras(turno.hora_inicio, turno.hora_fin);
                        $('#tiempototal').val(ttotal + ' minutos');
                        console.log('Tiempo total en minutos:', ttotal);
                    } else {
                        console.warn('Respuesta vacía o inválida:', response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error en la solicitud:', error);
                }
            });
        }


    </script>