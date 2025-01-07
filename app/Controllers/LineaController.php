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

        require_once __DIR__ . '/../views/layouts/lineas.php';
        require_once __DIR__ . '/../views/linea/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $procesos = $this->proceso->getAllProceso();
        $linea = new Linea();
        if (isset($_POST['id'])) {
            $linea = $this->linea->getLineaById($_POST['id']);
        }
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
}
