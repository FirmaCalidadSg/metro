<div class="">
    <form action="" method="POST" id="formProducto">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" value="<?= $producto->nombre ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del producto" value="<?= $producto->codigo ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción del producto"><?= $producto->descripcion ?? '' ?></textarea>
        </div>

        <div class="mb-3">
            <label for="linea_id" class="form-label">Línea</label>
            <select class="form-control" id="linea_id" name="linea_id" required>
                <option value="">Seleccione una Línea</option>
                <?php foreach ($lineas as $linea): ?>
                    <option value="<?= $linea->id ?>" <?= isset($producto->linea_id) && $producto->linea_id == $linea->id ? 'selected' : '' ?>>
                        <?= $linea->nombre ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <input type="hidden" id="id" name="id" value="<?= $producto->id ?? ''; ?>">

        <a onclick="Registrar('producto', 'crear', 'formProducto')" class="btn btn-primary">
            <?= isset($producto->id) && $producto->id > 0 ? 'Actualizar' : 'Registrar'; ?>
        </a>
    </form>
</div>
