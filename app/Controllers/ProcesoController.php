<?php

namespace App\Controllers;

use App\Models\Proceso;
use App\Models\Plantas;
use App\Models\Responsable;


class ProcesoController
{
    private $Proceso;
    private $planta;
    private $responsable;

    public function __construct()
    {
        $this->Proceso = new Proceso();
        $this->planta = new Plantas();
        // $this->responsable = new Responsable();
    }

    public function index()
    {
        $proceso = $this->Proceso->getAllProceso();
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/proceso/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function registro()
    {
        $Proceso = new Proceso();
        $plantas = $this->planta->getAllPlantas();
        /* $responsables = $this->responsable->getAllResponsables(); */

        if (isset($_REQUEST['id'])) {
            $proceso = $this->Proceso->getProcesoById($_REQUEST['id']);
        }

        require_once __DIR__ . '/../views/proceso/registro.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function crear()
    {
        $Proceso = new Proceso();
        $Proceso->id = $_POST['id'] ?? null;
        $Proceso->nombre = $_POST['nombre'];
        $Proceso->descripcion = $_POST['descripcion'] ?? null;
        $Proceso->planta_id = $_POST['planta_id'];
        $Proceso->responsable_id = $_POST['responsable_id'];

        $result = $Proceso->id > 0 ? $this->Proceso->updateProceso($Proceso) : $this->Proceso->createProceso($Proceso);
        echo json_encode($result);
    }

    public function eliminar($id = null)
    {
        try {
            $id = $id ?? json_decode(file_get_contents('php://input'), true)['id'];
            if (!$id) throw new \Exception('ID no proporcionado');

            $result = $this->Proceso->deleteProceso($id);
            echo json_encode(['success' => $result]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    public function GetProcesoByPlanta()
    {
        $procesos = $this->Proceso->getProcesoByPlanta($_REQUEST['linea']);
        echo json_encode($procesos);
    }
}
