<div class="container">
    <div class="card">

        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h5>Lista de Equipos</h5>
                </div>
                <div class="col-sm-6 text-end">
                    <button onclick="agregarEquipo()" class="btn-div">
                        <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                        <div class="text-style">Agregar</div>
                    </button>
                </div>




            </div>
        </div>

        <div class="card-body">
            <table class="custom-table" id="tablaEquipos">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Modelo</th>
                        <th>Estado</th>
                        <th>Daño</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($equipos as $equipo): ?>
                        <tr>
                            <td><?php echo $equipo->id; ?></td>
                            <td><?php echo $equipo->nombre; ?></td>
                            <td><?php echo $equipo->modelo; ?></td>
                            <td><?php echo $equipo->estado; ?></td>
                            <td>valor</td>
                            <td>
                               <!--  <a href="../app/equipo/vistaPrevia/<?php echo $equipo->id; ?>" class="btn-preview">
                                    <img class="btn-preview img" src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                                </a> -->
                                <a href="../app/equipo/editarFormulario/<?php echo $equipo->id; ?>" class="">
                                    <img class="" src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                                </a>
                                <a onclick="eliminarEquipo(<?php echo $equipo->id; ?>)" class="">
                                    <img class="" src="/metro/app/Assets/css/images/delete.svg" title="Eliminar">
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
    document.getElementById('modelo-selector').addEventListener('change', function() {
        filtrarTabla();
    });

    document.getElementById('estado-selector').addEventListener('change', function() {
        filtrarTabla();
    });

    function filtrarTabla() {
        var modeloSeleccionado = document.getElementById('modelo-selector').value;
        var estadoSeleccionado = document.getElementById('estado-selector').value;

        var filas = document.querySelectorAll('#tablaEquipos tbody tr');

        filas.forEach(function(fila) {
            var id = fila.cells[0].textContent.trim();
            var modelo = fila.cells[2].textContent.trim();
            var estado = fila.cells[3].textContent.trim();

            if ((modeloSeleccionado === "" || modelo == modeloSeleccionado) &&
                (estadoSeleccionado === "" || estado == estadoSeleccionado)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    }


    function goBack() {
        window.history.back();
    }

    function editarEquipo(id) {

        const formData = new FormData();
        formData.append('id', id);
        fetch('/metro/app/equipo/registro', {
            method: 'POST',
            body: formData
        }).then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.text();
        }).then(data => {
            document.getElementById('modal-title').innerHTML = 'ACTUALIZAR EQUIPO';
            document.getElementById('modal-body-content').innerHTML = data;
            addSubmitForm();
        }).catch(error => {
            console.error('Error:', error);
            alert('Error al procesar la solicitud');
        });

    }

    function agregarEquipo() {

        window.location.href = '/metro/app/equipo/registro';
        /*             fetch('/metro/app/equipo/registro', {
                        method: 'POST'
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta del servidor');
                        }
                        return response.text();
                    }).then(data => {
                        document.getElementById('modal-title').innerHTML = 'REGISTRAR EQUIPO';
                        document.getElementById('modal-body-content').innerHTML = data;
                        addSubmitForm();
                    }).catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud');
                    }); */

    }

    function eliminarEquipo(id) {
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
                fetch(`/metro/app/equipo/eliminar/${id}`, {
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
                                text: 'El equipo se eliminó exitosamente.',
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
                                text: 'Hubo un problema al eliminar el equipo.',
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

            fetch('/metro/app/equipo/crear', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = '/metro/app/equipo';
                    } else {
                        console.error(data);
                        alert('Error al registrar equipo: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });
        });
    }
</script>