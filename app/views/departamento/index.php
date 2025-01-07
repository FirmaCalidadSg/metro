<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Departamentos</title>
</head>

<body>
    <div class="departamento">
        <div class="departamento-header">
            <h2>Lista de Departamentos</h2>
            <button onclick="agregarDepartamento()" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-div">
                <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                <div class="text-style">Agregar</div>
            </button>

        <div class="table-container">
        <table class="custom-table" id="tablaDepartamento">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Pais</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departamentos as $departamento): ?>
                    <tr>
                        <td><?php echo $departamento->id; ?></td>
                        <td><?php echo $departamento->nombre; ?></td>
                        <td><?php echo $departamento->nombre_pais; ?></td>
                        <td>
                            <button onclick="verDepartamento(<?php echo $departamento->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-preview ">
                                <img class="btn-preview img" src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                            </button>
                            <button onclick="editarDepartamento(<?php echo $departamento->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-warning">
                                <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                            </button>
                            <button onclick="eliminarDepartamento(<?php echo $departamento->id; ?>)" class="btn-danger">
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
        function editarDepartamento(id) {

            const formData = new FormData();
            formData.append('id', id);
            fetch('/metro/app/departamento/registro', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'ACTUALIZAR DEPARTAMENTO';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function agregarDepartamento() {

            fetch('/metro/app/departamento/registro', {
                method: 'POST'
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'REGISTRAR DEPARTAMENTO';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function eliminarDepartamento(id) {
            if (confirm('¿Está seguro de eliminar este departamento?')) {
                fetch(`/metro/app/departamento/eliminar/${id}`, {
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
                            alert('Departamento eliminado exitosamente');
                            location.reload();
                        } else {
                            alert('Error al eliminar departamento');
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

                fetch('/metro/app/departamento/crear', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = '/metro/app/departamento';
                        } else {
                            console.error(data);
                            alert('Error al registrar departamento: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud');
                    });
            });
        }
        var tablaDepartamento = document.getElementById('tablaDepartamento');
        var tablaDepartamento = new DataTable(tablaDepartamento,{
            perPage: 5,
            searchable: true,
            info: true,
            lengthChange: false,
            ordering: true,
            paging: true,
            pageLength: 5,
            perPageSelect: false,
        });
    </script>
</body>

</html>