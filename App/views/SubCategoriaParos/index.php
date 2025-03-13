<div class="pais">
    <div class="pais-header">
        <div class="btn-space">
            <h2>Subcategorías de Paros Registradas</h2>
            <button data-toggle="modal" href='#modal-id' onclick="Cargar('registro','subCategoriaParos')" class="btn-div">
                <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                <div class="text-style">Agregar</div>
            </button>
        </div>

        <table class="custom-table" id="table">
            <thead>
                <tr>
                   
                    <th>Categoría</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($SubCategoriaParos as $subcategoria): ?>
                    <tr>
                        
                        <td><?php echo $subcategoria->nombre_categoria; ?></td>
                        <td><?php echo $subcategoria->nombre; ?></td>
                        <td><?php echo $subcategoria->descripcion; ?></td>
                        <td>
                            <a data-toggle="modal" href='#modal-id' onclick="Cargar('registro/?id=<?= $subcategoria->id_subcategoria ?>','subCategoriaParos')" class="btn-editar">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a onclick="eliminar('subCategoriaParos','eliminar',<?php echo $subcategoria->id_subcategoria; ?>)" class="btn-eliminar">
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
                <h1 class="modal-title fs-5" id="modal-title">Subcategorías de Paros</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="index"></div>
        </div>
    </div>
</div>
