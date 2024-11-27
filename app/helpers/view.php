<?php

if (!function_exists('view')) {
    function view($path) {
        $viewPath = __DIR__ . "/../views/" . $path . ".php";
        if (file_exists($viewPath)) {
            ob_start();
            require $viewPath;
            return ob_get_clean();
        }
        throw new Exception("Vista no encontrada: " . $path);
    }
}