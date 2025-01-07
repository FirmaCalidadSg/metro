<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Procesos</title>
</head>

<body>
    <div class="procesos">
        <div class="procesos-header">
        <h2>Lista de Procesos</h2>
        <button onclick="agregarProceso()" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-div">
            <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg" title="Agregar">
            <div class="text-style">Agregar</div>
        </button>
        
        <!-- <a href="/metro/app/proceso/registro" class="btn btn-primary">Nuevo Proceso</a> -->
        <div class="table-container">
            <table class="custom-table" id="tablaProcesos">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($procesos as $proceso): ?>
                    <tr>
                        <td><?php echo $proceso->id; ?></td>
                        <td><?php echo $proceso->nombre; ?></td>
                        <td><?php echo $proceso->descripcion; ?></td>
                        <td>
                            <button onclick="verProceso(<?php echo $proceso->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-preview">
                                <img class="btn-preview img" src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                            </button>
                            <button onclick="editarProceso(<?php echo $proceso->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-warning">
                                <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                            </button>
                            <button onclick="eliminarProceso(<?php echo $proceso->id; ?>)" class="btn-danger">
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
        function editarProceso(id) {

            const formData = new FormData();
            formData.append('id', id);
            fetch('/metro/app/proceso/registro', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'ACTUALIZAR PROCESO';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function agregarProceso() {

            fetch('/metro/app/proceso/registro', {
                method: 'POST'
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'REGISTRAR PROCESO';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function eliminarProceso(id) {
            if (confirm('¿Está seguro de eliminar este proceso?')) {
                fetch(`/metro/app/proceso/eliminar/${id}`, {
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
                            alert('Proceso eliminado exitosamente');
                            location.reload();
                        } else {
                            alert('Error al eliminar proceso');
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

                fetch('/metro/app/proceso/crear', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = '/metro/app/proceso';
                        } else {
                            console.error(data);
                            alert('Error al registrar proceso: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud');
                    });
            });
        }
        var tablaProcesos = document.getElementById('tablaProcesos');
        var dataTable = new DataTable(tablaProcesos, {
            perPage: 2,
            paging: true,
            perPageSelect: false,
            sortable: false,
        });
    </script>
</body>

</html>