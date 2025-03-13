<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h5>Plantas Registradas</h5>

                </div>
                <div class="col-sm-6 text-end">
                    <button data-toggle="modal" href='#modal-id' onclick="Cargar('registro','plantas')" class="btn-div">
                        <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                        <div class="text-style">Agregar</div>
                    </button>
                </div>

            </div>


        </div>
        <div class="card-body">
            <table class="custom-table" id="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre Planta</th>
                        <th>Ciudad</th>
                        <th>Responsable</th>
                        <th>Fecha de Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($plantas as $planta): ?>
                        <tr>
                            <td><?php echo $planta->id; ?></td>
                            <td><?php echo $planta->nombre_planta; ?></td>
                            <td><?php echo $planta->ciudad_id; ?></td>
                            <td><?php echo $planta->responsable_id ?? 'No asignado'; ?></td>
                            <td><?php echo $planta->created; ?></td>
                            <td>
                                <a data-toggle="modal" href='#modal-id' onclick="Cargar('registro/?id=<?= $planta->id ?>','plantas')" class="btn-editar">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a onclick="eliminar('plantas','eliminar',<?php echo $planta->id; ?>)" class="btn-eliminar">
                                    <i class="fa fa-trash"></i>
                                </a>
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
                <h1 class="modal-title fs-5" id="modal-title">Plantas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="index"></div>
        </div>
    </div>
</div>