<?php

namespace App\Controllers;


use App\Models\Equipo;
use App\Models\DanoEquipo;

class EquipoController
{
    public $equipo;
    public $dano;

    public function __construct()
    {
        $this->equipo = new Equipo();
    }

    public function index()
    {

        $equipos = $this->equipo->getAllEquipo();

        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/equipo/index.php';
    }

    public function registro()
    {
        $equipo = new Equipo();
        if (isset($_POST['id'])) {
            $equipo = $this->equipo->getEquipoAndDanos($_POST['id']);
        }
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
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
    public function vistaPrevia($id)
    {
        if (isset($id)) {
            $equipo = $this->equipo->getEquipoById($id);
        } else {
            header("Location: /metro/app/equipo");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/equipo/vista-previa.php';
    }
    public function editarFormulario($id)
    {

        $equipo = $this->equipo->getEquipoById($id);


        if (!$equipo) {
            $response = [
                'success' => false,
                'message' => 'Equipo no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/equipo/editar.php';
    }
    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $response = [
                'success' => false,
                'message' => 'Método no permitido.'
            ];
            echo json_encode($response);
            exit;
        }

        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $modelo = $_POST['modelo'];
        $estado = $_POST['estado'];
        $id = $_POST['id'];
        $dano = $_POST['dano'];

        // Obtener la definición por ID
        $equipo = $this->equipo->getEquipoById($id);

        if (!$equipo) {
            $response = [
                'success' => false,
                'message' => 'Equipo no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }


        $equipo->nombre = $nombre;
        $equipo->modelo = $modelo;
        $equipo->estado = $estado;

        $this->equipo->updateEquipo($equipo);

        $response = [
            'success' => true,
            'message' => 'Equipo actualizado exitosamente.'
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
