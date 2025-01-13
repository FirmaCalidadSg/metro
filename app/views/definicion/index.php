<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Definiciones</title>
    <link rel="stylesheet" href="../app/Assets/css/globals.css" />
    <link rel="stylesheet" href="../app/Assets/css/styleguide.css" />
    <link rel="stylesheet" href="../app/Assets/css/style.css" />
</head>

<body>
    <div class="ciudad">
        <button class="btn-back" onclick="goBack()">
            <div class="btn-back-text">
                < Volver</div>
        </button>
        <div class="ciudad-header">
            <div class="btn-space">
                <h2>Lista de Definiciones</h2>
                <button onclick="agregarDefinicion()" class="btn-div">
                    <img class="image-list" src="../app/Assets/css/images/circle-fill.svg">
                    <div class="text-style">Agregar</div>
                </button>
                <div class="space-input">
                    <select class="selector-table" id="definicion-selector">
                        <option value="" disabled selected>Filtrar por definicion</option>
                        <?php foreach ($definicion as $value): ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
                <div class="space-input">
                    <select class="selector-table" id="valor-selector">
                        <option value="" disabled selected>Filtrar por valor</option>
                        <?php foreach ($definicion as $value): ?>
                            <option value="<?php echo $value->valor; ?>"><?php echo $value->valor; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
            </div>
            <table class="custom-table" id="tablaDefinicion">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Valor</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($definicion as $value): ?>
                        <tr id="fila-<?php echo $value->id; ?>">
                            <td><?php echo $value->id; ?></td>
                            <td><?php echo $value->valor; ?></td>
                            <td><?php echo $value->nombre; ?></td>
                            <td><?php echo $value->descripcion; ?></td>
                            <td>
                                <a href="../app/definicion/vistaPrevia/<?php echo $value->id; ?>" class="btn-preview ">
                                    <img class="btn-preview img" src="../app/Assets/css/images/preview.svg" title="Ver">
                                </a>
                                <a href="../app/definicion/editarFormulario/<?php echo $value->id; ?>" class="btn-warning">
                                    <img class="btn-warning img" src="../app/Assets/css/images/edit.svg" title="Editar">
                                </a>
                                <button onclick="eliminarDefinicion(<?php echo $value->id; ?>)" class="btn-danger"><img src="../app/Assets/css/images/delete.svg" title="Eliminar"></button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Escuchar cambios en los selects
            document.getElementById('definicion-selector').addEventListener('change', filtrarTabla);
            document.getElementById('valor-selector').addEventListener('change', filtrarTabla);

            // Función para filtrar la tabla
            function filtrarTabla() {
                var valorSeleccionado = document.getElementById('valor-selector').value;
                var definicionSeleccionado = document.getElementById('definicion-selector').value;

                // Obtener todas las filas de la tabla
                var filas = document.querySelectorAll('#tablaDefinicion tbody tr');

                filas.forEach(function(fila) {
                    var valor = fila.cells[1].textContent.trim(); // Columna "Valor"
                    var nombre = fila.cells[2].textContent.trim(); // Columna "Nombre"

                    // Filtrar por departamento y país, si están seleccionados
                    if ((definicionSeleccionado === "" || definicion == definicionSeleccionado) &&
                        (valorSeleccionado === "" || valor == valorSeleccionado)) {
                        fila.style.display = "";
                    } else {
                        fila.style.display = "none";
                    }
                });
            }
        });


        function goBack() {
            window.history.back();
        }

        function agregarDefinicion() {
            window.location.href = '../app/definicion/registro';
        }

        function enviarId(id) {
            const formData = new FormData();
            formData.append('id', id);

            fetch('/metro/app/definicion/crear', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    // La redirección ya se maneja en el controlador, no es necesario hacer nada más aquí
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });
        }


        function eliminarDefinicion(id) {
            if (confirm('¿Está seguro de eliminar esta definicion?')) {
                fetch(`/metro/app/definicion/eliminar/${id}`, {
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
                            alert('Definicion eliminada exitosamente');
                            location.reload();
                        } else {
                            alert('Error al eliminar definicion');
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

                fetch('/metro/app/definicion/crear', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = '/metro/app/definicion';
                        } else {
                            console.error(data);
                            alert('Error al registrar definicion: ' + data.message);
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