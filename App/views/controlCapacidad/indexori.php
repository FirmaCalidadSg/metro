<!-- Registro control de capacidad -->
<div class="card border-0 w-100">
    <h5 class="card-header">Registro control de capacidad</h5>
    <div class="card-body">
        <div class="container-fluid mt-3">

        </div>
    </div>
</div>
<!-- Tiempo de Operación (TO) -->
<div class="card mt-3">
    <div class="card-header">
        <h5>Tiempo de Operación (TO)</h5>
    </div>
    <div class="card-body">


        <table class="table mt-4" id="tablaResultados">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Tiempo Operación (TO)</th>
                    <th>Producción Ideal (TO)</th>
                    <th>AT</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
</div>
<!-- Tiempo Planeado de No Operación (TPNO) -->
<div class="card mt-3">
    <div class="card-header">
        <h5>Tiempo Planeado de No Operación (TPNO)</h5>
    </div>
    <div class="card-body">
        <form id="paroForm">
            <div class="row">
                <div class="col">
                    <label for="paroSelect" class="form-label">Paro/SubParo/Razón</label>
                    <select class="form-select" id="paroSelect">
                        <option value="mantenimiento">Mantenimiento Programado</option>
                        <option value="falla">Falla</option>
                        <option value="otros">Otros</option>
                    </select>
                </div>
                <div class="col">
                    <label for="tiempoInput" class="form-label">Tiempo (minutos)</label>
                    <input type="number" class="form-control" id="tiempoInput">
                </div>
                <div class="mb-3">
                    <label for="comentariosText" class="form-label">Comentarios</label>
                    <textarea class="form-control" id="comentariosText" rows="3"></textarea>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-primary" id="agregarParo">Agregar Paro</button>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-danger" id="borrarParo">Borrar Paro</button>
                </div>
        </form>

        <table class="table mt-4" id="tablaParos">
            <thead>
                <tr>
                    <th>Paro/SubParo/Razón</th>
                    <th>Tiempo (minutos)</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

        <div class="mt-4">
            <h6>Tiempo Planeado de No Operación (TPNO): <span id="tpnoTotal">0</span> minutos</h6>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="index">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Tiempo en Paros y/o Ajustes (Mantenimiento) -->
<div class="card mt-3">
    <div class="card-header">
        <h5> Tiempo en Paros y/o Ajustes (Mantenimiento)</h5>
    </div>
    <div class="card-body">
        <form id="paroForm0">
            <div class="row mb-3">
                <div class="col">
                    <label for="paroSelect" class="form-label">Paro/SubParo/Razón</label>
                    <select class="form-select" id="paroSelect">
                        <option value="falla_equipos">Fallas de equipos</option>
                        <option value="dano_mecanico">Daño mecánico</option>
                        <option value="dano_mecanico_empaque">Daño mecánico equipo empaque</option>
                    </select>
                </div>
                <div class="col">
                    <label for="subParoSelect" class="form-label">SubParo</label>
                    <select class="form-select" id="subParoSelect">
                        <option value="equipo_error">Equipo error</option>
                        <option value="dano_detectado">Daño detectado</option>
                    </select>
                </div>
                <div class="col">
                    <label for="razonSelect" class="form-label">Razón de la Anomalia</label>
                    <select class="form-select" id="razonSelect">
                        <option value="empaque_dano">Empaque dañado</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label for="tiempoInput" class="form-label">Tiempo Total (minutos)</label>
                <input type="number" class="form-control" id="tiempoInput">
            </div>
            <div class="mb-3">
                <label for="descripcionText" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcionText" rows="3"></textarea>
            </div>
            <button type="button" class="btn btn-primary" id="agregarParo">Agregar Paro</button>
            <button type="button" class="btn btn-danger" id="borrarParo">Borrar Paro</button>
        </form>
        <table class="table mt-4" id="tablaParos01">
            <thead>
                <tr>
                    <th>Paro/SubParo/Razón</th>
                    <th>Tiempo (minutos)</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="mt-4">
            <h6>Tiempo en Paros y/o Ajustes (Mantenimiento): <span id="tpnoTotal">0</span> minutos</h6>
        </div>
    </div>
