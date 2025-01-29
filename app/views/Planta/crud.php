<form id="formPlanta" method="POST">
    <div class="row">
        <div class="col-md-12">
            <div class="col md-6">
                <input type="hidden" id="id_planta" name="id_planta">
                <div class="form-group">
                    <label for="nombre">Nombre de la Planta</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
            </div>
            <div class="col md-6">
                <div class="form-group">
                    <label for="ubicacion">Ubicación</label>
                    <select id='ciudad_id' name="ciudad_id" class="form-control select2">
                        <option value="">Seleccionar</option>
                        <?php foreach ($ciudades as $value): ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->nombre ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>
<script>
    $('#formPlanta').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: '<?php echo BASE_PATH ?>plantas/registrar',
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
                        text: 'Planta guardada correctamente',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {                        
                            $('#table').DataTable().ajax.reload();
                        
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