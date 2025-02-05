<?php //print_r($categoriaParos) ?>
<div class="pais">

    <div class="pais-header">
        <div class="btn-space">
            <h2>Paros</h2>
            <button data-toggle="modal" href='#modal-id' onclick="Cargar('registro','categoriaParos')" class="btn-div">
                <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                <div class="text-style">Agregar</div>
            </button>
        </div>

        <table class="custom-table" id="table">
            <thead>
                <tr>
                    
                    <th>Nombre</th>
                    <th>DistribucionTiempos</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categoriaParos as $categoria): ?>
                    <tr>
                        
                        <td><?php echo $categoria->nombre; ?></td>
                        
                        <td><?php echo $categoria->distribucion; ?></td>

                        <td><?php echo $categoria->descripcion; ?></td>
                        <td>
                            <a data-toggle="modal" href='#modal-id' onclick="Cargar('registro/?id=<?= $categoria->id_categoria ?>','categoriaParos')" class="btn-editar">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a onclick="eliminar('categoriaParos','eliminar',<?php echo $categoria->id_categoria; ?>)" class="btn-eliminar">
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
                <h1 class="modal-title fs-5" id="modal-title">Categorías de Paros</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="index"></div>
        </div>
    </div>
</div>
