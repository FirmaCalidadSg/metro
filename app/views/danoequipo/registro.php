<div class="container">

    <form id="registroForm">

        <div class="mb-3">
            <label for="equipo" class="form-label">Equipo:</label>
            <select id="equipo" name="equipo" class="form-control" required>
                <?php foreach ($equipos as $equipo): ?>
                    <option value="<?php echo $equipo->id ?>" <?php echo $dano->equipo == $equipo->id ? 'selected' : '' ?>><?php echo $equipo->nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" value="<?php echo $dano->descripcion; ?>" required>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="datetime-local" id="fecha" name="fecha" class="form-control" value="<?php echo $dano->fecha; ?>" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <input type="text" id="estado" name="estado" class="form-control" value="<?php echo $dano->estado; ?>" required>
        </div>

        <div class="col-12">
            <input type="hidden" id="id" name="id" value="<?php echo $dano->id; ?>">
            <button type="submit" class="btn btn-primary"><?php echo $dano->id > 0 ? 'Actualizar' : 'Registrar'; ?></button>
        </div>
    </form>
</div>