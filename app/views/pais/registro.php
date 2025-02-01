    <?php // print_r($pais) ?>
    <div class="">
        <form action=""  method='POST' id="formPais">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?= $pais->nombre ?>" required>
            </div>

            <div class="mb-3">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código" value="<?= $pais->codigo ?>" required>
            </div>

            <input type="hidden" id="id" name="id" value="<?php echo $pais->id ?? ''; ?>">
            
            <a onclick="Registrar('pais', 'crear','formPais')" class="btn btn-primary">
                <?php echo isset($pais->id) && $pais->id > 0 ? 'Actualizar' : 'Registrar'; ?>
            </a>
        </form>
    </div>




