<?php // print_r($categoriasParos) ?>
<div class="">
    <form action="" method="POST" id="formSubcategoriaParos">
        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select class="form-control" id="id_categoria" name="id_categoria" required>
                <option value="">Seleccione el paro</option>
                <?php foreach ($categoriasParos as $categoria): ?>
                    <option value="<?= $categoria->id_categoria ?>" <?= isset($SubCategoriaParos->id_categoria) && $SubCategoriaParos->id_categoria == $categoria->id_categoria ? 'selected' : '' ?>>
                        <?= $categoria->nombre ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?= $SubCategoriaParos->nombre ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required><?= $SubCategoriaParos->descripcion ?? '' ?></textarea>
        </div>

        <input type="hidden" id="id" name="id" value="<?= $SubCategoriaParos->id_subcategoria; ?>">

        <a onclick="Registrar('subCategoriaParos', 'crear', 'formSubcategoriaParos')" class="btn btn-primary">
            <?= isset($SubCategoriaParos->id_subcategoria) && $SubCategoriaParos->id_subcategoria > 0 ? 'Actualizar' : 'Registrar'; ?>
        </a>
    </form>
</div>
