<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>

<body>
    <div class="container">
        <h2>Lista de Usuarios</h2>
        <a href="/metro/app/usuarios/registro" class="btn btn-primary">Nuevo Usuario</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Identificación</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario->id; ?></td>
                        <td><?php echo $usuario->identificacion; ?></td>
                        <td><?php echo $usuario->nombres; ?></td>
                        <td><?php echo $usuario->apellidos; ?></td>
                        <td><?php echo $usuario->usuario; ?></td>
                        <td><?php echo $usuario->rol_id; ?></td>
                        <td>
                            <button onclick="editarUsuario(<?php echo $usuario->id; ?>)" class="btn btn-warning">Editar</button>
                            <button onclick="eliminarUsuario(<?php echo $usuario->id; ?>)" class="btn btn-danger">Eliminar</button>
                            <button onclick="cambiarCredenciales(<?php echo $usuario->id; ?>)" class="btn btn-info">Cambiar Credenciales</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function cambiarCredenciales(id) {
            window.location.href = '/metro/app/usuarios/credenciales/' + id;
        }
        function editarUsuario(id) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/metro/app/usuarios/registro';

            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'id';
            input.value = id;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }

        function eliminarUsuario(id) {
            if (confirm('¿Está seguro de eliminar este usuario?')) {
                fetch(`/metro/app/usuarios/eliminar/${id}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta del servidor');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert('Usuario eliminado exitosamente');
                            location.reload();
                        } else {
                            alert('Error al eliminar usuario');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud');
                    });
            }
        }
    </script>
</body>

</html>