<div class="container">

    <form id="registroForm">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $equipo->nombre; ?>" required>
        </div>

        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo:</label>
            <input type="text" id="modelo" name="modelo" class="form-control" value="<?php echo $equipo->modelo; ?>" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <input type="text" id="estado" name="estado" class="form-control" value="<?php echo $equipo->estado; ?>" required>
        </div>

        <div class="col-12">
            <input type="hidden" id="id" name="id" value="<?php echo $equipo->id; ?>">
            <button type="submit" class="btn btn-primary"><?php echo $equipo->id > 0 ? 'Actualizar' : 'Registrar'; ?></button>
        </div>
    </form>
</div>