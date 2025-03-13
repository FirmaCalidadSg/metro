<?php

namespace App\Controllers;


use App\Models\Ciudad;
use App\Models\Departamento;
use App\Models\Plantas;

class CapacidadesController
{
    public $ciudad;
    public $departamento;
    public $planta;

    public function __construct()
    {
        $this->ciudad = new Ciudad();
        $this->departamento = new Departamento();
        $this->planta = new Plantas();
    }

    public function index()
    {
        require_once __DIR__ . '/../views/layouts/layout.php';
        $ciudades = $this->ciudad->getAllCiudad();  
        require_once __DIR__ . '/../views/ciudad/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
