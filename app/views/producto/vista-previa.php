<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../../Assets/css/globals.css" />
    <link rel="stylesheet" href="../../Assets/css/styleguide.css" />
    <link rel="stylesheet" href="../../Assets/css/style.css" />
    <title>Vista Previa</title>
</head>

<body>
    <div class="registroConfig">
        <div class="btn-back">
            <a href="/metro/app/producto">
                <div class="text-wrapper-6"> < Volver</div>
            </a>
        </div>
        <div class="info">
            <div class="frame">
                <div class="text">
                    <div class="text-wrapper">Vista Previa del Producto</div>
                </div>
                <div class="div">
                    <div class="frame-2">
                        <div class="text-wrapper-2">Creado por</div>
                        <div class="div-wrapper">
                            <div class="text-wrapper-3">Sebastian Diaz</div>
                        </div>
                    </div>
                    <div class="frame-2">
                        <div class="text-wrapper-2">Fecha registro</div>
                        <div class="frame-3">
                            <div class="img-calendar">
                                <img src="../../Assets/css/images/calender.svg" />
                            </div>
                            <div class="text-wrapper-3">
                                <?php
                                $fecha = date('d/m/Y');
                                echo $fecha;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario solo de vista previa (sin enviar datos) -->
            <form method="POST" class="form-register">
                <div class="drops-downs">
                    <div class="element">
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-5">Nombre</div>
                                <div class="div-2">
                                    <input type="text" class="select-register" value="<?php echo $producto->nombre ?? ''; ?>" readonly>
                                </div>
                                <img class="underline" src="../../Assets/css/images/underline.svg" />
                            </div>
                        </div>
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-5">Codigo</div>
                                <div class="div-2">
                                    <input type="text" class="select-register" value="<?php echo $producto->codigo ?? ''; ?>" readonly>
                                </div>
                                <img class="underline" src="../../Assets/css/images/underline.svg" />
                            </div>
                        </div>
                    </div>
                    <div class="element">
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-5">Descripción</div>
                                <div class="div-2">
                                    <input type="text" class="select-register" value="<?php echo $producto->descripcion ?? ''; ?>" readonly>
                                </div>
                                <img class="underline" src="../../Assets/css/images/underline.svg" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-container">
                    <button type="button" class="btn-editar" onclick="editarProducto()">Editar</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    function editarProducto() {
        window.location.href = '../../producto/editarFormulario/<?php echo $producto->id; ?>';
    }

    function eliminarProducto(id) {
        if (confirm('¿Está seguro de eliminar este producto?')) {
            fetch(`../../producto/eliminar/${id}`, {
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
</script>

</html>
