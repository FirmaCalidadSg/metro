<?php

namespace App\Controllers;



class ConsultasController
{


    public function __construct() {}

    public function index()
    {
        require_once __DIR__ . '/../views/layouts/Sidebar.php';
        require_once __DIR__ . '/../views/consultas/index.php';
    }

    public function registrosconsulta()
    {
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/consultas/registrosconsulta.php';
    }

    public function consultaPreview()
    {
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/consultas/consulta-Preview.php';
    }
}
