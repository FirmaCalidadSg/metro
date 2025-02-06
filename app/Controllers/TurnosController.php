<?php

namespace App\Controllers;

use App\Models\Plantas;
use App\Models\Turno;

class TurnosController
{
    private $planta;
    private $turno;

    public function __construct()
    {
        $this->planta = new Plantas();
        $this->turno = new Turno();
    }

    public function index()
    {
         //$plantas = $this->planta->getAllPlantas();
        $turnos = $this->turno->getAllTurnos(); 

        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/turnos/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }

    public function registro()
    {
        $turno = new Turno();
        $plantas = $this->planta->getAllPlantas();

        if (isset($_REQUEST['id'])) {
            $turno = $this->turno->getTurnoById($_REQUEST['id']);
        }

        require_once __DIR__ . '/../views/turnos/registro.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }

    public function crear()
    {
        try {
            $turno = new Turno();
            $turno->id = $_POST['id'] ?? null;
            $turno->nombre = $_POST['nombre'];
            $turno->planta_id = $_POST['planta_id'];
            $turno->fecha_inicio = $_POST['fecha_inicio'];
            $turno->fecha_fin = $_POST['fecha_fin'];
            $turno->hora_inicio = $_POST['hora_inicio'];
            $turno->hora_fin = $_POST['hora_fin'];

            $result = $turno->id > 0
                ? $this->turno->updateTurno($turno)
                : $this->turno->createTurno($turno);

            echo json_encode($result);
        } catch (\Exception $e) {
            echo json_encode(['status' => 'error', 'msn' => $e->getMessage()]);
        }
    }

    public function GetTurnoByPlanta()
    {
        if (!isset($_REQUEST['planta'])) {
            echo json_encode(['error' => 'ID de planta no proporcionado']);
            return;
        }

        $plantaId = intval($_REQUEST['planta']);
        $turnos = $this->turno->getTurnoById($plantaId);

        echo json_encode($turnos);
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

            $result = $this->turno->deleteTurno($id);
            echo json_encode(['success' => $result]);
        } catch (\Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    public function GetTurnoById()
    {
        $turnos =   $this->turno->getTurno($_REQUEST['turno_id']);
        echo json_encode($turnos);
    }
}
