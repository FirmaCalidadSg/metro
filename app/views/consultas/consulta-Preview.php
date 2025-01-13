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
                            <img class="calendar" src="../../app/Assets/css/images/calender.svg" />
                            <div class="text-wrapper-3">
                                16/10/2024
                            </div>
                        </div>
                        
                    </div>
                    <div class="frame-2">
                        <div class="text-wrapper-2">Estado</div>
                        <div class="frame-3">
                            <div class="frame-9"></div>
                            <div class="text-wrapper-3">Registrado</div>
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
                            <div class="text-wrapper-3">16/10/2024</div>
                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">Planta</div>
                            <div class="text-wrapper-3">Bogota</div>
                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
                <div class="element">
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">Linea</div>
                            <div class="text-wrapper-3">Liquidos Buga</div>
                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">Proceso</div>
                            <div class="text-wrapper-3">Envase Liquido</div>
                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
                <div class="element">
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">Nombre del operario líder</div>
                            <div class="text-wrapper-3">Sebastian Diaz</div>
                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">No. de operarios</div>
                            <div class="text-wrapper-3">10</div>
                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
                <div class="element">
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">No. horas hombre</div>
                                <div class="text-wrapper-3">40</div>
                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield-2">
                        <div class="input">
                            <div class="text-wrapper-6">Turno</div>
                            <div class="text-wrapper-3">Turno 1</div>
                            <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tiempo-de-operacion">
            <div class="frame-5">
                <div class="text-wrapper-10">Tiempo de operación</div>
                <button class="div-3" id="verParos" onclick="redireccionar()"> <img class="img-paro" src="../../app/Assets/css/images/eye.svg" />
                    Ver paros
                </button>
            </div>
            <div class="operacion">
                <div class="drops-downs">
                    <div class="element">
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-6">Producto</div>
                                <div class="text-wrapper-19">Envase líquido</div>
                                <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-6">Hora inicial</div>
                                <div class="text-wrapper-19">08:00</div>
                                <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                    </div>
                    <div class="element-2">
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-6">Hora final</div>
                                <div class="text-wrapper-19">17:00</div>
                                <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-6">Tiempo total</div>
                                <div class="text-wrapper-19">3600</div>
                                <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                    </div>
                    <div class="element">
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-6">Producción conforme</div>
                                <div class="text-wrapper-19">500</div>
                                <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-6">Reproceso</div>
                                <div class="text-wrapper-19">50</div>
                                <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="datos">
                    <div class="element-3">
                        <div class="frame-6">
                            <div class="text-wrapper-13">Tiempo por perdida ideales:</div>
                        </div>
                        <div class="text-wrapper-14">120min</div>
                    </div>
                    <div class="element-3">
                        <div class="frame-6">
                            <div class="text-wrapper-13">Tiempo por perdida reales:</div>
                        </div>
                        <div class="text-wrapper-14">150min</div>
                    </div>
                    <div class="element-3">
                        <div class="frame-6">
                            <div class="text-wrapper-13">Producción ideal total:</div>
                        </div>
                        <div class="text-wrapper-14">15000KG</div>
                    </div>
                    <div class="element-3">
                        <div class="frame-6">
                            <div class="text-wrapper-13">Producción ideal por hora:</div>
                        </div>
                        <div class="text-wrapper-14">2750KG</div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<script>
    function redireccionar() {
        window.location.href = "../../app/controlCapacidad/paradas";
    }
</script>

</html>

