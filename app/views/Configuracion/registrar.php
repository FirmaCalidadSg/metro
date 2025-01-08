<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../../app/Assets/css/globals.css" />
    <link rel="stylesheet" href="../../app/Assets/css/styleguide.css"/>  
    <link rel="stylesheet" href="../../app/Assets/css/style.css" />
</head>

<body>
    <div class="registrar-view">
        <div class="info">
            <div class="frame">
                <div class="text">
                    <div class="text-wrapper">Registrar nuevo</div>
                </div>
            </div>
            <div class="element">
                <div class="textfield">
                    <div class="input">
                        <div class="div">Selecciona que necesitas registrar</div>
                        <div class="div-2">
                            <select class="select-register" id="registroSelect">
                                <option value="" disabled selected>Seleccionar</option>
                                <option value="definicion">Definición</option>
                                <option value="paises">Países</option>
                                <option value="ciudad">Ciudad</option>
                                <option value="departamentos">Departamentos</option>
                                <option value="equipos">Equipos</option>
                                <option value="danos">Daños</option>  
                                <option value="procesos">Procesos</option>  
                                <option value="lineas">Lineas</option>
                                <option value="productos">Productos</option>
                                <option value="linea_productos">Lineas Y Productos</option>
                            </select>
                        </div> 
                        <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Evento que escucha el cambio en el select
        document.getElementById("registroSelect").addEventListener("change", function() {
            // Almacenar el valor seleccionado en una variable
            let selectedValue = this.value;
            

        });
    </script>
</body>

</html>
