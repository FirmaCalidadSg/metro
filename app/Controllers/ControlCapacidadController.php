<?php

namespace App\Controllers;

use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\Plantas;
use App\Models\Turno;
use App\Models\Controlcapacidad;

class ControlCapacidadController
{
    public $ciudad;
    public $departamento;
    public $planta;
    public $turnos;
    public $controlcapacidad;

    public function __construct()
    {
        $this->controlcapacidad = new Controlcapacidad();
        $this->ciudad = new Ciudad();
        $this->departamento = new Departamento();
        $this->planta = new Plantas();
        $this->turnos = new Turno();
    }



    public function index()
    {
        $plantas = $this->planta->getAllPlantas();

        require_once  __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/controlCapacidad/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function paradas()
    {
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/controlCapacidad/paradas.php';
    }

    public function modal1()
    {
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/controlCapacidad/modal1.php';
    }

    public function modal2()
    {
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/controlCapacidad/modal2.php';
    }


    public function RegistroCtrlCap()
    {
        $data = $_POST;
        // print_r(json_encode($data));

        $control = new Controlcapacidad();
        $control->fecha_registro = $_POST['fechaRegistro'];
        $control->planta_id = $_POST['planta_id'];
        $control->linea_id = $_POST['linea_id'];
        $control->proceso_id = $_POST['proceso_id'];
        $control->turno_id = $_POST['turno_id'];
        $control->operario = $_POST['operarioLider'];
        $control->horashombre = $_POST['h_hombre'];
        $control->num_operarios = $_POST['num_operarios'];
        $result = $control->create();
        if ($result) {
            $result = [
                "id" => $result,
                "success" => true,
                "message" => "Registro creado exitosamente.",
            ];

            echo json_encode($result);
        }
    }
}
