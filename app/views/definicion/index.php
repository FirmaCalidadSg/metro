<div class="container">
    <!--  <button class="btn-back" onclick="goBack()">
        <div class="btn-back-text">
            < Volver</div>
    </button> -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Lista de Definiciones</h2>

                </div>
                <div class="col-sm-6">
                    <button data-toggle="modal" href='#modal-id' onclick="Cargar('registro','definicion')" class="btn-div pull-right">
                        <img class="image-list" src="../app/Assets/css/images/circle-fill.svg">
                        <div class="text-style">Agregar</div>
                    </button>
                </div>
            </div>

        </div>

        <div class="card-body">
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

                                <a data-toggle="modal" href='#modal-id' href="" onclick="Cargar('registro/?id=<?= $value->id ?>','definicion')" class="btn-editar">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a onclick="eliminar('definicion','eliminar',<?php echo $value->id; ?>)" class="btn-eliminar">
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
                <h1 class="modal-title fs-5" id="modal-title">Definicion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="index">

            </div>
        </div>
    </div>
</div>