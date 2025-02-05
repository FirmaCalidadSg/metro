<div class="container mt-5">
        <!-- Formulario de selección -->
        <div class="card border-0 mb-3">
            <h5 class="card-header">Registro Productos</h5>
            <div class="card-body">
                <form id="productForm" method="POST" action="/metro/app/producto/<?php echo isset($producto->id) && $producto->id > 0 ? 'actualizar' : 'crear'; ?>">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Planta</label>
                            <select class="form-select" name="planta" required>
                                <option value="" selected>Seleccionar</option>
                                <?php foreach ($plantas as $value): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->nombre_planta ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Proceso</label>
                            <select class="form-select" name="proceso" required>
                                <option value="" selected>Seleccionar</option>
                                <?php foreach ($procesos as $value): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Línea</label>
                            <select class="form-select" name="linea" required>
                                <option value="">Seleccionar</option>
                                <?php foreach ($lineas as $value): ?>
                                    <option value="<?php echo $value->id ?>"><?php echo $value->nombre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label d-block">¿Tiene Referencias?</label>
                            <div class="form-check form-check-inline" required>
                                <input class="form-check-input" type="radio" name="referencia" value="si" id="refSi" onchange="Ref(this)">
                                <label class="form-check-label" for="refSi">Sí</label>
                            </div>
                            <div class="form-check form-check-inline" required>
                                <input class="form-check-input" type="radio" name="referencia" value="no" id="refNo" onchange="Ref(this)" checked>
                                <label class="form-check-label" for="refNo">No</label>
                            </div>
                        </div>
                        <div id="ref"></div>
                    </div>
            </div>
        </div>

        <!-- Formulario de registro/actualización -->
        <div class="card">
            <div class="card-body">

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $producto->nombre ?? ''; ?>" placeholder="Nombre" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Código</label>
                        <input type="text" name="codigo" class="form-control" value="<?php echo $producto->codigo ?? ''; ?>" placeholder="Código" required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="<?php echo $producto->descripcion ?? ''; ?>" placeholder="Descripción" required>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $producto->id ?? ''; ?>">

                <button type="submit" class="btn btn-primary mt-3">
                    <?php echo isset($producto->id) && $producto->id > 0 ? 'Actualizar' : 'Registrar'; ?>
                </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function Ref(radio) {
            const refDiv = document.getElementById('ref');

            if (radio.value === 'si') {
                refDiv.innerHTML = `
        <div class="mt-3">
          <label class="form-label">Referencia del Producto</label>
          <input type="text" class="form-control" name="referencia_producto" placeholder="Ingrese la referencia">
        </div>
      `;
            } else {
                refDiv.innerHTML = ''; // Vaciar el contenido del div pero mantenerlo visible
            }
        }


        // Manejar envío del formulario con AJAX
        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch(this.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error en la respuesta del servidor');
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire({
                        icon: data.success ? 'success' : 'error',
                        title: data.success ? '¡Éxito!' : 'Error',
                        text: data.message
                    }).then(() => {
                        window.location.href = "/metro/app/producto/";

                    });
                })
                .catch(() => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error inesperado'
                    });
                });
        });
    </script>
