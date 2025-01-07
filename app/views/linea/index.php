<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Lineas</title>
</head>

<body>
    <div class="lineas">
        <div class="lineas-header">
            <div class="table-container">
                <div class="dataTable-top">
                    <div class="btn-space">
                        <div class="dataTable-wrapper">
                            <h2>Lista de Lineas</h2>
                        </div>
                        <button onclick="agregarLinea()" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-div">
                            <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                            <div class="text-style">Agregar</div>
                        </button>
                    </div>
                <table class="custom-table" id="tablaLineas">
                    <thead>
                        <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Proceso</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($lineas as $linea): ?>
                                    <tr>
                                        <td><?php echo $linea->id; ?></td>
                                        <td><?php echo $linea->nombre; ?></td>
                                        <td><?php echo $linea->nombre_proceso; ?></td>
                                        <td>
                                            <button onclick="verLinea(<?php echo $linea->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-preview">
                                                <img class="btn-preview img" src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                                            </button>
                                            <button onclick="editarLinea(<?php echo $linea->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-warning">
                                                <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                                            </button>
                                            <button onclick="eliminarLinea(<?php echo $linea->id; ?>)" class="btn-danger">
                                                <img class="btn-danger img" src="/metro/app/Assets/css/images/delete.svg" title="Eliminar">
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
            
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
            function editarLinea(id) {

                const formData = new FormData();
                formData.append('id', id);
                fetch('/metro/app/linea/registro', {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.text();
                }).then(data => {
                    document.getElementById('modal-title').innerHTML = 'ACTUALIZAR LINEA';
                    document.getElementById('modal-body-content').innerHTML = data;
                    addSubmitForm();
                }).catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });

            }

            function agregarLinea() {

                fetch('/metro/app/linea/registro', {
                    method: 'POST'
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.text();
                }).then(data => {
                    document.getElementById('modal-title').innerHTML = 'REGISTRAR LINEA';
                    document.getElementById('modal-body-content').innerHTML = data;
                    addSubmitForm();
                }).catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });

            }

            function eliminarLinea(id) {
                if (confirm('¿Está seguro de eliminar este linea?')) {
                    fetch(`/metro/app/linea/eliminar/${id}`, {
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
                                alert('Linea eliminado exitosamente');
                                location.reload();
                            } else {
                                alert('Error al eliminar linea');
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

                    fetch('/metro/app/linea/crear', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                window.location.href = '/metro/app/linea';
                            } else {
                                console.error(data);
                                alert('Error al registrar linea: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al procesar la solicitud');
                        });
                });
            }
            var tablaLineas = document.getElementById('tablaLineas');
            var dataTable = new DataTable(tablaLineas, {
                perPage: 5,
                paging: true,
                perPageSelect: false,
                sortable: false,
            });
        </script>
</body>

</html>