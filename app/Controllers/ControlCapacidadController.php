<?php

namespace App\Controllers;

class ControlCapacidadController
{

    public function __construct() {}



    public function index()
    {
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
