<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Roles</title>
</head>

<body>

    <div class="roles">
        <div class="roles-header">
                    <h2>Gestión de Roles</h2>
                    <div class="mb-3">
                <button onclick="agregarRol()" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-primary">Nueva Rol</button>
                <!-- <a href="<?php echo BASE_PATH; ?>/roles/registro" class="btn btn-primary">Nuevo Rol</a> -->
            </div>

        <table class="custom-table" id="tablaRoles">
            <thead>
                <tr>
                    <th>ID</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $rol): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($rol->id); ?></td>
                                <td><?php echo htmlspecialchars($rol->rol); ?></td>
                                <td>
                                <button onclick="editarRol(<?php echo $rol->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-warning">
                                <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                                </button>
                                <button onclick="eliminarRol(<?php echo $rol->id; ?>)" class="btn-danger">
                                    <img class="btn-danger img" src="/metro/app/Assets/css/images/delete.svg" title="Eliminar">
                                </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-title"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body-content">
                    ...
                </div>

            </div>
        </div>
    </div>

    <script>
        function editarRol(id) {

            const formData = new FormData();
            formData.append('id', id);
            fetch('/metro/app/roles/registro', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'ACTUALIZAR ROL';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function agregarRol() {

            fetch('/metro/app/roles/registro', {
                method: 'POST'
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'REGISTRAR ROL';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function eliminarRol(id) {
            if (confirm('¿Está seguro de eliminar este rol?')) {
                fetch(`/metro/app/roles/eliminar/${id}`, {
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
                            alert('Rol eliminado exitosamente');
                            location.reload();
                        } else {
                            alert('Error al eliminar roles');
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

                fetch('/metro/app/roles/crear', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = '/metro/app/roles';
                        } else {
                            console.error(data);
                            alert('Error al registrar roles: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud');
                    });
            });
        }
    </script>