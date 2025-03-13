<div class="">
    <form action="" method="POST" id="formProceso">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Proceso</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del proceso" value="<?= $proceso->nombre ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del proceso"><?= $proceso->descripcion ?? '' ?></textarea>
        </div>

        <div class="mb-3">
            <label for="planta_id" class="form-label">Planta</label>
            <select class="form-control" id="planta_id" name="planta_id" required>
                <option value="">Seleccione una Planta</option>
                <?php foreach ($plantas as $planta): ?>
                    <option value="<?= $planta->id ?>" <?= isset($proceso->planta_id) && $proceso->planta_id == $planta->id ? 'selected' : '' ?>>
                        <?= $planta->nombre_planta ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="responsable_id" class="form-label">Responsable</label>
            <input type="text" class="form-control" id="responsable_id" name="responsable_id" placeholder="Nombre del responsable" value="<?= $proceso->responsable_id ?? '' ?>" required>
        </div>

        <input type="hidden" id="id" name="id" value="<?= $proceso->id ?? ''; ?>">

        <a onclick="Registrar('proceso', 'crear', 'formProceso')" class="btn btn-primary">
            <?= isset($proceso->id) && $proceso->id > 0 ? 'Actualizar' : 'Registrar'; ?>
        </a>
    </form>
</div>
