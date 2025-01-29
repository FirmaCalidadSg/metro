<?php

namespace App\Controllers;

use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\Plantas;
use App\Models\Turno;

class ControlCapacidadController
{
    public $ciudad;
    public $departamento;
    public $planta;
    public $turnos;

    public function __construct()
    {
        $this->ciudad = new Ciudad();
        $this->departamento = new Departamento();
        $this->planta = new Plantas();
        $this->turnos = new Turno();
    }



    public function index()
    {
        $plantas = $this->planta->getAllPlantas();
        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/controlCapacidad/index.php';
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
}
