<div class="container">
    <div class="reportes">
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
</div>


<script>
    // Evento que escucha el cambio en el select
    document.getElementById("registroSelect").addEventListener("change", function() {
        // Almacenar el valor seleccionado en una variable
        let selectedValue = this.value;

        // Redirigir después de un retraso de 1.5 segundos
        setTimeout(function() {
            switch (selectedValue) {
                case 'definicion':
                    window.location.href = '../../app/definicion/registro';
                    break;
                case 'paises':
                    window.location.href = '../../app/pais/registro';
                    break;
                case 'ciudad':
                    window.location.href = '../../app/ciudad/registro';
                    break;
                case 'departamentos':
                    window.location.href = '../../app/departamento/registro';
                    break;
                case 'equipos':
                    window.location.href = '../../app/equipo/registro';
                    break;
                case 'danos':
                    window.location.href = '../../app/danoequipo/registro';
                    break;
                case 'procesos':
                    window.location.href = '../../app/proceso/registro';
                    break;
                case 'lineas':
                    window.location.href = '../../app/linea/registro';
                    break;
                case 'productos':
                    window.location.href = '../../app/producto/registro';
                    break;
                case 'linea_productos':
                    window.location.href = '../../app/lineaproducto/registro';
                    break;
                default:
                    break;
            }
        }, 1000);
    });
</script>