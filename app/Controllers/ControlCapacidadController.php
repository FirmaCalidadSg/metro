<?php

namespace App\Controllers;

class ControlCapacidadController
{
    public function index()
    {
        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/controlCapacidad/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
