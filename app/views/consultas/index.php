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
        <div class="info" style="display: none;">
            <div class="text-wrapper" id="resultado"></div>
            <div class="drops-downs">
                <div class="element">
                    <div class="textfield">
                        <div class="input">
                            <div class="div">Fecha</div>
                            <div class="p">
                                <select class="select-line-2">
                                    <option value="">mm/aaaa</option>
                                    <option value="01/2022">Enero 2022</option>
                                    <option value="02/2022">Febrero 2022</option>
                                    <option value="03/2022">Marzo 2022</option>
                                    <!-- ... -->
                                </select>
                            </div>
                            <img class="underline" src="../app/Assets/css/images/underline.svg" />
                        </div>
                    </div>
                    <div class="textfield">
                        <div class="input">
                            <div class="div">Planta</div>
                            <div class="p">
                                <select class="select-line-3">
                                    <option value="">Seleccionar</option>
                                    <option value="planta1">Planta 1</option>
                                    <option value="planta2">Planta 2</option>
                                    <option value="planta3">Planta 3</option>
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
                                    <option value="">Seleccionar</option>
                                    <option value="linea1">Linea 1</option>
                                    <option value="linea2">Linea 2</option>
                                    <option value="linea3">Linea 3</option>
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
                var infos = document.querySelectorAll('.info');
                infos.forEach(function(info) {
                    info.style.display = 'none';
                });

                // Guarda el valor seleccionado en localStorage
                var selectedValue = this.value;
                localStorage.setItem('selectedValue', selectedValue);

                // Envía el formulario para que PHP reciba el valor
                document.getElementById('submit-btn').click();

                // Muestra los elementos .info después de enviar el formulario
                infos.forEach(function(info) {
                    info.style.display = 'flex';
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