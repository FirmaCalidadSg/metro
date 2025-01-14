<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Lineas</title>
</head>

<body>
    <div class="lineas">
        <button class="btn-back" onclick="goBack()">
            <div class="btn-back-text">
                < Volver</div>
        </button>
        <div class="lineas-header">
            <div class="btn-space">
                <h2>Lista de Lineas</h2>
                <button onclick="agregarLinea()" class="btn-div">
                    <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                    <div class="text-style">Agregar</div>
                </button>
                <div class="space-input">
                    <select class="selector-table" id="linea-selector">
                        <option value="" disabled selected>Filtrar por linea</option>
                        <?php foreach ($lineas as $linea): ?>
                            <option value="<?php echo $linea->id; ?>"><?php echo $linea->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
                <div class="space-input">
                    <select class="selector-table" id="proceso-selector">
                        <option value="" disabled selected>Filtrar por proceso</option>
                        <?php foreach ($lineas as $linea): ?>
                            <option value="<?php echo $linea->nombre_proceso; ?>"><?php echo $linea->nombre_proceso; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
            </div>
            <table class="custom-table" id="tablaLineas">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Proceso</th>
                        <th>Producto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lineas as $linea): ?>
                        <tr>
                            <td><?php echo $linea->id; ?></td>
                            <td><?php echo $linea->nombre; ?></td>
                            <td><?php echo $linea->nombre_proceso; ?></td>
                            <td> Valor</td>
                            <td>
                                <button onclick="verLinea(<?php echo $linea->id; ?>)" class="btn-preview">
                                    <img class="btn-preview img" src="../app/Assets/css/images/preview.svg" title="Ver">
                                </button>
                                <a href="../app/linea/editarFormulario/<?php echo $linea->id; ?>" class="btn-warning">
                                    <img class="btn-warning img" src="../app/Assets/css/images/edit.svg" title="Editar">
                                </a>
                                <button onclick="eliminarLinea(<?php echo $linea->id; ?>)" class="btn-danger">
                                    <img class="btn-danger img" src="../app/Assets/css/images/delete.svg" title="Eliminar">
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>

        <div class="modal fade" id="modal-id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="false">
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
            document.getElementById('linea-selector').addEventListener('change', function() {
                filtrarTabla();
            });

            document.getElementById('proceso-selector').addEventListener('change', function() {
                filtrarTabla();
            });

            function filtrarTabla() {
                var lineaSeleccionada = document.getElementById('linea-selector').value;
                var procesoSeleccionado = document.getElementById('proceso-selector').value;

                var filas = document.querySelectorAll('#tablaLineas tbody tr');

                filas.forEach(function(fila) {
                    var lineaId = fila.cells[0].textContent.trim(); // Columna "ID" (usada para comparar)
                    var proceso = fila.cells[2].textContent.trim(); // Columna "Proceso"

                    // Filtrar por ciudad ID o departamento, si corresponde
                    if ((lineaSeleccionada === "" || lineaId == lineaSeleccionada) &&
                        (procesoSeleccionado === "" || proceso == procesoSeleccionado)) {
                        fila.style.display = "";
                    } else {
                        fila.style.display = "none";
                    }
                });
            }


            function goBack() {
                window.history.back();
            }

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

            function verLinea(id) {
                window.location.href = '../app/linea/vistaPrevia/<?php echo $linea->id; ?>';
            }

            function agregarLinea() {
                window.location.href = '/metro/app/linea/registro';

                /*                 fetch('/metro/app/linea/registro', {
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
                                }); */

            }

            function eliminarLinea(id) {
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
                        popup: 'mi-clase-modal',
                        title: 'mi-titulo-modal',
                        content: 'mi-contenido-modal',
                        icon: 'mi-icono-modal'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/metro/app/linea/eliminar/${id}`, {
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
                                        text: 'La línea se eliminó exitosamente.',
                                        icon: 'success',
                                        customClass: {
                                            popup: 'mi-clase-modal',
                                            title: 'mi-titulo-modal',
                                            content: 'mi-contenido-modal',
                                            icon: 'mi-icono-modal'
                                        }
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: 'Hubo un problema al eliminar la línea.',
                                        icon: 'error',
                                        customClass: {
                                            popup: 'mi-clase-modal',
                                            title: 'mi-titulo-modal',
                                            content: 'mi-contenido-modal',
                                            icon: 'mi-icono-modal'
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
                                        popup: 'mi-clase-modal',
                                        title: 'mi-titulo-modal',
                                        content: 'mi-contenido-modal',
                                        icon: 'mi-icono-modal'
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
        </script>
</body>

</html>