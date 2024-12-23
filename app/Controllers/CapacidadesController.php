<?php

namespace App\Controllers;


use App\Models\Ciudad;
use App\Models\Departamento;

class CapacidadesController
{
    public $ciudad;
    public $departamento;

    public function __construct()
    {
        $this->ciudad = new Ciudad();
        $this->departamento = new Departamento();
    }

    public function index()
    {
        $ciudades = $this->ciudad->getAllCiudad();

        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/ciudad/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
