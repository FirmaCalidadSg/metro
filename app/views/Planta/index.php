<div class="pais">
    <button class="btn-back" onclick="goBack()">
        <div class="btn-back-text">
            < Volver</div>
    </button>
    <div class="pais-header">
        <div class="btn-space">
            <h2>Plantas Registradas</h2>
            <a data-toggle="modal" href='#modal-id' onclick="Cargar('crud','')" class="btn-primary">Registrar Planta</a>
        </div>
        <table class="custom-table" id="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plantas as $value): ?>
                    <tr>

                        <td><?php echo $value->nombre_planta; ?></td>
                        <td><?php echo $value->ciudad_nombre; ?></td>
                        <td>
                            <a href="../app/pais/vistaPrevia/<?php echo $value->id; ?>" class="btn">
                                <img src="/metro/app/Assets/css/images/preview.svg" title="Ver">
                            </a>
                            <a href="../app/pais/editarFormulario/<?php echo $value->id; ?>" class="btn">
                                <img src="/metro/app/Assets/css/images/edit.svg" title="Editar">
                            </a>
                            <button onclick="eliminarPais(<?php echo $value->id; ?>)" class="btn">
                                <img src="/metro/app/Assets/css/images/delete.svg" title="Eliminar">
                            </button>
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
                <h1 class="modal-title fs-5" id="modal-title">Registro Planta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="index">

            </div>
        </div>
    </div>
</div>

<script>
    function Cargar(url, data) {
        urls = '<?php echo BASE_PATH ?>plantas/' + url;
        $.ajax({
            url: urls,
            type: 'GET',
            data: data,
            success: function(response) {
                $('#index').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    $('#formPlanta').on('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: '<?php echo BASE_PATH ?>plantas/registrar',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Planta guardada correctamente',
                        confirmButtonText: 'Aceptar'
                    }).then((result) => {
                        $('#table').DataTable().ajax.reload();

                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al guardar la planta',
                        confirmButtonText: 'Aceptar'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Error en el servidor: ' + error,
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    });
</script>