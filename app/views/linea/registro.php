<div class="container">

    <form id="registroForm">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $linea->nombre; ?>" required>
        </div>

        <div class="mb-3">
            <label for="proceso" class="form-label">Proceso:</label>
            <select id="proceso" name="proceso" class="form-control" required>
                <?php foreach ($procesos as $proceso): ?>
                    <option value="<?php echo $proceso->id ?>" <?php echo $linea->proceso == $proceso->id ? 'selected' : '' ?>><?php echo $proceso->nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-12">
            <input type="hidden" id="id" name="id" value="<?php echo $linea->id; ?>">
            <button type="submit" class="btn btn-primary"><?php echo $linea->id > 0 ? 'Actualizar' : 'Registrar'; ?></button>
        </div>
    </form>
</div>