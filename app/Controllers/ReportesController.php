<?php

namespace App\Controllers;

class ReportesController
{

    public function __construct() {}



    public function index()
    {
        require_once __DIR__ . '/../views/layouts/reportes.php';
        require_once __DIR__ . '/../views/Reportes/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
    public function Resultados()
    {
        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/Reportes/resultados.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
