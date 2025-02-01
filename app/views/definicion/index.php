<div class="ciudad">
   <!--  <button class="btn-back" onclick="goBack()">
        <div class="btn-back-text">
            < Volver</div>
    </button> -->
    <div class="ciudad-header">
        <div class="btn-space">
            <h2>Lista de Definiciones</h2>
            <button  data-toggle="modal" href='#modal-id' onclick="Cargar('registro','definicion')" class="btn-div">
                <img class="image-list" src="../app/Assets/css/images/circle-fill.svg">
                <div class="text-style">Agregar</div>
            </button>

        </div>
        <table class="custom-table" id="table">
            <thead>
                <tr>

                    <th>Valor</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($definicion as $value): ?>
                    <tr id="fila-<?php echo $value->id; ?>">

                        <td><?php echo $value->valor; ?></td>
                        <td><?php echo $value->nombre; ?></td>
                        <td><?php echo $value->descripcion; ?></td>
                        <td>
                          <!--   <a href="../app/definicion/vistaPrevia/<?php echo $value->id; ?>" class="btn-preview ">
                                <img class="btn-preview img" src="../app/Assets/css/images/preview.svg" title="Ver">
                            </a> -->
                            
                            <a  data-toggle="modal" href='#modal-id' href="" onclick="Cargar('registro/?id=<?= $value->id ?>','definicion')" class="btn-warning">
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

<div class="modal fade" id="modal-id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-title">Definicion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="index">

            </div>
        </div>
    </div>
</div>


<script>

        function eliminarDefinicion(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡Esta acción no se puede deshacer!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#0b7c3e',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: 'Cancelar',
                customClass: { popup: 'mi-clase-modal' }
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?php echo BASE_PATH ?>definicion/eliminar/'+id,
                        type: 'POST',
                        contentType: 'application/json',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            console.log(response.status);
                            if (response.status != 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Éxito!',
                                    text: response.msn,
                                    confirmButtonText: 'Aceptar'
                                }).then((result) => {
                                    location.reload(); // Recargar la página
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Hubo un error al eliminar la definición',
                                    confirmButtonText: 'Aceptar'
                                });
                            }
                        },
                        error: () => Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error al procesar la solicitud.',
                            icon: 'error',
                            customClass: { popup: 'mi-clase-modal' }
                        })
                    });
                }
            });
        }
</script>