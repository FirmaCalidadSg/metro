<div class="">
    <form action="" method="POST" id="formTurnos">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Turno</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del turno" value="<?= $turno->turno ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="planta_id" class="form-label">Planta</label>
            <select class="form-control" id="planta_id" name="planta_id" required>
                <option value="">Seleccione una Planta</option>
                <?php foreach ($plantas as $planta): ?>
                    <option value="<?= $planta->id ?>" <?= isset($turno->planta_id) && $turno->planta_id == $planta->id ? 'selected' : '' ?>>
                        <?= $planta->nombre_planta ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?= $turno->fecha_inicio ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Fin</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?= $turno->fecha_fin ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="hora_inicio" class="form-label">Hora de Inicio</label>
            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" value="<?= $turno->hora_inicio ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="hora_fin" class="form-label">Hora de Fin</label>
            <input type="time" class="form-control" id="hora_fin" name="hora_fin" value="<?= $turno->hora_fin ?? '' ?>" required>
        </div>

        <input type="hidden" id="id" name="id" value="<?= $turno->turno_id ?? ''; ?>">

        <a onclick="Registrar('turno', 'crear', 'formTurnos')" class="btn btn-primary">
            <?= isset($turno->turno_id) && $turno->turno_id > 0 ? 'Actualizar' : 'Registrar'; ?>
        </a>
    </form>
</div>
