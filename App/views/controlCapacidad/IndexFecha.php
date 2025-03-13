<script src="<?= BASE_PATH ?>/Assets/jquery/jquery-3.7.1.min.js"></script>
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
                            <!-- Equipos -->
                            <div class="col-md-4">
                                <label for="equipo" class="form-label">Equipo</label>
                                <select class="form-select" id="equipo_id" name="equipo_id">
                                    <option value="">Seleccionar</option>
                                    <?php foreach ($equipos as $value): ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->nombre ?>
                                        </option>
                                    <?php endforeach; ?>
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

                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12 text-center mt-3">
                            <button
                                id="rangoFechas"
                                data-bs-toggle="modal"
                                data-bs-target="#modalId"
                                class="btn btn-primary"
                                onclick="changeModalTitle('TPNO (Tiempo Planeado de No Operación)'),getParoByTipo('tpnof')">Agregar TPNO por rango de fechas</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>Descripción de paros</h6>
                </div>
                <div class="card-body">
                    <div class="row responsive">
                        <div class="col-md-12">
                            <table class="table table-bordered mt-4" id="tablaParos">
                                <thead>
                                    <tr>
                                        <th style="text-transform: capitalize;">Inicio</th>
                                        <th style="text-transform: capitalize;">Fin</th>
                                        <th style="text-transform: capitalize;">Duración</th>
                                        <th style="text-transform: capitalize;">Paro/Razón</th>
                                        <th style="text-transform: capitalize;">Descripción</th>
                                        <th style="text-transform: capitalize;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Filas dinámicas aquí -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary" id="registrar">Registrar</button>
                    </div>
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

    $("#produccionConforme, #reprocesoInput, #mermasInput, #horaInicial, #horaFinal").change(function() {
        let produccionIdeal = parseFloat($("#produccionIdeal").val()) || 0;
        let produccionConforme = parseFloat($("#produccionConforme").val()) || 0;
        let produccionIdealHora = parseFloat($("#produccionIdealHora").val()) || 1;
        let reproceso = parseFloat($("#reprocesoInput").val()) || 0;
        let mermas = parseFloat($("#mermasInput").val()) || 0;
        let produccionNoConforme = reproceso + mermas;

        // Calcular el tiempo total de operación
        let horaInicial = $("#horaInicial").val();
        let horaFinal = $("#horaFinal").val();
        let tiempoTotalOperacion = Math.max((horaFinal - horaInicial) / (1000 * 60), 0);

        // Cálculo del Tiempo Perdido por Producción Ideal
        let diferencia = Math.max(produccionIdeal - produccionConforme, 0);
        let tiempoPerdidasIdeales = (diferencia / produccionIdealHora) * 60;

        // Cálculo del Tiempo Perdido por Producción No Conforme
        let tiempoPerdidoReproceso = (reproceso / produccionIdealHora) * 60;
        let tiempoPerdidoMerma = (mermas / produccionIdealHora) * 60;
        let tiempoTotalPerdido = tiempoPerdidasIdeales + tiempoPerdidoReproceso + tiempoPerdidoMerma;

        if (tiempoTotalPerdido > tiempoTotalOperacion) {
            tiempoTotalPerdido = tiempoTotalOperacion;
        }
        // let tt =  calcularDiferenciaHoras($("#horaInicial").val(), $("#horaFinal").val());
        // Actualizar la interfaz con los valores y tiempos
        // $("#tt").text(tiempoTotalOperacion.toFixed(0) + " min");
        $("#pc").html(produccionConforme + " <br>(" + tiempoPerdidasIdeales.toFixed(0) + " min)");
        $("#reproceso").html(reproceso + " <br>(" + tiempoPerdidoReproceso.toFixed(0) + " min)");
        $("#merma").html(mermas + " <br>(" + tiempoPerdidoMerma.toFixed(0) + " min)");
        $("#tpi").text(tiempoPerdidasIdeales.toFixed(0) + " min");
        $("#tpr").text(tiempoTotalPerdido.toFixed(0) + " min");
        $("#tiempoPerdidasIdeales").text(tiempoTotalPerdido.toFixed(0) + " min");
        $("#tiempoPerdidoIdealesInput").val(tiempoTotalPerdido.toFixed(0));

    });


    // $("#tiempoPerdidoRealesInput, #reprocesoInput, #mermasInput").change(function() {
    //     let targetId = $(this).attr("id"); // Obtener el ID del input cambiado
    //     let value = $(this).val(); // Obtener el valor ingresado

    //     // Mapeo de inputs a sus respectivos elementos de salida
    //     let mapping = {
    //         "tiempoPerdidoRealesInput": "#tpr",
    //         "reprocesoInput": "#reproceso",
    //         "mermasInput": "#merma"
    //     };

    //     // Actualizar el valor en el elemento correspondiente
    //     $(mapping[targetId]).html(value);
    // });

    function actualizarTiempos() {
        let tpno = parseInt($('#tpno').val()) || 0;
        let tp_mantenimiento = parseInt($('#tp_mantenimiento').val()) || 0;
        let tp_proceso = parseInt($('#tp_proceso').val()) || 0;
        let tpv = parseInt($('#tpv').val()) || 0;

        let totalParadas = tpno + tp_mantenimiento + tp_proceso + tpv;

        // $('#res_tpno').html(tpno);
        $('#res_tp_mantenimiento').html(tp_mantenimiento);
        $('#res_tp_proceso').html(tp_proceso);
        $('#res_tpv').html(tpv);
        $('#res_total').html(totalParadas);
    }

    $(".tiempo-parada").on("input", function() {
        actualizarTiempos();
    });


    $("#hinicial, #hfinal").on("change", function() {
        let hinicial = $("#hinicial").val();
        let hfinal = $("#hfinal").val();
        calcularDiferenciaHoras(hinicial, hfinal);
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
        $("#registrar").click(function(event) {
            event.preventDefault(); // Evita la recarga de la página

            // Validar que los campos obligatorios no estén vacíos
            if ($("#planta_id").val() === "" || $("#linea_id").val() === "" || $("#operarioLider").val().trim() === "") {
                Swal.fire("Error", "Por favor, completa los campos obligatorios.", "error");
                return;
            }
            // Obtener datos de "registroForm"
            let form1Data = $("#registroForm").serializeArray();

            // Obtener datos de "toForm"
            //let form2Data = $("#toForm").serializeArray();

            // Obtener datos de la tabla "tablaParos"
            let tablaData = [];
            $("#tablaParos tbody tr").each(function() {
                let rowData = {
                    inicio: $(this).find("td:eq(0)").text().trim(),
                    fin: $(this).find("td:eq(1)").text().trim(),
                    Tiempo: $(this).find("td:eq(2)").text().trim(),
                    Paro: $(this).find("td:eq(3)").text().trim(),
                    SubParo: $(this).find("td:eq(3)").text().trim(),
                    Razon: $(this).find("td:eq(3)").text().trim(),
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
                tabla: tablaData
            };

            console.log("Datos a enviar:", allData); // Depuración en consola

            // Enviar con AJAX
            $.ajax({
                type: "POST",
                url: "<?php echo BASE_PATH ?>controlCapacidad/procesarDatosFecha/", // Reemplaza con la URL correcta
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