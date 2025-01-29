<?php

namespace App\Controllers;


use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\Pais;
use App\Models\Plantas;

class PlantasController
{
    public $ciudad;
    public $departamento;
    public $pais;
    public $planta;

    public function __construct()
    {
        $this->ciudad = new Ciudad();
        $this->departamento = new Departamento();
        $this->pais = new Pais();
        $this->planta = new Plantas();
    }

    public function index()
    {

        $plantas = $this->planta->getAllPlantas();
        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/Planta/index.php';
        // require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function crud()
    {
        $ciudades = $this->ciudad->getAllCiudad();
        require_once __DIR__ . '/../views/Planta/crud.php';
    }

    public function registrar()
    {
        $planta = new Plantas();
        $planta->id = $_POST['id_planta'];
        $planta->nombre = $_POST['nombre'];
        $planta->ciudad_id = $_POST['ciudad_id'];
        $planta->ciudad_id = $_POST['ciudad_id'];
        $result = $planta->id > 0 ? $this->planta->updatePlanta($planta) : $this->planta->createPlanta($planta);
        echo json_encode($result, true);
    }
}
