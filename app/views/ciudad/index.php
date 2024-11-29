<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Ciudades</title>
</head>

<body>
    <div class="container">
        <h2>Lista de Ciudades</h2>
        <button onclick="agregarCiudad()" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn btn-primary">Nueva Ciudad</button>
        <!-- <a href="/metro/app/ciudad/registro" class="btn btn-primary">Nuevo Ciudad</a> -->

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Pais</th>
                    <th>Codigo Postal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ciudades as $ciudad): ?>
                    <tr>
                        <td><?php echo $ciudad->id; ?></td>
                        <td><?php echo $ciudad->nombre; ?></td>
                        <td><?php echo $ciudad->nombre_pais; ?></td>
                        <td><?php echo $ciudad->codigo_postal; ?></td>
                        <td>
                            <button onclick="editarCiudad(<?php echo $ciudad->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn btn-warning">Editar</button>
                            <button onclick="eliminarCiudad(<?php echo $ciudad->id; ?>)" class="btn btn-danger">Eliminar</button>
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
        function editarCiudad(id) {

            const formData = new FormData();
            formData.append('id', id);
            fetch('/metro/app/ciudad/registro', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'ACTUALIZAR CIUDAD';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function agregarCiudad() {

            fetch('/metro/app/ciudad/registro', {
                method: 'POST'
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'REGISTRAR CIUDAD';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function eliminarCiudad(id) {
            if (confirm('¿Está seguro de eliminar este ciudad?')) {
                fetch(`/metro/app/ciudad/eliminar/${id}`, {
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
                            alert('Ciudad eliminado exitosamente');
                            location.reload();
                        } else {
                            alert('Error al eliminar ciudad');
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

                fetch('/metro/app/ciudad/crear', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = '/metro/app/ciudad';
                        } else {
                            console.error(data);
                            alert('Error al registrar ciudad: ' + data.message);
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