</div>
</div>
<!-- Tiempo en Paros y/o Ajustes (PROCESO) -->
<div class="card mt-3 ">
    <div class="card-header">
        <h5> Tiempo en Paros y/o Ajustes (Proceso)</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="row g-3 align-items-center">
                <!-- Descripción -->
                <div class="col-md-4">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <select id="descripcion" class="form-select">
                        <option value="">Selecciona una opción</option>
                        <option value="Gestion">Gestión</option>
                        <option value="Problemas">Problemas de Comunicación</option>
                        <option value="Informacion">Información errada</option>
                    </select>
                </div>

                <!-- Tiempo -->
                <div class="col-md-4">
                    <label for="tiempo" class="form-label">Tiempo (minutos)</label>
                    <input type="number" id="tiempo" class="form-control" min="1">
                </div>

                <!-- Comentarios -->
                <div class="col-md-4">
                    <label for="comentarios" class="form-label">Comentarios</label>
                    <input type="text" id="comentarios" class="form-control">
                </div>
            </div>

            <div class="mt-3">
                <button class="btn btn-success" onclick="agregarParo()">Adicionar Paro</button>
            </div>

            <!-- Tabla de Tiempos -->
            <table class="table table-bordered mt-3">
                <thead class="table-light">
                    <tr>
                        <th>Descripción</th>
                        <th>Tiempo (minutos)</th>
                        <th>Comentarios</th>
                    </tr>
                </thead>
                <tbody id="tablaParos_"></tbody>
            </table>

            <div class="row g-3 mt-3">
                <div class="col-md-4"></div>
                <div class="col-md-4 highlight">TIEMPO EN PAROS Y/O AJUSTES (PROCESO)</div>
                <div class="col-md-4">
                    <input type="text" id="tiempoTotal" class="form-control highlight" readonly>
                </div>
            </div>
        </div>
    </div>
</div>






