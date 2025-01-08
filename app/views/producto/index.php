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
            <button onclick="agregarProducto()" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-div">
                <img class="btn-div img" src="/metro/app/Assets/css/images/circle-fill.svg">
                <div class="text-style">Agregar</div>
            </button>
            <select class="selector-table">
                <option value="" disabled selected>Filtrar por producto</option>
                <?php foreach ($productos as $producto): ?>
                    <option value="<?php echo $producto->id; ?>"><?php echo $producto->nombre; ?></option>
                <?php endforeach; ?>
            </select>
            <select class="selector-table">
                <option value="" disabled selected>Filtrar por codigo</option>
                <?php foreach ($productos as $producto): ?>
                    <option value="<?php echo $producto->id; ?>"><?php echo $producto->codigo; ?></option>
                <?php endforeach; ?>
            </select>
            </div>
            <!-- <a href="/metro/app/producto/registro" class="btn btn-primary">Nuevo Producto</a> -->
            <table class="custom-table" id="tablaProductos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
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
                            <button onclick="verProducto(<?php echo $producto->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-preview">
                                <img class="btn-preview img" src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                            </button>
                            <button onclick="editarProducto(<?php echo $producto->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-warning">   
                                <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                            </button>
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

            fetch('/metro/app/producto/registro', {
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
            });

        }

        function eliminarProducto(id) {
            if (confirm('¿Está seguro de eliminar este producto?')) {
                fetch(`/metro/app/producto/eliminar/${id}`, {
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
                            alert('Producto eliminado exitosamente');
                            location.reload();
                        } else {
                            alert('Error al eliminar producto');
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