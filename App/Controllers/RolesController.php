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
        $message = 'Rol registrado exitosamente';  // Mensaje por defecto para crear
        $rol = new Roles();
        $rol->id = isset($_POST['id']) ? $_POST['id'] : 0;  // Asegúrate de que `id` esté presente
        $rol->rol = $_POST['rol'];  // Asigna el valor del rol

        if ($rol->id > 0) {  // Si el ID existe, actualiza el rol
            $this->roles->updateRol($rol);
            $message = 'Rol actualizado exitosamente';
        } else {  // Si no, crea un nuevo rol
            $this->roles->createRol($rol);
        }

        // Respuesta con éxito y mensaje de la operación
        $response = [
            'success' => true,
            'message' => $message
        ];

        // Responder en formato JSON para que el frontend pueda manejarlo
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
