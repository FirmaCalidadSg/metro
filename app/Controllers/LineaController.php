<?php

namespace App\Controllers;


use App\Models\Linea;
use App\Models\Proceso;

class LineaController
{
    public $linea;
    public $proceso;

    public function __construct()
    {
        $this->linea = new Linea();
        $this->proceso = new Proceso();
    }

    public function index()
    {
        $lineas = $this->linea->getAllLinea();

        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/linea/index.php';
    }

    public function registro()
    {
        $procesos = $this->proceso->getAllProceso();
        $linea = new Linea();
        if (isset($_POST['id'])) {
            $linea = $this->linea->getLineaById($_POST['id']);
        }
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/linea/registro.php';
    }

    public function crear()
    {
        $message = 'Linea registrada exitosamente';
        $linea = new Linea();
        $linea->id = $_POST['id'];
        $linea->nombre = $_POST['nombre'];
        $linea->proceso = $_POST['proceso'];

        if ($linea->id > 0) {
            $this->linea->updateLinea($linea);
            $message = 'Linea actualizada exitosamente';
        } else {
            $this->linea->createLinea($linea);
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
            $linea = $this->linea->getLineaById($id);
        } else {
            header("Location: /metro/app/linea");
            exit;
        }
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/linea/vista-previa.php';
    }
    public function editarFormulario($id)
    {
        $linea = $this->linea->getLineaById($id);
        $procesos = $this->proceso->getAllProceso();
        require_once __DIR__ . '/../views/layouts/Sidebar3.php';
        require_once __DIR__ . '/../views/linea/editar.php';
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
        $proceso = $_POST['proceso'];

        // Obtener la definición por ID
        $linea = $this->linea->getLineaById($id);

        if (!$linea) {
            $response = [
                'success' => false,
                'message' => 'Línea no encontrada.'
            ];
            echo json_encode($response);
            exit;
        }

        // Actualizar la definición
        $linea->nombre = $nombre;
        $linea->proceso = $proceso;

        // Guardar la definición actualizada
        $this->linea->updateLinea($linea);

        $response = [
            'success' => true,
            'message' => 'Línea actualizada exitosamente.'
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

            // Eliminar el linea
            $this->linea->deleteLinea($id);

            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function getbyplanta()
    {
        $lineas =  $this->linea->GetByPlanta($_REQUEST['planta']);
        echo json_encode($lineas);
    }
}
