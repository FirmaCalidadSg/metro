<div class="container">

    <form id="registroForm">

        <div class="mb-3">
            <label for="rol" class="form-label">Nombre del rol:</label>
            <input type="text" id="rol" name="rol" class="form-control" value="<?php echo $rol->rol; ?>" required>
        </div>

        <div class="col-12">
            <input type="hidden" id="id" name="id" value="<?php echo $rol->id; ?>">
            <button type="submit" class="btn btn-primary"><?php echo $rol->id > 0 ? 'Actualizar' : 'Registrar'; ?></button>
        </div>
    </form>
</div>