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
    <div class="modal-Admin" id="successModal" style="display: none;">
        <div class="modal-content">
            <div class="modal-title">
                <h2 id="modal-title">¡Éxito!</h2>
            </div>
            <p class="modal-message" id="modal-message">La operación se completó correctamente.</p>
            <button id="closeModal">Cerrar</button>
        </div>
    </div>

    <script>
        function editarRol(id) {
            const formData = new FormData();
            formData.append('id', id);
            fetch('/metro/app/roles/registro', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.text();
                })
                .then(data => {
                    // Cargar contenido dentro del modal
                    document.getElementById('modal-title').innerHTML = 'ACTUALIZAR ROL';
                    document.getElementById('modal-body-content').innerHTML = data;
                    addSubmitForm(); // Añadir la funcionalidad del submit al formulario cargado

                    // Mostrar el modal
                    const modal = new bootstrap.Modal(document.getElementById('modal-id'));
                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });
        }


        function agregarRol() {
            fetch('/metro/app/roles/registro', {
                    method: 'POST'
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.text();
                })
                .then(data => {
                    // Cargar contenido dentro del modal
                    document.getElementById('modal-title').innerHTML = 'REGISTRAR ROL';
                    document.getElementById('modal-body-content').innerHTML = data;
                    addSubmitForm(); // Añadir la funcionalidad del submit al formulario cargado

                    // Mostrar el modal
                    const modal = new bootstrap.Modal(document.getElementById('modal-id'));
                    modal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });
        }



        function eliminarRol(id) {
            // Modal de confirmación con SweetAlert
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0b7c3e',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'mi-clase-modal', // Clase personalizada para el modal
                    title: 'mi-titulo-modal', // Clase personalizada para el título
                    content: 'mi-contenido-modal', // Clase personalizada para el contenido
                    icon: 'mi-icono-modal' // Clase personalizada para el icono
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la petición al backend para eliminar el rol
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
                                // Mostrar mensaje de éxito con SweetAlert
                                Swal.fire(
                                    '¡Eliminado!',
                                    'El rol se eliminó exitosamente.',
                                    'success', {
                                        customClass: {
                                            popup: 'mi-clase-modal', // Clase personalizada para el modal
                                            title: 'mi-titulo-modal', // Clase personalizada para el título
                                            content: 'mi-contenido-modal', // Clase personalizada para el contenido
                                            icon: 'mi-icono-modal' // Clase personalizada para el icono
                                        }
                                    }
                                ).then(() => {
                                    location.reload(); // Recargar la página solo después de que el usuario cierre el modal
                                });
                            } else {
                                // Mostrar mensaje de error con SweetAlert
                                Swal.fire(
                                    'Error',
                                    'Hubo un problema al eliminar el rol.',
                                    'error', {
                                        customClass: {
                                            popup: 'mi-clase-modal', // Clase personalizada para el modal
                                            title: 'mi-titulo-modal', // Clase personalizada para el título
                                            content: 'mi-contenido-modal', // Clase personalizada para el contenido
                                            icon: 'mi-icono-modal' // Clase personalizada para el icono
                                        }
                                    }
                                );
                            }
                        })
                        .catch(error => {
                            // Mostrar mensaje de error general con SweetAlert
                            console.error('Error:', error);
                            Swal.fire(
                                'Error',
                                'Ocurrió un error al procesar la solicitud.',
                                'error', {
                                    customClass: {
                                        popup: 'mi-clase-modal', // Clase personalizada para el modal
                                        title: 'mi-titulo-modal', // Clase personalizada para el título
                                        content: 'mi-contenido-modal', // Clase personalizada para el contenido
                                        icon: 'mi-icono-modal' // Clase personalizada para el icono
                                    }
                                }
                            );
                        });
                }
            });
        }

        function addSubmitForm() {
            const formulario = document.getElementById('registroForm');

            formulario.addEventListener('submit', function(event) {
                event.preventDefault(); // Evita el comportamiento por defecto

                const formData = new FormData(event.currentTarget);

                // Enviar los datos al backend para crear/actualizar
                fetch('/metro/app/roles/crear', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        showModal(data.message, data.success);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showModal('Error al procesar la solicitud', false);
                    });
            });
        }



        function showModal(message, success) {
            const modalRegistro = bootstrap.Modal.getInstance(document.getElementById('modal-id'));
            modalRegistro.hide(); // Cierra el modal de registro/actualización

            const modalConfirmacion = document.getElementById('successModal');
            const modalMessage = document.getElementById('modal-message');
            modalMessage.textContent = message;

            if (success) {
                modalConfirmacion.style.backgroundColor = '#11111bd';
            } else {
                modalConfirmacion.style.backgroundColor = '#dc3545';
            }

            modalConfirmacion.style.display = 'block';

            const closeModalButton = document.getElementById('closeModal');
            closeModalButton.onclick = function() {
                modalConfirmacion.style.display = 'none'; // Cierra el modal de confirmación
                location.reload(); // Recarga la página
            };
        }
    </script>