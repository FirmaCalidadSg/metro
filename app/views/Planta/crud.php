<div class="">
    <form action="" method="POST" id="formPlantas">
        <div class="mb-3">
            <label for="nombre_planta" class="form-label">Nombre de la Planta</label>
            <input type="text" class="form-control" id="nombre_planta" name="nombre_planta" placeholder="Nombre de la planta" value="<?= $planta->nombre_planta ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="ciudad_id" class="form-label">Ciudad</label>
            <select class="form-control" id="ciudad_id" name="ciudad_id" required>
                <option value="">Seleccione una Ciudad</option>
                <?php foreach ($ciudades as $ciudad): ?>
                    <option value="<?= $ciudad->id ?>" <?= isset($planta->ciudad_id) && $planta->ciudad_id == $ciudad->id ? 'selected' : '' ?>>
                        <?= $ciudad->nombre ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="responsable_id" class="form-label">Responsable</label>
            <input type="text" class="form-control" id="responsable_id" name="responsable_id" placeholder="Nombre del Responsable" value="" required>
        </div>

        <input type="hidden" id="id" name="id" value="<?= $planta->id ?? ''; ?>">

        <a onclick="Registrar('plantas', 'crear', 'formPlantas')" class="btn btn-primary">
            <?= isset($planta->id) && $planta->id > 0 ? 'Actualizar' : 'Registrar'; ?>
        </a>
    </form>
</div>
