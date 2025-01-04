<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../app/Assets/css/globals.css" />
    <link rel="stylesheet" href="../app/Assets/css/styleguide.css" />
    <link rel="stylesheet" href="../app/Assets/css/style.css" />
</head>

<body>
    <div class="consultas">
        <div class="info">
            <div class="frame">
                <div class="text">
                    <div class="div-wrapper">
                        <div class="text-wrapper">Consultas control de capacidad</div>
                    </div>
                    <div class="div">
                        <div class="text-wrapper-2">Registradas</div>
                    </div>
                </div>
            </div>
            <div class="drops-downs">
                <div class="element">
                    <div class="textfield">
                        <div class="input">
                            <div class="div-2">
                                <div class="text-wrapper-3">
                                    <div class="p">Selecciona el tipo de consulta</div>
                                    <form id="consulta-select">
                                        <select class="select-line" name="tipo-consulta">
                                            <option value="" selected disabled>Seleccionar</option>
                                            <option value="planta">Por planta</option>
                                            <option value="proceso">Por proceso</option>
                                            <option value="linea">Por linea</option>
                                            <option value="supervisor">Por supervisor</option>
                                            <option value="fecha">Por fecha</option>
                                            <option value="batch">Batch</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="filtro" style="display: none;">
            <div class="text-wrapper" id="resultado"></div>
            <div class="drops-downs">
                <div class="element">
                    <div class="textfield">
                        <div class="input">
                            <div class="div">Fecha y Hora</div>
                            <div class="p">
                                <input type="datetime-local" class="datatimer"/>
                            </div>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield">
                        <div class="input">
                            <div class="div">Planta</div>
                            <div class="p">
                                <select class="select-line-3">
                                    <option value="" disabled selected>Seleccionar</option>
                                    <option value="buga">Buga</option>
                                    <option value="cali">Cali</option>
                                    <option value="bogota">Bogota</option>
                                </select>
                            </div>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
                <div class="element">
                    <div class="textfield-2">
                        <div class="input">
                            <div class="div">Linea</div>
                            <div class="p">
                                <select class="select-line-2">
                                    <option value="" disabled selected>Seleccionar</option>
                                    <option value="liquidos">Liquidos Buga</option>
                                    <option value="solidos">Solidos</option>
                                    <option value="mezclas">Mezclas</option>
                                </select>
                            </div>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                </div>
            </div>
            <button class="buttom">
                <div class="text-wrapper-4">Consultar</div>
            </button>

        </div>
        <button type="submit" id="submit-btn" style="display: none;"></button>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectPrincipal = document.querySelector('.select-line');
        selectPrincipal.addEventListener('change', function() {
            if (this.value !== "") {
                // Oculta los elementos .info
                var filtros = document.querySelectorAll('.filtro');
                filtros.forEach(function(filtro) {
                    filtro.style.display = 'flex';
                });

                // Guarda el valor seleccionado en localStorage
                var selectedValue = this.value;
                localStorage.setItem('selectedValue', selectedValue);

                // Envía el formulario para que PHP reciba el valor
                document.getElementById('submit-btn').click();

                // Muestra los elementos .info después de enviar el formulario
                filtros.forEach(function(filtro) {
                    filtro.style.display = 'flex';
                });
            }
        });

        var selects = document.querySelectorAll('select');
        selects.forEach(function(select) {
            select.addEventListener('change', function() {
                var selectedValue = this.value;
                localStorage.setItem('selectedValue', selectedValue);
            });
        });
    });

    function mostrarSeleccion() {
        // Capturamos el elemento select
        const selectElement = document.querySelector(".select-line");

        // Obtenemos el texto de la opción seleccionada
        const opcionSeleccionadaTexto = selectElement.options[selectElement.selectedIndex].text;

        // Limpiamos el valor previamente almacenado
        localStorage.removeItem('consultaSeleccionada');
        document.getElementById("resultado").innerHTML = ""; // Limpia el contenido en pantalla

        // Si el valor seleccionado es válido (diferente de vacío)
        if (selectElement.value) {
            // Actualizamos el div resultado con el nuevo valor
            document.getElementById("resultado").innerHTML = opcionSeleccionadaTexto;

            // Guardamos el nuevo valor en localStorage (o puedes almacenarlo de otra manera)
            localStorage.setItem('consultaSeleccionada', opcionSeleccionadaTexto);
        }
    }

    // Asociamos la función mostrarSeleccion() al evento onchange del select
    document.addEventListener("DOMContentLoaded", function() {
        const selectElement = document.querySelector(".select-line");
        selectElement.addEventListener("change", mostrarSeleccion);
    });
/*     document.querySelector('.buttom').addEventListener('click', function() {
        window.location.href = '../app/views/consultas/registro.php';
    });   */   
</script>

</html>