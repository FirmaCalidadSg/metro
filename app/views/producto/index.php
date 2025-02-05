<div class="container mt-5">
    <!-- Formulario de selección -->
    <div class="card border-0 mb-3">
        <h5 class="card-header">Registro Productos</h5>
        <button type="button"  class="btn btn-primary col-3" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="Cargar('registro','productos')">
            Registrar producto
        </button>
        <div class="card-body">
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
    </div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="index">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<script>
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