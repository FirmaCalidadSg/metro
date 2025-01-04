<?php

namespace App\Controllers;

class ControlCapacidadController
{

    public function __construct() {}



    public function index()
    {
        require_once __DIR__ . '/../views/layouts/controlcapacidad.php';
        require_once __DIR__ . '/../views/controlCapacidad/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function Parada()
    {
        require_once __DIR__ . '/../views/layouts/paradas.php';
        require_once __DIR__ . '/../views/controlCapacidad/parada.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
