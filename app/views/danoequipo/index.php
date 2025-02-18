<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h5>Lista de Daños en Equipos</h5>
                </div>
                <div class="col-sm-6 text-end">
                    <button onclick="agregarDano()" class="btn-div">
                        <img class="image-list" src="../app/Assets/css/images/circle-fill.svg">
                        <div class="text-style">Agregar</div>
                    </button>
                </div>


            </div>
        </div>
        <div class="card-body">

            <table class="custom-table" id="tablaDano">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Equipo</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($danos as $dano): ?>
                        <tr>
                            <td><?php echo $dano->id; ?></td>
                            <td><?php echo $dano->nombre_equipo; ?></td>
                            <td><?php echo $dano->descripcion; ?></td>
                            <td><?php echo $dano->fecha; ?></td>
                            <td><?php echo $dano->estado; ?></td>
                            <td>

                                <a href="../app/danoequipo/editarFormulario/<?php echo $dano->id; ?>" class="btn-editar">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button onclick="eliminarDano(<?php echo $dano->id; ?>)" class="btn-eliminar">
                                    <i class="fa fa-trash"></i>

                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
    document.getElementById('equipo-selector').addEventListener('change', function() {
        filtrarTabla();
    });

    document.getElementById('estado-selector').addEventListener('change', function() {
        filtrarTabla();
    });

    function filtrarTabla() {
        var equipoSeleccionado = document.getElementById('equipo-selector').value;
        var estadoSeleccionado = document.getElementById('estado-selector').value;

        var filas = document.querySelectorAll('#tablaDano tbody tr');

        filas.forEach(function(fila) {
            var equipoId = fila.cells[0].textContent.trim();
            var estado = fila.cells[4].textContent.trim();

            if ((equipoSeleccionado === "" || equipoId == equipoSeleccionado) &&
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

    function editarDano(id) {

        const formData = new FormData();
        formData.append('id', id);
        fetch('/metro/app/danoequipo/registro', {
            method: 'POST',
            body: formData
        }).then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.text();
        }).then(data => {
            document.getElementById('modal-title').innerHTML = 'ACTUALIZAR DAÑO';
            document.getElementById('modal-body-content').innerHTML = data;
            addSubmitForm();
        }).catch(error => {
            console.error('Error:', error);
            alert('Error al procesar la solicitud');
        });

    }

    function agregarDano() {
        window.location.href = '/metro/app/danoequipo/registro';

        /*                 fetch('/metro/app/danoequipo/registro', {
                            method: 'POST'
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta del servidor');
                            }
                            return response.text();
                        }).then(data => {
                            document.getElementById('modal-title').innerHTML = 'REGISTRAR DAÑO';
                            document.getElementById('modal-body-content').innerHTML = data;
                            addSubmitForm();
                        }).catch(error => {
                            console.error('Error:', error);
                            alert('Error al procesar la solicitud');
                        }); */

    }

    function eliminarDano(id) {
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
                fetch(`/metro/app/danoequipo/eliminar/${id}`, {
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
                                text: 'El daño se eliminó exitosamente.',
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
                                text: 'Hubo un problema al eliminar el daño.',
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

            fetch('/metro/app/danoequipo/crear', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = '/metro/app/danoequipo';
                    } else {
                        console.error(data);
                        alert('Error al registrar dano: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud');
                });
        });
    }
</script>