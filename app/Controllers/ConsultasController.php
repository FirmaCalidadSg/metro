<?php

namespace App\Controllers;



class ConsultasController
{


    public function __construct() {}

    public function index()
    {
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/consultas/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }

    public function registrosconsulta()
    {
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/consultas/registrosconsulta.php';
        require_once __DIR__ . '/../views/layouts/footer.php';


    }

    public function consultaPreview()
    {
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/consultas/consulta-Preview.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }
}
