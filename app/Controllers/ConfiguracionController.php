<?php

namespace App\Controllers;

class ConfiguracionController
{
    public function index()
    {
        require_once __DIR__ . '/../views/layouts/configuracion.php';
        require_once __DIR__ . '/../views/configuracion/index.php';
     
    }
    public function registrar()
    {   
        require_once   'views/layouts/registro.php';
        require_once __DIR__ . '/../views/configuracion/registrar.php';
        print_r(__DIR__);
    }
}   

