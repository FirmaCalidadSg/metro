<div class="container">

    <form id="registroForm">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $pais->nombre; ?>" required>
        </div>

        <div class="mb-3">
            <label for="codigo" class="form-label">Codigo:</label>
            <input type="text" id="codigo" name="codigo" class="form-control" value="<?php echo $pais->codigo; ?>" required>
        </div>

        <div class="col-12">
            <input type="hidden" id="id" name="id" value="<?php echo $pais->id; ?>">
            <button type="submit" class="btn btn-primary"><?php echo $pais->id > 0 ? 'Actualizar' : 'Registrar'; ?></button>
        </div>
    </form>
</div>