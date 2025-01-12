<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Procesos</title>
</head>

<body>
    <div class="procesos">
        <button class="btn-back" onclick="goBack()">
            <div class="btn-back-text">
                < Volver</div>
        </button>
        <div class="procesos-header">
            <div class="btn-space">
                <h2>Lista de Procesos</h2>
                <button onclick="agregarProceso()" class="btn-div">
                    <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg" title="Agregar">
                    <div class="text-style">Agregar</div>
                </button>
                <div class="space-input">
                    <select class="selector-table" id="proceso-selector">
                        <option value="" disabled selected>Filtrar por proceso</option>
                        <?php foreach ($procesos as $proceso): ?>
                            <option value="<?php echo $proceso->id; ?>"><?php echo $proceso->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
                <div class="space-input">
                    <select class="selector-table" id="linea-selector">
                        <option value="" disabled selected>Filtrar por linea</option>
                        <?php foreach ($lineas as $linea): ?>
                            <option value="<?php echo $linea->id; ?>"><?php echo $linea->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
            </div>
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
                                <a href="../app/proceso/vistaPrevia/<?php echo $proceso->id; ?>" class="btn-preview">
                                    <img class="btn-preview img" src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                                </a>
                                <a href="/metro/app/proceso/editarFormulario/<?php echo $proceso->id; ?>" class="btn-warning">
                                    <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                                </a>
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
            document.getElementById('proceso-selector').addEventListener('change', function() {
                filtrarTabla();
            });

            document.getElementById('linea-selector').addEventListener('change', function() {
                filtrarTabla();
            });

            function filtrarTabla() {
                var procesoSeleccionado = document.getElementById('proceso-selector').value;
                var lineaSeleccionada = document.getElementById('linea-selector').value;

                var filas = document.querySelectorAll('#tablaProcesos tbody tr');

            filas.forEach(function(fila) {
                var procesoId = fila.cells[0].textContent.trim();
                var linea = fila.cells[2].textContent.trim();
                var descripcion = fila.cells[3].textContent.trim();

                if ((procesoSeleccionado === "" || procesoId == procesoSeleccionado) &&
                    (lineaSeleccionada === "" || linea == lineaSeleccionada)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        }
            function goBack() {
                window.history.back();
            }

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
                window.location.href = '/metro/app/proceso/registro';

/*                 fetch('/metro/app/proceso/registro', {
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
                }); */

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
        </script>
</body>

</html>