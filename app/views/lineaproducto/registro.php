<div class="container">

    <form id="registroForm">

        <div class="mb-3">
            <label for="linea" class="form-label">Linea:</label>
            <select id="linea" name="linea" class="form-control" required>
                <?php foreach ($lineas as $linea): ?>
                    <option value="<?php echo $linea->id ?>" <?php echo $linea_producto->linea == $linea->id ? 'selected' : '' ?>><?php echo $linea->nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="producto" class="form-label">Producto:</label>
            <select id="producto" name="producto" class="form-control" required>
                <?php foreach ($productos as $producto): ?>
                    <option value="<?php echo $producto->id ?>" <?php echo $linea_producto->producto == $producto->id ? 'selected' : '' ?>><?php echo $producto->nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="capacidad_produccion" class="form-label">Capacidad de Producción:</label>
            <input type="number" step=".01" min="0" id="capacidad_produccion" name="capacidad_produccion" class="form-control" value="<?php echo $linea_producto->capacidad_produccion; ?>" required>
        </div>

        <div class="col-12">
            <input type="hidden" id="id" name="id" value="<?php echo $linea_producto->id; ?>">
            <button type="submit" class="btn btn-primary"><?php echo $linea_producto->id > 0 ? 'Actualizar' : 'Registrar'; ?></button>
        </div>
    </form>
</div>