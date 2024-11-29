<?php

namespace App\Controllers;


use App\Models\Proceso;

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

        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/proceso/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $proceso = new Proceso();
        if (isset($_POST['id'])) {
            $proceso = $this->proceso->getProcesoById($_POST['id']);
        }
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
}
