<?php

namespace App\Controllers;



class ConsultasController
{


    public function __construct() {}

    public function index()
    {
        require_once __DIR__ . '/../views/layouts/layout.php';
        require_once __DIR__ . '/../views/consultas/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }
}
