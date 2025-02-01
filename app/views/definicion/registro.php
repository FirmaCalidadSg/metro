<form method="POST" id="formdefinicion" class="" action="">
    <div class="drops-downs">
        <div class="element">
            <div class="form-group">
                <label for="valor">Valor</label>
                <input type="text" name="valor" class="form-control" id="valor" value="<?php echo $definicion->valor ?? ''; ?>" placeholder="Valor" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" id="nombre" value="<?php echo $definicion->nombre ?? ''; ?>" placeholder="Nombre" required>
            </div>
        </div>
        <div class="element">
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" class="form-control" id="descripcion" value="<?php echo $definicion->descripcion ?? ''; ?>" placeholder="Descripción" required>
            </div>
        </div>
    </div>

    <input type="hidden" id="id" name="id" value="<?php echo $definicion->id ?? ''; ?>">
    <button type="submit" class="btn btn-primary">
        <?php echo isset($definicion->id) && $definicion->id > 0 ? 'Actualizar' : 'Registrar'; ?>
    </button>
</form>
<script>
    $('#formdefinicion').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: '<?php echo BASE_PATH ?>definicion/crear',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
               
                if (response.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: response.msn,
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        $('#table').DataTable().ajax.reload();
                        location.reload(); // Agregado para recargar la página
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al guardar la planta',
                        confirmButtonText: 'Aceptar'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error en el servidor: ' + error,
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    });
</script>