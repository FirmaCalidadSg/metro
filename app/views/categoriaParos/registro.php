<?php  //print_r($distribucion); 
?>
<div class="">
    <form action="" method="POST" id="formCategoriaParos">
        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select class="form-control" id="id_distribucion" name="id_distribucion" required>
                <option value="">Seleccione la distribucion de tiempo</option>
                <?php foreach ($distribucion as $categoria): ?>
                    <option value="<?= $categoria->id ?>" <?= isset($categoriaParos->id_distribucion) && $categoriaParos->id_distribucion == $categoria->id ? 'selected' : '' ?>>
                        <?= $categoria->nombre ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?= $categoriaParos->nombre ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required><?= $categoriaParos->descripcion ?? '' ?></textarea>
        </div>

        <input type="hidden" id="id" name="id" value="<?= $categoriaParos->id_categoria ?? ''; ?>">

        <a onclick="Registrar('categoriaParos', 'crear', 'formCategoriaParos')" class="btn btn-primary">
            <?= isset($categoriaParos->id_categoria) && $categoriaParos->id_categoria > 0 ? 'Actualizar' : 'Registrar'; ?>
        </a>
    </form>
</div>