<?php

namespace App\Lib;

class Router {
    private $routes = [];
    private $params = [];
    
    public function add($path, $controller, $action, $method = 'GET') {
        $this->routes[$path] = [
            'controller' => $controller,
            'action' => $action,
            'method' => $method
        ];
        return $this;
    }
    
    public function group($prefix, $controller, callable $callback) {
        $group = new RouterGroup($prefix, $controller);
        $callback($group);
        $this->routes = array_merge($this->routes, $group->getRoutes());
        return $this;
    }
    
    public function match($uri, $method = 'GET') {
        foreach ($this->routes as $pattern => $route) {
            $pattern = $this->convertPattern($pattern);
            if (preg_match($pattern, $uri, $matches) && $route['method'] === $method) {
                array_shift($matches);
                $this->params = $matches;
                return $route;
            }
        }
        return false;
    }
    
    private function convertPattern($pattern) {
        $pattern = str_replace('/', '\/', $pattern);
        $pattern = preg_replace('/\{([a-zA-Z]+)\}/', '([^\/]+)', $pattern);
        return '/^' . $pattern . '$/';
    }
    
    public function dispatch($uri, $method = 'GET') {
        $route = $this->match($uri, $method);
        
        if (!$route) {
            throw new \Exception("Ruta no encontrada", 404);
        }
        
        $controllerName = "App\\Controllers\\" . $route['controller'];
        $actionName = $route['action'];
        
        if (!class_exists($controllerName)) {
            throw new \Exception("Controlador no encontrado: $controllerName", 404);
        }
        
        $controller = new $controllerName();
        
        if (!method_exists($controller, $actionName)) {
            throw new \Exception("Acción no encontrada: $actionName", 404);
        }
        
        return call_user_func_array([$controller, $actionName], $this->params);
    }
}               