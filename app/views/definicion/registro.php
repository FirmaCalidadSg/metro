<div class="container">

    <form id="registroForm">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $definicion->nombre; ?>" required>
        </div>

        <div class="mb-3">
            <label for="valor" class="form-label">Valor:</label>
            <input type="text" id="valor" name="valor" class="form-control" value="<?php echo $definicion->valor; ?>" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcion:</label>
            <input type="text" id="descripcion" name="descripcion" class="form-control" value="<?php echo $definicion->descripcion; ?>" required>
        </div>        

        <div class="col-12">
            <input type="hidden" id="id" name="id" value="<?php echo $definicion->id; ?>">
            <button type="submit" class="btn btn-primary"><?php echo $definicion->id > 0 ? 'Actualizar' : 'Registrar'; ?></button>
        </div>
    </form>
</div>