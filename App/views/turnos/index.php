<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-7">
                <h5>Turnos Registrados</h5>
            </div>
            <div class="col-sm-5 text-end">
                <button data-toggle="modal" href='#modal-id' onclick="Cargar('registro','turno')" class="btn-div">
                    <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                    <div class="text-style">Agregar</div>
                </button>
            </div>



        </div>
        <div class="card-body">
            <table class="custom-table" id="table">
                <thead>
                    <tr>

                        <th>Turno</th>
                        <th>Planta</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($turnos as $turno): ?>
                        <tr>

                            <td><?php echo $turno->turno; ?></td>
                            <td><?php echo $turno->nombre_planta; ?></td>
                            <td><?php echo $turno->fecha_inicio; ?></td>
                            <td><?php echo $turno->fecha_fin; ?></td>
                            <td><?php echo $turno->hora_inicio; ?></td>
                            <td><?php echo $turno->hora_fin; ?></td>
                            <td>
                                <a data-toggle="modal" href='#modal-id' onclick="Cargar('registro/?id=<?= $turno->turno_id ?>','turno')" class="btn-editar">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a onclick="eliminar('turno','eliminar',<?php echo $turno->turno_id; ?>)" class="btn-eliminar">
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
                <h1 class="modal-title fs-5" id="modal-title">Turnos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="index"></div>
        </div>
    </div>
</div>