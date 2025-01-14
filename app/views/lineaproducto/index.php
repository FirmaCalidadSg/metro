<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lineas Y Productos registradas</title>
    <link rel="stylesheet" href="../../app/Assets/css/global.css">
    <link rel="stylesheet" href="../../app/Assets/css/style.css">
    <link rel="stylesheet" href="../../app/Assets/css/styleguide.css">
</head>

<body>
    <div class="lineas-productos">
        <button class="btn-back" onclick="goBack()">
            <div class="btn-back-text">
                < Volver</div>
        </button>
        <div class="lineas-productos-header">
            <div class="btn-space">
                <h2>Linea y Productos registrados</h2>
                <button onclick="agregarLineaProducto()" class="btn-div">
                    <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                    <div class="text-style">Agregar</div>
                </button>
                <div class="space-input">
                    <select class="selector-table" id="linea-selector">
                        <option value="" disabled selected>Filtrar por linea</option>
                        <?php foreach ($lineas_producto as $lineaproducto): ?>
                            <option value="<?php echo $lineaproducto->id; ?>"><?php echo $lineaproducto->nombre_linea; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
                <div class="space-input">
                    <select class="selector-table" id="producto-selector">
                        <option value="" disabled selected>Filtrar por producto</option>
                        <?php foreach ($lineas_producto as $lineaproducto): ?>
                            <option value="<?php echo $lineaproducto->nombre_producto; ?>"><?php echo $lineaproducto->nombre_producto; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
            </div>
            <table class="custom-table" id="tablaLineasProductos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Linea</th>
                        <th>Producto</th>
                        <th>Capacidad de Produccion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lineas_producto as $lineaproducto): ?>
                        <tr>
                            <td><?php echo $lineaproducto->id; ?></td>
                            <td><?php echo $lineaproducto->nombre_linea; ?></td>
                            <td><?php echo $lineaproducto->nombre_producto; ?></td>
                            <td><?php echo $lineaproducto->capacidad_produccion; ?></td>
                            <td>
                                <a href="../app/lineaproducto/vistaPrevia/<?php echo $lineaproducto->id; ?>" class="btn-preview">
                                    <img class="btn-preview img" src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                                </a>
                                <a href="../app/lineaproducto/editarFormulario/<?php echo $lineaproducto->id; ?>" class="btn-warning">
                                    <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                                </a>
                                <button onclick="eliminarLineaProducto(<?php echo $lineaproducto->id; ?>)" class="btn-danger">
                                    <img class="btn-danger img" src="/metro/app/Assets/css/images/delete.svg" title="Eliminar">
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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

        <script>
            document.getElementById('linea-selector').addEventListener('change', function() {
                filtrarTabla();
            });

            document.getElementById('producto-selector').addEventListener('change', function() {
                filtrarTabla();
            });

            function filtrarTabla() {
                var lineaSeleccionada = document.getElementById('linea-selector').value;
                var productoSeleccionado = document.getElementById('producto-selector').value;

                var filas = document.querySelectorAll('#tablaLineasProductos tbody tr');

                filas.forEach(function(fila) {
                    var lineaId = fila.cells[0].textContent.trim();
                    var producto = fila.cells[2].textContent.trim();

                    if ((lineaSeleccionada === "" || lineaId == lineaSeleccionada) &&
                        (productoSeleccionado === "" || producto == productoSeleccionado)) {
                        fila.style.display = "";
                    } else {
                        fila.style.display = "none";
                    }
                });
            }

            function goBack() {
                window.history.back();
            }

            function editarLineaProducto(id) {

                const formData = new FormData();
                formData.append('id', id);
                fetch('/metro/app/lineaproducto/registro', {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.text();
                }).then(data => {
                    document.getElementById('modal-title').innerHTML = 'ACTUALIZAR LINEA Y PRODUCTO';
                    document.getElementById('modal-body-content').innerHTML = data;
                    addSubmitForm();
                }).catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });

            }

            function agregarLineaProducto() {
                window.location.href = '/metro/app/lineaproducto/registro';

                /*                     fetch('/metro/app/lineaproducto/registro', {
                                        method: 'POST'
                                    }).then(response => {
                                        if (!response.ok) {
                                            throw new Error('Error en la respuesta del servidor');
                                        }
                                        return response.text();
                                    }).then(data => {
                                        document.getElementById('modal-title').innerHTML = 'REGISTRAR LINEA Y PRODUCTO';
                                        document.getElementById('modal-body-content').innerHTML = data;
                                        addSubmitForm();
                                    }).catch(error => {
                                        console.error('Error:', error);
                                        alert('Error al procesar la solicitud');
                                    }); */

            }

            function eliminarLineaProducto(id) {
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
                        fetch(`/metro/app/lineaproducto/eliminar/${id}`, {
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
                                        text: 'La línea y el producto se eliminaron exitosamente.',
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
                                        text: 'Hubo un problema al eliminar la línea y el producto.',
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

                    fetch('/metro/app/lineaproducto/crear', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                window.location.href = '/metro/app/lineaproducto';
                            } else {
                                console.error(data);
                                alert('Error al registrar linea y producto: ' + data.message);
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