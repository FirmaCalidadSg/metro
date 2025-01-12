<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
</head>

<body>
    <div class="usuarios">
        <div class="usuarios-header">
            <div class="btn-space">
                <h2>Lista de Usuarios</h2>
            </div>
            <button onclick="agregarUsuario()" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-primary">Nuevo Usuario</button>

        <table class="custom-table" id="tablaUsuarios">
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
                            <button onclick="editarUsuario(<?php echo $usuario->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-warning">
                                <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                            </button>
                            <button onclick="eliminarUsuario(<?php echo $usuario->id; ?>)" class="btn-danger">
                                <img class="btn-danger img" src="/metro/app/Assets/css/images/delete.svg" title="Eliminar">
                            </button>
                            <button onclick="cambiarCredenciales(<?php echo $usuario->id; ?>)" class="btn-adjust">
                                <img class="btn-adjust img" src="/metro/app/Assets/css/images/set3.svg" title="Cambiar Credenciales">
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>

    <div class="modal fade" id="modal-id" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="false" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="modal-title">Modal title</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    ...
                </div>

            </div>
        </div>
    </div>


    <script>
        function cambiarCredenciales(id) {
            window.location.href = '/metro/app/usuarios/credenciales/' + id;
        }

        function editarUsuario(id) {

            const formData = new FormData();
            formData.append('id', id);
            fetch('/metro/app/usuarios/registro', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'ACTUALIZAR USUARIO';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function agregarUsuario() {

            fetch('/metro/app/usuarios/registro', {
                method: 'POST'
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'REGISTRAR USUARIO';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

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

        function addSubmitForm() {
            const formulario = document.getElementById('registroForm');
            formulario.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(event.currentTarget);

                fetch('/metro/app/usuarios/crear', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = '/metro/app/usuarios';
                        } else {
                            alert('Error al registrar usuario: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud');
                    });
            });
        }
    </script>
</body>

</html>