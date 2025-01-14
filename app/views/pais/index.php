<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Paises</title>
</head>

<body>
    <div class="pais">
        <button class="btn-back" onclick="goBack()">
            <div class="btn-back-text">
                < Volver</div>
        </button>
        <div class="pais-header">
            <div class="btn-space">
                <h2>Lista de Paises</h2>
                <button onclick="agregarPais()" class="btn-div">
                    <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                    <div class="text-style">Agregar</div>
                </button>
                <div class="space-input">
                    <select class="selector-table" id="pais-selector">
                        <option value="" disabled selected>Filtrar por Pais</option>
                        <?php foreach ($paises as $pais): ?>
                            <option value="<?php echo $pais->id; ?>"><?php echo $pais->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
                <div class="space-input">
                    <select class="selector-table" id="codigo-selector">
                        <option value="" disabled selected>Filtrar por codigo</option>
                        <?php foreach ($paises as $pais): ?>
                            <option value="<?php echo $pais->codigo; ?>"><?php echo $pais->codigo; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
            </div>
            <table class="custom-table" id="tablaPais">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paises as $pais): ?>
                        <tr>
                            <td><?php echo $pais->id; ?></td>
                            <td><?php echo $pais->nombre; ?></td>
                            <td><?php echo $pais->codigo; ?></td>
                            <td>
                                <a href="../app/pais/vistaPrevia/<?php echo $pais->id; ?>" class="btn-preview">
                                    <img src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                                </a>
                                <a href="../app/pais/editarFormulario/<?php echo $pais->id; ?>" class="btn-warning">
                                    <img src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                                </a>
                                <button onclick="eliminarPais(<?php echo $pais->id; ?>)" class="btn-danger">
                                    <img src="/metro/app/Assets/css/images/delete.svg" title="Eliminar">
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
        document.getElementById('pais-selector').addEventListener('change', function() {
            filtrarTabla();
        });

        document.getElementById('codigo-selector').addEventListener('change', function() {
            filtrarTabla();
        });

        function filtrarTabla() {
            var paisSeleccionado = document.getElementById('pais-selector').value;
            var codigoSeleccionado = document.getElementById('codigo-selector').value;

            var filas = document.querySelectorAll('#tablaPais tbody tr');

            filas.forEach(function(fila) {
                var paisId = fila.cells[0].textContent.trim(); // Columna "ID" (usada para comparar)
                var codigo = fila.cells[2].textContent.trim(); // Columna "Codigo"

                // Filtrar por pais ID o codigo, si corresponde
                if ((paisSeleccionado === "" || paisId == paisSeleccionado) &&
                    (codigoSeleccionado === "" || codigo == codigoSeleccionado)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        }


        function goBack() {
            window.history.back();
        }

        function editarPais(id) {

            const formData = new FormData();
            formData.append('id', id);
            fetch('/metro/app/pais/registro', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'ACTUALIZAR PAIS';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function agregarPais() {
            window.location.href = '/metro/app/pais/registro';

            /*             fetch('/metro/app/pais/registro', {
                            method: 'POST'
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta del servidor');
                            }
                            return response.text();
                        }).then(data => {
                            document.getElementById('modal-title').innerHTML = 'REGISTRAR PAIS';
                            document.getElementById('modal-body-content').innerHTML = data;
                            addSubmitForm();
                        }).catch(error => {
                            console.error('Error:', error);
                            alert('Error al procesar la solicitud');
                        });
             */
        }

        function eliminarPais(id) {
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
                    fetch(`/metro/app/pais/eliminar/${id}`, {
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
                                    location.reload(); // Recargar la página después de eliminar
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

        function addSubmitForm() {
            const formulario = document.getElementById('registroForm');
            formulario.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(event.currentTarget);

                fetch('/metro/app/pais/crear', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = '/metro/app/pais';
                        } else {
                            console.error(data);
                            alert('Error al registrar pais: ' + data.message);
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