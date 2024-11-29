<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Paises</title>
</head>

<body>
    <div class="container">
        <h2>Lista de Paises</h2>
        <button onclick="agregarPais()" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn btn-primary">Nueva Pais</button>
        <!-- <a href="/metro/app/pais/registro" class="btn btn-primary">Nuevo Pais</a> -->

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Codigo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($paises as $pais): ?>
                    <tr>
                        <td><?php echo $pais->id; ?></td>
                        <td><?php echo $pais->nombre; ?></td>
                        <td><?php echo $pais->codigo; ?></td>
                        <td>
                            <button onclick="editarPais(<?php echo $pais->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn btn-warning">Editar</button>
                            <button onclick="eliminarPais(<?php echo $pais->id; ?>)" class="btn btn-danger">Eliminar</button>
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
                document.getElementById('modal-title').innerHTML = 'ACTUALIZAR DEFINICION';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function agregarPais() {

            fetch('/metro/app/pais/registro', {
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
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function eliminarPais(id) {
            if (confirm('¿Está seguro de eliminar este pais?')) {
                fetch(`/metro/app/pais/eliminar/${id}`, {
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
                            alert('Pais eliminado exitosamente');
                            location.reload();
                        } else {
                            alert('Error al eliminar pais');
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