    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2>Gestión de Roles</h2>
                <div class="mb-3">
                    <a href="<?php echo BASE_PATH; ?>/roles/registro" class="btn btn-primary">Nuevo Rol</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($roles as $rol): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($rol->id); ?></td>
                                <td><?php echo htmlspecialchars($rol->rol); ?></td>
                                <td>
                                    <form action="<?php echo BASE_PATH; ?>/roles/eliminar/<?php echo $rol->id; ?>" method="POST" style="display: inline;">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este rol?')">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>