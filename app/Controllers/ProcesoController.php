<?php

namespace App\Controllers;


use App\Models\Proceso;
use App\Models\Linea;

class ProcesoController
{
    public $proceso;

    public function __construct()
    {
        $this->proceso = new Proceso();
    }

    public function index()
    {

        $procesos = $this->proceso->getAllProceso();

        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/proceso/index.php';
    }

    public function registro()
    {
        $proceso = new Proceso();
        if (isset($_POST['id'])) {
            $proceso = $this->proceso->getProcesoById($_POST['id']);
        }
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/proceso/registro.php';
    }

    public function crear()
    {
        $message = 'Proceso registrado exitosamente';
        $proceso = new Proceso();
        $proceso->id = $_POST['id'];
        $proceso->nombre = $_POST['nombre'];
        $proceso->descripcion = $_POST['descripcion'];

        if ($proceso->id > 0) {
            $this->proceso->updateProceso($proceso);
            $message = 'Proceso actualizado exitosamente';
        } else {
            $this->proceso->createProceso($proceso);
        }
        $response = [
            'success' => true,
            'message' => $message
        ];
        echo json_encode($response);
    }
    public function editarFormulario($id)
    {
        $proceso = $this->proceso->getProcesoById($id);

        if (!$proceso) {
            $response = [
                'success' => false,
                'message' => 'Proceso no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/proceso/editar.php';
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
        $descripcion = $_POST['descripcion'];
        $linea = $_POST['linea'];

        // Obtener la definición por ID
        $proceso = $this->proceso->getProcesoById($id);

        if (!$proceso) {
            $response = [
                'success' => false,
                'message' => 'Proceso no encontrado.'
            ];
            echo json_encode($response);
            exit;
        }

        // Actualizar la definición
        $proceso->nombre = $nombre;
        $proceso->descripcion = $descripcion;
        $proceso->nombre = $linea;

        // Guardar la definición actualizada
        $this->proceso->updateProceso($proceso);

        $response = [
            'success' => true,
            'message' => 'Proceso actualizado exitosamente.'
        ];

        echo json_encode($response);
    }

    public function vistaPrevia($id)
    {
        if (isset($id)) {
            $proceso = $this->proceso->getProcesoById($id);
        } else {
            header("Location: /metro/app/proceso");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/proceso/vista-previa.php';
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

            // Eliminar el proceso
            $this->proceso->deleteProceso($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }


    public function GetProcesoByPlanta()
    {
        $procesos = $this->proceso->getProcesoByPlanta($_REQUEST['planta']);
        echo json_encode($procesos);
    }
}
