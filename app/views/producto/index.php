<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
</head>

<body>
    <div class="productos">
        <button class="btn-back" onclick="goBack()">
            <div class="btn-back-text">
                < Volver</div>
        </button>
        <div class="productos-header">
            <div class="btn-space">
                <h2>Lista de Productos</h2>
                <button onclick="agregarProducto()" class="btn-div">
                    <img class="btn-div img" src="/metro/app/Assets/css/images/circle-fill.svg">
                    <div class="text-style">Agregar</div>
                </button>
                <div class="space-input">
                    <select class="selector-table" id="producto-selector">
                        <option value="" disabled selected>Filtrar por producto</option>
                        <?php foreach ($productos as $producto): ?>
                            <option value="<?php echo $producto->id; ?>"><?php echo $producto->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
                <div class="space-input">
                    <select class="selector-table" id="codigo-selector">
                        <option value="" disabled selected>Filtrar por codigo</option>
                        <?php foreach ($productos as $producto): ?>
                            <option value="<?php echo $producto->codigo; ?>"><?php echo $producto->codigo; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
            </div>
            <table class="custom-table" id="tablaProductos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto->id; ?></td>
                            <td><?php echo $producto->nombre; ?></td>
                            <td><?php echo $producto->codigo; ?></td>
                            <td><?php echo $producto->descripcion; ?></td>
                            <td>
                                <a href="../app/producto/vistaPrevia/<?php echo $producto->id; ?>" class="btn-preview">
                                    <img class="btn-preview img" src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                                </a>
                                <a href="../app/producto/editarFormulario/<?php echo $producto->id; ?>" class="btn-warning">
                                    <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                                </a>
                                <button onclick="eliminarProducto(<?php echo $producto->id; ?>)" class="btn-danger">
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
            document.getElementById('producto-selector').addEventListener('change', function() {
                filtrarTabla();
            });

            document.getElementById('codigo-selector').addEventListener('change', function() {
                filtrarTabla();
            });

            function filtrarTabla() {
                var productoSeleccionado = document.getElementById('producto-selector').value;
                var codigoSeleccionado = document.getElementById('codigo-selector').value;

                var filas = document.querySelectorAll('#tablaProductos tbody tr');

                filas.forEach(function(fila) {
                    var productoId = fila.cells[0].textContent.trim();
                    var codigo = fila.cells[2].textContent.trim();

                    if ((productoSeleccionado === "" || productoId == productoSeleccionado) &&
                        (codigoSeleccionado === "" || codigo == codigoSeleccionado)) {
                        fila.style.display = "";
                    } else {
                        fila.style.display = "none";
                    }
                });
            }

            function goBack() {
                window.history.back();
            }

            function editarProducto(id) {

                const formData = new FormData();
                formData.append('id', id);
                fetch('/metro/app/producto/registro', {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.text();
                }).then(data => {
                    document.getElementById('modal-title').innerHTML = 'ACTUALIZAR PRODUCTO';
                    document.getElementById('modal-body-content').innerHTML = data;
                    addSubmitForm();
                }).catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });

            }

            function agregarProducto() {
                window.location.href = '/metro/app/producto/registro';
                /*                 fetch('/metro/app/producto/registro', {
                                    method: 'POST'
                                }).then(response => {
                                    if (!response.ok) {
                                        throw new Error('Error en la respuesta del servidor');
                                    }
                                    return response.text();
                                }).then(data => {
                                    document.getElementById('modal-title').innerHTML = 'REGISTRAR PRODUCTO';
                                    document.getElementById('modal-body-content').innerHTML = data;
                                    addSubmitForm();
                                }).catch(error => {
                                    console.error('Error:', error);
                                    alert('Error al procesar la solicitud');
                                }); */

            }

            function eliminarProducto(id) {
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
                        fetch(`/metro/app/producto/eliminar/${id}`, {
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
                                        text: 'El producto se eliminó exitosamente.',
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
                                        text: 'Hubo un problema al eliminar el producto.',
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

                    fetch('/metro/app/producto/crear', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                window.location.href = '/metro/app/producto';
                            } else {
                                console.error(data);
                                alert('Error al registrar producto: ' + data.message);
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