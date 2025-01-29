<div class="col-md-12">
    <div class="consultas-capacidad">
        <div class="info-capacidad">
            <div class="frame">
                <div class="text">
                    <div class="text-wrapper">Registro control de capacidad</div>
                </div>
                <div class="div">
                    <div class="frame-2">
                        <div class="text-wrapper-2">Supervisor</div>
                        <div class="div-wrapper">
                            <div class="text-wrapper-3">Sebastian Diaz</div>
                        </div>
                    </div>
                    <div class="frame-2">
                        <div class="text-wrapper-2">Fecha registro</div>
                        <div class="frame-3">
                            <img class="calendar" src="../app/Assets/css/images/calender.svg" />
                            <div class="text-wrapper-3">
                                <?php
                                $fecha = date('d/m/Y');
                                echo $fecha;
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="frame-2">
                        <div class="text-wrapper-2">Estado</div>
                        <div class="frame-3">
                            <div class="frame-4"></div>
                            <div class="text-wrapper-3">En preparación</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-wrapper-5">Información general</div>
            <div class="drops-downs">
                <div class="element">
                    <div class="textfield">
                        <div class="input">
                            <div class="text-wrapper-6">Fecha de registro</div>
                            <input type="date" id="fechaRegistro" class="time-select">
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">Plantas</div>
                            <select class="select-line" name="planta_id" id="planta_id" onchange="ByPlanta(this)">
                                <option value="">Seleccionar</option>
                                <?php foreach ($plantas as $value): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->nombre_planta ?></option>
                                <?php endforeach; ?>
                            </select>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
                <div class="element">
                    <div class="textfield-2">
                        <div class="input" id="data_linea">
                            <div class="text-wrapper-6">Linea</div>
                            <select class="select-line" id="linea_id" name="linea_id">
                                <option value="">Seleccione una línea</option>
                            </select>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">Proceso</div>
                            <select class="select-line" id="proceso_id" name="proceso_id">
                                <option value="">Seleccionar</option>
                            </select>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
                <div class="element">
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">Nombre del operario líder</div>
                            <input type="text" class="select-line" />
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">No. de operarios</div>
                            <input type="text" class="select-line" id="num_operarios" name="num_operarios" onchange="handleInputChange(this)" />
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
                <div class="element">
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">No. horas hombre</div>
                            <input type="text" class="select-line" id="h_hombre" name="h_hombre" />
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">Turno</div>
                            <select class="select-line" name="turno_id" id="turno_id">
                                <option value="" disabled selected>Seleccionar</option>

                            </select>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tiempo-de-operacion">
            <div class="frame-5">
                <div class="text-wrapper-10">Tiempo de operación</div>
                <button class="div-3" id="verParos" onclick="redireccionar()"> <img class="img-paro" src="../app/Assets/css/images/eye.svg" />
                    Ver paros
                </button>
                <button class="div-3" id="agregarParos" onclick="redireccionarModals()"> <img class="img-plus" src="../app/Assets/css/images/circle.svg">
                    Agrega un paro
                </button>
                <button class="div-3" id="borrar"> <img class="img-paro" src="../app/Assets/css/images/delete-trash.svg" />
                    Borrar
                </button>
            </div>
            <div class="operacion">
                <div class="drops-downs">
                    <div class="element">
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-6">Producto</div>
                                <div class="div-2">
                                    <select class="select-line">
                                        <option value="" disabled selected>Seleccionar</option>
                                        <option value="1">Envase líquido</option>
                                        <option value="2">Envase sólido</option>
                                        <option value="3">Envase semilíquido</option>
                                    </select>
                                </div> <img class="underline" src="../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-6">Hora inicial</div>
                                <div class="div-2">
                                    <input type="time" class="time-select" placeholder="HH:MM">
                                </div> <img class="underline" src="../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                    </div>
                    <div class="element-2">
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-6">Hora final</div>
                                <input type="time" class="time-select" placeholder="HH:MM">
                                <img class="underline" src="../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-6">Tiempo total</div>
                                <select class="select-line">
                                    <option value="" disabled selected>Seleccionar</option>
                                    <option value="1">360</option>
                                    <option value="2">3600</option>
                                    <option value="3">3600</option>
                                    <option value="4">3600</option>
                                    <option value="5">3600</option>
                                </select>
                                <img class="underline" src="../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                    </div>
                    <div class="element">
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-6">Producción conforme</div>
                                <input type="text" class="select-line" />
                                <img class="underline" src="../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-6">Reproceso</div>
                                <input type="text" class="select-line" />
                                <img class="underline" src="../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="datos">
                    <div class="element-3">
                        <div class="frame-6">
                            <div class="text-wrapper-13">Tiempo por perdida ideales:</div>
                        </div>
                        <div class="text-wrapper-14">----</div>
                    </div>
                    <div class="element-3">
                        <div class="frame-6">
                            <div class="text-wrapper-13">Tiempo por perdida reales:</div>
                        </div>
                        <div class="text-wrapper-14">----</div>
                    </div>
                    <div class="element-3">
                        <div class="frame-6">
                            <div class="text-wrapper-13">Producción ideal total:</div>
                        </div>
                        <div class="text-wrapper-14">----</div>
                    </div>
                    <div class="element-3">
                        <div class="frame-6">
                            <div class="text-wrapper-13">Producción ideal por hora:</div>
                        </div>
                        <div class="text-wrapper-14">----</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="buttom">
            <button class="buttom-2" id="btnAgregarProducto"> <!-- <img class="img" src="../app/Assets/css/images/02-circle-2.svg" /> -->
                Agregar producto
            </button>
            <button class="buttom-3" id="btnGuardar"> <!-- <img class="img" src="../app/Assets/css/images/05-download.png" /> -->
                Guardar
            </button>
        </div>
    </div>
    <!-- <script src="../app/Assets/jquery/jquery.min.js"></script> -->
    <script>
        // function redireccionar() {
        //     window.location.href = "../app/controlCapacidad/paradas";
        // }

        // function redireccionarModals() {
        //     window.location.href = "../app/controlCapacidad/modal1";
        // }

        function ByPlanta() {
            var planta = $('#planta_id').val();
            Linea(planta);
            Turno(planta);
            Proceso(planta);
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

        function Proceso(planta) {
            $.ajax({
                url: '<?php echo BASE_PATH ?>proceso/GetProcesoByPlanta/',
                type: 'GET',
                data: {
                    planta: planta
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

        document.addEventListener("DOMContentLoaded", function() {
            const botonesParos = [
                document.getElementById('verParos'),
                document.getElementById('agregarParos'),
                document.getElementById('borrar')
            ];

            const botonAgregarProducto = document.getElementById('btnAgregarProducto');
            const botonGuardar = document.getElementById('btnGuardar');

            const inputsRequeridos = [
                document.querySelector('.consultas-capacidad input[type="date"]'),
                document.querySelector('.operacion select.select-line'),
                document.querySelector('.consultas-capacidad select.select-line'),
                document.querySelector('.operacion input[type="time"]'),
                document.querySelector('.operacion input[type="text"]')
            ];

            function toggleButtons() {
                inputsRequeridos.forEach((input, index) => {
                    console.log(`Input ${index} (${input && input.type}): ${input ? input.value : "null"}`);
                });

                const algunVacio = inputsRequeridos.some(input => input == null || input.value.length === 0);
                console.log(`Algún input vacío: ${algunVacio}`);

                botonesParos.forEach(boton => {
                    if (algunVacio) {
                        boton.disabled = true;
                        boton.style.color = '#9c9c9c'; // Color gris claro
                    } else {
                        boton.disabled = false;
                        boton.style.color = 'black';
                    }
                });

                if (algunVacio) {
                    botonAgregarProducto.disabled = true;
                    botonAgregarProducto.style.borderColor = '#9c9c9c';
                    botonAgregarProducto.style.color = '#9c9c9c';
                    botonGuardar.disabled = true;
                    botonGuardar.style.backgroundColor = '#cccccc';
                    botonGuardar.style.color = '#666666';
                    botonGuardar.style.border = '1px solid #aaaaaa';
                    botonBorrar.style.display = 'none';
                } else {
                    botonAgregarProducto.disabled = false;
                    botonAgregarProducto.style.borderColor = '#0a843c';
                    botonAgregarProducto.style.color = '#0a843c';
                    botonGuardar.disabled = false;
                    botonGuardar.style.backgroundColor = '#0a843c';
                    botonGuardar.style.color = '#ffffff';
                    botonGuardar.style.border = 'none';
                    botonBorrar.style.display = 'flex';
                }
            }

            inputsRequeridos.forEach(input => {
                if (input) {
                    input.addEventListener('input', toggleButtons);
                }
            });

            toggleButtons();
        });
    </script>