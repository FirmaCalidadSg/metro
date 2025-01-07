<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Equipos</title>
</head>

<body>
    <div class="equipos">
        <div class="equipos-header">
            <h2>Lista de Equipos</h2>
            <button onclick="agregarEquipo()" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-div">
                <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                <div class="text-style">Agregar</div>
            </button>
    
        <!-- <a href="/metro/app/equipo/registro" class="btn btn-primary">Nuevo Equipo</a> -->
        <div class="table-container">
        <table class="custom-table" id="tablaEquipos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Modelo</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($equipos as $equipo): ?>
                    <tr>
                        <td><?php echo $equipo->id; ?></td>
                        <td><?php echo $equipo->nombre; ?></td>
                        <td><?php echo $equipo->modelo; ?></td>
                        <td><?php echo $equipo->estado; ?></td>
                        <td>
                            <button onclick="verEquipo(<?php echo $equipo->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-preview">
                                <img class="btn-preview img" src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                            </button>
                            <button onclick="editarEquipo(<?php echo $equipo->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-warning">
                                <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                            </button>
                            <button onclick="eliminarEquipo(<?php echo $equipo->id; ?>)" class="btn-danger">
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
        function editarEquipo(id) {

            const formData = new FormData();
            formData.append('id', id);
            fetch('/metro/app/equipo/registro', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'ACTUALIZAR EQUIPO';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function agregarEquipo() {

            fetch('/metro/app/equipo/registro', {
                method: 'POST'
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'REGISTRAR EQUIPO';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function eliminarEquipo(id) {
            if (confirm('¿Está seguro de eliminar este equipo?')) {
                fetch(`/metro/app/equipo/eliminar/${id}`, {
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
                            alert('Equipo eliminado exitosamente');
                            location.reload();
                        } else {
                            alert('Error al eliminar equipo');
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

                fetch('/metro/app/equipo/crear', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = '/metro/app/equipo';
                        } else {
                            console.error(data);
                            alert('Error al registrar equipo: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud');
                    });
            });
        }
        document.addEventListener('DOMContentLoaded', function() {
            const tablaEquipos = document.getElementById('tablaEquipos');
            var dataTable = new DataTable(tablaEquipos, {
                    perPage: 2, 
                    paging: true, 
                    perPageSelect: false, 
                    sortable: false, 
                });
        });
    </script>
</body>

</html>