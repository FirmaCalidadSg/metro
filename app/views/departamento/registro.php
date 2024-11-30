<div class="container">

    <form id="registroForm">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $departamento->nombre; ?>" required>
        </div>

        <div class="mb-3">
            <label for="pais" class="form-label">Pais:</label>
            <select id="pais" name="pais" class="form-control" required>
                <?php foreach ($paises as $pais): ?>
                    <option value="<?php echo $pais->id ?>" <?php echo $departamento->pais == $pais->id ? 'selected' : '' ?>><?php echo $pais->nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-12">
            <input type="hidden" id="id" name="id" value="<?php echo $departamento->id; ?>">
            <button type="submit" class="btn btn-primary"><?php echo $departamento->id > 0 ? 'Actualizar' : 'Registrar'; ?></button>
        </div>
    </form>
</div>