<form name="formparo" id="formparo">
    <div class="row">
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">Paros</label>
            <select name="paro_id" id="paro_id" class="form-control">
                <option value="">seleccionar</option>
                <?php foreach ($paros as $value): ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">SubParos</label>
            <select name="subparo_id" id="subparo_id" class="form-control">
                <option value="">seleccionar</option>
            </select>
        </div>
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">Razón Paro</label>
            <select name="razon_id" id="razon_id" class="form-control">
                <option value="">seleccionar</option>
            </select>
        </div>
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">Equipo</label>
            <select name="equipo_id" id="equipo_id" class="form-control">
                <option value="">seleccionar</option>
            </select>
        </div>
        <div class="col-6">
            <label for="exampleInputEmail1" class="form-label">Daño Detectado</label>
            <input type="text" name="danoDetetado" id="danoDetetado" class="form-control">
        </div>


        <div class="col-6">
            <label for="exampleInputPassword1" class="form-label">Tiempo Usado</label>
            <input type="text" class="form-control" id="tiempo" class="form-control">
        </div>
        <div class="col-12">
            <label for="exampleInputPassword1" class="form-label">Razón de la Anomalía</label>
            <textarea type="text" class="form-control" id="descripcion" class="form-control"></textarea>
        </div>
        <div class="col-12 mt-2">
            <button type="button" id="agregar" class="btn btn-primary">Agregar</button>
        </div>
    </div>
</form>

<script>

    $("#paro_id").change(function () {
        let paro_id = $("#paro_id").val();
        $.ajax({
            url: '<?php echo BASE_PATH ?>controlCapacidad/SubParo/',
            type: 'POST',
            data: {
                paro_id: paro_id
            },
            dataType: "json",
            success: function (response) {
                let select = $("#subparo_id");
                select.empty(); // Limpiar opciones anteriores
                select.append('<option value="">Seleccione una opción</option>'); // Opción por defecto

                $.each(response, function (index, item) {
                    select.append('<option value="' + item.id + '">' + item.nombre + '</option>');
                });
            },
            error: function () {
                alert("Error al obtener los datos");
            }
        });
    });

    $("#subparo_id").change(function () {
        let subparo_id = $("#subparo_id").val();
        $.ajax({
            url: '<?php echo BASE_PATH ?>controlCapacidad/RazonParo/',
            type: 'POST',
            data: {
                subparo_id: subparo_id
            },
            dataType: "json",
            success: function (response) {
                let select = $("#razon_id");
                select.empty(); // Limpiar opciones anteriores
                select.append('<option value="">Seleccione una opción</option>'); // Opción por defecto

                $.each(response, function (index, item) {
                    select.append('<option value="' + item.id + '">' + item.descripcion + '</option>');
                });
            },
            error: function () {
                alert("Error al obtener los datos");
            }
        });
    });

    $("#razon_id").change(function () {
        // let subparo_id = $("#subparo_id").val();
        $.ajax({
            url: '<?php echo BASE_PATH ?>equipo/GetEquipos/',
            type: 'POST',
            data: {},
            dataType: "json",
            success: function (response) {
                let select = $("#equipo_id");
                select.empty(); // Limpiar opciones anteriores
                select.append('<option value="">Seleccione una opción</option>'); // Opción por defecto
                $.each(response, function (index, item) {
                    select.append('<option value="' + item.id + '">' + item.modelo + "-" + item.nombre + '</option>');
                });
            },
            error: function () {
                alert("Error al obtener los datos");
            }
        });
    })




    $(document).ready(function () {
        $("#agregar").click(function () {
            let paroId = $("#paro_id").val();
            let paroTexto = $("#paro_id option:selected").text();
            let subparoId = $("#subparo_id").val();
            let subparoTexto = $("#subparo_id option:selected").text();
            let razonId = $("#razon_id").val();
            let razonTexto = $("#razon_id option:selected").text();
            let tiempo = parseFloat($("#tiempo").val()); // Convertir a número
            let descripcion = $("#descripcion").val();
            let tpi = parseFloat($("#tiempoPerdidasIdeales").text()); // Convertir a número

            if (!paroId || !subparoId || !razonId || isNaN(tiempo) || !descripcion) {
                alert("Todos los campos son obligatorios y el tiempo debe ser un número válido.");
                return;
            }

            if (tiempo > tpi) {
                alert("El tiempo ingresado no puede ser mayor que el tiempo de pérdidas ideales.");
                return;
            }

            let fila = `<tr>
                        <td>${paroTexto}</td>
                        <td>${subparoTexto}</td>
                        <td>${razonTexto}</td>
                        <td class="tiempo">${tiempo}</td>
                        <td>${descripcion}</td>
                        <td><button class="btn btn-danger btn-sm eliminar">Eliminar</button></td>
                    </tr>`;

            $("#tablaParos tbody").append(fila);

            // Actualizar tiempo de pérdidas ideales
            $("#tiempoPerdidasIdeales").text((tpi - tiempo).toFixed(2));

            // Limpiar formulario
            $("#formparo")[0].reset();
        });

        // Evento para eliminar fila y devolver el tiempo eliminado
        $(document).on("click", ".eliminar", function () {
            let tiempoRecuperado = parseFloat($(this).closest("tr").find(".tiempo").text());
            let tpiActual = parseFloat($("#tiempoPerdidasIdeales").text());

            $("#tiempoPerdidasIdeales").text((tpiActual + tiempoRecuperado).toFixed(2));

            $(this).closest("tr").remove();
        });
    });




</script>