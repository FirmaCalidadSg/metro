<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>

<body>
    <div class="container">
        <h2>Registro de Usuario</h2>

        <form id="registroForm" onsubmit="enviarFormulario(event)">
            <script>
                function enviarFormulario(e) {
                    e.preventDefault();

                    const formData = new FormData(document.getElementById('registroForm'));

                    fetch('/metro/app/usuarios/crear', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('Usuario registrado exitosamente');
                                //  window.location.href = '/metro/app/usuarios';
                            } else {
                                alert('Error al registrar usuario: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al procesar la solicitud');
                        });
                }
            </script>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control" value="<?php echo $usuario->apellidos; ?>" required>
            </div>

            <div class="form-group">
                <label for="nombres">Nombres:</label>
                <input type="text" id="nombres" name="nombres" class="form-control" value="<?php echo $usuario->nombres; ?>" required>
            </div>

            <div class="form-group">
                <label for="sistema">usuario:</label>
                <input type="text" id="usuario" name="usuario" class="form-control" value="<?php echo $usuario->usuario; ?>" required>
            </div>

            <div class="form-group">
                <label for="credencial">credencial:</label>
                <input type="text" id="credencial" name="credencial" class="form-control" value="" required>
            </div>


            <div class="form-group">
                <label for="rol">Rol:</label>
                <select id="rol" name="rol_id" class="form-control" required>
                    <?php foreach ($roles as $rol): ?>
                        <option value="<?php echo $rol['id']; ?>" <?php echo $usuario->rol_id == $rol['id'] ? 'selected' : ''; ?>><?php echo $rol['rol']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="identificacion">identificacion:</label>
                <input type="number" id="identificacion" class="form-control" name="identificacion" value="<?php echo $usuario->identificacion; ?>" required>
                <input type="hidden" id="id" name="id" value="<?php echo $usuario->id; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
</body>

</html>