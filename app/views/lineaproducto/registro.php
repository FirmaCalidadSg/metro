<div class="card">
    <div class="card-header">
        <h5>Registro De Línea/Producto</h5>
    </div>
    <div class="card-body">
        <form name="lineaProceso" id="lineaProceso">
            <div class="row">
                <!-- Selección de Planta -->
                <div class="col-3">
                    <label for="plantas" class="form-label">* Planta</label>
                    <select id="plantas" name="planta_id" class="form-select">
                        <option value="">Seleccione una planta</option>
                        <?php foreach ($plantas as $value): ?>
                            <option value="<?= $value->id ?>"><?= $value->nombre_planta ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Selección de Proceso -->
                <div class="col-3">
                    <label for="procesos" class="form-label">* Proceso</label>
                    <select id="procesos" name="proceso_id" class="form-select" disabled>
                        <option value="">Seleccione un proceso</option>
                    </select>
                </div>

                <!-- Selección de Línea -->
                <div class="col-3">
                    <label for="lineas" class="form-label">* Línea</label>
                    <select id="lineas" name="linea_id" class="form-select" disabled>
                        <option value="">Seleccione una línea</option>
                    </select>
                </div>

                <!-- Selección de Producto -->
                <div class="col-3">
                    <label for="productos" class="form-label">* Producto</label>
                    <select id="productos" name="producto_id" class="form-select" disabled>
                        <option value="">Seleccione un producto</option>
                    </select>
                </div>

                <!-- Unidad -->
                <div class="col-3">
                    <label for="unidad" class="form-label">* Unidad</label>
                    <select id="unidad" name="unidad" class="form-control">
                        <option value="">Seleccione una unidad</option>
                        <option value="Kg">Kg</option>
                        <option value="Cajas">Cajas</option>
                        <option value="Unidades">Unidades</option>
                        <option value="Toneladas">Toneladas</option>
                    </select>
                </div>

                <!-- Peso -->
                <div class="col-3">
                    <label for="peso" class="form-label">* Peso (KG)</label>
                    <input type="number" id="peso" name="peso" class="form-control" placeholder="Ingrese el peso en KG">
                </div>

                <!-- Rendimiento Esperado -->
                <div class="col-3">
                    <label for="rendimiento" class="form-label">* Rendimiento Esperado</label>
                    <input type="number" id="rendimiento" name="rendimiento" class="form-control" value="1.00">
                </div>

                <!-- Producción Ideal Teórica -->
                <div class="col-3">
                    <label for="produccion_teorica" class="form-label">* Producción Ideal Teórica (Unidad/Horas)</label>
                    <input type="number" id="produccion_teorica" name="produccion_teorica" class="form-control">
                </div>

                <!-- Producción Ideal Ajustada -->
                <div class="col-3">
                    <label for="produccion_ajustada" class="form-label">* Producción Ideal Ajustada</label>
                    <input type="number" id="produccion_ajustada" name="produccion_ajustada" class="form-control">
                </div>

                <div class="col-md-12 mt-3">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="<?= BASE_PATH ?>/Assets/jquery/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {

        // Cargar procesos al seleccionar una planta
        $("#plantas").change(function () {
            let plantaId = $(this).val();
            let $procesos = $("#procesos");
            $procesos.prop("disabled", true).empty().append('<option value="">Seleccione un proceso</option>');

            if (plantaId) {
                $.ajax({
                    url: '<?= BASE_PATH ?>proceso/GetProcesoByPlanta/',
                    type: 'GET',
                    data: { linea: plantaId },
                    success: function (response) {
                        let procesos = JSON.parse(response);
                        procesos.forEach(proceso => {
                            $procesos.append(new Option(proceso.nombre, proceso.proceso_id));
                        });
                        $procesos.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        console.error("❌ Error al cargar procesos:", error);
                    }
                });
            }
        });

        // Cargar líneas al seleccionar un proceso
        $("#procesos").change(function () {
            let procesoId = $(this).val();
            let $lineas = $("#lineas");
            $lineas.prop("disabled", true).empty().append('<option value="">Seleccione una línea</option>');

            if (procesoId) {
                $.ajax({
                    url: '<?= BASE_PATH ?>linea/getbyplanta/',
                    type: 'GET',
                    data: { planta: procesoId },
                    success: function (response) {
                        let lineas = JSON.parse(response);
                        lineas.forEach(linea => {
                            $lineas.append(new Option(linea.nombre, linea.id));
                        });
                        $lineas.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        console.error("❌ Error al cargar líneas:", error);
                    }
                });
            }
        });

        // Cargar productos al seleccionar una línea
        $("#lineas").change(function () {
            let lineaId = $(this).val();
            let procesoId = $("#procesos").val();
            let plantaId = $("#plantas").val();
            let $productos = $("#productos");
            $productos.prop("disabled", true).empty().append('<option value="">Seleccione un producto</option>');

            if (lineaId) {
                $.ajax({
                    url: '<?= BASE_PATH ?>controlCapacidad/productosBYPlantaLineaProceso/',
                    type: 'POST',
                    data: { planta_id: plantaId, linea_id: lineaId, proceso_id: procesoId },
                    success: function (response) {
                        let productos = JSON.parse(response);
                        productos.forEach(producto => {
                            $productos.append(new Option(`${producto.nombre} (${producto.codigo})`, producto.id));
                        });
                        $productos.prop("disabled", false);
                    },
                    error: function (xhr, status, error) {
                        console.error("❌ Error al cargar productos:", error);
                    }
                });
            }
        });

        // Enviar formulario con AJAX
        $("#lineaProceso").submit(function (event) {
            event.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: '<?= BASE_PATH ?>lineaproducto/crear',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: 'Formulario enviado correctamente',
                            confirmButtonText: 'OK'
                        });
                        $("#lineaProceso")[0].reset();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error AJAX',
                        text: 'Hubo un problema con la petición.',
                        confirmButtonText: 'OK'
                    });
                    console.error("Error AJAX:", error);
                }
            });
        });

    });
</script>