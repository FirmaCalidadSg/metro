
    <div class="pais">

        <div class="pais-header">
            <div class="btn-space">
                <h2>Paises Registrados</h2>
                <button data-toggle="modal" href='#modal-id' onclick="Cargar('registro','pais')" class="btn-div">
                    <img class="image-list" src="/metro/app/Assets/css/images/circle-fill.svg">
                    <div class="text-style">Agregar</div>
                </button>

            </div>
            <table class="custom-table" id="table">
                <thead>
                    <tr>
                        <th>Planta</th>
                        <th>Pais</th>
                        <th>Ciudad</th>
                        <th>Reponsable</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($paises as $pais): ?>
                        <tr>
                            <td><?php echo $pais->id; ?></td>
                            <td><?php echo $pais->nombre; ?></td>
                            <td><?php echo $pais->codigo; ?></td>
                            <td>

                                <a data-toggle="modal" href='#modal-id' href="" onclick="Cargar('registro/?id=<?= $pais->id ?>','pais')" class="btn-editar">
                                    <i class="fa fa-edit"></i>

                                </a>
                                <a  onclick="eliminar('pais','eliminar',<?php echo $pais->id; ?>)" class="btn-eliminar">
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
                    <h1 class="modal-title fs-5" id="modal-title">Paises</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="index">

                </div>
            </div>
        </div>
    </div>

      