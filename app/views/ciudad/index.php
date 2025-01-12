<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Ciudades</title>
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
                <h2>Lista de Ciudades</h2>
                <button onclick="agregarCiudad()"class="btn-div">
                    <img class="image-list" src="../app/Assets/css/images/circle-fill.svg">
                    <div class="text-style">Agregar</div>
                </button>
                <div class="space-input">
                    <select class="selector-table" id="ciudad-selector">
                        <option value="" disabled selected>Filtrar por ciudad</option>
                        <?php foreach ($ciudades as $ciudad): ?>
                            <option value="<?php echo $ciudad->id; ?>"><?php echo $ciudad->nombre; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
                <div class="space-input">
                    <select class="selector-table" id="departamento-selector">
                        <option value="" disabled selected>Filtrar por departamento</option>
                        <?php foreach ($ciudades as $ciudad): ?>
                            <option value="<?php echo $ciudad->nombre_departamento; ?>"><?php echo $ciudad->nombre_departamento; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <img class="underline-btn" src="../app/Assets/css/images/underline.svg">
                </div>
            </div>
            <table class="custom-table" id="tablaCiudad">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ciudad</th>
                        <th>Departamento</th>
                        <th>Codigo Postal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ciudades as $ciudad): ?>
                        <tr id="fila-<?php echo $ciudad->id; ?>">
                            <td><?php echo $ciudad->id; ?></td>
                            <td><?php echo $ciudad->nombre; ?></td>
                            <td><?php echo $ciudad->nombre_departamento; ?></td>
                            <td><?php echo $ciudad->codigo_postal; ?></td>
                            <td>
                                <a href="/metro/app/ciudad/vistaPrevia/<?php echo $ciudad->id; ?>" class="btn-preview ">
                                    <img class="btn-preview img" src="../app/Assets/css/images/preview.svg" title="Ver">
                                </a>
                                <a href="/metro/app/ciudad/editarFormulario/<?php echo $ciudad->id; ?>" class="btn-warning">
                                    <img class="btn-warning img" src="../app/Assets/css/images/edit.svg" title="Editar">
                                </a>
                                <button onclick="eliminarCiudad(<?php echo $ciudad->id; ?>)" class="btn-danger"><img src="../app/Assets/css/images/delete.svg" title="Eliminar"></button>
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
    </div>

    <script>
        document.getElementById('ciudad-selector').addEventListener('change', function() {
            filtrarTabla();
        });

        document.getElementById('departamento-selector').addEventListener('change', function() {
            filtrarTabla();
        });

        function filtrarTabla() {
            var ciudadSeleccionada = document.getElementById('ciudad-selector').value;
            var departamentoSeleccionado = document.getElementById('departamento-selector').value;

            var filas = document.querySelectorAll('#tablaCiudad tbody tr');

            filas.forEach(function(fila) {
                var ciudadId = fila.cells[0].textContent.trim(); // Columna "ID" (usada para comparar)
                var departamento = fila.cells[2].textContent.trim(); // Columna "Departamento"

                // Filtrar por ciudad ID o departamento, si corresponde
                if ((ciudadSeleccionada === "" || ciudadId == ciudadSeleccionada) &&
                    (departamentoSeleccionado === "" || departamento == departamentoSeleccionado)) {
                    fila.style.display = "";
                } else {
                    fila.style.display = "none";
                }
            });
        }

        function goBack() {
            window.history.back();
        }

        function editarCiudad(id) {

            const formData = new FormData();
            formData.append('id', id);
            fetch('/metro/app/ciudad/registro', {
                method: 'POST',
                body: formData
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'ACTUALIZAR CIUDAD';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });

        }

        function agregarCiudad() {
            window.location.href = '/metro/app/ciudad/registro';
/*             fetch('/metro/app/ciudad/registro', {
                method: 'POST'
            }).then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.text();
            }).then(data => {
                document.getElementById('modal-title').innerHTML = 'REGISTRAR CIUDAD';
                document.getElementById('modal-body-content').innerHTML = data;
                addSubmitForm();
            }).catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });
 */
        }

        function eliminarCiudad(id) {
            if (confirm('¿Está seguro de eliminar este ciudad?')) {
                fetch(`/metro/app/ciudad/eliminar/${id}`, {
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
                            alert('Ciudad eliminado exitosamente');
                            location.reload();
                        } else {
                            alert('Error al eliminar ciudad');
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

                fetch('/metro/app/ciudad/crear', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.href = '/metro/app/ciudad';
                        } else {
                            console.error(data);
                            alert('Error al registrar ciudad: ' + data.message);
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