<?php

namespace App\Controllers;


use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\Plantas;
use App\Models\Turno;

class TurnosController
{
    public $id;
    public $nombre;
    public $planta_id;
    public $fecha_inicio;
    public $fecha_fin;
    public $hora_fin;
    public $hora_inicio;
    public $planta;
    public $turno;

    public function __construct()
    {

        $this->planta = new Plantas();
        $this->turno = new Turno();
    }

    public function index()
    {
        require_once __DIR__ . '/../views/layouts/layout.php';
        $ciudades = $this->planta->getAllPlantas();
        require_once __DIR__ . '/../views/turno/index.php';
    }


    public function GetTurnoByPlanta()
    {
        $turnos =   $this->turno->getTurnosById($_REQUEST['planta']);
        echo json_encode($turnos);
    }
    public function GetTurnoById()
    {
        $turnos =   $this->turno->getTurno($_REQUEST['turno_id']);
        echo json_encode($turnos);
    }
}
