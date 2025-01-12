<div class="container">
    <form id="registroForm">

        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo $usuario->apellidos; ?>" required>
        </div>

        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres:</label>
            <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo $usuario->nombres; ?>" required>
        </div>

        <div class="mb-3">
            <label for="sistema" class="form-label">Usuario:</label>
            <input type="text" id="usuario" name="usuario" class="form-control" value="<?php echo $usuario->usuario; ?>" required>
        </div>

        <div class="mb-3">
            <label for="credencial" class="form-label">Credencial:</label>
            <input type="text" id="credencial" name="credencial" class="form-control" value="" required>
        </div>


        <div class="mb-3">
            <label for="rol" class="form-label">Rol:</label>
            <select id="rol" name="rol_id" class="form-control" required>
                <?php foreach ($roles as $rol): ?>
                    <option value="<?php echo $rol['id']; ?>" <?php echo $usuario->rol_id == $rol['id'] ? 'selected' : ''; ?>><?php echo $rol['rol']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="identificacion" class="form-label">Identificacion:</label>
            <input type="number" id="identificacion" class="form-control" name="identificacion" value="<?php echo $usuario->identificacion; ?>" required>
            <input type="hidden" id="id" name="id" value="<?php echo $usuario->id; ?>">
        </div>

        <div class="col-12">
            <button type="submit" class="btn-primary"><?php echo $usuario->id > 0 ? 'Actualizar' : 'Registrar'; ?></button>
        </div>
    </form>
    </div>
</div>