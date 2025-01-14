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
                        <th>Identificación</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario->identificacion; ?></td>
                            <td><?php echo $usuario->nombres; ?></td>
                            <td><?php echo $usuario->apellidos; ?></td>
                            <td><?php echo $usuario->usuario; ?></td>
                            <td><?php echo $usuario->rol; ?></td>
                            <td>
                                <button onclick="editarUsuario(<?php echo $usuario->usuario_id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-warning">
                                    <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                                </button>
                                <button id="eliminarBtn" class="btn-danger" onclick="confirmarEliminar(<?php echo $usuario->usuario_id; ?>)">
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

    <div class="modal fade" id="modal-id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false" backdrop="static">
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

                setTimeout(() => {
                    const modalRegistro = new bootstrap.Modal(document.getElementById('modal-id'));
                    modalRegistro.show();
                }, 100);
            }).catch(error => {
                console.error('Error:', error);
                // Si hay un error, mostrar un modal de error
                /*                 setTimeout(() => {
                                    showModal('Usuario Actualizado correctamente', false);
                                }, 300); */
            });
        }




        function agregarUsuario() {
            const modal = new bootstrap.Modal(document.getElementById('modal-id'), {
                backdrop: 'static'
            });
            modal.show();

            fetch('/metro/app/usuarios/registro', {
                    method: 'POST'
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error al obtener el formulario');
                    }
                    return response.text();
                })
                .then(data => {
                    document.getElementById('modal-title').innerHTML = 'REGISTRAR USUARIO';
                    document.getElementById('modal-body-content').innerHTML = data;
                    addSubmitForm();
                })
                .catch(error => {
                    console.error('Error:', error);
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
                modalConfirmacion.style.backgroundColor = '#11111bd';
            }

            modalConfirmacion.style.display = 'block';

            const closeModalButton = document.getElementById('closeModal');
            closeModalButton.onclick = function() {
                modalConfirmacion.style.display = 'none'; // Cierra el modal de confirmación
                location.reload(); // Recarga la página
            };
        }

        function confirmarEliminar(id) {
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
                    fetch(`/metro/app/usuarios/eliminar/${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: '¡Eliminado!',
                                    text: data.message,
                                    icon: 'success',
                                    customClass: {
                                        popup: 'mi-clase-modal', // Clase personalizada para el modal de éxito
                                        title: 'mi-titulo-modal', // Clase personalizada para el título de éxito
                                        content: 'mi-contenido-modal', // Clase personalizada para el contenido de éxito
                                        icon: 'mi-icono-modal' // Clase personalizada para el icono de éxito
                                    }
                                }).then(() => {
                                    location.reload(); // Recarga la página después de la confirmación de éxito
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: data.error,
                                    icon: 'error',
                                    customClass: {
                                        popup: 'mi-clase-modal', // Clase personalizada para el modal de error
                                        title: 'mi-titulo-modal', // Clase personalizada para el título de error
                                        content: 'mi-contenido-modal', // Clase personalizada para el contenido de error
                                        icon: 'mi-icono-modal' // Clase personalizada para el icono de error
                                    }
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                title: 'Error',
                                text: 'Ocurrió un error al procesar la solicitud.',
                                icon: 'error',
                                customClass: {
                                    popup: 'mi-clase-modal', // Clase personalizada para el modal de error
                                    title: 'mi-titulo-modal', // Clase personalizada para el título de error
                                    content: 'mi-contenido-modal', // Clase personalizada para el contenido de error
                                    icon: 'mi-icono-modal' // Clase personalizada para el icono de error
                                }
                            });
                        });
                }
            });
        }



        /*         function eliminarUsuario(id) {
                    if (confirm('¿Está seguro de eliminar este usuario?')) {
                        fetch(`../app/usuarios/eliminar/${id}`, {
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
                } */

        function addSubmitForm() {
            const formulario = document.getElementById('registroForm');

            if (!formulario) {
                console.error('Formulario no encontrado');
                return;
            }

            formulario.addEventListener('submit', function(event) {
                event.preventDefault(); // Evita el comportamiento por defecto

                const formData = new FormData(event.currentTarget);

                // Enviar los datos al backend para crear/actualizar
                fetch('/metro/app/usuarios/crear', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        const contentType = response.headers.get('Content-Type');

                        if (contentType && contentType.includes('application/json')) {
                            return response.json(); // Si es JSON, lo procesamos como JSON
                        } else {
                            return response.text(); // Si no es JSON, lo tratamos como texto (HTML)
                        }
                    })
                    .then(data => {
                        if (typeof data === 'object') {
                            // Si es un objeto JSON válido
                            if (data.success) {
                                showModal('Usuario registrado correctamente', true);
                            } else {
                                showModal('Error al registrar usuario', false);
                            }
                        } else {
                            // Si no es JSON, significa que es una página de error en HTML
                            console.error('Error inesperado:', data);
                            showModal('Usuario registrado correctamente', false);
                        }
                    })
                    .catch(error => {
                        console.error('Error en el fetch:', error);
                        showModal('Error al procesar la solicitud', false); // Mostrar modal de error
                    });
            });
        }
    </script>
</body>

</html>