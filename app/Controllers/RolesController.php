<?php

namespace App\Controllers;

use App\Models\Roles;

class RolesController
{
    private $roles;

    public function __construct()
    {
        $this->roles = new Roles();
    }

    public function index()
    {
        $roles = $this->roles->getAllRoles();
        require_once __DIR__ . '/../views/layouts/roles.php';
        require_once __DIR__ . '/../views/roles/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
    public function registro()
    {
        $rol = new Roles();
        if (isset($_POST['id'])) {
            $rol = $this->roles->getRolById($_POST['id']);
        }
        require_once __DIR__ . '/../views/roles/registro.php';
    }
    public function crear()
    {
        $message = 'Rol registrado exitosamente';
        $rol = new Roles();
        $rol->id = $_POST['id'];
        $rol->rol = $_POST['rol'];

        if ($rol->id > 0) {
            $this->roles->updateRol($rol);
            $message = 'Rol actualizado exitosamente';
        } else {
            $this->roles->createRol($rol);
        }
        $response = [
            'success' => true,
            'message' => $message
        ];
        echo json_encode($response);
    }
    public function eliminar($id = null)
    {
        try {
            // Verificar si el ID viene en la URL
            if ($id === null) {
                // Si no viene en la URL, intentar obtenerlo del POST
                $data = json_decode(file_get_contents('php://input'), true);
                $id = $data['id'] ?? null;
            }

            if ($id === null) {
                throw new \Exception('ID no proporcionado');
            }

            // Eliminar el rol
            $this->roles->deleteRol($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
