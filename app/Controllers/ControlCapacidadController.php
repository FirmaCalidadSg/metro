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

    public function paradas()
    {
        require_once __DIR__ . '/../views/layouts/paradas.php';
        require_once __DIR__ . '/../views/controlCapacidad/parada.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function modal1()
    {
        require_once __DIR__ . '/../views/layouts/modal1.php';
        require_once __DIR__ . '/../views/controlCapacidad/modal1.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    public function modal2()
    {
        require_once __DIR__ . '/../views/layouts/modal2.php';
        require_once __DIR__ . '/../views/controlCapacidad/modal2.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
