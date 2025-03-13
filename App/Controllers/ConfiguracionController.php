<?php

namespace App\Controllers;

class ConfiguracionController
{
    public function index()
    {
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/configuracion/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

     
    }
    public function registroConfiguracion()
    {   
        require_once __DIR__ . '/../views/layouts/default.php';
        require_once __DIR__ . '/../views/configuracion/registroConfiguracion.php';
        require_once __DIR__ . '/../views/layouts/footer.php';

    }
}   

