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

        $this->routes[$fullPath] = [
            'controller' => $this->controller,
            'action' => $action,
            'method' => $method
        ];

        return $this;
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
