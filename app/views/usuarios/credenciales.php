<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Credenciales</title>
</head>
<body>
    <div class="container">
        <h2>Cambiar Credenciales de Usuario</h2>
        
        <form id="formCredenciales" class="mt-4">
            <input type="hidden" id="userId" name="id" value="<?php echo $usuario->id; ?>">
            
            <div class="form-group">
                <label for="usuario">Nombre de Usuario:</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario->usuario; ?>" required>
            </div>

            <div class="form-group">
                <label for="credencial">Nueva Contraseña:</label>
                <input type="password" class="form-control" id="credencial" name="credencial" value="" required placeholder="Ingrese la nueva contraseña">
            </div>

            <div class="form-group">
                <label for="confirmarCredencial">Confirmar Contraseña:</label>
                <input type="password" class="form-control" id="confirmarCredencial" name="confirmarCredencial" required placeholder="Confirme la nueva contraseña">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
            <a href="/metro/app/usuarios" class="btn btn-secondary mt-3">Cancelar</a>
        </form>
    </div>

    <script>
        document.getElementById('formCredenciales').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const credencial = document.getElementById('credencial').value;
            const confirmarCredencial = document.getElementById('confirmarCredencial').value;
            
            if (credencial !== confirmarCredencial) {
                alert('Las contraseñas no coinciden');
                return;
            }

            const formData = {
                id: document.getElementById('userId').value,
                usuario: document.getElementById('usuario').value,
                credencial: credencial
            };

            fetch('/metro/app/usuarios/credenciales', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Credenciales actualizadas exitosamente');
                    window.location.href = '/metro/app/usuarios';
                } else {
                    alert('Error al actualizar credenciales: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });
        });

        // Obtener el ID del usuario de la URL
        const urlParams = new URLSearchParams(window.location.search);
        const userId = urlParams.get('id');
        if (userId) {
            document.getElementById('userId').value = userId;
        }
    </script>
</body>
</html>
