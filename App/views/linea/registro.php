<?php // print_r($procesos) 
?>
<div class="">
    <form action="" method="POST" id="formLinea">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Línea</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la línea" value="<?= $linea->nombre ?? '' ?>" required>
        </div>
        <label class="form-label">Procesos</label>

        <div style="border: 1px solid #CACACA; padding:3%" class="mb-3">
            <input type="text" id="buscadorProcesos" onkeyup="filtrarProcesos()" placeholder="Buscar procesos..." class="form-control mb-2">
            <div id="listaProcesos" class="d-flex flex-wrap">
                <?php foreach ($procesos as $proceso): ?>
                    <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" id="proceso_<?= $proceso->id ?>" name="procesos[]" value="<?= $proceso->id ?>" <?= isset($linea->proceso) && in_array($proceso->id, (array)$linea->proceso) ? 'checked' : '' ?> onchange="actualizarProcesos()">
                        <label class="form-check-label" for="proceso_<?= $proceso->id ?>">
                            <?= $proceso->nombre ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <small class="form-text text-muted">Seleccione los procesos que desee.</small>
        </div>
        <!-- <div class="mb-3">
            <button type="button" class="btn btn-danger" onclick="eliminarProcesos()">Eliminar Procesos Seleccionados</button>
        </div> -->
        <script>
            function filtrarProcesos() {
                const input = document.getElementById('buscadorProcesos');
                const filter = input.value.toLowerCase();
                const procesos = document.querySelectorAll('#listaProcesos .form-check');

                procesos.forEach(proceso => {
                    const label = proceso.querySelector('label').textContent.toLowerCase();
                    proceso.style.display = label.includes(filter) ? '' : 'none';
                });
            }

            function actualizarProcesos() {
                const checkboxes = document.querySelectorAll('input[name="procesos[]"]');
                const selectedOptions = Array.from(checkboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);
                console.log('Procesos seleccionados:', selectedOptions);
            }

            function eliminarProcesos() {
                const checkboxes = document.querySelectorAll('input[name="procesos[]"]:checked');
                const selectedOptions = Array.from(checkboxes).map(checkbox => checkbox.value);
                // Aquí puedes agregar la lógica para eliminar los procesos seleccionados
                console.log('Procesos a eliminar:', selectedOptions);
            }
        </script>

        <div class="mb-3">
            <label for="planta_id" class="form-label">Planta</label>
            <select class="form-control" id="planta_id" name="planta_id" required>
                <option value="">Seleccione una Planta</option>
                <?php foreach ($plantas as $planta): ?>
                    <option value="<?= $planta->id ?>" <?= isset($linea->planta_id) && $linea->planta_id == $planta->id ? 'selected' : '' ?>>
                        <?= $planta->nombre_planta ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo_unidad" class="form-label">Tipo de Unidad</label>
            <select class="form-control" id="tipo_unidad" name="tipo_unidad" required>
                <option value="">Seleccione una Unidad</option>
                <?php foreach ($unidad as $unidadMedida): ?>
                    <option value="<?= $unidadMedida->id ?>" <?= isset($linea->tipo_unidad) && $linea->tipo_unidad == $unidadMedida->id ? 'selected' : '' ?>>
                        <?= $unidadMedida->unidad ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="citg" class="form-label">Capacidad Ideal Teórica General (CITG)</label>
            <input type="number" class="form-control" id="citg" name="citg" placeholder="CITG" value="<?= $linea->citg ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="citr" class="form-label">Capacidad Ideal Teórica por Referencia (CITR)</label>
            <input type="number" class="form-control" id="citr" name="citr" placeholder="CITR" value="<?= $linea->citr ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="supervisor" class="form-label">Supervisor</label>
            <input type="text" class="form-control" id="supervisor" name="supervisor" placeholder="Nombre del Supervisor" value="<?= $linea->supervisor ?? '' ?>" required>
        </div>

        <input type="hidden" id="id" name="id" value="<?= $linea->id ?? ''; ?>">

        <a onclick="Registrar('linea', 'crear', 'formLinea')" class="btn btn-primary">
            <?= isset($linea->id) && $linea->id > 0 ? 'Actualizar' : 'Registrar'; ?>
        </a>
    </form>
</div>