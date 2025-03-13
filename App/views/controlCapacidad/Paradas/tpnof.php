<form name="formparo" id="formparo">
    <div class="mb-3">
        <label for="paro_id" class="form-label">Paros</label>
        <select name="paro_id" id="paro_id" class="form-control">
            <option value="">Seleccionar</option>
            <?php foreach ($paros as $value): ?>
                <option value="<?php echo $value->id ?>"><?php echo $value->nombre ?></option>
            <?php endforeach; ?>
        </select>

        <label for="subparo_id" class="form-label mt-2">SubParos</label>
        <select name="subparo_id" id="subparo_id" class="form-control">
            <option value="">Seleccionar</option>
        </select>

        <label for="razon_id" class="form-label mt-2">Razón del Paro</label>
        <select name="razon_id" id="razon_id" class="form-control">
            <option value="">Seleccionar</option>
        </select>

        <!-- Fechas para TPNO -->
        <div class="row mt-3">
            <div class="col-md-6">
                <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                <input type="datetime-local" id="fechaInicio" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="fechaFin" class="form-label">Fecha de Fin</label>
                <input type="datetime-local" id="fechaFin" class="form-control" onchange="calcularTiempoTPNO()">
            </div>
        </div>
        <div class="row  mt-3">

            <!-- Tiempo calculado -->
            <div class="col mt-2">
                <label for="dias" class="form-label">Duración Total (Días)</label>
                <input type="number" class="form-control bg-light" id="dias" readonly>
            </div>

            <div class="col mt-2">
                <label for="tiempo" class="form-label">Tiempo Total (Minutos)</label>
                <input type="number" class="form-control bg-light" id="tiempo" readonly>
            </div>

            <div class="mt-2">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea type="text" class="form-control" id="descripcion"></textarea>
            </div>
        </div>

        <div class="col mt-3 text-end">
            <button type="button" id="agregar" class="btn btn-primary">Agregar</button>
        </div>
    </div>
</form>

<script>
    function calcularTiempoTPNO() {
        let inicio = new Date(document.getElementById("fechaInicio").value);
        let fin = new Date(document.getElementById("fechaFin").value);

        if (inicio && fin && inicio <= fin) {
            let diffMs = fin - inicio;
            let diffDias = diffMs / (1000 * 60 * 60 * 24); // Diferencia en días
            let diffMin = diffMs / (1000 * 60); // Diferencia en minutos

            document.getElementById("dias").value = diffDias.toFixed(2);
            document.getElementById("tiempo").value = diffMin.toFixed(0);
        } else {
            alert("La fecha de fin debe ser mayor o igual a la fecha de inicio.");
            document.getElementById("dias").value = "";
            document.getElementById("tiempo").value = "";
        }
    }

    function guardarTPNO() {
        let paro = document.getElementById("paro_id").value;
        let subparo = document.getElementById("subparo_id").value;
        let razon = document.getElementById("razon_id").value;
        let fechaInicio = document.getElementById("fechaInicio").value;
        let fechaFin = document.getElementById("fechaFin").value;
        let dias = document.getElementById("dias").value;
        let tiempo = document.getElementById("tiempo").value;
        let descripcion = document.getElementById("descripcion").value;


        if (!paro || !subparo || !razon || !fechaInicio || !fechaFin || dias <= 0 || tiempo <= 0) {
            alert("Por favor completa todos los campos correctamente.");
            return;
        }

        // Aquí iría la lógica para guardar en la base de datos
        alert("TPNO registrado con éxito: " + dias + " días, " + tiempo + " minutos");

        // Reset form
        document.getElementById("formparo").reset();
    }

    $("#paro_id").change(function() {
        let paro_id = $("#paro_id").val();
        $.ajax({
            url: '<?php echo BASE_PATH ?>controlCapacidad/SubParo/',
            type: 'POST',
            data: {
                paro_id: paro_id
            },
            dataType: "json",
            success: function(response) {
                let select = $("#subparo_id");
                select.empty(); // Limpiar opciones anteriores
                select.append('<option value="">Seleccione una opción</option>'); // Opción por defecto

                $.each(response, function(index, item) {
                    select.append('<option value="' + item.id + '">' + item.nombre + '</option>');
                });
            },
            error: function() {
                alert("Error al obtener los datos");
            }
        });
    });

    $("#subparo_id").change(function() {
        let subparo_id = $("#subparo_id").val();
        $.ajax({
            url: '<?php echo BASE_PATH ?>controlCapacidad/RazonParo/',
            type: 'POST',
            data: {
                subparo_id: subparo_id
            },
            dataType: "json",
            success: function(response) {
                let select = $("#razon_id");
                select.empty(); // Limpiar opciones anteriores
                select.append('<option value="">Seleccione una opción</option>'); // Opción por defecto

                $.each(response, function(index, item) {
                    select.append('<option value="' + item.id + '">' + item.descripcion + '</option>');
                });
            },
            error: function() {
                alert("Error al obtener los datos");
            }
        });
    });

    $(document).ready(function() {
        $("#agregar").click(function() {

            let inicio = document.getElementById("fechaInicio").value;
            let fin = document.getElementById("fechaFin").value;

            let paroId = $("#paro_id").val();
            let paroTexto = $("#paro_id option:selected").text();
            let subparoId = $("#subparo_id").val();
            let subparoTexto = $("#subparo_id option:selected").text();
            let razonId = $("#razon_id").val();
            let razonTexto = $("#razon_id option:selected").text();
            let tiempo = parseFloat($("#tiempo").val()); // Convertir a número
            let dias = parseFloat($("#dias").val()); // Convertir a número
            let descripcion = $("#descripcion").val();
            let tpi = parseFloat($("#tiempoPerdidasIdeales").text()); // Convertir a número
            let tt = parseFloat($("#tt").text()); // Convertir a número

            if (!paroId || !subparoId || !razonId || isNaN(tiempo) || !descripcion) {
                alert("Todos los campos son obligatorios y el tiempo debe ser un número válido.");
                return;
            }

            let fila = `<tr>            
            <td>${inicio}</td>
            <td>${fin}</td>
            <td>${dias} Diás / <br>${tiempo} Minutos</td>            
            <td>-${subparoTexto}<br>-${subparoTexto}<br>-${razonTexto}</td>            
            <td>${descripcion}</td>
            <td><button class="btn btn-danger btn-sm eliminar"> Eliminar</button></td>
            </tr>`;

            $("#tablaParos tbody").append(fila);
            // Actualizar tiempo de pérdidas ideales
            $("#tiempoPerdidasIdeales").text((tpi - tiempo).toFixed(0));
            $("#tt").text((tt - tiempo).toFixed(0));

            // Limpiar formulario
            $("#formparo")[0].reset();
        });

        // Evento para eliminar fila y devolver el tiempo eliminado
        $(document).on("click", ".eliminar", function() {
            let tiempoRecuperado = parseFloat($(this).closest("tr").find(".tiempo").text());
            let tpiActual = parseFloat($("#tiempoPerdidasIdeales").text());

            $("#tiempoPerdidasIdeales").text((tpiActual + tiempoRecuperado).toFixed(2));

            $(this).closest("tr").remove();
        });
    });
</script>