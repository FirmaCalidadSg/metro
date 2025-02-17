<div class="container">
    <div class="">
        <!--  <button class="btn-back" onclick="goBack()">
            <div class="btn-back-text">
                < Volver</div>
        </button> -->
        <div class="card">
            <div class="card-header">
                <h2>Lista de Ciudades</h2>
                <button onclick="agregarCiudad()" class="btn-div">
                    <img class="image-list" src="../app/Assets/css/images/circle-fill.svg">
                    <div class="text-style">Agregar</div>
                </button>
            </div>
            <div class="card-body">
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
                                <!-- <a href="/metro/app/ciudad/vistaPrevia/<?php echo $ciudad->id; ?>" class="btn-preview ">
                                    <img class="btn-preview img" src="../app/Assets/css/images/preview.svg" title="Ver">
                                </a> -->
                                <a href="/metro/app/ciudad/editarFormulario/<?php echo $ciudad->id; ?>" class="">
                                    <img class="" src="../app/Assets/css/images/edit.svg" title="Editar">
                                </a>
                                <a onclick="eliminarCiudad(<?php echo $ciudad->id; ?>)" class=""><img src="../app/Assets/css/images/delete.svg" title="Eliminar"></a>
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
    function goBack() {
        window.history.back();
    }

    function agregarCiudad() {
        window.location.href = '/metro/app/ciudad/registro';
    }

    function eliminarCiudad(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0b7c3e',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, eliminar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/metro/app/ciudad/eliminar/${id}`, {
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
                            Swal.fire('¡Eliminado!', data.message, 'success').then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', data.error, 'error');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error', 'Ocurrió un error al procesar la solicitud.', 'error');
                    });
            }
        });
    }
</script>