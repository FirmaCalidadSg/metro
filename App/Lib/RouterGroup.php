<?php

namespace App\Lib;

class RouterGroup
{
    private $prefix;
    private $controller;
    private $routes = [];

    public function __construct($prefix, $controller)
    {
        $this->prefix = trim($prefix, '/');
        $this->controller = $controller;
    }

    public function add($path, $action, $method = 'GET')
{
    $fullPath = $this->prefix . '/' . trim($path, '/');
    $fullPath = trim($fullPath, '/');

    // Asegúrate de que $method sea siempre un array para manejar múltiples métodos
    $methods = is_array($method) ? $method : [$method];

    $this->routes[$fullPath] = [
        'controller' => $this->controller,
        'action' => $action,
        'methods' => $methods // Cambiado de 'method' a 'methods'
    ];

    return $this;
}

    public function getRoutes()
    {
        return $this->routes;
    }
}
