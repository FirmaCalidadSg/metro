<?php // print_r($categoriasParos) ?>
<div class="">
    <form action="" method="POST" id="formTiposParos">
        <div class="mb-3">
            <label for="id_subcategoria" class="form-label">Subcategoría</label>
            <select class="form-control" id="id_subcategoria" name="id_subcategoria" required>
                <option value="">Seleccione una Subcategoría</option>
                <?php foreach ($categoriasParos as $subcategoria): ?>
                    <option value="<?= $subcategoria->id_subcategoria ?>" <?= isset($TiposParos->id_subcategoria) && $TiposParos->id_subcategoria == $subcategoria->id_subcategoria ? 'selected' : '' ?>>
                        <?= $subcategoria->nombre ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="codigo" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?= $TiposParos->nombre ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required><?= $TiposParos->descripcion ?? '' ?></textarea>
        </div>

        <input type="hidden" id="id_tipo" name="id_tipo" value="<?= $TiposParos->id_tipo ?? ''; ?>">

        <a onclick="Registrar('tiposParos', 'crear', 'formTiposParos')" class="btn btn-primary">
            <?= isset($TiposParos->id_tipo) && $TiposParos->id_tipo > 0 ? 'Actualizar' : 'Registrar'; ?>
        </a>
    </form>
</div>