<script>
    // document.getElementById('registroForm2').querySelectorAll('input, select, textarea, button').forEach(element => {
    //     element.disabled = true;
    // });

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

    function calcularDiferenciaHoras(horaInicial, horaFinal) {
        // Obtener los valores de los inputs
        // const horaInicial = document.getElementById('hinicial').value;
        // const horaFinal = document.getElementById('hfinal').value;

        if (!horaInicial || !horaFinal) {
            alert('Por favor ingrese ambas horas.');
            return;
        }

        // Convertir las horas a objetos Date
        const [h1, m1] = horaInicial.split(':').map(Number);
        const [h2, m2] = horaFinal.split(':').map(Number);

        const inicio = new Date();
        inicio.setHours(h1, m1, 0);

        const fin = new Date();
        fin.setHours(h2, m2, 0);

        // Calcular la diferencia en milisegundos
        let diferenciaMs = fin - inicio;

        // Si la diferencia es negativa, se asume que el horario cruzó la medianoche
        if (diferenciaMs < 0) {
            diferenciaMs += 24 * 60 * 60 * 1000;
        }

        // Convertir la diferencia a minutos
        const diferenciaMinutos = Math.floor(diferenciaMs / (1000 * 60));

        // Mostrar el resultado en el input de tiempo total
        $('#tiempototal').val(diferenciaMinutos + ' minutos');
    }

    function TurnoDatos() {
        var turno_id = $('#turno_id').val();
        $.ajax({
            url: '<?php echo BASE_PATH ?>turno/getturnobyid/',
            type: 'GET',
            data: {
                turno_id: turno_id
            },
            dataType: 'json',
            success: function (response) {

                // try {
                var turnos = JSON.parse(response);
                console.log(turnos);
                // turnos.forEach(turno => {
                //     $('#hinicial').val(turno.hora_inicio);
                //     $('#hfinal').val(turno.hora_fin);

                //     // Calcular la diferencia en minutos
                //     var ttotal = calcularDiferenciaHoras(turno.hora_inicio, turno.hora_fin);
                //     // $('#tiempototal').val(ttotal + ' minutos');
                // });

                // } catch (error) {
                //     console.error('Error al procesar la respuesta JSON:', error);
                // }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    document.getElementById('agregarProducto').addEventListener('click', function () {
        const productosContainer = document.getElementById('productosContainer');
        const nuevoProducto = document.createElement('div');
        nuevoProducto.classList.add('producto');
        nuevoProducto.innerHTML = `
        <div class="row g-3">
            <div class="col-md-4">
                <label for="tipoUnidad" class="form-label">Tipo de Unidad (Kg):</label>
                <input type="text" class="form-control" name="tipoUnidad" value="Kg" required>
            </div>
            <div class="col-md-4">
                <label for="itemProducto" class="form-label">Ítem/Producto:</label>
                <select class="form-select" name="itemProducto" required>
                    <option value="FRISOQUE - 5500">FRISOQUE - 5500</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="horaInicio" class="form-label">Hora Inicial:</label>
                <input type="time" class="form-control" name="horaInicio" value="06.00" required>
            </div>
            <div class="col-md-4">
                <label for="horaFin" class="form-label">Hora Final:</label>
                <input type="time" class="form-control" name="horaFin" value="14:00" required>
            </div>
            <div class="col-md-4">
                <label for="tiempoTotal" class="form-label">Tiempo Total (minutos):</label>
                <input type="number" class="form-control" name="tiempoTotal" value="480" readonly>
            </div>
            <div class="col-md-4">
                <label for="produccionConforme" class="form-label">Producción Conforme:</label>
                <input type="number" class="form-control" name="produccionConforme" value="40000" required>
            </div>
            <div class="col-md-4">
                <label for="produccionNoConforme" class="form-label">Producción No Conforme:</label>
                <input type="number" class="form-control" name="produccionNoConforme" value="0" required>
            </div>
            <div class="col-md-4">
                <label for="Reproceso:</label>
                <input type="number" class="form-control" name="reproceso" value="0" required>
                </div>
                <div class="col-md-4">
                <label for="mermas" class="form-label">Mermas:</label>
                <input type="number" class="form-control" name="mermas" value="0" required>
                </div>
                <div class="col-md-4">
                <label for="tiempoPerdidoReales" class="form-label">Tiempo Perdido (Reales):</label>
                <input type="number" class="form-control" name="tiempoPerdidoReales" value="43" required>
                </div>
                <div class="col-md-4">
                <label for="tiempoPerdidoIdeales" class="form-label">Tiempo Perdido (Ideales):</label>
                <input type="number" class="form-control" name="tiempoPerdidoIdeales" value="13" required>
                </div>
                <div class="col-md-4">
                <label for="produccionIdealHora" class="form-label">Producción Ideal (Hora):</label>
                <input type="number" class="form-control" name="produccionIdealHora" value="5500" required>
                </div>
                <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm eliminarProducto">Eliminar</button>
                </div>
                </div>
            <hr>
`;
        productosContainer.appendChild(nuevoProducto);
        // Agregar evento para eliminar producto
        const botonesEliminar = nuevoProducto.querySelectorAll('.eliminarProducto');
        botonesEliminar.forEach(boton => {
            boton.addEventListener('click', function () {
                nuevoProducto.remove();
            });
        });
    });

    // Función para calcular los resultados
    function calcularTiempo() {
        const productos = document.querySelectorAll('.producto');
        const resultadosBody = document.getElementById('resultadosBody');
        resultadosBody.innerHTML = ''; // Limpiar resultados anteriores

        productos.forEach((producto, index) => {
            const tipoUnidad = producto.querySelector('[name="tipoUnidad"]').value;
            const itemProducto = producto.querySelector('[name="itemProducto"]').value;
            const horaInicio = producto.querySelector('[name="horaInicio"]').value;
            const horaFin = producto.querySelector('[name="horaFin"]').value;
            const tiempoTotal = parseInt(producto.querySelector('[name="tiempoTotal"]').value);
            const produccionConforme = parseInt(producto.querySelector('[name="produccionConforme"]').value);
            const produccionNoConforme = parseInt(producto.querySelector('[name="produccionNoConforme"]').value);
            const tiempoPerdidoReales = parseInt(producto.querySelector('[name="tiempoPerdidoReales"]').value);
            const tiempoPerdidoIdeales = parseInt(producto.querySelector('[name="tiempoPerdidoIdeales"]').value);
            const produccionIdealHora = parseInt(producto.querySelector('[name="produccionIdealHora"]').value);

            // Calcula los resultados (reemplaza con tu lógica específica)
            const tiempoOperacion = tiempoTotal - tiempoPerdidoReales;
            const produccionIdealTO = (produccionIdealHora / 60) * tiempoOperacion;
            const at = (produccionConforme / produccionIdealTO) * 100;

            // Muestra los resultados en la tabla
            resultadosBody.innerHTML += `
        <tr><td><span class="math-inline">\{itemProducto\}</td\>
        <td>{tiempoOperacion.toFixed(2)}</td>
        <td>produccionIdealTO.toFixed(2)</td><td>{at.toFixed(2)}%</td>
        </tr>
`;
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        const paroForm = document.getElementById('paroForm');
        const paroSelect = document.getElementById('paroSelect');
        const tiempoInput = document.getElementById('tiempoInput');
        const comentariosText = document.getElementById('comentariosText');
        const agregarParo = document.getElementById('agregarParo');
        const borrarParo = document.getElementById('borrarParo');
        const tablaParos = document.getElementById('tablaParos').getElementsByTagName('tbody')[0];
        const tpnoTotal = document.getElementById('tpnoTotal');

        let paros = [];

        agregarParo.addEventListener('click', () => {
            const paro = paroSelect.value;
            const tiempo = parseInt(tiempoInput.value) || 0;
            const comentarios = comentariosText.value;

            paros.push({
                paro,
                tiempo,
                comentarios
            });
            actualizarTabla();
            actualizarTPNO();

            // Limpiar el formulario después de agregar
            paroForm.reset();
        });

        borrarParo.addEventListener('click', () => {
            paros.pop(); // Elimina el último paro agregado
            actualizarTabla();
            actualizarTPNO();
        });

        function actualizarTabla() {
            tablaParos.innerHTML = ''; // Limpiar la tabla

            paros.forEach(paro => {
                const row = tablaParos.insertRow();
                const paroCell = row.insertCell();
                const tiempoCell = row.insertCell();
                const comentariosCell = row.insertCell();

                paroCell.textContent = paro.paro;
                tiempoCell.textContent = paro.tiempo;
                comentariosCell.textContent = paro.comentarios;
            });
        }

        function actualizarTPNO() {
            let totalTiempo = paros.reduce((sum, paro) => sum + paro.tiempo, 0);
            tpnoTotal.textContent = totalTiempo;
        }



        // Código para el nuevo formulario de Tiempo de Operación (TO)
        const toForm = document.getElementById('toForm');
        const medidaSelect = document.getElementById('medidaSelect');
        const itemInput = document.getElementById('itemInput');
        const horaInicioInput = document.getElementById('horaInicioInput');
        const horaFinInput = document.getElementById('horaFinInput');
        const produccionConformeInput = document.getElementById('produccionConformeInput');
        const tiempoPerdidoRealesInput = document.getElementById('tiempoPerdidoRealesInput');
        const tiempoPerdidoIdealesInput = document.getElementById('tiempoPerdidoIdealesInput');
        const produccionIdealHoraInput = document.getElementById('produccionIdealHoraInput');
        const reprocesoInput = document.getElementById('reprocesoInput');
        const mermasInput = document.getElementById('mermasInput');
        const agregarProducto = document.getElementById('agregarProducto');
        const calcularTiempo = document.getElementById('calcularTiempo');
        const tablaResultados = document.getElementById('tablaResultados').getElementsByTagName('tbody')[0];

        let resultados = [];

        agregarProducto.addEventListener('click', () => {
            const item = itemInput.value;
            const tiempoOperacion = calcularTiempoOperacion();
            const produccionIdealTO = calcularProduccionIdealTO(tiempoOperacion);
            const at = calcularAT(produccionIdealTO);

            resultados.push({
                item,
                tiempoOperacion,
                produccionIdealTO,
                at
            });
            actualizarTablaResultados();

            // Limpiar el formulario después de agregar
            toForm.reset();
        });

        calcularTiempo.addEventListener('click', () => {
            const tiempoOperacion = calcularTiempoOperacion();
            // Aquí puedes realizar otras acciones con el tiempo de operación calculado
            alert('Tiempo de Operación (TO): ' + tiempoOperacion + ' minutos');
        });

        function calcularTiempoOperacion() {
            const horaInicio = horaInicioInput.value;
            const horaFin = horaFinInput.value;

            if (!horaInicio || !horaFin) {
                return 0;
            }

            const inicio = new Date(`2023-10-27T${horaInicio}`); // Se usa una fecha arbitraria
            const fin = new Date(`2023-10-27T${horaFin}`); // Se usa una fecha arbitraria

            const diff = fin.getTime() - inicio.getTime();
            const minutos = Math.round(diff / (1000 * 60));

            return minutos;
        }

        function calcularProduccionIdealTO(tiempoOperacion) {
            const produccionIdealHora = parseFloat(produccionIdealHoraInput.value) || 0;
            const tiempoOperacionHoras = tiempoOperacion / 60;
            return produccionIdealHora * tiempoOperacionHoras;
        }

        function calcularAT(produccionIdealTO) {
            const produccionConforme = parseFloat(produccionConformeInput.value) || 0;
            return produccionConforme / produccionIdealTO;
        }

        function actualizarTablaResultados() {
            tablaResultados.innerHTML = ''; // Limpiar la tabla

            resultados.forEach(resultado => {
                const row = tablaResultados.insertRow();
                const itemCell = row.insertCell();
                const tiempoOperacionCell = row.insertCell();
                const produccionIdealTOCell = row.insertCell();
                const atCell = row.insertCell();

                itemCell.textContent = resultado.item;
                tiempoOperacionCell.textContent = resultado.tiempoOperacion;
                produccionIdealTOCell.textContent = resultado.produccionIdealTO;
                atCell.textContent = resultado.at;
            });
        }



    });
    document.addEventListener('DOMContentLoaded', () => {
        const paroForm = document.getElementById('paroForm0');
        const paroSelect = document.getElementById('paroSelect');
        const subParoSelect = document.getElementById('subParoSelect');
        const razonSelect = document.getElementById('razonSelect');
        const tiempoInput = document.getElementById('tiempoInput');
        const descripcionText = document.getElementById('descripcionText');
        const agregarParo = document.getElementById('agregarParo');
        const borrarParo = document.getElementById('borrarParo');
        const tablaParos = document.getElementById('tablaParos').getElementsByTagName('tbody')[0];
        const tpnoTotal = document.getElementById('tpnoTotal');

        let paros = [];

        agregarParo.addEventListener('click', (event) => {
            event.preventDefault(); // Evitar que se recargue la página

            const paro = paroSelect.value;
            const subParo = subParoSelect.value;
            const razon = razonSelect.value;
            const tiempo = parseInt(tiempoInput.value) || 0;
            const descripcion = descripcionText.value;

            paros.push({
                paro,
                subParo,
                razon,
                tiempo,
                descripcion
            });
            actualizarTabla();
            actualizarTPNO();

            paroForm.reset(); // Limpiar el formulario
        });

        borrarParo.addEventListener('click', (event) => {
            event.preventDefault(); // Evitar que se recargue la página

            paros.pop(); // Eliminar el último paro agregado
            actualizarTabla();
            actualizarTPNO();
        });

        function actualizarTabla() {
            tablaParos.innerHTML = ''; // Limpiar la tabla

            paros.forEach(paro => {
                const row = tablaParos.insertRow();
                const paroCell = row.insertCell();
                const tiempoCell = row.insertCell();
                const descripcionCell = row.insertCell();

                paroCell.textContent = `${paro.paro} - ${paro.subParo} - ${paro.razon}`;
                tiempoCell.textContent = paro.tiempo;
                descripcionCell.textContent = paro.descripcion;
            });
        }

        function actualizarTPNO() {
            let totalTiempo = paros.reduce((sum, paro) => sum + paro.tiempo, 0);
            tpnoTotal.textContent = totalTiempo;
        }
    });
</script>

<script>
    let tiempoAcumulado = 0;

    function agregarParo() {
        const descripcion = document.getElementById("descripcion").value;
        const tiempo = parseInt(document.getElementById("tiempo").value);
        const comentarios = document.getElementById("comentarios").value;

        if (!descripcion || isNaN(tiempo) || tiempo <= 0) {
            alert("Por favor completa todos los campos correctamente.");
            return;
        }

        tiempoAcumulado += tiempo;

        const tablaParos = document.getElementById("tablaParos_");
        const fila = document.createElement("tr");
        fila.innerHTML = `
        <td>${descripcion}</td>
        <td>${tiempo}</td>
        <td>${comentarios}</td>
      `;
        tablaParos.appendChild(fila);

        document.getElementById("tiempoTotal").value = tiempoAcumulado;

        // Limpiar campos
        document.getElementById("descripcion").value = "";
        document.getElementById("tiempo").value = "";
        document.getElementById("comentarios").value = "";
    }
</script>

<style>
    .producto {
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
    }

    .resultados {
        margin-top: 20px;
    }

    .resultados table {
        width: 100%;
    }

    .resultados th,
    .resultados td {
        text-align: center;
    }

    .subitem {
        font-size: smaller;
    }
</style>