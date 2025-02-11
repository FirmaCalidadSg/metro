<?php

namespace App\Controllers;

class ConfiguracionController
{
    public function index()
    {
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/configuracion/index.php';
     
    }
    public function registroConfiguracion()
    {   
        require_once __DIR__ . '/../views/layouts/Sidebar2.php';
        require_once __DIR__ . '/../views/configuracion/registroConfiguracion.php';
    }
}   

