<?php

namespace App\Config;

class CustomAutoloader 
{
    public static function register() 
    {
        spl_autoload_register(function ($class) {
            // Convertir namespace a ruta de archivo
            $class = str_replace('App\\', '', $class);
            $class = str_replace('\\', '/', $class);
            
            $file = __DIR__ . '/../' . $class . '.php';
            
            error_log("Intentando cargar: " . $file);
            
            if (file_exists($file)) {
                require_once $file;
                error_log("Clase cargada: " . $class);
                return true;
            }
            
            error_log("No se encontró la clase: " . $class);
            return false;
        });
    }
} 