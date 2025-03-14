<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../../app/Assets/css/globals.css" />
    <link rel="stylesheet" href="../../app/Assets/css/styleguide.css" />
    <link rel="stylesheet" href="../../app/Assets/css/style.css" />
    <title>Registro</title>
</head>

<body>
    <div class="registroConfig">
        <div class="info">
            <div class="frame">
                <div class="text">
                    <div class="text-wrapper">Nuevo Daño</div>
                </div>
                <div class="div">
                    <div class="frame-2">
                        <div class="text-wrapper-2">Creado por</div>
                        <div class="div-wrapper">
                            <div class="text-wrapper-3">Sebastian Diaz</div>
                        </div>
                    </div>
                    <div class="frame-2">
                        <div class="text-wrapper-2">Fecha registro</div>
                        <div class="frame-3">
                            <div class="img-calendar">
                                <img src="../../app/Assets/css/images/calender.svg" />
                            </div>
                            <div class="text-wrapper-3">
                                <?php
                                $fecha = date('d/m/Y');
                                echo $fecha;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Agregamos el formulario que enviará los datos a la función crear del controlador -->
            <form method="POST" class="form-register" action="/metro/app/danoequipo/<?php echo isset($dano->id) && $dano->id > 0 ? 'actualizar' : 'crear'; ?>">
                <div class="drops-downs">
                    <div class="element">
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-5">Equipo</div>
                                <div class="div-2">
                                    <select class="select-register" name="equipo">
                                        <option value="">Seleccionar</option>
                                        <?php foreach ($equipos as $equipo) { ?>
                                            <option value="<?php echo $equipo->id; ?>"><?php echo $equipo->nombre;?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>

                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-5">Fecha</div>
                                <div class="div-2">
                                    <input type="datetime-local" name="fecha" class="select-register" value="<?php echo $dano->fecha ?? ''; ?>" placeholder="Fecha" required>
                                </div>
                                <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                    </div>

                    <div class="element">
                        <div class="textfield-wrapper">
                            <div class="textfield-2">
                                <div class="input">
                                    <div class="text-wrapper-5">Descripción</div>
                                    <div class="div-2">
                                        <input type="text" name="descripcion" class="select-register" value="<?php echo $dano->descripcion ?? ''; ?>" placeholder="Descripción" required>
                                    </div>
                                    <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                                </div>
                            </div>
                        </div>
                        <div class="textfield-2">
                            <div class="input">
                                <div class="text-wrapper-5">Estado</div>
                                <div class="div-2">
                                    <input type="text" name="estado" class="select-register" value="<?php echo $dano->estado ?? ''; ?>" placeholder="Estado" required>
                                </div>
                                <img class="underline" src="../../app/Assets/css/images/underline.svg" />
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <input type="hidden" id="id" name="id" value="<?php echo $dano->id ?? ''; ?>">
        <button type="submit" class="btn btn-primary">
            <?php echo isset($dano->id) && $dano->id > 0 ? 'Actualizar' : 'Registrar'; ?>
        </button>
        </form>

        <!-- Modal HTML -->
        <div class="modal-changes" id="successModal" style="display: none;">
            <div class="modal-content">
                <div class="modal-title">
                    <h2 id="modal-title">¡Éxito!</h2>
                </div>
                <p class="modal-message" id="modal-message">La operación se completó correctamente.</p>
                <button id="closeModal">Cerrar</button>
            </div>
        </div>


</body>
<script>
    function showModal(message, isSuccess = true) {
        document.getElementById('modal-message').innerHTML = message;

        document.getElementById('modal-title').innerHTML = isSuccess ? '¡Éxito!' : 'Error';
        document.getElementById('successModal').style.backgroundColor = isSuccess ? '#111111bd' : '#F44336';
        document.getElementById('successModal').style.display = 'flex';
        document.getElementById('closeModal').addEventListener('click', function() {
            closeModal(isSuccess);
        });

        setTimeout(() => {
            closeModal(isSuccess);
        }, 5000);
    }

    function closeModal(isSuccess) {
        document.getElementById('successModal').style.display = 'none';

        // Si es éxito, redirigir a la lista de definiciones
        if (isSuccess) {
            window.location.href = "<?php echo BASE_PATH; ?>/danoequipo";
        }
    }

    // Enviar el formulario mediante Fetch
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault(); // Evitar que se recargue la página al enviar el formulario

        // Recopilar datos del formulario
        const formData = new FormData(this);

        // Realizar la petición Fetch para enviar el formulario
        fetch('/metro/app/danoequipo/crear', {
            method: 'POST',
            body: formData
        }).then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta del servidor');
            }
            return response.json();
        }).then(data => {
            if (data.success) {
                showModal(data.message, true); // Mostrar modal si la operación fue exitosa
            } else {
                showModal(data.message, false); // Mostrar modal con error
            }
        }).catch(error => {
            /*     console.error('Error:', error); */
            showModal('Ocurrió un error inesperado', false); // Mostrar error en el modal
        });
    });
</script>

</html>