<script src="<?= BASE_PATH ?>/Assets/jquery/jquery-3.7.1.min.js"></script>

<style>
    table {
        font-size: 14px;
        /* Tamaño de fuente más pequeño */
    }

    th {
        background-color: #f4f4f4;
        font-weight: bold;
        font-size: 14px;

    }
</style>
<div class="container">
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
                                    value="<?php echo date('Y-m-d') ?>" placeholder="dd/mm/aaaa">
                            </div>
                            <!-- Plantas -->
                            <div class="col-md-4">
                                <label for="plantas" class="form-label">Plantas</label>
                                <select class="form-select" id="planta_id" name="planta_id" onchange="ByPlanta(this)">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($plantas as $value): ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->nombre_planta ?>
                                        </option>
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
                                <select class="form-select" id="proceso_id" name="proceso_id"
                                    onchange="productosBYPlantaLineaProceso(this)">
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
                                <button type="submit" class="btn btn-primary" id="registrar">Registrar</button>
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
                    <form id="toForm" name="toForm">
                        <div class="row g-3">
                            <div class="col-3">
                                <label for="medidaSelect" class="form-label">Medida</label>
                                <select class="form-select" id="medidaSelect">
                                    <option value="kg">Kg</option>
                                    <option value="unidades">Unidades</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="itemInput" class="form-label">Ítems/Productos</label>
                                <select name="producto_id" id="producto_id" class="form-select select2">
                                    <option selected>Seleccionar</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label for="hinicial" class="form-label">Hora Inicial</label>
                                <input type="time" class="form-control" id="hinicial">
                            </div>
                            <div class="col-3">
                                <label for="hfinal" class="form-label">Hora Final</label>
                                <input type="time" class="form-control" id="hfinal">
                            </div>
                            <div class="col-3">
                                <label for="produccionConformeInput" class="form-label">Producción Conforme</label>
                                <input type="number" class="form-control" id="produccionConforme">
                            </div>
                            <div class="col-3">
                                <label for="tiempoPerdidoIdealesInput" class="form-label">Tiempo Perdido
                                    (Ideal)</label>
                                <input type="number" class="form-control" id="tiempoPerdidoIdealesInput"
                                    name="tiempoPerdidoIdealesInput">
                            </div>
                            <!-- <div class="col">
                                <label for="tiempoPerdidoRealesInput" class="form-label">Tiempo Perdido (Real)</label>
                                <input type="hidden" class="form-control" id="tiempoPerdidoRealesInput">
                            </div>-->
                            <div class="col-md-6 text-center">
                                <div class="row text-center">
                                    <div class="col">
                                        <label for="reprocesoInput" class="form-label">Reproceso</label>
                                        <input type="number" class="form-control" id="reprocesoInput">
                                    </div>
                                    <div class="col">
                                        <label for="mermasInput" class="form-label">Mermas</label>
                                        <input type="number" class="form-control" id="mermasInput">
                                    </div>
                                    <label for="" class="form-label">Producción No Conforme</label>
                                </div>
                            </div>
                            <div class="col-2" id="produccionIdeal0">
                            </div>
                            <div class="col-4" id="produccionIdealHora0">
                            </div>
                            <input type="hidden" class="form-control" id="produccionIdeal" name="produccionIdeal"
                                value="">
                            <input type="hidden" class="form-control" id="produccionIdealHora"
                                name="produccionIdealHora" value="">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-stats card-default card-round">
            <div class="card-body text-center">
                <div class="numbers">
                    <p class="card-category">
                    <h6>Tiempo por Perdidas Ideales</h6>
                    </p>
                    <h4 class="card-title" id="tiempoPerdidasIdeales">0</h4>
                    <table class="table table-bordered mt-4" id="descripcionParos">
                        <thead style="font-size:14px">
                            <tr>
                                <th>Tiempo Total</th>
                                <th>Producción Conforme</th>
                                <th>Reproceso</th>
                                <th>Merma</th>
                                <th>TPI</th>
                                <th>TPR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="tt"></td>
                                <td id="pc"></td>
                                <td id="reproceso"></td>
                                <td id="merma"></td>
                                <td id="tpi"></td>
                                <td id="tpr"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="btn-group dropdown mt-3">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">Agregar Paros</button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a class="dropdown-item" id="tpno" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalId"
                                    onclick="changeModalTitle('TPNO (Tiempo Planeado de No Operación)'),getParoByTipo('tpno')">TPNO
                                    (Tiempo
                                    Planeado de No Operación)</a></li>
                            <li><a class="dropdown-item" id="tpam" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalId"
                                    onclick="changeModalTitle('Tiempo en Paros y Ajustes (Mantenimiento)'),getParoByTipo('tpam')">Tiempo
                                    en
                                    Paros y Ajustes (Mantenimiento)</a></li>
                            <li><a class="dropdown-item" id="tpap" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalId"
                                    onclick="changeModalTitle('Tiempo en Paros y Ajustes (Proceso)'),getParoByTipo('tpp')">Tiempo
                                    en Paros y Ajustes (Proceso)</a></li>
                            <li><a class="dropdown-item" id="tpv" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalId"
                                    onclick="changeModalTitle('Tiempo en Pérdidas por Velocidad (TPV)'),getParoByTipo('tpv')">Tiempo
                                    en
                                    Pérdidas por Velocidad (TPV)</a></li>
                            <li><a class="dropdown-item" id="tpv" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalId"
                                    onclick="changeModalTitle('Tiempo en Pérdidas por Calidad (TPC)'),getParoByTipo('tpc')">Tiempo
                                    en
                                    Pérdidas por Calidad (TPC)</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6>Descripción de paros</h6>
            </div>
            <div class="card-body">
                <div class="row responsive">
                    <table class="table table-bordered mt-4 custom-table" id="tablaParos" style="">
                        <thead>
                            <tr>
                                <th>Paro</th>
                                <th>SubParo</th>
                                <th>Razón</th>
                                <th>Tiempo</th>
                                <th>Descripción</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Filas dinámicas aquí -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalId" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Título del Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="index">
                Contenido del modal aquí...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function changeModalTitle(title) {
        document.getElementById('modalTitle').innerText = title;
    }
    //    calcula las horas hombre
    const input = document.getElementById('num_operarios');
    input.addEventListener('input', function() {
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
                        value: proceso.proceso_id,
                        text: proceso.nombre_proceso
                    }));
                });
            },
            error: function(xhr, status, error) {
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
        $('#tt').html(diferencia);

        return diferencia;
    }

    function productosBYPlantaLineaProceso() {
        var planta_id = $('#planta_id').val();
        var linea_id = $('#linea_id').val();
        var proceso_id = $('#proceso_id').val(); // Corregido: proceso_id debía tomar el valor correcto

        if (!planta_id || !linea_id || !proceso_id) {
            alert('Por favor seleccione valores válidos para planta, línea y proceso.');
            return;
        }

        $.ajax({
            url: '<?php echo BASE_PATH ?>controlCapacidad/productosBYPlantaLineaProceso/',
            type: 'POST',
            data: {
                planta_id: planta_id,
                linea_id: linea_id,
                proceso_id: proceso_id
            },
            dataType: "json",
            success: function(response) {
                // Limpiar y rellenar el select de productos
                $('#producto_id').empty().append('<option value="">Seleccione un producto</option>');

                if (response && response.length > 0) {
                    response.forEach(function(producto) {
                        $('#producto_id').append(
                            `<option value="${producto.id}">${producto.nombre} (${producto.codigo})</option>`
                        );
                    });
                } else {
                    $('#producto_id').append('<option value="">No hay productos disponibles</option>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en la solicitud:', error);
            }
        });
    }

    function TurnoDatos() {
        var turno_id = $('#turno_id').val();
        $.ajax({
            url: '<?php echo BASE_PATH ?>turno/getturnobyid/',
            type: 'GET',
            data: {
                turno_id: turno_id
            },
            dataType: "json",
            success: function(response) {
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
            error: function(xhr, status, error) {
                console.error('Error en la solicitud:', error);
            }
        });
    }

    $("#producto_id").change(function() {
        $(this).off("change"); // Desactiva temporalmente el evento
        let lineaId = $("#linea_id").val();
        let procesoId = $("#proceso_id").val();
        let plantaId = $("#planta_id").val();
        let productoId = $("#producto_id").val();
        $.ajax({
            url: '<?php echo BASE_PATH ?>controlCapacidad/getlineaProducto/',
            type: 'POST',
            data: {
                lineaId: lineaId,
                procesoId: procesoId,
                plantaId: plantaId,
                productoId: productoId
            },
            dataType: "json",
            success: function(response) {
                if (response && typeof response === "object") { // Verifica si es un objeto válido
                    // console.log('Producción Ajustada:', response.produccion_ajustada);
                    // console.log('Producción Teórica:', response.produccion_teorica);
                    // console.log('Datos recibidos:', response);
                    $('#produccionIdeal0').html('<label class="form-label">Producción Ideal: </label>' +
                        response.produccion_ajustada);
                    $('#produccionIdealHora0').html(
                        '<label class="form-label">Producción Ideal*Hora: </label>' + (response
                            .produccion_teorica / 8).toFixed(2));

                    $('#produccionIdeal').val(response.produccion_ajustada);
                    $('#produccionIdealHora').val((response.produccion_teorica / 8).toFixed(
                        2)); // FIX: Ahora está bien cerrado



                } else {
                    console.warn('No se encontraron datos para el producto seleccionado.');
                }
            },

            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
                console.log('Respuesta del servidor:', xhr.responseText);
            }
        });

        $(this).on("change", arguments.callee); // Reactiva el evento después de la ejecución
    });

    $("#produccionConforme").change(function() {
        let produccionIdeal = parseFloat($("#produccionIdeal").val()) || 0; // Producción ideal
        let produccionConforme = parseFloat($(this).val()) || 0; // Producción conforme
        let produccionIdealHora = parseFloat($("#produccionIdealHora").val()) ||
            1; // Producción ideal por hora (evita división por 0)

        let diferencia = produccionIdeal - produccionConforme; // Diferencia de producción

        // Cálculo del Tiempo por Pérdidas Ideales en minutos
        let tiempoPerdidasIdeales = (diferencia / produccionIdealHora) * 60;
        // alert("Diferencia: " + diferencia + "\nTiempo por Pérdidas Ideales: " + tiempoPerdidasIdeales.toFixed(2) + " minutos");
        // Si tienes un campo donde mostrar el resultado, puedes actualizarlo:
        $("#pc").html(produccionConforme);
        $("#tiempoPerdidasIdeales").html(tiempoPerdidasIdeales.toFixed(2) + ' minutos');
        $("#tpi").html(tiempoPerdidasIdeales.toFixed(2) + ' minutos');
        $("#tiempoPerdidoIdealesInput").val(tiempoPerdidasIdeales.toFixed(2));
    });

    $("#tiempoPerdidoRealesInput, #reprocesoInput, #mermasInput").change(function() {
        let targetId = $(this).attr("id"); // Obtener el ID del input cambiado
        let value = $(this).val(); // Obtener el valor ingresado

        // Mapeo de inputs a sus respectivos elementos de salida
        let mapping = {
            "tiempoPerdidoRealesInput": "#tpr",
            "reprocesoInput": "#reproceso",
            "mermasInput": "#merma"
        };

        // Actualizar el valor en el elemento correspondiente
        $(mapping[targetId]).html(value);
    });

    function actualizarTiempos() {
        let tpno = parseInt($('#tpno').val()) || 0;
        let tp_mantenimiento = parseInt($('#tp_mantenimiento').val()) || 0;
        let tp_proceso = parseInt($('#tp_proceso').val()) || 0;
        let tpv = parseInt($('#tpv').val()) || 0;

        let totalParadas = tpno + tp_mantenimiento + tp_proceso + tpv;

        $('#res_tpno').html(tpno);
        $('#res_tp_mantenimiento').html(tp_mantenimiento);
        $('#res_tp_proceso').html(tp_proceso);
        $('#res_tpv').html(tpv);
        $('#res_total').html(totalParadas);
    }

    $(".tiempo-parada").on("input", function() {
        actualizarTiempos();
    });

    function getParoByTipo(TipoParo) {
        $.ajax({
            url: '<?php echo BASE_PATH ?>controlCapacidad/getParoByTipo/',
            type: 'POST',
            data: {
                tipoParo: TipoParo

            },
            // dataType: "json",
            success: function(response) {
                $("#index").html(response);
            },

            error: function(xhr, status, error) {
                console.error('Error en la solicitud AJAX:', error);
                console.log('Respuesta del servidor:', xhr.responseText);
            }
        });


    }



    $(document).ready(function() {
        $("#registroForm").submit(function(event) {
            event.preventDefault(); // Evita la recarga de la página

            // Validar que los campos obligatorios no estén vacíos
            if ($("#planta_id").val() === "" || $("#linea_id").val() === "" || $("#operarioLider").val().trim() === "") {
                Swal.fire("Error", "Por favor, completa los campos obligatorios.", "error");
                return;
            }
            // Obtener datos de "registroForm"
            let form1Data = $("#registroForm").serializeArray();

            // Obtener datos de "toForm"
            let form2Data = $("#toForm").serializeArray();

            // Obtener datos de la tabla "tablaParos"
            let tablaData = [];
            $("#tablaParos tbody tr").each(function() {
                let rowData = {
                    Paro: $(this).find("td:eq(0)").text().trim(),
                    SubParo: $(this).find("td:eq(1)").text().trim(),
                    Razon: $(this).find("td:eq(2)").text().trim(),
                    Tiempo: $(this).find("td:eq(3)").text().trim(),
                    Descripcion: $(this).find("td:eq(4)").text().trim()
                };

                // Agregar solo si hay datos válidos en la fila
                if (rowData.Paro !== "" && rowData.Tiempo !== "") {
                    tablaData.push(rowData);
                }
            });

            // Construir objeto final con datos correctos
            let allData = {
                form1: form1Data,
                form2: form2Data,
                tabla: tablaData
            };

            console.log("Datos a enviar:", allData); // Depuración en consola

            // Enviar con AJAX
            $.ajax({
                type: "POST",
                url: "<?php echo BASE_PATH ?>controlCapacidad/procesarDatos/", // Reemplaza con la URL correcta
                data: JSON.stringify(allData),
                contentType: "application/json",
                dataType: "json",
                success: function(response) {
                    Swal.fire("Éxito", "Datos registrados correctamente." + response.cc, "success").then(() => {

                        window.location.href = '<?php echo BASE_PATH ?>controlCapacidad/ViewData/' + response.cc; // Recargar la página tras éxito
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire("Error", "Hubo un problema al registrar los datos.", "error");
                    console.error("Error AJAX:", error);
                }
            });
        });
    });
</script>