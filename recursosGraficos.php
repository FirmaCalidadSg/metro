<!-- BOTONES -->
<a data-toggle="modal" href='#modal-id' href="" onclick="Cargar('registro/?id=<?= $value->id ?>','definicion')"
    class="btn-editar">
    <i class="fa fa-edit"></i>
</a>
<a onclick="eliminarDefinicion('definicion','eliminar',<?php echo $value->id; ?>)" class="btn-eliminar">
    <i class="fa fa-trash"></i>
</a>

<button data-toggle="modal" href='#modal-id' onclick="Cargar('registro','definicion')" class="btn-div">
    <img class="image-list" src="../app/Assets/css/images/circle-fill.svg">
    <div class="text-style">Agregar</div>
</button>