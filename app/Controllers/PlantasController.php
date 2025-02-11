<?php

namespace App\Controllers;

use App\Models\Plantas;
use App\Models\Ciudad;
// use App\Models\Responsable;

class PlantasController
{
    private $planta;
    private $ciudad;
    private $responsable;

    public function __construct()
    {
        $this->planta = new Plantas();
        $this->ciudad = new Ciudad();
        //$this->responsable = new Responsable();
    }

    public function index()
    {
        $plantas = $this->planta->getAllPlantas();
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/planta/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }

    public function registro()
    {
        $planta = new Plantas();
        $ciudades = $this->ciudad->getAllCiudad();
        //$responsables = $this->responsable->getAllResponsables();

        if (isset($_REQUEST['id'])) {
            $planta = $this->planta->getPlantaById($_REQUEST['id']);
        }

        require_once __DIR__ . '/../views/planta/crud.php';
        require_once __DIR__ . '/../views/layouts/footer.php';


    }

    public function crear()
    {
        try {
            $planta = new Plantas();
            $planta->id = $_POST['id'];
            $planta->nombre_planta = $_POST['nombre_planta'];
            $planta->ciudad_id = $_POST['ciudad_id'];
            $planta->responsable_id = $_POST['responsable_id'];
            //print_r($planta->responsable_id);
            $result = $planta->id > 0
                ? $this->planta->updatePlanta($planta)
                : $this->planta->createPlanta($planta);

            echo json_encode($result);
        } catch (\Exception $e) {
            echo json_encode(['status' => 'error', 'msn' => $e->getMessage()]);
        }
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

            $result = $this->planta->deletePlanta($id);
            echo json_encode(['success' => $result]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
