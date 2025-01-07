<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Daños de Equipos</title>
</head>

<body>
    <div class="dano">
        <div class="dano-header">
            <h2>Lista de Daños de Equipos</h2>
            <button onclick="agregarDano()" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-div">
                <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                <div class="text-style">Agregar</div>
            </button>
        <div class="table-container">
            <table class="custom-table" id="tablaDano">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Equipo</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($danos as $dano): ?>
                    <tr>
                        <td><?php echo $dano->id; ?></td>                        
                        <td><?php echo $dano->nombre_equipo; ?></td>
                        <td><?php echo $dano->descripcion; ?></td>
                        <td><?php echo $dano->fecha; ?></td>
                        <td><?php echo $dano->estado; ?></td>
                        <td>
                        <button onclick="verDano(<?php echo $dano->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-preview ">
                                            <img class="btn-preview img" src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                                        </button>
                                <button onclick="editarDano(<?php echo $dano->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-warning">
                                    <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                                </button>
                            <button onclick="eliminarDano(<?php echo $dano->id; ?>)" class="btn-danger">
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
        function editarDano(id) {

            const formData = new FormData();
            formData.append('id', id);
            fetch('/metro/app/danoequipo/registro', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'ACTUALIZAR DAÑO';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function agregarDano() {

            fetch('/metro/app/danoequipo/registro', {
                method: 'POST'
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'REGISTRAR DAÑO';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function eliminarDano(id) {
            if (confirm('¿Está seguro de eliminar este dano?')) {
                fetch(`/metro/app/danoequipo/eliminar/${id}`, {
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
                            alert('Daño eliminado exitosamente');
                            location.reload();
                        } else {
                            alert('Error al eliminar dano');
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

                fetch('/metro/app/danoequipo/crear', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = '/metro/app/danoequipo';
                        } else {
                            console.error(data);
                            alert('Error al registrar dano: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud');
                    });
            });
        }
        document.addEventListener("DOMContentLoaded", function() {
                var tabla = document.querySelector('#tablaDano');
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