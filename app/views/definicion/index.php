<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Definicion</title>
</head>

<body>
    <div class="definicion">
        <div class="definicion-header">
        <div class="btn-space">
                    <h2>Definiciones Registradas</h2>
                    <button onclick="editarConfiguracion()" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-div">
                        <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                        <div class="text-style">Agregar</div>
                    </button>
                </div>
                <div class="table-container">
                    <table class="custom-table" id="tablaDefinicion">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Valor</th>
                                <th>Descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($definicion as $value): ?>
                                <tr>
                                    <td><?php echo $value->id; ?></td>
                                    <td><?php echo $value->nombre; ?></td>
                                    <td><?php echo $value->valor; ?></td>
                                    <td><?php echo $value->descripcion; ?></td>
                                    <td>
                                        <button onclick="verDefinicion(<?php echo $value->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-preview ">
                                            <img class="btn-preview img" src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                                        </button>
                                        <button onclick="editarDefinicion(<?php echo $value->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-warning">
                                            <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                                        </button>
                                        <button onclick="eliminarDefinicion(<?php echo $value->id; ?>)" class="btn-danger"><img src="/metro/app/Assets/css/images/delete.svg" title="Eliminar"></button>
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
            function editarConfiguracion() {
                window.location.href = '/metro/app/configuracion/registrar';
            }
            function editarDefinicion(id) {

                const formData = new FormData();
                formData.append('id', id);
                fetch('/metro/app/definicion/registro', {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.text();
                }).then(data => {
                    document.getElementById('modal-title').innerHTML;
                    document.getElementById('modal-body-content').innerHTML = data;
                    addSubmitForm();
                }).catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });

            }

            function agregarDefinicion() {

                fetch('/metro/app/configuracion/registrar', {
                    method: 'POST'
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.text();
                }).then(data => {
                    document.getElementById('modal-title').innerHTML = 'REGISTRAR DEFINICION';
                    document.getElementById('modal-body-content').innerHTML = data;
                    addSubmitForm();
                    window.location.href = '/metro/app/configuracion/registrar';
                }).catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });

            }

            function eliminarDefinicion(id) {
                if (confirm('¿Está seguro de eliminar este definicion?')) {
                    fetch(`/metro/app/definicion/eliminar/${id}`, {
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
                                alert('Definicion eliminado exitosamente');
                                location.reload();
                            } else {
                                alert('Error al eliminar definicion');
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

                    fetch('/metro/app/definicion/crear', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                window.location.href = '/metro/app/definicion';
                            } else {
                                console.error(data);
                                alert('Error al registrar definicion: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error al procesar la solicitud');
                        });
                });
            }
            document.addEventListener("DOMContentLoaded", function() {
                var tabla = document.querySelector('#tablaDefinicion');
                var dataTable = new DataTable(tabla, {
                    perPage: 2, 
                    paging: true, 
                    perPageSelect: false, 
                    sortable: false, 
                });
            });
        </script>
</body>

</html>