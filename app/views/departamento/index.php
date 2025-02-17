<div class="container">
    <div class="">
        <div class="card">
            <div class="card-header">
                <h2>Lista de Departamentos</h2>
                <button onclick="agregarDepartamento()" class="btn-departamentos">
                    <img class="image-list" src="../app/Assets/css/images/circle-fill.svg">
                    <div class="text-style">Agregar</div>
                </button>

            </div>
            <div class="card-body">
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
                                    <!-- <a href="../app/departamento/vistaPrevia/<?php echo $departamento->id; ?>" class=" ">
                                        <img class="" src="../app/Assets/css/images/preview.svg" title="Ver">
                                    </a> -->
                                    <a href="../app/departamento/editarFormulario/<?php echo $departamento->id; ?>" class="">
                                        <img class="" src="../app/Assets/css/images/edit.svg" title="Editar">
                                    </a>
                                    <a onclick="eliminarDepartamento(<?php echo $departamento->id; ?>)" class="">
                                        <img class="" src="../app/Assets/css/images/delete.svg" title="Eliminar">
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
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
                var pais = fila.cells[2].textContent.trim(); // Columna "Pais"

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
                fetch(`/metro/app/departamento/eliminar/${id}`, {
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
                                text: data.message,
                                icon: 'success',
                                customClass: {
                                    popup: 'mi-clase-modal',
                                    title: 'mi-titulo-modal',
                                    content: 'mi-contenido-modal',
                                    icon: 'mi-icono-modal'
                                }
                            }).then(() => {
                                location.reload(); // Recargar la página después de eliminar
                            });
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: data.error,
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