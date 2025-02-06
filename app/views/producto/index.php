<div class="pais">
    <div class="pais-header">
        <div class="btn-space">
            <h2>Lista de Productos</h2>
            <button data-toggle="modal" href='#modal-id' onclick="Cargar('registro','producto')" class="btn-div">
                <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                <div class="text-style">Agregar</div>
            </button>
        </div>

        <table class="custom-table" id="table">
            <thead>
                <tr>
                   
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Línea</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        
                        <td><?= $producto->nombre; ?></td>
                        <td><?= $producto->codigo; ?></td>
                        <td><?= $producto->descripcion ?? 'N/A'; ?></td>
                        <td><?= $producto->linea_nombre; ?></td>
                        <td>
                            <a data-toggle="modal" href='#modal-id' onclick="Cargar('registro/?id=<?= $producto->id ?>','producto')" class="btn-editar">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a onclick="eliminar('producto','eliminar',<?= $producto->id; ?>)" class="btn-eliminar">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL PARA REGISTRO Y EDICIÓN -->
<div class="modal fade" id="modal-id" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-title">Producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="index"></div>
        </div>
    </div>
</div>
