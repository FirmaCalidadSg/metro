<?php

namespace App\Controllers;


use App\Models\Equipo;

class EquipoController
{
    public $equipo;

    public function __construct()
    {
        $this->equipo = new Equipo();
    }

    public function index()
    {

        $equipos = $this->equipo->getAllEquipo();

        require_once __DIR__ . '/../views/layouts/equipo.php';
        require_once __DIR__ . '/../views/equipo/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $equipo = new Equipo();
        if (isset($_POST['id'])) {
            $equipo = $this->equipo->getEquipoById($_POST['id']);
        }
        require_once __DIR__ . '/../views/equipo/registro.php';
    }

    public function crear()
    {
        $message = 'Equipo registrado exitosamente';
        $equipo = new Equipo();
        $equipo->id = $_POST['id'];
        $equipo->nombre = $_POST['nombre'];
        $equipo->modelo = $_POST['modelo'];
        $equipo->estado = $_POST['estado'];

        if ($equipo->id > 0) {
            $this->equipo->updateEquipo($equipo);
            $message = 'Equipo actualizado exitosamente';
        } else {
            $this->equipo->createEquipo($equipo);
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

            // Eliminar el equipo
            $this->equipo->deleteEquipo($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
