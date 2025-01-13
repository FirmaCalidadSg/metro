<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Credenciales</title>
</head>

<body>
    <div class="credenciales">
        <div class="credenciales-header">
            <div class="btn-space">
                <h2>Cambiar Credenciales de Usuario</h2>
            </div>
    
        <form id="formCredenciales" class="formCredenciales-input">
            <input type="hidden" id="userId" name="id" value="<?php echo $usuario->id; ?>">

            <div class="formCredenciales-input">
                <label for="usuario">
                    <span class="form-label">Nombre de Usuario:</span>
                </label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="<?php echo $usuario->usuario; ?>" required>
            </div>

            <div class="formCredenciales-input">
                <label for="credencial">
                    <span class="form-label">Nueva Contraseña:</span>
                </label>
                <input type="password" class="form-control" id="credencial" name="credencial" value="" required placeholder="Ingrese la nueva contraseña">
            </div>

            <div class="formCredenciales-input">
                <label for="confirmarCredencial">
                    <span class="form-label">Confirmar Contraseña:</span>
                </label>
                <input type="password" class="form-control" id="confirmarCredencial" name="confirmarCredencial" required placeholder="Confirme la nueva contraseña">
            </div>

            <button type="submit" class="btn-primary mt-6" >Guardar Cambios</button> 
            <button type="button" class="btn-secondary mt-6" onclick="window.location.href='/metro/app/usuarios'">Cancelar</button>

        </form>
    </div>
    <script src="../../app/Assets/jquery/jquery.min.js"></script>

    <script>
        $('#formCredenciales').on('submit', function(e) {
            e.preventDefault();

            const credencial = $('#credencial').val();
            const confirmarCredencial = $('#confirmarCredencial').val();

            if (credencial !== confirmarCredencial) {
                alert('Las contraseñas no coinciden');
                return;
            }

            // Serializar los datos del formulario
            const formData = $(this).serialize();

            // Enviar datos con AJAX
            $.ajax({
                url: '/metro/app/usuarios/actcredenciales',
                type: 'POST',
                data: formData,
                dataType:'json',
                success: function(response) {
                    if (response.success) {
                        alert('Credenciales actualizadas exitosamente');
                        window.location.href = '/metro/app/usuarios';
                    } else {
                        alert('Error al actualizar credenciales: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                },
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