<div class="container">

    <form id="registroForm">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $ciudad->nombre; ?>" required>
        </div>

        <div class="mb-3">
            <label for="pais" class="form-label">Pais:</label>
            <select id="pais" name="pais" class="form-control" required>
                <?php foreach ($paises as $pais): ?>
                    <option value="<?php echo $pais->id ?>" <?php echo $ciudad->pais == $pais->id ? 'selected' : '' ?>><?php echo $pais->nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="codigo_postal" class="form-label">Codigo Postal:</label>
            <input type="number" id="codigo_postal" name="codigo_postal" class="form-control" value="<?php echo $ciudad->codigo_postal; ?>" required>
        </div>

        <div class="col-12">
            <input type="hidden" id="id" name="id" value="<?php echo $ciudad->id; ?>">
            <button type="submit" class="btn btn-primary"><?php echo $ciudad->id > 0 ? 'Actualizar' : 'Registrar'; ?></button>
        </div>
    </form>
</div>