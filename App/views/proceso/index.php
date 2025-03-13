<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Procesos</h2>
                </div>
                <div class="col-sm-6 text-end">
                    <button data-toggle="modal" href='#modal-id' onclick="Cargar('registro','proceso')" class="btn-div">
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
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Planta</th>
                        <!-- <th>Responsable</th> -->
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                   //  print_r($proceso);
                    foreach ($proceso as $entidad): ?>
                        <tr>
                            <td><?= $entidad->id; ?></td>
                            <td><?= $entidad->nombre; ?></td>
                            <td><?= $entidad->descripcion ?? 'N/A'; ?></td>
                            <td><?= $entidad->planta_nombre; ?></td>
                            <!-- <td><?= $entidad->responsable_id; ?></td> -->
                            <td>
                                <a data-toggle="modal" href='#modal-id'
                                    onclick="Cargar('registro/?id=<?= $entidad->id ?>','proceso')" class="btn-editar">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a onclick="eliminar('proceso','eliminar',<?= $entidad->id; ?>)" class="btn-eliminar">
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
</div>

        <table class="custom-table" id="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Planta</th>
                    <!-- <th>Responsable</th> -->
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // print_r($proceso);
                foreach ($proceso as $entidad): ?>
                    <tr>
                        <td><?= $entidad->id; ?></td>
                        <td><?= $entidad->nombre; ?></td>
                        <td><?= $entidad->descripcion ?? 'N/A'; ?></td>
                        <td><?= $entidad->planta_id; ?></td>
                        <!-- <td><?= $entidad->responsable_id; ?></td> -->
                        <td>
                            <a data-toggle="modal" href='#modal-id'
                                onclick="Cargar('registro/?id=<?= $entidad->id ?>','proceso')" class="btn-editar">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a onclick="eliminar('proceso','eliminar',<?= $entidad->id; ?>)" class="btn-eliminar">
                                <i class="fa fa-trash"></i>
                            </a>
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
                <h1 class="modal-title fs-5" id="modal-title">Procesos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="index">

            </div>
        </div>
    </div>
</div>