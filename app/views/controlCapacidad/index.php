<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../app/Assets/css/globals.css" />
    <link rel="stylesheet" href="../app/Assets/css/styleguide.css" />
    <link rel="stylesheet" href="../app/Assets/css/style.css" />
</head>

<body>
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
                            <div class="text-wrapper-6">Planta</div>
                            <select class="select-line">
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="buga">Buga</option>
                                <option value="cali">Cali</option>
                                <option value="medellin">Medellin</option>
                                <option value="barranquilla">Barranquilla</option>
                                <option value="cartagena">Cartagena</option>
                                <option value="santamartha">Santa Marta</option>
                                <option value="pereira">Pereira</option>
                                <option value="manizales">Manizales</option>
                                <option value="pasto">Pasto</option>
                                <option value="cucuta">Cucuta</option>
                                <option value="bogota">Bogota</option>
                            </select>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
                <div class="element">
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">Linea</div>
                            <select class="select-line">
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="liquidosbogota">Liquidos Bogota</option>
                                <option value="liquidosbarranquilla">Liquidos Barranquilla</option>
                                <option value="liquidoscartagena">Liquidos Cartagena</option>
                                <option value="liquidosmedellin">Liquidos Medellin</option>
                                <option value="liquidospereira">Liquidos Pereira</option>
                                <option value="liquidosmanizales">Liquidos Manizales</option>
                                <option value="liquidospasto">Liquidos Pasto</option>
                                <option value="liquidoscucuta">Liquidos Cucuta</option>
                            </select>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">Proceso</div>
                            <input type="text" class="select-line">
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
                            <input type="text" class="select-line" />
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
                <div class="element">
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">No. horas hombre</div>
                            <input type="text" class="select-line" />
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">Turno</div>
                            <select class="select-line">
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="1">Turno 1</option>
                                <option value="2">Turno 2</option>
                                <option value="3">Turno 3</option>
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
</body>
<script>
    function redireccionar() {
        window.location.href = "../app/controlCapacidad/paradas";
    }

    function redireccionarModals() {
        window.location.href = "../app/controlCapacidad/modal1";
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

</html>