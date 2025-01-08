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
                <h2>Lineas Y Productos registradas</h2>
                <button onclick="agregarLineaProducto()" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-div">
                    <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                    <div class="text-style">Agregar</div>
                </button>
                <select class="selector-table">
                    <option value="" disabled selected>Filtrar por proceso</option>
                    <?php foreach ($procesos as $proceso): ?>
                        <option value="<?php echo $proceso->id; ?>"><?php echo $proceso->nombre; ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="selector-table">
                    <option value="" disabled selected>Filtrar por linea</option>
                    <?php foreach ($lineas as $linea): ?>
                        <option value="<?php echo $lineaproducto->id; ?>"><?php echo $lineaproducto->nombre; ?></option>
                    <?php endforeach; ?>
                </select>
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
                                <button onclick="verLineaProducto(<?php echo $lineaproducto->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-preview">
                                    <img class="btn-preview img" src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                                </button>
                                <button onclick="editarLineaProducto(<?php echo $lineaproducto->id; ?>)" data-bs-toggle="modal" data-bs-target="#modal-id" class="btn-warning">
                                    <img class="btn-warning img" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                                </button>
                                <button onclick="eliminarLineaProducto(<?php echo $lineaproducto->id; ?>)" class="btn-danger">
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

            <script>
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

                    fetch('/metro/app/lineaproducto/registro', {
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
                    });

                }

                function eliminarLineaProducto(id) {
                    if (confirm('¿Está seguro de eliminar esta linea y producto?')) {
                        fetch(`/metro/app/lineaproducto/eliminar/${id}`, {
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
                                    alert('LineaProducto eliminado exitosamente');
                                    location.reload();
                                } else {
                                    alert('Error al eliminar linea y producto');
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