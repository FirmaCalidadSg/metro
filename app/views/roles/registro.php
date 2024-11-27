
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Registro de Rol</h2>
                <form id="rolForm" method="POST" action="<?php echo BASE_PATH; ?>/roles/crear">
                    <input type="hidden" name="id" value="<?php echo isset($rol) ? $rol->id : ''; ?>">
                    
                    <div class="mb-3">
                        <label for="rol" class="form-label">Nombre del Rol</label>
                        <input type="text" class="form-control" id="rol" name="rol" 
                               value="<?php echo isset($rol) ? $rol->rol : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="<?php echo BASE_PATH; ?>/roles" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

   
    <script>
        document.getElementById('rolForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('Rol guardado exitosamente');
                    window.location.href = '<?php echo BASE_PATH; ?>/roles';
                } else {
                    alert('Error al guardar el rol: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });
        });
    </script>

