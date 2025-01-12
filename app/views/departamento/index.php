<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Departamentos</title>
    <link rel="stylesheet" href="../app/Assets/css/style.css">
    <link rel="stylesheet" href="../app/Assets/css/styleguide.css">
    <link rel="stylesheet" href="../app/Assets/css/globals.css">
</head>

<body>
    <div class="departamento">
        <button class="btn-back" onclick="goBack()">
            <div class="btn-back-text">
                < Volver</div>
        </button>
        <div class="departamento-header">
            <div class="btn-space">
                <h2>Lista de Departamentos</h2>
                <button onclick="agregarDepartamento()" class="btn-departamentos">
                    <img class="image-list" src="../app/Assets/css/images/circle-fill.svg">
                    <div class="text-style">Agregar</div>
                </button>
                <div class="space-input">
                    <select class="selector-table" id="departamento-selector">
                        <option value="" disabled selected>Filtrar por departamento</option>
                        <?php foreach ($departamentos as $departamento): ?>
                            <option value="<?php echo $departamento->nombre; ?>"><?php echo $departamento->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
                <div class="space-input">
                    <select class="selector-table" id="pais-selector">
                        <option value="" disabled selected>Filtrar por Pais</option>
                        <?php foreach ($departamentos as $departamento): ?>
                            <option value="<?php echo $departamento->nombre_pais; ?>"><?php echo $departamento->nombre_pais; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
            </div>
            <table class="custom-table" id="tablaDepartamento">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Pais</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($departamentos as $departamento): ?>
                        <tr>
                            <td><?php echo $departamento->id; ?></td>
                            <td><?php echo $departamento->nombre; ?></td>
                            <td><?php echo $departamento->nombre_pais; ?></td>
                            <td>
                                <a href="../app/departamento/vistaPrevia/<?php echo $departamento->id; ?>" class="btn-preview ">
                                    <img class="btn-preview img" src="../app/Assets/css/images/preview.svg" title="Ver">
                                </a>
                                <a href="../app/departamento/editarFormulario/<?php echo $departamento->id; ?>" class="btn-warning">
                                    <img class="btn-warning img" src="../app/Assets/css/images/edit.svg" title="Editar">
                                </a>
                                <button onclick="eliminarDepartamento(<?php echo $departamento->id; ?>)" class="btn-danger">
                                    <img class="btn-danger img" src="../app/Assets/css/images/delete.svg" title="Eliminar">
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
document.addEventListener('DOMContentLoaded', function() {
    // Escuchar cambios en los selects
    document.getElementById('departamento-selector').addEventListener('change', filtrarTabla);
    document.getElementById('pais-selector').addEventListener('change', filtrarTabla);

    // Función para filtrar la tabla
    function filtrarTabla() {
        var departamentoSeleccionado = document.getElementById('departamento-selector').value;
        var paisSeleccionado = document.getElementById('pais-selector').value;

        // Obtener todas las filas de la tabla
        var filas = document.querySelectorAll('#tablaDepartamento tbody tr');

        filas.forEach(function(fila) {
            var departamento = fila.cells[1].textContent.trim(); // Columna "Departamento"
            var pais = fila.cells[2].textContent.trim();         // Columna "Pais"

            // Filtrar por departamento y país, si están seleccionados
            if ((departamentoSeleccionado === "" || departamento == departamentoSeleccionado) &&
                (paisSeleccionado === "" || pais == paisSeleccionado)) {
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

            function editarDepartamento(id) {

                const formData = new FormData();
                formData.append('id', id);
                fetch('/metro/app/departamento/registro', {
                    method: 'POST',
                    body: formData
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.text();
                }).then(data => {
                    document.getElementById('modal-title').innerHTML = 'ACTUALIZAR DEPARTAMENTO';
                    document.getElementById('modal-body-content').innerHTML = data;
                    addSubmitForm();
                }).catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });

            }

            function agregarDepartamento() {
                window.location.href = '/metro/app/departamento/registro';

 /*                fetch('/metro/app/departamento/registro', {
                    method: 'POST'
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.text();
                }).then(data => {
                    document.getElementById('modal-title').innerHTML = 'REGISTRAR DEPARTAMENTO';
                    document.getElementById('modal-body-content').innerHTML = data;
                    addSubmitForm();
                }).catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });
 */
            }

            function eliminarDepartamento(id) {
                if (confirm('¿Está seguro de eliminar este departamento?')) {
                    fetch(`/metro/app/departamento/eliminar/${id}`, {
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
                                alert('Departamento eliminado exitosamente');
                                location.reload();
                            } else {
                                alert('Error al eliminar departamento');
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

                    fetch('/metro/app/departamento/crear', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                window.location.href = '/metro/app/departamento';
                            } else {
                                console.error(data);
                                alert('Error al registrar departamento: ' + data.message);
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