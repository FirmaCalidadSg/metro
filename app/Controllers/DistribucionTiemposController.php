<?php

namespace App\Controllers;

use App\Models\DistribucionTiempos;

class DistribucionTiemposController
{
    public $DistribucionTiempos;

    public function __construct()
    {
        $this->DistribucionTiempos = new DistribucionTiempos();
    }

    public function index()
    {
        $distribucionTiempos = $this->DistribucionTiempos->getAllDistribucionTiempos();

        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/DistribucionTiempos/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $distribucionTiempo = new DistribucionTiempos();

        if (isset($_REQUEST['id'])) {
            $distribucionTiempo = $this->DistribucionTiempos->getDistribucionTiemposById($_REQUEST['id']);
        }

        require_once __DIR__ . '/../views/DistribucionTiempos/registro.php';
    }

    public function crear()
    {
        $distribucionTiempo = new DistribucionTiempos();
        $distribucionTiempo->id = $_POST['id'] ?? null;
        $distribucionTiempo->nombre = $_POST['nombre'];

        $result = $distribucionTiempo->id > 0
            ? $this->DistribucionTiempos->updateDistribucionTiempos($distribucionTiempo)
            : $this->DistribucionTiempos->createDistribucionTiempos($distribucionTiempo);

        echo json_encode($result, true);
    }

    public function eliminar($id = null)
    {
        try {
            if ($id === null) {
                $data = json_decode(file_get_contents('php://input'), true);
                $id = $data['id'] ?? null;
            }

            if ($id === null) {
                throw new \Exception('ID no proporcionado');
            }

            $result = $this->DistribucionTiempos->deleteDistribucionTiempos($id);
            echo json_encode(['success' => true]);
        } catch (\PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
